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
			FIELD_ORDERING, FIELD_TYPE, FIELD_CAMPAIGN_ID, FIELD_BRIEF, FIELD_IMG, FIELD_FILE,
			...F_SCOPE
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
						F_TYPE => self::TYPE_DOCUMENT
					], array_concat($hidden_fields))
			),
			array(
				A_NAME	=> 	'Thêm Nhanh Từ vựng',
				A_HREF	=> 	DS . self::CONTROLLER . DS . self::ADD_ACTION . '?' .
					$this->buildQuery([
						F_TYPE => self::TYPE_VOCABULARY
					], array_concat($hidden_fields))
			),
		);
	}
	public function getListFieldSettings()
	{
		return array(
			list_field(F_IMG, self::TABLE),
			list_field(F_TITLE, self::TABLE),
			list_field(LF_CATEGORY_NAME, self::TABLE),
			list_field(LF_CLASSES_WITH_FILTER, self::TABLE),
			list_field(F_MODIFIED_NAME, self::TABLE),
			list_field(F_MODIFIED, self::TABLE),
			list_field(F_ORDERING, self::TABLE),
			list_field(F_STATUS, self::TABLE)
		);
	}

	public $searchLabel = 'Tìm kiếm';
	public $searchFields = [
		[C_COLUMN, self::TABLE, F_ID],
		[C_COLUMN, self::TABLE, F_TITLE],
		[C_COLUMN, self::TABLE, F_ALIAS]
	];

	public function getFilterFields()
	{
		return filter_fields([
			F_SUBJECT_CATEGORY,
			F_TRIAL,
			F_STATUS
		], self::TABLE);
	}

	public function getSortFields()
	{
		return sort_fields([
			F_ID, F_TITLE, F_CATEGORY_ID, F_ORDERING
		], self::TABLE);
	}

	public $quickMode = false;
	public function getQuickFieldSettings()
	{
		return list_fields(F_TITLE, self::TABLE);
	}

	public $logable = true;
	public $logFields = [...F_BASIC, F_CLASSES];

	public $addLabel = 'Thêm tài liệu';
	public $addFields = [
		...F_BASIC,
		FIELD_CLASSES,
		...F_SCOPE
	];
	public function getAddFieldSettings()
	{
		return edit_fields([
			F_TITLE . '[mdsize=6]',
			F_ALIAS . '[mdsize=6]',
			F_CATEGORY_ID . '[mdsize=6]',
			F_FILE . '[mdsize=6]',
			F_IMG . '[mdsize=12]',
			F_STATUS . '[mdsize=4]',
			F_TRIAL . '[mdsize=4]',
			F_ORDERING . '[mdsize=4]',
			F_CLASSES . '[mdsize=12]',
			F_BRIEF . '[mdsize=12]',
			F_CONTENT
		], self::TABLE);
	}

	public $detailFields = 'document.*, categories.name as categoryName, creator.name as creatorName, modifier.name as modifiedName';
	public function getViewFieldSettings()
	{
		return list_fields([
			F_TITLE,
			F_ALIAS,
			F_CATEGORY_NAME,
			F_VIEWS,
			F_LIKES,
			F_COMMENTS,
			F_CREATOR_NAME,
			F_MODIFIED_NAME,
			F_CREATED,
			F_MODIFIED,
			F_STATUS_TEXT,
			F_ORDERING_TEXT,
			F_BRIEF_TEXT
		], self::TABLE);
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
				'listFieldSettings'	=>  list_fields([F_COMMENTS, F_LIKES, F_IP, F_CREATED], self::TABLE_COMMENT),
				'sortFields' => sort_fields([F_ID, F_LIKES, F_CREATED], self::TABLE_COMMENT)
			),
			array(
				A_INDEX	=> 'visitors',
				A_TITLE	=> 'Người ghé thăm',
				A_LABEL	=> 'Người ghé thăm',
				A_TABLE	=> self::TABLE_VISITOR,
				'addLabel'	=> 'Thêm người ghé thăm',
				'quickMode'	=> false,
				'module'	=> 'visitor',
				'parentField'	=> 'documentId',
				'listFieldSettings'	=> list_fields([F_IP, F_VISITED], self::TABLE_VISITOR),
				'sortFields' => sort_fields([F_ID, F_VISITED], self::TABLE_VISITOR)
			)
		);
	}

	public function getParentDetailSettings()
	{
		return array(
			PzkParentConstant::get('creator', self::TABLE),
			PzkParentConstant::get('modifier', self::TABLE),
			PzkParentConstant::get('category', self::TABLE, list_fields('nameOfCategory, alias, router, statusText, displayText', 'category'))
		);
	}
}
