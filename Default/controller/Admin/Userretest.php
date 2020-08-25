<?php
class PzkAdminUserretestController extends PzkGridAdminController {
    public $titleController = 'Quản lí thi lại';
    public $table = 'user_retest';
    public $listFieldSettings = array(
        array(
            'index' => 'id',
            'type' => 'text',
            'label' => 'ID'
        ),
		array(
            'index' => 'username',
            'type' => 'text',
            'label' => "Tên đăng nhập"
        ),
		
        array(
            'index'     => 'contestId',
            'type'      => 'nameid',
            'table'     => 'contest',
            'findField' => 'id',
            'showField' => 'name',
            'label'     => 'Cuộc thi',
            
        ),
		
        array(
            'index' => 'status',
            'type' => 'status',
            'label' => 'Trạng thái'
        ),
        
    );

    public $searchFields = array('username');
    public $searchLabel = 'Tên user';
	

    public $addFields = 'username, startDate, endDate, resultDate, contestId, status, practice, creatorId, created, software, site';
    public $addLabel = 'Thêm người thi';

    public $addFieldSettings = array(
        array(
            'index' => 'username',
            'type' => 'text',
            'label' => 'Tên đề thi'
        ),
		array(
			'index' => 'contestId',
			'type'	=> 'select',
			'table' => 'contest',
			'show_value' => 'id',
			'show_name' => 'name'
		),
		array(
            'index' => 'startDate',
            'type' => 'datetimepicker',
            'label' => 'Ngày bắt đầu'
        ),
		array(
            'index' => 'endDate',
            'type' => 'datetimepicker',
            'label' => 'Ngày kết thúc'
        ),
		array(
            'index' => 'resultDate',
            'type' => 'datetimepicker',
            'label' => 'Ngày xem đáp án'
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
            'username' => array(
                'required' => true,
                'minlength' => 2,
                'maxlength' => 1000
            )
        ),
        'messages' => array(
            'name' => array(
                'required' => 'username đề thi không được để trống',
                'minlength' => 'username đề thi phải dài 2 ký tự trở lên',
                'maxlength' => 'username đề thi chỉ dài tối đa 255 ký tự'
            )
        )
    );

    public $editLabel = 'Sửa đề thi';
    public $editFields = 'username, startDate, endDate, resultDate, contestId, status, practice, software, site';

    public $editFieldSettings = array(
        array(
            'index' => 'username',
            'type' => 'text',
            'label' => 'Tên đề thi'
        ),
		array(
			'index' => 'contestId',
			'type'	=> 'select',
			'table' => 'contest',
			'show_value' => 'id',
			'show_name' => 'name'
		),
		array(
            'index' => 'startDate',
            'type' => 'datetimepicker',
            'label' => 'Ngày bắt đầu'
        ),
		array(
            'index' => 'endDate',
            'type' => 'datetimepicker',
            'label' => 'Ngày kết thúc'
        ),
		array(
            'index' => 'resultDate',
            'type' => 'datetimepicker',
            'label' => 'Ngày xem đáp án'
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
            'username' => array(
                'required' => true,
                'minlength' => 2,
                'maxlength' => 1000
            )
        ),
        'messages' => array(
            'username' => array(
                'required' => 'username đề thi không được để trống',
                'minlength' => 'username đề thi phải dài 2 ký tự trở lên',
                'maxlength' => 'username đề thi chỉ dài tối đa 1000 ký tự'
            )
        )

    );

}