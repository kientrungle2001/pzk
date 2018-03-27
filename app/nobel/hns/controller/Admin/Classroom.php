<?php
class PzkAdminClassroomController extends PzkGridAdminController {
	public $table = 'education_classroom';
	public $addFields = 'schoolYear, gradeNum, className, place, software, site, global, sharedSoftwares';
	public $editFields = 'schoolYear, gradeNum, className, place, software, site, global, sharedSoftwares';
	public function getListFieldSettings() {
		return PzkListConstant::gets('schoolYear, gradeNum, className, place', 'education_classroom');
	}

	//sort by
    public function getSortFields() {
    	return PzkSortConstant::gets ( 'id', 'education_classroom' );
    }
	
	public $addLabel = 'Thêm Xếp lớp';

	public function getAddFieldSettings() {
		return PzkEditConstant::gets('schoolYear, gradeNum, className, place', 'education_classroom');
	}
	public function getEditFieldSettings() {
		return PzkEditConstant::gets('schoolYear, gradeNum, className, place', 'education_classroom');
	}
	
}