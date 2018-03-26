<?php 

/**
* 
*/
class PzkUserAccountLoginsn extends PzkObject{
	
	public $scriptable = true;
	public $layout = "user/account/login";
	public $cacheable = true;
	public function hash() {
	    return 'userAccountLoginsn' . pzk_session('login');
	}
}