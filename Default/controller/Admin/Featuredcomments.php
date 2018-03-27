<?php
class PzkAdminFeaturedCommentsController extends PzkGridAdminController {
	public $table = 'featured_comment';
	public function getJoins() {
		return PzkJoinConstant::gets('featured, user', 'featured_comment');
	}
	
	public function getSortFields() {
		return PzkSortConstant::gets('id, created', 'featured_comment');
	}
	public $selectFields = 'featured_comment.*, featured.title as title, user.username as username';
	public $detailFields = 'featured_comment.*, featured.title as title, user.username as username';
	public function getFilterFields(){
		return PzkFilterConstant::gets('featuredId', 'featured_comment');
	}
	public $searchFields = array('featuredId', 'comment', 'userId');
	public function getListFieldSettings() {
		return array(
			PzkListConstant::get('title', 'featuredcomments'),
			PzkListConstant::get('username', 'user'),
			PzkListConstant::get('contentText', 'featured_comment'),
			PzkListConstant::get('likes', 'featured_comment'),
			PzkListConstant::get('created', 'featured_comment'),
		);
	}
	public function getQuickFieldSettings() {
		return array(
			PzkListConstant::get('title', 'featuredcomments'),
			PzkListConstant::get('username', 'user'),
		);
	}
	public $editFields = 'content';
	public function getEditFieldSettings() {
		return PzkEditConstant::gets('content', 'featured_comment');
	}
}