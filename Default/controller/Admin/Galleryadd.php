<?php
class PzkAdminGalleryAddController extends PzkGridAdminController {
	 public $title = 'Quản lý ảnh trong Gallery';
	 public $table = 'gallery_img';
	 public $joins = array(
		array(
			'table'	=> 	'gallery',
			'condition'	=> 	'gallery_img.galleryId = gallery.id',
			'type'		=> 	JOIN_TYPE_LEFT
		),
		array(
			'table' => '`admin` as `creator`',
			'condition' => 'gallery.creatorId = creator.id',
			'type' => JOIN_TYPE_LEFT
		),
		array(
			'table' => '`admin` as `modifier`',
			'condition' => 'gallery.modifiedId = modifier.id',
			'type' => JOIN_TYPE_LEFT
		),
	 );
	 public $selectFields ='gallery.title, gallery_img.*, creator.name as creatorName, modifier.name as modifiedName';
    public $logable = true;
	public $logFields = 'galleryId, url';
	public $addFields = 'galleryId, url';
	public $editFields = 'galleryId, url';
	public $sortFields = array(
		'id asc' => 'ID tăng',
		'id desc' => 'ID giảm'
	);
	
	public $listFieldSettings = array(
        array(
            'index' => 'title',
            'type' => 'text',
            'label' => 'Gallery'
        ),
        array(
            'index' => 'url',
            'type' => 'image',
            'label' => 'Ảnh'
        ),
		array(
            'index' => 'status',
            'type' => 'status',
            'label' => 'Trạng thái'
        ),
		array(
			'index'	=> 'none4',
			'type'	=> 'group',
			'label'	=> '<br />Người tạo<br />Người sửa',
			'delimiter'	=> '<br />',
			'fields'	=> array(
				array(
					'index' => 'creatorName',
					'type' => 'text',
					'label' => 'Người tạo'
				),
				array(
					'index' => 'modifiedName',
					'type' => 'text',
					'label' => 'Người sửa'
				),
			)
		),
		array(
			'index'	=> 'none5',
			'type'	=> 'group',
			'label'	=> '<br />Ngày tạo<br />Ngày sửa',
			'delimiter'	=> '<br />',
			'fields'	=> array(
				array(
					'index' => 'created',
					'type' => 'datetime',
					'label' => 'Ngày tạo',
					'format'	=> 'H:i d/m'
				),
				array(
					'index' => 'modified',
					'type' => 'datetime',
					'label' => 'Ngày sửa',
					'format'	=> 'H:i d/m'
				),
			)
		),

    );
   public $addLabel = 'Thêm';
   public $addFieldSettings = array(
            array(
            'index' => 'galleryId',
            'type' => 'text',
            'label' => 'Gallery'
        ),
        array(
            'index' => 'url',
            'type' => 'upload',
            'uploadtype'=>'image',
            'label' => 'Chọn ảnh',
        )

    );

    public $editFieldSettings = array(
           array(
            'index' => 'galleryId',
            'type' => 'text',
            'label' => 'Gallery'
        ),
        array(
            'index' => 'url',
            'type' => 'upload',
            'uploadtype'=>'image',
            'label' => 'Chọn ảnh',
        )
    );
	public $menuLinks = array(
        array(
            'name' => 'Quay lại',
            'href' => '/admin_gallery'
        )
    );
	
	
}