<?php 
class PzkInvitationController extends PzkFrontendController 
{
	public $masterPage='index';
	public $masterPosition='left';
	public function listinvitationAction()
	{
		$this->layout();		
		$this->append('user/profile/profileuser', 'right');
		$this->append('user/profile/profileuserleft1')->append('communication/invitation/listinvitation');
		$this->page->display();
	
	}
	public function invitationAction()
	{
		$this->layout();		
		$this->append('user/profile/profileuser', 'right');
		$this->append('user/profile/profileuserleft1')->append('communication/invitation/invitation');
		$this->page->display();
	
	}
	public function agreeAction()
	{
		$usersendinvi = trim(pzk_request()->getUserinvitation());
		$invitation = _db()->getEntity('communication.invitation');
		$invitation->loadWhere(array('and',array('userinvitation',pzk_session()->getUsername()),array('username',$usersendinvi)));
		pzk_user()->acceptInvitation($invitation);
		$this->redirect('listinvitation');
	}
	public function denyAction()
	{
		$usersendinvi = pzk_request()->getUserinvitation();
		$invitation=_db()->getEntity('communication.invitation');
		$invitation->loadWhere(array('and',array('userinvitation',pzk_session()->getUsername()),array('username',$usersendinvi)));
		pzk_user()->denyInvitation($invitation);
		$this->redirect('listinvitation');
	
	}

}
 ?>