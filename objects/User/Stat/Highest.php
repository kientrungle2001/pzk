<?php 
class PzkUserStatHighest extends PzkObject
{
	public function getHighest()
	{
		$highest=_db()->useCB()->select("distinct(username),id,point")->from("user")->limit(5)->orderBy('point desc')->result();
		return($highest);
	}
	
}
 ?>