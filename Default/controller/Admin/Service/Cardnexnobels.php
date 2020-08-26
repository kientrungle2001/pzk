<?php
class PzkAdminServiceCardnexnobelsController extends PzkGridAdminController {
    public $title 		= 	'Thẻ cào Nextnobels';
	public $addFields 	= 	'pincard_normal, pincard, serial, price,discount,status, languages, class, time, software, site, quantity, promotion, serial, expiredDate, startDate, endDate, couponable, resellerId';
    public $editFields 	= 	'pincard_normal, pincard, price,discount,status, languages, class, time, software, site, quantity, promotion, expiredDate, startDate, endDate, couponable, resellerId';
    public $table		=	'card_nextnobels';
    public $sortFields 	= array(
        'id asc' 		=> 	'ID tăng',
        'id desc' 		=> 	'ID giảm',
		'serial asc' 	=> 	'Serial tăng',
        'serial desc' 	=> 	'Serial giảm'
    );
	
	public $selectFields 	= 'card_nextnobels.*';
	public $logable 		= true;
	public $logFields 		= 'serial, price,discount,status';
    public $searchFields 	= array('pincard_normal','serial','price','discount','status', 'languages', 'time', 'class');
    public function getLinks() {
        if(pzk_request()->getSoftwareId()==1 && pzk_request()->getSiteId() == 1){
           return array(array(
                'name'  =>  '<span class="glyphicon glyphicon-plus"></span> <span>Thêm thẻ FL</span>',
                'href'  =>  '/home/renderCodeFL?price=400000&time=365'
            ) );
        }else if (pzk_request()->getSoftwareId()==1 && pzk_request()->getSiteId() == 2){
            return array();
			return array(
				
				
                array(
                    'name'  =>  '<span class="glyphicon glyphicon-plus"></span> <span>Thẻ FLSN(600k/1năm)</span>',
                    'href'  =>  '/home/renderCode?price=600000&languages=ev&time=365&class=5'
                ),
                array(
                    'name'  =>  '<span class="glyphicon glyphicon-plus"></span> <span>Thẻ FLSN(400k/6tháng)</span>',
                    'href'  =>  '/home/renderCode?price=400000&languages=ev&time=180&class=5'
                ),
                array(
                    'name'  =>  '<span class="glyphicon glyphicon-plus"></span> <span>Thẻ FLSN(400k/T.Việt)</span>',
                    'href'  =>  '/home/renderCode?price=400000&languages=vn&time=365&class=5'
                ),
                array(
                    'name'  =>  '<span class="glyphicon glyphicon-plus"></span> <span>Thẻ FLSN(400k/T.Anh)</span>',
                    'href'  =>  '/home/renderCode?price=400000&languages=en&time=365&class=5'
                )
            );
        }
    }
    public $listFieldSettings = array(
        
        array(
            'index' 	=> 'pincard_normal',
            'type' 		=> 'text',
            'label' 	=> 'Mã thẻ'
        ),
        array(
            'index' 	=> 'serial',
            'type' 		=> 'text',
            'label' 	=> 'Serial '
        ),
        array(
            'index' 	=> 'price',
            'type' 		=> 'price',
            'label' 	=> 'Giá '
        ),
        array(
            'index' 	=> 'discount',
            'type' 		=> 'text',
            'label' 	=> 'Giảm giá (%)'
        ),
        array(
            'index' 	=> 'languages',
            'type' 		=> 'text',
            'label' 	=> 'Ngôn ngữ'
        ),
        array(
            'index' 	=> 'time',
            'type' 		=> 'text',
            'label' 	=> 'Thời gian'
        ),
        array(
            'index' 	=> 'class',
            'type' 		=> 'text',
            'label' 	=> 'lớp'
        ),
        array(
            'index' 	=> 'promotion',
            'type' 		=> 'status',
            'label' 	=> 'Khuyến mại'
        ),
		array(
            'index' 	=> 'expiredDate',
            'type' 		=> 'datetime',
            'label' 	=> 'Ngày hết hạn'
        ),
		
		array(
            'index' 	=> 'startDate',
            'type' 		=> 'datetime',
            'label' 	=> 'Ngày bắt đầu'
        ),
		array(
            'index' 	=> 'endDate',
            'type' 		=> 'datetime',
            'label' 	=> 'Ngày kết thúc'
        ),
		array(
            'index' 	=> 'quantity',
            'type' 		=> 'text',
            'label' 	=> 'Số lượng'
        ),
		
        array(
            'index'     => 'status',
            'type'      => 'workflow',
            'label'     => 'Trạng thái',
            'states'    => array(
                '0'         => 'Chưa kích hoạt', // init
                '1'         => 'Đã kích hoạt', // accept
                '-1'        => 'Đã hủy', // cancel
                '2'         => 'Đã sử dụng', // complete
                '-2'        => 'Thất bại' // failed
            ),
            'rules'     => array(
                '0'         => array(
                    '1'         => array(
                        'action'        => 'Đã kích hoạt',
                        'model'         => 'workflow.historypayment', 
                        'handler'       => 'active',
                        'adminLevel'    => 'Accountant, ChiefAccountant, Manager'
                    ),
                    
                    '-1'    => array(
                        'action'        => 'Hủy',
                        'adminLevel'    => 'Accountant, ChiefAccountant, Manager')
                ),
                '1'         => array(
                    '0'         => array(
                        'action'        => 'Khóa',
                        'adminLevel'    => 'Accountant, ChiefAccountant, Manager'
                    ),
                    '-1'        => array(
                        'action'        =>  'Hủy', 
                        'model'         => 'workflow.historypayment', 
                        'handler'       => 'cancel',
                        'adminLevel'    => 'Accountant, ChiefAccountant, Manager'
                    ),
                    '2'         => array(
                        'action'        =>  'Đã sử dụng',
                        'adminLevel'    => 'ChiefAccountant, Manager'
                    )
                ),
                '2'         => array(
                    '0'         => array(
                        'action'        => 'Khóa',
                        'adminLevel'    => 'Accountant, ChiefAccountant, Manager'
                    ),
                    '-1'        => array(
                        'action'        =>  'Hủy', 
                        'model'         => 'workflow.historypayment', 
                        'handler'       => 'cancel',
                        'adminLevel'    => 'Accountant, ChiefAccountant, Manager'
                    ),
                    '-2'        => array(
                        'action'        =>  'Đã sử dụng',
                        'adminLevel'    => 'ChiefAccountant, Manager'
                    )
                ),
                
                '-1'        => array(
                    '-2'        => array(
                        'action'        => 'Thất bại',
                        'adminLevel'    => 'ChiefAccountant, Manager'
                    )
                )
            )
        ),
		array(
			'index'		=> 'none4',
			'type'		=> 'group',
			'label'		=> '<br />Người tạo<br />Người sửa',
			'delimiter'		=> '<br />',
			'fields'		=> array(
				array(
					'index' 	=> 'creatorName',
					'type' 		=> 'text',
					'label' 	=> 'Người tạo'
				),
				array(
					'index' 	=> 'modifiedName',
					'type' 		=> 'text',
					'label' 	=> 'Người sửa'
				),
			)
		),
		array(
			'index'				=> 'none5',
			'type'				=> 'group',
			'label'				=> '<br />Ngày tạo<br />Ngày sửa',
			'delimiter'			=> '<br />',
			'fields'			=> array(
				array(
					'index' 		=> 'created',
					'type' 			=> 'datetime',
					'label' 		=> 'Ngày tạo',
					'format'		=> 'H:i d/m'
				),
				array(
					'index' 		=> 'modified',
					'type' 			=> 'datetime',
					'label' 		=> 'Ngày sửa',
					'format'		=> 'H:i d/m'
				),
			)
		),
		
		array(
            'index' 		=> 'couponable',
            'type' 			=> 'status',
            'label' 		=> 'Là mã coupon'
        ),
		
		array(
            'index' 		=> 'resellerId',
            'type' 			=> 'nameid',
            'label' 		=> 'Đại lý',
			'table'			=>	'admin',
			'findField' 	=> 'id',
			'showField'		=> 'name'
        ),

    );
    public $addLabel = 'Thêm mới';
    public $addFieldSettings = array(
		array(
            'index' 		=> 'pincard_normal',
            'type' 			=> 'text',
            'label' 		=> 'Mã'
        ),
		array(
            'index' 		=> 'serial',
            'type' 			=> 'text',
            'label' 		=> 'Serial'
        ),
		array(
            'index' 		=> 'price',
            'type' 			=> 'text',
            'label' 		=> 'Giá '
        ),
        array(
            'index' 		=> 'discount',
            'type' 			=> 'text',
            'label' 		=> 'Giảm giá (%)'
        ),
        array(
            'index' 		=> 'languages',
            'type' 			=> 'selectoption',
            'option' 		=> array(
                'en' 			=> 'Tiếng Anh',
                'vn' 			=> 'Tiếng Việt',
                'ev' 			=> 'Song Ngữ'
            ),
            'label' 		=> 'Ngôn ngữ '
        ),
        array(
            'index' 		=> 'time',
            'type' 			=> 'text',
            'option' 		=> array(
                '180' 			=> '6 tháng',
                '365' 			=> '1 năm'
            ),
            'label' 		=> 'Thời gian'
        ),
        array(
            'index' 		=> 'class',
            'type' 			=> 'selectoption',
            'option' 		=> array(
                '3' 			=> 'Lớp 3',
                '4' 			=> 'Lớp 4',
                '5' 			=> 'Lớp 5'
            ),
            'label' 		=> 'Lớp'
        ),
        array(
            'index' 		=> 'promotion',
            'type' 			=> 'status',
            'label' 		=> 'Khuyến mại'
        ),
		array(
            'index' => 'expiredDate',
            'type' 	=> 'datetimepicker',
            'label' => 'Ngày hết hạn'
        ),
		
		array(
            'index' => 'startDate',
            'type' 	=> 'datetimepicker',
            'label' => 'Ngày bắt đầu'
        ),
		array(
            'index' => 'endDate',
            'type' 	=> 'datetimepicker',
            'label' => 'Ngày kết thúc'
        ),
		array(
            'index' => 'quantity',
            'type' 	=> 'text',
            'label' => 'Số lượng'
        ),
		array(
            'index' => 'status',
            'type' => 'status',
            'label' => 'Trạng thái '
        ),
		array(
            'index' => 'couponable',
            'type' 	=> 'status',
            'label' => 'Là mã coupon'
        ),
		array(
            'index' 		=> 'resellerId',
            'type' 			=> 'select',
            'label' 		=> 'Đại lý',
			'table'			=>	'admin',
			'show_name'		=> 'name',
			'show_value'	=> 'id'
        ),
	);
    public $editFieldSettings = array(
        
        array(
            'index' => 'pincard_normal',
            'type' => 'text',
            'label' => 'Mã'
        ),
		array(
            'index' => 'serial',
            'type' => 'text',
            'label' => 'Serial'
        ),
        array(
            'index' => 'price',
            'type' => 'text',
            'label' => 'Giá '
        ),
        array(
            'index' => 'discount',
            'type' => 'text',
            'label' => 'Giảm giá (%)'
        ),
        array(
            'index' => 'languages',
            'type' => 'selectoption',
            'option' => array(
                'en' => 'Tiếng anh',
                'vn' => 'Tiếng việt',
                'ev' => 'Song ngữ'
            ),
            'label' => 'Ngôn ngữ '
        ),
        array(
            'index' => 'time',
            'type' => 'text',
            'option' => array(
                '180' => '6 tháng',
                '365' => '1 năm'
            ),
            'label' => 'Thời gian '
        ),
        array(
            'index' => 'class',
            'type' => 'selectoption',
            'option' => array(
                '3' => 'lớp 3',
                '4' => 'lớp 4',
                '5' => 'lớp 5'
            ),
            'label' => 'Lớp'
        ),
		array(
            'index' => 'promotion',
            'type' 	=> 'status',
            'label' => 'Khuyến mại'
        ),
		array(
            'index' => 'expiredDate',
            'type' 	=> 'datepicker',
            'label' => 'Ngày hết hạn'
        ),
		
		array(
            'index' => 'startDate',
            'type' 	=> 'datepicker',
            'label' => 'Ngày bắt đầu'
        ),
		array(
            'index' => 'endDate',
            'type' 	=> 'datepicker',
            'label' => 'Ngày kết thúc'
        ),
        array(
            'index' => 'quantity',
            'type' 	=> 'text',
            'label' => 'Số lượng'
        ),
		array(
            'index' => 'status',
            'type' => 'status',
            'label' => 'Trạng thái '
        ),
		array(
            'index' => 'couponable',
            'type' 	=> 'status',
            'label' => 'Là mã coupon'
        ),
		array(
            'index' 		=> 'resellerId',
            'type' 			=> 'select',
            'label' 		=> 'Đại lý',
			'table'			=>	'admin',
			'show_name'		=> 'name',
			'show_value'	=> 'id'
        ),
    );
    
    public $editValidator = array(
        'rules' => array(
            'price' => array(
                'required' => true
               
            )

        ),
        'messages' => array(
            
            
            'price' => array(
                'required' => ' price không được để trống'
               
            )
        )
    );
	
	public function add($row) {
		$row['pincard']	=	md5($row['pincard_normal']);
		parent::add($row);
	}
	
	public function edit($row) {
		$row['pincard']	=	md5($row['pincard_normal']);
		parent::edit($row);
	}
    

}
?>