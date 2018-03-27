<?php
class PzkAdminCouponUserController extends PzkGridAdminController {
	public $title = 'Quản lý người nạp Coupon';
	public $table = 'coupon_user';
	public $addFields = 'code,userId,username,resellerId,software,global,sharedSoftwares,status';
	public $editFields = 'code,userId,username,resellerId,software,global,sharedSoftwares,status';
	public $logable = true;
	public $logFields = 'code,status';
	public $sortFields = array(
		'id asc' => 'ID tăng',
		'id desc' => 'ID giảm',
		'code asc' => 'Tiêu đề tăng',
		'code desc' => 'Tiêu đề giảm'
	);
	public $filterFields = array(
		array(
            'index' 		=> 	'resellerId',
            'type' 			=> 	'select',
            'label' 		=> 	'Đại lý',
			'table'			=>	'admin',
			'show_value'	=>	'id',
			'show_name'		=>	'name'
        ),
	);
	public $listFieldSettings = array(
        array(
            'index' 	=> 'code',
            'type' 		=> 'text',
            'label' 	=> 'Mã coupon'
        ),
		array(
            'index' 	=> 'amount',
            'type' 		=> 'text',
            'label' 	=> 'Số tiền'
        ),
		array(
            'index' 	=> 'serviceId',
            'type' 		=> 'nameid',
            'label' 	=> 'Dịch vụ',
			'table'		=>	'service_packages',
			'findField'	=>	'id',
			'showField'	=>	'serviceName'
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
            'index' 	=> 'username',
            'type' 		=> 'text',
            'label' 	=> 'Người nạp'
        ),
		array(
            'index' 	=> 'name',
            'type' 		=> 'text',
            'label' 	=> 'Tên Người nạp'
        ),
		array(
            'index' 	=> 'phone',
            'type' 		=> 'text',
            'label' 	=> 'SĐT Người nạp'
        ),
		array(
            'index' 	=> 'email',
            'type' 		=> 'text',
            'label' 	=> 'Email Người nạp'
        ),
		array(
            'index' => 'actived',
            'type' => 'datetime',
			'format' => 'H:i d/m/Y',
            'label' => 'Ngày nạp'
        ),
		
		array(
            'index' => 'status',
            'type' => 'status',
            'label' => 'Trạng thái'
        ),
	);
    public $addLabel = 'Thêm';
    public $addFieldSettings = array(
    );
    public $editFieldSettings = array(  
    );
}
	
?>