<?php 
/**
* 
*/
class PzkEntityEducationCourseModel extends PzkEntityModel
{
	public $table 		= "categories";
	
	public function getTeachers() {
		if(!$this->get('teachers')) return array();
		return json_decode($this->get('teachers'), true);
	}
	
	public function getRelatedCourses() {
		if(!$this->get('relatedCourses')) return array();
		return json_decode($this->get('relatedCourses'), true);
	}
	
	public function getTopics() {
		$topics = _db()->selectAll()->fromCategories()->whereParent($this->get('id'))->orderBy('ordering asc')->result('Education.Topic');
		return $topics;
	}
	
	public function getEmbedYoutubeUrl() {
		return null;
	}
	
	public function getTrialTestCount() {
		$id = $this->get('id');
		$count = _db()->select('count(*) as c')->fromTests()->whereTrial(1)->likeCategoryIds("%,$id,%")->result_one();
		return $count['c'];
	}
	
	public function getTestCount() {
		$id = $this->get('id');
		$count = _db()->select('count(*) as c')->fromTests()->likeCategoryIds("%,$id,%")->result_one();
		return $count['c'];
	}
}