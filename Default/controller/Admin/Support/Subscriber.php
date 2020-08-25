<?php
class PzkAdminSupportSubscriberController extends PzkGridAdminController {
    public $title = 'Quản trị người đăng ký nhận thư báo';
	public $addFields = 'email, note, status';
    public $editFields = 'email, note, status';
    public $table = 'support_subscribe';
    public $filterStatus = true;
	public $logable = true;
	public $logFields = 'email, created, status';
    public $sortFields = array(
        'id asc' => 'ID tăng',
        'id desc' => 'ID giảm',
        'email asc' => 'Email tăng',
        'email desc' => 'Email giảm',
    	'created asc' => 'Ngày đăng ký tăng',
    	'created desc' => 'Ngày đăng ký giảm',
    );
    public $searchFields = array('name', 'phone','email', 'note');
    public $searchLabel = 'Email';
    public $listFieldSettings = array(
        array(
            'index' => 'name',
            'type' => 'text',
            'label' => 'Họ tên'
        ),
		array(
            'index' => 'phone',
            'type' => 'text',
            'label' => 'Số điện thoại'
        ),
		array(
            'index' => 'email',
            'type' => 'text',
            'label' => 'Thư điện tử'
        ),
		array(
            'index' => 'class',
            'type' => 'text',
            'label' => 'Lớp'
        ),
		array(
            'index' => 'note',
            'type' => 'text',
            'label' => 'Ghi chú'
        ),
		array(
            'index' => 'created',
            'type' => 'datetime',
			'format' => 'd/m/Y H:i',
            'label' => 'Ngày đăng ký'
        ),
        array(
            'index' => 'status',
            'type' => 'status',
            'label' => 'Trạng thái'
        ),
    );
    public $addLabel = 'Thêm người đăng ký';
    public $addFieldSettings = array(
        array(
            'index' => 'email',
            'type' => 'text',
            'label' => 'Email',
        ),
        array(
            'index' => 'registered',
            'type' => 'text',
            'label' => 'Ngày đăng ký'
        ),
        array(
            'index' => 'status',
            'type' => 'status',
            'label' => 'Trạng thái'
        )
    );
    public $editFieldSettings = array(
        array(
            'index' => 'email',
            'type' => 'text',
            'label' => 'Email',
        ),
        array(
            'index' => 'registered',
            'type' => 'text',
            'label' => 'Ngày đăng ký'
        ),
        array(
            'index' => 'status',
            'type' => 'status',
            'label' => 'Trạng thái'
        )
    );
    public $addValidator = array(
        'rules' => array(
            'email' => array(
                'required' => true,
                'minlength' => 2,
                'maxlength' => 50
            )

        ),
        'messages' => array(
            'email' => array(
                'required' => 'Tên menu không được để trống',
                'minlength' => 'Tên menu phải dài 2 ký tự trở lên',
                'maxlength' => 'Tên menu chỉ dài tối đa 50 ký tự'
            )

        )
    );
    public $editValidator = array(
        'rules' => array(
            'email' => array(
                'required' => true,
                'minlength' => 2,
                'maxlength' => 50
            )

        ),
        'messages' => array(
            'email' => array(
                'required' => 'Tên menu không được để trống',
                'minlength' => 'Tên menu phải dài 2 ký tự trở lên',
                'maxlength' => 'Tên menu chỉ dài tối đa 50 ký tự'
            )

        )
    );

}
?>