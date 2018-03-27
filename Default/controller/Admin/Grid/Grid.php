<?php
class PzkAdminGridGridController extends PzkGridAdminController {
	public $addFields = 'name,table,selectFields,joins,childTables,filterFields,listSettingType,listFieldSettings,addLabel,addFields,addFieldSettings,editLabel,editFields,editFieldSettings,searchFields,searchLabels,filterFieldSettings,sortFields,title,fixedPageSize,orderBy';
	public $editFields ='name,table,selectFields,joins,childTables,filterFields,listSettingType,listFieldSettings,addLabel,addFields,addFieldSettings,editLabel,editFields,editFieldSettings,searchFields,searchLabels,filterFieldSettings,sortFields,title,fixedPageSize,orderBy';
	public $table='grid_grid';
    public $selectFields = '*';
	public $sortFields = array(
		'id asc' => 'ID tăng',
		'id desc' => 'ID giảm'
	);
	public $searchFields = array('name');
	public $listFieldSettings = array(
		
		array(
			'index' => 'name',
			'type' => 'text',
			'label' => 'Tên Grid'
		),
		array(
			'index' => 'title',
			'type' => 'text',
			'label' => 'Tiêu đề grid'
		)
	);
	public $addLabel = 'Thêm mới';
	public $addFieldSettings = array(
		array(
			'index' 	=> 'name',
			'type' 		=> 'text',
			'label' 	=> 'Tên'
		),
		
		array(
			'index' 	=> 'title',
			'type' 		=> 'text',
			'label' 	=> 'Tiêu đề'
		),
		array(
			'index' 	=> 'table',
			'type' 		=> 'text',
			'label' 	=> 'Bảng'
		),
		array(
			'index' 	=> 'joins',
			'type' 		=> 'dimension',
			'label' 	=> 'Nối bảng',
			'deep'		=> 2,
			'settings'	=> array(
				array(
					'type'	=> 'text'
				),
				array(
					'type'	=> 'selectoption',
					'option'=> array(
						'table'			=> 	'table',
						'type'			=>	'type',
						'condition'		=> 	'condition'
					)
				),
			)
		),
		array(
			'index' 	=> 'selectFields',
			'type' 		=> 'text',
			'label' 	=> 'Các trường cần hiển thị'
		),
		array(
			'index' 	=> 'orderBy',
			'type' 		=> 'text',
			'label' 	=> 'Sắp xếp theo'
		),
		array(
			'index' 	=> 'fixedPageSize',
			'type' 		=> 'text',
			'label' 	=> 'Thứ tự cố định'
		),
		array(
			'index' 	=> 'listSettingType',
			'type' 		=> 'selectoption',
			'label' 	=> 'Kiểu hiển thị',
			'option' 	=> array(
				''			=> 'Bình thường',
				'parent'	=> 'Kiểu Cây'
			)
		),
		array(
			'index' 	=> 'sortFields',
			'type' 		=> 'dimension',
			'label' 	=> 'Sắp xếp theo',
			'deep'		=>	1
		),
		array(
			'index' 	=> 'listFieldSettings',
			'type' 		=> 'dimension',
			'label' 	=> 'Hiển thị các trường',
			'deep'		=>	2,
			'settings'	=> array(
				array(
					'type'	=> 'text'
				),
				array(
					'type'	=> 'selectoption',
					'option'=> array(
						'index'	=> 	'index',
						'type'	=>	'type',
						'label'	=> 	'label'
					)
				),
			)
		),
		array(
			'index' 	=> 'searchLabels',
			'type' 		=> 'text',
			'label' 	=> 'Tiêu đề tìm kiếm'
		),
		array(
			'index' 	=> 'searchFields',
			'type' 		=> 'dimension',
			'label' 	=> 'Tìm theo các trường',
			'deep'		=> 1
		),
		array(
			'index' 	=> 'filterFields',
			'type' 		=> 'dimension',
			'label' 	=> 'Lọc theo các trường',
			'deep'		=>	2,
			'settings'	=> array(
				array(
					'type'	=> 'text'
				),
				array(
					'type'	=> 'selectoption',
					'option'=> array(
						'index'	=> 	'index',
						'type'	=>	'type',
						'label'	=> 	'label'
					)
				),
			)
		),
		array(
			'index' 	=> 'addLabel',
			'type' 		=> 'text',
			'label' 	=> 'Tiêu đề Thêm bản ghi'
		),
		array(
			'index' 	=> 'addFields',
			'type' 		=> 'text',
			'label' 	=> 'Các trường database để thêm'
		),
		array(
			'index' 	=> 'addFieldSettings',
			'type' 		=> 'dimension',
			'label' 	=> 'Các trường để Thêm bản ghi mới',
			'deep'		=>	2,
			'settings'	=> array(
				array(
					'type'	=> 'text'
				),
				array(
					'type'	=> 'selectoption',
					'option'=> array(
						'index'	=> 	'index',
						'type'	=>	'type',
						'label'	=> 	'label'
					)
				),
			)
		),
		array(
			'index' 	=> 'editLabel',
			'type' 		=> 'text',
			'label' 	=> 'Tiêu đề Sửa bản ghi'
		),
		array(
			'index' 	=> 'editFields',
			'type' 		=> 'text',
			'label' 	=> 'Các trường database để sửa'
		),
		array(
			'index' 	=> 'editFieldSettings',
			'type' 		=> 'dimension',
			'label' 	=> 'Các trường để Sửa bản ghi',
			'deep'		=>	2,
			'settings'	=> array(
				array(
					'type'	=> 'text'
				),
				array(
					'type'	=> 'selectoption',
					'option'=> array(
						'index'	=> 	'index',
						'type'	=>	'type',
						'label'	=> 	'label'
					)
				),
			)
		),
	);
	public $editFieldSettings = array(
		array(
			'index' 	=> 'name',
			'type' 		=> 'text',
			'label' 	=> 'Tên'
		),
		
		array(
			'index' 	=> 'title',
			'type' 		=> 'text',
			'label' 	=> 'Tiêu đề'
		),
		array(
			'index' 	=> 'table',
			'type' 		=> 'text',
			'label' 	=> 'Bảng'
		),
		array(
			'index' 	=> 'joins',
			'type' 		=> 'dimension',
			'label' 	=> 'Nối bảng',
			'deep'		=> 2,
			'settings'	=> array(
				array(
					'type'	=> 'text'
				),
				array(
					'type'	=> 'selectoption',
					'option'=> array(
						'table'			=> 	'table',
						'type'			=>	'type',
						'condition'		=> 	'condition'
					)
				),
			)
		),
		array(
			'index' 	=> 'selectFields',
			'type' 		=> 'text',
			'label' 	=> 'Các trường cần hiển thị'
		),
		array(
			'index' 	=> 'orderBy',
			'type' 		=> 'text',
			'label' 	=> 'Sắp xếp theo'
		),
		array(
			'index' 	=> 'fixedPageSize',
			'type' 		=> 'text',
			'label' 	=> 'Thứ tự cố định'
		),
		array(
			'index' 	=> 'listSettingType',
			'type' 		=> 'selectoption',
			'label' 	=> 'Kiểu hiển thị',
			'option' 	=> array(
				''			=> 'Bình thường',
				'parent'	=> 'Kiểu Cây'
			)
		),
		array(
			'index' 	=> 'sortFields',
			'type' 		=> 'dimension',
			'label' 	=> 'Sắp xếp theo',
			'deep'		=>	1
		),
		array(
			'index' 	=> 'listFieldSettings',
			'type' 		=> 'dimension',
			'label' 	=> 'Hiển thị các trường',
			'deep'		=>	2,
			'settings'	=> array(
				array(
					'type'	=> 'text'
				),
				array(
					'type'	=> 'selectoption',
					'option'=> array(
						'index'	=> 	'index',
						'type'	=>	'type',
						'label'	=> 	'label'
					)
				),
			)
		),
		array(
			'index' 	=> 'searchLabels',
			'type' 		=> 'text',
			'label' 	=> 'Tiêu đề tìm kiếm'
		),
		array(
			'index' 	=> 'searchFields',
			'type' 		=> 'dimension',
			'label' 	=> 'Tìm theo các trường',
			'deep'		=> 1
		),
		array(
			'index' 	=> 'filterFields',
			'type' 		=> 'dimension',
			'label' 	=> 'Lọc theo các trường',
			'deep'		=>	2,
			'settings'	=> array(
				array(
					'type'	=> 'text'
				),
				array(
					'type'	=> 'selectoption',
					'option'=> array(
						'index'	=> 	'index',
						'type'	=>	'type',
						'label'	=> 	'label'
					)
				),
			)
		),
		array(
			'index' 	=> 'addLabel',
			'type' 		=> 'text',
			'label' 	=> 'Tiêu đề Thêm bản ghi'
		),
		array(
			'index' 	=> 'addFields',
			'type' 		=> 'text',
			'label' 	=> 'Các trường database để thêm'
		),
		array(
			'index' 	=> 'addFieldSettings',
			'type' 		=> 'dimension',
			'label' 	=> 'Các trường để Thêm bản ghi mới',
			'deep'		=>	2,
			'settings'	=> array(
				array(
					'type'	=> 'text'
				),
				array(
					'type'	=> 'selectoption',
					'option'=> array(
						'index'	=> 	'index',
						'type'	=>	'type',
						'label'	=> 	'label'
					)
				),
			)
		),
		array(
			'index' 	=> 'editLabel',
			'type' 		=> 'text',
			'label' 	=> 'Tiêu đề Sửa bản ghi'
		),
		array(
			'index' 	=> 'editFields',
			'type' 		=> 'text',
			'label' 	=> 'Các trường database để sửa'
		),
		array(
			'index' 	=> 'editFieldSettings',
			'type' 		=> 'dimension',
			'label' 	=> 'Các trường để Sửa bản ghi',
			'deep'		=>	2,
			'settings'	=> array(
				array(
					'type'	=> 'text'
				),
				array(
					'type'	=> 'selectoption',
					'option'=> array(
						'index'	=> 	'index',
						'type'	=>	'type',
						'label'	=> 	'label'
					)
				),
			)
		)
	);
}