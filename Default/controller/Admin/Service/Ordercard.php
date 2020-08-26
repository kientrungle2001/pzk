<?php
class PzkAdminServiceOrdercardController extends PzkGridAdminController {
    public $title = 'Danh sách đặt mua thẻ Full Look';
	public $addFields = 'fullname,phone, address,serviceId,quantity, amount, class, software, site, status, note';
    public $editFields = 'fullname,phone, address,serviceId,quantity, amount, class, software, site, status, note';
	
	
    public $table='order_card';
    public $sortFields = array(
        'id asc' => 'ID tăng',
        'id desc' => 'ID giảm',
        
    );
	public $joins = array(
		array(
			'table' => 'service_packages',
			'condition' => '`order_card`.cardId = service_packages.id',
			'type'	=> JOIN_TYPE_LEFT
		)
	);
	public $selectFields = '`order_card`.*, service_packages.serviceName, service_packages.serviceType as serviceType';
    public $searchFields = array('`order_card`.`fullname`','`order_card`.`phone`', '`order_card`.`address`','`order_card`.`quantity`','`order_card`.`amount`','`order_card`.`status`','`order_card`.`date`');
    public $filterFields = array(

        array(
            'index' => 'status',
            'type' => 'selectoption',
            'option' => array(
                
                '0' => 'Chờ xử lý',
                '1' => 'Đã hoàn thành',
                '-1' => 'Đã huỷ'
            ),
            'label' =>'Trạng thái đơn hàng'
        )
    );
    public $listFieldSettings = array(
        
        
        array(
            'index' => 'fullname',
            'type' => 'text',
            'label' => 'fullname'
        ),
        array(
            'index' => 'address',
            'type' => 'text',
            'label' => 'address'
        ),
        array(
            'index' => 'phone',
            'type' => 'text',
            'label' => 'phone'
        ),
		
		array(
            'index' => 'serviceName',
            'type' => 'text',
            'label' => 'Dịch vụ'
        ),
        array(
            'index' => 'quantity',
            'type' => 'text',
            'label' => 'Số lượng'
        ),
        array(
            'index' => 'amount',
            'type' => 'price',
            'label' => 'Tổng tiền'
        ),
        array(
            'index' => 'date',
            'type' => 'datetime',
			'format'	=> 'd/m/Y H:i',
            'label' => 'Ngày'
        ),
		array(
            'index' => 'note',
            'type' => 'text',
            'label' => 'Ghi chú'
        ),
        array(
            'index'     => 'status',
            'type'      => 'workflow',
            'label'     => 'Trạng thái',
            'states'    => array(
                '0'         => 'Chưa kích hoạt', // init
                '1'         => 'Đã kích hoạt', // accept
                '-1'        => 'Đã hủy', // cancel
                '2'         => 'Thành công', // complete
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
                        'action'        =>  'Thành công',
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
                        'action'        =>  'Thành công',
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
		

    );
    public $addLabel = 'Thêm mới';
    public $addFieldSettings = array(
        
        array(
            'index' => 'fullname',
            'type' => 'text',
            'label' => 'Tên khách hàng '
        ),
        array(
            'index' => 'address',
            'type' => 'text',
            'label' => 'Địa chỉ '
        ),
        array(
            'index' => 'phone',
            'type' => 'text',
            'label' => 'Điện thoại'
        ),
        array(
            'index' => 'serviceId',
            'type' => 'select',
            'table'=>'service_packages',
            'show_value'=>'id',
            'show_name'=>'serviceName',
            'label' => 'Dịch vụ'
        ),
        
        array(
            'index' => 'quantity',
            'type' => 'text',
            'label' => 'Số lượng'
        ),
        array(
            'index' => 'amount',
            'type' => 'text',
            'label' => 'Tổng tiền'
        ),
        array(
            'index' => 'status',
            'type' => 'status',
            'label' => 'Trạng thái đơn hàng',
            'options' => array(
                '0' => 'chưa xử lý',
                '1' => 'Đã xử lý'
            ),
            'actions' => array(
                '0' => 'mở',
                '1' => 'dừng'
            )
        )
    );
    public $editFieldSettings = array(
        array(
            'index' => 'fullname',
            'type' => 'text',
            'label' => 'Tên khách hàng '
        ),
        array(
            'index' => 'address',
            'type' => 'text',
            'label' => 'Địa chỉ '
        ),
        array(
            'index' => 'phone',
            'type' => 'text',
            'label' => 'Điện thoại'
        ),
        array(
            'index' => 'serviceId',
            'type' => 'select',
            'table'=>'service_packages',
            'show_value'=>'id',
            'show_name'=>'serviceName',
            'label' => 'Dịch vụ'
        ),
        
        array(
            'index' => 'quantity',
            'type' => 'text',
            'label' => 'Số lượng'
        ),
        array(
            'index' => 'amount',
            'type' => 'text',
            'label' => 'Tổng tiền'
        ),
        array(
            'index' => 'status',
            'type' => 'status',
            'label' => 'Trạng thái đơn hàng',
            'options' => array(
                '0' => 'chưa xử lý',
                '1' => 'Đã xử lý'
            ),
            'actions' => array(
                '0' => 'mở',
                '1' => 'dừng'
            )
        )
    );
    public $addValidator = array(
        'rules' => array(
                        
            'serviceId' => array(
                'required' => true
            ),
            'quantity' => array(
                'required' => true               
            ),
            'amount' => array(
                'required' => true               
            ),
            
            'status' => array(
                'required' => true               
            )

        ),
        'messages' => array(
            
            'serviceId' => array(
                'required' => 'Mã dịch vụ không được để trống'
                
            ),
            'quantity' => array(
                'required' => 'Số lượng không được để trống'
                
            ),
            'amount' => array(
                'required' => 'Tổng tiền không được để trống'                
            ),
            
            'status' => array(
                'required' => 'Trạng thái đơn hàng không được để trống'                
            )
        )
    );
    public $editValidator = array(
        'rules' => array(
                        
            'serviceId' => array(
                'required' => true
            ),
            'quantity' => array(
                'required' => true               
            ),
            'amount' => array(
                'required' => true               
            ),
            
            'status' => array(
                'required' => true               
            )

        ),
        'messages' => array(
            
            'serviceId' => array(
                'required' => 'Mã dịch vụ không được để trống'
                
            ),
            'quantity' => array(
                'required' => 'Số lượng không được để trống'
                
            ),
            'amount' => array(
                'required' => 'Tổng tiền không được để trống'                
            ),
            
            'status' => array(
                'required' => 'Trạng thái đơn hàng không được để trống'                
            )
        )
    ); 
    
    public function editPostAction() {
        $id     = pzk_request()->getId();
        $row    = $this->getEditData();
        
        
        if($this->validateEditData($row)) {         
                       
            $row['software'] = pzk_request()->getSoftwareId();
            $row['site'] = pzk_request()->getSiteId();
            $this->edit($row);
            pzk_notifier()->addMessage('Cập nhật thành công');
            $this->redirect('index');
        
        } else {
            pzk_validator()->setEditingData($row);
            $this->redirect('edit/' . pzk_request()->getId());
        }
    }
}