<?php
class PzkAdminGalleryController extends PzkGridAdminController {
	public $title = 'Quản lý Gallery';
	public $table = 'gallery';
	public $addFields = 'title, date, brief';
	public $editFields = 'title, date, brief';
	public $logable = true;
	public $logFields = 'title, date, brief';	
	public $sortFields = array(
		'id asc' => 'ID tăng',
		'id desc' => 'ID giảm',
		'date asc' => 'Ngày tăng',
		'date desc' => 'Ngày giảm'
		
	);
	public $selectFields = 'gallery.*, categories.name as categoryName, campaign.name as campaignName, creator.name as creatorName, modifier.name as modifiedName';
	public $joins = array(
		array(
			'table' => 'categories',
			'condition' => 'gallery.categoryId = categories.id',
			'type' => JOIN_TYPE_LEFT
		),
		array(
			'table' => 'campaign',
			'condition' => 'gallery.campaignId = campaign.id',
			'type' => JOIN_TYPE_LEFT
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
	public $listFieldSettings = array(
		array(
            'index' => 'title',
            'type' => 'text',
            'label' => 'Hoạt động',
			'link'	=> '/admin_gallery/view/'
        ),
        array(
            'index' => 'brief',
            'type' => 'text',
            'label' => 'Mô tả ngắn gọn',
			'link'	=> '/admin_gallery/edit/'
        ),
		array(
            'index' => 'date',
            'type' => 'datetime',
			'format'	=> 'd/m/Y',
            'label' => 'Ngày diễn ra'
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
	public $childrenGridSettings = array(
		array(
			'title'	=> 'Hình ảnh',
			'label'	=> 'Hình ảnh',
			'table'	=> 'gallery_img',
			'index'	=> 'images',
			'parentField'	=> 'galleryId',
			'module'	=> 'galleryadd',
			'listFieldSettings'	=> array(
				array(
					'index' => 'url',
					'type' => 'image',
					'label' => 'Ảnh'
				)
			)
		)
	);
	public $viewFieldSettings = array(
		array(
            'index' => 'title',
            'type' => 'text',
            'label' => 'Hoạt động'
        ),
        array(
            'index' => 'brief',
            'type' => 'text',
            'label' => 'Mô tả ngắn gọn'
        ),
		array(
            'index' => 'date',
            'type' => 'datetime',
			'format'	=> 'd/m/Y',
            'label' => 'Ngày diễn ra'
        )
	);
	public $addLabel = 'Thêm';
	public $addFieldSettings = array(
        array(
            'index' => 'title',
            'type' => 'text',
            'label' => 'Hoạt động'
        ),
        array(
            'index' => 'brief',
            'type' => 'text',
            'label' => 'Mô tả ngắn gọn'
        ),
		
		array(
            'index' => 'date',
            'type' => 'datepicker',
            'label' => 'Ngày diễn ra'
        )

    );

    public $editFieldSettings = array(
           array(
            'index' => 'title',
            'type' => 'text',
            'label' => 'Hoạt động'
        ),
        array(
            'index' => 'brief',
            'type' => 'text',
            'label' => 'Mô tả ngắn gọn'
        ),
		
		array(
            'index' => 'date',
            'type' => 'datepicker',
            'label' => 'Ngày diễn ra'
        )


		
    );
	//add menu links
    public $menuLinks = array(
        array(
            'name' => 'Thêm ảnh hoạt động',
            'href' => '/admin_galleryadd'
        )
    );
	
}