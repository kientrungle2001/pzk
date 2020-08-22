<?php
class PzkAdminGalleryVisitorController extends PzkGridAdminController {
	public $table = 'gallery_visitor';
	public $joins = array(
		array(
			'table' => 'gallery',
			'condition' => 'gallery_visitor.galleryId = gallery.id',
			'type' => JOIN_TYPE_LEFT
		),
		array(
			'table' => 'gallery_img',
			'condition' => 'gallery_visitor.galleryId = gallery_img.galleryId',
			'type' => JOIN_TYPE_LEFT
		),
	);
	public $sortFields = array(
		'gallery_visitor.id asc' => 'ID tăng',
		'gallery_visitor.id desc' => 'ID giảm',
		'gallery_visitor.visited asc' => 'Ngày tăng',
		'gallery_visitor.visited desc' => 'Ngày giảm',	
	);
	public $selectFields = 'gallery_visitor.*, gallery.title as galleryTitle';
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
	public $searchFields = array('galleryId');
	
	public $listFieldSettings = array(
		array(
            'index' => 'galleryTitle',
            'type' => 'text',
            'label' => 'Hoạt động'
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