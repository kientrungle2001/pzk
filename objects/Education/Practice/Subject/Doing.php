<?php
pzk_import('Education.Practice.Subject');
class PzkEducationPracticeSubjectDoing extends PzkEducationPracticeSubject {
	public function getQuestions() {
		$class 			=	$this->getClass();
		$topicId		=	$this->getTopicId();
		$exerciseNumber	=	$this->getExerciseNumber();
		$check			=	$this->getCheckPayment();
		
		$query = _db()->useCache(1800)->select('q.*')->from('questions q');
		
		$query->where( array('like','classes','%,'.$class.',%'));
		$query->where( array('like','categoryIds','%,'.$topicId.',%'));
		
		if(!$check)
			$query->where(array('trial', 1));
		
		$query->orderby('ordering asc, id asc');
		$query->limit(5, $exerciseNumber-1);
		
		$query->where(array('status', QUESTION_ENABLE));
		$query->where(array('ne', 'deleted', DELETED));
		
		return $query->result();
	}
	
	public function getTopic(){
		return _db()->selectAll()->fromCategories()->whereId($this->getTopicId())->result_one();
	}
}