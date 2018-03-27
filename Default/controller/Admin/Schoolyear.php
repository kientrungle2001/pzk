<?php
class PzkAdminSchoolyearController extends PzkGridAdminController {
	public $table = 'education_school_year';
	public $addFields = 'yearNum, software, site, global, sharedSoftwares';
	public $editFields = 'yearNum, software, site, global, sharedSoftwares';
	public function getListFieldSettings() {
		return PzkListConstant::gets('yearNum', 'education_grade');
	}

    public $searchFields = array('yearNum');
    public $Searchlabels = 'Tên';
	//sort by
    public function getSortFields() {
    	return PzkSortConstant::gets ( 'id, yearNum', 'education_grade' );
    }
	
	public $logable = true;
	public $logFields = 'yearNum';
	public $addLabel = 'Thêm Niên khóa';

	public function getAddFieldSettings() {
		return PzkEditConstant::gets('yearNum', 'education_grade');
	}
	public function getEditFieldSettings() {
		return PzkEditConstant::gets('yearNum', 'education_grade');
	}

	public function getAddValidator() {
		return PzkValidatorConstant::gets(
			array(
				'yearNum' => array(
					'required' => true
				)
			)
		);
	}
    
    public function getEditValidator() {
		return PzkValidatorConstant::gets(
			array(
				'yearNum' => array(
					'required' => true
				)
			)
		);
	}
}