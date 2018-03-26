<?php 

/**
 * @author Admin
 *
 * Mar 9, 2015
 * 
 * Object Question fill 
 *
 */
class PzkEducationQuestionFill extends PzkObject{
	public $item = false; // cau hoi: entity question.questions
	public $layout = 'test/fill';
	public function ShowQestion($level,$categoryIds,$quantity){
		$view=_db()->useCB()->select('questions. *')->from('questions')->where(array('and',array('level',$level),array('like','categoryIds','%'.$categoryIds.'%')))->limit($quantity)->result();
		return $view;
	}	
	public function ShowAnswer($questionId){
		$view_answer=_db()->useCB()->select('answers_question_tn. *')->from('answers_question_tn')->where(array('question_id',$questionId))->result();
		//var_dump($view_answer);
		//die();
		return $view_answer;
	}
	public function ShowCate($categoryId){
		$category = _db()->useCb()->getEntity('Table')->setTable('categories');
		$category->loadWhere(array('id',$categoryId));
		return $category->getName();
	}	
	
}
 ?>