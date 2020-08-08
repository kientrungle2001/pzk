<?php 
pzk_import('Core.Db.List');

class PzkEducationTestList extends PzkCoreDbList{
	
	public function hash() {
		return md5(pzk_session()->getLogin().pzk_user()->checkPayment('full'). parent::hash());
	}
	public $table ='categories';
	public $cacheable ='true';
	public $cacheParams ='layout, table,position';
	public $orderBy = 'categories.ordering asc';
	
	public function getPractice($class){
		$data = _db()->selectAll()->fromCategories()->likeClasses('%,'.$class.',%')->wherePractice('1')->whereDisplay('1')->whereParent(ROOT_WEEK_CATEGORY_ID)->limit('18')->orderBy('ordering asc')->result();
		return $data;
	} 
	public function getTest($class){
		$data = _db()->selectAll()->fromCategories()->likeClasses('%,'.$class.',%')->wherePractice('0')->whereDisplay('1')->whereParent(ROOT_WEEK_CATEGORY_ID)->limit('18')->orderBy('ordering asc')->result();
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
		$listTest->where(array("or", array('displayAtSite', '0'), array('displayAtSite', pzk_request()->getSiteId())));
        
        $listTest->orderBy('ordering asc');
		return $listTest->result();
		
	}
	public function getTestCompability($class, $school=false){
		$query = _db()->select('*')->from('tests')->where('classes like \'%,'.$class.',%\'')->where('compability=1')->where('status=1')->where('parent=0')->orderBy('ordering desc');
		if($school){
			$data = $query->result();
		}else{
			if(pzk_user_ns()){
				$data = $query->result();
			}else{
				$data = $query->whereSchool(0)->result();
			}
			
		}
		
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
	
	public function getSubject($class){
		$data = _db()->selectAll()->fromCategories()->likeClasses('%,'.$class.',%')->whereStatus('1')->whereDisplay('1')->orderBy('ordering asc')->whereParent('47')->result();
		return $data;
	}
	
	public function getFirstTestByWeek($weekId=0, $practice, $check= 0, $class){
	
		$listTest = _db()->useCache(1800)->useCacheKey('getFirstTestByWeek_' . $weekId . '_' . $practice . '_' . $check . '_' . $class)->select('*')->fromTests();
		
		$listTest->whereStatus(1);
		if($class)
			$listTest->likeClasses("%,$class,%");
		if($weekId)
			$listTest->likeCategoryIds("%,$weekId,%");
		$listTest->wherePractice($practice);
		$listTest->where(array("or", array('displayAtSite', '0'), array('displayAtSite', pzk_request()->getSiteId())));
        
        $listTest->orderBy('ordering asc');
		$listTest->limit(1);
        if(isset($check ) && ($check == 1)){
			return $listTest->result_one();
		}else{
			return $listTest->whereTrial(1)->result_one();
		}
	}
	
	public function getTestByWeek($weekId=0, $practice, $check= 0, $class){
	
		//$listTest = _db()->useCache(1800)->useCacheKey('getFirstTestByWeek_' . $weekId . '_' . $practice . '_' . $check . '_' . $class)->select('*')->fromTests();
		
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
        /*if(isset($check ) && ($check == 1)){
			return $listTest->result();
		}else{
			return $listTest->whereTrial(1)->result();
		}*/
	}
	
	public function getAllTestCompability(){
		 $data = _db()->select('*')->from('tests')->where('compability=1')->where('status=1')->where('parent=0')->orderBy('ordering asc')->result();
		 return $data;
	}
	public function getAllExtraTest(){
		 $data = _db()->select('*')->from('tests')->where('compability=1')
		 ->whereExtraCompability(1)->where('status=1')->where('parent=0')
		 ->orderBy('ordering asc')->result();
		 return $data;
	}
	
	public function getTestCompabilityBySchool($class, $school){
		$query = _db()->select('*')->from('tests')->where('classes like \'%,'.$class.',%\'')->where('compability=1')->where('status=1')->whereSchool($school)->where('parent=0')->orderBy('ordering desc');
		
		$data = $query->result();
		
		return $data;
	}
}
?>