<?php 
class PzkUserStatLatestPaid extends PzkObject
{
	public function getPaid()
	{
		$highest=_db()->useCB()->select("distinct(username),userId")->from("history_buyservice")->join("user","user.id =history_buyservice.userId ")->limit(5)->orderBy('dateActive desc')->result();
		
	return($highest);
	}
	
}
 ?>