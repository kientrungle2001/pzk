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
        $request = pzk_element('request');
        $gameType = $request->get('gameType');

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
        $request = pzk_element('request');
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
        $request = pzk_element('request');
        if($request->get('check') == 1){
            $topicId = $request->get('gameTopic');
            $gameCode =  $request->get('gamecode');
            $data = array(
                'gamecode'=> $gameCode,
                'score'=> $request->get('score'),
                'live'=> $request->get('live'),
                'gametopic'=> $topicId,
                'userId'=> pzk_session()->getUserId(),
                'software'=> pzk_request('software'),
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