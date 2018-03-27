<?php 
/**
* 
*/
class PzkEntityEducationUseranswerModel extends PzkEntityModel
{
	public $table = 'user_answers';
	public function getQuestion() {
		return _db()->selectAll()->fromQuestions()->whereId($this->get('questionId'))->result_one('Education.Question');
	}
	
	public function updateMark($mark) {
		_db()->update($this->table)->set(array('mark' => $mark))->whereId($this->get('id'))->result();
	}
	
	public function updateMarked() {
		_db()->update($this->table)->set(array('isMark' => 1))->whereId($this->get('id'))->result();
	}
}