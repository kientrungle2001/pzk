<?php
class PzkAdminScheduleLectureController extends PzkBackendController {
	public function indexAction($classroomId) {
		$this->initPage();
		$schedule = $this->parse('admin/schedule/lecture');
		$schedule->setClassroomId( $classroomId);
		$this->append($schedule);
		$this->display();
	}
	
	public function topicsAction($classroomId, $subjectId) {
		//$this->initPage();
		$schedule = $this->parse('admin/schedule/lecture/subject');
		$schedule->setClassroomId( $classroomId);
		$schedule->setSubjectId( $subjectId);
		$schedule->display();
		//$this->display();
	}
}