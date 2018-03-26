<?php
pzk_import('Core.Db.List');
class PzkEducationLecturePracticeHistory extends PzkCoreDbList {
	public $table 		= 	'pmtv_user_book';
	public $layout		=	'education/lecture/practice/history';
	public function init() {
		$userId 		=	pzk_user()->get('id');
		$this->addFilter(array('column', 'pmtv_user_book', 'userId'), $userId);
		parent::init();
	}
	public $joins 		= array(
		array(
			'table'		=> 'user',
			'condition'	=> 'pmtv_user_book.userId = user.id'
		),
		array(
			'table'		=> 'categories',
			'condition'	=> 'pmtv_user_book.categoryId = categories.id'
		)
	);
	public $fields = 'pmtv_user_book.*, user.username, categories.name as categoryName, categories.alias as categoryAlias';
}