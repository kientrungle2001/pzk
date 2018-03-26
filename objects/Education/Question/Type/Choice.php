<?php 
class PzkEducationQuestionTypeChoice extends PzkObject{
	
	public $layout = 'education/question/choice';
	
	public $questionId;
	
	public $questionType;
	
	public $question;
	
	public $answer = array();
	
	public $type;
	
	/*function getQuestion(){
		
		if(isset($this->questionId)){
			
			$question = _db()->getEntity('Question.Choice');
			$question->load($this->questionId, 1800);
		
			$this->setType($question->getType());
			$this->setQuestion($question);
			
			return $question;
		}
		return null;
	}*/
}