<?php 
/**
* 
*/
class PzkEntityEducationTestModel extends PzkEntityModel
{
	public $table 		= "tests";
	private $_questions 	= null;
	private $_answers_of_all_questions = null;
	public function getQuestions() {
		if(!$this->_questions) {
			$db = _db();
			if(CACHE_MODE) {
				$db->useCache(1800);
			}
			$this->_questions = $db->selectAll()->fromQuestions()->likeTestId('%,'.$this->getId().',%')->limit(100)->result('Education.Question');
		}
		return $this->_questions;
	}
	public function getAnswersOfAllQuestions() {
		if(!$this->_answers_of_all_questions) {
			$questions = $this->getQuestions();
			$questionIds = array();
			foreach($questions as $question) {
				$questionIds[] = $question->getId();
			}
			$db = _db();
			if(CACHE_MODE) {
				$db->useCache(1800);
			}
			$this->_answers_of_all_questions = $db
					->selectAll()->fromAnswers_question_tn()
					->inQuestion_id($questionIds)
					->result('Education.Question.Answer');
		}
		return $this->_answers_of_all_questions;
	}
	public function deliverAnswersToQuestions() {
		
		
		$questions = $this->getQuestions();
		$answers = $this->getAnswersOfAllQuestions();
		
		$answersGroupedByQuestionId = array();
		foreach($answers as $answer) {
			if(!isset($answersGroupedByQuestionId[$answer->getQuestion_id()])) {
				$answersGroupedByQuestionId[$answer->getQuestion_id()] = array();
			}
			$answersGroupedByQuestionId[$answer->getQuestion_id()][] = $answer;
		}
		
		foreach($questions as $question) {
			$question->setAnswers(@$answersGroupedByQuestionId[$question->getId()]);
		}
	}
	public function getAnswersOfQuestion($question) {
		return $question->getAnswers();
	}
	
	public function getUrl($class, $subject) {
		return '/test/class-'.$class.'/week-'.$subject->getId().'/examination-' . $this->getId();
	}
}
 ?>