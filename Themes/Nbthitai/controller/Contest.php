<?php
pzk_import_controller('Themes/Default', 'Contest');
class PzkContestController extends PzkThemesDefaultContestController {
	public $masterPage = 'index';
	public $masterPosition 	= 	'wrapper';
	
	public function showResultAction() {
		
		if(pzk_session('userId')){
				$testId = intval(pzk_request()->getSegment(3));
				$userId = pzk_session('userId');
			
				$frontend = pzk_model('Frontend');
				$userBookModel 	= pzk_model('Userbook');
				
				$userInfo = $frontend->getOne($userId, 'user');
				
				$userbook = $frontend->getUserbookTt($userId, $testId);

				if($userbook) {
					$this->initPage();
						pzk_page()->setTitle('Kết quả thi thử trường Trần Đại Nghĩa');
						pzk_page()->setKeywords('Kết quả thi thử trường Trần Đại Nghĩa');
						pzk_page()->setDescription('Kêt quả thi thử vao trường Trần Đại nghĩa với phần mềm Full Look');
						pzk_page()->setImg('/Default/skin/nobel/Themes/Story/media/logo.png');
						pzk_page()->setBrief('Công Ty Cổ Phần Giáo Dục Phát Triển Trí Tuệ Và Sáng Tạo Next Nobels');
						$this->append('showresult/showresult', 'wrapper');
						
						//get rate
						$rate = $frontend->getRateTt($userbook['id'], $testId);
						//data cau trac nghiem
						$showQuestionTn = $userBookModel->getQuestionByTrytestId($testId);
						
						$showresult = pzk_element('showresult');
						//set showQuestionTn
						$showresult->setShowQuestionTn($showQuestionTn);
						
						//xu li bai trac nghiem
						$showresult->setUserBookIdTn($userbook['id']);
						//set rate
						$showresult->setRate($rate);
						//dulieu hoc sinh
						$showresult->setUserInfo($userInfo);
						//diem thi trac nghiem
						$scoreTn = $userbook['mark'];
						$showresult->setTestId($testId);
						$showresult->setScoretn($scoreTn);
						
							
					$this->display();
					pzk_system()->halt();
				}else{
					$this->initPage();
						pzk_page()->setTitle('Chưa làm đề của trung tâm');
						pzk_page()->setKeywords('Chưa làm đề của trung tâm');
						pzk_page()->setDescription('Chưa làm đề của trung tâm');
						pzk_page()->setImg('/Default/skin/nobel/Themes/Story/media/logo.png');
						pzk_page()->setBrief('Công Ty Cổ Phần Giáo Dục Phát Triển Trí Tuệ Và Sáng Tạo Next Nobels');
						$this->append('showresult/alert', 'wrapper');
						$alert = pzk_element()->getAlert();
						$alert->setTitle('Bạn chưa làm đề này!');
					$this->display();
					pzk_system()->halt();
				}	
				
			
				
			
		}else{
			//chua dang nhap
			$camp = intval(pzk_request()->getSegment(3));
			$this->initPage();
				pzk_page()->setTitle('Đăng nhập thi thử trường Trần Đại Nghĩa');
				pzk_page()->setKeywords('Đăng nhập thi thử trường Trần Đại Nghĩa');
				pzk_page()->setDescription('Đăng nhập thi thử vao trường Trần Đại nghĩa với phần mềm Full Look');
				pzk_page()->setImg('/Default/skin/nobel/Themes/Story/media/logo.png');
				pzk_page()->setBrief('Công Ty Cổ Phần Giáo Dục Phát Triển Trí Tuệ Và Sáng Tạo Next Nobels');
				$this->append('showresult/login', 'wrapper');
				$login = pzk_element()->getLogin();
				$login->setRel("/contest/showresult/".$camp);
				$login->setTitle('thì mới xem được kết quả!');
			$this->display();
			pzk_system()->halt();
		}
	}
	public function ratingAction() {
		$testId = intval(pzk_request()->getSegment(3));
		
        $this->initPage();
        $this->append('showresult/testrating', 'wrapper');
		$rank= pzk_element('testRating');
		$rank->setTestId($testId);
	    $rank->setPageSize(20);
		$this->display();
    }
	public function getStudentAction() {
		$class = intval(pzk_request()->getSegment(3));
		if($class == 4 or $class == 5) {
			$this->initPage();
			$this->append('showresult/resulttest', 'wrapper');
			$resulttest= pzk_element('resulttest');
			$resulttest->setClass($class);
			$resulttest->setPageSize(20);
			$this->display();
		}
		
	}
   
}