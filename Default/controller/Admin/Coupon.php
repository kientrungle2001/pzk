<?php
class PzkAdminCouponController extends PzkGridAdminController {
	public $title = 'Quản lý Coupon';
	public $table = 'coupon';
	public $addFields = 'code,startDate,endDate,expiredDate,discount,resellerDiscount,resellerId,software,global,sharedSoftwares,status';
	public $editFields = 'code,startDate,endDate,expiredDate,discount,resellerDiscount,resellerId,software,global,sharedSoftwares,status';
	public $logable = true;
	public $logFields = 'code,status,startDate,endDate';
	public $sortFields = array(
		'id asc' => 'ID tăng',
		'id desc' => 'ID giảm',
		'code asc' => 'Tiêu đề tăng',
		'code desc' => 'Tiêu đề giảm'
	);
	public $listFieldSettings = array(
        array(
            'index' 	=> 'code',
            'type' 		=> 'text',
            'label' 	=> 'Mã coupon'
        ),
		array(
            'index' 	=> 'resellerId',
            'type' 		=> 'nameid',
            'label' 	=> 'Đại lý',
			'table'		=>	'admin',
			'findField'	=>	'id',
			'showField'	=>	'name'
        ),
		array(
            'index' 	=> 'discount',
            'type' 		=> 'text',
            'label' 	=> 'Giảm giá cho khách hàng'
        ),
		array(
            'index' 	=> 'resellerDiscount',
            'type' 		=> 'text',
            'label' 	=> 'Chiết khấu cho đại lý'
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
	);
    public $addLabel = 'Thêm';
    public $addFieldSettings = array(
        array(
            'index' 	=> 'code',
            'type' 		=> 'text',
            'label' 	=> 'Mã coupon'
        ),
		array(
            'index' 	=> 'resellerId',
            'type' 		=> 'select',
            'label' 	=> 'Đại lý',
			'table'		=>	'admin',
			'show_name' =>	'name',
			'show_value'=>	'id'
        ),
		array(
            'index' 	=> 'discount',
            'type' 		=> 'text',
            'label' 	=> 'Giảm giá cho khách hàng'
        ),
		array(
            'index' 	=> 'resellerDiscount',
            'type' 		=> 'text',
            'label' 	=> 'Chiết khấu cho đại lý'
        ),
		array(
            'index' 	=> 'status',
            'type' 		=> 'status',
            'label' 	=> 'Trạng thái'
        ),
		array(
            'index' 	=> 'startDate',
            'type' 		=> 'datepicker',
			'format' 	=> 'd/m/Y',
            'label' 	=> 'Ngày bắt đầu'
        ),
		array(
            'index' 	=> 'endDate',
            'type' 		=> 'datepicker',
			'format' 	=> 'd/m/Y',
            'label' 	=> 'Ngày kết thúc'
        ),
		array(
            'index' 	=> 'content',
            'type' 		=> 'tinymce',
            'label' 	=> 'Nội dung'
        )
    );
    public $editFieldSettings = array(
        array(
            'index' 	=> 'code',
            'type' 		=> 'text',
            'label' 	=> 'Mã coupon'
        ),
		array(
            'index' 	=> 'resellerId',
            'type' 		=> 'select',
            'label' 	=> 'Đại lý',
			'table'		=>	'admin',
			'show_name' =>	'name',
			'show_value'=>	'id'
        ),
		array(
            'index' 	=> 'discount',
            'type' 		=> 'text',
            'label' 	=> 'Giảm giá cho khách hàng'
        ),
		array(
            'index' 	=> 'resellerDiscount',
            'type' 		=> 'text',
            'label' 	=> 'Chiết khấu cho đại lý'
        ),
		array(
            'index' 	=> 'status',
            'type' 		=> 'status',
            'label' 	=> 'Trạng thái'
        ),
		array(
            'index' 	=> 'startDate',
            'type' 		=> 'datepicker',
			'format' 	=> 'd/m/Y',
            'label' 	=> 'Ngày bắt đầu'
        ),
		array(
            'index' 	=> 'endDate',
            'type' 		=> 'datepicker',
			'format' 	=> 'd/m/Y',
            'label' 	=> 'Ngày kết thúc'
        ),
		array(
            'index' 	=> 'content',
            'type' 		=> 'tinymce',
            'label' 	=> 'Nội dung'
        )
    );
	public $addValidator = array(
		'rules' => array(
			'code' => array(
				'required' => true,
				'minlength' => 2,
				'maxlength' => 255
			)
		),
		'messages' => array(
			'code' => array(
				'required' => 'Tên Coupon không được để trống',
				'minlength' => 'Tên Coupon phải từ hai ký tự trở lên',
				'maxlength' => 'Tên Coupon tối đa 255 ký tự'
			)
		)
	);
	public $editValidator = array(
		'rules' => array(
			'code' => array(
				'required' => true,
				'minlength' => 2,
				'maxlength' => 255
			)
		),
		'messages' => array(
			'code' => array(
				'required' => 'Tên Coupon không được để trống',
				'minlength' => 'Tên Coupon phải từ hai ký tự trở lên',
				'maxlength' => 'Tên Coupon tối đa 255 ký tự'
			)
		)
	);
}
	
?>