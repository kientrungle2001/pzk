<?php
class PzkAdminHistorypaymentController extends PzkGridAdminController {
	public $addFields = ' username, paymentType,bank,transactioncode,billcode, amount, paymentStatus,paymentDate,status, software,buySoftware';
	public $editFields = ' username, paymentType,bank,transactioncode,billcode, amount, paymentStatus,paymentDate,status,software,buySoftware';
	public $table='history_payment';
	public $sortFields = array(
		'id asc' => 'ID tăng',
		'id desc' => 'ID giảm',
		'paymentDate asc' => 'Ngày thanh toán tăng',
		'paymentDate desc' => 'Ngày thanh toán giảm',
		'paymentType asc' => 'Hình thức thanh toán tăng',
		'paymentType desc' => 'Hình thức thanh toán giảm',
		'paymentStatus asc' => 'Trạng thái thanh toán tăng',
		'paymentStatus desc' => 'Trạng thái thanh toán giảm',
		'status asc' => 'trạng thái hoá đơn tăng',
		'status desc' => 'trạng thái hoá đơn giảm',
		'transactioncode asc' => 'Mã giao dịch tăng',
		'transactioncode desc' => 'Mã giao dịch giảm',
		'billcode asc' => 'Mã hóa đơn tăng',
		'billcode desc' => 'Mã hóa đơn giảm',
		'bank asc' => 'Ngân hàng tăng',
		'bank desc' => 'Ngân hàng giảm',

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
			
			'option' => array(
				'' => 'Tất cả',
				'0' => 'Chưa kích hoạt', // init
				'1' => 'Đã kích hoạt', // accept
				'-1' => 'Đã hủy', // cancel
				'2' => 'Thành công', // complete
				'-2' => 'Thất bại' 
			),
			'label' => 'trạng thái hoá đơn'
		),
		array(
			'index' => 'buySoftware',
			'type' => 'selectoption',
			'option' => array(
				''  => 'Tất cả',
				
				'1' => 'Đã kích hoạt PM1',
				'2' => 'Đã kích hoạt PM2',
				'6' => 'Đã kích hoạt PM3'
			),
			'label' => 'Các phần mềm'
		)
	);
	public $searchFields = 'id,paymentDate, paymentType, transactioncode, billcode, bank';
	
	public $listFieldSettings = array(
		
		array(
			'index' => 'username',
			'type' => 'text',
			'label' => 'Tên đăng nhập'
		),
		array(
			'index' => 'paymentType',
			'type' => 'text',
			'label' => 'Loại thanh toán'
		),
		array(
			'index' => 'transactioncode',
			'type' => 'text',
			'label' => 'Mã giao dịch'
		),
		array(
			'index' => 'billcode',
			'type' => 'text',
			'label' => 'Mã hóa đơn'
		),
		array(
			'index' => 'amount',
			'type' => 'text',
			'label' => 'Tổng tiền'
		),
		array(
			'index' => 'paymentDate',
			'type' => 'text',
			'label' => 'Ngày thanh toán'
		),
		array(
			'index' => 'buySoftware',
			'type' => 'text',
			'label' => 'Phần mềm'
		),
		array(
			'index' => 'paymentStatus',
			'type' => 'text',
			'label' => 'Trạng thái thanh toán',
			
			'actions' => array(
				'0' => 'mở',
				'1' => 'dừng'
			)
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
						'model' => 'workflow.historypayment', 
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
	public $addLabel = 'Thêm giao dịch';
	public $addFieldSettings = array(
		
		array(
			'index' => 'username',
			'type' => 'text',
			'label' => 'Tên đăng nhập'
		),
		array(
			'index' => 'paymentType',
			'type' => 'selectoption',
			'option'=> array(
				'chuyển khoản ngân hàng'=>'Chuyển khoản ngân hàng',
				'tiền mặt'=>'Thanh toán tiền mặt'
			),

			'label' => 'Hình thức thanh toán'
		),
		array(
			'index' => 'transactioncode',
			'type' => 'text',
			'label' => 'Mã giao dịch (tại ngân hàng)'
		),
		array(
			'index' => 'billcode',
			'type' => 'text',
			'label' => 'Mã hóa đơn (mã hóa đơn)'
		),
		array(
			'index' => 'amount',
			'type' => 'text',
			'label' => 'Tổng tiền'
		),
		array(
			'index' => 'paymentDate',
			'type' => 'date',
			'label' => 'Ngày thanh toán'
		),
		array(
			'index' => 'bank',
			'type' => 'text',
			'label' => 'Ngân hàng'
		),
		array(
			'index' => 'paymentStatus',
			'type' => 'status',
			'label' => 'Tình trạng thanh toán',
			'options' => array(
				'0' => 'chưa thanh toán',
				'1' => 'Đã thanh toán'
			),
			'actions' => array(
				'0' => 'mở',
				'1' => 'dừng'
			)
		),
		array(
			'index' => 'status',
			'type' => 'status',
			'label' => 'Kích hoạt tài khoản user',			
			'option' => array(
				'0' => 'Chưa kích hoạt',
				'1' => 'Đã kích hoạt',
			),
			'actions' => array(
				'0' => 'mở',
				'1' => 'dừng'
			)
			
		),
		array(
			'index' => 'buySoftware',
			'type' => 'selectoption',			
			'option' => array(
				'1' => 'Kích hoạt PM1',
				'2' => 'Kích hoạt PM2',
				'6' => 'Kích hoạt PM3'
			),
			'label' => 'Kích hoạt phần mềm'
		)
	);
	public $editFieldSettings = array(
		
		array(
			'index' => 'username',
			'type' => 'text',
			'label' => 'Tên đăng nhập'
		),
		array(
			'index' => 'paymentType',
			'type' => 'selectoption',
			'option'=> array(
				'chuyển khoản ngân hàng'=>'Chuyển khoản ngân hàng',
				'tiền mặt'=>'Thanh toán tiền mặt'
			),

			'label' => 'Hình thức thanh toán'
		),
		array(
			'index' => 'transactioncode',
			'type' => 'text',
			'label' => 'Mã giao dịch (tại ngân hàng)'
		),
		array(
			'index' => 'billcode',
			'type' => 'text',
			'label' => 'Mã hóa đơn (mã hóa đơn)'
		),
		array(
			'index' => 'amount',
			'type' => 'text',
			'label' => 'Tổng tiền'
		),
		array(
			'index' => 'paymentDate',
			'type' => 'date',
			'label' => 'Ngày thanh toán'
		),
		array(
			'index' => 'bank',
			'type' => 'text',
			'label' => 'Ngân hàng'
		),
		array(
			'index' => 'paymentStatus',
			'type' => 'status',
			'label' => 'Tình trạng thanh toán',
			'options' => array(
				'0' => 'chưa thanh toán',
				'1' => 'Đã thanh toán'
			),
			'actions' => array(
				'0' => 'mở',
				'1' => 'dừng'
			)
		),
		array(
			'index' => 'status',
			'type' => 'status',
			'label' => 'Kích hoạt tài khoản user',			
			'option' => array(
				'0' => 'Chưa kích hoạt',
				'1' => 'Đã kích hoạt',
			),
			'actions' => array(
				'0' => 'mở',
				'1' => 'dừng'
			)
			
		),
		array(
			'index' => 'buySoftware',
			'type' => 'selectoption',			
			'option' => array(
				'1' => 'Kích hoạt PM1',
				'2' => 'Kích hoạt PM2',
				'3' => 'Kích hoạt PM3'
			),
			'label' => 'Kích hoạt phần mềm'
		)
	);
	public $addValidator = array(
		'rules' => array(
			'paymentType' => array(
				'required' => true
			),
			'amount' => array(
				'required' => true

				
			)
		),
		'messages' => array(
			'paymentType' => array(
				'required' => 'Phải nhập thức thanh toán'
				
			),
			
			'amount' => array(
				'required' => 'Nhập số tiền thanh toán'
				
			)
		)
	);
	public $editValidator = array(
			'rules' => array(
			'paymentType' => array(
				'required' => true
			),
			'amount' => array(
				'required' => true

			)
		),
		'messages' => array(
			'paymentType' => array(
				'required' => 'Phải nhập thức thanh toán'
				
			),
			
			'amount' => array(
				'required' => 'Nhập số tiền thanh toán'
				
			)
		)
	);
    public function addPostAction() {
        $row = $this->getAddData();
        if($this->validateAddData($row)) {
        	$username = $row['username'];            
            $user =_db()->getEntity('User.Account.User');
            if($username){
            	$user->loadWhere(array('username',$username));
            	$row['userId'] = $user->getId();
            }
			if($row['status']) {
				$row['paymentStatus'] = 1;
			} else {
				$row['paymentStatus'] = 0;
			}
            $row['creatorId']=pzk_session('adminId');
            $row['created']=date("Y-m-d H:i:s");
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
        	$username = $row['username'];            
            $user =_db()->getEntity('User.Account.User');
            if($username){
            	$user->loadWhere(array('username',$username));
            	$row['userId'] = $user->getId();
            }
			if($row['status']) {
				$row['paymentStatus'] = 1;
			} else {
				$row['paymentStatus'] = 0;
			}
        	$date=date("Y-m-d H:i:s");
            $row['modifiedId']=pzk_session('adminId');
            $row['modified']=date("Y-m-d H:i:s");
            $this->edit($row);
            pzk_notifier()->addMessage('Cập nhật thành công');
            $this->redirect('index');
        
        } else {
            pzk_validator()->setEditingData($row);
            $this->redirect('edit/' . pzk_request()->getId());
        }
    }
}