<?php 
class PzkProfileController extends PzkFrontendController 
{
	public $masterPage = 'profile';
	public $masterPosition = 'left_profile';
	public function detailAction()
	{
		if(1 && pzk_themes('cms')) {
			$this->setMasterPage('onepage');
			$this->setMasterPosition('left');
			
		}
		$this->render('user/profile/detail');
		
	}
	

	// Sửa thông tin cá nhân
	public function editAction() 
	{
		$this->initPage();
			$userId = pzk_session()->getUserId();
			$user = _db()->getEntity('User.Account.User');
			$user->loadWhere(array('id',$userId));
			$editinfor = $this->parse('user/profile/edit');
			// lấy thông tin cá nhân
			$name = $user->getName();
			$birthday = $user->getBirthday();
			$address = $user->getAddress();
			$phone = trim($user->getPhone());
			$sex = $user->getSex();
			$school = $user->getSchool();
			$class = $user->getClass();
			$area = $user->getAreacode();
			// Hiển thị thông tin tài khoản
			$editinfor->setName($name);
			$editinfor->setBirthday($birthday);
			$editinfor->setAddress( $address);
			$editinfor->setPhone($phone);
  			$editinfor->setSex( $sex);
  			$editinfor->setSchool($school);
			$editinfor->setClass($class);
			$editinfor->setAreacode( $area);
			
			$this->append($editinfor);
			$this->display();
	}
	public function editPostAction()
	{
		$message = "";
		$request = pzk_request();
		$name = $request->getName();
		$birthday = $request->getBirthday();
		$address = $request->getAddress();
		$phone = $request->getPhone();
		$sex = $request->getSex();
		$editdate = date("Y-m-d H:i:s"); 
		$userId = pzk_session()->getUserId();
		$school = $request->getSchool();
		$class = $request->getClass1();
		$area = $request->getAreacode();
		$user = _db()->getEntity('User.Account.User');
		$user->loadWhere(array('id',$userId));
		$user->update(array('name' => $name, 'birthday' => $birthday, 'address' => $address, 'sex' => $sex, 'phone' => $phone, 'school' =>$school, 'class' =>$class, 'areacode' =>$area, 'modified' =>$editdate, 'modifiedId' =>$userId));
		$message = "Cập nhật thông tin thành công!";
		$user->loadWhere(array('id',$userId));
		$editinfor = $this->parse('user/profile/edit');
		// lấy thông tin cá nhân
		$name = $user->getName();
		$birthday = $user->getBirthday();
		$address = $user->getAddress();
		$phone = $user->getPhone();
		$sex = $user->getSex();
		$school = $user->getSchool();
		$class = $user->getClass();
		$area = $user->getAreacode();
		// Hiển thị thông tin tài khoản
		$editinfor->setMessage($message);
		$editinfor->setName($name);
		$editinfor->setBirthday($birthday);
		$editinfor->setAddress( $address);
		$editinfor->setPhone($phone);
  		$editinfor->setSex( $sex);
		$editinfor->setSchool($school);
		$editinfor->setClass($class);
		$editinfor->setAreacode( $area);
		$this->initPage();
		
		$this->append($editinfor);
		
		$this->display();

	}

	public function addinforPostAction()
	{
		$request = pzk_request();
		$email = $request->getEmail();
		$username = $request->getUsername();
		$user = _db()->getEntity('User.Account.User');

		$testUser = $user->loadWhere(array('username',$username));
		if($testUser->getId()) {
				//$error = "Tên đăng nhập đã tồn tại trên hệ thống";
				echo '01';
				return false;
		}else{
				
			$testEmail = $user->loadWhere(array('email',$email));
			if($testEmail->getId()) {
				//$error = "Email đã tồn tại trên hệ thống";
				echo '02';
				return false;
			}else{
				$sex = $request->getSex();
				$password = $request->getPassword();
				$password = md5($password);
				$birthday = $request->getBirthday();
				$phone = $request->getPhone();
				$address = $request->getAddress();
				$school = $request->getSchool();
				$class = $request->getClass1();
				$area = $request->getArea();
				$editdate = date("Y-m-d H:i:s"); 
				$userId = pzk_session()->getUserId();
				$user->loadWhere(array('id',$userId));
				$user->update(array('username' => $username, 'birthday' => $birthday, 'address' => $address, 'phone' => $phone, 'sex' => $sex, 'password' => $password, 'email' => $email, 'school' => $school, 'class' => $class, 'areacode' => $area, 'modified' =>$editdate, 'modifiedId' =>$userId));
				pzk_session()->setUsername($username);
				echo '1';
			}
		}
	
	}
	public function addinforGPostAction()
	{
		
		$request = pzk_request();
		$username = $request->getUsername();
		$user = _db()->getEntity('User.Account.User');
		$testUser = $user->loadWhere(array('username',$username));
		if($testUser->getId()) {
			echo '01';
		}else{
				$name = $request->getName();
				$sex = $request->getSex();
				$password = $request->getPassword();
				$password = md5($password);
				$birthday = $request->getBirthday();
				$phone = $request->getPhone();
				$address = $request->getAddress();
				$school = $request->getSchool();
				$class = $request->getClass1();
				$area = $request->getArea();
				$editdate = date("Y-m-d H:i:s"); 
				$userId = pzk_session()->getUserId();
				$user->loadWhere(array('id',$userId));
				$user->update(array('name' =>$name, 'username' => $username, 'birthday' => $birthday, 'address' => $address, 'phone' => $phone, 'password' => $password, 'class' => $class, 'school' => $school, 'areacode' => $area, 'modified' =>$editdate, 'modifiedId' =>$userId));
				pzk_session()->setUsername($username);
				echo '1';
		}
	}
	public function changePasswordAction()
	{
		$this->initPage();
		$this->append('user/profile/changePassword');
		$this->display();
	}
	public function changePassword1Action()
	{
		
		$request = pzk_request();
		$oldpassword = md5($request->getOldpass());
		$newpassword = $request->getNewpass();
		
		$userId = pzk_session()->getUserId();
		$user = _db()->getEntity('User.Account.User');
		$user->loadWhere(array('and',array('id',$userId),array('password',$oldpassword)));
		if($user->getId())
		{
			$confirmpassword = md5($oldpassword.$newpassword);
			$email = $user->getEmail();			
			// Update Key
			$user->update(array('key' => $confirmpassword));
			$this->sendMail($email,$confirmpassword,$newpassword);
			echo "1";
		}	
		else
		{
			echo "0";
		}	
	}
	
	public function sendMail($email = "",$key = "",$newpassword = "")
	{
		//tạo URL gửi email xác nhận đăng ký
		$mailtemplate = $this->parse('user/mailtemplate/changePassword');
		//$url = "http://".$_SERVER["SERVER_NAME"].'/Profile/confirmchangePassword';
		$url = 'Profile/confirmchangePassword';
		$newpassword = md5($newpassword);
		$arr = array('changePassword' =>$key, 'conf' =>$newpassword);
		$request = pzk_request();
		$url = $request->build($url,$arr);
		$mailtemplate->setUrl($url);
		$mail = pzk_mailer();
		$mail->AddAddress($email);
		$mail->Subject = 'Thay đổi mật khẩu';
		$mail->Body    = $mailtemplate->getContent();
		if(!$mail->send()) {
			echo 'Message could not be sent.';
			echo 'Mailer Error: ' . $mail->ErrorInfo;
		}

	}
	
	public function confirmpassAction()
	{
		$request = pzk_request();
		$confirm = $request->getChangePassword();
		$newpassword = $request->getConf();
		$username = pzk_session()->getUsername();
		$userId = pzk_session()->getUserId();
		$editdate = date("Y-m-d H:i:s"); 
		$user = _db()->getEntity('User.Account.User');
		$user->loadWhere(array(array('key', $confirm),array('username',$username))); 
		if($user->getId())
		{	
			$editpass = $this->parse('user/profile/changePasswordsuccess');
			$editpass->setUsername("ok");		
			$user->update(array('password' => $newpassword, 'key' =>'', 'modified' =>$editdate, 'modifiedId' =>$user->getId()));
			
			$this->initPage();
			$this->append($editpass);
			$this->display();
		}
		else
		{
			$editpass = $this->parse('user/profile/changePasswordsuccess');
			$editpass->setUsername("");
			$this->initPage();
			$this->append($editpass);
			$this->display();
		}
	}
	public function editpassSAction()
	{
			$this->render('user/profile/changePasswordsuccess');
	}
	// EditAvatar

	
	//Edit Avatar
	public function normal_resize_image($source, $destination, $image_type, $max_size, $image_width, $image_height, $quality){
	
		if($image_width <= 0 || $image_height <= 0){return false;} //return false if nothing to resize
		
		//do not resize if image is smaller than max size
		if($image_width <= $max_size && $image_height <= $max_size){
			if($this->save_image($source, $destination, $image_type, $quality)){
				return true;
			}
		}
		
		//Construct a proportional size of new image
		$image_scale	 = min($max_size/$image_width, $max_size/$image_height);
		$new_width		 = ceil($image_scale * $image_width);
		$new_height		 = ceil($image_scale * $image_height);
		
		$new_canvas		 = imagecreatetruecolor( $new_width, $new_height ); //Create a new true color image
		
		//Copy and resize part of an image with resampling
		if(imagecopyresampled($new_canvas, $source, 0, 0, 0, 0, $new_width, $new_height, $image_width, $image_height)){
			$this->save_image($new_canvas, $destination, $image_type, $quality); //save resized image
		}

		return true;
	}

	##### This function corps image to create exact square, no matter what its original size! ######
	public function crop_image_square($source, $destination, $image_type, $square_size, $image_width, $image_height, $quality){
		if($image_width <= 0 || $image_height <= 0){return false;} //return false if nothing to resize
		
		if( $image_width > $image_height )
		{
			$y_offset = 0;
			$x_offset = ($image_width - $image_height) / 2;
			$s_size 	 = $image_width - ($x_offset * 2);
		}else{
			$x_offset = 0;
			$y_offset = ($image_height - $image_width) / 2;
			$s_size = $image_height - ($y_offset * 2);
		}
		$new_canvas	 = imagecreatetruecolor( $square_size, $square_size); //Create a new true color image
		
		//Copy and resize part of an image with resampling
		if(imagecopyresampled($new_canvas, $source, 0, 0, $x_offset, $y_offset, $square_size, $square_size, $s_size, $s_size)){
			$this->save_image($new_canvas, $destination, $image_type, $quality);
		}

		return true;
	}

##### Saves image resource to file ##### 
	public function save_image($source, $destination, $image_type, $quality){
		switch(strtolower($image_type)){//determine mime type
			case 'image/png': 
				imagepng($source, $destination); return true; //save png file
				break;
			case 'image/gif': 
				imagegif($source, $destination); return true; //save gif file
				break;          
			case 'image/jpeg': case 'image/pjpeg': 
				imagejpeg($source, $destination, $quality); return true; //save jpeg file
				break;
			default: return false;
		}
	}
		// End Edit Avatar
	public function editavatarPostAction(){
		$max_image_size 		 = 150; //Maximum image size (height and width
		$jpeg_quality 			 = 150; 
		//$fileToUpload = pzk_request()->getFileToUpload();
		$image_name = $_FILES['fileToUpload']['name']; //file name
		$image_size = $_FILES['fileToUpload']['size']; //file size
		$image_temp = $_FILES['fileToUpload']['tmp_name'];
		$destination_folder = BASE_DIR."/uploads/avatar/";
		$target_dir = BASE_DIR."/uploads/avatar/";
		$basename = basename($_FILES["fileToUpload"]["name"]);
		$target_file = $target_dir .$basename;
		$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
		$size = $_FILES["fileToUpload"]["size"];	
		if($size < 500000){
			if($imageFileType == "jpg" || $imageFileType == "png" || $imageFileType == "jpeg"|| $imageFileType == "gif"|| $imageFileType == "JPG" || $imageFileType == "PNG" || $imageFileType == "JPEG" || $imageFileType == "GIF"){
				$image_size_info 	 = getimagesize($image_temp);
				if($image_size_info){
					$image_width 		 = $image_size_info[0]; //image width
					$image_height 		 = $image_size_info[1]; //image height
					$image_type 		 = $image_size_info['mime']; //image type
				}else{
						//$error = "File ảnh không đúng quy định";
						echo "01";
					}
				switch($image_type){
					case 'image/png':
						$image_res =  imagecreatefrompng($image_temp); break;
					case 'image/gif':
						$image_res =  imagecreatefromgif($image_temp); break;			
					case 'image/jpeg': case 'image/pjpeg':
						$image_res = imagecreatefromjpeg($image_temp); break;
					default:
						$image_res = false;
				}
				if($image_res){
					$image_info = pathinfo($image_name);
					$image_extension = strtolower($image_info["extension"]); //image extension
					$image_name_only = strtolower($image_info["filename"]);//file name only, no extension
					$new_file_name = pzk_session()->getUserId().'.'. $imageFileType;
					$image_save_folder 	 = $target_dir . $new_file_name;
					$this->normal_resize_image($image_res, $image_save_folder, $image_type, $max_image_size, $image_width, $image_height, $jpeg_quality);
					imagedestroy($image_res); //freeup memory
					$userId = pzk_session()->getUserId();
					$userId = pzk_session()->getUserId();
					$editdate = date("Y-m-d H:i:s");
					$avatar = '/uploads/avatar/'.$new_file_name;
					$user = _db()->getEntity('User.Account.User');
					$user->loadWhere(array('id',$userId));
					$user->update(array('avatar' =>$avatar, 'modified' =>$editdate, 'modifiedId' =>$userId));
					//$message = "Bạn đã thay đổi avatar thành công";
					
				}
			}else{
				//$error = "Bạn chỉ được phép upload file ảnh JPG, JPEG, PNG, GIF";
				//echo "02";
			}

		}else{
			//$error = "Dung lượng của file ảnh quá lớn, bạn hãy chọn file ảnh có kích thước < 488kb ";
			//echo "03";
		}
		
	}
}
 ?>