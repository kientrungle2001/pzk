<?php
class PzkAdminNewsLikeController extends PzkGridAdminController {
	public $table = 'news_like';
	public $joins = array(
		array(
			'table' => 'news',
			'condition' => 'news_like.newsId = news.id',
			'type' => 'left'
		),
		array(
			'table' => 'user',
			'condition' => 'news_like.userId = user.id',
			'type' => 'left'
		)
	);
	public $sortFields = array(
		'news_like.id asc' => 'ID tăng',
		'news_like.id desc' => 'ID giảm',
		'news_like.timelike asc' => 'Ngày tăng',
		'news_like.timelike desc' => 'Ngày giảm',	
	);
	public $selectFields = 'news_like.*, news.title as newsTitle, user.username as userUsername';
	public $filterFields = array(
		array(
            'index' => 'newsId',
            'type' => 'select',
            'label' => 'Theo bài viết',
            'table' => 'news',
            'show_value' => 'id',
            'show_name' => 'title',
        ),
		array(
            'index' => 'userUsername',
            'type' => 'select',
            'label' => 'Theo thành viên',
            'table' => 'user',
            'show_value' => 'id',
            'show_name' => 'username',
        )
	);
	public $searchFields = array('newsId','userId');
	
	public $listFieldSettings = array(
		array(
            'index' => 'newsTitle',
            'type' => 'text',
            'label' => 'Bài viết'
        ),
		array(
            'index' => 'userUsername',
            'type' => 'text',
            'label' => 'Thành viên'
        ),
		array(
            'index' => 'ip',
            'type' => 'text',
            'label' => 'IP'
        ),
		array(
            'index' => 'timelike',
            'type' => 'text',
            'label' => 'Thời gian'
        )
    );
}