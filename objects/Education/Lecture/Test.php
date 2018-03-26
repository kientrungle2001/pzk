<?php
pzk_import('Core.Db.Detail');
class PzkEducationLectureTest extends PzkCoreDbDetail {
	public $table 		= 'tests';
	public $layout		= 'lecture/test';
	public $scriptable 	= true;
	
	public function getOthers() {
		return _db()->selectAll()->from('categories')->whereParent($this->getMainMenuId())->orderBy('ordering asc')->limit(30)->result();
	}
	
	public function getTests() {
		return _db()->selectAll()->from('categories')->whereParent($this->getMenuId())->orderBy('ordering asc')->limit(100)->result();
	}
	
	public function getQuestions() {
		$item = $this->getItem();
		$questions = _db()->selectAll()->fromQuestions()->whereStatus(1)->whereDeleted(0)->likeTestId('%,'.$item['id'].',%')->limit($item['quantity'])->orderBy('ordering asc')->result();
		return $questions;
	}
	
	public function getAnswers($question) {
		$answers = _db()->selectAll()->fromAnswers_question_tn()->whereQuestion_id($question['id'])->limit(8)->result();
		return $answers;
	}
}