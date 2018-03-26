<?php 
class PzkEducationQuestionTypeFill_word extends PzkObject{
	
	public $layout ='question/fill_word';
	
	public $questionId;
	
	public $questionType;
	
	public $question;
	
	public $answer = array();
	
	public $type;
	
	function getQuestion() {
	
		if(isset($this->questionId)){
		
			$query = _db()->select('q.*')
			->from('questions q')
			->where("q.id='$this->questionId'");
			$question = $query->result_one('Question.Choice');
		
			$this->setType($question->getType());
			$this->setQuestion($question);
			
			return $question;
		}
		return null;
	}
}