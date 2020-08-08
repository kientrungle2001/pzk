<?php
class PzkGameFamily extends PzkObject
{
	public $questionId;
	
	public $questionType;
	
	public $question;
	
	public $answer = array();
	
	public $type;
	
	public function getQuestion() {
		$data = _db()->select('*')
            ->from('questions')
			->where("type = 'gameQuestion'")
            ->orderBy('rand()');
        return $data->result_one();
	}
	
	public function getNewQuestion($id) {
		$id = mysql_escape_string($id);
		$data = _db()->selectAll()->fromQuestions()->where("id NOT IN ($id)")->whereType('gameQuestion')->orderBy(rand())->limit(1)->result();
        return $data;
	}
	
	function detailQuestion(){
		
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

?>