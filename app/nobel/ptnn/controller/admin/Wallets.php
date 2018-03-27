<?php
class PzkAdminWalletsController extends PzkGridAdminController {
	public $title = 'Ví điện tử';
	public $table='wallets';
	public $sortFields = array(
		'id asc' => 'ID tăng',
		'id desc' => 'ID giảm',
		'username asc' => 'Tên đăng nhập tăng',
		'username desc' => 'Tên đăng nhập giảm'
	);
	public $logable = true;
	public $logFields = 'username, amount, userId';
	public $searchFields = array('username','amount','userId');
	public $filterFields = array(
        array(
            'index' => 'status',
            'type' => 'status',
            'option' => array(
            	'' =>'Tất cả',
            	'0' => 'Không hoạt động',
            	'1' => 'Hoạt động'
            ),
            'label' =>'Trạng thái hoạt động'
        )
    );
	public $listFieldSettings = array(
		array(
			'index' => 'userId',
			'type' => 'text',
			'label' => 'Mã người dùng'
		),
		array(
			'index' => 'username',
			'type' => 'text',
			'label' => 'Tên đăng nhập'
		),
		array(
			'index' => 'amount',
			'type' => 'price',
			'label' => 'Tổng số tiền '
		),
		array(
			'index' => 'status',
			'type' => 'workflow',
			'label' => 'Trạng thái',
			'states' => array(
				'0' => 'Không hoạt động',
				'1' => 'Hoạt động',
				'-1' => 'Dừng hoạt động'
			),
			'rules' => array(
				'0' => array('1' => array('action' => 'Kích hoạt')),
				'1' => array(
					'0' => array('action' => 'Khóa'),
					'-1' => array('action' =>  'Tạm dừng')),
				'-1' => array(
					'1' => array('action' => 'Mở lại')
				)
			),
			'bgcolor' => '',
			'color' => ''
		)
	);
	
}