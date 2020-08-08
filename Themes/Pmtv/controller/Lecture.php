<?php
class PzkLectureController extends PzkController {
	public $masterStructure = 	'index';
	public $masterPosition	=	'left';
	public function indexAction($mainMenuId, $menuId) {
		$this->layout();
		$this->append('lecture/index');
		$lectureMenu = pzk_element()->getLectureMenu();
		$lectureMenu->set('parentId', $mainMenuId);
		$lectureMenu->set('menuId', $menuId);
		$this->display();
	}
	
	public function luyentuvacauAction($mainMenuId, $menuId) {
		$this->layout();
		$this->append('lecture/index');
		$lectureMenu = pzk_element()->getLectureMenu();
		$lectureMenu->set('layout', 'lecture/luyentuvacau');
		$lectureMenu->set('parentId', $mainMenuId);
		$lectureMenu->set('menuId', $menuId);
		$this->display();
	}
	public function daucauAction($mainMenuId, $menuId) {
		$this->layout();
		$this->append('lecture/index');
		$lectureMenu = pzk_element()->getLectureMenu();
		$lectureMenu->set('layout', 'lecture/daucau');
		$lectureMenu->set('parentId', $mainMenuId);
		$lectureMenu->set('menuId', $menuId);
		$this->display();
	}
	
	public function chinhtaAction($mainMenuId, $menuId) {
		$this->layout();
		$this->append('lecture/index');
		$lectureMenu = pzk_element()->getLectureMenu();
		$lectureMenu->set('layout', 'lecture/chinhta');
		$lectureMenu->set('parentId', $mainMenuId);
		$lectureMenu->set('menuId', $menuId);
		$this->display();
	}
	
	public function morongvontuAction($mainMenuId, $menuId) {
		$this->layout();
		$this->append('lecture/index');
		$lectureMenu = pzk_element()->getLectureMenu();
		$lectureMenu->set('layout', 'lecture/morongvontu');
		$lectureMenu->set('parentId', $mainMenuId);
		$lectureMenu->set('menuId', $menuId);
		$this->display();
	}
	
	public function taplamvanAction($mainMenuId, $menuId) {
		$this->layout();
		$this->append('lecture/index');
		$lectureMenu = pzk_element()->getLectureMenu();
		$lectureMenu->set('layout', 'lecture/taplamvan');
		$lectureMenu->set('parentId', $mainMenuId);
		$lectureMenu->set('menuId', $menuId);
		$this->display();
	}
	
	public function tapdochieuAction($mainMenuId, $menuId) {
		$this->layout();
		$this->append('lecture/index');
		$lectureMenu = pzk_element()->getLectureMenu();
		$lectureMenu->set('layout', 'lecture/tapdochieu');
		$lectureMenu->set('parentId', $mainMenuId);
		$lectureMenu->set('menuId', $menuId);
		$this->display();
	}
	
	public function dethitonghopAction($mainMenuId, $menuId) {
		$this->layout();
		$this->append('lecture/index');
		$lectureMenu = pzk_element()->getLectureMenu();
		$lectureMenu->set('layout', 'lecture/dethitonghop2');
		$lectureMenu->set('parentId', $mainMenuId);
		$lectureMenu->set('menuId', $menuId);
		$this->display();
	}
	
	public function detailAction($mainMenuId, $menuId, $lectureId) {
		$this->layout();
		$this->append('lecture/detail');
		$detail = pzk_element()->getDetail();
		if($detail) {
			$detail->set('mainMenuId', $mainMenuId);
			$detail->set('menuId', $menuId);
			$detail->set('lectureId', $lectureId);
			$detail->set('itemId', $lectureId);
		}
		$this->display();
	}
	
	public function saveChoiceAction() {
		// kết quả
		$result = array(
			'quantity' 	=> (int)pzk_request('quantity'),
			'rights'	=> 0,
			'wrongs'	=> 0
		);
		
		// câu trả lời
		$answers = pzk_request('answers');
		
		// loại câu hỏi
		$question_types = pzk_request('question_types');
		
		// nếu ko có câu trả lời
		if(!count($answers)) {
			$result['wrongs'] = $result['quantity'];
		} else {
			
			// tìm số câu đúng
			$conds = array('or');
			foreach($answers as $questionId => $answerId) {
				
				// nếu là câu trắc nghiệm
				if($question_types[$questionId] == QUESTION_TYPE_CHOICE) {
					$conds[] = array('and', array('question_id', $questionId), array('id', $answerId), array('status', 1));
				} else {
					$conds[] = array('and', array('question_id', $questionId), array('id', $answerId), array('status', 1));
				// nếu là dạng điền từ
					// $conds[] = array('and', array('question_id', $questionId), array('content', $answerId), array('status', 1));
				}
			}
			
			// tính số câu đúng
			$rslt = _db()->select('count(*) as rights')->fromAnswers_question_tn()->where($conds)->limit($result['quantity'])->result_one();
			$result['rights'] = (int)$rslt['rights'];
			
			// tính số câu sai
			$result['wrongs'] = $result['quantity'] - $rslt['rights'];
		}
		$questions_answers = _db()->select('id,question_id,content')->fromAnswers_question_tn()->whereStatus(1)->where('question_id in ('.pzk_request('questionIds').')')->limit($result['quantity'])->result();
		$answersRslt = array();
		foreach($questions_answers as $answer) {
			if($question_types[$answer['question_id']] == QUESTION_TYPE_CHOICE) {
				$answersRslt[$answer['question_id']] = $answer['id'];
			} else {
				$answersRslt[$answer['question_id']] = $answer['id'];
				// $answersRslt[$answer['question_id']] = $answer['content'];
			}
		}
		
		$result['answers'] = $answersRslt;
		$data = array(
			'userId'		=> pzk_session()->get('userId'),
			'quantity'		=> $result['quantity'],
			'categoryId'	=> pzk_request('categoryId'),
			'rights'		=> $result['rights'],
			'userAnswers'	=> json_encode($answers),
			'created'		=> date(DATEFORMAT),
			'questionIds'	=> pzk_request('questionIds'),
			'exerciseNum'	=> pzk_request('exerciseNum'),
			'duration'		=> pzk_request('duration'),
			'startTime'		=> pzk_request('startTime'),
			'remaining'		=> pzk_request('remaining')
		);
		_db()->insert('pmtv_user_book')->fields(false)->values($data)->result();
		echo json_encode($result);
	}
	
	public function saveTestAction() {
		$result = array(
			'quantity' 	=> (int)pzk_request('quantity'),
			'rights'	=> 0,
			'wrongs'	=> 0
		);
		
		$answers = pzk_request('answers');
		if(!count($answers)) {
			$result['wrongs'] = $result['quantity'];
		} else {
			$conds = array('or');
			foreach($answers as $questionId => $answerId) {
				$conds[] = array('and', array('question_id', $questionId), array('id', $answerId), array('status', 1));
			}
			$rslt = _db()->select('count(*) as rights')->fromAnswers_question_tn()->where($conds)->limit($result['quantity'])->result_one();
			$result['rights'] = (int)$rslt['rights'];
			$result['wrongs'] = $result['quantity'] - $rslt['rights'];
		}
		$questions_answers = _db()->select('id,question_id')->fromAnswers_question_tn()->whereStatus(1)->where('question_id in ('.pzk_request('questionIds').')')->limit($result['quantity'])->result();
		$answersRslt = array();
		foreach($questions_answers as $answer) {
			$answersRslt[$answer['question_id']] = $answer['id'];
		}
		
		$result['answers'] = $answersRslt;
		$data = array(
			'userId'		=> pzk_session()->get('userId'),
			'quantity'		=> $result['quantity'],
			'categoryId'	=> pzk_request('categoryId'),
			'rights'		=> $result['rights'],
			'userAnswers'	=> json_encode($answers),
			'created'		=> date(DATEFORMAT),
			'questionIds'	=> pzk_request('questionIds'),
			'testId'		=> pzk_request('testId'),
			'duration'		=> pzk_request('duration'),
			'startTime'		=> pzk_request('startTime'),
			'remaining'		=> pzk_request('remaining')
		);
		_db()->insert('pmtv_user_book')->fields(false)->values($data)->result();
		echo json_encode($result);
	}
	
	public function explainAction() {
		$questions_answers = _db()->select('id,question_id,recommend')->fromAnswers_question_tn()->whereStatus(1)->where('question_id in ('.pzk_request('questionIds').')')->limit((int)pzk_request('quantity'))->result();
		$answersRslt = array();
		foreach($questions_answers as $answer) {
			$answersRslt[$answer['question_id']] = $answer['recommend'];
		}
		echo json_encode($answersRslt);
	}
	
	public function testAction($mainMenuId, $menuId, $catId, $testId) {
		$this->layout();
		$this->append('lecture/test');
		$test = pzk_element()->getTest();
		if($test) {
			$test->set('mainMenuId', $mainMenuId);
			$test->set('menuId',$menuId);
			$test->set('catId', $catId);
			$test->set('testId', $testId);
			$test->set('itemId', $testId);
		}
		$this->display();
	}
}