<?php
class PzkAdminClassController extends PzkGridAdminController {
	public $table = 'education_class';
	public $addFields = 'name, ordering, software, site, global, sharedSoftwares';
	public $editFields = 'name, ordering, software, site, global, sharedSoftwares';
	public function getListFieldSettings() {
		return PzkListConstant::gets('name, ordering', 'education_class');
	}

    public $searchFields = array('name');
    public $Searchlabels = 'Tên';
	//sort by
    public function getSortFields() {
    	return PzkSortConstant::gets ( 'id, ordering, name', 'education_class' );
    }
	
	public $logable = true;
	public $logFields = 'name';
	public $addLabel = 'Thêm Lớp';

	public function getAddFieldSettings() {
		return PzkEditConstant::gets('name, ordering', 'education_class');
	}
	public function getEditFieldSettings() {
		return PzkEditConstant::gets('name, ordering', 'education_class');
	}

	public function getAddValidator() {
		return PzkValidatorConstant::gets(
			array(
				'name' => array(
					'required' => true
				)
			)
		);
	}
    
    public function getEditValidator() {
		return PzkValidatorConstant::gets(
			array(
				'name' => array(
					'required' => true
				)
			)
		);
	}
}