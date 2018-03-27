<?php 
/**
* 
*/
class PzkEntityEducationClassroomModel extends PzkEntityModel
{
	public $table 		= "education_classroom";
	
	public function getUserbooks($homeworkId) {
		$students = $this->getClassroomStudents();
		$studentIds = array_map(function($student) {
			return $student->get('studentId');
		}, $students);
		return _db()->selectAll()->fromUser_book()->whereTestId($homeworkId)->inUserId($studentIds)->result('Education.Userbook');
	}
	
	public function getClassroomStudents() {
		return _db()->selectAll()->fromEducation_classroom_student()->whereClassroomId($this->get('id'))->result('Education.Classroom.Student');
	}
	
	public function getSubjectAndTeachers() {
		
	}
}