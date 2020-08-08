<?php 
class PzkEducationQuestionTypeFill_many_text extends PzkObject{
	
	public $layout ='question/fill_many_text';
	
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
		
			$this->setType( $question->getType());
			$this->setQuestion( $question);
				
			return $question;
		}
		return null;
	}
	
}