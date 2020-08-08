<?php 
class PzkEducationQuestionTypeChoice_ex extends PzkObject{
	
	public $layout ='question/choice_ex';
	
	public $questionId;
	
	public $questionType;
	
	public $question;
	
	public $answer = array();
	
	public $type;
	
	function getQuestion(){
		
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