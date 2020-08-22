<?php
class PzkAdminFeaturedLikeController extends PzkGridAdminController {
	public $table = 'featured_like';
	public $joins = array(
		array(
			'table' => 'featured',
			'condition' => 'featured_like.featuredId = featured.id',
			'type' => JOIN_TYPE_LEFT
		),
		array(
			'table' => 'user',
			'condition' => 'featured_like.userId = user.id',
			'type' => JOIN_TYPE_LEFT
		)
	);
	public $sortFields = array(
		'featured_like.id asc' => 'ID tăng',
		'featured_like.id desc' => 'ID giảm',
		'featured_like.timelike asc' => 'Ngày tăng',
		'featured_like.timelike desc' => 'Ngày giảm',	
	);
	public $selectFields = 'featured_like.*, featured.title as featuredTitle, user.username as userUsername';
	public $filterFields = array(
		array(
            'index' => 'featuredId',
            'type' => 'select',
            'label' => 'Theo bài viết',
            'table' => 'featured',
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
	public $searchFields = array('featuredId','userId');
	
	public $listFieldSettings = array(
		array(
            'index' => 'featuredTitle',
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