<?php
class PzkGameController extends PzkController {
	public $masterPage='index';
	public $masterPosition='left';
	public $pageGame = 0;
	
	
	
	public function getTopicByTypeAction() {
		$request = pzk_request();
		$gametype = $request->get('gametype');
		
		$this->parse('game/topic');
		$topic = pzk_element('topic');	
		$topic->set('typeGame', $gametype);
		$topic->display();
		
			
		
	}
	public function getTryTopicByTypeAction() {
		$request = pzk_request();
		$gametype = $request->get('gametype');
		
		$this->parse('game/trytopic');
		$topic = pzk_element('trytopic');	
		$topic->set('typeGame', $gametype);
		$topic->display();
	}
    public function ptnnAction()
    {
        
		$request = pzk_request();
        $gameType = $request->get('gameType');
		$check = pzk_user()->checkPayment('full');

        $this->initPage();
			pzk_page()->set('title', 'Trò chơi');
			pzk_page()->set('keywords', 'Trò chơi');
			pzk_page()->set('description', 'Cùng chơi game với Next Nobels');
			pzk_page()->set('img', '/Default/skin/nobel/themes/story/media/logo.png');
			pzk_page()->set('brief', 'Công Ty Cổ Phần Giáo Dục Phát Triển Trí Tuệ Và Sáng Tạo Next Nobels');
		if(pzk_session('userId')){
			
			if(isset($check) and $check==1) {
				$this->set('masterPage', 'index');
				$this->set('masterPosition', 'wrapper');
				$this->append('game/formGame', 'wrapper');
				if($gameType) {
					if ($gameType == 'muatu') {
						$this->append('game/ptnn', 'wrapper');
					} 
					else if($gameType == 'dragWord') {
						if(pzk_request()->isMobile()) {
							$this->append('game/vocabulary/nosupport', 'wrapper');
						}else{
							$this->append('game/dragWord', 'wrapper');	
						}
						
					}
					else {
						$this->append('game/gameOther', 'wrapper');
					}
				}

				
			} else {
				if(1 || pzk_themes('default')) {
					$this->set('masterPage', 'index');
					$this->set('masterPosition', 'wrapper');
					$this->append("game/tryGame", 'wrapper');
					if($gameType) {
						if ($gameType == 'muatu') {
							$frontend = pzk_model('Frontend');
							$gameTopics = $frontend->getGameTopic();
							$gameTopic = $gameTopics[0]['id']; 
							$gameRqTopic = $request->get('gameTopic');
							if($gameTopic == $gameRqTopic) {
								$this->append('game/ptnn', 'wrapper');
							}
						}else if($gameType == 'dragWord') {
							if(pzk_request()->isMobile()) {
								$this->append('game/vocabulary/nosupport', 'wrapper');
							}else{
								$gameRqTopic = $request->get('gameTopic');
								if($gameRqTopic == 19) {
									$this->append('game/dragWord', 'wrapper');
								}
							}			
						} else {
							$this->append('game/gameOther', 'wrapper');
						}
					}
				}else {
					$this->append("game/tryGame", 'left');
				}
			}
		}else{
			if(1 || pzk_themes('default')) {
				$this->set('masterPage', 'index');
				$this->set('masterPosition', 'wrapper');
				$this->append("game/nologin", 'wrapper');
			}else {
				$this->append("game/nologin", 'left');
			}
		}		
			
			
		$this->display();
	}
	public function gameTypeAction() {
		$request = pzk_request();
		$gameType = $request->get('gameType');
		$this->initPage();
		//echo $gameType;
		if($gameType == 'muatu') {
			$this->append('game/rainword', 'left');
		}else{
			$this->append('game/gameOther', 'left');
		}
        $this->display();
    }
    public function saveAction() {
        $request = pzk_request();
        if($request->get('check') == 1){
            $topicId = $request->get('gameTopic');
            $gameCode =  $request->get('gamecode');
            $data = array(
                'gamecode'=> $gameCode,
                'score'=> $request->get('score'),
                'live'=> $request->get('live'),
                'gametopic'=> $topicId,
                'userId'=> pzk_session()->get('userId'),
                'software'=> pzk_request('software'),
                'created'=> date('d:m:y H:i:s', time())
            );

            $frontendmodel = pzk_model('Frontend');
            $id = $frontendmodel->save($data, 'gamescore');
            $dataScore = $frontendmodel->gameRate('gamescore', $id, $topicId, $gameCode);
            echo json_encode($dataScore);
        }
    }
	
	public function gameVocabularyAction() {
		
		$id = Pzk_request()->get('id');
		$type = Pzk_request()->get('type');
		$cateId = Pzk_request()->get('cateId');
		if($id && $type) {
			if($type == 'sortword') {
				if(pzk_request()->isMobile()) {
					$this->parse('game/vocabulary/nosupport');
					$nosupport = pzk_element('nosupport');
					$nosupport->display();
				}else{
					$this->parse('game/vocabulary/sortword');
					$sortword = pzk_element('sortword');
					$sortword->set('documentId', $id);
					$sortword->set('cateId', $cateId);
					$sortword->set('gameCode', $type);
					$sortword->display();	
				}
				
			}elseif($type == 'dragToPart') {
				if(pzk_request()->isMobile()) {
					$this->parse('game/vocabulary/nosupport');
					$nosupport = pzk_element('nosupport');
					$nosupport->display();
				}else{
					
					$this->parse('game/vocabulary/dragToPart');
					$dragToPart = pzk_element('dragToPart');
					$dragToPart->set('documentId',$id);
					$dragToPart->set('cateId',$cateId);
					$dragToPart->set('gameCode', $type);
					$dragToPart->display();
				}
			}elseif($type == 'vdt') {
				$this->parse('game/vocabulary/vdt');
				$vdt = pzk_element('vdt');
				$vdt->set('documentId', $id);
				$vdt->set('cateId', $cateId);
				$vdt->set('gameCode', $type);
				$vdt->display();
			}elseif($type == 'vmt') {
				$this->parse('game/vocabulary/vmt');
				$vmt = pzk_element('vmt');
				$vmt->set('documentId', $id);
				$vmt->set('cateId', $cateId);
				$vmt->set('gameCode', $type);
				$vmt->set('pageGame', 1);
				$vmt->display();
			}elseif($type == 'vdrag') {
				
				$this->parse('game/vocabulary/vdrag');
				$vdrag = pzk_element('vdrag');
				$vdrag->set('documentId', $id);
				$vdrag->set('cateId', $cateId);
				$vdrag->set('gameCode', $type);
				$vdrag->display();
				
			}elseif($type == 'vdragimg') {
				if(pzk_request()->isMobile()) {
					$this->parse('game/vocabulary/nosupport');
					$nosupport = pzk_element('nosupport');
					$nosupport->display();
				}else{
					
					$this->parse('game/vocabulary/vdragimg');
					$vdragimg = pzk_element('vdragimg');
					$vdragimg->set('documentId', $id);
					$vdragimg->set('cateId', $cateId);
					$vdragimg->set('gameCode', $type);
					$vdragimg->display();
				}
			}else{
				die("this game dosen't support");
			}
			
		}
	}
	public function pageVdragAction() {
		$request = pzk_request();
		$id = $request->get('id');
		$type = $request->get('type');
		$cateId = $request->get('cateId');
		$page = $request->get('page');
		if($id && $type && $page) {
			$this->parse('game/vocabulary/vdrag');
				$vdrag = pzk_element('vdrag');
				$vdrag->set('documentId', $id);
				$vdrag->set('gameCode', $type);
				$vdrag->set('cateId', $cateId);
				$vdrag->set('pageGame', $page);
				$vdrag->display();
		}
	}
	public function pageVdragimgAction() {
		$request = pzk_request();
		$id = $request->get('id');
		$type = $request->get('type');
		$page = $request->get('page');
		$cateId = $request->get('cateId');
		if($id && $type && $page) {
			$this->parse('game/vocabulary/vdragimg');
				$vdragimg = pzk_element('vdragimg');
				$vdragimg->set('documentId', $id);
				$vdragimg->set('gameCode', $type);
				$vdragimg->set('cateId', $cateId);
				$vdragimg->set('pageGame', $page);
				$vdragimg->display();
		}
	}
	public function pageVmtAction() {
		$request = pzk_request();
		$id = $request->get('id');
		$type = $request->get('type');
		$page = $request->get('page');
		$cateId = $request->get('cateId');
		if($id && $type && $page) {
			$this->parse('game/vocabulary/vmt');
				$vmt = pzk_element('vmt');
				$vmt->set('documentId', $id);
				$vmt->set('gameCode', $type);
				$vmt->set('cateId', $cateId);
				$vmt->set('pageGame', $page);
				$vmt->display();
		}
	}
	public function saveGameVocabunaryAction(){
		$request = pzk_request();
		$gameCode = $request->get('gameCode');
		$trueWords = $request->get('trueWords');
		$score = $request->get('score');
		$totalWord = $request->get('totalWord');
		$userId = pzk_session()->get('userId');
		$cateId= $request->get('cateId');
		
		if($gameCode == 'vdt'){
			if(count($trueWords)> 0){
			$trueWords = json_encode($trueWords);	
			}else{
				$trueWords = "[]";
			}
		}elseif($gameCode == 'vdrag') {
			$addScore = 0;
			foreach($score as $val) {
				$addScore = $addScore + $val;
			}
			$score = $addScore;
			
			$merged = array();
			if(count($trueWords) == 1 ){
				foreach($trueWords as $word){
					$merged = $word;
				}
			}elseif(count($trueWords)> 1) {
				foreach($trueWords as $word){
					$merged = array_merge($merged, $word);
				}
				
			}
			
			if(count($merged)> 0){
				$trueWords = json_encode($merged);	
			}else{
				$trueWords = "[]";
			}
		}elseif($gameCode == 'vdragimg') {
			$addScore = 0;
			foreach($score as $val) {
				$addScore = $addScore + $val;
			}
			$score = $addScore;
			
			$merged = array();
			if(count($trueWords) == 1 ){
				foreach($trueWords as $word){
					$merged = $word;
				}
			}elseif(count($trueWords)> 1) {
				foreach($trueWords as $word){
					$merged = array_merge($merged, $word);
				}
				
			}
			
			if(count($merged)> 0){
				$trueWords = json_encode($merged);	
			}else{
				$trueWords = "[]";
			}
		}elseif($gameCode == 'vmt' || $gameCode == 'sortword') {
			
			if(count($trueWords)> 0){
				$trueWords = json_encode($trueWords);	
			}else{
				$trueWords = "[]";
			}
		}
		
		$data = array(
			'gamecode' => $gameCode,
			'score' => $score,
			'userId' => $userId,
			'software' => pzk_request('software'),
			'documentId' =>  pzk_request()->get('documentId'),
			'trueWords' =>  $trueWords,
			'totalWord' => $totalWord,
			'categoryId' => $cateId,
			'created' => date(DATEFORMAT, time())
		);
		//debug($data);die();
		$frontendmodel = pzk_model('Frontend');
		$frontendmodel->save($data, 'gamescore');
		//log game
		//session user
		$username = pzk_session('username');
		$name = pzk_session('name');
		$areacode = pzk_session('areacode');
		$district = pzk_session('district');
		$school = pzk_session('school');
		$class = pzk_session('class');
		$className = pzk_session('classname');
		$checkUser = pzk_session('checkUser');
		$servicePackage = pzk_session('servicePackage');
		pzk_stat()->logGame($userId, $username, $name, $score, $totalWord, $areacode, $district, $school, $class, $className, $checkUser);
		
		$data = json_encode(array(
			'trueWords' => $trueWords,
			'score' => $score,
			'totalWord' => $totalWord
		));
		echo $data;
	}
}
?>