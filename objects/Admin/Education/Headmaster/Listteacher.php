<?php
class PzkAdminEducationHeadmasterListteacher extends PzkObject {
	public $layout = 'admin/education/headmaster/listteacher';
	public function getTeachers(){
		 $listTeachers = array();
		 if($this->get('schoolYear') || $this->get('class') || $this->get('classname') || $this->get('subject')){
				 
				 $query = _db()->select('admin.*')->from('admin');
				 
				 $query->join('education_classroom_teacher', 'education_classroom_teacher.teacherId = admin.id')
				 ->join('education_classroom', 'education_classroom.id = education_classroom_teacher.classroomId');
				 
				 if($this->get('schoolYear')){
					  $query->whereSchoolYear($this->get('schoolYear'));
				 }
				  if($this->get('class')){
					  $query->where('education_classroom.gradeNum = '.$this->get('class'));
				 }
				  if($this->get('nameOfClass')){
					  $query->where('education_classroom.className = "'.$this->get('nameOfClass').'"');
				 }
				 if($this->get('subject')){
					  $query->where('education_classroom_teacher.subjectId = "'.$this->get('subject').'"');
				 }
				 
				  $listTeachers = $query->whereUsertype_id(5)->result();
				 
			 }
			 
			
			
		return $listTeachers;	 
	}
}
?>