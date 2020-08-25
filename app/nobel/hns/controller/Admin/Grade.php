<?php
class PzkAdminGradeController extends PzkGridAdminController {
	public $table = 'education_grade';
	public $addFields = 'gradeNum, software, site, global, sharedSoftwares';
	public $editFields = 'gradeNum, software, site, global, sharedSoftwares';
	public function getListFieldSettings() {
		return PzkListConstant::gets('gradeNum', 'education_grade');
	}

    public $searchFields = array('gradeNum');
    public $searchLabel = 'Tên';
	//sort by
    public function getSortFields() {
    	return PzkSortConstant::gets ( 'id, gradeNum', 'education_grade' );
    }
	
	public $logable = true;
	public $logFields = 'gradeNum';
	public $addLabel = 'Thêm Khối';

	public function getAddFieldSettings() {
		return PzkEditConstant::gets('gradeNum', 'education_grade');
	}
	public function getEditFieldSettings() {
		return PzkEditConstant::gets('gradeNum', 'education_grade');
	}

	public function getAddValidator() {
		return PzkValidatorConstant::gets(
			array(
				'gradeNum' => array(
					'required' => true
				)
			)
		);
	}
    
    public function getEditValidator() {
		return PzkValidatorConstant::gets(
			array(
				'gradeNum' => array(
					'required' => true
				)
			)
		);
	}
}