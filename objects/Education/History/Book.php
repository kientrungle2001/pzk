<?php
pzk_import('Core.Db.Detail');
class PzkEducationHistoryBook extends PzkCoreDbDetail {
	public $table = 'user_book';
	public function getQuestions() {
		$item = $this->getItem();
		$questions = _db()->select('user_answers.id, questions.ordering as ordering, questions.id as questionId, questions.name as questionName, questions.name_vn as name_vn, user_answers.answerId, questions.questionType as questionType')->fromUser_answers()
		->joinQuestions('user_answers.questionId = questions.id')->whereUser_book_id($item['id'])->orderBy('ordering asc')->result();
		return $questions;
	}
	
	public function getAnswers($questionId) {
		return _db()->selectAll()->fromAnswers_question_tn()->whereQuestion_id($questionId)->result();
	}
	
	public function getAnswersTl($questionId) {
		$item = $this->getItem();
		return _db()->selectAll()->fromUser_answers()->whereQuestionId($questionId)->whereUser_book_id($item['id'])->result_one();
	}
}