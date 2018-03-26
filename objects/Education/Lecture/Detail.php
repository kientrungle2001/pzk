<?php
pzk_import('Core.Db.Detail');
class PzkEducationLectureDetail extends PzkCoreDbDetail {
	public $table = 'categories';
	public $scriptable = true;
	public function getOthers() {
		$item = $this->getItem();
		$parentId = $item['parent'];
		return _db()->selectAll()->from($this->getTable())->whereParent($parentId)->orderBy('ordering asc')->limit(30)->result();
	}
	
	public function getExercises() {
		$item = $this->getItem();
		$stat = _db()->select('count(*) as total')->fromQuestions()->whereStatus(1)->whereDeleted(0)->likeCategoryIds('%,'.$item['id'].',%')->result_one();
		return ceil($stat['total'] / 10);
	}
	
	public function getQuestions($exerciseNum) {
		$item = $this->getItem();
		$questions = _db()->selectAll()->fromQuestions()->whereStatus(1)->whereDeleted(0)->likeCategoryIds('%,'.$item['id'].',%')->limit(10, $exerciseNum - 1)->orderBy('ordering asc')->result();
		return $questions;
	}
	
	public function getAnswers($question) {
		$answers = _db()->selectAll()->fromAnswers_question_tn()->whereQuestion_id($question['id'])->limit(8)->result();
		return $answers;
	}
	
	public function getAllSections() {
		$parentId = 0;
		$items = _db()->selectAll()->from($this->getTable())->likeRouter('%lecture%')->whereStatus(1)->whereDisplay(1)->orderBy('ordering asc')->limit(200)->result();
		$items = treefy ( $items );
		return $items;
	}
	
	public function getOtherSections() {
		$item = $this->getItem();
		$parents = $item['parents'];
		$match = null;
		preg_match('/^,([\d]+),/', $parents, $match);
		$root = $match[1];
		$items = _db()->selectAll()->from($this->getTable())->likeRouter('%lecture%')->likeParents('%,'.$root.',%')->whereStatus(1)->whereDisplay(1)->orderBy('ordering asc')->limit(200)->result();
		$items = treefy ( $items );
		return $items;
	}
}