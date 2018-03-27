<?php 
/**
* 
*/
class PzkEntityUserUserModel extends PzkEntityModel
{
	public $table="user";
	public function getWallets()
	{
		$wallets=_db()->getEntity('User.Wallets');
		$wallets->loadWhere(array('username',$this->get('username')));
		return $wallets;
	}
	
	public function addFriend($user) {
		if($user->get('id')) {
			$friend = _db()->getEntity('User.Friend');
			$friend->set('username', $this->get('username'));
			$friend->set('userfriend',$this->get('userfriend'));
			$friend->set('date', date('Y-m-d H:i:s', $_SERVER['REQUEST_TIME']));
			$friend->save();
			
			$friend = _db()->getEntity('User.Friend');
			$friend->set('username', $this->get('userfriend'));
			$friend->set('userfriend', $this->get('username'));
			$friend->set('date', date('Y-m-d H:i:s', $_SERVER['REQUEST_TIME']));
			$friend->save();
		}
		
	}
	
	public function removeFriend($user) {
		if($user->get('id')) {
			$friend = _db()->getEntity('User.Friend');
			$friend->loadWhere(array('and', array('username', $this->get('username')), array('userfriend', $user->get('username'))));
			if($friend->get('id')) {
				$friend->delete();
			}

			$friend = _db()->getEntity('User.Friend');
			$friend->loadWhere(array('and', array('username', $user->get('username')), array('userfriend', $this->get('username'))));
			if($friend->get('id')) {
				$friend->delete();
			}
		}
		
	}
	
	public function inviteFriend($user, $message) {
		if($user->get('id')) {
			$invitation = _db()->getEntity('User.Invitation');
			$invitation->set('username', $this->get('username'));
			$invitation->set('userinvitation', $user->get('username'));
			$invitation->set('invitation', $message);
			$invitation->save();	
		}
	}
	public function acceptInvitation($invitation) {
		$this->addFriend($invitation->getUser());
		$invitation->delete();
	}
	public function denyInvitation($invitation) {
		$invitation->delete();
	}
}
 ?>