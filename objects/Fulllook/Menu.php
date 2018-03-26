<?php
class PzkFulllookMenu extends PzkObject
{
	public $scriptable = true;
	public function getTest($class)
	{
		$test=_db()->useCache(1800)->useCacheKey('tests-class-'.$class)->select("*")->from("tests")->where( array('like','classes','%,'.$class.',%'))->whereStatus(1)->wherePractice(0)->where(array("or", array('displayAtSite', '0'), array('displayAtSite', pzk_request('siteId'))))->orderBy('ordering desc')->limit(9)->result();
		return($test);
	}
	public function getPractice($class)
	{
		$practice=_db()->useCache(1800)->useCacheKey('practice-class-'.$class)->select("*")->from("tests")->where( array('like','classes','%,'.$class.',%'))->whereStatus(1)->wherePractice(1)->where(array("or", array('displayAtSite', '0'), array('displayAtSite', pzk_request('siteId'))))->orderBy('ordering desc')->limit(9)->result();
		return($practice);
	}
	
	function getWeekTest($subjectId){
		return _db()->useCache(1800)->select('*')
			->useCacheKey('categories-parent-' . $subjectId. '-practice-0-page-1')
			->fromCategories()
			->whereParent($subjectId)
			->whereDisplay(1)
			->wherePractice(0)			
			->orderBy('ordering asc')
			->limit(10, 0)->result();
	}
	function getWeekTestByClass($subjectId, $class){
		return _db()->select('*')
			->fromCategories()
			->whereParent($subjectId)
			->where( array('like','classes','%,'.$class.',%'))
			->whereDisplay(1)
			->wherePractice(0)			
			->orderBy('ordering asc')
			->limit(10, 0)->result();
	}
	function getWeekTest2($subjectId, $class){
		return _db()->useCache(1800)
			->useCacheKey('categories-parent-' . $subjectId. '-practice-0-page-2')
			->select('*')
			->fromCategories()
			->whereParent($subjectId)
			->whereDisplay(1)
			->wherePractice(0)			
			->orderBy('ordering asc')
			->limit(10, 1)->result();
	}
	function getWeekTestByClass2($subjectId, $class){
		return _db()
			->select('*')
			->fromCategories()
			->whereParent($subjectId)
			->where( array('like','classes','%,'.$class.',%'))
			->whereDisplay(1)
			->wherePractice(0)			
			->orderBy('ordering asc')
			->limit(10, 1)->result();
	}
	function getWeekPractice($subjectId){
		return _db()->useCache(1800)->select('*')
			->useCacheKey('categories-parent-' . $subjectId. '-practice-1-page-1')
			->fromCategories()
			->whereParent($subjectId)
			->whereDisplay(1)
			->wherePractice(1)			
			->orderBy('ordering asc')
			->limit(10, 0)->result();
	}
	function getWeekPracticeByClass($subjectId, $class){
		return _db()->select('*')
			->fromCategories()
			->whereParent($subjectId)
			->where( array('like','classes','%,'.$class.',%'))
			->whereDisplay(1)
			->wherePractice(1)			
			->orderBy('ordering asc')
			->limit(10, 0)->result();
	}
	function getWeekPractice2($subjectId){
		return _db()->useCache(1800)->select('*')
			->useCacheKey('categories-parent-' . $subjectId. '-practice-1-page-2')
			->fromCategories()
			->whereParent($subjectId)
			->whereDisplay(1)
			->wherePractice(1)			
			->orderBy('ordering asc')
			->limit(10, 1)->result();
	}
	function getWeekPracticeByClass2($subjectId, $class){
		return _db()->select('*')
			->fromCategories()
			->whereParent($subjectId)
			->where( array('like','classes','%,'.$class.',%'))
			->whereDisplay(1)
			->wherePractice(1)			
			->orderBy('ordering asc')
			->limit(10, 1)->result();
	}
	public function getSubject()
	{
		$subject=_db()->useCache(1800)->useCacheKey('list-category-parent-47')->selectAll()->fromCategories()->whereStatus('1')->whereDisplay('1')->whereParent('47')->orderBy('ordering asc')->result();
		return($subject);
	}
	public function getSubjectByClass($class)
	{
		$subject=_db()->selectAll()->fromCategories()->whereStatus('1')->where( array('like','classes','%,'.$class.',%'))->whereDisplay('1')->whereParent('47')->orderBy('ordering asc')->result();
		
		return($subject);
	}
	public function getSubjectSN($class)
	{
		$subject=_db()->useCache(1800)->useCacheKey('list-category-parent-47-class-' . $class)->selectAll()->fromCategories()->likeClasses('%,'.$class.',%')->whereStatus('1')->whereDisplay('1')->whereParent('47')->orderBy('ordering asc')->result();
		return($subject);
	}
	public function hash() {
		return md5(pzk_user()->checkPayment('full'). parent::hash());
	}
	
	public function getFirstTestByWeek($weekId=0, $practice, $check= 0, $class){
	
		$listTest = _db()->useCache(1800)->useCacheKey('getFirstTestByWeek_' . $weekId . '_' . $practice . '_' . $check . '_' . $class)->select('*')->fromTests();
		
		$listTest->whereStatus(1);
		if($class)
			$listTest->likeClasses("%,$class,%");
		if($weekId)
			$listTest->likeCategoryIds("%,$weekId,%");
		$listTest->wherePractice($practice);
		$listTest->where(array("or", array('displayAtSite', '0'), array('displayAtSite', pzk_request('siteId'))));
        
        $listTest->orderBy('ordering asc');
		$listTest->limit(1);
        if(isset($check ) && ($check == 1)){
			return $listTest->result_one();
		}else{
			return $listTest->whereTrial(1)->result_one();
		}
	}
	public function getTestByMonth($class){
		$query = _db()->select('*')->from('tests')->where('classes like \'%,'.$class.',%\'')->where('compability=1')->where('status=1')->where('parent=0')->limit(10)->orderBy('ordering desc');
		
		$data = $query->result();
		
		
		return $data;
	}
	
	public function getMonthTest($class, $classroomIds){
	
		$query = _db()->select('t.*')
			->from('tests t')
			->join('education_classroom_homework h', 't.id = h.homeworkId')
			->where('h.classroomId in ('. implode(',', $classroomIds).')')
			->where('classes like \'%,'.$class.',%\'')
			->where('compability=1')
			->where('t.status=1')
			->where('t.parent=0')
			->orderBy('ordering desc');
		
		$data = $query->result();
		
		return $data;
	}
	
	public function getTestsOfWeek($class, $weekId, $practice, $check= 0) {
		$listTest = _db()->useCache(1800)->useCacheKey('getTestsOfWeek_' . $weekId . '_' . $practice . '_' . $check . '_' . $class)->select('*')->fromTests();
		
		$listTest->whereStatus(1);
		if($class)
			$listTest->likeClasses("%,$class,%");
		if($weekId)
			$listTest->likeCategoryIds("%,$weekId,%");
		$listTest->wherePractice($practice);
		$listTest->where(array("or", array('displayAtSite', '0'), array('displayAtSite', pzk_request('siteId'))));
        
        $listTest->orderBy('ordering asc');
		return $listTest->result();
	}
}

?>