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
		$this->initPage()->append('game/rainword')->display();
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



}
?>