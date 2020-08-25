<?php
class PzkAdminTopicsController extends PzkGridAdminController {
	
	public $titleController = 'Topics';
	public $table = 'topics';
	public $listFieldSettings = array(
			array(
					'index' => 'name',
					'type' => 'text',
					'label' => 'Chủ đề'
			)
	);
	
	public $searchFields = array('name');
	public $searchLabel = 'Chủ đề';
	
	public $addFields = 'name, category_id, status';
	public $addLabel = 'Thêm chủ đề';
	public $logable = true;
	public $logFields = 'name, category_id, status';
	public $addFieldSettings = array(
			array(
					'index' => 'name',
					'type' => 'text',
					'label' => 'Chủ đề'
			),
            array(
                'index' => 'category_id',
                'type' => 'select',
                'label' => 'Menu cha',
                'table' => 'categories',
                'show_name' => 'name',
                'show_value' =>'id'

            ),
            array(
                'index' => 'status',
                'type' => 'status',
                'label' => 'Trạng thái',
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
			'name' => array(
				'required' => true,
				'minlength' => 2,
				'maxlength' => 1000
			)
		),
		'messages' => array(
			'name' => array(
				'required' => 'Tên chủ điểm không được để trống',
				'minlength' => 'Tên chủ điểm phải dài 2 ký tự trở lên',
				'maxlength' => 'Tên chủ điểm chỉ dài tối đa 255 ký tự'
			)
		)
	);
	
	public $editLabel = 'Sửa chủ đề';
	public $editFields = 'name, category_id, status, createdId, created, modifiedId, modified';
	
	public $editFieldSettings = array(
			array(
					'index' => 'name',
					'type' => 'text',
					'label' => 'Chủ đề'
			),
            array(
                    'index' => 'category_id',
                    'type' => 'select',
                    'label' => 'Menu cha',
                    'table' => 'categories',
                    'show_name' => 'name',
                    'show_value' =>'id'

                ),
            array(
                'index' => 'status',
                'type' => 'status',
                'label' => 'Trạng thái',
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
					'name' => array(
							'required' => true,
							'minlength' => 2,
							'maxlength' => 50
					)
			),
			'messages' => array(
					'name' => array(
							'required' => 'Chủ đề không được để trống',
							'minlength' => 'Chủ đề phải dài 2 ký tự trở lên',
							'maxlength' => 'Chủ đề chỉ dài tối đa 50 ký tự'
					)
			)

	);
}