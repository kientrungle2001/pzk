<?php
class PzkAdminBuyServiceBankController extends PzkGridAdminController {
	public $addFields = 'username, name, phone, address, serviceId, quantity,amount,paymentType,bank,dateOrder,paymentStatus, status';
	public $editFields ='username, name, phone, address, serviceId, quantity,amount,paymentType,bank,dateOrder,paymentStatus, status';
	public $table='order';
	public $sortFields = array(
		'id asc' => 'ID tăng',
		'id desc' => 'ID giảm',
	);
	public $filterFields = array(
		array(
			'index' => 'paymentStatus',
			'type' => 'status',
			'label' => 'Tình trạng thanh toán',
			'options' => array(
				'0' => 'chưa thanh toán',
				'1' => 'Đã thanh toán'
			)
		),
		array(
			'index' => 'status',
			'type' => 'selectoption',
			'label' => 'trạng thái hoá đơn',
			'states' => array(
				'' => 'Tất cả',
				'0' => 'Chưa kích hoạt', // init
				'1' => 'Đã kích hoạt', // accept
				'-1' => 'Đã hủy', // cancel
				'2' => 'Thành công', // complete
				'-2' => 'Thất bại' 
			)
		)
	);
	public $searchFields = 'id,paymentDate, paymentType, transactioncode, billcode, bank';
	public $listFieldSettings = array(
		array(
			'index' => 'username',
			'type' => 'text',
			'label' => 'UserName'
		),
		array(
			'index' => 'name',
			'type' => 'text',
			'label' => 'Tên'
		),
		array(
			'index' => 'phone',
			'type' => 'text',
			'label' => 'Điện thoại'
		),
		array(
			'index' => 'address',
			'type' => 'text',
			'label' => 'Địa chỉ'
		),
		array(
			'index' => 'serviceId',
			'type' => 'text',
			'label' => 'Mã dịch vụ'
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
			'index' => 'paymentType',
			'type' => 'text',
			'label' => 'Kiểu thanh toán'
		),
		array(
			'index' => 'bank',
			'type' => 'text',
			'label' => 'Ngân hàng'
		),
		array(
			'index' => 'dateOrder',
			'type' => 'text',
			'label' => 'Ngày thanh toán'
		),
		array(
			'index' => 'software',
			'type' => 'text',
			'label' => 'Phần mềm'
		),
		array(
			'index' => 'paymentStatus',
			'type' => 'text',
			'label' => 'Trạng thái thanh toán',
		),
		array(
			'index' => 'status',
			'type' => 'workflow',
			'label' => 'Trạng thái hoá đơn',
			'states' => array(
				'0' => 'Chưa kích hoạt', // init
				'1' => 'Đã kích hoạt', // accept
				'-1' => 'Đã hủy', // cancel
				'2' => 'Thành công', // complete
				'-2' => 'Thất bại' // failed
			),
			'rules' => array(
				'0' => array(
					'1' => array(
						'action' => 'Đã kích hoạt',
						'model' => 'workflow.buyServiceBank', 
						'handler' => 'active',
						'adminLevel' => 'Accountant, ChiefAccountant'
					),
					
					'-1' => array(
						'action' => 'Hủy',
						'adminLevel' => 'Accountant, ChiefAccountant')
				),
				'1' => array(
					'0' => array(
						'action' => 'Khóa',
						'adminLevel' => 'Accountant, ChiefAccountant'
					),
					'-1' => array(
						'action' =>  'Hủy', 
						'model' => 'workflow.historypayment', 
						'handler' => 'cancel',
						'adminLevel' => 'Accountant, ChiefAccountant'
					),
					'2' => array(
						'action' =>  'Thành công',
						'adminLevel' => 'ChiefAccountant'
					)
				),
				'2' => array(
					'0' => array(
						'action' => 'Khóa',
						'adminLevel' => 'Accountant, ChiefAccountant'
					),
					'-1' => array(
						'action' =>  'Hủy', 
						'model' => 'workflow.historypayment', 
						'handler' => 'cancel',
						'adminLevel' => 'Accountant, ChiefAccountant'
					),
					'-2' => array(
						'action' =>  'Thành công',
						'adminLevel' => 'ChiefAccountant'
					)
				),
				
				'-1' => array(
					'-2' => array(
						'action' => 'Thất bại',
						'adminLevel' => 'ChiefAccountant'
					)
				)
			)
		),
	);
	public $addLabel = 'Thêm mới';
	public $addFieldSettings = array(
		array(
			'index' => 'username',
			'type' => 'text',
			'label' => 'UserName'
		),
		array(
			'index' => 'name',
			'type' => 'text',
			'label' => 'Tên'
		),
		array(
			'index' => 'phone',
			'type' => 'text',
			'label' => 'Điện thoại'
		),
		array(
			'index' => 'address',
			'type' => 'text',
			'label' => 'Địa chỉ'
		),
		array(
			'index' => 'serviceId',
			'type' => 'select',
			'label' => 'Mã dịch vụ',
			'table'=>'service_packages',
			'show_value'=>'id',
			'show_name'=>'serviceName'
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
			'index' => 'paymentType',
			'type' => 'selectoption',
			'option'=> array(
				'chuyển khoản ngân hàng'=>'Chuyển khoản ngân hàng',
				'tiền mặt'=>'Thanh toán tiền mặt'		
		),
		array(
			'index' => 'bank',
			'type' => 'text',
			'label' => 'Ngân hàng'
		),
		array(
			'index' => 'dateOrder',
			'type' => 'date',
			'label' => 'Ngày thanh toán'
		),
		array(
			'index' => 'software',
			'type' => 'text',
			'label' => 'Phần mềm'
		),
		array(
			'index' => 'status',
			'type' => 'selectoption',			
			'option' => array(
				'0' => 'Chưa kích hoạt',
				'1' => 'Đã kích hoạt',
			),
			'label' => 'Kích hoạt tài khoản user'
		)		
	);
	public $editFieldSettings = array(
		array(
			'index' => 'username',
			'type' => 'text',
			'label' => 'UserName'
		),
		array(
			'index' => 'name',
			'type' => 'text',
			'label' => 'Tên'
		),
		array(
			'index' => 'phone',
			'type' => 'text',
			'label' => 'Điện thoại'
		),
		array(
			'index' => 'address',
			'type' => 'text',
			'label' => 'Địa chỉ'
		),
		array(
			'index' => 'serviceId',
			'type' => 'select',
			'label' => 'Mã dịch vụ',
			'table'=>'service_packages',
			'show_value'=>'id',
			'show_name'=>'serviceName'
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
			'index' => 'paymentType',
			'type' => 'selectoption',
			'option'=> array(
				'chuyển khoản ngân hàng'=>'Chuyển khoản ngân hàng',
				'tiền mặt'=>'Thanh toán tiền mặt'		
		),
		array(
			'index' => 'bank',
			'type' => 'text',
			'label' => 'Ngân hàng'
		),
		array(
			'index' => 'dateOrder',
			'type' => 'date',
			'label' => 'Ngày thanh toán'
		),
		array(
			'index' => 'software',
			'type' => 'text',
			'label' => 'Phần mềm'
		),
		array(
			'index' => 'status',
			'type' => 'selectoption',			
			'option' => array(
				'0' => 'Chưa kích hoạt',
				'1' => 'Đã kích hoạt',
			),
			'label' => 'Kích hoạt tài khoản user'
		)
	);
	public $addValidator = array(
		'rules' => array(
			'username' => array(
				'required' => true
			),
			'amount' => array(
				'required' => true

				
			)
		),
		'messages' => array(
			'username' => array(
				'required' => 'Phải nhập tên đăng nhập'
				
			),
			
			'amount' => array(
				'required' => 'Nhập số tiền thanh toán'
				
			)
		)
	);
	public $editValidator = array(
		'rules' => array(
			'username' => array(
				'required' => true
			),
			'amount' => array(
				'required' => true

				
			)
		),
		'messages' => array(
			'username' => array(
				'required' => 'Phải nhập tên đăng nhập'
				
			),
			
			'amount' => array(
				'required' => 'Nhập số tiền thanh toán'
				
			)
		)
	);
    public function addPostAction() {
        $row = $this->getAddData();
        if($this->validateAddData($row)) {
            $row['userAdd']=pzk_session('adminId');
            $row['dateAdd']=date("Y-m-d H:i:s");
            $this->add($row);                    
            pzk_notifier()->addMessage('Cập nhật thành công');
            $this->redirect('index');
        
        } else {
            pzk_validator()->setEditingData($row);
            $this->redirect('add');
        }
    }

    public function editPostAction() {
    	$id= pzk_request()->getId();
        $row = $this->getEditData();
        if($this->validateEditData($row)) {
        	$date=date("Y-m-d H:i:s");
            $row['userModified']=pzk_session('adminId');
            $row['dateModified']=date("Y-m-d H:i:s");
            $this->edit($row);
            pzk_notifier()->addMessage('Cập nhật thành công');
            $this->redirect('index');
        
        } else {
            pzk_validator()->setEditingData($row);
            $this->redirect('edit/' . pzk_request()->getId());
        }
    }
}