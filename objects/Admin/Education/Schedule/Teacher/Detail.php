<?php
class PzkAdminEducationScheduleTeacherDetail extends PzkObject {
	public $layout = 'admin/education/schedule/teacher/detail';
	private $_classroom = false;
	public function getClassroom() {
		if($this->_classroom) return $this->_classroom;
		return $this->_classroom = _db()->select('*')->from('education_classroom')->where(array('id', $this->get('classroomId')))->result_one();
	}
	public function getClassrooms() {
		return _db()->select('education_classroom.*, categories.name as subject')
			->from('education_classroom_teacher')
			->join('education_classroom', 'education_classroom_teacher.classroomId=education_classroom.id')
			->join('categories', 'education_classroom_teacher.subjectId=categories.id')
			->whereTeacherId($this->get('teacherId'))->result();
	}
	
	public function getTeacher() {
		return _db()->select('*')->from('admin')->whereId($this->get('teacherId'))->result_one();
	}
	
	public function getHomeworks() {
		return _db()->select('tests.*, categories.name as subject')->from('tests')
			->likeTeacherIds('%,'. $this->get('teacherId').',%')
			->join('categories', 'tests.subjectId=categories.id')
			->whereHomework('1')
			->result();
	}
	
	public function getTests() {
		return _db()->select('tests.*, categories.name as subject')->from('tests')
			->likeTeacherIds('%,'. $this->get('teacherId').',%')
			->join('categories', 'tests.subjectId=categories.id')
			->whereHomework('0')
			->result();
	}
	
	public function getStudentHomeworks() {
		return _db()->select('user_book.*, categories.name as subject, 
			tests.name as homeworkName, 
			tests.week, tests.month, tests.semester,
			user.name as fullName, user.username')->from('user_book')
			->join('tests', 'user_book.testId=tests.id')
			->join('categories', 'user_book.categoryId=categories.id')
			->join('user', 'user_book.userId=user.id')
			->where('tests.teacherIds like "%,'.$this->get('teacherId').',%"')
			->where('tests.homework=1')
			->orderBy('startTime desc')
			->result();
	}
}