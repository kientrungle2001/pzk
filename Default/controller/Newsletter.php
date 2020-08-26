<?php
class PzkNewsletterController extends PzkController {
	public $masterPage='index';
	public $masterPosition='left';
	
	public function sendMail($email="") 
		{
			$mailtemplate = $this->parse('cms/newsletter/mailtemplate/subscribe');
			$mail = pzk_mailer();
			$mail->CharSet = "UTF-8";
			$mail->AddAddress($email);
			$mail->Subject = 'Cảm ơn bạn đã đăng ký nhận tin qua Email';
			$mail->Body    = $mailtemplate->getContent();
			//$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

		if(!$mail->send()) {
			echo 'Message could not be sent.';
			echo 'Mailer Error: ' . $mail->ErrorInfo;
		}
	}
	public function subscribeSuccessPostAction()
	{
			$error="";	
			$email=pzk_request()->getEmail();
			$testEmail= _db()->useCB()->select('email')->from('newsletter_subscriber')->where(array('equal','email',$email))->result();
				if($testEmail)
					{
						$error="Email đã tồn tại trên hệ thống";
						pzk_notifier_add_message($error, 'danger');
						$this->initPage()->display();
					} 
					else{
					$dateregister=date("Y-m-d H:i:s");
					$addLesson=array('email'=>$email,'registered'=>$dateregister);
					$entity = _db()->useCb()->getEntity('Table')->setTable('newsletter_subscriber');
					$entity->setData($addLesson);
					$entity->save();
					$this->sendMail($email);
					$this->initPage()->append('cms/newsletter/subscribeSuccess','left')->display();
						
					}
	}
	public function unsubscribeAction(){
			$email = pzk_request()->getEmail();
			$key = pzk_request()->getKey();
			$key2 = md5($email.'nn123456');
			 if($key==$key2)
				{
					$id=_db()->useCB()->select('id')->from('newsletter_subscriber')->where(array('email',$email))->result_one();
					_db()->delete()->from('newsletter_subscriber')->where('id='.$id['id'])->result();
				}
			//$delmail = $data->getDelMail($key,$email);
			$this->initPage();
			$unsubscribe = pzk_parse('<cms.newsletter.unsubscribe css="newsletter" table="newsletter_subscriber" layout="cms/newsletter/unsubscribe" />');
			$this->append($unsubscribe);
			$this->display();
			
		}
	public function clickAction(){
		
		
	}
}
?>