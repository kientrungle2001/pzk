<?php
class PzkAdminEducationHeadmasterListcomplete extends PzkObject {
	public $layout = 'admin/education/headmaster/listcomplete';
	
	public $classroomId;
	private $_classroom = false;
	public function getClassroom() {
		if($this->_classroom) return $this->_classroom;
		return $this->_classroom = _db()->select('*')->from('education_classroom')->where(array('id', $this->get('classroomId')))->result_one();
	}
	
	public function getClassrooms() {
		return _db()->select('education_classroom.*')->from('education_classroom_student')->join('education_classroom', 'education_classroom_student.classroomId=education_classroom.id')->whereStudentId($this->get('studentId'))->result();
	}
	
	public function countStudents() {
		$data = _db()->select('count(*) as total')->from('education_classroom_student')
		->join('user', 'education_classroom_student.studentId=user.id')
		->whereClassroomId($this->get('classroomId'))->result_one();
		return $data['total'];
	}
	
	public function getStudentIds() {
		$data = _db()->select('studentId')->from('education_classroom_student')
		->join('user', 'education_classroom_student.studentId=user.id')
		->whereClassroomId($this->get('classroomId'))->result();
		return array_map(function($r){
			return $r['studentId'];
		}, $data);
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
	public function countStudentHomework($schooolYear, $grade, $classname, $week, $subjectId){
		$studentIds = $this->getStudentIds();
		$data = _db()->select('count(*) as total')
				->fromUser_book()
				->whereSchoolYear($schooolYear)
				->whereClass($grade)
				->likeClassname('%,'.$classname.',%')
				->whereWeek($week)
				->whereCategoryId($subjectId)
				->whereHomeworkStatus(1)
				->inUserId($studentIds)
				->result_one();
		return $data['total'];		
	}
	
	public function countStudentHomeworkMarked($schooolYear, $grade, $classname, $week, $subjectId){
		$studentIds = $this->getStudentIds();
		$data = _db()->select('count(*) as total')
				->fromUser_book()
				->whereSchoolYear($schooolYear)
				->whereClass($grade)
				->likeClassname('%,'.$classname.',%')
				->whereWeek($week)
				->whereCategoryId($subjectId)
				->whereHomeworkStatus(1)
				->inUserId($studentIds)
				->whereStatus(1)
				->result_one();
		return $data['total'];		
	}
	
	
}