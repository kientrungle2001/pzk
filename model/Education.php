<?php
class PzkEducationModel {
	
	public function getTestByTester($class) {
		 $data = _db()->useCB()
			->select('*')
			->from('tests')
            ->likeClasses('%,'.$class.',%')
			->orderBy('id asc');
		return $data->result_one();	
	}
	
	public function getLessonTester($id) {
		$data = _db()->useCB()
			->select('*')
			->from('categories')
            ->where(array('parent', $id))
			->orderBy('id asc');
		return $data->result_one();
	}
	
	public function markTuLuan($question, $answer) {
		
		if($question['auto']) {
			$teacher_answers = json_decode($question['teacher_answers'], true);
			$total = 0;
			foreach($answer as $type => $ans) {
				foreach($ans as $index => $value)  {
					if(isset($teacher_answers[$type][$index])) {
						$t_answers = explode('|', $teacher_answers[$type][$index]);
						foreach($t_answers as $t_answer) {
							if($t_answer == $value) {
								$total+= $teacher_answers[$type.'_m'][$index];
							}
						}
					}
				}
			}
			return $total;
		}
		return 0;
	}
	
	public function markTuLuanAnswer($questionId, $user_answer_id) {
		
	}
	
	public function markTuLuanAnswerById($user_answer_id) {
		
	}
	
	public function markUserbook($user_book_id) {
		// chấm điểm tự động
			// chấm điểm trắc nghiệm
			// chấm điểm tự luận
		// chấm điểm không tự động
			// cập nhật vào trường giáo viên chấm
		
		$user_book = $this->getUserBook($user_book_id);
		$user_answers = $this->getUserAnswers($user_book_id);
		$tnMark 		= 0;
		$autoMark 		= 0;
		$teacherMark 	= 0;
		foreach($user_answers as $user_answer) {
			$question = _db()->selectAll()->fromQuestions()->whereId($user_answer['questionId'])->result_one();
			if($question['questionType'] == 1) {
				
			} elseif($question['questionType'] == 4) {
				if($question['auto']) {
					$mark = $this->markTuLuan($question, unserialize($user_answer['content']));
					$this->updateUserAnswerMark($user_answer['id'], $mark);
				} else {
					
				}
			}
			
		}
		$this->updateTnMark($user_book_id, $tnMark);
		$this->updateAutoMark($user_book_id, $autoMark);
		$this->updateTeacherMark($user_book_id, $teacherMark);
		
	}
	
	public function markTuLuanByUserBook($user_book_id) {
		$user_book = $this->getUserBook($user_book_id);
		$user_answers = $this->getUserAnswers($user_book_id);
		foreach($user_answers as $user_answer) {
			$question = _db()->selectAll()->fromQuestions()->whereId($user_answer['questionId'])->result_one();
			if($question['auto']) {
				$mark = $this->markTuLuan($question, unserialize($user_answer['content']));
				$this->updateUserAnswerMark($user_answer['id'], $mark);
			}
		}
		$this->updateMarkedsUserBook($user_book_id);
	}
	
	public function updateMarkedsUserBook($user_book_id) {
		$user_book = _db()->select('count(*) as markeds, sum(mark) as total_mark')->fromUser_answers()->whereUser_book_id($user_book_id)->whereIsMark(1)->result_one();
		$this->updateUserBookMarkeds($user_book_id, $user_book['markeds'], $user_book['total_mark']);
	}
	
	public function updateUserBookMarkeds($user_book_id, $markeds, $total_mark) {
		_db()->update('user_book')->set(array('marked' => $markeds, 'total_mark' => $total_mark))
			->whereId($user_book_id)->result();
	}
	
	public function getUserBook($user_book_id) {
		return _db()->selectAll()->from('user_book')->whereId($user_book_id)->result_one();
	}
	
	public function getUserAnswers($user_book_id) {
		return _db()->selectAll()->from('user_answers')->whereUser_book_id($user_book_id)->result();
	}
	
	public function updateUserAnswerMark($user_answer_id, $mark) {
		_db()->update('user_answers')->set(array('mark' => $mark, 'isMark' => 1))
			->whereId($user_answer_id)->result();
	}
	
	public function testMarkTuLuanByUserBook() {
		$this->markTuLuanByUserBook(267);
	}
	
	public function testMarkTuLuanByTest() {
		$user_books = _db()->select('id')->fromUser_book()->whereTestId(10)->result();
		foreach($user_books as $user_book) {
			$this->markTuLuanByUserBook($user_book['id']);
		}
	}
	
	public function getChoiceAnswers($questionIds) {
		if(!count($questionIds)) return array();
		return _db()->select('id, question_id, id as value, status')
		->fromAnswers_question_tn()
		->inQuestion_id($questionIds)->whereStatus(1)->result();
	}
	
	public function getUserBookByUserAndTest($userEntity, $testEntity) {
		$book						=	_db()
					->select('*')->from('user_book')
					->whereUserId($userEntity->get('id'))
					->whereTestId($testEntity->get('id'))
					->result_one();
		if(!$book) {
			$bookId = _db()->insert('user_book')
				->fields('userId,testId,homework,software')
				->values(array(
					array(
						'userId'	=>	$userEntity->get('id'),
						'testId'	=>	$testEntity->get('id'),
						'homework'	=>	$testEntity->get('homework'),
						'software'	=>	pzk_request('softwareId')
					)
				))
				->result();
			$book 	=	_db()->selectAll()->from('user_book')->whereId($bookId)->result_one();
		}
		return $book;
	}
}
?>