<?php
class PzkAdminCardnexnobelsController extends PzkGridAdminController {
    public $addFields 	= 	'pincard, serial, serviceId, activedId, quantity, status, promotion';
    public $editFields 	= 	'pincard, serial, serviceId, activedId, quantity, status, promotion';
    public $table		=	'card_nextnobels';
	public $joins 		= 	array(
		array(
			'table'		=> 'service_packages',
			'condition'	=> 'card_nextnobels.serviceId = service_packages.id',
			'type'		=> 'left'
		),
		array(
			'table'		=> 'user',
			'condition'	=> 'card_nextnobels.activedId = user.id',
			'type'		=> 'left'
		)
	);
	public $selectFields	=	'card_nextnobels.*, service_packages.serviceName as serviceName, user.username, user.phone';
    public $sortFields = array(
        'id asc' => 'ID tăng',
        'id desc' => 'ID giảm'
       
    );
	
	public $filterFields	=	array(
		array(
            'index' => 'status',
            'type' => 'selectoption',
            'label' => 'Trạng thái',
			'option'	=>	array(
				'0'		=>	'Chưa kích hoạt',
				'1'		=>	'Đã kích hoạt',
				'2'		=>	'Đã nạp'
			)
        ),
		array(
            'index' 	=> 	'serviceId',
            'type' 		=> 	'select',
            'label' 	=> 	'Dịch vụ',
			'table'		=>	'service_packages',
			'show_name'	=>	'serviceName',
			'show_value'=>	'id'
        )
	);
    public $searchFields = array('pincard', 'serial', 'username', 'phone');
    public $listFieldSettings = array(
        array(
            'index' => 'pincard',
            'type' => 'text',
            'label' => 'Mã thẻ'
        ),
        array(
            'index' => 'serial',
            'type' => 'text',
            'label' => 'Serial '
        ),
		array(
            'index' => 'serviceName',
            'type' => 'text',
            'label' => 'Dịch vụ'
        ),
		array(
            'index' => 'username',
            'type' => 'text',
            'label' => 'Người kích hoạt'
        ),
		array(
            'index' => 'phone',
            'type' => 'text',
            'label' => 'Số điện thoại'
        ),
		array(
            'index' => 'quantity',
            'type' => 'text',
            'label' => 'Số lượng'
        ),
		array(
            'index' 	=> 'actived',
            'type' 		=> 'datetime',
            'label' 	=> 'Ngày nạp',
			'format'	=>	'H:i d/m/Y'
        ),
        array(
            'index' 	=> 'promotion',
            'type' 		=> 'status',
            'label' 	=> 'Khuyến mại',
        ),
		array(
            'index' => 'status',
            'type' => 'text',
            'label' => 'Trạng thái',
			'maps'	=>	array(
				'0'		=>	'Chưa kích hoạt',
				'1'		=>	'Đã kích hoạt',
				'2'		=>	'Đã nạp'
			)
        )

    );
    public $addLabel = 'Thêm bạn mới';
    public $addFieldSettings = array(
        array(
            'index' => 'pincard',
            'type' => 'text',
            'label' => 'Mã thẻ'
        ),
        array(
            'index' => 'serial',
            'type' => 'text',
            'label' => 'Serial '
        ),
		array(
            'index' 	=> 	'serviceId',
            'type' 		=> 	'select',
            'label' 	=> 	'Dịch vụ',
			'table'		=>	'service_packages',
			'show_name'	=> 	'serviceName',
			'show_value'=>	'id'
        ),
		array(
            'index' => 'quantity',
            'type' => 'text',
            'label' => 'Số lượng'
        ),
        array(
            'index' => 'status',
            'type' => 'text',
            'label' => 'Trạng thái'
        )
    );
    public $editFieldSettings = array(
         array(
            'index' => 'pincard',
            'type' => 'text',
            'label' => 'Mã thẻ'
        ),
        array(
            'index' => 'serial',
            'type' => 'text',
            'label' => 'Serial '
        ),
        array(
            'index' 	=> 	'serviceId',
            'type' 		=> 	'select',
            'label' 	=> 	'Dịch vụ',
			'table'		=>	'service_packages',
			'show_name'	=> 	'serviceName',
			'show_value'=>	'id'
        ),
		array(
            'index' => 'quantity',
            'type' => 'text',
            'label' => 'Số lượng'
        ),
        array(
            'index' => 'status',
            'type' => 'text',
            'label' => 'Trạng thái'
        )
    );
    public $addValidator = array(
        'rules' => array(
            'pincard' => array(
                'required' => true
            ),
            'serial' => array(
                'required' => true
               
            )

        ),
        'messages' => array(
            'pincard' => array(
                'required' => 'Pincard không được để trống'
                
            ),
            'serial' => array(
                'required' => 'Serial không được để trống'
                
            )
        )
    );
    public $editValidator = array(
        'rules' => array(
            'serial' => array(
                'required' => true
               
            )

        ),
        'messages' => array(
            
            'serial' => array(
                'required' => 'Serial không được để trống'
                
            )
        )
    );

}