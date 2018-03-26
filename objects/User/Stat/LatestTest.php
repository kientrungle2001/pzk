<?php 
class PzkUserStatLatestTest extends PzkObject
{
	public function getTest()
	{
		$highest=_db()->useCB()->select("distinct(username),userId")->from("user_book")->join("user","user.id =user_book.userId ")->limit(5)->orderBy('startTime desc')->result();
		
	return($highest);
	}
	
}
 ?>