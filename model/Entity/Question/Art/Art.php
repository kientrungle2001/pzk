<?php
class PzkEntityQuestionArtArtModel extends PzkEntityModel {
	public $table = 'question';
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
		//return _db()->select('*')->from('user_test_detail')->whereTestId($this->get('id'))->result('test.detail');
		return _db()->select('*')->from('user_test_detail')->whereTestId($this->get('id'))->result('Test.Detail');
	}
	public function viewQuestion(){
		$rs = _db()->select('*')->from('questions')->whereLevel($this->level)->likeCategoryId('%,'.$this->getCategoryIds().',%')->orderBy('RAND()')->limitQuantity()->result('Question.Questions');
		return $rs;
	}
}