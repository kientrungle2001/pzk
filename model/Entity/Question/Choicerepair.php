<?php
class PzkEntityQuestionChoicerepairModel extends PzkEntityModel {
	public $table = 'questions';
	public function getAnswers() {
		return _db()->selectAll()->from('answers_question_tn')->where(array('question_id',$this->getId()))->result('Question.Choicerepair.Answer');
		//return _db()->selectAll()->from('answers_question_tn')->where(array('question_id',$this->getId()))->orderBy('RAND()')->result('question.choice.answer');
	}

}