<?php
class PzkGameController extends PzkController {
	public $masterPage='index';
	public $masterPosition='left';
	
	
	public function gamehomeAction()
	{
		$this->initPage()->append('game/gamehome')->display();
	}
	public function rainwordAction()
	{
		//$this->initPage()->append('game/rainword')->display();
        $this->initPage();
        $this->append('game/rainword', 'left');
        $this->display();
	}

	public function subrainwordAction()
	{
		$this->initPage()->append('game/subrainword')->display();
	}
	public function playgameAction()
	{
		$this->initPage()->append('game/playgame')->display();
	}
	public function hookwordAction()
	{
		$this->initPage()->append('game/hookword')->display();
	}
    public function ptnnAction()
    {
        $request = pzk_request();
        $gameType = $request->getGameType();

        $this->initPage();
        $this->append('game/formGame', 'left');
            if($gameType) {
                if ($gameType == 'muatu') {
                    $this->append('game/rainword', 'left');
                } else {
                    $this->append('game/gameOther', 'left');
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

}
?>