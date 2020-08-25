<?php
class PzkAdminAreatypeController extends PzkGridAdminController {
    public $title = 'Quản lý loại địa điểm';
	public $addFields = 'name, parent, status';
    public $editFields = 'name, parent, status';
    public $table = 'areatype';
	public $quickMode = false;
	
	public $logable = true;
	public $logFields = 'name, parent, status';
	//sort by
    public function getSortFields() {
    	return PzkSortConstant::gets('id, name', 'areatype');
    }
    public $searchFields = array('name');
    public $searchLabel = 'Loại địa điểm';
    
    public function getListFieldSettings() {
    	return PzkListConstant::gets('nameOfAreatype, status', 'areatype');
    }
	
    public $addLabel = 'Thêm loại địa điểm';
    public function getAddFieldSettings() {
    	return PzkEditConstant::gets('nameOfAreatype[mdsize=3], parentOfAreatype[mdsize=3], status[mdsize=3]', 'areatype');
    }
    
	public function getEditFieldSettings() {
    	return PzkEditConstant::gets('nameOfAreatype[mdsize=3], parentOfAreatype[mdsize=3], status[mdsize=3]', 'areatype');
    }
	public function getAddValidator() {
		return PzkValidatorConstant::gets(
			array(
				'name' => array(
					'required' => true, 'minlength' => 2, 'maxlength' => 500
				)
			)
		);
	}
    
    public function getEditValidator() {
		return PzkValidatorConstant::gets(
			array(
				'name' => array(
					'required' => true, 'minlength' => 2, 'maxlength' => 500
				)
			)
		);
	}
	public $listSettingType = 'parent';
	public $fixedPageSize = 2000;
}
?>