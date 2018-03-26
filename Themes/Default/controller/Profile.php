<?php 
class PzkProfileController extends PzkFrontendController 
{
	public $masterPage		=	'index';
	public $masterPosition	=	'wrapper';
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
		$this->initPage();
		pzk_page()->set('title', 'Trang cá nhân');
		pzk_page()->set('keywords', 'Giáo dục');
		pzk_page()->set('description', 'Trang cá nhân thành viên');
		pzk_page()->set('img', '/Default/skin/nobel/Themes/Story/media/logo.png');
		pzk_page()->set('brief', 'Phần mềm Full Look, Phần mềm luyện thi vào lớp 6 Trần Đại Nghĩa');
		$this ->append('user/profile/detail')
		->display();
	}
	public function teacherAction()
	{	
		$this->initPage();
		pzk_page()->set('title', 'Trang cá nhân');
		pzk_page()->set('keywords', 'Giáo dục');
		pzk_page()->set('description', 'Trang cá nhân thành viên');
		pzk_page()->set('img', '/Default/skin/nobel/Themes/Story/media/logo.png');
		pzk_page()->set('brief', 'Phần mềm Full Look, Phần mềm luyện thi vào lớp 6 Trần Đại Nghĩa');
		$this ->append('user/profile/teacher');
		$this->display();
	}
	public function onchangeCateIdAction() {
        pzk_session('cateSelect', pzk_request('categoryId'));
        pzk_session('cateSelectName', pzk_request('cateName'));
        $this->redirect('teacher');
    }
	
	public function onchangeHistoryWeekAction() {
        pzk_session('historyWeek', pzk_request('historyWeek'));
        $this->redirect('Profile/detail');
    }
	public function onchangeHistoryMonthAction() {
        pzk_session('historyMonth', pzk_request('historyMonth'));
        $this->redirect('Profile/detail');
    }
	
    public function updateScheduleAction()
    {
    	$subject 	= pzk_request('subject');
    	$topicId 	= pzk_request('topicId');
    	$date 		= pzk_request('date');
    	$date 		= date("Y-m-d H:i:s", strtotime($date));
    	$status 	= pzk_request('status');
    	$lessonId 	= pzk_request('lessonId');
    	$scheduleId 	= pzk_request('scheduleId');
    	$teacher = _db()->getEntity('User.Account.Teacher');
    	if($scheduleId){
    		$rows = $teacher->loadWhere(array('id',$scheduleId));
    		if($rows){
    			$rows->update(array(
	    				'openDate'=>$date,
	    				'status'=> $status,
	    				'modifiedId'=>pzk_session('userId'),
						'modified'=>date('Y-m-d H:i:s', $_SERVER['REQUEST_TIME'])
    				)
    			);
    		}
    	}else{
			$lessonData = array(
					'subject' => $subject,
					'topic' 	=> $topicId,
					'exercise_number'=>$lessonId,
					'areacode'=> pzk_session('adminAreacode'),
					'district'=>pzk_session('adminDistrict'),
					'school'=>pzk_session('adminSchool'),
					'class'=>pzk_session('adminClass'),
					'className'=>pzk_session('adminClassname'),
					'openDate'=>$date,
					'status'=> $status,
					'software'=>pzk_request('softwareId'),
					'site'=>pzk_request('siteId'),
					'creatorId'=>pzk_session('userId'),
					'created'=>date('Y-m-d H:i:s', $_SERVER['REQUEST_TIME'])
			);
    		$teacher->create($lessonData);
    		$scheduleId = $teacher->get('id');
    	}
    	echo '1/'.$scheduleId;
    }
	public function bookAction($id)
	{	
		$this->initPage();
		pzk_page()->set('title', 'Trang cá nhân');
		pzk_page()->set('keywords', 'Giáo dục');
		pzk_page()->set('description', 'Trang cá nhân thành viên');
		pzk_page()->set('img', '/Default/skin/nobel/Themes/Story/media/logo.png');
		pzk_page()->set('brief', 'Phần mềm Full Look, Phần mềm luyện thi vào lớp 6 Trần Đại Nghĩa');
		$this ->append('user/profile/book');
		$book = pzk_element('book');
		if($book) {
			$book->set('itemId', $id);
		}
		$this->display();
	}
	public function booktlAction($userBookId){	
		$userId = pzk_session('userId');
		$frontend = pzk_model('Frontend');
		$userbookTl = $frontend->getUserBook($userBookId);
		
						
		if($userbookTl['status'] == 1) {
			//da cham xong
			
			$this->initPage();
				pzk_page()->set('title', 'Trang cá nhân');
				pzk_page()->set('keywords', 'Giáo dục');
				pzk_page()->set('description', 'Trang cá nhân thành viên');
				pzk_page()->set('img', '/Default/skin/nobel/Themes/Story/media/logo.png');
				pzk_page()->set('brief', 'Phần mềm Full Look, Phần mềm luyện thi vào lớp 6 Trần Đại Nghĩa');
				$this->append('education/test/resultTestTl', 'wrapper');
				
				$userBookModel 	= pzk_model('Userbook');
				
				$resultTestTl = pzk_element('resultTestTl');
				
				//du lieu cho bai tu luan
				$dataUserAnswers 	= $userBookModel->getUserAnswers($userBookId);
				
				$resultTestTl->set('dataUserAnswers', $dataUserAnswers);
				
				//diem bai thi tu luan 
				$scoreTl = $userbookTl['teacherMark'];
				$resultTestTl->set('scoreTl', $scoreTl);
				
					
			$this->display();
			
		} else {
			$this->initPage();
				pzk_page()->set('title', 'Trang cá nhân');
				pzk_page()->set('keywords', 'Giáo dục');
				pzk_page()->set('description', 'Trang cá nhân thành viên');
				pzk_page()->set('img', '/Default/skin/nobel/Themes/Story/media/logo.png');
				pzk_page()->set('brief', 'Phần mềm Full Look, Phần mềm luyện thi vào lớp 6 Trần Đại Nghĩa');
				$this->append('education/test/resultTestTl', 'wrapper');
				
				$userBookModel 	= pzk_model('Userbook');
				
				$resultTestTl = pzk_element('resultTestTl');
				
				//du lieu cho bai tu luan
				$dataUserAnswers 	= $userBookModel->getUserAnswers($userBookId);
				
				$resultTestTl->set('dataUserAnswers', $dataUserAnswers);
				
				//diem bai thi tu luan 
				$scoreTl = $userbookTl['teacherMark'];
				$resultTestTl->set('scoreTl', $scoreTl);
				
					
			$this->display();
		}
	}
	public function viewfileAction()
	{	
		$this->initPage();
		pzk_page()->set('title', 'Trang cá nhân');
		pzk_page()->set('keywords', 'Giáo dục');
		pzk_page()->set('description', 'Trang cá nhân thành viên');
		pzk_page()->set('img', '/Default/skin/nobel/Themes/Story/media/logo.png');
		pzk_page()->set('brief', 'Phần mềm Full Look, Phần mềm luyện thi vào lớp 6 Trần Đại Nghĩa');
		$this ->append('user/profile/viewfile')
		->display();
	}
	public function addInfoAction()
	{

		$request 	= pzk_request();

		$email= $request->get('addemail');
		$phone= $request->get('addphone');

		$user		= pzk_user();

		if($user->get('id')){
			$user->update(array(
					'phone'=> $phone,
					'email'=> $email
			));
			pzk_session('email',$email);	
			pzk_session('phone',$phone);
			pzk_system()->halt('1') ;
				
			echo "1";
		}
		pzk_system()->halt('0');
	}
	public function editPostAction()
	{
		$request 	= pzk_request();
		
		$name 		= $request->get('name');
		$birthday 	= $request->get('birthday');
		$address 	= $request->get('address');
		$schoolname 	= $request->get('schoolname');	
		$classname		= $request->get('class1');
		$area		= $request->get('areacode');
		$phone 		= $request->get('phone');
		$sex 		= $request->get('sex');
		
			
		$user		= pzk_user();
		
		if($user->get('id')) {
			if(pzk_request('softwareId') == 1 && pzk_request('siteId') == 2){
				$user->update(array(
				'name' 		=> 	$name,
				'birthday' 	=> 	$birthday, 
				'phone' 	=> 	$phone,
				'address' 	=> 	$address,
				
				'sex' 			=> 	$sex
				));

				pzk_session()->set('name', $name);
				pzk_session()->set('address', $address);
				
				pzk_session()->set('birthday', $birthday);
				
			}
			else{
				$user->update(array(
				'name' 		=> 	$name, 		'birthday' 		=> 	$birthday, 
				'address' 	=> 	$address, 	'sex' 			=> 	$sex,
				'phone' 	=> 	$phone, 	'school'		=>	$schoolname,
				'class'	=> 	$classname, 'areacode'      => $area));
			}
			
			pzk_system()->halt('1') ;
		}
		pzk_system()->halt('0');

	}
	
	public function changePasswordPostAction()
	{
		
		$request 		= 	pzk_element('request');
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
		$request		= pzk_element('request');
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
				$avatar 				= '/uploads/avatar/'.$new_file_name;
				$user->update(array(
						'avatar'		=> $avatar));
				pzk_session('avatar',$avatar);
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