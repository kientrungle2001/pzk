<?php 
/**
* 
*/
class PzkEntityCommunicationInvitationModel extends PzkEntityModel
{
	public $table="invitation"; 
	public function getUser() {
		return _db()->getEntity('User.Account.User')->loadWhere(array('username', $this->get('username')));
	}
	public function getInvitationUser() {
		return _db()->getEntity('User.Account.User')->loadWhere(array('username', $this->get('userinvitation')));
	}
	
}
 ?>