<?php 

/**
* 
*/
class PzkUserAccountDialog extends PzkObject{
	
	public $scriptable = true;
	public $layout = "user/account/dialog";
	public $cacheable = true;
	public function hash() {
	    return 'userAccountDialog' . pzk_session()->getLogin();
	}
}