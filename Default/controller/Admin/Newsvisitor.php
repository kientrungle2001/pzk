<?php
class PzkAdminNewsVisitorController extends PzkGridAdminController {
	public $table = 'news_visitor';
	public $joins = array(
		array(
			'table' => 'news',
			'condition' => 'news_visitor.newsId = news.id',
			'type' => 'left'
		),
	);
	public $sortFields = array(
		'news_visitor.id asc' => 'ID tăng',
		'news_visitor.id desc' => 'ID giảm',
		'news_visitor.visited asc' => 'Ngày tăng',
		'news_visitor.visited desc' => 'Ngày giảm',	
	);
	public $selectFields = 'news_visitor.*, news.title as newsTitle';
	public $filterFields = array(
		array(
            'index' => 'newsId',
            'type' => 'select',
            'label' => 'Theo bài viết',
            'table' => 'news',
            'show_value' => 'id',
            'show_name' => 'title',
        )
	);
	public $searchFields = array('newsId');
	
	public $listFieldSettings = array(
		array(
            'index' => 'newsTitle',
            'type' => 'text',
            'label' => 'Bài viết'
        ),
		array(
            'index' => 'ip',
            'type' => 'text',
            'label' => 'IP'
        ),
		array(
            'index' => 'visited',
            'type' => 'text',
            'label' => 'Thời gian ghé thăm'
        )
    );
}