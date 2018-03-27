<?php
class PzkAdminQuestionModel {
	
	function get_question_type($id = ''){
		
		if(!empty($id)){
			$query = _db()->useCache(1800)->select('qt.*')
			->from('questiontype qt')
			->where("qt.id='$id'");
		}else{
			$query = _db()->useCache(1800)->select('qt.*')
			->orderBy('id ASC')
			->from('questiontype qt');
		}
		return $query->result();
	}
	
	function get_category_type_name($id = ''){
		if(!empty($id)){
			$query = _db()->useCache(1800)->select('name')
			->from('categories')
			->where("id='$id'");
		}else{
			return null;
		}
		return $query->result_one();
	}
	
	function get_category_type_name_vn($id = ''){
		if(!empty($id)){
			$query = _db()->useCache(1800)->select('name_vn')
			->from('categories')
			->where("id='$id'");
		}else{
			return null;
		}
		return $query->result_one();
	}
	
	function get_question($id=''){
		if(!empty($id)){
			$query = _db()->useCache(1800)->select('q.*')
			->from('questions q')
			->where("q.id='$id'");
		}else{
			$query = _db()->useCache(1800)->select('q.*')
			->orderBy('id ASC')
			->from('questions q');
		}
		return $query->result();
	}
	
	function get_question_type_of_question($id=''){
		if(!empty($id)){
			$query = _db()->useCache(1800)->select('q.type')
			->from('questions q')
			->where("q.id='$id'");
			$data =  $query->result();
			if(count($data) >0){
				return $data[0]['type'];
			}
		}
		return false;
	}
	
	function get_questionType_of_question($id=''){
		if(!empty($id)){
			$query = _db()->useCache(1800)->select('q.questionType')
			->from('questions q')
			->where("q.id='$id'");
			$data =  $query->result();
			if(count($data) >0){
				return $data[0]['questionType'];
			}
		}
		return false;
	}
	
	function question_answers_add($data = array()){
		
		$addition = array(
			'date_modify'	=>	date(DATEFORMAT),
			'admin_modify'	=>	pzk_session('adminId'),
		);
		
		$data_merger = array_merge($data, $addition);
		
		if(!empty($data_merger) && is_array($data_merger)){
			
			$query	= _db()->insert('answers_question_tn')->fields('question_id, content, status, content_full, recommend, date_modify, admin_modify, content_vn')->values(array($data_merger))->result();
			
			return $query;
		}
		return false;
	}
	
	function question_answers_topic_add($data = array()){
		
		if(!empty($data)){
				
			$query	= _db()->insert('answers_question_topic')->fields('question_id, answers_question_tn_id, content')->values(array($data))->result();
				
			return $query;
		}
		return false;
	}
	
	function get_question_answers($question_id = ''){
		
		if(!empty($question_id)){
			
			$query = _db()->useCache(1800)->select('qa.*')
			->from('answers_question_tn qa')
			->where("qa.question_id='$question_id'");
			$data =  $query->result();
			if(count($data) >0){
				
				foreach($data as $key =>$value){
					$data_topic = $this->get_question_answers_topic($value);
					$data[$key]['topic'] = $data_topic;
				}
				
				return $data;
			}
			return NULL;
		}
		return NULL;
	}
	
	function get_question_answersFill($question_id = ''){
	
		if(!empty($question_id)){
				
			$query = _db()->useCache(1800)->select('qa.*')
			->from('answers_question_tn qa')
			->where("qa.question_id='$question_id'");
			$data =  $query->result();
			if(count($data) >0){
				
				return $data;
			}
			return NULL;
		}
		return NULL;
	}

    function get_question_answers_test($question_id = ''){

        if(!empty($question_id)){

            $query = _db()->useCache(1800)->select('qa.*')
                ->from('answers_question_tn qa')
                ->where("qa.question_id='$question_id'");
            $data =  $query->result();
            if(count($data) >0){
                return $data;
            }
            return NULL;
        }
        return NULL;
    }
	
	function get_question_answers_topic($data = array()){
		
		if(!empty($data)){
			$data_id = $data['id'];
			$query = _db()->useCache(1800)->select('tp.*')
			->from('answers_question_topic tp')
			->where("tp.answers_question_tn_id ='$data_id'");
			$data_topic =  $query->result();
			return $data_topic;
		}
		return null;
	}
	
	function del_question_answers($question_id = '', $table = ''){
		
		if(!empty($question_id) && !empty($table)){
			
			$query = _db()->delete()->from($table)
			->where(array('question_id', $question_id))->result();
			return true;
		}
		return false;
	}
	
	function check_question_answers($question_id = ''){
		
		if(!empty($question_id)){
			
			$query = _db()->useCache(1800)->select('*')	->from('answers_question_tn')	->where("question_id='$question_id'");
			$data =  $query->result();
			if(count($data) >0){
				return true;
			}
		}
		return false;
	}
	
	function update_question_answers($data = array(), $table =''){
		
		$addition = array(
				'date_modify'	=>	date(DATEFORMAT),
				'admin_modify'	=>	pzk_session('adminId'),
		);
		
		$data_merger = array_merge($data, $addition);
		
		if(!empty($data_merger) && !empty($table)){
			
			$query = _db()->update($table)->set($data_merger)
			->where(array('question_id', $data['question_id']))->result();
			return true;
		}
		return false;
	}
	
	function get_topics($id=''){
		if(!empty($id)){
			$query = _db()->useCache(1800)->select('t.*')
			->from('topics t')
			->where("t.id='$id'");
		}else{
			$query = _db()->useCache(1800)->select('t.*')
			->orderBy('id ASC')
			->from('topics t');
		}
		return $query->result();
	}
	/*
	function update_question_type_id($type_id, $value = array()){
		$value['type_id'] = $type_id;
		
		$query = _db()->update('questions')->set($value)
				->where(array('id', $value['id']))->result();
				return true;
	}
	
	function get_question_type_id($type){
		
		$query = _db()->select('qt.*')
		->from('questiontype qt')
		->where("qt.question_type='$type'");
		
		$results = $query->result();
		
		if(count($results)>0){
			
			return $results[0]['id'];
		}
		return 0;
	} */
	function update_answers($id, $data = array(), $table ='answers_question_tn'){
		
		$addition = array(
				'date_modify'	=>	date(DATEFORMAT),
				'admin_modify'	=>	pzk_session('adminId'),
		);
		
		$data_merger = array_merge($data, $addition);
		
		if(!empty($data_merger) && !empty($table)){
			
			$query = _db()->update($table)->set($data_merger)
			->where(array('id', $id))->result();
			return true;
		}
		return false;
	}
	function del_answers($id = '', $table = 'answers_question_tn'){
		
		if(!empty($id) && !empty($table)){
			
			$query = _db()->delete()->from($table)
			->where(array('id', $id))->result();
			return true;
		}
		return false;
	}


	// Test
	function update_answersId($questionId, $content, $answerID, $table ='user_answers'){
		
		$data = array('answerID'	=>	$answerID);
		if(!empty($data) && !empty($table)){
			
			$query = _db()->update($table)->set($data)
			->where(array('and',array('questionId', $questionId),array('content', $content)))->result();
			return true;
		}
		return false;
	}
	//mảng id câu hỏi
	function createArrayQuestion(){
			$query = _db()->useCB()->select('question_id')
			->from('answers_question_tn')
			->groupBy('question_id')->result();
		 return $query;
	}
	//Mảng câu trả lời theo từng câu hỏi
	function createArrayAnswer(){
		
		$query = _db()->useCB()->select('answers_question_tn.question_id, answers_question_tn.id, answers_question_tn.content, answers_question_tn.content_vn')
			->from('answers_question_tn')
			->result();
		return $query;
	}
	// Mảng câu hỏi và câu trả lời theo chỉ mục từng câu hỏi
	function createQuestion(){

		//$questionIds = $this->createArrayQuestion();
		$answers =$this->createArrayAnswer();
		foreach ($answers as $item) {
			$return = $this->update_answersId($item['question_id'], $item['content'], $item['id']);
		}
		return $return;
	}
}
?>