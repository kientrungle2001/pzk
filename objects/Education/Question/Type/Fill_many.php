<?php 
class PzkEducationQuestionTypeFill_many extends PzkObject{
	
	public $layout ='question/fill_many';
	
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
	
	public function getAnswers() {
		if(isset($this->questionId)){
			$query = _db()->selectAll()
			->from('answers_question_tn')
			->where(array('question_id', $this->questionId));
			$answers = $query->result();
			
			return $answers;
		}
		return null;
	}
}