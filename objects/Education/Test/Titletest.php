<?php
class PzkEducationTestTitletest extends PzkObject {
	public $layout = 'test/titletest';
	public $categoryId=false;
	//$categoryId = $this->getCategoryId();
	
	public function Easy(){
		return _db()->useCB()->select('user_test. *')->from('user_test')->where(array('and',array('level','1'),array('categoryId',$this->getCategoryId())))->result();
	}
	public function Normal(){
		return _db()->useCB()->select('user_test. *')->from('user_test')->where(array('and',array('level','2'),array('categoryId',$this->getCategoryId())))->result();
	}
	public function Difficult(){
		return _db()->useCB()->select('user_test. *')->from('user_test')->where(array('and',array('level','3'),array('categoryId',$this->getCategoryId())))->result();
	}
}