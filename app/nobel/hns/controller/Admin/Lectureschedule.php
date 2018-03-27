<?php
class PzkAdminLecturescheduleController extends PzkGridAdminController {
	public $table = 'education_lecture_schedule';
	public $addFields = 'teacherScheduleId, topicId, exerciseNum, type, expiredDate, software, site, global, sharedSoftwares';
	public $editFields = 'teacherScheduleId, topicId, exerciseNum, type, expiredDate, software, site, global, sharedSoftwares';
	
	public $selectFields = 'education_lecture_schedule.id, admin.name as teacherId, topic.name as topicId,
		concat(education_classroom.schoolYear,"-", education_classroom.gradeNum, education_classroom.className, "-", subject.name, "-", admin.name) as teacherScheduleId, education_lecture_schedule.exerciseNum, education_lecture_schedule.type, education_lecture_schedule.expiredDate';
	
	public $joins = array(
		array(
			'table' 		=> 	'categories as topic',
			'condition'		=> 	'education_lecture_schedule.topicId = topic.id',
			'type'			=> 	'left'
		),
		array(
			'table' 		=> 	'education_classroom_teacher',
			'condition'		=> 	'education_lecture_schedule.teacherScheduleId = education_classroom_teacher.id',
			'type'			=> 	'left'
		),
		array(
			'table' 		=> 	'admin',
			'condition'		=> 	'education_classroom_teacher.teacherId = admin.id',
			'type'			=> 	'left'
		),
		array(
			'table' 		=> 	'categories as subject',
			'condition'		=> 	'education_classroom_teacher.subjectId = subject.id',
			'type'			=> 	'left'
		),
		array(
			'table' 		=> 	'education_classroom',
			'condition'		=> 	'education_classroom_teacher.classroomId = education_classroom.id',
			'type'			=> 	'left'
		),
	);
	
	
	
	public function getListFieldSettings() {
		$fields = PzkListConstant::gets('teacherScheduleId, topicId, type, exerciseNum, expiredDate', 'education_lecture_schedule');
		$this->alterField($fields, array(
			'teacherScheduleId'	=> array('label' => 'Xếp lớp'),
			'topicId'	=> array('label' => 'Bài học'),
			'exerciseNum'	=> array('label' => 'Bài'),
			'type'	=> array('label' => 'Loại', 'maps' => array('1' => 'Trắc nghiệm', '4' => 'Tự luận')),
			'expiredDate'	=> array('label' => 'Thời gian', 'format' => 'H:i d/m/Y', 'type' => 'datetime'),
		));
		
		return $fields;
	}

	//sort by
    public function getSortFields() {
    	return PzkSortConstant::gets ( 'id', 'education_lecture_schedule' );
    }
	
	public $addLabel = 'Thêm Xếp lớp';

	public function getAddFieldSettings() {
		$fields = $this->getDefaultEditFieldSettings();
		return $fields;
	}
	public function getEditFieldSettings() {
		$fields = $this->getDefaultEditFieldSettings();
		return $fields;
	}
	
}