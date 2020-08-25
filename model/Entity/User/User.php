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
		$wallets->loadWhere(array('username',$this->getUsername()));
		return $wallets;
	}
	
	public function addFriend($user) {
		if($user->getId()) {
			$friend = _db()->getEntity('User.Friend');
			$friend->setUsername($this->getUsername());
			$friend->set('userfriend',$this->getUserfriend());
			$friend->setDate(date('Y-m-d H:i:s', $_SERVER['REQUEST_TIME']));
			$friend->save();
			
			$friend = _db()->getEntity('User.Friend');
			$friend->setUsername($this->getUserfriend());
			$friend->setUserfriend($this->getUsername());
			$friend->setDate(date('Y-m-d H:i:s', $_SERVER['REQUEST_TIME']));
			$friend->save();
		}
		
	}
	
	public function removeFriend($user) {
		if($user->getId()) {
			$friend = _db()->getEntity('User.Friend');
			$friend->loadWhere(array('and', array('username', $this->getUsername()), array('userfriend', $user->getUsername())));
			if($friend->getId()) {
				$friend->delete();
			}

			$friend = _db()->getEntity('User.Friend');
			$friend->loadWhere(array('and', array('username', $user->getUsername()), array('userfriend', $this->getUsername())));
			if($friend->getId()) {
				$friend->delete();
			}
		}
		
	}
	
	public function inviteFriend($user, $message) {
		if($user->getId()) {
			$invitation = _db()->getEntity('User.Invitation');
			$invitation->setUsername($this->getUsername());
			$invitation->setUserinvitation($user->getUsername());
			$invitation->setInvitation($message);
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