<?php
class PzkAdminEducationScheduleClassroomTeacherSubject extends PzkObject {
	public $layout = 'admin/education/schedule/classroom/teacher/subject';
	public $_classroom = false;
	public function getTopics() {
		return _db()->select('*')->from('categories')->likeParents('%,'.$this->getSubjectId().',%')->orderBy('ordering asc')->result();
	}
	public function getSchedules() {
		$sql = _db()->select('*')->from('education_lecture_schedule')->whereTeacherScheduleId($this->getTeacherScheduleId());
		return $sql->result();
	}
	public function getClassroom() {
		if($this->_classroom) return $this->_classroom;
		return $this->_classroom = _db()->select('*')->from('education_classroom')->where(array('id', $this->getClassroomId()))->result_one();
	}
}