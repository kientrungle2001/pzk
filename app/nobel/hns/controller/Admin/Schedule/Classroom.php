<?php
class PzkAdminScheduleClassroomController extends PzkBackendController {
	public function indexAction() {
		$this->initPage();
		$classrooms = $this->parse('admin/schedule/classrooms');
		$this->append($classrooms);
		$this->display();
	}
	public function teachersAction($classroomId) {
		$this->initPage();
		$teachers = $this->parse('admin/schedule/classroom/teachers');
		$teachers->set('classroomId', $classroomId);
		$this->append($teachers);
		$this->display();
	}
	
	public function studentsAction($classroomId) {
		$this->initPage();
		$classroom = $this->parse('admin/schedule/classroom/students');
		$this->append($classroom);
		$this->display();
	}
}