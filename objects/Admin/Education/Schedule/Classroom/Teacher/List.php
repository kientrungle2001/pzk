<?php
class PzkAdminEducationScheduleClassroomTeacherList extends PzkObject {
	public $layout = 'admin/education/schedule/classroom/teacher/list';
	public function getTeachers() {
		$teachers = null;
		if(pzk_session()->getAdminLevel() == 'Headmaster') {
			$teachers = _db()->select('education_classroom_teacher.*, admin.name as name, categories.name as subject')->from('education_classroom_teacher')
				->join('admin', 'education_classroom_teacher.teacherId = admin.id')
				->join('categories', 'education_classroom_teacher.subjectId = categories.id')
				->whereClassroomId($this->getClassroomId())->result();
		} else {
			$teachers = _db()->select('education_classroom_teacher.*, admin.name as name, categories.name as subject')->from('education_classroom_teacher')
				->join('admin', 'education_classroom_teacher.teacherId = admin.id')
				->join('categories', 'education_classroom_teacher.subjectId = categories.id')
				->whereClassroomId($this->getClassroomId())
				->whereTeacherId(pzk_session()->getAdminId())
				->result();
		}
		return $teachers;
	}
}