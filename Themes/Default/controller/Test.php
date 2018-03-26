<?php
class PzkTestController extends PzkController{

	public $masterPage		=	"index";
	public $masterPosition 	= 	'wrapper';
	public $isContest		=	false;
	public function testAction(){
		$request	= pzk_request();
		$class 		= $request->get('class');
		$type		= $request->get('practice');
		$check 		= pzk_session('checkPayment');
    	
    	$testId 	= $request->getSegment(3);
		$testEntity = _db()->getTableEntity('tests')->load($testId, 1800);
		
		$this->initPage();
		$page 		= pzk_page();
		$page->set('title', $testEntity->get('name'));
		$page->set('keywords', $testEntity->get('name'));
		$page->set('description', $testEntity->get('name'));
		$page->set('img', $testEntity->get('img'));
		$page->set('brief', $testEntity->get('name'));
		
		$this->append('education/test/test');
		
		$test 	= pzk_element('test');
		$test->set('class', $class);
		$test->set('type', $type);
		$test->set('isContest', $this->isContest);
		if($this->isContest) {
			$book = _db()->getTableEntity('user_book');
			$book->loadWhere(array(
				'and', array(
					'userId', pzk_session('userId')
				), array(
					'testId', $testId
				)
			));
			if($book->get('id')) {
				$test->set('isDone', true);
				$test->set('book', $book);
			} else {
				$test->set('isDone', false);
			}
		}
		echo '1';
		if($testId !== 0){
			$testModel 		= pzk_model('Question');
			$testDetail 	= $testModel->getTestById($testId);
			$test->set('testDetail', $testDetail);
		}else{
			echo '3';
			$test->set('testDetail', 0);
		}
    	
    	$this->display();
    }
	
	function testtlAction(){
		
    	
		$class 		= pzk_request('class');
		
		$testId = (int) pzk_request()->getSegment(3);
		$dbTryTestIds = _db()->select('id')->fromTests()->whereTrial(1)->whereSoftware(1)->result();
		$tryTestIds = array();
		foreach($dbTryTestIds as $val){
			$tryTestIds[] = $val['id'];
		}
		//debug($tryTestIds);
		if(in_array($testId, $tryTestIds)){
			$testModel = pzk_model('Question');
			$test_detail = $testModel->getTestById($testId);
			$this->initPage();
			$testEntity = _db()->getTableEntity('tests')->load($testId);
				
			pzk_page()->set('title', $testEntity->get('name'));
			pzk_page()->set('keywords', $testEntity->get('name'));
			pzk_page()->set('description', $testEntity->get('name'));
			pzk_page()->set('img', $testEntity->get('img'));
			pzk_page()->set('brief', $testEntity->get('name'));
			
			
			$this->append('education/test/showTestTl', 'wrapper');
				
			
			$resultQuestion = $testModel->getQuestionByTest($testId, $test_detail['quantity']);
			
			$data_showQuestion	= pzk_element('showTestTl');		    	
			$data_showQuestion->set('showQuestionTl', $resultQuestion);	
			
			$data_showQuestion->set('dataTest', $test_detail);		    	 
			$this->display();
			pzk_system()->halt();
				
		}else{
			$check 		= pzk_session('checkPayment');
		
			if($check){
				$testModel = pzk_model('Question');
				$test_detail = $testModel->getTestById($testId);
				$this->initPage();
				$testEntity = _db()->getTableEntity('tests')->load($testId);
					
				pzk_page()->set('title', $testEntity->get('name'));
				pzk_page()->set('keywords', $testEntity->get('name'));
				pzk_page()->set('description', $testEntity->get('name'));
				pzk_page()->set('img', $testEntity->get('img'));
				pzk_page()->set('brief', $testEntity->get('name'));
				
				
				$this->append('education/test/showTestTl', 'wrapper');
					
				
				$resultQuestion = $testModel->getQuestionByTest($testId, $test_detail['quantity']);
				
				$data_showQuestion	= pzk_element('showTestTl');		    	
				$data_showQuestion->set('showQuestionTl', $resultQuestion);	
				
				$data_showQuestion->set('dataTest', $test_detail);		    	 
				$this->display();
				pzk_system()->halt();
			}else{
				//tai khoan dung thu k dc truy cap
				$this->initPage();
				$this->append('education/test/noaccount', 'wrapper');
				$this->display();
				pzk_system()->halt();
			}

		}

    }
	
	function doTestAction(){
		
    	$class 		= pzk_request('class');
		$type		= pzk_request('practice');
    	if( pzk_request()->is('POST')){
	    	$testId = (int) pzk_request()->get('test');
	    	if(isset($testId)){
		    	$testModel = pzk_model('Question');
		    	$test_detail = $testModel->getTestById($testId);
		    	$this->initPage();
				$testEntity = _db()->getTableEntity('tests')->load($testId);
					
				pzk_page()->set('title', $testEntity->get('name'));
				pzk_page()->set('keywords', $testEntity->get('name'));
				pzk_page()->set('description', $testEntity->get('name'));
				pzk_page()->set('img', $testEntity->get('img'));
				pzk_page()->set('brief', $testEntity->get('name'));
		    	$keybook	= uniqid();		    	
		    	$s_keybook	=	pzk_session('keybook', $keybook);
				$this->append('education/test/showTest', 'wrapper');

		    	$test_detail['keybook'] = $keybook;		    	
		    	if(CACHE_MODE && CACHE_QUESTION_MODE){		    	
			    	$key = md5('test'.json_encode($testId));
			    	if($result_search = pzk_filevar($key)){			    	
			    	} else {
			    		$result_search = $testModel->getQuestionByTest($testId, $test_detail['quantity']);
			    		pzk_filevar($key, $result_search);
			    	}
		    	}else{		    		
		    		$result_search = $testModel->getQuestionByTest($testId, $test_detail['quantity']);
		    	}    	
		    	$data_showQuestion	= pzk_element('showTest');		    	
		    	$data_showQuestion->set('data_showQuestion', $result_search);		    	
		    	$data_showQuestion->set('data_criteria', $test_detail);		    	 
		    	$this->display();
	    	}
    	}
    }
	public function testSNAction(){

		$request	= pzk_request();
		$class 		= $request->get('class');
		$type		= $request->get('practice');
		$check 		= pzk_session('checkPayment');
    	
    	$testId 	= pzk_request('de');
		$testEntity = _db()->getTableEntity('tests')->load($testId, 1800);
		
		$this->initPage();
		$page 		= pzk_page();
		$page->set('title', $testEntity->get('name_sn'));
		$page->set('keywords', $testEntity->get('name'));
		$page->set('description', $testEntity->get('name'));
		$page->set('img', $testEntity->get('img'));
		$page->set('brief', $testEntity->get('name'));
		
		$this->append('education/test/test');
		
		$test 	= pzk_element('test');
		$test->set('class', $class);
		$test->set('type', $type);
		$test->set('isContest', $this->isContest);
		if($this->isContest) {
			$book = _db()->getTableEntity('user_book');
			$book->loadWhere(array(
				'and', array(
					'userId', pzk_session('userId')
				), array(
					'testId', $testId
				)
			), 1800);
			if($book->get('id')) {
				$test->set('isDone', true);
				$test->set('book', $book);
			} else {
				$test->set('isDone', false);
			}
		}
		
		if($testId !== 0){
			$testModel 		= pzk_model('Question');
			$testDetail 	= $testModel->getTestById($testId);
			$test->set('testDetail', $testDetail);
		}else{
			$test->set('testDetail', 0);
		}
    	
    	$this->display();
    }
	
	function doTestSNAction(){
		
		$userId		=	pzk_session('userId');
		
    	if($userId == 0){
			
    		$this->initPage();
			$this->append('home/login', 'wrapper');
			$this->display();
			pzk_system()->halt();
    	}else{
			$testId 	= pzk_request('de');
			$check 		= pzk_session('checkPayment');
			
			if(isset($check) && $check == 0){
				$frontend = pzk_model('Frontend');
				$testIdTry = $frontend->getTestIdTry();
				$istest = array();
				foreach($testIdTry as $item){
					$istest[] = $item['id'];
				}
				if(!in_array($testId, $istest)){
					echo "Bạn phải mua tài khoản mới truy cập được!";
					pzk_system()->halt();
				}
			}
		}
		
    	$class 		= pzk_request('class');
		$practice	= pzk_request('practice');
		$week		= pzk_request('id');
		

    	if(isset($testId)){
		    	$testModel = pzk_model('Question');
		    	$test_detail = $testModel->getTestById($testId);
		    	$this->initPage();
				$testEntity = _db()->getTableEntity('tests')->load($testId, 1800);
					
				pzk_page()->set('title', $testEntity->get('name_sn'));
				pzk_page()->set('keywords', $testEntity->get('name'));
				pzk_page()->set('description', $testEntity->get('name'));
				pzk_page()->set('img', $testEntity->get('img'));
				pzk_page()->set('brief', $testEntity->get('name'));
		    	$keybook	= uniqid();		    	
		    	$s_keybook	=	pzk_session('keybook', $keybook);
		    	$this->append('education/test/showTest', 'wrapper');
		    	/*if(pzk_themes('default')) {
					
				}else {
					$this->append('question/showTest', 'left');
				}*/
		    	$test_detail['keybook'] = $keybook;		    	
		    	if(CACHE_MODE && CACHE_QUESTION_MODE){		    	
			    	$key = md5('test'.json_encode($testId));
			    	if($result_search = pzk_filevar($key)){			    	
			    	} else {
			    		$result_search = $testModel->getQuestionByTest($testId, $test_detail['quantity']);
			    		pzk_filevar($key, $result_search);
			    	}
		    	}else{		    		
		    		$result_search = $testModel->getQuestionByTest($testId, $test_detail['quantity']);
		    	}    	
		    	$data_showQuestion	= pzk_element('showTest');		    	
		    	$data_showQuestion->set('data_showQuestion', $result_search);		    	
		    	$data_showQuestion->set('data_criteria', $test_detail);		    	 
		    	$this->display();
	    	}
    }
}
