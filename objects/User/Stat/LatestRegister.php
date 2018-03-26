<?php 
class PzkUserStatLatestRegister extends PzkObject
{
	public function getRegister()
	{
		$highest=_db()->useCB()->select("distinct(username),id")->from("user")->limit(5)->orderBy('registered desc')->result();
		
	return($highest);
	}
	
}
 ?>