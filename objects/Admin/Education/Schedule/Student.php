<?php
class PzkAdminEducationScheduleStudent extends PzkObject {
	public $layout = 'admin/education/schedule/student';
	public $classroomId;
	private $_classroom = false;
	public function getClassroom() {
		if($this->_classroom) return $this->_classroom;
		return $this->_classroom = _db()->select('*')->from('education_classroom')->where(array('id', $this->get('classroomId')))->result_one();
	}
	
	public function getClassrooms() {
		return _db()->select('education_classroom.*')->from('education_classroom_student')->join('education_classroom', 'education_classroom_student.classroomId=education_classroom.id')->whereStudentId($this->get('studentId'))->result();
	}
	
	public function getStudents() {
		return _db()->select('education_classroom_student.id,user.id as studentId, user.name, user.username, user.birthday')->from('education_classroom_student')
		->join('user', 'education_classroom_student.studentId=user.id')
		->whereClassroomId($this->get('classroomId'))->result();
	}
	
	public function getStudent() {
		return _db()->select('*')->from('user')->whereId($this->get('studentId'))->result_one();
	}
	public function getHomeworks() {
		return _db()->select('user_book.*, tests.name as homeworkName, tests.week, tests.month, tests.semester, categories.name as subject')->from('user_book')
			->join('tests', 'user_book.testId=tests.id')
			->join('categories', 'tests.subjectId=categories.id')
			->where('user_book.userId='.$this->get('studentId'))
			->where('tests.homework=1')
			->orderBy('tests.subjectId asc, tests.week asc')
			->result();
	}
	public function getTests() {
		return _db()->select('user_book.*, tests.name as testName, tests.week, tests.month, tests.semester, categories.name as subject')->from('user_book')
			->join('tests', 'user_book.testId=tests.id')
			->join('categories', 'tests.subjectId=categories.id')
			->where('user_book.userId='.$this->get('studentId'))
			->where('tests.homework=0')
			->orderBy('tests.subjectId asc, tests.week asc')
			->result();
	}
	public function getSubjects($gradeNum) {
		return _db()->select('*')->from('categories')
			->likeClasses('%,'.$gradeNum.',%')
			->whereType('subject')
			->where('id != 47')
			->result();
	}
}