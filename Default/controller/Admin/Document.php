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
				'href'	=> 	DS . self::CONTROLLER . DS . self::ADD_ACTION . '?' .
				$this->buildQuery([
					'type' => 'document'
				], [
					'ordering', 'global', 'campaignId', 'sharedSoftwares', 
					'startDate', 'endDate', 'type', 
					'meta_keywords', 'meta_description', 
					'brief', 'img', 'file'
				])
			),
			array(
				'name'	=> 	'Thêm Nhanh Từ vựng',
				'href'	=> 	DS . self::CONTROLLER . DS . self::ADD_ACTION . '?' .
				$this->buildQuery([
					'type' => 'vocabulary'
				], [
					'ordering', 'global', 'campaignId', 'sharedSoftwares', 
					'startDate', 'endDate', 'type', 
					'meta_keywords', 'meta_description', 
					'brief', 'img', 'file'
				])
			),
		);
	}
	public function getListFieldSettings()
	{
		return array(
			list_field('img', self::TABLE),
			list_fields_group(
				'<br />Tiêu đề<br />Bí danh',
				['title', 'alias'],
				self::TABLE
			),
			list_field(LIST_FIELD_CATEGORY_NAME, self::TABLE),
			list_field(LIST_FIELD_CLASSES_WITH_FILTER, self::TABLE),
			list_fields_group(
				'<br />Người tạo<br />Người sửa',
				[LIST_FIELD_CREATOR_NAME, LIST_FIELD_MODIFIED_NAME],
				self::TABLE
			),
			list_fields_group(
				'<br />Ngày tạo<br />Ngày sửa',
				[LIST_FIELD_CREATED, LIST_FIELD_MODIFIED],
				self::TABLE
			),
			list_field(LIST_FIELD_ORDERING, self::TABLE),
			list_field(LIST_FIELD_STATUS, self::TABLE)
		);
	}

	public $searchLabel = 'Tìm kiếm';
	public $searchFields = [
		[C_COLUMN, self::TABLE, 'id'],
		[C_COLUMN, self::TABLE, 'title'],
		[C_COLUMN, self::TABLE, 'alias']
	];

	public function getFilterFields()
	{
		return filter_fields([
			'subjectCategory',
			'trial',
			'status'
		], self::TABLE);
	}

	public function getSortFields()
	{
		return sort_fields([
			'id',
			'title',
			'categoryId',
			'ordering'
		], self::TABLE);
	}

	public $quickMode = false;
	public function getQuickFieldSettings()
	{
		return list_fields('title', self::TABLE);
	}

	public $logable = true;
	public $logFields = 'title, categoryId, img, content, brief, trial, alias, file, ordering, classes';

	public $addLabel = 'Thêm tài liệu';
	public $addFields = [
		'title',
		'categoryId',
		'img',
		'content',
		'brief',
		'trial',
		'alias',
		'file',
		'ordering',
		'classes',
		'status',
		'software',
		'global',
		'sharedSoftwares'
	];
	public function getAddFieldSettings()
	{
		return edit_fields([
			'title[mdsize=6]',
			'alias[mdsize=6]',
			'categoryId[mdsize=6]',
			'file[mdsize=6]',
			'img[mdsize=12]',
			'status[mdsize=4]',
			'trial[mdsize=4]',
			'ordering[mdsize=4]',
			'classes[mdsize=12]',
			'brief[mdsize=12]',
			'content'
		], self::TABLE);
	}

	public $detailFields = 'document.*, categories.name as categoryName, creator.name as creatorName, modifier.name as modifiedName';
	public function getViewFieldSettings()
	{
		return list_fields('title, alias, categoryName,
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
