<?php
class PzkEducationTestFormStart extends PzkObject {
	public $layout 		= 'education/test/form/start';
	public $class 		= false;
	public $practice 	= '0';
	public $trial		= false;
	public $table 		= 'tests';
	public $_tests		= false;
	public $testId		= false;
	public function getTest() {
		if($this->getTestId()) {
			return _db()->getEntity('Education.Test')->load($this->getTestId(), 1800);
		}
		return null;
	}
	public function getTests() {
		
		if($this->_tests !== false) return $this->_tests;
		
		$listTest = _db()->selectAll()->from($this->getTable());
		
        if($this->getTrial()){
            $listTest->whereTrial('1');
        }
		
		$listTest->whereStatus('1');
		
		$class = $this->getClass();
		if($class) {
			$listTest->likeClasses("%,$class,%");
		}
		
		$listTest->wherePractice($this->getPractice());
        
		$listTest->orderBy('ordering asc');
		
		return ($this->_tests = $listTest->result('Education.Test'));
	}
}