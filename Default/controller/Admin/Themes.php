<?php
class PzkAdminThemesController extends PzkGridAdminController {
	public $title = 'Quản lý giao diện';
	public $table = 'themes';
	public $addFields = 'name,status,startDate,endDate,content,layouts,controllers,files,modules,objects,software,global,sharedSoftwares';
	public $editFields = 'name,status,startDate,endDate,content,layouts,controllers,files,modules,objects,software,global,sharedSoftwares';
	public $logable = true;
	public $logFields = 'name,status,startDate,endDate';
	public $sortFields = array(
		'id asc' => 'ID tăng',
		'id desc' => 'ID giảm',
		'name asc' => 'Tiêu đề tăng',
		'name desc' => 'Tiêu đề giảm'
	);
	public $listFieldSettings = array(
        array(
            'index' => 'site',
            'type' => 'text',
            'label' => 'Site'
        ),
		array(
            'index' => 'name',
            'type' => 'text',
            'label' => 'Tên Themes'
        ),
		array(
            'index' => 'startDate',
            'type' => 'datetime',
			'format' => 'd/m/Y',
            'label' => 'Ngày bắt đầu'
        ),
		array(
            'index' => 'endDate',
            'type' => 'datetime',
			'format' => 'd/m/Y',
            'label' => 'Ngày kết thúc'
        ),
		
		array(
            'index' => 'status',
            'type' => 'status',
            'label' => 'Trạng thái'
        ),
		array(
            'index' => 'default',
            'type' => 'status',
            'label' => 'Default'
        ),
	);
    public $addLabel = 'Thêm';
    public $addFieldSettings = array(
        array(
            'index' => 'name',
            'type' => 'text',
            'label' => 'Tên Themes'
        ),

		array(
            'index' => 'status',
            'type' => 'status',
            'label' => 'Trạng thái'
        ),
		array(
            'index' => 'startDate',
            'type' => 'datepicker',
			'format' => 'd/m/Y',
            'label' => 'Ngày bắt đầu'
        ),
		array(
            'index' => 'endDate',
            'type' => 'datepicker',
			'format' => 'd/m/Y',
            'label' => 'Ngày kết thúc'
        ),
		array(
            'index' => 'content',
            'type' => 'tinymce',
            'label' => 'Nội dung'
        )
    );
    public $editFieldSettings = array(
        array(
            'index' => 'name',
            'type' => 'text',
            'label' => 'Tên Themes'
        ),

		array(
            'index' => 'status',
            'type' => 'status',
            'label' => 'Trạng thái'
        ),
		array(
            'index' => 'startDate',
            'type' => 'datepicker',
			'format' => 'd/m/Y',
            'label' => 'Ngày bắt đầu'
        ),
		array(
            'index' => 'endDate',
            'type' => 'datepicker',
			'format' => 'd/m/Y',
            'label' => 'Ngày kết thúc'
        ),
		array(
            'index' => 'content',
            'type' => 'tinymce',
            'label' => 'Nội dung'
        ),
		array(
            'index' => 'layouts',
            'type' 	=> 'dimension',
			'deep'	=> 3,
            'label' => 'Bố cục',
			'settings' => array(
				array(
					'type'	=> 	'text',
					'label'	=>	'Tên bố cục'
				)
			)
        ),
		array(
            'index' => 'controllers',
            'type' 	=> 'table',
            'label' => 'Controller/Action',
			'settings' => array(
				array(
					'type'	=> 	'text',
					'index'	=>	'name',
					'label'	=>	'Tên Controller/Action'
				),
				array(
					'type'	=> 	'text',
					'index'	=>	'path',
					'label'	=>	'Đường dẫn Controller/Action'
				),
				array(
					'type'	=> 	'text',
					'index'	=>	'layout',
					'label'	=>	'Tên bố cục'
				),
				array(
					'type'	=> 	'text',
					'index'	=>	'page',
					'label'	=>	'Tên page'
				),
			)
        ),
		array(
            'index' => 'modules',
            'type' 	=> 'table',
            'label' => 'Additional Modules',
			'settings' => array(
				array(
					'type'	=> 	'text',
					'index'	=>	'name',
					'label'	=>	'Tên Controller/Action'
				),
				array(
					'type'	=> 	'text',
					'index'	=>	'position',
					'label'	=>	'Vị trí'
				),
				array(
					'type'	=> 	'text',
					'index'	=>	'path',
					'label'	=>	'Đường dẫn Module'
				)
			)
        ),
		array(
            'index' => 'objects',
            'type' 	=> 'table',
            'label' => 'Objects',
			'settings' => array(
				array(
					'type'	=> 	'text',
					'index'	=>	'name',
					'label'	=>	'Tên Object'
				),
				array(
					'type'	=> 	'text',
					'index'	=>	'object',
					'label'	=>	'Object'
				),
				array(
					'type'	=> 	'text',
					'index'	=>	'layout',
					'label'	=>	'Layout'
				),
				array(
					'type'	=> 	'text',
					'index'	=>	'js',
					'label'	=>	'Javascript'
				),
				array(
					'type'	=> 	'text',
					'index'	=>	'css',
					'label'	=>	'Css'
				)
			)
        ),
		array(
            'index' => 'files',
            'type' 	=> 'table',
            'label' => 'Các Files',
			'settings' => array(
				array(
					'type'	=> 	'text',
					'index'	=>	'path',
					'label'	=>	'Đường dẫn File'
				),
				array(
					'type'	=> 	'text',
					'index'	=>	'type',
					'label'	=>	'Loại File'
				),
			)
        ),
    );
	public $addValidator = array(
		'rules' => array(
			'name' => array(
				'required' => true,
				'minlength' => 2,
				'maxlength' => 255
			)
		),
		'messages' => array(
			'name' => array(
				'required' => 'Tên bài viết không được để trống',
				'minlength' => 'Tên bài viết phải từ hai ký tự trở lên',
				'maxlength' => 'Tên bài viết tối đa 255 ký tự'
			)
		)
	);
	public $editValidator = array(
		'rules' => array(
			'name' => array(
				'required' => true,
				'minlength' => 2,
				'maxlength' => 255
			)
		),
		'messages' => array(
			'name' => array(
				'required' => 'Tên bài viết không được để trống',
				'minlength' => 'Tên bài viết phải từ hai ký tự trở lên',
				'maxlength' => 'Tên bài viết tối đa 255 ký tự'
			)
		)
	);
}
	
?>