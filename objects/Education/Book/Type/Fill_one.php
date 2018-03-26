<?php 
class PzkEducationBookTypeFill_one extends PzkObject{
	
	public $layout = 'book/fill_one';
	
	public $id;
	
	public $user_answers_text_id;
	
	public $request;
	
	public $cauhoi;
	
	public $dapan;
	
	public $questionId;
	
	public $question_type;
	
	public $content;
	
	public $mark;
	
	public $recommend_mark;
	
	public $order;
	
	function getQuestion(){
		
		if(isset($this->questionId)){
		
			$query = _db()->select('id, request, name, type, topic_id, type_id')
			->from('questions')
			->where(array('id',$this->questionId));
			$question = $query->result_one();
			$question['content'] 	= $this->content;
			$question['mark'] 		= $this->mark;
			$question['recommend_mark'] 	= $this->recommend_mark;
			$question['order'] 		= $this->order;
			$question['user_answers_id']	=	$this->id;
			return $question;
		}
		return null;
	}
	
	function getQuestionAnswers(){
	
		if(!empty($this->questionId)){
	
			$query = _db()->select('id, question_id, content, status, content_full, recommend') ->from('answers_question_tn') ->where(array('question_id',$this->questionId));
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