<?php
class PzkAdminEducationScheduleBooks extends PzkObject {
	public $layout = 'admin/education/schedule/books';
	public $classroomId;
	private $_classroom = false;
	public function getClassroom() {
		if($this->_classroom) return $this->_classroom;
		$this->_classroom = _db()->select('*')->from('education_classroom')->whereId($this->get('classroomId'))->result_one();
		return $this->_classroom;
	}
	
	public function getClassrooms() {
		return _db()->select('*')->from('education_classroom')->result();
	}
	
	public function getHomeworks() {
		return _db()->select('education_classroom_homework.*, tests.name as name, tests.teacherIds')
		->from('education_classroom_homework')
		->join('tests', 'education_classroom_homework.homeworkId = tests.id')
		->whereClassroomId($this->get('classroomId'))->result();
	}
	
}