<?php
class PzkAdminTeacherscheduleController extends PzkGridAdminController {
	public $table = 'education_classroom_teacher';
	public $addFields = 'teacherId, classroomId, subjectId, software, site, global, sharedSoftwares';
	public $editFields = 'teacherId, classroomId, subjectId, software, site, global, sharedSoftwares';
	
	public $selectFields = 'education_classroom_teacher.id, admin.name as teacherId, categories.name as subjectId,
		concat(education_classroom.schoolYear,"-", education_classroom.gradeNum, education_classroom.className) as classroomId';
	
	public $joins = array(
		array(
			'table' 		=> 	'admin',
			'condition'		=> 	'education_classroom_teacher.teacherId = admin.id',
			'type'			=> 	'left'
		),
		array(
			'table' 		=> 	'categories',
			'condition'		=> 	'education_classroom_teacher.subjectId = categories.id',
			'type'			=> 	'left'
		),
		array(
			'table' 		=> 	'education_classroom',
			'condition'		=> 	'education_classroom_teacher.classroomId = education_classroom.id',
			'type'			=> 	'left'
		),
	);
	
	public function alterField(&$fields, $field, $arr = array()) {
		
		// Nếu field là một chuỗi
		if(is_string($field)) {
			foreach($fields as &$f) {
				if($f['index'] == $field) {
					$f = merge_array($f, $arr);
				}
			}
		// Nếu field là một mảng
		} else if(is_array($field)) {
			foreach($fields as &$f) {
				foreach($field as $index => $settings) {
					if($index == $f['index']) {
						$f = merge_array($f, $settings);
					}
				}
			}
		}
	}
	
	public function getListFieldSettings() {
		$fields = PzkListConstant::gets('classroomId, subjectId, teacherId', 'education_classroom_teacher');
		$this->alterField($fields, array(
			'teacherId'	=> array('label' => 'Giáo viên'),
			'subjectId'	=> array('label' => 'Môn học'),
			'classroomId'	=> array('label' => 'Lớp học'),
		));
		
		return $fields;
	}

	//sort by
    public function getSortFields() {
    	return PzkSortConstant::gets ( 'id', 'education_classroom_teacher' );
    }
	
	public $addLabel = 'Thêm Xếp lớp';

	public function getAddFieldSettings() {
		$fields = PzkEditConstant::gets('classroomId, subjectId, teacherId', 'education_classroom_teacher');
		$this->alterField($fields, array(
			'teacherId'	=> array('label' => 'Giáo viên'),
			'subjectId'	=> array('label' => 'Môn học'),
			'classroomId'	=> array('label' => 'Lớp học'),
		));
		return $fields;
	}
	public function getEditFieldSettings() {
		$fields = PzkEditConstant::gets('classroomId, subjectId, teacherId', 'education_classroom_teacher');
		$this->alterField($fields, array(
			'teacherId'	=> array('label' => 'Giáo viên'),
			'subjectId'	=> array('label' => 'Môn học'),
			'classroomId'	=> array('label' => 'Lớp học'),
		));
		return $fields;
	}
	
}