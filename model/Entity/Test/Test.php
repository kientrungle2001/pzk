<?php
class PzkEntityTestTestModel extends PzkEntityModel {
	public $table = 'user_test';
	public function getQuestions() {
		$rs = array();
		$details = $this->getDetails();
		foreach ($details as $detail) {
			$questions = $detail->getQuestions();
			foreach ($questions as $question) {
				$rs[] = $question;
			}
		}
		return $rs;
	}
	public function getDetails() {
		return _db()->select('*')->from('user_test_detail')->whereTestId($this->get('id'))->result('Test.Detail');
	}
}