<?php
class PzkAdminDocumentController extends PzkGridAdminController {
	public const TABLE = 'document';
	public const CONTROLLER = 'Admin_Document';
	public const ADD_ACTION = 'add';
	public $title 		= 'Quản lý tài liệu';
	public $table 		= self::TABLE;
	// public $gridLayout	= 'grid/js';
	public function getJoins() {
		return PzkJoinConstant::gets('category, creator, modifier', self::TABLE);
	}

	public $selectFields = 'document.*, categories.name as categoryName, creator.name as creatorName, modifier.name as modifiedName';
	public function getLinks() {
		return array(
				array(
						'name'	=> 	'Tạo Alias',
						'href'	=> 	DS . self::CONTROLLER . DS . 'alias'
				),
				array(
					'name'	=> 	'Thêm Nhanh Tài liệu',
					'href'	=> 	DS. self::CONTROLLER . DS . self::ADD_ACTION . '?type=document&hidden_ordering=1&hidden_global=1&hidden_campaignId=1&hidden_sharedSoftwares=1&hidden_startDate=1&hidden_endDate=1&hidden_type=1&hidden_meta_keywords=1&hidden_meta_description=1&hidden_brief=1&hidden_img=1&hidden_file=1'
				),
				array(
					'name'	=> 	'Thêm Nhanh Từ vựng',
					'href'	=> 	DS . self::CONTROLLER . DS . self::ADD_ACTION . '?type=vocabulary&hidden_ordering=1&hidden_global=1&hidden_campaignId=1&hidden_sharedSoftwares=1&hidden_startDate=1&hidden_endDate=1&hidden_type=1&hidden_meta_keywords=1&hidden_meta_description=1&hidden_brief=1&hidden_img=1&hidden_file=1'
				),
		);
	}
	public function getListFieldSettings() { 
		return array(
			/*
			PzkListConstant::get('img', 'document'),
			*/
			PzkListConstant::group('<br />Tiêu đề<br />Bí danh', 'title, alias', self::TABLE),
			/*
			PzkListConstant::group('<br />Từ khóa<br />Mô tả', 'meta_keywords, meta_description', 'document'),*/
			PzkListConstant::get('categoryName', self::TABLE),
			PzkListConstant::get('document_en_title', self::TABLE),
			array(
				'index' 	=> 'tdn_title',
				'type' 		=> 'text',
				'label' 	=> 'Tiêu đề TĐN',
			),
			PzkListConstant::get('categoryIds', self::TABLE),
			array(
				'index' 	=> 'classes',
				'type' 		=> 'text',
				'label' 	=> 'Lớp',
				'filter'	=> 	array(
					'index' 		=> 'classes',
					'type' 			=> 'selectoption',
					'label' 		=> 'Chọn lớp',
					'option' 		=> array(
						CLASS3 			=> "Lớp 3",
						CLASS4 			=> "Lớp 4",
						CLASS5 			=> "Lớp 5"
					),
					'like' 			=> true
				),
			),
			array(
				'index' 	=> 'type',
				'type' 		=> 'text',
				'label' 	=> 'Loại',
				'filter'	=> 	array(
					'index' 		=> 'type',
					'type' 			=> 'selectoption',
					'label' 		=> 'Chọn loại',
					'option' 		=> array(
						'vocabulary' 	=> "Từ vựng và lý thuyết",
						'document' 		=> "Tài liệu"
					),
					'like' 			=> true
				),
			),
			/*
			PzkListConstant::get('campaignName', 'document'),
			*/
			PzkListConstant::group('<br />Xem<br />Thích<br />Bình luận', 'views, likes, comments', self::TABLE),
			PzkListConstant::group('<br />Người tạo<br />Người sửa', 'creatorName, modifiedName', self::TABLE),
			PzkListConstant::group('<br />Ngày tạo<br />Ngày sửa', 'created, modified', self::TABLE),
			PzkListConstant::get('trial', self::TABLE),
			PzkListConstant::get('ordering', self::TABLE),
			/*PzkListConstant::get('classes', 'document'),*/
			/*PzkListConstant::get('file', 'document'),*/
			PzkListConstant::get('status', self::TABLE),
			array(
				ATTR_INDEX 	=> 'displayAtSite',
				ATTR_TYPE 		=> LIST_TYPE_ORDERING,
				ATTR_LABEL 	=> 'H.Thị ở Site',
			),
			array(
				ATTR_INDEX 	=> 'hidden',
				ATTR_TYPE 		=> LIST_TYPE_STATUS,
				ATTR_LABEL 	=> 'Ẩn',
			),
		);
	}
	
	public $searchLabel = 'Tìm kiếm';
	public $searchFields = array('`document`.id', '`document`.title', '`document`.alias');
	
	public function getFilterFields () { 
		return PzkFilterConstant::gets('subjectCategory, categoryIds, trial, status', 'document', 'classes');
	}
	
	public function getSortFields() {
		return PzkSortConstant::gets('id, title, categoryId, ordering', self::TABLE);
	}
	
	public $quickMode = false;
	public function getQuickFieldSettings(){
		return PzkListConstant::gets('title', self::TABLE);
	}
	
	public $logable = true;
	public $logFields = 'title, en_title, type, categoryId, img, content, brief, trial, alias, file, ordering, classes';
	
	public $addLabel = 'Thêm tài liệu';
	public $addFields = 'title, en_title, type, categoryId, img, content, brief, trial, alias, file, ordering, classes, categoryIds,
				meta_keywords, meta_description, status, software, global, sharedSoftwares';
	public function getAddFieldSettings() { 
		return PzkEditConstant::gets('title[mdsize=3], en_title[mdsize=3], alias[mdsize=3], categoryId[mdsize=3],  file[mdsize=3],categoryIds[mdsize=12], img[mdsize=3], status[mdsize=3], trial[mdsize=3], classes[mdsize=3], brief[mdsize=3], typeOfDocument[mdsize=3], content,  ordering[mdsize=2], meta_keywords[mdsize=5], meta_description[mdsize=5]',self::TABLE);
    }
	
	public $editFields = 'title, en_title, type, categoryId, img, content, brief, trial, alias, file, ordering, classes, categoryIds,
				meta_keywords, meta_description, status, software, global, sharedSoftwares';
	public function getEditFieldSettings() { 
		return PzkEditConstant::gets('title[mdsize=3], en_title[mdsize=3], alias[mdsize=3], categoryId[mdsize=3],  file[mdsize=3],categoryIds[mdsize=12], img[mdsize=3], status[mdsize=3], trial[mdsize=3], classes[mdsize=3], brief[mdsize=3], typeOfDocument[mdsize=3], content,  ordering[mdsize=2], meta_keywords[mdsize=5], meta_description[mdsize=5]',self::TABLE);
    }
	
	public $detailFields = 'document.*, categories.name as categoryName, creator.name as creatorName, modifier.name as modifiedName';
	public function getViewFieldSettings() { 
		return PzkListConstant::gets('title, alias, meta_keywords, meta_description, categoryName,
			campaignName, views, likes, comments, creatorName, modifiedName, created, modified, 
			 statusText, orderingText, briefText', self::TABLE);
	}
	
	public function getChildrenGridSettings() { 
		return array(
			array(
				'index'	=> 'comments',
				'title'	=> 'Bình luận',
				'label'	=> 'Bình luận',
				'table'	=> 'document_comment',
				'parentField'	=> 'documentId',
				'addLabel'	=> 'Thêm bình luận',
				'quickMode'	=> false,
				'module'	=> 'document_comment',
				'listFieldSettings'	=>  PzkListConstant::gets('comment, likes, ip, created', 'document_comment'),
				'sortFields' => PzkSortConstant::gets('id, created, likes', 'document_comment')
			),
			array(
				'index'	=> 'visitor',
				'title'	=> 'Người ghé thăm',
				'label'	=> 'Người ghé thăm',
				'table'	=> 'document_visitor',
				'addLabel'	=> 'Thêm người ghé thăm',
				'quickMode'	=> false,
				'module'	=> 'visitor',
				'parentField'	=> 'documentId',
				'listFieldSettings'	=> PzkListConstant::gets('ip, visited', 'document_visitor'),
				'sortFields' => PzkSortConstant::gets('id, visited', 'document_visitor')
			)
		);
	}
	
	public function getParentDetailSettings() { 
		return array(
			PzkParentConstant::get('creator', self::TABLE),
			PzkParentConstant::get('modifier', self::TABLE),
			PzkParentConstant::get('category', self::TABLE, PzkListConstant::gets('nameOfCategory, alias, router, statusText, displayText', 'category'))
		);
	}
}
