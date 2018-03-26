<?php 

/**
* 
*/
class PzkUserUser extends PzkObject
{
	public function loadData()
	{
			
			$username = pzk_session('username');
			$ip= getRealIPAddress();
			pzk_session('userIp',$ip);
			$user=_db()->getEntity('User.User');
			$user->loadWhere(array('username',$username));
			if(pzk_request('app')=='ptnn'){
				$wallets= $user->getWallets();
				$this->set('amount', $wallets->get('amount'));
			}
			$this->set('name', $user->get('name'));
			
	}
	
}
 ?>