<?php
class PzkSController extends PzkController {
	public function iAction() {
		$id = pzk_request()->getSegment(3);
		if(is_numeric($id)) {
			$entity = _db()->getTableEntity('short_url')->load($id);
			$url = $entity->getUrl();
			$clicks = $entity->getClicks();
			$clicks++;
			$entity->update(array('clicks' => $clicks));
			$this->redirect($url);
		} else {
			$this->redirect(BASE_URL);
		}
	}
	
	public function uAction() {
		_db()->query('update user set paid_id=0, paid_1_id=0, paid_2_id=0 where 1');
		_db()->query('update user, history_payment set user.paid_id = history_payment.id where user.username = history_payment.username and history_payment.status=2 and history_payment.paymentStatus=1');
		_db()->query('update user, history_payment_test set user.paid_1_id = history_payment_test.id where user.username = history_payment_test.username and history_payment_test.test=1 and history_payment_test.status=2 and history_payment_test.paymentStatus=1');
		_db()->query('update user, history_payment_test set user.paid_2_id = history_payment_test.id where user.username = history_payment_test.username and history_payment_test.test=2 and history_payment_test.status=2 and history_payment_test.paymentStatus=1');
		/*
		foreach($paids as $paid) {
			if($paid['username']) {
				_db()->update('user')->set(array('paid_id'	=> $paid['id']))
					->whereUsername($paid['username'])->result();
			}
		}*/
	}
	public function getIds($items, $field = 'id')	{
		$result 		= array();
		foreach($items as $item) {
			$result[]	= $item[$field];
		}
		return $result;
	}
	public function getMapIds($items) {
		$result			= array();
		foreach($items as $item) {
			$result[$item['id']] = $item;
		}
		return $items;
	}
	public function getGroupBy($items, $field = 'parentId') {
		$result 		= array();
		foreach($items as $item) {
			if(!isset($result[$item[$field]])) {
				$result[$item[$field]] 	=	array();
			}
			$result[$item[$field]][]	= $item;
		}
		return $result;
	}
	public function cAction() {
		$books 		= _db()->selectAll()->fromUser_book()->whereTrytest(2)->result();
		$bookIds 	= $this->getIds($books);
		$questions = _db()->selectAll()->fromUser_answers()
			->whereQuestionId(3736)
			->inUser_book_id($bookIds)->result();
		$book_questions = $this->getGroupBy($questions, 'user_book_id');		
		$real_question_ids = $this->getIds($questions, 'questionId');
		$real_questions = _db()->selectAll()->fromQuestions()->inId($real_question_ids)->result();
		$real_questions = $this->getGroupBy($real_questions, 'id');
		foreach($books as $book)	{
			$user_book_questions = $book_questions[$book['id']];
			foreach($user_book_questions as $question) {
				$answers = unserialize($question['content']);
				$real_question = $real_questions[$question['questionId']];
				//debug($question);
				//debug($real_question);
				$mark = $question['mark'];
				$recommend_mark = $question['recommend_mark'];
				if(1 || !$recommend_mark) {
					if($mark == 0) {
						$recommend_mark = 'Cần đọc kĩ đề hơn. Học sinh xem thêm phần lí giải để có đáp án đúng.';
					}elseif($mark == 1) {
						$recommend_mark = 'Kết quả chưa đúng, học sinh xem thêm phần lí giải để có kết quả đúng.';
					}elseif($mark == 2) {
						$recommend_mark = 'Cần cố gắng hơn';
					} elseif($mark == 3) {
						$recommend_mark = 'Bài làm khá';
					} elseif($mark == 4) {
						$recommend_mark = 'Bài làm tốt';
					}
					_db()->update('user_answers')
						->set(array('recommend_mark' => $recommend_mark))
						->whereId($question['id'])->result();
					echo 'updated!';
				}
				
			}
		}
		
	}
}