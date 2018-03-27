<?php
class PzkAdminNewsCommentsController extends PzkGridAdminController {
	public $table = 'news_comment';
	public function getJoins() {
		return PzkJoinConstant::gets('news, user', 'news_comment');
	}
	
	public function getSortFields() {
		return PzkSortConstant::gets('id, created', 'news_comment');
	}
	public $selectFields = 'news_comment.*, news.title as title, user.username as username';
	public $detailFields = 'news_comment.*, news.title as title, user.username as username';
	public function getFilterFields(){
		return PzkFilterConstant::gets('newsId', 'news_comment');
	}
	public $searchFields = array('newsId', 'comment', 'userId');
	public function getListFieldSettings() {
		return array(
			PzkListConstant::get('title', 'newscomments'),
			PzkListConstant::get('username', 'user'),
			PzkListConstant::get('contentText', 'news_comment'),
			PzkListConstant::get('likes', 'news_comment'),
			PzkListConstant::get('created', 'news_comment'),
		);
	}
	public function getQuickFieldSettings() {
		return array(
			PzkListConstant::get('title', 'newscomments'),
			PzkListConstant::get('username', 'user'),
		);
	}
	public $editFields = 'content';
	public function getEditFieldSettings() {
		return PzkEditConstant::gets('content', 'news_comment');
	}
}