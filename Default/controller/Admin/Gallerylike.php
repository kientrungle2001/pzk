<?php
class PzkAdminGalleryLikeController extends PzkGridAdminController {
	public $table = 'gallery_like';
	public $joins = array(
		array(
			'table' => 'gallery',
			'condition' => 'gallery_like.galleryId = gallery.id',
			'type' => 'left'
		),
		array(
			'table' => 'user',
			'condition' => 'gallery_like.userId = user.id',
			'type' => 'left'
		)
	);
	public $sortFields = array(
		'gallery_like.id asc' => 'ID tăng',
		'gallery_like.id desc' => 'ID giảm',
		'gallery_like.timelike asc' => 'Ngày tăng',
		'gallery_like.timelike desc' => 'Ngày giảm',	
	);
	public $selectFields = 'gallery_like.*, gallery.title as featuredTitle, user.username as userUsername';
	public $filterFields = array(
		array(
            'index' => 'galleryId',
            'type' => 'select',
            'label' => 'Theo hoạt động',
            'table' => 'gallery',
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
	public $searchFields = array('galleryId','userId');
	
	public $listFieldSettings = array(
		array(
            'index' => 'galleryTitle',
            'type' => 'text',
            'label' => 'Hoạt động'
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