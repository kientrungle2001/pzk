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
		$sql = "SELECT * FROM questions WHERE id NOT IN ($id) AND type = 'gameQuestion' ORDER BY rand() LIMIT 1";
		$data = _db()->query($sql);
        return $data;
	}
	
	function detailQuestion(){
		
		if(isset($this->questionId)){
		
			$query = _db()->select('q.*')
			->from('questions q')
			->where("q.id='$this->questionId'");
			$question = $query->result_one('Question.Choice');
		
			$this->set('type', $question->get('type'));
			$this->set('question', $question);
			
			return $question;
		}
		return null;
	}
}

?>