<?php
class PzkGameController extends PzkController {
	public $masterPage='index';
	public $masterPosition='left';
	public $pageGame = 0;
	
	
	
	public function getTopicByTypeAction() {
		$request = pzk_request();
		$gametype = $request->getGametype();
		
		$this->parse('game/topic');
		$topic = pzk_element()->getTopic();	
		$topic->setTypeGame( $gametype);
		$topic->display();
		
			
		
	}
	public function getTryTopicByTypeAction() {
		$request = pzk_request();
		$gametype = $request->getGametype();
		
		$this->parse('game/trytopic');
		$topic = pzk_element()->getTrytopic();	
		$topic->setTypeGame( $gametype);
		$topic->display();
	}
    public function ptnnAction()
    {
        
		$request = pzk_request();
        $gameType = $request->getGameType();
		$check = pzk_user()->checkPayment('full');

        $this->initPage();
			pzk_page()->setTitle( 'Trò chơi');
			pzk_page()->setKeywords( 'Trò chơi');
			pzk_page()->setDescription( 'Cùng chơi game với Next Nobels');
			pzk_page()->setImg( '/Default/skin/nobel/themes/story/media/logo.png');
			pzk_page()->setBrief( 'Công Ty Cổ Phần Giáo Dục Phát Triển Trí Tuệ Và Sáng Tạo Next Nobels');
		if(pzk_session('userId')){
			
			if(isset($check) and $check==1) {
				$this->setMasterPage( 'index');
				$this->setMasterPosition( 'wrapper');
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
					$this->setMasterPage( 'index');
					$this->setMasterPosition( 'wrapper');
					$this->append("game/tryGame", 'wrapper');
					if($gameType) {
						if ($gameType == 'muatu') {
							$frontend = pzk_model('Frontend');
							$gameTopics = $frontend->getGameTopic();
							$gameTopic = $gameTopics[0]['id']; 
							$gameRqTopic = $request->getGameTopic();
							if($gameTopic == $gameRqTopic) {
								$this->append('game/ptnn', 'wrapper');
							}
						}else if($gameType == 'dragWord') {
							if(pzk_request()->isMobile()) {
								$this->append('game/vocabulary/nosupport', 'wrapper');
							}else{
								$gameRqTopic = $request->getGameTopic();
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
				$this->setMasterPage( 'index');
				$this->setMasterPosition( 'wrapper');
				$this->append("game/nologin", 'wrapper');
			}else {
				$this->append("game/nologin", 'left');
			}
		}		
			
			
		$this->display();
	}
	public function gameTypeAction() {
		$request = pzk_request();
		$gameType = $request->getGameType();
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
        if($request->getCheck() == 1){
            $topicId = $request->getGameTopic();
            $gameCode =  $request->getGamecode();
            $data = array(
                'gamecode'=> $gameCode,
                'score'=> $request->getScore(),
                'live'=> $request->getLive(),
                'gametopic'=> $topicId,
                'userId'=> pzk_session()->getUserId(),
                'software'=> pzk_request()->getSoftware(),
                'created'=> date('d:m:y H:i:s', time())
            );

            $frontendmodel = pzk_model('Frontend');
            $id = $frontendmodel->save($data, 'gamescore');
            $dataScore = $frontendmodel->gameRate('gamescore', $id, $topicId, $gameCode);
            echo json_encode($dataScore);
        }
    }
	
	public function gameVocabularyAction() {
		
		$id = Pzk_request()->getId();
		$type = Pzk_request()->getType();
		$cateId = Pzk_request()->getCateId();
		if($id && $type) {
			if($type == 'sortword') {
				if(pzk_request()->isMobile()) {
					$this->parse('game/vocabulary/nosupport');
					$nosupport = pzk_element()->getNosupport();
					$nosupport->display();
				}else{
					$this->parse('game/vocabulary/sortword');
					$sortword = pzk_element()->getSortword();
					$sortword->setDocumentId( $id);
					$sortword->setCateId( $cateId);
					$sortword->setGameCode( $type);
					$sortword->display();	
				}
				
			}elseif($type == 'dragToPart') {
				if(pzk_request()->isMobile()) {
					$this->parse('game/vocabulary/nosupport');
					$nosupport = pzk_element()->getNosupport();
					$nosupport->display();
				}else{
					
					$this->parse('game/vocabulary/dragToPart');
					$dragToPart = pzk_element()->getDragToPart();
					$dragToPart->setDocumentId($id);
					$dragToPart->setCateId($cateId);
					$dragToPart->setGameCode( $type);
					$dragToPart->display();
				}
			}elseif($type == 'vdt') {
				$this->parse('game/vocabulary/vdt');
				$vdt = pzk_element()->getVdt();
				$vdt->setDocumentId( $id);
				$vdt->setCateId( $cateId);
				$vdt->setGameCode( $type);
				$vdt->display();
			}elseif($type == 'vmt') {
				$this->parse('game/vocabulary/vmt');
				$vmt = pzk_element()->getVmt();
				$vmt->setDocumentId( $id);
				$vmt->setCateId( $cateId);
				$vmt->setGameCode( $type);
				$vmt->setPageGame( 1);
				$vmt->display();
			}elseif($type == 'vdrag') {
				if(pzk_request()->isMobile()) {
					$this->parse('game/vocabulary/nosupport');
					$nosupport = pzk_element()->getNosupport();
					$nosupport->display();
				}else{
					
					$this->parse('game/vocabulary/vdrag');
					$vdrag = pzk_element()->getVdrag();
					$vdrag->setDocumentId( $id);
					$vdrag->setCateId( $cateId);
					$vdrag->setGameCode( $type);
					$vdrag->display();
				}
			}elseif($type == 'vdragimg') {
				if(pzk_request()->isMobile()) {
					$this->parse('game/vocabulary/nosupport');
					$nosupport = pzk_element()->getNosupport();
					$nosupport->display();
				}else{
					
					$this->parse('game/vocabulary/vdragimg');
					$vdragimg = pzk_element()->getVdragimg();
					$vdragimg->setDocumentId( $id);
					$vdragimg->setCateId( $cateId);
					$vdragimg->setGameCode( $type);
					$vdragimg->display();
				}
			}else{
				die("this game dosen't support");
			}
			
		}
	}
	public function pageVdragAction() {
		$request = pzk_request();
		$id = $request->getId();
		$type = $request->getType();
		$cateId = $request->getCateId();
		$page = $request->getPage();
		if($id && $type && $page) {
			$this->parse('game/vocabulary/vdrag');
				$vdrag = pzk_element()->getVdrag();
				$vdrag->setDocumentId( $id);
				$vdrag->setGameCode( $type);
				$vdrag->setCateId( $cateId);
				$vdrag->setPageGame( $page);
				$vdrag->display();
		}
	}
	public function pageVdragimgAction() {
		$request = pzk_request();
		$id = $request->getId();
		$type = $request->getType();
		$page = $request->getPage();
		$cateId = $request->getCateId();
		if($id && $type && $page) {
			$this->parse('game/vocabulary/vdragimg');
				$vdragimg = pzk_element()->getVdragimg();
				$vdragimg->setDocumentId( $id);
				$vdragimg->setGameCode( $type);
				$vdragimg->setCateId( $cateId);
				$vdragimg->setPageGame( $page);
				$vdragimg->display();
		}
	}
	public function pageVmtAction() {
		$request = pzk_request();
		$id = $request->getId();
		$type = $request->getType();
		$page = $request->getPage();
		$cateId = $request->getCateId();
		if($id && $type && $page) {
			$this->parse('game/vocabulary/vmt');
				$vmt = pzk_element()->getVmt();
				$vmt->setDocumentId( $id);
				$vmt->setGameCode( $type);
				$vmt->setCateId( $cateId);
				$vmt->setPageGame( $page);
				$vmt->display();
		}
	}
	public function saveGameVocabunaryAction(){
		$request = pzk_request();
		$gameCode = $request->getGameCode();
		$trueWords = $request->getTrueWords();
		$score = $request->getScore();
		$totalWord = $request->getTotalWord();
		$userId = pzk_session()->getUserId();
		$cateId= $request->getCateId();
		
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
			'software' => pzk_request()->getSoftware(),
			'documentId' =>  pzk_request()->getDocumentId(),
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