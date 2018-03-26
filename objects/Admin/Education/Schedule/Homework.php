<?php
class PzkAdminEducationScheduleHomework extends PzkObject {
	public $layout = 'admin/education/schedule/homework';
	public $classroomId;
	private $_classroom = false;
	private $_classroomStudents = false;
	
	public function getClassroom() {
		if($this->_classroom) return $this->_classroom;
		$this->_classroom = _db()->select('*')->from('education_classroom')->whereId($this->get('classroomId'))->result_one();
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
	
	public function getHomework() {
		return _db()->select('tests.*, categories.name as subject')->from('tests')->join('categories', 'tests.subjectId=categories.id')->where('tests.id='.$this->get('homeworkId'))->result_one();
	}
	
	public function getAutoQuestions() {
		return _db()->select('*')->fromQuestions()->where('questionType=1 or (questionType=4 and auto=1)')->likeTestId('%,'.$this->get('homeworkId').',%')->result();
	}
	
	public function countRight($questionId, $studentIds) {
		$row = _db()->select('count(*) as c')->fromUser_answers()
			->joinUser_book('user_answers.user_book_id = user_book.id')
			->whereQuestionId($questionId)
			->where('user_answers.mark <> 0')
			->where('user_book.testId =' .$this->get('homeworkId'))
			->inUserId($studentIds)
			->result_one();
		return $row['c'];
	}
	
	public function getHomeworks() {
		return _db()->select('education_classroom_homework.*, tests.name as name, tests.teacherIds')
		->from('education_classroom_homework')
		->join('tests', 'education_classroom_homework.homeworkId = tests.id')
		->whereClassroomId($this->get('classroomId'))
		->result();
	}
	
	public function getClassroomStudents() {
		if($this->_classroomStudents) return $this->_classroomStudents;
		return $this->_classroomStudents = _db()
			->select('education_classroom_student.*, user.username, user.name')
			->from('education_classroom_student')
			->join('user', 'education_classroom_student.studentId=user.id')
			->whereClassroomId($this->get('classroomId'))->result();
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
			->whereTestId($this->get('homeworkId'))
			->whereHomeworkStatus(1)
			->orderBy('user_book.id asc')
			->result();
		return $userBooks;
	}
}