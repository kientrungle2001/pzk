<?php
class PzkAdminMediaController extends PzkGridAdminController {
    public $addFields = 'url, status, name, type, content, categoryId, categoryIds, software, global, sharedSoftwares';
    public $editFields = 'url, status, name, type, content, categoryId, categoryIds, software, global, sharedSoftwares';
    public $table = 'media';
    
	public function getJoins() {
		return PzkJoinConstant::gets('category,creator,modifier', 'media');
	}
	
	public $selectFields	=	'media.*, categories.name as categoryName, creator.name as creatorName, modifier.name as modifierName';
	
	public function getListFieldSettings() { 
		return array(
			PzkListConstant::get('name', 'media'),
			PzkListConstant::get('url', 'media'),
			PzkListConstant::get('categoryIds', 'media'),
			PzkListConstant::get('categoryName', 'media'),
			PzkListConstant::get('creatorName', 'media'),
			PzkListConstant::get('created', 'media'),
			PzkListConstant::get('modifiedName', 'media'),
			PzkListConstant::get('modified', 'media'),
			PzkListConstant::get('status', 'media'),
		);
	}
	public $searchFields = array('name', 'url');
	public function getSortFields() {
		return PzkSortConstant::gets('id, name', 'media');
	}
	
	public function getFilterFields() {
		return PzkFilterConstant::gets('categoryIds', 'media');
	}
    
	public $logable = true;
	public $logFields = 'name,url,status';
    
    public $addLabel = 'Thêm media';
    public function getAddFieldSettings() { 
		return array(
			PzkEditConstant::get('name', 'media'),
			PzkEditConstant::get('mediaUrl', 'media'),
			PzkEditConstant::get('categoryId', 'media'),
			PzkEditConstant::get('categoryIds', 'media'),
			PzkEditConstant::get('content', 'media'),
			PzkEditConstant::get('status', 'media'),
			
		);
	}
    public function getEditFieldSettings() { 
		return array(
			PzkEditConstant::get('name', 'media'),
			PzkEditConstant::get('mediaUrl', 'media'),
			PzkEditConstant::get('categoryId', 'media'),
			PzkEditConstant::get('categoryIds', 'media'),
			PzkEditConstant::get('content', 'media'),
			PzkEditConstant::get('status', 'media'),
		);
	}
    public $addValidator = array(
        'rules' => array(
            'name' => array(
                'required' => true,
                'minlength' => 2,
                'maxlength' => 50
            )

        ),
        'messages' => array(
            'name' => array(
                'required' => 'Tên media không được để trống',
                'minlength' => 'Tên media phải dài 2 ký tự trở lên',
                'maxlength' => 'Tên media chỉ dài tối đa 50 ký tự'
            )

        )
    );
    public $editValidator = array(
        'rules' => array(
            'name' => array(
                'required' => true,
                'minlength' => 2,
                'maxlength' => 50
            )

        ),
        'messages' => array(
            'name' => array(
                'required' => 'Tên media không được để trống',
                'minlength' => 'Tên media phải dài 2 ký tự trở lên',
                'maxlength' => 'Tên media chỉ dài tối đa 50 ký tự'
            )

        )
    );
}
?>