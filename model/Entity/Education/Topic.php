<?php 
/**
* 
*/
class PzkEntityEducationTopicModel extends PzkEntityModel
{
	public $table 		= "categories";
	
	public function getTests() {
		$tests = _db()->selectAll()->fromTests()->likeCategoryIds('%,'.$this->get('id') . ',%')->orderBy('ordering asc')->result('Education.Test');
		return $tests;
	}
}