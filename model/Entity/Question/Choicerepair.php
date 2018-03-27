<?php
class PzkEntityQuestionChoicerepairModel extends PzkEntityModel {
	public $table = 'questions';
	public function getAnswers() {
		return _db()->selectAll()->from('answers_question_tn')->where(array('question_id',$this->get('id')))->result('Question.Choicerepair.Answer');
		//return _db()->selectAll()->from('answers_question_tn')->where(array('question_id',$this->get('id')))->orderBy('RAND()')->result('question.choice.answer');
	}

}