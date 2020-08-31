<?php
class PzkAdminDocumentController extends PzkGridAdminController
{
	public const TABLE = 'document';
	public const TABLE_COMMENT = 'document_comment';
	public const TABLE_VISITOR = 'document_visitor';
	public const CONTROLLER = 'Admin_Document';
	public const ADD_ACTION = 'add';
	public $title 		= 'Quản lý tài liệu';
	public $table 		= self::TABLE;
	public $mdAddOffset	= '2';
	public $mdAddSize	= '8';

	public function getJoins()
	{
		return PzkJoinConstant::gets([JOIN_TABLE_CATEGORY, JOIN_TABLE_CREATOR, JOIN_TABLE_MODIFIER], self::TABLE);
	}

	public $selectFields = [
		'document.*',
		'categories.name as categoryName',
		'creator.name as creatorName',
		'modifier.name as modifiedName'
	];
	public function getLinks()
	{
		return array(
			array(
				'name'	=> 	'Tạo Alias',
				'href'	=> 	DS . self::CONTROLLER . DS . 'alias'
			),
			array(
				'name'	=> 	'Thêm Nhanh Tài liệu',
				'href'	=> 	DS . self::CONTROLLER . DS . self::ADD_ACTION . '?type=document&hidden_ordering=1&hidden_global=1&hidden_campaignId=1&hidden_sharedSoftwares=1&hidden_startDate=1&hidden_endDate=1&hidden_type=1&hidden_meta_keywords=1&hidden_meta_description=1&hidden_brief=1&hidden_img=1&hidden_file=1'
			),
			array(
				'name'	=> 	'Thêm Nhanh Từ vựng',
				'href'	=> 	DS . self::CONTROLLER . DS . self::ADD_ACTION . '?type=vocabulary&hidden_ordering=1&hidden_global=1&hidden_campaignId=1&hidden_sharedSoftwares=1&hidden_startDate=1&hidden_endDate=1&hidden_type=1&hidden_meta_keywords=1&hidden_meta_description=1&hidden_brief=1&hidden_img=1&hidden_file=1'
			),
		);
	}
	public function getListFieldSettings()
	{
		return array(
			PzkListConstant::get('img', 'document'),
			PzkListConstant::group('<br />Tiêu đề<br />Bí danh', 'title, alias', self::TABLE),
			PzkListConstant::get('categoryName', self::TABLE),
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
			PzkListConstant::group('<br />Người tạo<br />Người sửa', 'creatorName, modifiedName', self::TABLE),
			PzkListConstant::group('<br />Ngày tạo<br />Ngày sửa', 'created, modified', self::TABLE),
			PzkListConstant::get('ordering', self::TABLE),
			PzkListConstant::get('status', self::TABLE)
		);
	}

	public $searchLabel = 'Tìm kiếm';
	public $searchFields = array('`document`.id', '`document`.title', '`document`.alias');

	public function getFilterFields()
	{
		return PzkFilterConstant::gets('subjectCategory, trial, status', 'document', 'classes');
	}

	public function getSortFields()
	{
		return PzkSortConstant::gets('id, title, categoryId, ordering', self::TABLE);
	}

	public $quickMode = false;
	public function getQuickFieldSettings()
	{
		return PzkListConstant::gets('title', self::TABLE);
	}

	public $logable = true;
	public $logFields = 'title, categoryId, img, content, brief, trial, alias, file, ordering, classes';

	public $addLabel = 'Thêm tài liệu';
	public $addFields = 'title, categoryId, img, content, brief, trial, alias, file, ordering, classes, status, software, global, sharedSoftwares';
	public function getAddFieldSettings()
	{
		return PzkEditConstant::gets('title[mdsize=6], alias[mdsize=6], categoryId[mdsize=6],  file[mdsize=6], img[mdsize=12], status[mdsize=4], trial[mdsize=4], ordering[mdsize=4], classes[mdsize=12], brief[mdsize=12], content', self::TABLE);
	}

	public $detailFields = 'document.*, categories.name as categoryName, creator.name as creatorName, modifier.name as modifiedName';
	public function getViewFieldSettings()
	{
		return PzkListConstant::gets('title, alias, categoryName,
			views, likes, comments, creatorName, modifiedName, created, modified, 
			 statusText, orderingText, briefText', self::TABLE);
	}

	public function getChildrenGridSettings()
	{
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

	public function getParentDetailSettings()
	{
		return array(
			PzkParentConstant::get('creator', self::TABLE),
			PzkParentConstant::get('modifier', self::TABLE),
			PzkParentConstant::get('category', self::TABLE, PzkListConstant::gets('nameOfCategory, alias, router, statusText, displayText', 'category'))
		);
	}
}
