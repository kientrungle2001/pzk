<?php
class PzkThemesDefaultPracticeController extends PzkController{

	public $masterPage	=	"index";
	public $masterPosition = 'wrapper';
	
	public function detailAction(){
		
		$check = pzk_session('checkPayment');

		$this->initPage();
		
		// subject
		$category_id 	= intval(pzk_request()->getSegment(3));
		
		// class
		$class 			= intval(pzk_request()->getClass());
		
		
		$catEntity = _db()->getTableEntity('categories')->load($category_id, 1800);
		pzk_page()->setTitle('Luyện tập: ' . $catEntity->getName());
		pzk_page()->setKeywords($catEntity->getMeta_keywords());
		pzk_page()->setDescription($catEntity->getMeta_description());
		pzk_page()->setImg($catEntity->getImg());
		pzk_page()->setBrief($catEntity->getBrief());
		
		$this->append('education/practice/detail', 'wrapper');

		$subjectPractice = pzk_element('subjectPractice');
		
		$subjectPractice->setCategoryId($category_id);
		
		$subjectPractice->setClass($class);
		
		$subjectPractice->setCheckPayment($check);
				
			
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
	
	public function exercisesAction($topicId) {
		$topicId = intval($topicId);
		$check 	=	intval(pzk_request()->getCheck());
		$class	=	intval(pzk_request()->getClass());
		if(isset($check ) && ($check == 1)){
			$query = _db()->useCache(1800)
			->select('count(*) as c')
			->fromQuestions()
			->likeCategoryIds("%,$topicId,%")
			->likeClasses("%,$class,%");
			$data = $query->result_one();
		}else{
			$query = _db()->useCache(1800)->select('count(*) as c')
			->useCacheKey('ngonngu_getPractices_class_' . $class.'_subject_' . $topicId . '_0')
			->fromQuestions()
			->likeCategoryIds("%,$topicId,%")
			->likeClasses("%,$class,%")
			->whereTrial("1")
			->orderBy('ordering asc');
			$data = $query->result_one();
		}
		$topic = _db()->select('id,alias')->fromCategories()->whereId($topicId)->result_one();
		if($data['c']){
			$topic['exercises'] = ceil($data['c']/ 5);
		}else{
			$topic['exercises'] = 0;
		}
		echo json_encode($topic);
	}
	
	public function doQuestionAction(){
		
		
    	$check = pzk_session('checkPayment');
    	
		$this->initPage();
		
		$de = intval(pzk_request('de'));
		
		$topicId		= intval(pzk_request('topic'));
		
		// subject
		$category_id 	= intval(pzk_request()->getSegment(3));
		
		// class
		$class 			= intval(pzk_request()->getClass());
		
		$catEntity = _db()->getTableEntity('categories')->load($category_id, 1800);
			
		pzk_page()->setTitle($catEntity->getName().' Bài '.$de);
		pzk_page()->setKeywords($catEntity->getMeta_keywords());
		pzk_page()->setDescription($catEntity->getMeta_description());
		pzk_page()->setImg($catEntity->getImg());
		pzk_page()->setBrief($catEntity->getBrief());
    	
		if(!pzk_session('userId')) {
			$this->append('user/warning/login');
			$this->display();
			pzk_system()->halt();
		}
		
    	if(1 || pzk_request()->is('POST')){
    		
    		$keybook	= uniqid();
    		
    		$s_keybook	=	pzk_session('keybook', $keybook);
    		
			$this->append('education/practice/showQuestion');
			
			$subjectPracticeDoing = pzk_element('subjectPracticeDoing');
			
			$subjectPracticeDoing->setCategoryId($category_id);
		
			$subjectPracticeDoing->setClass($class);
			
			$subjectPracticeDoing->setCheckPayment($check);
			
			$subjectPracticeDoing->setTopicId($topicId);
			
			$subjectPracticeDoing->setExerciseNumber($de);
			
	    }
		
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
	public function vocabularyAction(){
		$categoryId = intval(pzk_request()->getSegment(3));		
		
		$detail = $this->parse('education/document/vocabulary');
		
		$detail->setItemId(intval(pzk_request()->getId()));
		$detail->setCategoryId($categoryId);
		$detail->display();
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
}
