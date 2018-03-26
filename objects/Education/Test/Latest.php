<?php 
class PzkEducationTestLatest extends PzkObject
{
	public function getLatest()
	{
		$highest=_db()->useCB()->select("name,id")->from("tests")->limit(5)->orderBy("id desc")->result();
		return($highest);
	}
}
 ?>