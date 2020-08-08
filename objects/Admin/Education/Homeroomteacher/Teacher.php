<?php
class PzkAdminEducationHomeroomteacherTeacher extends PzkObject {
	public $layout = 'admin/homeroomteacher/teacher';
	public $classroomId;
	private $_classroom = false;
	public function getClassroom() {
		if($this->_classroom) return $this->_classroom;
		return $this->_classroom = _db()->select('*')->from('education_classroom')->where(array('id', $this->getClassroomId()))->result_one();
	}
	
	public function getClassrooms() {
		return _db()->select('*')->from('education_classroom')->result();
	}
	
	public function getStudents() {
		return _db()->select('education_classroom_student.id,user.id as studentId, user.name, user.username, user.birthday')->from('education_classroom_student')
		->join('user', 'education_classroom_student.studentId=user.id')
		->whereClassroomId($this->getClassroomId())->result();
	}
	public function getHomeroomTeacher() {
		return _db()->select('education_classroom.HomeroomTeacherId,admin.id as teacherId, admin.name, admin.fullName, admin.phone')->from('education_classroom')
		->join('admin', 'education_classroom.HomeroomTeacherId=admin.id')	
		->where('education_classroom.id= '.$this->getClassroomId())->result_one();
	}
	public function getTeachers() {
		return _db()->select('education_classroom_teacher.id,admin.id as teacherId, admin.name, admin.fullName, admin.phone, categories.name as subjectName,categories.id as subjectId')->from('education_classroom_teacher')
		->join('admin', 'education_classroom_teacher.teacherId=admin.id')
		->join('categories', 'education_classroom_teacher.subjectId=categories.id')
		->whereClassroomId($this->getClassroomId())->result();
	}
}