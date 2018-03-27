<?php 
class PzkEntityEducationQuestionModel extends PzkEntityModel
{
	public $table = 'questions';
	public $_answers = null;
	
	public function setAnswers($answers) {
		$this->_answers = $answers;
	}
	
	public function getAnswers() {
		return $this->_answers;
	}
	
	public function getChoiceAnswers() {
	}
	
	public function isTn() {
		return $this->get('questionType') == 1;
	}
	
	public function isTl() {
		return $this->get('questionType') == 4;
	}
	
	public function isAuto() {
		return $this->get('auto') == 1;
	}
	
	public function getTnQuestion() {
		return $this;
	}
	
	public function mark($userAnswer) {
		if($userAnswer->get('answerId') == $this->getAnswerId()) {
			return 1;
		} else {
			return 0;
		}
		return $userAnswer->get('mark');
	}
	
	public function getAnswerId() {
		$answer = _db()->selectAll()->fromAnswers_question_tn()->whereQuestion_id($this->get('id'))->whereStatus(1)->result_one();
		if($answer) {
			return $answer['id'];
		}
		return null;
	}
	
	public function getAutoTlQuestion() {
		return _db()->selectAll()->fromQuestions()->whereId($this->get('id'))->result_one('Education.Question.Tuluan.Auto');
	}
	
	public function getTlQuestion() {
		return _db()->selectAll()->fromQuestions()->whereId($this->get('id'))->result_one('Education.Question.Tuluan');
	}
	
	
}