<?php
class PzkAdminFeaturedVisitorController extends PzkGridAdminController {
	public $table = 'featured_visitor';
	public $joins = array(
		array(
			'table' => 'featured',
			'condition' => 'featured_visitor.featuredId = featured.id',
			'type' => JOIN_TYPE_LEFT
		),
	);
	public $sortFields = array(
		'featured_visitor.id asc' => 'ID tăng',
		'featured_visitor.id desc' => 'ID giảm',
		'featured_visitor.visited asc' => 'Ngày tăng',
		'featured_visitor.visited desc' => 'Ngày giảm',	
	);
	public $selectFields = 'featured_visitor.*, featured.title as featuredTitle';
	public $filterFields = array(
		array(
            'index' => 'featuredId',
            'type' => 'select',
            'label' => 'Theo bài viết',
            'table' => 'featured',
            'show_value' => 'id',
            'show_name' => 'title',
        )
	);
	public $searchFields = array('featuredId');
	
	public $listFieldSettings = array(
		array(
            'index' => 'featuredTitle',
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