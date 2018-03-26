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
		if($this->get('testId')) {
			return _db()->getEntity('Education.Test')->load($this->get('testId'), 1800);
		}
		return null;
	}
	public function getTests() {
		
		if($this->_tests !== false) return $this->_tests;
		
		$listTest = _db()->selectAll()->from($this->get('table'));
		
        if($this->get('trial')){
            $listTest->whereTrial('1');
        }
		
		$listTest->whereStatus('1');
		
		$class = $this->get('class');
		if($class) {
			$listTest->likeClasses("%,$class,%");
		}
		
		$listTest->wherePractice($this->get('practice'));
        
		$listTest->orderBy('ordering asc');
		
		return ($this->_tests = $listTest->result('Education.Test'));
	}
}