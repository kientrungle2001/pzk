<?php 
/**
* 
*/
class PzkEntityEducationUseranswerModel extends PzkEntityModel
{
	public $table = 'user_answers';
	public function getQuestion() {
		return _db()->selectAll()->fromQuestions()->whereId($this->getQuestionId())->result_one('Education.Question');
	}
	
	public function updateMark($mark) {
		_db()->update($this->table)->set(array('mark' => $mark))->whereId($this->getId())->result();
	}
	
	public function updateMarked() {
		_db()->update($this->table)->set(array('isMark' => 1))->whereId($this->getId())->result();
	}
}