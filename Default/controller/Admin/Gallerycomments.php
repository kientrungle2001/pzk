<?php
class PzkAdminGalleryCommentsController extends PzkGridAdminController {
	public $table = 'gallery_comment';
	public $joins = array(
		array(
			'table' => 'gallery',
			'condition' => 'gallery_comment.galleryId = gallery.id',
			'type' => 'left'
		)
	);
	public $editFields = 'comment';
	public $sortFields = array(
		'gallery_comment.id asc' => 'ID tăng',
		'gallery_comment.id desc' => 'ID giảm',
		'gallery_comment.created asc' => 'Ngày tăng',
		'gallery_comment.created desc' => 'Ngày giảm',	
	);
	public $selectFields = 'gallery_comment.*, gallery.title as galleryTitle';
	public $filterFields = array(
		array(
            'index' => 'galleryId',
            'type' => 'select',
            'label' => 'Theo hoạt động',
            'table' => 'gallery',
            'show_value' => 'id',
            'show_name' => 'title',
        )
	);
	public $searchFields = array('galleryId', 'comment', 'userId');
	
	public $listFieldSettings = array(
        array(
            'index' => 'galleryTitle',
            'type' => 'text',
            'label' => 'Hoạt động'
        ),
		array(
            'index' => 'comment',
            'type' => 'text',
            'label' => 'Bình luận'
        ),
		array(
            'index' => 'like',
            'type' => 'text',
            'label' => 'Số lượt thích'
        ),
        array(
            'index' => 'created',
            'type' => 'datetime',
			'format'	=> 'd/m/Y H:i:s',
            'label' => 'Ngày tạo'
        )
    );
	public $editFieldSettings = array(
        array(
            'index' => 'comment',
            'type' => 'tinymce',
            'label' => 'Bình luận',
        )
    );
}