<?php 

/**
 * @author Admin
 *
 * Mar 25, 2015
 * 
 * Object Question Test 
 *
 */
class PzkEducationQuestionTest extends PzkObject{
	public $table = 'tests';

	function getWeekTest($subjectId, $practice, $check = 0){
		$query = _db()->useCache(1800)->select('*')
			->fromCategories()
			->whereParent($subjectId)
			->whereDisplay(1)
			->wherePractice($practice)			
			->orderBy('ordering asc');
		$class= pzk_session()->getLop();
		if($class)
			$query->likeClasses("%,$class,%");
		if(isset($check ) && ($check == 1)){
			return $query->result();
		}else{
			return $query->whereTrial(1)->result();
		}
	}
	function getWeekTestSN($subjectId, $practice, $check = 0, $class){
		$query = _db()->useCache(1800)->select('*')
			->fromCategories()
			->whereParent($subjectId)
			->whereDisplay(1)
			->wherePractice($practice)		
			->orderBy('ordering asc');
			
		$class= pzk_session()->getLop();
		if($class){
			$query->likeClasses("%,$class,%");
		}
		
		return $query->result();
			
	}
	function getWeekName($subjectId, $practice, $check = 0){
		$query = _db()->useCache(1800)->select('*')
			->fromCategories()
			->whereId($subjectId)
			->whereDisplay(1)
			->wherePractice($practice)			
			->orderBy('ordering asc');
			
		if(isset($check ) && ($check == 1)){
			return $query->result_one();
		}else{
			return $query->whereTrial(1)->result_one();
		}
	}
	function getWeekNameSN($subjectId, $practice, $check = 0, $class){
		$query = _db()->useCache(1800)->select('*')
			->fromCategories()
			->whereId($subjectId)
			->whereDisplay(1)
			->wherePractice($practice)	
			->likeClasses("%,$class,%")
			->orderBy('ordering asc');
			
		if(isset($check ) && ($check == 1)){
			return $query->result_one();
		}else{
			return $query->whereTrial(1)->result_one();
		}
	}

	public function getTestSN($weekId=0, $practice, $check= 0, $class){
	
		$listTest = _db()->useCache(1800)->select('*')->from($this->table);
		
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
	
	public function getFirstTestByWeek($weekId=0, $practice, $check= 0, $class){
	
		$listTest = _db()->useCache(1800)->useCacheKey('getFirstTestByWeek_' . $weekId . '_' . $practice . '_' . $check . '_' . $class)->select('*')->from($this->table);
		
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
	
	public function getTest(){
		
		$check = pzk_session()->getCheckPayment();
		
		$listTest = _db()->useCache(1800)->select('*')->from($this->table);
		
        if(!$check){
        	
            $listTest->where('trial = 1');
        }
		$class = $this->getClass();
		$listTest->where('status = 1');
		if($class)
			$listTest->likeClasses("%,$class,%");
		$listTest->where('trytest = 0');
		$listTest->wherePractice('0');
		$listTest->where(array("or", array('displayAtSite', '0'), array('displayAtSite', pzk_request()->getSiteId())));
        $listTest->orderBy('ordering asc');
		return $listTest->result();
	}
	public function getPractice(){
		$class = $this->getClass();
		$check = pzk_session()->getCheckPayment();
		
		$listTest = _db()->useCache(1800)->select('*')->from($this->table);
		
        if(empty($check)){
        	
            $listTest->where('trial = 1');
        }
        
		if($class)
			$listTest->likeClasses("%,$class,%");		
		$listTest->where('practice = 1');
		$listTest->where('status = 1');
		$listTest->where(array("or", array('displayAtSite', '0'), array('displayAtSite', pzk_request()->getSiteId())));
        $listTest->orderBy('ordering asc');
        
		return $listTest->result();
	}
	
	public function getTrytest($trytest, $camp){
		$test = _db()->useCache(1800)->select('*')
			->from($this->table)
			->whereTrytest($trytest)
			->whereCamp($camp);
			
		return $test->result_one();
	}
	
	public function getTestTl(){
		$test = _db()->useCache(1800)->select('*')
			->from($this->table)
			->whereTrytest(2)
			->whereStatus(1);
			
		return $test->result();
	}
	
	public function getQuestionByTrytest($trytest, $camp) {
		$test = $this->getTrytest($trytest, $camp);
		if(!$test) {
			return array();
		}
		$testId = $test['id'];
		$question = _db()->useCache(1800)->select('*')
			->from('questions')
			->likeTestId("%,$testId,%")
			->where('status = 1')
			->result();
			
		return $question;
	}
	public function getQuestionByTrytestId($trytestId) {
		$question = _db()->useCache(1800)->select('*')
			->from('questions')
			->likeTestId("%,$trytestId,%")
			->where('status = 1')
			->result();
			
		return $question;
	}
	
}
 ?>