<?php
class PzkEntityTestDetailModel extends PzkEntityModel {
	public $table = 'user_test_detail';
	public function getQuestions() {
		$rs = _db()->select('*')->from('questions')->likeCategoryIds('%,'.$this->get('categoryId').',%')->orderBy('RAND()')->limit($this->get('quantity'), 0)->result('Question.Questions');
		return $rs;
	}
}