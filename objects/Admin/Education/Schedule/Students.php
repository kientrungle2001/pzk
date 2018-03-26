<?php
class PzkAdminEducationScheduleStudents extends PzkObject {
	public $layout = 'admin/education/schedule/students';
	public $classroomId;
	private $_classroom = false;
	public function getClassroom() {
		if($this->_classroom) return $this->_classroom;
		return $this->_classroom = _db()->select('*')->from('education_classroom')->where(array('id', $this->get('classroomId')))->result_one();
	}
	
	public function getClassrooms() {
		return _db()->select('*')->from('education_classroom')->result();
	}
	
	public function getStudents() {
		return _db()->select('education_classroom_student.id,user.id as studentId, user.name, user.username, user.birthday')->from('education_classroom_student')
		->join('user', 'education_classroom_student.studentId=user.id')
		->whereClassroomId($this->get('classroomId'))->result();
	}
	
}