<?php 
/**
* 
*/
class PzkEntityEducationTopicModel extends PzkEntityModel
{
	public $table 		= "categories";
	
	public function getTests() {
		$tests = _db()->selectAll()->fromTests()->likeCategoryIds('%,'.$this->getId() . ',%')->orderBy('ordering asc')->result('Education.Test');
		return $tests;
	}
}