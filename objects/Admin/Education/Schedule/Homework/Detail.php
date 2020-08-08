<?php
class PzkAdminEducationScheduleHomeworkDetail extends PzkObject {
	public $layout = 'admin/education/schedule/homework/detail';
	public $classroomId;
	private $_classroom = false;
	private $_classroomStudents = false;
	
	public function getClassroom() {
		if($this->_classroom) return $this->_classroom;
		$this->_classroom = _db()->select('*')->from('education_classroom')->whereId($this->getClassroomId())->result_one();
		return $this->_classroom;
	}
	
	public function getClassrooms() {
		return _db()->select('*')->from('education_classroom')->result();
	}
	
	public function getSameGradeClassrooms() {
		$classroom = $this->getClassroom();
		$gradeNum = $classroom['gradeNum'];
		return _db()->select('*')->from('education_classroom')->whereGradeNum($gradeNum)->result();
	}
	
	public function getClassroomsHasHomework() {
		return _db()->select('*')->from('education_classroom_homework')->whereHomeworkId($this->getHomeworkId())->result();
	}
	
	public function getHomeworks() {
		return _db()->select('education_classroom_homework.*, tests.name as name')
		->from('education_classroom_homework')
		->join('tests', 'education_classroom_homework.homeworkId = tests.id')
		->whereClassroomId($this->getClassroomId())
		->result();
	}
	
	public function getHomework() {
		return _db()->select('tests.*, categories.name as subject')->from('tests')->leftJoin('categories', 'tests.subjectId=categories.id')->where('tests.id='.$this->getHomeworkId())->result_one();
	}
	
	public function getClassroomStudents() {
		if($this->_classroomStudents) return $this->_classroomStudents;
		return $this->_classroomStudents = _db()
			->select('education_classroom_student.*, user.username, user.name')
			->from('education_classroom_student')
			->join('user', 'education_classroom_student.studentId=user.id')
			->whereClassroomId($this->getClassroomId())->result();
	}
	
	public function getClassroomHomeworks() {
		$students 		= 	$this->getClassroomStudents();
		$studentIds 	= 	array_map(function($student) {
			return $student['studentId'];
		}, $students);
		$userBooks 		=	_db()
			->select('user_book.*, user.username, user.name')
			->fromUser_book()
			->join('user', 'user_book.userId=user.id')
			->inUserId($studentIds)
			->whereTestId($this->getHomeworkId())
			->orderBy('user_book.id asc')
			->result();
		return $userBooks;
	}
	public function getStudentsOfClassroom($classroomId) {
		return _db()
			->select('education_classroom_student.*, user.username, user.name')
			->from('education_classroom_student')
			->join('user', 'education_classroom_student.studentId=user.id')
			->whereClassroomId($classroomId)->result();
	}
	public function getStudentHomeworks($classroomId, $students) {
		$studentIds 	= 	array_map(function($student) {
			return $student['studentId'];
		}, $students);
		$userBooks 		=	_db()
			->select('user_book.*, user.username, user.name')
			->fromUser_book()
			->join('user', 'user_book.userId=user.id')
			->inUserId($studentIds)
			->whereTestId($this->getHomeworkId())
			->orderBy('user_book.id asc')
			->result();
		return $userBooks;
	}
	public function getSubjects($gradeNum) {
		return _db()->select('*')->from('categories')
			->likeClasses('%,'.$gradeNum.',%')
			->whereType('subject')
			->where('id != 47')
			->result();
	}
	public function getQuestions() {
		return _db()->select('*')->fromQuestions()->likeTestId('%,'.$this->getHomeworkId().',%')
			->whereStatus(1)->result();
	}
}