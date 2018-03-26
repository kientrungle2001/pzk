<?php
class PzkPracticeController extends PzkController{

	public $masterPage	=	"index";
	public $masterPosition = 'wrapper';
	
	public function detailAction(){
		
			$check = pzk_session('checkPayment');
			$category_id = pzk_request()->getSegment(3);
			$this->initPage();
			$catEntity = _db()->getTableEntity('categories')->load($category_id, 1800);
			$class= pzk_session('lop');
			pzk_page()->set('title', 'Luyện tập: ' . $catEntity->get('name'));
			pzk_page()->set('keywords', $catEntity->get('meta_keywords'));
			pzk_page()->set('description', $catEntity->get('meta_description'));
			pzk_page()->set('img', $catEntity->get('img'));
			pzk_page()->set('brief', $catEntity->get('brief'));
				$this->append('education/practice/detail', 'wrapper');
				$ngonngu = pzk_element('ngonngu');
				

				$data_category = pzk_model('Category');
				
				// get category child of practice
				
				$categoryOrgin_id = 47;
				
				$categoryName = $data_category->get_category($category_id);
				
				$categoryCurrentObservation = $data_category->get_category_all_display_sn(88, $class , $check);	
				
				$ngonngu->set('categoryCurrentObservation', $categoryCurrentObservation);
				
				$ngonngu->set('categoryName', $categoryName);

				$category = $data_category->get_category_all_display_sn($categoryOrgin_id, $class);

				$ngonngu->set('category', $category);

				$ngonngu->set('categoryId', $category_id);
				$ngonngu->set('checkPayment', $check);
				
			
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
	public function doQuestionAction(){
	
    	$check = pzk_session('checkPayment');
    	$this->initPage();
		$de = pzk_request('de');
		$topicId= pzk_request('topic');
		$category_id = pzk_request()->getSegment(3);
		$catEntity = _db()->getTableEntity('categories')->load($category_id, 1800);
		$class= pzk_session('lop');
			
		pzk_page()->set('title', $catEntity->get('name').' Bài '.$de);
		pzk_page()->set('keywords', $catEntity->get('meta_keywords'));
		pzk_page()->set('description', $catEntity->get('meta_description'));
		pzk_page()->set('img', $catEntity->get('img'));
		pzk_page()->set('brief', $catEntity->get('brief'));
    	
    	if(1 || pzk_request()->is('POST')){
    		
    		$keybook	= uniqid();
    		
    		$s_keybook	=	pzk_session('keybook', $keybook);
    		

			$this->append('education/practice/showQuestion', 'wrapper');	
				
	    	

	    	$data_AdminQuestion_model = pzk_model('AdminQuestion');
	    	
	    	(int)$category_type = pzk_request()->getSegment(3);
	    	
	    	$category_type_name = $data_AdminQuestion_model->get_category_type_name($category_type);
			$category_type_name_vn = $data_AdminQuestion_model->get_category_type_name_vn($category_type);
			$de = pzk_request('de');
			if(is_numeric($de)) {
				$question_limit = 5;
			} else {
				$question_limit = 10;
			}
			
	    	$data_criteria = array(
	    		'category_id'		=> pzk_request()->get('topic') ? pzk_request()->get('topic') : pzk_request()->getSegment(3),
	    		'topic_id'			=> pzk_request()->get('topic'),
	    		'category_name'		=> pzk_request()->get('category_name'),
				'class'		        =>  pzk_request('class'),
				'de'		        =>  $de,
				'trial'		        =>  $check,
		    	'question_limit' 	=> $question_limit,
		    	'question_time'		=> 10,
		    	'question_level' 	=> null,
	    		'keybook'			=> $keybook,
	    		'category_type'		=> pzk_request()->get('topic') ? pzk_request()->get('topic') : pzk_request()->getSegment(3),
	    		'category_type_name'=> $category_type_name['name'],
				'category_type_name_vn'=> $category_type_name_vn['name_vn']
	    	);
	    	
	    	$data_cache = array(
	    			'category_id'		=> pzk_request()->getSegment(3),
	    		'category_name'		=> pzk_request()->get('category_name'),
				'class'		        =>  pzk_request('class'),
				'de'		        =>  pzk_request('de'),
				'trial'		        =>  $check,
		    	'question_limit' 	=> $question_limit,
		    	'question_time'		=> $de,
		    	'question_level' 	=> null,
	    		'category_type'		=> pzk_request()->getSegment(3),
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
	    	
	    	$data_showQuestion	= pzk_element('showQuestion');
	    	$data_showQuestion->set('checkPayment', $check);
	    	$data_showQuestion->set('dataRow', $dataRow);
	    	
	    	$data_showQuestion->set('data_showQuestion', $result_search);
	    	
	    	$data_showQuestion->set('data_criteria', $data_criteria);
			
			$categoryCurrentObservation = $dataCategoryRow->get_category_all_display_sn(88, $class, $check);

			$data_showQuestion->set('categoryCurrentObservation', $categoryCurrentObservation);
    	}
		$vocabularyList = pzk_element('vocabularyList');
		$vocabularyList->set('checkPayment', $check);
    	$this->display();
    }
	
	public function doMediaQuestionAction(){
    	$check = pzk_session('checkPayment');
    	$this->initPage();
		$media = pzk_request('media');
		$mediaEntity	=	_db()->getTableEntity('media')->load($media);
		$topicId= pzk_request('topic');
		$category_id = pzk_request()->getSegment(3);
		$catEntity = _db()->getTableEntity('categories')->load($category_id, 1800);
		$class= pzk_session('lop');
			
		pzk_page()->set('title', $catEntity->get('name').' - '.$mediaEntity->get('name'));
		pzk_page()->set('keywords', $catEntity->get('meta_keywords'));
		pzk_page()->set('description', $catEntity->get('meta_description'));
		pzk_page()->set('img', $catEntity->get('img'));
		pzk_page()->set('brief', $catEntity->get('brief'));
    	
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
	    		'category_id'		=> pzk_request()->get('topic') ? pzk_request()->get('topic') : pzk_request()->getSegment(3),
	    		'topic_id'			=> pzk_request()->get('topic'),
	    		'category_name'		=> pzk_request()->get('category_name'),
				'class'		        =>  pzk_request('class'),
				'media'		        =>  $media,
				'trial'		        =>  $check,
		    	'question_limit' 	=> $question_limit,
		    	'question_time'		=> 30,
		    	'question_level' 	=> null,
	    		'keybook'			=> $keybook,
	    		'category_type'		=> pzk_request()->get('topic') ? pzk_request()->get('topic') : pzk_request()->getSegment(3),
	    		'category_type_name'=> $category_type_name['name'],
				'category_type_name_vn'=> $category_type_name_vn['name_vn']
	    	);
	    	
	    	$data_cache = array(
	    			'category_id'		=> pzk_request()->getSegment(3),
	    		'category_name'		=> pzk_request()->get('category_name'),
				'class'		        =>  pzk_request('class'),
				'media'		        =>  pzk_request('media'),
				'trial'		        =>  $check,
		    	'question_limit' 	=> $question_limit,
		    	'question_time'		=> 10,
		    	'question_level' 	=> null,
	    		'category_type'		=> pzk_request()->getSegment(3),
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
	    	
	    	$data_showQuestion	= pzk_element('showQuestion');
	    	$data_showQuestion->set('checkPayment', $check);
	    	$data_showQuestion->set('dataRow', $dataRow);
	    	
	    	$data_showQuestion->set('data_showQuestion', $result_search);
	    	
	    	$data_showQuestion->set('data_criteria', $data_criteria);
			
			$categoryCurrentObservation = $dataCategoryRow->get_category_all_display_sn(88, $class, $check);

			$data_showQuestion->set('categoryCurrentObservation', $categoryCurrentObservation);
    	}
		$vocabularyList = pzk_element('vocabularyList');
		$vocabularyList->set('checkPayment', $check);
    	
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
	public function showVocabularyAction() {
		$check = pzk_session('checkPayment');
    	$this->initPage();
		$de = pzk_request('de');
		$topicId= pzk_request('topic');
		$category_id = pzk_request()->getSegment(3);
		$catEntity = _db()->getTableEntity('categories')->load($category_id, 1800);
		$class= pzk_session('lop');
			
		pzk_page()->set('title', $catEntity->get('name').' Bài '.$de);
		pzk_page()->set('keywords', $catEntity->get('meta_keywords'));
		pzk_page()->set('description', $catEntity->get('meta_description'));
		pzk_page()->set('img', $catEntity->get('img'));
		pzk_page()->set('brief', $catEntity->get('brief'));
		$this->append('education/practice/showVocabulary', 'wrapper');	

		$vocabularyList = pzk_element('vocabularyList');
		$vocabularyList->set('checkPayment', $check);
    	
    	$this->display();
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
