<?php
if(!defined('PZK_ACCESS')) die('Cannot access');
require_once BASE_DIR . '/core/controller/Module.php';
class PzkPracticeController extends PzkModuleController{

	public $masterPage	=	"index";
	public $masterPosition = 'wrapper';
	
	public function detailAction(){
		
		$check = pzk_session('checkPayment');
		$category_id = intval(pzk_request()->getSegment(3));
		$this->initPage();
		$catEntity = _db()->getTableEntity('categories')->load($category_id, 1800);
		$class= pzk_session('lop');
		pzk_page()->setTitle('Luyện tập: ' . $catEntity->getName());
		pzk_page()->setKeywords($catEntity->getMeta_keywords());
		pzk_page()->setDescription($catEntity->getMeta_description());
		pzk_page()->setImg($catEntity->getImg());
		pzk_page()->setBrief($catEntity->getBrief());
		$this->append('education/practice/detail', 'wrapper');
		$ngonngu = pzk_element()->getNgonngu();
		

		$data_category = pzk_model('Category');
		
		// get category child of practice
		
		$categoryOrgin_id = 47;
		
		$categoryName = $data_category->get_category($category_id);
		
		$categoryCurrentObservation = $data_category->get_category_all_display_sn(88, $class , $check);	
		
		$ngonngu->setCategoryCurrentObservation($categoryCurrentObservation);
		
		$ngonngu->setCategoryName($categoryName);

		$category = $data_category->get_category_all_display_sn($categoryOrgin_id, $class);

		$ngonngu->setCategory($category);

		$ngonngu->setCategoryId($category_id);
		$ngonngu->setCheckPayment($check);
				
			
		$vocabularyList = pzk_element()->getVocabularyList();
		if(pzk_request('siteId') == 2) {
			if($vocabularyList){
				$vocabularyList->setCheckPayment($check);
			}	
		} else {
			if($vocabularyList){
				$vocabularyList->setParentId($category_id);
				if(!$check) {
					$vocabularyList->addFilter('trial', 1);
				}
			}	
		}	
		
    	$this->display();
	}
	public function doQuestionAction(){
		
    	$check = pzk_session('checkPayment');
    	$this->initPage();
		$de = intval(pzk_request('de'));
		$topicId= intval(pzk_request('topic'));
		$category_id = intval(pzk_request()->getSegment(3));
		$catEntity = _db()->getTableEntity('categories')->load($category_id, 1800);
		$class= pzk_session('lop');
		$questionType = false;
		if(pzk_request('questionType')){
			$questionType = clean_value(pzk_request('questionType'));
		}
			
		pzk_page()->setTitle($catEntity->getName().' Bài '.$de);
		pzk_page()->setKeywords($catEntity->getMeta_keywords());
		pzk_page()->setDescription($catEntity->getMeta_description());
		pzk_page()->setImg($catEntity->getImg());
		pzk_page()->setBrief($catEntity->getBrief());
    	
    	if(1 || pzk_request()->is('POST')){
    		
    		$keybook	= uniqid();
    		
    		$s_keybook	=	pzk_session('keybook', $keybook);
    		
			if($questionType == 4){
				$this->append('education/practice/showTl', 'wrapper');		
	    	}else{
				$this->append('education/practice/showQuestion', 'wrapper');
			}

	    	$data_AdminQuestion_model = pzk_model('AdminQuestion');
	    	
	    	(int)$category_type = pzk_request()->getSegment(3);
	    	
	    	$category_type_name = $data_AdminQuestion_model->get_category_type_name($category_type);
			$category_type_name_vn = $data_AdminQuestion_model->get_category_type_name_vn($category_type);
			$de = clean_value(pzk_request('de'));
			if(is_numeric($de)) {
				$question_limit = 5;
			} else {
				$question_limit = 10;
			}
			
	    	$data_criteria = array(
	    		'category_id'		=> pzk_request()->getTopic() ? intval(pzk_request()->getTopic()) : intval(pzk_request()->getSegment(3)),
	    		'topic_id'			=> intval(pzk_request()->getTopic()),
	    		'category_name'		=> clean_value(pzk_request()->getCategory_name()),
				'class'		        =>  intval(pzk_request('class')),
				'de'		        =>  $de,
				'questionType'      => $questionType,
				'trial'		        =>  $check,
		    	'question_limit' 	=> $question_limit,
		    	'question_time'		=> 10,
		    	'question_level' 	=> null,
	    		'keybook'			=> $keybook,
	    		'category_type'		=> pzk_request()->getTopic() ? intval(pzk_request()->getTopic()) : intval(pzk_request()->getSegment(3)),
	    		'category_type_name'=> $category_type_name['name'],
				'category_type_name_vn'=> $category_type_name_vn['name_vn']
	    	);
	    	
	    	$data_cache = array(
	    			'category_id'		=> intval(pzk_request()->getSegment(3)),
	    		'category_name'		=> clean_value(pzk_request()->getCategory_name()),
				'class'		        =>  intval(pzk_request('class')),
				'de'		        =>  clean_value(pzk_request('de')),
				'questionType'      => $questionType,
				'trial'		        =>  $check,
		    	'question_limit' 	=> $question_limit,
		    	'question_time'		=> $de,
		    	'question_level' 	=> null,
	    		'category_type'		=> intval(pzk_request()->getSegment(3)),
	    		'category_type_name'=> $category_type_name['name'],
				'category_type_name_vn'=> $category_type_name_vn['name_vn']
	    	);
	    	
	    	$dataCategoryRow = pzk_model('Category');
	    	
	    	$dataRow = $dataCategoryRow->get_category($category_type);
	    	
	    	
	    	
	    	$data_question_model = pzk_model('Question');
	    	
	    	if(CACHE_MODE && CACHE_QUESTION_MODE){
	    	
	    	
		    	$key = md5(json_encode($data_cache). rand(1, PRACTICE_CACHE_LIMIT));
		    	if($result_search = pzk_filevar($key)){
	
		    	} else {
		    		$result_search = $data_question_model->search_criteria($data_criteria);
		    		pzk_filevar($key, $result_search);
		    	}
	    	}else{
	    		
	    		$result_search = $data_question_model->search_criteria($data_criteria);
	    	}
			
	    
	    	$data_criteria['question_limit'] = count($result_search);
	    	
	    	$data_showQuestion	= pzk_element()->getShowQuestion();
	    	$data_showQuestion->setCheckPayment($check);
	    	$data_showQuestion->setDataRow($dataRow);
	    	
	    	$data_showQuestion->setData_showQuestion($result_search);
	    	
	    	$data_showQuestion->setData_criteria($data_criteria);
			
			$categoryCurrentObservation = $dataCategoryRow->get_category_all_display_sn(88, $class, $check);

			$data_showQuestion->setCategoryCurrentObservation($categoryCurrentObservation);
    	}
		$vocabularyList = pzk_element()->getVocabularyList();
		$vocabularyList->setCheckPayment($check);
    	$this->display();
    }
	
	public function doMediaQuestionAction(){
    	$check = pzk_session('checkPayment');
    	$this->initPage();
		$media = intval(pzk_request('media'));
		$mediaEntity	=	_db()->getTableEntity('media')->load($media);
		$topicId= intval(pzk_request('topic'));
		$category_id = intval(pzk_request()->getSegment(3));
		$catEntity = _db()->getTableEntity('categories')->load($category_id, 1800);
		$class= pzk_session('lop');
			
		pzk_page()->setTitle($catEntity->getName().' - '.$mediaEntity->getName());
		pzk_page()->setKeywords($catEntity->getMeta_keywords());
		pzk_page()->setDescription($catEntity->getMeta_description());
		pzk_page()->setImg($catEntity->getImg());
		pzk_page()->setBrief($catEntity->getBrief());
    	
    	if(1 || pzk_request()->is('POST')){
    		
    		$keybook	= uniqid();
    		
    		$s_keybook	=	pzk_session('keybook', $keybook);
    		
			if(1 || pzk_themes('default')) {
					//if(pzk_session('userId')) {
						$this->append('education/practice/showMediaQuestion', 'wrapper');	
					//}else {
						//$this->append('education/practice/trialshowquestion', 'wrapper');
					//}
					
				} else {
					$this->append('question/showMediaQuestion', 'left');
				}
				
	    	

	    	$data_AdminQuestion_model = pzk_model('AdminQuestion');
	    	
	    	(int)$category_type = pzk_request()->getSegment(3);
	    	
	    	$category_type_name = $data_AdminQuestion_model->get_category_type_name($category_type);
			$category_type_name_vn = $data_AdminQuestion_model->get_category_type_name_vn($category_type);
			
			$question_limit = 10;
			
	    	$data_criteria = array(
	    		'category_id'		=> pzk_request()->getTopic() ? intval(pzk_request()->getTopic()) : intval(pzk_request()->getSegment(3)),
	    		'topic_id'			=> intval(pzk_request()->getTopic()),
	    		'category_name'		=> clean_value(pzk_request()->getCategory_name()),
				'class'		        =>  intval(pzk_request('class')),
				'media'		        =>  $media,
				'trial'		        =>  $check,
		    	'question_limit' 	=> $question_limit,
		    	'question_time'		=> 30,
		    	'question_level' 	=> null,
	    		'keybook'			=> $keybook,
	    		'category_type'		=> pzk_request()->getTopic() ? intval(pzk_request()->getTopic()) : intval(pzk_request()->getSegment(3)),
	    		'category_type_name'=> $category_type_name['name'],
				'category_type_name_vn'=> $category_type_name_vn['name_vn']
	    	);
	    	
	    	$data_cache = array(
	    		'category_id'		=> intval(pzk_request()->getSegment(3)),
	    		'category_name'		=> clean_value(pzk_request()->getCategory_name()),
				'class'		        =>  intval(pzk_request('class')),
				'media'		        =>  intval(pzk_request('media')),
				'trial'		        =>  $check,
		    	'question_limit' 	=> $question_limit,
		    	'question_time'		=> 10,
		    	'question_level' 	=> null,
	    		'category_type'		=> intval(pzk_request()->getSegment(3)),
	    		'category_type_name'=> $category_type_name['name'],
				'category_type_name_vn'=> $category_type_name_vn['name_vn']
	    	);
	    	
	    	$dataCategoryRow = pzk_model('Category');
	    	
	    	$dataRow = $dataCategoryRow->get_category($category_type);
	    	
	    	
	    	
	    	$data_question_model = pzk_model('Question');
	    	
	    	if(CACHE_MODE && CACHE_QUESTION_MODE){
	    	
	    	
		    	$key = md5(json_encode($data_cache). rand(1, PRACTICE_CACHE_LIMIT));
		    	if($result_search = pzk_filevar($key)){
	
		    	} else {
		    		$result_search = $data_question_model->search_criteria($data_criteria);
		    		pzk_filevar($key, $result_search);
		    	}
	    	}else{
	    		
	    		$result_search = $data_question_model->search_criteria($data_criteria);
	    	}
	    
	    	$data_criteria['question_limit'] = count($result_search);
	    	
	    	$data_showQuestion	= pzk_element()->getShowQuestion();
	    	$data_showQuestion->setCheckPayment($check);
	    	$data_showQuestion->setDataRow($dataRow);
	    	
	    	$data_showQuestion->setData_showQuestion($result_search);
	    	
	    	$data_showQuestion->setData_criteria($data_criteria);
			
			$categoryCurrentObservation = $dataCategoryRow->get_category_all_display_sn(88, $class, $check);

			$data_showQuestion->setCategoryCurrentObservation($categoryCurrentObservation);
    	}
		$vocabularyList = pzk_element()->getVocabularyList();
		$vocabularyList->setCheckPayment($check);
    	
    	$this->display();
    }
	
	public function showMessageAndHalt($message = null) {
		$this->initPage();
		$this->append('home/login');
		if($message) {
			pzk_element()->getLogin()->setMessage($message);
		}
		$this->display();
		pzk_system()->halt();
	}
	
	public function doHomeworkQuestionAction(){
		#
		$userId		=	pzk_session('userId');
		$testId		=	null;
		#
    	if(!$userId){
			# chưa đăng nhập
    		$this->showMessageAndHalt();
    	}else{
			$request 	= pzk_request();
			$session 	= pzk_session();
			$user 		= pzk_user();
			
			$testId 		= 	intval($request->getHomework());
			$check 			= 	$user->checkPayment('full');
			
			# chưa thanh toán
			if(!$check){				
				$this->showMessageAndHalt('Bạn cần mua phần mềm mới có thể làm bài này');
			}
		}
		
    	$class		= $session->getLop();

		# không có phiếu bài tập
    	if(!$testId){
			$this->showMessageAndHalt('Phiếu bài tập không tồn tại');
		}
		
		$checkAccess = pzk_user()->checkHomeworkAccess($testId);
		
		# không có quyền truy cập phiếu bài tập
		if(!$checkAccess) {
			$this->showMessageAndHalt('Bạn không được quyền xem phiếu bài tập này');
		}
		
		$testEntity = $this->tableEntity('tests', $testId);
		
		# kiểm tra thời hạn
		$today = date('Y-m-d H:i:s');
		if(($testEntity->getStartDate() <= $today || $testEntity->getStartDate() == '0000-00-00 00:00:00') && ($testEntity->getEndDate() >= $today || $testEntity->getEndDate() == '0000-00-00 00:00:00')) {
			# được quyền làm bài
		} else {
			
			# chưa đến thời gian làm bài
			if($testEntity->getStartDate() != '0000-00-00 00:00:00' && $testEntity->getStartDate() > $today) {
				$this->showMessageAndHalt('Chưa đến thời gian làm bài: ' . $testEntity->getName() . '. Thời gian bắt đầu làm: ' . date('H:i d/m/Y', strtotime($testEntity->getStartDate())));
			}
		}
		
		$check = pzk_session('checkPayment');
		$category_id = pzk_request()->getSegment(3);
		
		$this->initPage();
		
		
		$metadata 	= 	$this->model('Metadata');	
		$metadata->fromTest($testEntity);
		
		$this->append('education/practice/showHomework');
		
		$education 	=	$this->model('Education');
		$book		=	$education->getUserBookByUserAndTest(pzk_user(), $testEntity);
		
		$homework					= 	pzk_element()->getShowTest();
		
		$homework->setItemId(		$testId);
		$homework->set('bookId',		$book['id']);
		$homework->setBook(			$book);
		
		
		$ngonngu = pzk_element()->getNgonngu();
		

		$data_category = pzk_model('Category');
		
		// get category child of practice
		
		$categoryOrgin_id = 47;
		
		$categoryName = $data_category->get_category($category_id);
		
		$categoryCurrentObservation = $data_category->get_category_all_display_sn(88, $class , $check);	
		
		$ngonngu->setCategoryCurrentObservation($categoryCurrentObservation);
		
		$ngonngu->setCategoryName($categoryName);

		$category = $data_category->get_category_all_display_sn($categoryOrgin_id, $class);

		$ngonngu->setCategory($category);

		$ngonngu->setCategoryId($category_id);
		$ngonngu->setCheckPayment($check);
		
		$this->display();
    }
	
	public function saveHomeworkAction() {
		$request 			= 	pzk_request();
		$session 			=	pzk_session();
		
		$userId 			=	$session->getUserId();
		
		$subject 			=	intval($request->getSubject());
		$topic				=	intval($request->getTopic());
		$testId				=	intval($request->getHomework());
		$userData 			= 	$request->getUserData();
		$questionIds 		= 	$userData['questionIds'];
		$questionTypes 		= 	$userData['questionTypes'];
		$answers			=	$userData['answers'];
		$bookId 			=	intval($userData['bookId']);
		$totalMark			=	0;
		$totalTn			=	0;
		$autoMark			=	0;
		$total 				=	0;
		$startTime 			=	$userData['start_time'];
		$duringTime			=	$userData['during_time'];
		$stopTime			=	$startTime + $duringTime;
		$user_answers		=	array();
		$test				=	_db()->selectAll()->from('tests')->whereId($testId)->result_one();
		
		foreach($questionIds as $questionIndex => $questionId) {
			$question 		=	_db()->getTableEntity('questions')->load($questionId);
			$questionType = $questionTypes[$questionIndex];
			$action = 'mark' . ucfirst($questionType);
			# kiểu bài trắc nghiệm
			if($questionType == 'choice') {
				$mark = $this->$action($question, $answers, $test);
				$totalMark 	+= 	$mark;
				$autoMark 	+=	$mark;
				$totalTn	+=	$mark;
				$total++;
				$user_answer 		=	array(
					'questionId'	=>	$questionId,
					'answerId'		=>	isset($answers[$questionId])?$answers[$questionId]: 0,
					'user_book_id'	=>	$bookId,
					'question_type'	=>	'Q0',
					'mark'			=>	$mark,
					'isMark'		=>	1,
					'testId'		=>	$testId,
					'auto'			=>	1
				);
				$user_answers[]		=	$user_answer;
			} else {
			# kiểu bài tự luận
				
				# bóc tách dữ liệu
				$arAnswer = array();
				if(isset($answers[$questionIndex.'_i'])){
					$arAnswer['i'] = $answers[$questionIndex.'_i'];
				}
				if(isset($answers[$questionIndex.'_t'])){
					$arAnswer['t'] = $answers[$questionIndex.'_t'];
				}
				
				# chấm điểm
				$mark = $this->$action($question, $arAnswer, $test);
				$totalMark += $mark;
				if($question->getauto()) {
					$autoMark += $mark;
				}
				
				# lưu vào user answer
				$user_answer 		=	array(
					'questionId'	=>	$questionId,
					'answerId'		=>	'',
					'content'		=>	serialize($arAnswer),
					'user_book_id'	=>	$bookId,
					'question_type'	=>	'TL',
					'testId'		=>	$testId,
					'auto'			=>	$question->getauto(),
					'isMark'		=> 	$question->getauto() ? 1 : 0,
					'mark'			=>	$mark
				);
				$user_answers[]		=	$user_answer;
			}
		}
		
		# lấy tên lớp học của học sinh và tên lớp học của đề thi giao nhau
		$className 					= 	'';
		$classNames					=	array();
		$classrooms					=	pzk_user()->getClassrooms();
		$testClassrooms				=	_db()->selectAll()->from('education_classroom_homework')
				->whereHomeworkId($testId)->result();
		foreach($classrooms as $classroom) {
			foreach($testClassrooms as $testClassroom) {
				if($classroom['classroomId'] == $testClassroom['classroomId']) {
					$classNames[] = $classroom['className'];
				}
			}
		}
		$className					=	','.implode(',', $classNames).',';
		
		# lưu vào bảng user_book
		# niên khóa
		$schoolYear					= 	date('Y');
		if(date('m') < 7) $schoolYear = date('Y') - 1;
		
		# tạo bản ghi user_book
		$user_book = array(
			'id'					=> 	$bookId,
			'userId'				=> 	$userId,
			'categoryId'			=> 	$subject,
			'topic'					=> 	$topic,
			'quantity_question'		=> 	count($questionIds),
			'startTime'				=> 	date('Y-m-d H:i:s', $startTime),
			'stopTime'				=> 	date('Y-m-d H:i:s', $stopTime),
			'duringTime'			=> 	$duringTime,
			'testId'				=> 	$testId,
			'keybook'				=> 	uniqid(),
			'software'				=> 	$request->getSoftwareId(),
			'created'				=> 	date('Y-m-d H:i:s'),
			'mustMark'				=> 	1,
			'homework'				=> 	1,
			'week'					=> 	$test['week'],
			'month'					=> 	$test['month'],
			'semester'				=> 	$test['semester'],
			'class'					=> 	pzk_session('lop'),
			'classname'				=>	$className,
			'schoolYear'			=>	$schoolYear,
			'homeworkStatus'		=>	1,
			'autoMark'				=>	$autoMark,
			'totalMark'				=>	$totalMark,
			'totalTn'				=> 	$totalTn,
			'testMark'				=>  $test['testMark'] 
		);
		
		# lưu
		$userBookEntity =	_db()->getTableEntity('user_book');
		$userBookEntity->setData($user_book);
		$userBookEntity->save();
		echo $user_book['keybook'];
		
		# Lưu các đáp án
		foreach($user_answers as $user_answer) {
			$user_answer['user_book_id']	=	$userBookEntity->getId();
			
			# kiểm tra đáp án đã có chưa
			$userAnswerEntity 	= 	_db()->getTableEntity('user_answers');
			$userAnswerExisted 	= 	_db()->select('id')->from('user_answers')
				->whereUser_book_id($bookId)
				->whereQuestionId($user_answer['questionId'])
				->result_one();
				
			# đáp án đã tồn tại
			if($userAnswerExisted) {
				$user_answer['id'] = $userAnswerExisted['id'];
			}
			
			# lưu
			$userAnswerEntity->setData($user_answer);
			$userAnswerEntity->save();
		}
		
	}
	
	public function showHomeworkResultAction() {
		$answers 		= 	pzk_request('answers');
		
		$questionIds 	= 	$answers['questionIds'];
		$questionTypes 	= 	$answers['questionTypes'];
		$user_answers 	=	$answers['answers'];
		$startTime		=	$answers['start_time'];
		$duringTime		=	$answers['during_time'];
		$questionTime	=	$answers['question_time'];
		$testId			=	$answers['testId'];
		$bookId			=	$answers['bookId'];
		$user_book		=	_db()->selectAll()->fromUser_book()->whereId($bookId)->result_one();
		
		$num_auto 		=	_db()->select('count(*) as c')
					->fromQuestions()
					->where('status=1 and deleted=0 and (questionType=1 or (questionType=4 and auto=1))')
					->inId($questionIds)
					->result_one();
		$num_auto 		= 	$num_auto['c'];
		
		$questionsAuto	=	_db()->select('id')
					->fromQuestions()
					->where('status=1 and deleted=0 and (questionType=1 or (questionType=4 and auto=1))')
					->inId($questionIds)
					->result();
		
		$questionAutoIds	=	array_map(function($question) {
			return $question['id'];
		}, $questionsAuto);
		$questionTeacherIds = array_diff($questionIds, $questionAutoIds);
		
		$num_total		=	count($questionIds);
		$num_teacher	=	$num_total	-	$num_auto;
		$book_true 		=	_db()->select('count(*) as c, sum(mark) as s')
					->fromUser_answers()
					->where('isMark=1 and mark!=0')
					->whereUser_book_id($bookId)
					->inQuestionId($questionAutoIds)
					->result_one();
		$num_true		=	$book_true['c'];
		$mark_auto		=	$book_true['s'];
		$num_false		=	$num_auto	-	$num_true;
		
		$teacher_true 		=	_db()->select('count(*) as c, sum(mark) as s')
					->fromUser_answers()
					->where('isMark=1')
					->whereUser_book_id($bookId)
					->inQuestionId($questionTeacherIds)
					->result_one();
		
		$mark_teacher		=	is_null($teacher_true['s']) ? 0 : $teacher_true['s'];
		
		echo json_encode( array(
			'num_total'				=>	intval($num_total),
			'num_auto'				=>	intval($num_auto),
			'num_true'				=>	intval($num_true),
			'num_false'				=>	intval($num_false),
			'num_teacher'			=>	intval($num_teacher),
			'mark_auto'				=>	floatval($mark_auto),
			'mark_teacher'			=>	floatval($mark_teacher),
			'mark_teacher_status'	=>	intval($user_book['status']),
			'otherIds'				=>	$questionTeacherIds
		));
	}
	
	public function showHomeworkAnswersChoiceAction() {
		$request 			= pzk_request();
    
    	$data_answers 		= $request->getanswers();
    	 
    	$questionIds 		= $data_answers['questionIds'];
    	
    	$questionTypes		= $data_answers['questionTypes'];
		    	
		$choiceQuestionIds 	= array();
		foreach($questionTypes as $questionId => $questionType) {
			if($questionType == 'choice') {
				$choiceQuestionIds[] = $questionId;
			}
		}
		
    	$result_answer = array();
		
		//xu ly phan show giai thich
		$education			=	$this->model('Education');
		$choiceAnswers 		= 	$education->getChoiceAnswers($choiceQuestionIds);
		
		
    	foreach($choiceAnswers as $answer){
            
    		$result_answer[] = array(
    				'superType' 	=> $questionTypes[$answer['question_id']],
    				'questionId' 	=> $answer['question_id'],
    				'value' 		=> $answer['id']
    		);
    	}
		
		#
		$tuluanAutoQuestionIds 	=	array();
		$tuluanQuestionIds		=	array();
		foreach($questionTypes as $questionId => $questionType) {
			if($questionType == 'tuluan') {
				$tuluanQuestionIds[] = $questionId;
			}
		}
    	if($tuluanQuestionIds) {
			$tuluanAutoQuestions 	=	_db()->select('id,teacher_answers')->fromQuestions()->inId($tuluanQuestionIds)->whereAuto(1)->result();
		} else {
			$tuluanAutoQuestions 	=	array();
		}
		$tuluanAutoQuestionIds	=	array_map(function($question) {
			return $question['id'];
		}, $tuluanAutoQuestions);
		foreach($tuluanAutoQuestions as $question) {
			$teacher_answers	=	json_decode($question['teacher_answers'], true);
			$result_answer[] = array(
    				'superType' 	=> $questionTypes[$question['id']],
    				'questionId' 	=> $question['id'],
    				'value' 		=> $teacher_answers,
					'auto'			=>	1
    		);
		}
    	echo json_encode($result_answer);
	}
	
	public function markChoice($question, $answers, $test) {
		if(!isset($answers[$question->getId()])) return 0;
		$right = _db()->select('id')->from('answers_question_tn')
			->whereQuestion_id($question->getId())
			->whereId($answers[$question->getId()])
			->whereStatus(1)
			->result_one();
		if($right) {
			return $test['score']?$test['score'] : 1;
		}
		return 0;
	}
	
	public function markTuluan($question, $answer, $test) {
		if($question->getauto()) {
			$teacher_answers = json_decode($question->getTeacher_answers(), true);
			$total = 0;
			foreach($answer as $type => $ans) {
				foreach($ans as $index => $value)  {
					if(isset($teacher_answers[$type][$index])) {
						$t_answers = explode('|', $teacher_answers[$type][$index]);
						foreach($t_answers as $t_answer) {
							if(strtolower(trim($t_answer)) == strtolower(trim($value))) {
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
	
	public function testMarkTuLuanAction() {
		$total = $this->markTuluan(48, unserialize('a:1:{s:1:"i";a:1:{i:1;s:1:"4";}}'), 10);
		debug($total);
		$education = pzk_model('Education');
		$education->testMarkTuLuanByTest();
	}
	
	public function vocabularyAction(){
		$class 		= intval(pzk_request('class'));
		$categoryId = intval(pzk_request()->getSegment(3));		
		
		$detail = $this->parse('education/document/vocabulary');
		$documentId = intval(pzk_request('id'));
		$detail->setItemId($documentId);
		$detail->setCategoryId($categoryId);
		$detail->display();
	}
	public function showVocabularyAction() {
		$check = pzk_session('checkPayment');
    	$this->initPage();
		$de = intval(pzk_request('de'));
		$topicId= intval(pzk_request('topic'));
		$category_id = intval(pzk_request()->getSegment(3));
		$catEntity = _db()->getTableEntity('categories')->load($category_id, 1800);
		$class= pzk_session('lop');
			
		pzk_page()->setTitle($catEntity->getName().' Bài '.$de);
		pzk_page()->setKeywords($catEntity->getMeta_keywords());
		pzk_page()->setDescription($catEntity->getMeta_description());
		pzk_page()->setImg($catEntity->getImg());
		pzk_page()->setBrief($catEntity->getBrief());
		$this->append('education/practice/showVocabulary', 'wrapper');	

		$vocabularyList = pzk_element()->getVocabularyList();
		$vocabularyList->setCheckPayment($check);
    	
    	$this->display();
	}
	function showAnswersTeacherAction(){
		$request	= pzk_request();
		$id = intval($request->getQuestionId());
		$answer = _db()->select('*')->from('answers_question_tn')->whereStatus('1')->whereQuestion_id($id)->result_one();
		echo json_encode($answer);
	}
	public function reportErrorAction(){
		if(pzk_request('contentError') && pzk_request('questionId') && pzk_session('userId')){
			
			$phone = pzk_session('phone');
			$email = pzk_session('email');
			$username = pzk_session('username');
			$userId	=	pzk_session('userId');
			$contentError = clean_value(pzk_request('contentError'));
			$questionId = intval(pzk_request('questionId'));
			$rows = array(
				'phone' => $phone,
				'email'  => $email,
				'username'  => $username,
				'userId'  => $userId,
				'content'  => $contentError,
				'questionId' => $questionId,
				'created' => date(DATEFORMAT, $_SERVER['REQUEST_TIME'])
				
			);
			$frontendmodel = pzk_model('Frontend');
			$frontendmodel->save($rows, 'question_error');
			echo 1;
		}
	}
	
	public function importAction() {
		$lines = file(BASE_DIR. '/EE5522.csv');
		array_shift($lines);
		foreach($lines as $line) {
			$cells = explode(',', $line);
			$className 	= $cells[0];			$username 	= $cells[1];
			$name 		= $cells[2];			$birthdate 	= $cells[3];
			$gender 	= $cells[4];			$gradeNum 	= substr($className, 0, 1);
			$className 	= substr($className, 1);
			$classroom 	= $this->findClassroom(2017, $gradeNum, $className);
			$birthdate 	= $this->reformatBirthdate($birthdate);
			$gender 	= $this->reformatGender($gender);
			if(_db()->selectAll()->fromUser()->whereUsername($username)->result_one()) {
				echo 'Username ' . $username . ' đã tồn tại!<br />';
			}
			$user 		= _db()->getTableEntity('user');
			$user->setData(array(
				'username'	=> 	$username,
				'name'		=>	$name,
				'birthday'	=>	$birthdate,
				'sex'		=>	$gender,
				'password'	=>	md5('123456'),
				'status'	=>	1,
				'type'		=>	'classroom',
				'areacode'	=>	'1',
				'district'	=>	'1150',
				'class'		=>	$gradeNum,
				'classname'	=>	$className,
				'school'	=>	'1183',
				'schoolName'=>	'TH Ngôi Sao Hà Nội'
			));
			$user->save();
			$userId = $user->getId();
			$classroomStudent = _db()->getTableEntity('education_classroom_student');
			$classroomStudent->setData(array(
				'classroomId'	=>	$classroom['id'],
				'studentId'		=>	$userId,
				'software'		=>	pzk_request('softwareId'),
				'site'			=>	pzk_request('siteId')
			));
			$classroomStudent->save();
			$historyPayment 	=	_db()->getTableEntity('history_payment');
			$historyPayment->setData(array(
				'username'		=>	$username,
				'amount'		=>	0,
				'paymentStatus'	=>	1,
				'status'		=>	2,
				'software'		=>	pzk_request('softwareId'),
				'site'			=>	pzk_request('site'),
				'serviceType'	=>	'full',
				'serviceId'		=>	19,
				'paymentDate'	=>	'2018-01-24 00:00:00',
				'expiredDate'	=>	'2020-01-24 00:00:00',
			));
			$historyPayment->save();
		}
	}
	
	public function findClassroom($schoolYear, $gradeNum, $className) {
		static $allClassrooms = array();
		if(isset($allClassrooms[$schoolYear.''. $gradeNum.''. $className])) return $allClassrooms[$schoolYear.''. $gradeNum.''. $className];
		$allClassrooms[$schoolYear.''. $gradeNum.''. $className] = $classroom = _db()->selectAll()->from('education_classroom')
			->whereSchoolYear($schoolYear)
			->whereClassName($className)
			->whereGradeNum($gradeNum)
			->result_one();
		return $classroom;
	}
	public function reformatBirthdate($birthdate) {
		return preg_replace('/([\d]+)\/([\d]+)\/([\d]+)/', '$3-$2-$1', $birthdate);
	}
	public function reformatGender($gender) {
		if(trim($gender) == 'Nam') {
			return 1;
		} else {
			return 0;
		}
	}
	
	public function updateTestMarkAction(){
		$tests = _db()->select('id, testMark')
					->fromTests()
					->whereHomework(1)
					->whereStatus(1)
					->result();
		foreach($tests as $test){
			_db()->update('user_book')
				->set(array('testMark' => $test['testMark']))
				->whereTestId($test['id'])->result();
		}
		echo 'done';	
	}
	
	public function userbookAction() {
		$userbook = _db()->getEntity('Education.Userbook')->load(1914);
		$userbook->mark();
	}
	
	public function testRenderLayoutAction() {
		$this->renderLayout('renderLayout', null, ['layoutCompiler' => false]);
	}
}
