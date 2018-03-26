<?php
class PzkFulllookMenu extends PzkObject
{
	public $scriptable = true;
	public function getTest($class)
	{
		$test=_db()->useCache(1800)->select("*")->from("tests")->where( array('like','classes','%,'.$class.',%'))->whereStatus(1)->wherePractice(0)->where(array("or", array('displayAtSite', '0'), array('displayAtSite', pzk_request('siteId'))))->orderBy('ordering desc')->limit(9)->result();
		return($test);
	}
	public function getPractice($class)
	{
		$practice=_db()->useCache(1800)->select("*")->from("tests")->where( array('like','classes','%,'.$class.',%'))->whereStatus(1)->wherePractice(1)->where(array("or", array('displayAtSite', '0'), array('displayAtSite', pzk_request('siteId'))))->orderBy('ordering desc')->limit(9)->result();
		return($practice);
	}
	
	function getWeekTest($subjectId){
		return _db()->useCache(1800)->select('*')
			->fromCategories()
			->whereParent($subjectId)
			->whereDisplay(1)
			->wherePractice(0)			
			->orderBy('ordering asc')
			->limit(9)->result();
	}
	function getWeekPractice($subjectId){
		return _db()->useCache(1800)->select('*')
			->fromCategories()
			->whereParent($subjectId)
			->whereDisplay(1)
			->wherePractice(1)			
			->orderBy('ordering asc')
			->limit(9)->result();
	}
	public function getSubject()
	{
		$subject=_db()->selectAll()->fromCategories()->whereStatus('1')->whereDisplay('1')->whereParent('47')->orderBy('ordering asc')->result();
		return($subject);
	}
	public function getSubjectSN($class)
	{
		$subject=_db()->selectAll()->fromCategories()->likeClasses('%,'.$class.',%')->whereStatus('1')->whereDisplay('1')->whereParent('47')->orderBy('ordering asc')->result();
		return($subject);
	}
	public function hash() {
		return md5(pzk_user()->checkPayment('full'). parent::hash());
	}
}

?>