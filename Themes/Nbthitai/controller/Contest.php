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
						pzk_page()->set('title', 'Kết quả thi thử trường Trần Đại Nghĩa');
						pzk_page()->set('keywords', 'Kết quả thi thử trường Trần Đại Nghĩa');
						pzk_page()->set('description', 'Kêt quả thi thử vao trường Trần Đại nghĩa với phần mềm Full Look');
						pzk_page()->set('img', '/Default/skin/nobel/Themes/Story/media/logo.png');
						pzk_page()->set('brief', 'Công Ty Cổ Phần Giáo Dục Phát Triển Trí Tuệ Và Sáng Tạo Next Nobels');
						$this->append('showresult/showresult', 'wrapper');
						
						//get rate
						$rate = $frontend->getRateTt($userbook['id'], $testId);
						//data cau trac nghiem
						$showQuestionTn = $userBookModel->getQuestionByTrytestId($testId);
						
						$showresult = pzk_element('showresult');
						//set showQuestionTn
						$showresult->set('showQuestionTn', $showQuestionTn);
						
						//xu li bai trac nghiem
						$showresult->set('userBookIdTn', $userbook['id']);
						//set rate
						$showresult->set('rate', $rate);
						//dulieu hoc sinh
						$showresult->set('userInfo', $userInfo);
						//diem thi trac nghiem
						$scoreTn = $userbook['mark'];
						$showresult->set('testId', $testId);
						$showresult->set('scoretn', $scoreTn);
						
							
					$this->display();
					pzk_system()->halt();
				}else{
					$this->initPage();
						pzk_page()->set('title', 'Chưa làm đề của trung tâm');
						pzk_page()->set('keywords', 'Chưa làm đề của trung tâm');
						pzk_page()->set('description', 'Chưa làm đề của trung tâm');
						pzk_page()->set('img', '/Default/skin/nobel/Themes/Story/media/logo.png');
						pzk_page()->set('brief', 'Công Ty Cổ Phần Giáo Dục Phát Triển Trí Tuệ Và Sáng Tạo Next Nobels');
						$this->append('showresult/alert', 'wrapper');
						$alert = pzk_element()->getAlert();
						$alert->set('title', 'Bạn chưa làm đề này!');
					$this->display();
					pzk_system()->halt();
				}	
				
			
				
			
		}else{
			//chua dang nhap
			$camp = intval(pzk_request()->getSegment(3));
			$this->initPage();
				pzk_page()->set('title', 'Đăng nhập thi thử trường Trần Đại Nghĩa');
				pzk_page()->set('keywords', 'Đăng nhập thi thử trường Trần Đại Nghĩa');
				pzk_page()->set('description', 'Đăng nhập thi thử vao trường Trần Đại nghĩa với phần mềm Full Look');
				pzk_page()->set('img', '/Default/skin/nobel/Themes/Story/media/logo.png');
				pzk_page()->set('brief', 'Công Ty Cổ Phần Giáo Dục Phát Triển Trí Tuệ Và Sáng Tạo Next Nobels');
				$this->append('showresult/login', 'wrapper');
				$login = pzk_element()->getLogin();
				$login->set('rel', "/contest/showresult/".$camp);
				$login->set('title', 'thì mới xem được kết quả!');
			$this->display();
			pzk_system()->halt();
		}
	}
	public function ratingAction() {
		$testId = intval(pzk_request()->getSegment(3));
		
        $this->initPage();
        $this->append('showresult/testrating', 'wrapper');
		$rank= pzk_element('testRating');
		$rank->set('testId', $testId);
	    $rank->set('pageSize', 20);
		$this->display();
    }
	public function getStudentAction() {
		$class = intval(pzk_request()->getSegment(3));
		if($class == 4 or $class == 5) {
			$this->initPage();
			$this->append('showresult/resulttest', 'wrapper');
			$resulttest= pzk_element('resulttest');
			$resulttest->set('class', $class);
			$resulttest->set('pageSize', 20);
			$this->display();
		}
		
	}
   
}