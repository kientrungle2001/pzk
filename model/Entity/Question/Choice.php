<?php
class PzkEntityQuestionChoiceModel extends PzkEntityModel {
	public $table = 'questions';
	/*public function getAnswers() {
		$answerEntitys = array();
		$answers = _db()->useCache(1800)->selectAll()->from('answers_question_tn')->where(array('question_id',$this->get('id')))->result();
		foreach($answers as $answer) {
			$answerEntity = _db()->getEntity('question.choice.answer');
			$answerEntity->setData($answer);
			$answerEntitys[] = $answerEntity;
		}
		return $answerEntitys;
	}
	public function getAnswersTopic() {
		return _db()->selectAll()->from('answers_question_tn')->where(array('question_id',$this->get('id')))->result('question.topic.topic');
	}*/
}