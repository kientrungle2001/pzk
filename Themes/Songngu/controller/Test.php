<?php
pzk_import_controller('Themes/Default', 'Test');
class PzkTestController extends PzkThemesDefaultTestController {
	public $masterPosition = 'wrapper';
	
	
	function doTestSNAction(){
		$userId		=	pzk_session('userId');
		
    	if($userId == 0){
			
    		$this->initPage();
			$this->append('home/login', 'wrapper');
			$this->display();
			pzk_system()->halt();
    	}else{
			$testId 	= pzk_request()->getDe();
			$check 		= pzk_session('checkPayment');
			
			if($check == 0){
				$class= pzk_session('lop');
				$frontend = pzk_model('Frontend');
				$testIdTry = $frontend->getTestIdTry($class);
				$istest = array();
				foreach($testIdTry as $item){
					$istest[] = $item['id'];
				}
				if(!in_array($testId, $istest)){
					$this->initPage();
					$this->append('home/login', 'wrapper');
					pzk_element()->getLogin()->setMessage('Bạn cần mua phần mềm mới có thể làm bài này');
					$this->display();
					pzk_system()->halt();
				}
			}
		}
    	$class= pzk_session('lop');
		$practice	= pzk_request()->getPractice();
		$week		= pzk_request()->getId();
		

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
	public function ajaxTestAction(){
		$page = pzk_request()->getPage();
		$class = pzk_request()->getLop();
		$this->parse('education/test/ajaxtest');
		
		$ajaxtest = pzk_element()->getAjaxtest();
		$ajaxtest->setPage($page);
		$ajaxtest->setClass($class);
		$ajaxtest->display();
	}
}