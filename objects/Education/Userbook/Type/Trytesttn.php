<?php 
class PzkEducationUserbookTypeTrytesttn extends PzkObject{
	
	public $layout = 'userbook/trytesttn';
	
	public $questionId;
	
	public $questionType;
	
	public $question;
	
	public $answer = array();
	
	public $type;
	
	public $userBookIdTn;
	
	/*
	function getQuestion(){
		
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
	}*/
	
	/*
	public function getUserAnswer() {
		if(isset($this->questionId)){
		
			$data = _db()->select('*')
			->from('user_answers')
			->where("questionId='$this->questionId'")
			->where(array('user_book_id', $this->userBookIdTn))
			->result_one();
			
			return $data['content'];
		}
	}*/
}