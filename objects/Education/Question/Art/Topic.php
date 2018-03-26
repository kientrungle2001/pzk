<?php
class PzkEducationQuestionArtTopic extends PzkObject {
	public $layout = 'question/art/topic';
	public $item = false;
	public function showTopic($questionId){
		$rs = _db()->useCB()->select('*')->from('answers_question_tn')->where(array('question_id',$questionId))->result();
		return $rs;
	}
}