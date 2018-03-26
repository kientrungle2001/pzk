<?php
class PzkAdminEducationHeadmasterListstudent extends PzkObject {
	public $layout = 'admin/education/headmaster/liststudent';
	public function getStudents(){
		 $listStudents = array();
		 if($this->get('schoolYear') || $this->get('class') || $this->get('classname')){
				 $query = _db()->select('user.*')->from('user');
				 $query->join('education_classroom_student', 'education_classroom_student.studentId = user.id')
				 ->join('education_classroom', 'education_classroom.id = education_classroom_student.classroomId');
				 
				 if($this->get('schoolYear')){
					  $query->whereSchoolYear($this->get('schoolYear'));
				 }
				  if($this->get('class')){
					  $query->where('education_classroom.gradeNum = '.$this->get('class'));
				 }
				  if($this->get('className')){
					  $query->where('education_classroom.className = "'.$this->get('className').'"');
				 }
				 
				 $listStudents = $query->result();
			}
			 
			
			 
		return $listStudents;	 
	}
}
?>