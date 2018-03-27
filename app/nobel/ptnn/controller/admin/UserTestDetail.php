<?php
class PzkAdminUserTestDetailController extends PzkGridAdminController {
	public $addFields = 'testId, categoryId, quantity,topicId,date_create,user_create,user_modify,date_modify';
	public $editFields ='testId, categoryId, quantity,topicId,date_create,user_create,user_modify,date_modify';
	public $table='user_test_detail';
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
		'testId asc' => 'Mã đề thi tăng',
		'testId desc' => 'Mã đề thi giảm'
	);
	public $searchFields = array('testId');
	public $listFieldSettings = array(
		array(
			'index' => 'testId',
			'type' => 'text',
			'label' => 'Mã đề thi'
		),
		array(
			'index' => 'categoryId',
			'type' => 'text',
			'label' => 'Danh mục '
		),
		array(
			'index' => 'quantity',
			'type' => 'text',
			'label' => 'Số lượng câu hỏi'
		),
		array(
			'index' => 'topicId',
			'type' => 'text',
			'label' => 'Chủ đề'
		)
	);
	public $addLabel = 'Thêm mới';
	public $addFieldSettings = array(
		array(
            'index' => 'testId',
            'type' => 'select',
            'table' => 'user_test',
            'show_value' => 'id',
            'show_name' => 'name',
             'label' => 'Mã đề thi'
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
			'index' => 'quantity',
			'type' => 'text',
			'label' => 'Số lượng câu hỏi'
		),
		array(
			'index' => 'topicId',
			'type' => 'select',
			'table' => 'topics',
			'show_value' => 'id',
            'show_name' => 'name',
			'label' => 'Mã chủ đề'
		)
	);
	public $editFieldSettings = array(
		array(
            'index' => 'testId',
            'type' => 'select',
            'table' => 'user_test',
            'show_value' => 'id',
            'show_name' => 'name',
             'label' => 'Mã đề thi'
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
			'index' => 'quantity',
			'type' => 'text',
			'label' => 'Số lượng câu hỏi'
		),
		array(
			'index' => 'topicId',
			'type' => 'select',
			'table' => 'topics',
			'show_value' => 'id',
            'show_name' => 'name',
			'label' => 'Mã chủ đề'
		)
	);
	public $addValidator = array(
		'rules' => array(
			'testId' => array(
				'required' => true
			),
			'categoryId' => array(
				'required' => true
				
			),
			'quantity' => array(
				'required' => true
				
			),
			'topicId' => array(
				'required' => true
				
			)
		),
		'messages' => array(
			'testId' => array(
				'required' => 'Mã đề thi không được để trống'
				
			),
			'categoryId' => array(
				'required' => 'Mã danh mục không được để trống'
			),
			'topicId' => array(
				'required' => 'Mã chủ đề không được để trống'
			)
		)
	);
	public $editValidator = array(
		'rules' => array(
			'testId' => array(
				'required' => true
			),
			'categoryId' => array(
				'required' => true
				
			),
			'quantity' => array(
				'required' => true
				
			),
			'topicId' => array(
				'required' => true
				
			)
		),
		'messages' => array(
			'testId' => array(
				'required' => 'Mã đề thi không được để trống'
				
			),
			'categoryId' => array(
				'required' => 'Mã danh mục không được để trống'
			),
			'topicId' => array(
				'required' => 'Mã chủ đề không được để trống'
			)
		)
	);
}