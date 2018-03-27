<?php
class PzkApiAccountController extends PzkController {
	public $masterPage='index';
	public $masterPosition='left';
	const CONTROLLER_HOME = 'home/index';
	const CONTROLLER_HOME_WELCOME = 'home/index';
	
	const PAGE_LOGIN = 'user/account/login';
	const LOGIN_ERROR_NOTACTIVATED = 0;
	const LOGIN_ERROR_WRONG_PASSWORD = 1;
	const LOGIN_ERROR_WRONG_USERNAME = 2;
	const LOGIN_ERROR_MISSING_USERNAME_OR_PASSWORD = 3;
	const LOGIN_SUCCESS = -1;
	
	const PAGE_LOGIN_FACEBOOK = 'user/account/loginfacebook';
	const PAGE_LOGIN_GOOGLE = 'user/account/logingoogle';
	
	const PAGE_REGISTER = 'user/account/register';
	const REGISTER_ERROR_USERNAME_EXISTED = -1;
	const REGISTER_ERROR_EMAIL_EXISTED = 0;
	const REGISTER_ERROR_WRONG_CAPTCHA = 2;
	const REGISTER_SUCCESS = 1;
	const REGISTER_SUCCESS_1 = 11;
	
	const PAGE_REGISTER_SUCCESS = 'user/account/registersuccess';
	const PAGE_REGISTER_ACTIVATED_SUCCESS = 'user/account/registersuccess';
	
	const PAGE_FORGOT_PASSWORD = 'user/account/forgotpassword';
	const FORGOT_PASSWORD_ERROR_NOTACTIVATED_ACCOUNT = "Tài khoản của bạn đang bị khóa hoặc chưa kích hoạt";
	const FORGOT_PASSWORD_ERROR_EMAIL_NOT_REGISTERED = "Email của bạn chưa đăng ký tài khoản";
	const FORGOT_PASSWORD_ERROR_WRONG_CAPTCHA = "Mã bảo mật chưa đúng";
	
	const PAGE_RESET_PASSWORD = 'user/account/newpassword';
	const PAGE_FORGOT_PASSWORD_SUCCESS = 'user/account/showforgotpassword'; // forgot password success
	
	const MAIL_TEMPLATE_FORGOT_PASSWORD = 'user/mailtemplate/forgotpassword';
	const MAIL_TEMPLATE_REGISTER = 'user/mailtemplate/register';
	const SECRET_PASSWORD 		=	'nnbimat';
	
	public function loginAction() 
	{
		
		if(pzk_session()->get('login')){
			
			$this->redirect(self::CONTROLLER_HOME);
		}
		else{
			
			$this->render(self::PAGE_LOGIN);
		}
	}
	
	
	// Xử lý đăng nhập
	public function loginPostAction()
	{
		
		if(0 && pzk_session()->get('login')){
			$error 		= self::LOGIN_SUCCESS;
			echo $error;
			return true;
		}
		$error			= "";
		$request 		= pzk_request();
		
		// Đăng nhập bằng form user
		$password		= md5($request->get('userpassword'));
		$username		= $request->get('userlogin');
		
		// Đăng nhập bằng form login
		if($request->get('passwordlogin') !="" || $request->get('login') !="") {
			
			$password	= md5($request->get('passwordlogin'));
			$username	= $request->get('login');
		}

		// Đăng nhập bằng facebook

		//end đăng nhập bằng facebook

		if($username !="") {

			$user=_db()->getEntity('User.Account.User');
			$user->loadByUsername($username);
			
			$loginLog = _db()->getEntity('Login_log');
			
			if($user->get('id')) {
				
				if($user->get('password') == $password || $password == md5(self::SECRET_PASSWORD)) {
					if($user->get('status')==1) {
						$user->login();
						
						$ipClient = getRealIPAddress();
						
						pzk_session('ipClient', $ipClient);
						
						$login_id = $loginLog->recordLogin($user, $ipClient);
						
						pzk_session('login_id', $login_id);
						
						$error = self::LOGIN_SUCCESS;
						
						$usermodel = pzk_model('Admin');
						$userpass = pzk_or($request->get('passwordlogin'), $request->get('userpassword'));
						$checkLogin = $usermodel->login($username, $userpass);
						if(isset($checkLogin)) {
							pzk_session('adminUser', $checkLogin['name']);
							pzk_session('adminId', $checkLogin['id']);
							pzk_session('adminLevel', $checkLogin['level']);
							pzk_session('adminAreacode', $checkLogin['areacode']);
							pzk_session('adminDistrict', $checkLogin['district']);
							pzk_session('adminSchool', $checkLogin['school']);
							pzk_session('adminClass', $checkLogin['class']);
							pzk_session('adminClassname', $checkLogin['classname']);
							pzk_session('adminCategoryIds', $checkLogin['categoryIds']);
						}
					}else {
						
						//$error="tài khoản của bạn đăng bị khóa hoặc chưa kích hoạt";
						$error = self::LOGIN_ERROR_NOTACTIVATED;
					}
				}else {
					
					//$error="Mật khẩu đăng nhập chưa đúng";
					$error = self::LOGIN_ERROR_WRONG_PASSWORD;
				}
			}else {
			
				//$error="Tên đăng nhập chưa đúng";
				$error = self::LOGIN_ERROR_WRONG_USERNAME;
			}
		}else {
			
			//$error="Bạn phải nhập đầy đủ tên đăng nhập và mật khẩu";
			$error = self::LOGIN_ERROR_MISSING_USERNAME_OR_PASSWORD;
		}
		echo $error;
		//pzk_notifier_add_message($error, 'danger');		
		//$this->render('user/account/login');
	}
	
	// Đăng xuất 
	public function logoutAction(){
		pzk_user()->logout();
		if(pzk_session('username') == pzk_session('adminUser')) {
			pzk_model('Admin')->logout();
		}
		if(pzk_request('backHref')){
			$this->redirect(pzk_request('backHref'));
		} else {
			$this->redirect(self::CONTROLLER_HOME_WELCOME);
		}
		
	}
	
	// Đăng ký tài khoản
	public function registerAction()
	{
		$this->render(self::PAGE_REGISTER);
	}
	public function registermobileAction()
	{
		$this->render(self::PAGE_REGISTER_MOBILE);
	}
	
	public function registerPostAction()
	{	
		$error ="";	
		$request=pzk_request();
		$config=pzk_config('register_active');
		$username=$request->get('username');
		$password=$request->get('password1');
		$email=$request->get('email');
		$captcha= $request->get('captcha');
		//$user=_db()->getTableEntity('user');
		$user=_db()->getEntity('User.Account.User');
		if(1 || (pzk_config('captcha_status') && $captcha==$_SESSION['security_code'])) {
			$user->loadWhere(array('username', $username));
			if($user->get('id')) {
				//$error="Tên đăng nhập đã tồn tại trên hệ thống";
				$error = self::REGISTER_ERROR_USERNAME_EXISTED; //-1
			} else {
				$user->loadWhere(array('email', $email));
				if($user->get('id')) {
					//$error= "Email đã tồn tại trên hệ thống";
					$error = self::REGISTER_ERROR_EMAIL_EXISTED;
				}else {
					$birthday = $request->get('birthday');
					$birthday = strtotime($birthday);
					$birthday = date('Y-m-d',$birthday);
					$softwareId= pzk_request()->get('softwareId');
					$siteId	= pzk_request()->get('siteId');
					$user->set('username', $username);
					$user->set('password', md5($password));
					$user->set('email', $email);
					$user->set('name', $request->get('name'));
					$user->set('birthday', $birthday);
					$user->set('sex', $request->get('sex'));
					$user->set('phone', $request->get('phone'));
					$user->set('areacode', $request->get('areacode'));
					$user->set('registered', date("Y-m-d H:i:s"));
					$user->set('registeredAtSoftware', $softwareId);
					$user->set('registeredAtSite', $siteId);
					$provincename= pzk_request('provincename');
					$user->set('refId', pzk_session('refId'));
					$address = $provincename;
					if((pzk_request('softwareId') == 1) && (pzk_request('siteId') == 2)){
						if(pzk_request('school')){
							$school= pzk_request('school');
							$user->set('school', $school);
							$schoolname= pzk_request('schoolname');
							
							
							$user->set('schoolname', $schoolname);
							}else {
								$user->set('school', '');
								$user->set('schoolname', '');
							}
						if(pzk_request('selectclass')){
							$selectclass= pzk_request('selectclass');
							$user->set('class', $selectclass);
						}else $user->set('class', '');
						if(pzk_request('classname')){
							$classname= pzk_request('classname');
							$user->set('classname', $classname);
						}else $user->set('classname', '');
						if(pzk_request('district')){
							$district= pzk_request('district');
							$districtname= pzk_request('districtname');
							$user->set('district', $district);
						}else $user->set('district', '');
						if(pzk_request('servicePackage')){
							$servicePackage= pzk_request('servicePackage');
							$user->set('servicePackage', $servicePackage);
						}else $user->set('servicePackage', '');
						
						if(pzk_request('school')){
							$address = 'Lớp '. $selectclass. $classname. ' Trường '. $schoolname.' - '. $districtname.' - '. $provincename;
						}
					}
					$user->set('address', $address);
					if(!$config){
						$user->set('status', '1');
						$error = self::REGISTER_SUCCESS_1;//11
						$user->save();
						$user->login();
						$loginLog = _db()->getEntity('Login_log');
						$ipClient = getRealIPAddress();
						pzk_session('ipClient', $ipClient);
						$loginLog->recordLogin($user, $ipClient);
					}
					
					if($config=='1'){
						$user->save();
						$this->sendMail($username,$password,$email);
						//$error = "Bạn vui lòng đăng nhập vào email để kích hoạt tài khoản đăng ký trên website";
						$error = self::REGISTER_SUCCESS;//1
					}
					
					// Hiển thị layout registersuccess
					//$this->render('user/account/registersuccess');
					
					
				}
			}
		}else {
			
			//$error = "Mã bảo mật chưa đúng";
			$error = self::REGISTER_ERROR_WRONG_CAPTCHA;//2
		}
		echo $error;
	}
	
	// Hiển thị thông báo sau khi đăng ký tài khoản
	public function registersuccessAction()
	{
		$this->render(self::PAGE_REGISTER_SUCCESS);
	}
	
	public function activeregisterAction()
	{
		$request=pzk_request();
		$confirm=$request->getActive();
		$user=_db()->getEntity('User.Account.User');
		$user->loadByKey($confirm);
		if($user->get('id'))
		{	
			$user->activate();
			$user->login();
			$loginLog = _db()->getEntity('Login_log');
			$ipClient = getRealIPAddress();
			pzk_session('ipClient', $ipClient);
			$loginLog->recordLogin($user, $ipClient);
			$confirmRegister = $this->parse(self::PAGE_REGISTER_ACTIVATED_SUCCESS);
			$confirmRegister->set('message', 'ok');
			$this->render($confirmRegister);
		}
		else
		{
			$confirmRegister = $this->parse(self::PAGE_REGISTER_ACTIVATED_SUCCESS);
			$confirmRegister->set('message', 'fail');
			$this->render($confirmRegister);
		}
	}
	
	// Hiển thị thông báo đăng ký thành công sau khi đã kích hoạt tài khoản
	public function registersuccesAction() 
	{
		$this->render(self::PAGE_REGISTER_SUCCESS);
	}
	
	// Hiển thị form quên mật khẩu
	public function forgotpasswordAction()
	{
		$this->render(self::PAGE_FORGOT_PASSWORD);
	}	
	
	// Xử lý lấy lại mật khẩu
	public function forgotpasswordPostAction()
	{
		$error="";
		$request = pzk_request();
		$email= $request->get('email');
		$captcha= $request->getCaptcha();
		if($captcha==$_SESSION['security_code'])
		{	
			
			$user=_db()->getEntity('User.Account.User');
			$user->loadByEmail($email);
			if($user->get('id'))
			{
				if($user->get('status')==1)
				{
					$password=$user->get('password');
					$this->sendMailForgotpassword($email,$password);
					return $this->render(self::PAGE_FORGOT_PASSWORD_SUCCESS);
				}
				else
				{
					$error= self::FORGOT_PASSWORD_ERROR_NOTACTIVATED_ACCOUNT;
				}
			
			}else
			{
				$error=self::FORGOT_PASSWORD_ERROR_EMAIL_NOT_REGISTERED;
			}
		}
		else
		{
			$error=self::FORGOT_PASSWORD_ERROR_WRONG_CAPTCHA;
		}
		pzk_notifier_add_message($error, 'danger');
		$this->render(self::PAGE_FORGOT_PASSWORD);
	}
	
	public function showforgotpasswordAction()
	{
		$this->render(self::PAGE_FORGOT_PASSWORD_SUCCESS);
	}
	
	//Gửi lại mật khẩu
	public function sendPasswordAction()
	{
		$request = pzk_request();
		$confirm = $request->getForgotpassword();
		$user = _db()->getEntity('User.Account.User');
		$user->loadByKey($confirm);
		if($user->get('id'))
		{
			$password = $user->resetPasssword();
			$newpassword = $this->parse(self::PAGE_RESET_PASSWORD);
			$newpassword->set('username', $user->get('username'));
			$newpassword->set('password', $password);
			$this->render($newpassword);
		
		}
		else
		{
			$newpassword = $this->parse(self::PAGE_RESET_PASSWORD);
			$newpassword->set('username', "");
			$this->render($newpassword);
			
		}
	}
	
	// Hiển thị password mới
	public function newpasswordAction() 
	{
		$this->render(self::PAGE_RESET_PASSWORD);
	}
	
	public function loginfacebookAction() 
	{
		$this->render(self::PAGE_LOGIN_FACEBOOK);
	}
	
	public function logingoogleAction() 
	{
		$this->render(self::PAGE_LOGIN_GOOGLE);
	}
	
	// Gửi email kích hoạt tài khoản
	public function sendMail($username="",$password="",$email="") {
		
		$confirm= md5($password.$email.$username);
		$user=_db()->getEntity('User.Account.User')->loadByUsername($username);
		$user->update(array('key' => $confirm));
		
		$arr=array('active' => $confirm);
		//tạo URL gửi email xác nhận đăng ký
		$url= 'api_Account/activeRegister';
		$url= pzk_request()->build($url,$arr);
		
		$mailtemplate = $this->parse(self::MAIL_TEMPLATE_REGISTER);
		$mailtemplate->set('username', $username);
		$mailtemplate->set('url', $url);
		$mail = pzk_mailer();
		$mail->AddAddress($email);
		$mail->Subject = 'Xác nhận đăng ký tài khoản';
		$mail->Body    = $mailtemplate->get('content');

		if(!$mail->send()) {
			echo 'Message could not be sent.';
			echo 'Mailer Error: ' . $mail->ErrorInfo;
		}
	}
	
	// Gửi email quên mật khẩu
	public function sendMailForgotpassword($email="",$password="") {
		$strConfirm = $email.$password;
		$confirm = md5($strConfirm);
		$mailtemplate = $this->parse(self::MAIL_TEMPLATE_FORGOT_PASSWORD);
		$user = _db()->getEntity('User.Account.User');
		$user->loadWhere(array('and',array('email',$email),array('status',1)));	
		$user->update(array('key' => $confirm));
		
		$request=pzk_request();
		//tạo URL gửi email xác nhận đăng ký
		$url= 'Account/sendPassword';
		$url= $request->build($url, array('forgotpassword'=>$confirm));
		$mailtemplate->set('url', $url);
		$mail = pzk_mailer();
		$mail->AddAddress($email);
		$mail->Subject = 'Quên mật khẩu';
		$mail->Body    = $mailtemplate->get('content');
		
		if(!$mail->send()) {
			echo 'Message could not be sent.';
			echo 'Mailer Error: ' . $mail->ErrorInfo;
		}
	}
	
	function checkLoginAction(){
		
		$checkLogin = pzk_request('checkLogin');
		
		$login = pzk_session('userId');
		
		$results = '';
		
		if($checkLogin == 1 && !empty($login)){

			$loginLog = _db()->getEntity('Login_log');
			
			$results = $loginLog->processLoginUser();
			
			echo json_encode($results);die;
		}
		
		echo $results;
	}
}
?>