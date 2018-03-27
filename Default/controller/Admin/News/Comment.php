<?php
class PzkAdminNewsCommentController extends PzkGridAdminController {
	public $table = 'news_comment';
	public function getJoins() {
		return PzkJoinConstant::gets ( 'user', 'news_comment' );
	}
	public $selectFields = 'news_comment.*, user.name as userName';
	
	public $editFields = 'newsId, content, ip, created,userId';
	public $sortFields = array(
		'id asc' => 'ID tăng',
		'id desc' => 'ID giảm',
		'created asc' => 'Ngày tăng',
		'created desc' => 'Ngày giảm',	
	);
	public $searchFields = array('newsId', 'content', 'userId');
	
	public $listFieldSettings = array(
        array(
            'index' => 'content',
            'type' => 'text',
            'label' => 'Bình luận'
        ),
		array(
            'index' => 'userName',
            'type' => 'text',
            'label' => 'Người đăng'
        ),
		array(
            'index' => 'ip',
            'type' => 'text',
            'label' => 'Địa chỉ IP'
        ),
        array(
            'index' => 'created',
            'type' => 'datetime',
			'format'	=> 'd/m/Y H:i:s',
            'label' => 'Ngày tạo'
        )
    );
}