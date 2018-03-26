<?php 
class PzkEducationBookTypeChoice extends PzkObject{
	
	public $layout = 'book/choice';
	
	public $id;
	
	public $user_answers_text_id;
	
	public $request;
	
	public $cauhoi;
	
	public $dapan;
	
	public $questionId;
	
	public $question_type;
	
	public $content;
	
	function getQuestion(){
		
		if(isset($this->id)){
		
			$query = _db()->select('*')
			->from('questions')
			->where(array('id', $this->id));
			$question = $query->result_one();
			
			
			
			
			
			return $question;
		}
		return null;
	}
	
	function getQuestionAnswers(){
	
		if(!empty($this->questionId)){
	
			$query = _db()->select('id, question_id, content, status, content_full, recommend') ->from('answers_question_tn') ->where("question_id='$question_id'");
			$data =  $query->result();
			$questionType = $this->question_type;
			foreach($data as $key => $value){
	
				$data[$key]['content_text'] = null;
	
				if(setSuperType($questionType) == 'fill_table' || setSuperType($questionType) == 'fill_table_text'){
						
					$query_text = _db()->select('content') ->from('answers_question_topic') ->where(array('answers_question_tn_id', $value['id']));
						
					$data_text =  $query->result();
	
					$data[$key]['content_text'] = $data_text;
				}
			}
				
			return $data;
		}
		return NULL;
	}
	
}