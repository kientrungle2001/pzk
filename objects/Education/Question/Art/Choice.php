<?php
class PzkEducationQuestionArtChoice extends PzkObject {
	public $layout = 'question/art/choice';
	public $item = false;
	public function showAnswer($questionId){
		$rs = _db()->useCB()->select('*')->from('answers_question_tn')->where(array('question_id',$questionId))->result();
	return $rs;
	}
}