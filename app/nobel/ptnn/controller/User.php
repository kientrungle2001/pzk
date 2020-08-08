<?php
class PzkUserController extends PzkFrontendController {
	public $masterPage='index';
	public $masterPosition='left';


	public function getLink($url,$params=array(),$use_existing_arguments=false)
		{
    		if($use_existing_arguments) $params = $params + $_GET;
    		if(!$params) return $url;
    		$link = $url;
    		if(strpos($link,'?') === false) $link .= '?'; //If there is no '?' add one at the end
    		elseif(!preg_match('/(\?|\&(amp;)?)$/',$link)) $link .= '&amp;'; //If there is no '&' at the END, add one.
    
   			 $params_arr = array();
    		foreach($params as $key=>$value) 
    		{
	        	if(gettype($value) == 'array') { //Handle array data properly
	            	foreach($value as $val)
	            	{
	                	$params_arr[] = $key . '[]=' . urlencode($val);
	            	}
	        	}
	        	else 
	        	{
	            	$params_arr[] = $key . '=' . urlencode($value);
	        	}
    		}
    		$link .= implode('&amp;',$params_arr);
    
    		return $link;
		} 
	// Gửi email kích hoạt tài khoản
	public function sendMail($username="",$password="",$email="") {
		$mailtemplate = pzk_parse(pzk_app()->getPageUri('user/mailtemplate/register'));
		$mailtemplate->setUsername($username);
		//tạo URL gửi email xác nhận đăng ký
		$url= "http://".$_SERVER["SERVER_NAME"].'/User/activeRegister';
		$strConfirm = $password.$email.$username;
		$confirm= md5($strConfirm);
		$user=_db()->getEntity('user.user');
		$user->loadWhere(array('username',$username));
		//var_dump($user->getId());
		$user->update(array('key' => $confirm));
		//_db()->useCB()->update('user')->set(array('key' => $confirm))->where(array('username',$username))->result();
		$arr=array('active'=>$confirm);
		$url= $this->getLink($url,$arr);
		$mailtemplate->setUrl($url);
		$mail = pzk_mailer();
		$mail->AddAddress($email);
		$mail->Subject = 'Confirm new Register';
		$mail->Body    = $mailtemplate->getContent();
		//$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

		if(!$mail->send()) {
			echo 'Message could not be sent.';
			echo 'Mailer Error: ' . $mail->ErrorInfo;
		}
	}
	// Hiển thị tài khoản trên header

	public function userAction()
	{
			$this->layout();
					
			$this->display();
	
	}
	// Đăng ký tài khoản mới

	// Hiển thị thông báo sau khi đăng ký tài khoản
	public function registersuccessAction()
	{
		$this->render('user/registersuccess');
	}

	// Hiển thị thông báo đăng ký thành công sau khi đã kích hoạt tài khoản





	public function invitationAction()
	{
		$this->layout();		
		$this->append('user/profileuser', 'right');
		$this->append('user/profileuserleft1')->append('user/invitation');
		$this->page->display();
	
	}

	public function invitationPostAction()
	{
		
		$txtinvi=pzk_request()->getInvitation();
		$userInvi=pzk_request()->getMember();
		$invitation=_db()->getEntity('communication.invitation');
		$invitation->loadWhere(array('and',array('userId',$userInvi),array('userinvitation',pzk_session()->getUserId())));
		if($invitation->getId())
		{
			echo "fail";
		}
		else
		{
			$rowInvitation=array('userinvitation'=>pzk_session()->getUserId(),'userId'=>$userInvi,'invitation'=>$txtinvi);
			$invitation->setData($rowInvitation);
			$invitation->save();
			echo "ok";
		}	

	}

/*	public function friendlistuserAction()
	{
		$this->layout();		
		$this->append('user/profileuserleft1')->append('user/friendlistuser');
		$this->append('user/profileuser', 'right');
		$this->page->display();
	
	}
*/

	public function friendlistmemberAction()
	{
		$this->layout();		
		$this->append('user/profilefriendright', 'right');
		$this->append('user/friendlistmember', 'left');
		$this->page->display();
	
	}
	public function profileuserleftAction()
	{
		$this->layout();	
		$this->append('user/profileuserleft', 'left');	
		$this->append('user/profileuser', 'right');
		
		$this->page->display();
	
	}





	public function profilefriendAction()
	{
		$this->layout();		
		$this->append('user/profilefriendright', 'right');
		$this->append('user/profilefriend', 'left');
		$this->page->display();
	
	}
	public function profilefriendrightAction()
	{
		$this->layout();		
		$this->append('user/profilefriendright', 'right');
		$this->append('user/profilefriend', 'left');
		$this->page->display();
	
	}




// BEGIN THANH TOÁN MỚI

// END THANH TOÁN MỚI


	public function profileuserleft1Action()
	{
		$this->layout();
		$this->append('user/profileuserleft1');
		//$this->append('user/profileuser','right');
		$this->display();
		//$this->render('user/payment/payment');		
	}
	public function memberAction()
	{
		$this->layout();
		$this->append('user/member/prfleft')->append('user/member/prfcontent');
		//$this->append('user/profileuser','right');
		$this->display();
		//$this->render('user/payment/payment');		
	}
	public function prfleftAction()
	{
		$this->layout();
		$this->append('user/member/prfleft');
		//$this->append('user/profileuser','right');
		$this->display();
		//$this->render('user/payment/payment');		
	}
	public function prfcontentAction()
	{
		$this->layout();
		$this->append('user/member/prfcontent');
		//$this->append('user/profileuser','right');
		$this->display();
		//$this->render('user/payment/payment');		
	}

	public function viewwritewallAction()
	{
		$this->layout();
		$this->append('user/profileuserleft1')->append('user/viewwritewall');
		$this->append('user/profileuser','right');
		$this->display();
		//$this->render('user/payment/payment');		
	}
	public function viewwritewallPageAction()
	{
		$viewwritewallpage=$this->parse('user/viewwritewallpage')	;
		$viewwritewallpage->display();	
	}

	public function lessonfavoriteAction()
	{
		$this->layout();
		$this->append('user/profileuserleft1')->append('user/lessonfavorite');
		$this->append('user/profileuser','right');
		$this->display();
	}
	public function delLessionfavoriteAction(){
	
		$id = pzk_request()->getSegment(3);
		$lessonfavorite=_db()->getEntity('user.lesson_favorite');
		$lessonfavorite->load($id);
		$lessonfavorite->delete();
		$this->redirect('lessonfavorite?member='.pzk_session()->getUserId());
	}
	public function lessonfavoritememberAction()
	{
		$this->layout();
		$this->append('user/profileuserleft1')->append('user/lessonfavoritemember');
		$this->append('user/profileuser','right');
		$this->display();
	}
	public function lessonhistoryAction()
	{
		$this->layout();
		$this->append('user/profileuserleft1')->append('user/lessonhistory');
		$this->append('user/profileuser','right');
		$this->display();
	}
    public function lessonAction()
    {
        $this->layout();
        $this->append('user/lesson');
        $this->append('user/profileuser','right');
        $this->display();
    }
    public function detailLessonAction() {
        $this->layout();
        $this->append('user/detaillesson');
        $this->append('user/profileuser','right');
        $this->display();
    }
}