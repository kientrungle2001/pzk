<?php
class PzkAdminOrdercardController extends PzkGridAdminController {
	public $addFields = 'cardId, quantity, amount,date,fullname,address,phone,note,status';
	public $editFields ='cardId, quantity, amount,date,fullname,address,phone,note,status';
	public $table='order_card';
	public $joins = array(
        array(
            'table' => 'service_packages',
            'condition' => 'service_packages.id = order_card.cardId',
            'type' =>'left'
        )
    );
    public $selectFields = 'order_card.*,service_packages.serviceName as serviceName, service_packages.amount as price';
	public $sortFields = array(
		'id asc' => 'ID tăng',
		'id desc' => 'ID giảm',
		'date asc' => 'date tăng',
		'date desc' => 'date giảm',
		'phone asc' => 'phone tăng',
		'phone desc' => 'phone giảm',
		'fullname asc' => 'fullname tăng',
		'fullname desc' => 'fullname giảm',
		'address asc' => 'address tăng',
		'address desc' => 'address giảm'
	);
	public $searchFields = array('date, phone, fullname,address, status');
	public $listFieldSettings = array(
		
		array(
			'index' => 'cardId',
			'type' => 'text',
			'label' => 'Loại Card '
		),
		array(
			'index' => 'serviceName',
			'type' => 'text',
			'label' => 'Tên Card'
		),
		array(
			'index' => 'price',
			'type' => 'text',
			'label' => 'Giá '
		),
		array(
			'index' => 'quantity',
			'type' => 'text',
			'label' => 'Số lượng '
		),
		array(
			'index' => 'amount',
			'type' => 'text',
			'label' => 'Tổng tiền '
		),
		array(
			'index' => 'date',
			'type' => 'text',
			'label' => 'date '
		),
		array(
			'index' => 'fullname',
			'type' => 'text',
			'label' => 'Tên người mua '
		),
		array(
			'index' => 'phone',
			'type' => 'text',
			'label' => 'Điện thoại '
		),
		array(
			'index' => 'address',
			'type' => 'text',
			'label' => 'Địa chỉ '
		),
		array(
			'index' => 'coupon',
			'type' => 'text',
			'label' => 'Mã coupon'
		),
		array(
			'index' => 'note',
			'type' => 'text',
			'label' => 'Ghi chú'
		),
		array(
			'index' 	=> 'status',
			'type' 		=> 'workflow',
			'label' 	=> 'Trạng thái',
			'states' 	=> array(
				'0' 		=> 'Chưa kích hoạt', // init
				'1' 		=> 'Đã kích hoạt', // accept
				'-1' 		=> 'Đã hủy', // cancel
				'2' 		=> 'Thành công', // complete
				'-2' 		=> 'Thất bại' // failed
			),
			'rules' 	=> array(
				'0' 		=> array(
					'1' 		=> array(
						'action' 		=> 'Đã kích hoạt',
						'adminLevel' 	=> 'Accountant, ChiefAccountant, Manager'
					),
					
					'-1' 	=> array(
						'action' 		=> 'Hủy',
						'adminLevel' 	=> 'Accountant, ChiefAccountant, Manager')
				),
				'1' 		=> array(
					'0' 		=> array(
						'action' 		=> 'Khóa',
						'adminLevel' 	=> 'Accountant, ChiefAccountant, Manager'
					),
					'-1' 		=> array(
						'action' 		=>  'Hủy', 
						'model' 		=> 'workflow.ordercard', 
						'handler' 		=> 'cancel',
						'adminLevel' 	=> 'Accountant, ChiefAccountant, Manager'
					),
					'2' 		=> array(
						'action' 		=>  'Thành công',
						'adminLevel' 	=> 'ChiefAccountant, Manager',
						'model' 		=> 'workflow.ordercard', 
						'handler' 		=> 'active',
					)
				),
				'2' 		=> array(
					'0' 		=> array(
						'action' 		=> 'Khóa',
						'adminLevel' 	=> 'Accountant, ChiefAccountant, Manager'
					),
					'-1' 		=> array(
						'action' 		=>  'Hủy', 
						'model' 		=> 'workflow.historypayment', 
						'handler' 		=> 'cancel',
						'adminLevel' 	=> 'Accountant, ChiefAccountant, Manager'
					),
					'-2' 		=> array(
						'action' 		=>  'Thành công',
						'adminLevel' 	=> 'ChiefAccountant, Manager'
					)
				),
				
				'-1' 		=> array(
					'-2' 		=> array(
						'action' 		=> 'Thất bại',
						'adminLevel' 	=> 'ChiefAccountant, Manager'
					)
				)
			)
		),
	);
	public $addLabel = 'Thêm mới';
	public $addFieldSettings = array(
		array(
			'index' => 'cardId',
			'type' => 'text',
			'label' => 'Loại Card '
		),
		
		array(
			'index' => 'quantity',
			'type' => 'text',
			'label' => 'Số lượng '
		),
		array(
			'index' => 'amount',
			'type' => 'text',
			'label' => 'Tổng tiền '
		),
		array(
			'index' => 'date',
			'type' => 'text',
			'label' => 'date '
		),
		array(
			'index' => 'fullname',
			'type' => 'text',
			'label' => 'Tên người mua '
		),
		array(
			'index' => 'phone',
			'type' => 'text',
			'label' => 'Điện thoại '
		),
		array(
			'index' => 'address',
			'type' => 'text',
			'label' => 'Địa chỉ '
		),
		array(
			'index' => 'note',
			'type' => 'text',
			'label' => 'Ghi chú'
		),
		array(
			'index' => 'status',
			'type' => 'text',
			'label' => 'Trạng thái '
		)
	);
	public $editFieldSettings = array(
		array(
			'index' => 'cardId',
			'type' => 'text',
			'label' => 'Loại Card '
		),
		
		array(
			'index' => 'quantity',
			'type' => 'text',
			'label' => 'Số lượng '
		),
		array(
			'index' => 'amount',
			'type' => 'text',
			'label' => 'Tổng tiền '
		),
		array(
			'index' => 'date',
			'type' => 'text',
			'label' => 'date '
		),
		array(
			'index' => 'fullname',
			'type' => 'text',
			'label' => 'Tên người mua '
		),
		array(
			'index' => 'phone',
			'type' => 'text',
			'label' => 'Điện thoại '
		),
		array(
			'index' => 'address',
			'type' => 'text',
			'label' => 'Địa chỉ '
		),
		array(
			'index' => 'note',
			'type' => 'text',
			'label' => 'Ghi chú'
		),
		array(
			'index' => 'status',
			'type' => 'text',
			'label' => 'Trạng thái '
		)
	);
}