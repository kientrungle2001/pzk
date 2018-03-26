<?php
class PzkAdminEducationScheduleHomeworks extends PzkObject {
	public $layout = 'admin/education/schedule/homeworks';
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
		return _db()->select('education_classroom_homework.*, tests.teacherIds, tests.name as name, categories.name as subject, tests.week, tests.month, tests.semester')
		->from('education_classroom_homework')
		->join('tests', 'education_classroom_homework.homeworkId = tests.id')
		->leftJoin('categories', 'tests.subjectId=categories.id')
		->whereClassroomId($this->get('classroomId'))
		->orderBy('tests.id desc')
		->result();
	}
	
}