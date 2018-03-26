<?php
class PzkAdminEducationScheduleLecture extends PzkObject {
	public $layout = 'admin/education/schedule/lecture';
	public $classroomId;
	private $_classroom = false;
	public function getClassroom() {
		if($this->_classroom) return $this->_classroom;
		return $this->_classroom = _db()->select('*')->from('education_classroom')->where(array('id', $this->get('classroomId')))->result_one();
	}
	
	public function getSubjects() {
		$classroom = $this->getClassroom();
		return _db()->select('*')->from('categories')->whereType('subject')->whereClasses(','.$classroom['gradeNum'] . ',')->result();
	}
}