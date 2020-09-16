<?php
class PzkAdminDocumentController extends PzkGridAdminController
{
	public const TABLE = 'document';
	public const TABLE_COMMENT = 'document_comment';
	public const TABLE_VISITOR = 'document_visitor';
	
	public const TYPE_DOCUMENT = 'document';
	public const TYPE_VOCABULARY = 'vocabulary';
	
	public const LABEL_LISTING_CREATOR_MODIFIER_NAME = '<br />Người tạo<br />Người sửa';
	public const LABEL_LISTING_CREATOR_MODIFIER_DATE = '<br />Ngày tạo<br />Ngày sửa';
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
		$hidden_fields = [
			FIELD_ORDERING, FIELD_GLOBAL, FIELD_CAMPAIGN_ID, FIELD_SHARED_SOFTWARES, 
			FIELD_START_DATE, FIELD_END_DATE, FIELD_TYPE, 
			FIELD_META_KEYWORDS, FIELD_META_DESCRIPTION, 
			FIELD_BRIEF, FIELD_IMG, FIELD_FILE
		];
		return array(
			array(
				A_NAME	=> 	'Tạo Alias',
				A_HREF	=> 	DS . self::CONTROLLER . DS . 'alias'
			),
			array(
				A_NAME	=> 	'Thêm Nhanh Tài liệu',
				A_HREF	=> 	DS . self::CONTROLLER . DS . self::ADD_ACTION . '?' .
				$this->buildQuery([
					FIELD_TYPE => self::TYPE_DOCUMENT
				], array_concat($hidden_fields))
			),
			array(
				A_NAME	=> 	'Thêm Nhanh Từ vựng',
				A_HREF	=> 	DS . self::CONTROLLER . DS . self::ADD_ACTION . '?' .
				$this->buildQuery([
					FIELD_TYPE => self::TYPE_VOCABULARY
				], array_concat($hidden_fields))
			),
		);
	}
	public function getListFieldSettings()
	{
		return array(
			list_field(FIELD_IMG, self::TABLE),
			list_field(FIELD_TITLE, self::TABLE),
			list_field(LIST_FIELD_CATEGORY_NAME, self::TABLE),
			list_field(LIST_FIELD_CLASSES_WITH_FILTER, self::TABLE),
			list_field(LIST_FIELD_MODIFIED_NAME, self::TABLE),
			list_field(FIELD_MODIFIED, self::TABLE),
			list_field(FIELD_ORDERING, self::TABLE),
			list_field(FIELD_STATUS, self::TABLE)
		);
	}

	public $searchLabel = 'Tìm kiếm';
	public $searchFields = [
		[C_COLUMN, self::TABLE, FIELD_ID],
		[C_COLUMN, self::TABLE, FIELD_TITLE],
		[C_COLUMN, self::TABLE, FIELD_ALIAS]
	];

	public function getFilterFields()
	{
		return filter_fields([
			'subjectCategory',
			FIELD_TRIAL,
			FIELD_STATUS
		], self::TABLE);
	}

	public function getSortFields()
	{
		return sort_fields([
			FIELD_ID,
			FIELD_TITLE,
			FIELD_CATEGORY_ID,
			FIELD_ORDERING
		], self::TABLE);
	}

	public $quickMode = false;
	public function getQuickFieldSettings()
	{
		return list_fields(FIELD_TITLE, self::TABLE);
	}

	public $logable = true;
	public $logFields = 'title, categoryId, img, content, brief, trial, alias, file, ordering, classes';

	public $addLabel = 'Thêm tài liệu';
	public $addFields = [
		FIELD_TITLE,
		FIELD_CATEGORY_ID,
		FIELD_IMG,
		FIELD_CONTENT,
		FIELD_BRIEF,
		FIELD_TRIAL,
		FIELD_ALIAS,
		FIELD_FILE,
		FIELD_ORDERING,
		FIELD_CLASSES,
		FIELD_STATUS,
		FIELD_SOFTWARE,
		FIELD_GLOBAL,
		FIELD_SHARED_SOFTWARES
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
				A_INDEX	=> 'comments',
				A_TITLE	=> 'Bình luận',
				A_LABEL	=> 'Bình luận',
				A_TABLE	=> self::TABLE_COMMENT,
				'parentField'	=> 'documentId',
				'addLabel'	=> 'Thêm bình luận',
				'quickMode'	=> false,
				'module'	=> 'document_comment',
				'listFieldSettings'	=>  PzkListConstant::gets('comments, likes, ip, created', self::TABLE_COMMENT),
				'sortFields' => PzkSortConstant::gets('id, created, likes', self::TABLE_COMMENT)
			),
			array(
				A_INDEX	=> 'visitor',
				A_TITLE	=> 'Người ghé thăm',
				A_LABEL	=> 'Người ghé thăm',
				A_TABLE	=> self::TABLE_VISITOR,
				'addLabel'	=> 'Thêm người ghé thăm',
				'quickMode'	=> false,
				'module'	=> 'visitor',
				'parentField'	=> 'documentId',
				'listFieldSettings'	=> PzkListConstant::gets([F_IP, F_VISITED], self::TABLE_VISITOR),
				'sortFields' => PzkSortConstant::gets([F_ID, F_VISITED], self::TABLE_VISITOR)
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
