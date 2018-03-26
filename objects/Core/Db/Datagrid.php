<?php
pzk_import('Core.Db.List');
class PzkCoreDbDatagrid extends PzkCoreDbList {
    public $joins 		= false;
    public $scriptable 	= true;
	public $layout 		= 'admin/datagrid/grid';
	public $table		= 'banner';
	
	public function getJoins() {
		return PzkJoinConstant::gets ( 'campaign, creator, modifier', 'banner' );
	}
	
	public function getFilterFields() {
		return PzkFilterConstant::gets ( 'campaign[compact=true]', 'banner' );
	}
	public $selectFields = 'banner.*, campaign.name as campaignName,creator.name as creatorName, modifier.name as modifiedName';
	
	public function getSortFields() {
		return PzkSortConstant::gets ( 'id, created, name', 'banner' );
	}
	public $searchFields = array('name', 'image');
	
	public function getListFieldSettings() {
		return array (
			PzkListConstant::get ( 'image', 'banner' ),
			PzkListConstant::get ( 'nameOfCommon', 'banner' ),
			PzkListConstant::get ( 'position', 'banner' ),
			PzkListConstant::get ( 'url', 'banner' ), 
			PzkListConstant::get ( 'campaignName', 'banner' ),
			
			PzkListConstant::group ( '<br />Người tạo<br />Người sửa', 'creatorName, modifiedName', 'news' ),
			PzkListConstant::group ( '<br />Ngày tạo<br />Ngày sửa', 'created, modified', 'news' ),
			PzkListConstant::get ( 'click', 'banner' ),
			PzkListConstant::get ( 'width', 'banner' ),
			PzkListConstant::get ( 'height', 'banner' ),
			PzkListConstant::get ( 'status', 'banner' ) 
		);
	}
	
	public function getJsObjectFields () {
		$data 	= 	array();
		$arr 	=	array('Title', 'Joins', 'SelectFields', 'SortFields', 'SearchFields', 'ListFieldSettings', 'OrderBy', 'GroupBy', 'Having', 'Table', 'PageNum', 'PageSize', 'ParentField', 'ParentWhere', 'ParentId', 'ParentMode');
		foreach($arr as $key) {
			$lkey 			= 	lcfirst($key);
			$method 		=	'get' . $key;
			$data[$lkey]	=	$this->$method();
		}
		return $data;
	}
}
?>