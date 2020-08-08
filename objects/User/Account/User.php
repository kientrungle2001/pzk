<?php 

/**
* 
*/
class PzkUserAccountUser extends PzkObject
{
	public $css	 		= 'user';
	public $js 			= 'user';
	public $cacheable 	= false;
	public $layout 		= 'user/account/user';
	
	public function init() {
		$ip = getRealIPAddress();
		pzk_session()->setUserIp( $ip);
		
	}
  	public function hash() {
  		return md5($this->getLayout(). 'usermenu' . pzk_session()->getUsername());
  	}
}
 ?>