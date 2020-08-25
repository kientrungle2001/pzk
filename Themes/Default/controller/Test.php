<?php
class PzkTestController extends PzkController{

	public $masterPage		=	"index";
	public $masterPosition 	= 	'wrapper';
	public $isContest		=	false;
	public function testAction(){
		$request	= pzk_request();
		$class 		= intval($request->getClass());
		$type		= intval($request->getPractice());
		$check 		= pzk_session('checkPayment');
    	
    	$testId 	= $request->getSegment(3);
		$testEntity = _db()->getTableEntity('tests')->load($testId, 1800);
		
		$this->initPage();
		$page 		= pzk_page();
		$page->setTitle($testEntity->getName());
		$page->setKeywords($testEntity->getName());
		$page->setDescription($testEntity->getName());
		$page->setImg($testEntity->getImg());
		$page->setBrief($testEntity->getName());
		
		$this->append('education/test/test');
		
		$test 	= pzk_element()->getTest();
		$test->setClass($class);
		$test->setType($type);
		$test->setIsContest($this->isContest);
		if($this->isContest) {
			$book = _db()->getTableEntity('user_book');
			$book->loadWhere(array(
				'and', array(
					'userId', pzk_session('userId')
				), array(
					'testId', $testId
				)
			));
			if($book->getId()) {
				$test->setIsDone(true);
				$test->setBook($book);
			} else {
				$test->setIsDone(false);
			}
		}
		echo '1';
		if($testId !== 0){
			$testModel 		= pzk_model('Question');
			$testDetail 	= $testModel->getTestById($testId);
			$test->setTestDetail($testDetail);
		}else{
			echo '3';
			$test->setTestDetail(0);
		}
    	
    	$this->display();
    }
	
	function testtlAction(){
		
    	
		$class 		= intval(pzk_request('class'));
		
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
				
			pzk_page()->setTitle($testEntity->getName());
			pzk_page()->setKeywords($testEntity->getName());
			pzk_page()->setDescription($testEntity->getName());
			pzk_page()->setImg($testEntity->getImg());
			pzk_page()->setBrief($testEntity->getName());
			
			
			$this->append('education/test/showTestTl', 'wrapper');
				
			
			$resultQuestion = $testModel->getQuestionByTest($testId, $test_detail['quantity']);
			
			$data_showQuestion	= pzk_element('showTestTl');		    	
			$data_showQuestion->setShowQuestionTl($resultQuestion);	
			
			$data_showQuestion->setDataTest($test_detail);		    	 
			$this->display();
			pzk_system()->halt();
				
		}else{
			$check 		= pzk_session('checkPayment');
		
			if($check){
				$testModel = pzk_model('Question');
				$test_detail = $testModel->getTestById($testId);
				$this->initPage();
				$testEntity = _db()->getTableEntity('tests')->load($testId);
					
				pzk_page()->setTitle($testEntity->getName());
				pzk_page()->setKeywords($testEntity->getName());
				pzk_page()->setDescription($testEntity->getName());
				pzk_page()->setImg($testEntity->getImg());
				pzk_page()->setBrief($testEntity->getName());
				
				
				$this->append('education/test/showTestTl', 'wrapper');
					
				
				$resultQuestion = $testModel->getQuestionByTest($testId, $test_detail['quantity']);
				
				$data_showQuestion	= pzk_element('showTestTl');		    	
				$data_showQuestion->setShowQuestionTl($resultQuestion);	
				
				$data_showQuestion->setDataTest($test_detail);		    	 
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
		
    	$class 		= intval(pzk_request('class'));
		$type		= intval(pzk_request('practice'));
    	if( pzk_request()->is('POST')){
	    	$testId = (int) pzk_request()->getTest();
	    	if(isset($testId)){
		    	$testModel = pzk_model('Question');
		    	$test_detail = $testModel->getTestById($testId);
		    	$this->initPage();
				$testEntity = _db()->getTableEntity('tests')->load($testId);
					
				pzk_page()->setTitle($testEntity->getName());
				pzk_page()->setKeywords($testEntity->getName());
				pzk_page()->setDescription($testEntity->getName());
				pzk_page()->setImg($testEntity->getImg());
				pzk_page()->setBrief($testEntity->getName());
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
		    	$data_showQuestion	= pzk_element()->getShowTest();		    	
		    	$data_showQuestion->setData_showQuestion($result_search);		    	
		    	$data_showQuestion->setData_criteria($test_detail);		    	 
		    	$this->display();
	    	}
    	}
    }
	public function testSNAction(){

		$request	= pzk_request();
		$class 		= intval($request->getClass());
		$type		= intval($request->getPractice());
		$check 		= pzk_session('checkPayment');
    	
    	$testId 	= intval(pzk_request('de'));
		$testEntity = _db()->getTableEntity('tests')->load($testId, 1800);
		
		$this->initPage();
		$page 		= pzk_page();
		$page->setTitle($testEntity->getName_sn());
		$page->setKeywords($testEntity->getName());
		$page->setDescription($testEntity->getName());
		$page->setImg($testEntity->getImg());
		$page->setBrief($testEntity->getName());
		
		$this->append('education/test/test');
		
		$test 	= pzk_element()->getTest();
		$test->setClass($class);
		$test->setType($type);
		$test->setIsContest($this->isContest);
		if($this->isContest) {
			$book = _db()->getTableEntity('user_book');
			$book->loadWhere(array(
				'and', array(
					'userId', pzk_session('userId')
				), array(
					'testId', $testId
				)
			), 1800);
			if($book->getId()) {
				$test->setIsDone(true);
				$test->setBook($book);
			} else {
				$test->setIsDone(false);
			}
		}
		
		if($testId !== 0){
			$testModel 		= pzk_model('Question');
			$testDetail 	= $testModel->getTestById($testId);
			$test->setTestDetail($testDetail);
		}else{
			$test->setTestDetail(0);
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
			$testId 	= intval(pzk_request('de'));
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
		
    	$class 		= intval(pzk_request('class'));
		$practice	= intval(pzk_request('practice'));
		$week		= intval(pzk_request('id'));
		

    	if(isset($testId)){
		    	$testModel = pzk_model('Question');
		    	$test_detail = $testModel->getTestById($testId);
		    	$this->initPage();
				$testEntity = _db()->getTableEntity('tests')->load($testId, 1800);
					
				pzk_page()->setTitle($testEntity->getName_sn());
				pzk_page()->setKeywords($testEntity->getName());
				pzk_page()->setDescription($testEntity->getName());
				pzk_page()->setImg($testEntity->getImg());
				pzk_page()->setBrief($testEntity->getName());
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
		    	$data_showQuestion	= pzk_element()->getShowTest();		    	
		    	$data_showQuestion->setData_showQuestion($result_search);		    	
		    	$data_showQuestion->setData_criteria($test_detail);		    	 
		    	$this->display();
	    	}
    }
}
