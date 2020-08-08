<?php 
class PzkEducationTestCompability extends PzkObject{
	
	public function getTests($class, $parent, $pageNum, $pageSize){
		$data = _db()->selectAll()->fromCategories()->likeClasses('%,'.$class.',%')->wherePractice('0')->whereDisplay('1')->whereParent($parent)->limit($pageSize, $pageNum)->orderBy('ordering asc');
		
		return $data->result();
	}
	public function countTests($class, $parent){
		$data = _db()->select('count(*) as total')->fromCategories()->likeClasses('%,'.$class.',%')->wherePractice('0')->whereDisplay('1')->whereParent($parent)->result_one();
		return $data['total'];
	}
	public function getTestByWeek($weekId=0, $practice, $check= 0, $class){
	
		
		$listTest = _db()->select('*')->fromTests();
		$listTest->whereStatus(1);
		if($class)
			$listTest->likeClasses("%,$class,%");
		if($weekId)
			$listTest->likeCategoryIds("%,$weekId,%");
		$listTest->wherePractice($practice);
		$listTest->where(array("or", array('displayAtSite', '0'), array('displayAtSite', pzk_request()->getSiteId())));
        $listTest->limit(2);
        $listTest->orderBy('ordering asc');
		
		return $listTest->result();
        
	}
}
?>	