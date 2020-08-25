<?php 
/**
* 
*/
class PzkEntityEducationCourseModel extends PzkEntityModel
{
	public $table 		= "categories";
	
	public function getTeachers() {
		if(!$this->getTeachers()) return array();
		return json_decode($this->getTeachers(), true);
	}
	
	public function getRelatedCourses() {
		if(!$this->getRelatedCourses()) return array();
		return json_decode($this->getRelatedCourses(), true);
	}
	
	public function getTopics() {
		$topics = _db()->selectAll()->fromCategories()->whereParent($this->getId())->orderBy('ordering asc')->result('Education.Topic');
		return $topics;
	}
	
	public function getEmbedYoutubeUrl() {
		return null;
	}
	
	public function getTrialTestCount() {
		$id = $this->getId();
		$count = _db()->select('count(*) as c')->fromTests()->whereTrial(1)->likeCategoryIds("%,$id,%")->result_one();
		return $count['c'];
	}
	
	public function getTestCount() {
		$id = $this->getId();
		$count = _db()->select('count(*) as c')->fromTests()->likeCategoryIds("%,$id,%")->result_one();
		return $count['c'];
	}
}