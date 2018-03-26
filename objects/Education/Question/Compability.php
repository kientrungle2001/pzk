<?php 

/**
 * @author Admin
 *
 * Mar 25, 2015
 * 
 * Object Question Test 
 *
 */
class PzkEducationQuestionCompability extends PzkObject{
	public $table = 'tests';

	
	
	public function getChildCompability($testtype, $parentId){
		$test = _db()->useCache(1800)->select('*')
			->from($this->table)
			->whereTrytest($testtype)
			->whereParent($parentId);
			
		return $test->result_one();
	}
	
	public function getTestTl(){
		$test = _db()->useCache(1800)->select('*')
			->from($this->table)
			->whereTrytest(2)
			->whereStatus(1);
			
		return $test->result();
	}
	
	public function getQuestionCompability($testtype, $parentId) {
		$test = $this->getChildCompability($testtype, $parentId);
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
	public function getOtherTest() {
		$tests = _db()->select('*')
			->from('tests')
			->where('compability = 1')
			->where('parent = 0')
			->where('status = 1')
			->result();
			
		return $tests;
	}
	public function getTestById($id){
		$tests = _db()->select('*')
			->from('tests')
			->whereId($id)
			->result_one();
			
		return $tests;
	}
}
 ?>