<?php
class PzkAdminScheduleLectureController extends PzkBackendController {
	public function indexAction($classroomId) {
		$this->initPage();
		$schedule = $this->parse('admin/schedule/lecture');
		$schedule->set('classroomId', $classroomId);
		$this->append($schedule);
		$this->display();
	}
	
	public function topicsAction($classroomId, $subjectId) {
		//$this->initPage();
		$schedule = $this->parse('admin/schedule/lecture/subject');
		$schedule->set('classroomId', $classroomId);
		$schedule->set('subjectId', $subjectId);
		$schedule->display();
		//$this->display();
	}
}