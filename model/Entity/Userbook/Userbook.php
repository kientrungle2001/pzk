<?php
require_once BASE_DIR . '/model/Entity.php';
class PzkEntityUserbookUserbookModel extends PzkEntityModel {
	public $table = 'user_book';
	
	function checkKeybook($keyBook){
		$userbook = _db()->select('user_book.keybook')->fromUser_book()
		->where(array('equal', 'keybook', $keyBook))
		->result('Userbook.UserBook');
		if(count($userbook) == 1){
			
			return TRUE;
		}
		return FALSE;
	}
	
	function getStatus($userbookId){
		$userbook = _db()->select('user_book.status')->fromUser_book()
		->where(array('equal', 'id', $userbookId))
		->result_one('userbook.UserBook');
		if(count($userbook) > 0){
			return $userbook->data['status'];
		}
		return false;
	}
	
	function getUserbook($userbookId = ""){
		$userbook = _db()->select('user_book.*')->fromUser_book();
		if($userbookId !==''){
			$userbook->where(array('equal', 'id', $userbookId));
		}
		$data = $userbook->result('Userbook.UserBook');
		if(count($data) > 0){
			return $data;
		}
		return false;
	}
	
	function userBook($userbookId) {
		$data = _db()->select('*')
			->from($this->table)
			->where(array('id', $userbookId))
			->result_one();
		
		return $data;
		
	}
	public function getUserbookTn($userId, $trytest, $camp) {
		$data = _db()->select('*')
			->from($this->table)
			->where(array('userId', $userId))
			->where(array('trytest', $trytest))
			->where(array('camp', $camp))
			->result_one();
		
		return $data;
	}
	public function getNsTn($userId, $trytest, $parentTest) {
		$data = _db()->select('*')
			->from($this->table)
			->where(array('userId', $userId))
			->where(array('trytest', $trytest))
			->where(array('parentTest', $parentTest))
			->result_one();
		
		return $data;
	}
	public function getParentTest($parentTest){
		$data = _db()->select('*')
			->fromTests()
			->where(array('id', $parentTest))
			->result_one();
		
		return $data;
	}
}