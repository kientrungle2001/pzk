<?php 
class PzkCmsFeaturedLatest extends PzkObject
{
	public function getLatest()
	{
		$highest=_db()->useCB()->select("title,id")->from("featured")->limit(5)->orderBy('id desc')->result();
		return($highest);
	}
}
 ?>