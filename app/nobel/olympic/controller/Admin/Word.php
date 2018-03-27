<?php 
class PzkAdminWordController extends PzkGridAdminController {
	public $title = "Quản lí word";
	public $table = "word";
	public $listFieldSettings = array(
		array(
			'index' => 'content',
			'type' => 'text',
			'label' => 'Nội dung bài'
		),
		array(
			'index' => 'categoryIds',
			'type' => 'nameid',
			'label' => 'Danh mục',
			'table' => 'categories',
			'findField' => 'id',
			'showField' => 'name'
		),
		array(
			'index' => 'testId',
			'type' => 'nameid',
			'label' => 'Đề thi',
			'table' => 'tests',
			'findField' => 'id',
			'showField' => 'name'
		),
		array(
			'index' => 'type',
			'type' => 'text',
			'label' => 'Type'
		),
		array(
			'index' => 'exnum',
			'type' => 'ordering',
			'label' => 'Bài tập'
		),
		array(
			'index' => 'status',
			'type' => 'status',
			'label' => 'Status'
		)
		
	);
	//search
	public $searchFields = array('id', 'name');
	public $searchLabel = "Tìm theo id hoặc name";
	//filter
	public $filterFields = array(
		array(
			'index' => 'categoryIds',
			'type' => 'select',
			'label' => 'Danh mục',
			'table' => 'categories',
			'show_value' => 'id',
			'show_name' => 'name',
			'like' => 'true'
		),
		array(
			'index' => 'testId',
			'type' => 'select',
			'label' => 'Đề thi',
			'table' => 'tests',
			'show_value' => 'id',
			'show_name' => 'name',
			'like' => 'true',
		),
		array(
			'index' => 'status',
			'type' => 'status',
			'label' => 'Status'
		)
	);
	//sort by
	public $sortFields = array(
		'id asc' => 'ID tăng',
		'id desc' => 'ID giảm',
		'exnum asc' => 'Bài tăng',
		'exnum desc' => 'Bài giảm',
		'ordering asc' => 'Thứ tự tăng',
		'ordering desc' => 'Thứ tự giảm'
	);
	//update data on curent table
	public $updateMenu = true;
    public $updateData = array(
        array(
            'index' => 'categoryIds',
            'type' => 'mutiSelect',
            'label' => 'Cập danh mục',
            'selectLabel' =>'Chọn danh mục',
            'nameField'=>"Danh mục",
            'table' => 'categories',
            'show_value' => 'id',
            'show_name' => 'name',
        ),
        array(
            'index' => 'testId',
            'type' => 'mutiSelect',
            'label' => 'Cập nhật đề',
            'selectLabel' =>'Chọn đề',
            'nameField'=>"Đề thi",
            'table' => 'tests',
            'show_value' => 'id',
            'show_name' => 'name',
        )
    );
	//add
	public $addLabel = "Thêm một bài";
	public $addFields = 'categoryIds, content, testId, type, status, software, global, sharedSoftwares';
	public $addFieldSettings = array(
		array(
			'index' => 'content',
			'type' => 'tinymce',
			'label' => 'Nội dụng bài'
		),
		array(
			'index' => 'type',
			'type' => 'select',
			'label' => 'Chọn dạng',
			'table' => 'questiontype',
			'show_name' => 'name',
			'show_value' => 'question_type'
		),
		array(
			'index' => 'categoryIds',
			'type' => 'multiselect',
			'label' => 'Danh mục',
			'table' => 'categories',
			'show_name' => 'name',
			'show_value' => 'id'
		),
		array(
			'index' => 'testId',
			'type' => 'multiselect',
			'label' => "Chọn đề",
			'table' => 'tests',
			'show_name' => 'name',
			'show_value' => 'id'
		),
		 array(
            'index' => 'status',
            'type' => 'status',
            'label' => 'Status',
            'options' => array(
                '0' => 'Không hoạt động',
                '1' => 'Hoạt động'
            ),
            'actions' => array(
                '0' => 'mở',
                '1' => 'dừng'
            )
        )
	);
	public $addValidator = array(
		'rules' => array(
			'content' => array(
				'required' => true,
				'minlength' => 2,
				
			),
			
		),
		'messages' => array(
			'name' => array(
				'required' => 'Nội dung không được để trống',
				'minlength' => 'Nội dung phải dài 2 ký tự trở lên',
				
			),
			
		)
	);
	//edit
	public $editLabel = "Thêm một bài";
	public $editFields = 'categoryIds, content, testId, type, status, software, global, sharedSoftwares';
	public $editFieldSettings = array(
		array(
			'index' => 'content',
			'type' => 'tinymce',
			'label' => 'Nội dụng bài'
		),
		array(
			'index' => 'type',
			'type' => 'select',
			'label' => 'Chọn dạng',
			'table' => 'questiontype',
			'show_name' => 'name',
			'show_value' => 'question_type'
		),
		array(
			'index' => 'categoryIds',
			'type' => 'multiselect',
			'label' => 'Danh mục',
			'table' => 'categories',
			'show_name' => 'name',
			'show_value' => 'id'
		),
		array(
			'index' => 'testId',
			'type' => 'multiselect',
			'label' => "Chọn đề",
			'table' => 'tests',
			'show_name' => 'name',
			'show_value' => 'id'
		),
		 array(
            'index' => 'status',
            'type' => 'status',
            'label' => 'Status',
            'options' => array(
                '0' => 'Không hoạt động',
                '1' => 'Hoạt động'
            ),
            'actions' => array(
                '0' => 'mở',
                '1' => 'dừng'
            )
        )
	);
	public $editValidator = array(
		'rules' => array(
			'content' => array(
				'required' => true,
				'minlength' => 2,
				
			),
			
		),
		'messages' => array(
			'name' => array(
				'required' => 'Nội dung không được để trống',
				'minlength' => 'Nội dung phải dài 2 ký tự trở lên',
				
			),
			
		)
	);
}
?>