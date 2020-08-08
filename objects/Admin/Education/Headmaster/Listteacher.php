<?php
class PzkAdminEducationHeadmasterListteacher extends PzkObject {
	public $layout = 'admin/education/headmaster/listteacher';
	public function getTeachers(){
		 $listTeachers = array();
		 if($this->getSchoolYear() || $this->getClass() || $this->getClassname() || $this->getSubject()){
				 
				 $query = _db()->select('admin.*')->from('admin');
				 
				 $query->join('education_classroom_teacher', 'education_classroom_teacher.teacherId = admin.id')
				 ->join('education_classroom', 'education_classroom.id = education_classroom_teacher.classroomId');
				 
				 if($this->getSchoolYear()){
					  $query->whereSchoolYear($this->getSchoolYear());
				 }
				  if($this->getClass()){
					  $query->where('education_classroom.gradeNum = '.$this->getClass());
				 }
				  if($this->getNameOfClass()){
					  $query->where('education_classroom.className = "'.$this->getNameOfClass().'"');
				 }
				 if($this->getSubject()){
					  $query->where('education_classroom_teacher.subjectId = "'.$this->getSubject().'"');
				 }
				 
				  $listTeachers = $query->whereUsertype_id(5)->result();
				 
			 }
			 
			
			
		return $listTeachers;	 
	}
}
?>