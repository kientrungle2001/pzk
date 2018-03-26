<?php 

/**
* 
*/
class PzkUserAccountRegistersn extends PzkObject{
	public $scriptable = true;
	public $layout = "user/account/register";
	public $cacheable = true;
	public function hash() {
	    return 'userAccountRegistersn' . pzk_session('login');
	}
}