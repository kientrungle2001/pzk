<?php 

/**
* 
*/
class PzkUserUser extends PzkObject
{
	public function loadData()
	{
			
			$username = pzk_session()->getUsername();
			$ip= getRealIPAddress();
			pzk_session()->setUserIp($ip);
			$user=_db()->getEntity('User.User');
			$user->loadWhere(array('username',$username));
			if(pzk_request()->getApp()=='ptnn'){
				$wallets= $user->getWallets();
				$this->setAmount( $wallets->getAmount());
			}
			$this->setName( $user->getName());
			
	}
	
}
 ?>