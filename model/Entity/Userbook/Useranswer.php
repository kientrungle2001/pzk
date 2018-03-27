<?php
require_once BASE_DIR . '/model/Entity.php';
class PzkEntityUserbookUseranswerModel extends PzkEntityModel {
	public $table = 'user_answers';
	
	public function totalMark($userBookId) {
		$data = _db()->select('user_answers.mark')->fromUser_answers()
			->where(array('equal', 'user_book_id', $userBookId))
			->result();
		debug($data);die();	
		$total = 0;
		if($data) {
			foreach($data as $val) {
				$total = $total + $val['mark'];
			}
		}	
		return $total;
	}
	
		public function totalMarkNs($userBookId) {
		$data = _db()->select('user_answers.mark')->fromUser_answers()
			->where(array('equal', 'user_book_id', $userBookId))
			->whereQuestion_type('TL')
			->result();
		$total = 0;
		if($data) {
			foreach($data as $val) {
				$total = $total + $val['mark'];
			}
		}	
		return $total;
	}
	
	public function checkFullMark($userBookId) {
		$data = _db()->select('user_answers.isMark')->fromUser_answers()
		->where(array('equal', 'user_book_id', $userBookId))
		->whereQuestion_type('TL')
		->result();
		$totalUserAnswer = count($data);
		$checkMarked = 0;
		
		foreach($data as $val) {
			if($val['isMark'] == 1){
				$checkMarked = $checkMarked + 1;
			}
		}
		if($totalUserAnswer == $checkMarked){
			return 'ok';
		}else{
			return $checkMarked;
		}
	}
	public function countAnswer($userBookId) {
		$data = _db()->select('count(*) as total')->from('user_answers')
		->where(array('user_book_id', $userBookId))
		->whereQuestion_type('TL')
		->result_one();
		return $data['total'];
	}
	
}
