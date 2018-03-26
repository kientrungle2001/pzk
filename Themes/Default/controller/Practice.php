<?php
class PzkThemesDefaultPracticeController extends PzkController{

	public $masterPage	=	"index";
	public $masterPosition = 'wrapper';
	
	public function detailAction(){
		
		$check = pzk_session('checkPayment');

		$this->initPage();
		
		// subject
		$category_id 	= pzk_request()->getSegment(3);
		
		// class
		$class 			= pzk_request()->get('class');
		
		
		$catEntity = _db()->getTableEntity('categories')->load($category_id, 1800);
		pzk_page()->set('title', 'Luyện tập: ' . $catEntity->get('name'));
		pzk_page()->set('keywords', $catEntity->get('meta_keywords'));
		pzk_page()->set('description', $catEntity->get('meta_description'));
		pzk_page()->set('img', $catEntity->get('img'));
		pzk_page()->set('brief', $catEntity->get('brief'));
		
		$this->append('education/practice/detail', 'wrapper');

		$subjectPractice = pzk_element('subjectPractice');
		
		$subjectPractice->set('categoryId', $category_id);
		
		$subjectPractice->set('class', $class);
		
		$subjectPractice->set('checkPayment', $check);
				
			
		$vocabularyList = pzk_element('vocabularyList');
		if(pzk_request('siteId') == 2) {
			if($vocabularyList){
				$vocabularyList->set('checkPayment', $check);
			}	
		} else {
			if($vocabularyList){
				$vocabularyList->set('parentId', $category_id);
				if(!$check) {
					$vocabularyList->addFilter('trial', 1);
				}
			}	
		}
		
    	$this->display();
	}
	
	public function exercisesAction($topicId) {
		$check 	=	pzk_request()->get('check');
		$class	=	pzk_request()->get('class');
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
		
		$de = pzk_request('de');
		
		$topicId		= pzk_request('topic');
		
		// subject
		$category_id 	= pzk_request()->getSegment(3);
		
		// class
		$class 			= pzk_request()->get('class');
		
		$catEntity = _db()->getTableEntity('categories')->load($category_id, 1800);
			
		pzk_page()->set('title', $catEntity->get('name').' Bài '.$de);
		pzk_page()->set('keywords', $catEntity->get('meta_keywords'));
		pzk_page()->set('description', $catEntity->get('meta_description'));
		pzk_page()->set('img', $catEntity->get('img'));
		pzk_page()->set('brief', $catEntity->get('brief'));
    	
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
			
			$subjectPracticeDoing->set('categoryId', $category_id);
		
			$subjectPracticeDoing->set('class', $class);
			
			$subjectPracticeDoing->set('checkPayment', $check);
			
			$subjectPracticeDoing->set('topicId', $topicId);
			
			$subjectPracticeDoing->set('exerciseNumber', $de);
			
	    }
		
		$vocabularyList = pzk_element('vocabularyList');
		if(pzk_request('siteId') == 2) {
			if($vocabularyList){
				$vocabularyList->set('checkPayment', $check);
			}	
		} else {
			if($vocabularyList){
				$vocabularyList->set('parentId', $category_id);
				if(!$check) {
					$vocabularyList->addFilter('trial', 1);
				}
			}	
		}
    	
    	$this->display();
    }
	public function vocabularyAction(){
		$class 		= pzk_request('class');
		$categoryId = pzk_request()->getSegment(3);		
		
		$detail = $this->parse('education/document/vocabulary');
		$documentId = pzk_request('id');
		$detail->set('itemId', pzk_request()->get('id'));
		$detail->set('categoryId', $categoryId);
		$detail->display();
	}
	function showAnswersTeacherAction(){
		$request	= pzk_element('request');
		$id = $request->get('questionId');
		$answer = _db()->select('*')->from('answers_question_tn')->whereStatus('1')->whereQuestion_id($id)->result_one();
		echo json_encode($answer);
	}
	public function reportErrorAction(){
		if(pzk_request('contentError') && pzk_request('questionId') && pzk_session('userId')){
			
			$phone = pzk_session('phone');
			$email = pzk_session('email');
			$username = pzk_session('username');
			$userId	=	pzk_session('userId');
			$contentError = pzk_request('contentError');
			$questionId = pzk_request('questionId');
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
