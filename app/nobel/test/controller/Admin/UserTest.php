<?php
class PzkAdminUserTestController extends PzkGridAdminController {
	public $addFields = 'name, time, quantity,categoryId,topicId,level';
	public $editFields ='name, time, quantity,categoryId,topicId,level';
	public $table='user_test';
	/*public $joins = array(
        array(
            'table' => 'user',
            'condition' => 'friend.username = user.username',
            'type' =>''
        )
    );*/
	public $sortFields = array(
		'id asc' => 'ID tăng',
		'id desc' => 'ID giảm',
		'name asc' => 'Tên đề thi tăng',
		'name desc' => 'Tên đề thi giảm'
	);
	public $searchFields = array('name');
	public $listFieldSettings = array(
		array(
			'index' => 'name',
			'type' => 'text',
			'label' => 'Tên đề thi'
		),
		array(
			'index' => 'time',
			'type' => 'text',
			'label' => 'Thời gian làm bài '
		),
		array(
			'index' => 'quantity',
			'type' => 'text',
			'label' => 'Số lượng câu hỏi'
		),
		array(
			'index' => 'categoryId',
			'type' => 'text',
			'label' => 'Mã danh mục'
		),
		array(
			'index' => 'topicId',
			'type' => 'text',
			'label' => 'Mã chủ đề'
		),
		array(
			'index' => 'level',
			'type' => 'text',
			'label' => 'Mức độ'
		)
	);
	public $addLabel = 'Thêm mới';
	public $addFieldSettings = array(
		array(
			'index' => 'name',
			'type' => 'text',
			'label' => 'Tên đề thi'
		),
		array(
			'index' => 'time',
			'type' => 'text',
			'label' => 'Thời gian làm bài '
		),
		array(
			'index' => 'quantity',
			'type' => 'text',
			'label' => 'Số lượng câu hỏi'
		),
		array(
            'index' => 'categoryId',
            'type' => 'select',
            'table' => 'categories',
            'show_value' => 'id',
            'show_name' => 'name',
             'label' => 'Danh mục'
        ),
		array(
			'index' => 'topicId',
			'type' => 'select',
			'table' => 'topics',
			'show_value' => 'id',
            'show_name' => 'name',
			'label' => 'Mã chủ đề'
		),
		array(
			'index' => 'level',
			'type' => 'selectoption',
            'option' => array(
                '1'=> 'Dễ',
                '2'=>'Bình thường',
                '3'=>'Khó'
            ),
			'label' => 'Mức độ'
		)
	);
	public $editFieldSettings = array(
		array(
			'index' => 'name',
			'type' => 'text',
			'label' => 'Tên đề thi'
		),
		array(
			'index' => 'time',
			'type' => 'text',
			'label' => 'Thời gian làm bài '
		),
		array(
			'index' => 'quantity',
			'type' => 'text',
			'label' => 'Số lượng câu hỏi'
		),
		array(
            'index' => 'categoryId',
            'type' => 'select',
            'table' => 'categories',
            'show_value' => 'id',
            'show_name' => 'name',
             'label' => 'Danh mục'
        ),
		array(
			'index' => 'topicId',
			'type' => 'select',
			'table' => 'topics',
			'show_value' => 'id',
            'show_name' => 'name',
			'label' => 'Mã chủ đề'
		),
		array(
			'index' => 'level',
			'type' => 'selectoption',
            'option' => array(
                '1'=> 'Dễ',
                '2'=>'Bình thường',
                '3'=>'Khó'
            ),
			'label' => 'Mức độ'
		)
	);
	public $addValidator = array(
		'rules' => array(
			'name' => array(
				'required' => true
			),
			'time' => array(
				'required' => true
				
			),
			'quantity' => array(
				'required' => true
				
			),
			'categoryId' => array(
				'required' => true
				
			),
			'level' => array(
				'required' => true
				
			)

		),
		'messages' => array(
			'name' => array(
				'required' => 'Tên đề thi không được để trống'
				
			),
			'time' => array(
				'required' => 'Thời gian làm bài không được để trống'
			),
			'level' => array(
				'required' => 'Mức độ câu hỏi không được để trống'
			),
			'quantity' => array(
				'required' => 'Số lượng câu hỏi không được để trống'
			),
			'categoryId' => array(
				'required' => 'Danh mục câu hỏi không được để trống'
			)
		)
	);
	public $editValidator = array(
		'rules' => array(
			'name' => array(
				'required' => true
			),
			'time' => array(
				'required' => true
				
			),
			'quantity' => array(
				'required' => true
				
			),
			'categoryId' => array(
				'required' => true
				
			),
			'level' => array(
				'required' => true
				
			)

		),
		'messages' => array(
			'name' => array(
				'required' => 'Tên đề thi không được để trống'
				
			),
			'time' => array(
				'required' => 'Thời gian làm bài không được để trống'
			),
			'level' => array(
				'required' => 'Mức độ câu hỏi không được để trống'
			),
			'quantity' => array(
				'required' => 'Số lượng câu hỏi không được để trống'
			),
			'categoryId' => array(
				'required' => 'Danh mục câu hỏi không được để trống'
			)
		)
	);
}