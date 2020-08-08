<?php
class PzkAdminEducationHeadmasterListstudent extends PzkObject {
	public $layout = 'admin/education/headmaster/liststudent';
	public function getStudents(){
		 $listStudents = array();
		 if($this->getSchoolYear() || $this->getClass() || $this->getClassname()){
				 $query = _db()->select('user.*')->from('user');
				 $query->join('education_classroom_student', 'education_classroom_student.studentId = user.id')
				 ->join('education_classroom', 'education_classroom.id = education_classroom_student.classroomId');
				 
				 if($this->getSchoolYear()){
					  $query->whereSchoolYear($this->getSchoolYear());
				 }
				  if($this->getClass()){
					  $query->where('education_classroom.gradeNum = '.$this->getClass());
				 }
				  if($this->getClassName()){
					  $query->where('education_classroom.className = "'.$this->getClassName().'"');
				 }
				 
				 $listStudents = $query->result();
			}
			 
			
			 
		return $listStudents;	 
	}
}
?>