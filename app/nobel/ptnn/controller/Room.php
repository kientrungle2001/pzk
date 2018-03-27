<?php
class PzkRoomController extends PzkController {
	public $masterPage = 'index';
	public $masterPosition = 'left';
	public function joinAction($id) {
		$this->layout();
		$room = $this->parse('room/join');
		$room->setRoomId($id);
		$this->append($room);
		$this->display();
	}
	
	public function membersAction($id) {
		$room = $this->parse('room/join');
		$room->setRoomId($id);
		$room->setScriptable(false);
		$room->setDisplayMembers(true);
		$room->display();
	}
}