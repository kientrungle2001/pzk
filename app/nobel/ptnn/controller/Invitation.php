<?php 
class PzkInvitationController extends PzkFrontendController 
{
	public $masterPage='index';
	public $masterPosition='left';
	public function listAction()
	{
		$this->layout();		
		$this->append('user/profile/profileuser')->append('communication/invitation/listinvitation');
		$this->page->display();
	
	}
	public function invitationAction()
	{
		$this->layout();		
		$this->append('user/profile/profileuser1')->append('communication/invitation/invitation');
		$this->page->display();
	
	}
	public function agreeAction()
	{
		$usersendinvi = trim(pzk_request()->getMember());
		$invi = _db()->getEntity('communication.invitation');
		$invi->loadWhere(array('and',array('userId',pzk_session()->getUserId()),array('userinvitation',$usersendinvi)));
		pzk_user()->acceptInvitation($invi);
		$this->redirect('list');
	}
	
	public function denyAction()
	{
		$usersendinvi = pzk_request()->getMember();
		$invitation=_db()->getEntity('communication.invitation');
		$invitation->loadWhere(array('and',array('userId',pzk_session()->getUserId()),array('userinvitation',$usersendinvi)));
		pzk_user()->denyInvitation($invitation);
		$this->redirect('list');
	}
	public function agree1Action()
	{
		$userInvi = trim(pzk_request()->getMember());
		$invi = _db()->getEntity('communication.invitation');
		$invi->loadWhere(array('and',array('userId',pzk_session()->getUserId()),array('userinvitation',$userInvi)));
		pzk_user()->acceptInvitation($invi);
	}
	public function deny1Action()
	{
		$usersendinvi = pzk_request()->getMember();
		$invitation=_db()->getEntity('communication.invitation');
		$invitation->loadWhere(array('and',array('userId',pzk_session()->getUserId()),array('userinvitation',$usersendinvi)));
		pzk_user()->denyInvitation($invitation);
	}
}
 ?>