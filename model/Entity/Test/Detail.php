<?php
class PzkEntityTestDetailModel extends PzkEntityModel {
	public $table = 'user_test_detail';
	public function getQuestions() {
		$rs = _db()->select('*')->from('questions')->likeCategoryIds('%,'.$this->getCategoryId().',%')->orderBy('RAND()')->limit($this->getQuantity(), 0)->result('Question.Questions');
		return $rs;
	}
}