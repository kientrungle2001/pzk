<?php
class PzkEntityQuestionTopicModel extends PzkEntityModel {
	public $table = 'questions';
	public function getTopics() {
		return _db()->selectAll()->from('answers_question_tn')->where(array('question_id',$this->getId()))->result('Question.Topic.Answer');
		//return _db()->selectAll()->from('answers_question_tn')->where(array('question_id',$this->getId()))->orderBy('RAND()')->result('question.choice.answer');
	}
}