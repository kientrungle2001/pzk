<?php
class PzkEducationQuestionShowtest extends PzkObject {
	function getWeekTest($subjectId){
		$check = pzk_session()->getCheckPayment();
		$query = _db()->useCache(1800)->select('*')
			->fromCategories()
			->whereParent($subjectId)
			->whereDisplay(1)			
			->orderBy('ordering asc');
		if(isset($check ) && ($check == 1)){
			return $query->result();
		}else{
			return $query->whereTrial(1)->result();
		}
	}
	public function getTest($weekId, $practice){
	
		$listTest = _db()->useCache(1800)->select('*')->from($this->table);
		
		$class = $this->getClass();
		$listTest->whereStatus(1);
		if($class)
			$listTest->likeClasses("%,$class,%");
		if($weekId)
			$listTest->likeCategoryIds("%,$weekId,%");
		$listTest->wherePractice($practice);
        $listTest->orderBy('ordering asc');
		return $listTest->result();
	}
    

}