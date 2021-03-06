<?php
pzk_import('Admin.Education.Schedule.Lecture');
class PzkAdminEducationScheduleLectureSubject extends PzkAdminEducationScheduleLecture {
	public $layout = 'admin/education/schedule/lecture/subject';
	public function getTopics() {
		return _db()->select('*')->from('categories')->likeParents('%,'.$this->getSubjectId().',%')->orderBy('ordering asc')->result();
	}
	public function getSchedules() {
		return _db()->select('*')->from('education_lecture_schedule')->whereSubjectId($this->getSubjectId())->whereClassroomId($this->getClassroomId())->result();
	}
}