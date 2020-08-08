<?php 
class PzkProfileController extends PzkFrontendController 
{
	public $masterPage		=	'index';
	public $masterPosition	=	'wrapper';
	const PAGE_PROFILE_DETAIL = 'user/profile/detail';
	const ENTITY_USER = 'User.Account.User';
	const MAIL_TEMPLATE_CHANGE_PASSWORD = 'user/mailtemplate/changePassword';
	const MAIL_TEMPLATE_CHANGE_PASSWORD_SUBJECT = 'Thay đổi mật khẩu';
	const CONTROLLER_CONFIRM_PASSWORD = 'profile/confirmChangePassword';
	const STATE_AVATAR_CHANGED_SUCCESSFULLY = "Thay đổi thành công";
	const STATE_AVATAR_EXTENSION_NOT_ALLOW = "Bạn chỉ được phép upload file ảnh JPG, JPEG, PNG, GIF";
	const STATE_AVATAR_SIZE_TOO_LARGE = "Dung lượng của file ảnh quá lớn, bạn hãy chọn file ảnh có kích thước < 488kb";
	const STATE_CHANGE_PASSWORD_SUCCESSFULLY = '1';
	const STATE_CHANGE_PASSWORD_FAILED = '0';
	public function detailAction()
	{
		$this->render(self::PAGE_PROFILE_DETAIL);
	}
	
	public function editPostAction()
	{
		$request 	= pzk_request();
		
		$name 		= $request->get('name');
		$birthday 	= $request->get('birthday');
		$address 	= $request->get('address');
		$phone 		= $request->get('phone');
		$sex 		= $request->get('sex');
		
		
		$school 	= $request->get('school');
		$class		= $request->get('class1');
		$area		= $request->get('areacode');
		
		$user		= pzk_user();
		
		if($user->get('id')) {
			$user->update(array(
				'name' 		=> 	$name, 		'birthday' 		=> 	$birthday, 
				'address' 	=> 	$address, 	'sex' 			=> 	$sex,
				'phone' 	=> 	$phone, 	'school'		=>	$school,
				'class'		=> 	$class, 	'areacode'		=>	$area));
			die('1') ;
		}
		die('0');

	}
	
	public function changePasswordPostAction()
	{
		
		$request 		= 	pzk_request();
		$oldpassword	=	md5($request->get('oldpass'));
		$newpassword	=	$request->get('newpass');
		
		$userId			= 	pzk_session('userId');
		$user			=	_db()->getEntity(self::ENTITY_USER);
		$user->loadWhere(array('and',array('id',$userId),array('password',$oldpassword)));
		if(pzk_config('register_active')) {
			if($user->get('id'))
			{
				$confirmpassword	= 	md5($oldpassword.$newpassword);
				$email				=	$user->get('email');			
				// Update Key
				$user->update(array('key' => $confirmpassword));
				$this->sendMail($email,	$confirmpassword,	$newpassword);
				echo self::STATE_CHANGE_PASSWORD_SUCCESSFULLY;
			}
			else
			{
				echo self::STATE_CHANGE_PASSWORD_FAILED;
			}	
		} else {
			if($user->get('id'))
			{
				$user->update(array('password' => md5($newpassword)));
				echo self::STATE_CHANGE_PASSWORD_SUCCESSFULLY;
			} else {
				echo self::STATE_CHANGE_PASSWORD_FAILED;
			}
		}
			
	}
	
	public function sendMail($email="",$key="",$newpassword="")
	{
		//tạo URL gửi email xác nhận đăng ký
		$mailtemplate = $this->parse(self::MAIL_TEMPLATE_CHANGE_PASSWORD);
		
		$url			= 	self::CONTROLLER_CONFIRM_PASSWORD;
		$newpassword	=	md5($newpassword);
		$arr			=	array('changePassword'	=> $key,	'conf'=>$newpassword);
		$request		=	pzk_request();
		$url			= 	$request->build($url,$arr);
		$mailtemplate->set('url', $url);
		$mail 			= 	pzk_mailer();
		$mail->AddAddress($email);
		$mail->Subject 	= self::MAIL_TEMPLATE_CHANGE_PASSWORD_SUBJECT;
		$mail->Body    	= $mailtemplate->get('content');
		if(!$mail->send()) {
			echo 'Message could not be sent.';
			echo 'Mailer Error: ' . $mail->ErrorInfo;
		}

	}
	
	public function confirmChangePasswordAction()
	{
		$request		= pzk_request();
		$confirm		= $request->get('changePassword');
		$newpassword	= $request->get('conf');
		$username		= pzk_session('username');
		$userId			= pzk_session('userId');
		$editdate 		= date("Y-m-d H:i:s"); 
		$user			= _db()->getEntity(self::ENTITY_USER);
		$user->loadWhere(array('and', 
			array('key', 		$confirm),
			array('username', 	$username)
		)); 
		if($user->get('id'))
		{	
			$this->initPage();
			$editpass 	= $this->parse('user/profile/changePasswordSuccess');
			$editpass->set('username', "ok");		
			$user->update(array('password' => $newpassword,'key'=>''));
			
			$this->append($editpass);
			$this->display();
		}
		else
		{
			$editpass 	= $this->parse('user/profile/changePasswordSuccess');
			$editpass->set('username', "");
			$this->initPage();
			$this->append($editpass);
			$this->display();
		}
	}
	
		// End Edit Avatar
	public function changeAvatarPostAction(){
		$max_image_size 		= 150; //Maximum image size (height and width
		$jpeg_quality 			= 150; 
		$image_temp 			= $_FILES['fileToUpload']['tmp_name'];
		
		$target_dir 			= BASE_DIR."/uploads/avatar/";
		$basename				= basename($_FILES["fileToUpload"]["name"]);
		$imageFileType 			= pathinfo($basename,PATHINFO_EXTENSION);
		$size 					= $_FILES["fileToUpload"]["size"];	
		if($size < 500000){
			if($imageFileType == "jpg" || $imageFileType == "png" || $imageFileType == "jpeg"|| $imageFileType == "gif"|| 
					$imageFileType == "JPG" || $imageFileType == "PNG" || $imageFileType == "JPEG" || $imageFileType == "GIF"){
				$image_size_info 		= getimagesize($image_temp);
				if($image_size_info){
					$image_width 		= $image_size_info[0]; //image width
					$image_height 		= $image_size_info[1]; //image height
					$image_type 		= $image_size_info['mime']; //image type
				}else{
					//$error="File ảnh không đúng quy định";
					echo "01";
				}
				$new_file_name 			= pzk_session('userId').'.'. $imageFileType;
				move_uploaded_file($image_temp, BASE_DIR.'/tmp/'.$new_file_name);
				$thumb 					= createThumb('/tmp/'.$new_file_name, 120, 120);
				rename(BASE_DIR.$thumb, BASE_DIR.'/uploads/avatar/'.$new_file_name);
				unlink(BASE_DIR.'/tmp/'.$new_file_name);
				$user 					= pzk_user();
				$user->update(array(
						'avatar'		=> '/uploads/avatar/'.$new_file_name));
				$error 					= self::STATE_AVATAR_CHANGED_SUCCESSFULLY;
			}else{
				
				$error					= self::STATE_AVATAR_EXTENSION_NOT_ALLOW;
				//echo "02";
			}

		}else{
			$error						= self::STATE_AVATAR_SIZE_TOO_LARGE;
			//echo "03";
		}
		echo $error;
	}
}
 ?>