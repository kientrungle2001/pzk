<?php 
class PzkProfileController extends PzkFrontendController 
{
	public $masterPage='index';
	public $masterPosition='left';
	
	public function profileuserAction()
	{
		$this->initPage();
		$member= pzk_request()->getMember();
		$sessionId= pzk_session('userId');	
		if($member==$sessionId){
			$this->append('user/profile/profileuser','right');
		}else $this->append('user/profile/profileuser1','right');	
		$this->page->display();	
	}
	public function messageAction(){
		$scriptable=false;
		$this->layout();		
		$this->append('user/profile/profileuser')->append('user/profile/newMessage');
		$this->page->display();
	}
	public function delMessageAction(){
		$userId= pzk_request()->getUserId();
		if($userId== pzk_session('userId')){
			$mess= _db()->select('new_message.*')
				->from('new_message')
				->where(array('userId',pzk_session('userId')))
				->where(array('status',0))
				->result('user.newmessage');
			foreach ($mess as $item) {
				$item->update(array('status'=>1));
			}
			echo 1;
		}else echo 0;
	}
	public function delOneMessageAction(){
		$userId= pzk_request()->getUserId();
		$messageType= pzk_request()->getMessageType();
		if($userId== pzk_session('userId')){
			$mess= _db()->select('new_message.*')
				->from('new_message')
				->where(array('userId',pzk_session('userId')))
				->where(array('messageType',$messageType))
				->where(array('status',0))
				->result('user.newmessage');
			foreach ($mess as $item) {
				$item->update(array('status'=>1));
			}
			echo 1;
		}else echo 0;
	}
	public function addinforAction()
	{	
		$this->initPage();		
		
		$this->append('user/profile/addinfor');
		$this->page->display();
			
	}
	public function addinforgoogleAction()
	{
		$this->initPage();		
		
		$this->append('user/profile/addinforgoogle');
		$this->page->display();
			
	}
	public function profileuserleft1Action()
	{
		$this->initPage();
		$this->append('user/profile/profileuserleft1');
		$this->display();
	}
	public function userAction()
	{
		$this->initPage();
		$member= pzk_request()->getMember();
		$sessionId= pzk_session('userId');	
		if($member==$sessionId){
			$this->append('user/profile/profileuser')->append('user/profile/profileusercontent');
		}else $this->append('user/profile/profileuser1')->append('user/profile/profileusercontent1');
		$this->display();		
	}
	// Sửa thông tin cá nhân
	public function editinforAction() 
	{
			$scriptable=false;
			$this->layout();
			$this->append('user/profile/edit','left');
			$this->display();
	}
	public function editinforPostAction()
	{	
		
		$message="";
		$request = pzk_request();
		$name=$request->getName();
		$birthday=$request->getBirthday();
		$address=$request->getAddress();
		$phone=$request->getPhone();
		$sex=$request->getSex();
		$editdate = date("Y-m-d H:i:s"); 
		$userId= pzk_session('userId');
		$school=$request->getSchool();
		$class=$request->getClass1();
		$area=$request->getAreacode();
		$user=_db()->getEntity('User.Account.User');
		$user->loadWhere(array('id',$userId));
		$user->update(array('name' => $name,'birthday' => $birthday,'address' => $address,'sex' => $sex,'phone' => $phone,'school'=>$school,'class'=>$class,'areacode'=>$area,'modified'=>$editdate,'modifiedId'=>$userId));

	}
	public function addinforPostAction()
	{
		$request = pzk_request();
		$username=$request->getUsername();
		$email=$request->getEmail();
		$user=_db()->getEntity('User.Account.User');
		$testUser=$user->loadWhere(array('username',$username));
		if($testUser->getId()) {
				//$error = "Tên đăng nhập đã tồn tại. Bạn vui lòng chọn tên đăng nhập khác";
			echo 0;
		}else{
				
			$testEmail= $user->loadWhere(array('email',$email));
			if($testEmail->getId()) {
				//$error= "Email đã tồn tại trên hệ thống";
					//$error = "Email đã tồn tại trên hệ thống. Bạn vui lòng chọn email khác";
				echo -1;
			}else{
			
				$sex=$request->getSex();
				$password=trim($request->getPassword());
				$password=md5($password);
				$birthday=$request->getBirthday();
				$phone=$request->getPhone();
				$address=$request->getAddress();
				$school=$request->getSchool();
				$class1=$request->getClass1();
				$areacode=$request->getAreacode();
				$editdate = date("Y-m-d H:i:s"); 
				$userId= pzk_session('userId');
				
				$user->loadWhere(array('id',$userId));
				$user->update(array('username' => $username,'areacode' => $areacode,'birthday' => $birthday,'address' => $address,'phone' => $phone,'sex' => $sex,'password' => $password,'email' => $email,'school' => $school,'class1' => $class1,'modified'=>$editdate,'modifiedId'=>$userId));
				pzk_session('username',$username);
				//$message="Cập nhật thành công";
				echo 1;
			}
		}
		
	}
	public function	googlePostAction()
	{
		$request = pzk_request();
		$username=$request->getUsername();
		$user=_db()->getEntity('User.Account.User');
		$testUser=$user->loadWhere(array('username',$username));
		if($testUser->getId()) {
			echo 0;
				//$error = "Tên đăng nhập đã tồn tại. Bạn vui lòng chọn tên đăng nhập khác";
		}else{

				$sex=$request->getSex();
				$password=trim($request->getPassword());
				$password=md5($password);
				$birthday=$request->getBirthday();
				$phone=$request->getPhone();
				$address=$request->getAddress();
				$school=$request->getSchool();
				$class1=$request->getClass1();
				$areacode=$request->getAreacode();
				$editdate = date("Y-m-d H:i:s"); 
				$userId= pzk_session('userId');
				
				$user->loadWhere(array('id',$userId));
				$user->update(array('username' => $username,'areacode' => $areacode,'birthday' => $birthday,'address' => $address,'phone' => $phone,'sex' => $sex,'password' => $password,'school' => $school,'class1' => $class1,'modified'=>$editdate,'modifiedId'=>$userId));
				pzk_session('username',$username);
				//$message="Cập nhật thành công";
				echo 1;
			
		}
		
	}
	public function changePasswordAction()
	{
		$scriptable=false;
		$this->initPage();
		$this->append('user/profile/changePassword');
		$this->display();
	}
	public function editpassPostAction()
	{	
		$request = pzk_request();
		$oldpass=md5($request->getOldpass());
		$newpass=$request->getNewpass();
		$username= pzk_session('username');
		$user=_db()->getEntity('User.Account.User');
		$user->loadWhere(array('and',array('username',$username),array('password',$oldpass)));
		if($user->getId())
		{
			$confpass= md5($oldpass.$newpass);
			$email=$user->getEmail();			
			// Update Key
			$user->update(array('key' => $confpass));
			$this->sendMailEditPass($email,$confpass,$newpass);	
			echo 1;		
		}	
		else
		{
			//$error='Mật khẩu cũ chưa chính xác';
			echo 0;
		}
	}
	public function sendMailEditPass($email="",$key="",$newpassword="")
	{
		//tạo URL gửi email xác nhận đăng ký
		$mailtemplate = pzk_parse(pzk_app()->getPageUri('user/mailtemplate/changePassword'));
		//$url= "http://".$_SERVER["SERVER_NAME"].'/Profile/confirmchangePassword';
		$url= 'Profile/confPass';
		$newpassword=md5($newpassword);
		$arr=array('changePassword'=>$key,'conf'=>$newpassword);
		$request=pzk_request();
		$url= $request->build($url,$arr);
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
	public function showchangePasswordAcction()
	{
			$this->render('user/profile/showchangePassword');
	}
	public function confPassAction()
	{
		$request=pzk_request();
		$confirm=$request->getChangePassword();
		$newpassword=$request->getConf();
		$username=pzk_session('username');
		$userId= pzk_session('userId');
		$editdate = date("Y-m-d H:i:s"); 
		$user=_db()->getEntity('User.Account.User');
		$user->loadWhere(array(array('key', $confirm),array('username',$username))); 
		if($user->getId())
		{	
			$success = pzk_parse(pzk_app()->getPageUri('user/profile/changePasswordsuccess'));
			$success->setUsername("ok");		
			$user->update(array('password' => $newpassword,'key'=>'','modified'=>$editdate,'modifiedId'=>$user->getId()));
			
			$this->initPage();
			$this->append($success);
			$this->display();
		}
		else
		{
			$success = pzk_parse(pzk_app()->getPageUri('user/profile/changePasswordsuccess'));
			$success->setUsername("");
			$this->initPage();
			$this->append($success);
			$this->display();
		}
	}
	public function successAction()
	{
			$this->render('user/profile/changePasswordsuccess');
	}
	public function editsignAction()
	{
			$username=pzk_session('username');
			$user=_db()->getEntity('User.Account.User');
			$user->loadWhere(array('username',$username));
			//$items=_db()->useCB()->select('user.*')->from('user')->where(array('username',$username))->result_one();
			$sign=$user->getSign();
			$editsign = pzk_parse(pzk_app()->getPageUri('user/profile/editsign'));
			$editsign->setSign($sign);
			$this->initPage();
			$this->append($editsign);
			$this->display();
	}
	public function editsignPostAction()
	{
			$username=pzk_session('username');
			$request = pzk_request();				
			$newsign=$request->getNewsign();
			$editdate = date("Y-m-d H:i:s"); 
			$userId= pzk_session('userId');
			$user=_db()->getEntity('User.Account.User');
			$user->loadWhere(array('username',$username));
			$user->update(array('sign'=>$newsign,'modified'=>$editdate,'modifiedId'=>$userId));
			//_db()->useCB()->update('user')->set(array('sign'=>$newsign,'modified'=>$editdate,'modifiedId'=>$userId))->where(array('username',$username))->result();
			$user->loadWhere(array('username',$username));
			$sign=$user->getSign();
			$editsign = pzk_parse(pzk_app()->getPageUri('user/profile/editsign'));
			$editsign->setSign($sign);
			$message="Bạn đã thay đổi chữ ký thành công";
			pzk_notifier_add_message($message, 'success');
			$this->initPage();
			$this->append($editsign);
			$this->display();
	}
	// Function hiển thị thông tin cá nhân của user

	public function editavatarAction()
	{
		$scriptable=false;
		$this->layout();
		$this->append('user/profile/editavatar','left');
		$this->display();
	}
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
	$image_scale	= min($max_size/$image_width, $max_size/$image_height);
	$new_width		= ceil($image_scale * $image_width);
	$new_height		= ceil($image_scale * $image_height);
	
	$new_canvas		= imagecreatetruecolor( $new_width, $new_height ); //Create a new true color image
	
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
		$s_size 	= $image_width - ($x_offset * 2);
	}else{
		$x_offset = 0;
		$y_offset = ($image_height - $image_width) / 2;
		$s_size = $image_height - ($y_offset * 2);
	}
	$new_canvas	= imagecreatetruecolor( $square_size, $square_size); //Create a new true color image
	
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
public function postAvatarAction(){
	$max_image_size 		= 120; //Maximum image size (height and width
	$jpeg_quality 			= 90; 
	$image_name = $_FILES['fileToUpload']['name']; //file name
	$image_size = $_FILES['fileToUpload']['size']; //file size
	$image_temp = $_FILES['fileToUpload']['tmp_name'];
	$error="";
	$destination_folder= BASE_DIR."/uploads/avatar/";
	$target_dir =BASE_DIR."/uploads/avatar/";
	$basename= basename($_FILES["fileToUpload"]["name"]);
	$target_file = $target_dir .$basename;
	$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
	$size =$_FILES["fileToUpload"]["size"];	
	if($size < 500000){
		if($imageFileType == "jpg" || $imageFileType == "png" || $imageFileType == "jpeg"|| $imageFileType == "gif"|| $imageFileType == "JPG" || $imageFileType == "PNG" || $imageFileType == "JPEG" || $imageFileType == "GIF"){
			$image_size_info 	= getimagesize($image_temp);
			if($image_size_info){
				$image_width 		= $image_size_info[0]; //image width
				$image_height 		= $image_size_info[1]; //image height
				$image_type 		= $image_size_info['mime']; //image type
			}else{
					$error="File ảnh không đúng quy định";
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
				$new_file_name =pzk_session('userId').'.'. $imageFileType;
				$image_save_folder 	= $target_dir . $new_file_name;
				$this->normal_resize_image($image_res, $image_save_folder, $image_type, $max_image_size, $image_width, $image_height, $jpeg_quality);
				imagedestroy($image_res); //freeup memory
				$username= pzk_session('username');
				$userId= pzk_session('userId');
				$editdate=date("Y-m-d H:i:s");
				$avatar=BASE_URL.'/uploads/avatar/'.$new_file_name;
				$user=_db()->getEntity('User.Account.User');
				$user->loadWhere(array('username',$username));
				$user->update(array('avatar'=>$avatar,'modified'=>$editdate,'modifiedId'=>$userId));
				// insert table user_communication

				$str = str_replace( array('-', ':',' ') , '', $editdate );
				$str=$userId.$str;
				$ett_comm= _db()->getEntity('communication.social');
				$ett_comm->editAvatar($userId);
				$ett_comm->create($userId,$str,0,$editdate,'avatar',0,0);
				echo 1;
			}
		}else{
			//$error="Bạn chỉ được phép upload file ảnh JPG, JPEG, PNG, GIF";
			echo "Bạn chỉ được phép upload file ảnh JPG, JPEG, PNG, GIF";
		}

	}else{
		//$error="Dung lượng của file ảnh quá lớn, bạn hãy chọn file ảnh có kích thước < 488kb ";
		echo "Dung lượng của file ảnh quá lớn, bạn hãy chọn file ảnh có kích thước < 488kb ";
	}
	
}
}
 ?>