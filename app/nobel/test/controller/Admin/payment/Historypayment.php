<?php
class PzkAdminPaymentHistorypaymentController extends PzkGridAdminController {
	public $addFields = ' username, paymentType,bank,transactioncode,billcode, amount, paymentStatus,paymentDate,expiredDate, status, software,buySoftware, serviceType,site, contestId, serviceId, categoryIds, class, categoryIds,languages,coupon';
	public $editFields = ' username, paymentType,bank,transactioncode,billcode, amount, paymentStatus,paymentDate,expiredDate, status,software,buySoftware, serviceType,site, contestId, serviceId, categoryIds, class , categoryIds,languages,coupon';
	public $table='history_payment';	
	public $selectFields = 'history_payment.*, user.name, user.username, user.email, user.phone, user.registered';
	public $joins = array(		
		array('table' => 'user', 'condition' => 'history_payment.username = user.username', 'type' => 'left')	);		
	public $orderBy = 'history_payment.id desc';
	public $sortFields = array(
		'history_payment.id asc' 				=> 'ID tăng',
		'history_payment.id desc' 				=> 'ID giảm',
		'history_payment.paymentDate asc' 		=> 'Ngày thanh toán tăng',
		'history_payment.paymentDate desc' 		=> 'Ngày thanh toán giảm',
		'history_payment.paymentType asc' 		=> 'Hình thức thanh toán tăng',
		'history_payment.paymentType desc' 		=> 'Hình thức thanh toán giảm',
		'history_payment.paymentStatus asc' 	=> 'Trạng thái thanh toán tăng',
		'history_payment.paymentStatus desc' 	=> 'Trạng thái thanh toán giảm',
		'history_payment.status asc' 			=> 'trạng thái hoá đơn tăng',
		'history_payment.status desc' 			=> 'trạng thái hoá đơn giảm',
		'history_payment.transactioncode asc' 	=> 'Mã giao dịch tăng',
		'history_payment.transactioncode desc' 	=> 'Mã giao dịch giảm',
		'history_payment.billcode asc' 			=> 'Mã hóa đơn tăng',
		'history_payment.billcode desc' 		=> 'Mã hóa đơn giảm',
		'history_payment.bank asc' 				=> 'Ngân hàng tăng',
		'history_payment.bank desc' 			=> 'Ngân hàng giảm',

	);
	public $filterFields = array(
		array(
			'index' 	=> 'paymentStatus',
			'type' 		=> 'status',
			'label' 	=> 'Tình trạng thanh toán',
			'options' 	=> array(
				'0' 		=> 'chưa thanh toán',
				'1' 		=> 'Đã thanh toán'
			)
		),
		array(
			'index' 	=> 'status',
			'type' 		=> 'selectoption',
			
			'option' => array(
				'' 		=> 'Tất cả',
				'0' 	=> 'Chưa kích hoạt', // init
				'1' 	=> 'Đã kích hoạt', // accept
				'-1' 	=> 'Đã hủy', // cancel
				'2' 	=> 'Thành công', // complete
				'-2' 	=> 'Thất bại' 
			),
			'label' => 'trạng thái hoá đơn'
		),
		array(
			'index' 		=> 	'serviceType',
			'type' 			=> 	'select',
			'label' 		=> 	'Gói dịch vụ',
			'table' 		=> 	'service_packages',
			'show_value' 	=>	'serviceType',
			'show_name'  	=>	'serviceName'
		),
		array(
				'index'			=> 'created',
				'type' 			=> 'datetime',
				'label'			=> 'Thời gian',
				'option' 		=> array(
						1	 	=> 'Hôm nay',
						2 		=> 'Hôm qua',
				),
		),
		array(
			'index' 	=> 'paymentType',
			'type' 		=> 'selectoption',
			'option'	=> array(
				'bank'		=>	'Chuyển khoản ngân hàng',
				'money'		=>	'Thanh toán tiền mặt',
				'wallets'	=>	'Ví điện tử',
				'nganluong'	=>	'Ngân Lượng'
			),

			'label' 	=> 'Hình thức thanh toán'
		),
	);
	public $searchFields = array('`history_payment`.`username`', '`user`.`phone`');
	
	public $listFieldSettings = array(
		
		array(
			'index' 	=> 'username',
			'type' 		=> 'text',
			'label' 	=> 'Đăng nhập'
		),		
		array(			
			'index' 	=> 'name',			
			'type' 		=> 'text',			
			'label' 	=> 'Tên'		
		),
		array(			
			'index' 	=> 'class',			
			'type' 		=> 'text',			
			'label' 	=> 'Lớp'		
		),		
		array(			
			'index' 	=> 'phone',			
			'type' 		=> 'text',			
			'label' 	=> 'SĐT'		
		),
		array(
			'index' 	=> 'paymentType',
			'type' 		=> 'text',
			'label' 	=> 'Loại'
		),
		array(
			'index' 	=> 'billcode',
			'type' 		=> 'text',
			'label' 	=> 'H.Đơn'
		),
		array(
			'index' 	=> 'amount',
			'type' 		=> 'price',
			'label' 	=> 'T.Tiền'
		),
		array(
			'index' 	=> 'paymentDate',
			'type' 		=> 'datetime',
			'label' 	=> 'Ngày T.Toán',
			'format'	=> 'd/m/Y'
		),
		array(
			'index' 	=> 'serviceType',
			'type' 		=> 'text',
			'label' 	=> 'DV'
		),
		array(
			'index' 	=> 'scope',
			'type' 		=> 'text',
			'label' 	=> 'P.Vi',
			'maps'		=> array(
				'0'		=>	'Toàn bộ',
				'1'		=>	'Chỉ bài giảng',
				'2'		=>	'Chỉ bài tập'
			)
		),
		array(
			'index' 	=> 'coupon',
			'type' 		=> 'text',
			'label' 	=> 'Coupon',
		),
		array(
			'index' 	=> 'note',
			'type' 		=> 'text',
			'label' 	=> 'Ghi chú',
		),
		array(
			'index' 	=> 'paymentStatus',
			'type' 		=> 'status',
			'label' 	=> 'T.Toán',
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
						'model' 		=> 'workflow.historypayment', 
						'handler' 		=> 'active',
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
						'model' 		=> 'workflow.historypayment', 
						'handler' 		=> 'cancel',
						'adminLevel' 	=> 'Accountant, ChiefAccountant, Manager'
					),
					'2' 		=> array(
						'action' 		=>  'Thành công',
						'adminLevel' 	=> 'ChiefAccountant, Manager'
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
	public $logable 	= true;
	public $logFields 	= 'username, paymentType, transactioncode, bank, billcode, amount';
	public $addLabel 	= 'Thêm giao dịch';
	public $addFieldSettings = array(
	
		array(
			'index' 		=> 'username',
			'type' 			=> 'text',
			'label' 		=> 'Tên đăng nhập',
			'mdsize'		=>	6
		),
		array(
			'index' 		=> 'class',
			'type' 			=> 'selectoption',
			'option'		=> array(
				'5'				=>	'Lớp 5',
				'4'				=>	'Lớp 4',
				'3'			=>	'Lớp 3'
			),

			'label' 		=> 'Lớp',
			'mdsize'		=>	4
		),
		array(
			'index' 		=> 'serviceId',
			'type' 			=> 'select',
			'label' 		=> 'Dịch vụ',
			'table' 		=> 'service_packages',
			'show_value' 	=> 'id',
			'show_name'  	=> 'serviceName',
			'mdsize'		=>	6
		),
		array(
			'index' 		=> 'categoryIds',
			'type' 			=> EDIT_TYPE_MULTISELECT,
		  	'label'   		=> 'Danh mục cha',
			'table'   		=> 'categories',
			'show_value'  	=> 'id',
			'show_name'  	=> 'name'
		),
		array(
			'index' 		=> 'paymentType',
			'type' 			=> 'selectoption',
			'option'		=> array(
				'bank'				=>	'Chuyển khoản ngân hàng',
				'money'				=>	'Thanh toán tiền mặt',
				'wallets'			=>	'Ví điện tử',
				'nganluong'			=>	'Ngân Lượng'
			),

			'label' 		=> 'Hình thức thanh toán',
			'mdsize'		=>	4
		),
		array(
			'index' 		=> 'bank',
			'type' 			=> 'text',
			'label' 		=> 'Ngân hàng',
			'mdsize'		=>	4
		),
		array(
			'index' 		=> 'transactioncode',
			'type' 			=> 'text',
			'label' 		=> 'Mã giao dịch',
			'mdsize'		=>	4
		),
		array(
			'index' 		=> 'amount',
			'type' 			=> 'text',
			'label' 		=> 'Tổng tiền',
			'mdsize'		=>	4
		),
		array(
			'index' 		=> 'paymentDate',
			'type' 			=> 'date',
			'label' 		=> 'Ngày thanh toán',
			'mdsize'		=>	4
		),
		array(
			'index' 		=> 'expiredDate',
			'type' 			=> 'date',
			'label' 		=> 'Ngày hết hạn',
			'mdsize'		=>	4
		),
		array(
			'index' 		=> 'billcode',
			'type' 			=> 'text',
			'label' 		=> 'Mã hóa đơn',
			'mdsize'		=>	6
		),
		array(
			'index' 		=> 'coupon',
			'type' 			=> 'text',
			'label' 		=> 'Mã Coupon',
			'mdsize'		=>	6
		),
		array(
			'index' 		=> 'paymentStatus',
			'type' 			=> 'status',
			'label' 		=> 'Tình trạng thanh toán',
			'mdsize'		=>	6
		)
	);
	public $editFieldSettings = array(
		
		array(
			'index' 		=> 'username',
			'type' 			=> 'text',
			'label' 		=> 'Tên đăng nhập',
			'mdsize'		=>	6
		),
		array(
			'index' 		=> 'class',
			'type' 			=> 'selectoption',
			'option'		=> array(
				'5'				=>	'Lớp 5',
				'4'				=>	'Lớp 4',
				'3'			=>	'Lớp 3'
			),

			'label' 		=> 'Lớp'
		),
		array(
			'index' 		=> 'serviceId',
			'type' 			=> 'select',
			'label' 		=> 'Dịch vụ',
			'table' 		=> 'service_packages',
			'show_value' 	=> 'id',
			'show_name'  	=> 'serviceName',
			'mdsize'		=>	6
		),
		array(
			'index' 		=> 'paymentType',
			'type' 			=> 'selectoption',
			'option'		=> array(
				'bank'				=>	'Chuyển khoản ngân hàng',
				'money'				=>	'Thanh toán tiền mặt',
				'wallets'			=>	'Ví điện tử',
				'nganluong'			=>	'Ngân Lượng'
			),

			'label' 		=> 'Hình thức thanh toán',
			'mdsize'		=>	4
		),
		array(
			'index' 		=> 'categoryIds',
			'type' 			=> EDIT_TYPE_MULTISELECT,
		  	'label'   		=> 'Danh mục cha',
			'table'   		=> 'categories',
			'show_value'  	=> 'id',
			'show_name'  	=> 'name'
		),
		array(
			'index' 		=> 'bank',
			'type' 			=> 'text',
			'label' 		=> 'Ngân hàng',
			'mdsize'		=>	4
		),
		array(
			'index' 		=> 'transactioncode',
			'type' 			=> 'text',
			'label' 		=> 'Mã giao dịch',
			'mdsize'		=>	4
		),
		array(
			'index' 		=> 'amount',
			'type' 			=> 'text',
			'label' 		=> 'Tổng tiền',
			'mdsize'		=>	4
		),
		array(
			'index' 		=> 'paymentDate',
			'type' 			=> 'date',
			'label' 		=> 'Ngày thanh toán',
			'mdsize'		=>	4
		),
		array(
			'index' 		=> 'expiredDate',
			'type' 			=> 'date',
			'label' 		=> 'Ngày hết hạn',
			'mdsize'		=>	4
		),
		array(
			'index' 		=> 'billcode',
			'type' 			=> 'text',
			'label' 		=> 'Mã hóa đơn',
			'mdsize'		=>	6
		),
		array(
			'index' 		=> 'coupon',
			'type' 			=> 'text',
			'label' 		=> 'Mã Coupon',
			'mdsize'		=>	6
		),
		array(
			'index' 		=> 'paymentStatus',
			'type' 			=> 'status',
			'label' 		=> 'Tình trạng thanh toán',
			'mdsize'		=>	6
		)
	);
	public $addValidator = array(
		'rules' 	=> array(
			'username' 		=> array(
				'required' 		=> true
			),
			'paymentType' 	=> array(
				'required' 		=> true
			),
			'amount' 		=> array(
				'required' 		=> true
			),
			'serviceId' 	=> array(
				'required' 		=> true
			)
		),
		'messages' 	=> array(
			'username' 		=> array(
				'required' 		=> 'Phải nhập tên đăng nhập'
			),
			'paymentType' 	=> array(
				'required' 		=> 'Phải nhập thức thanh toán'
			),
			'amount' 		=> array(
				'required' 		=> 'Nhập số tiền thanh toán'
			),
			'serviceId' 	=> array(
				'required' 		=> 'Kích hoạt dịch vụ'
			)
		)
	);
	public $editValidator = array(
		'rules' 	=> array(
			'username' 		=> array(
				'required' 		=> true
			),
			'paymentType' 	=> array(
				'required' 		=> true
			),
			'amount' 		=> array(
				'required' 		=> true

				
			),
			'serviceId' 	=> array(
				'required' 		=> true
			)
		),
		'messages' 	=> array(
			'username' 		=> array(
				'required' 		=> 'Phải nhập tên đăng nhập'
			),
			'paymentType' 	=> array(
				'required' 		=> 'Phải nhập thức thanh toán'
			),
			'amount' 		=> array(
				'required' 		=> 'Nhập số tiền thanh toán'
			),
			'serviceId' 	=> array(
				'required' 		=> 'Kích hoạt dịch vụ'
			)
		)
	);
	
    public $exportFields = array('user.username', 'user.email', 'user.phone, history_payment.serviceType');

    public $exportTypes = array('pdf', 'excel', 'csv');
	
    public function addPostAction() {
        $row = $this->getAddData();
        if(isset($row['serviceId'])) {
			$service = _db()->selectAll()->fromService_packages()->whereId($row['serviceId'])->result_one();
			if($service) {
				$row['serviceType'] = $service['serviceType'];
				$row['amount'] 		= @$row['amount'] ? $row['amount'] : $service['amount'];
				$row['contestId']	= @$row['contestId']? $row['contestId'] : $service['contestId'];
				$row['categoryIds']	= @$row['categoryIds'] ? $row['categoryIds']: $service['categoryIds'];
				$row['languages'] 	= $service['languages'];
				$row['scope'] 		= @$service['scope'];
			}
		}
		$coupon		=	$row['coupon'];
		$couponUser	=	null;
		if($coupon) {
			$couponUser 	=	_db()->getTableEntity('coupon_user');
			$couponEntity 	= 	_db()->getTableEntity('coupon');
			$couponEntity->loadWhere(array('code', $coupon));
			
			if($couponEntity->get('id')) {
				$amount			=	$row['amount'];
				$amount			=	$amount - $amount * $couponEntity->get('discount') / 100;
				$couponUser->setData(array(
					'userId'	=>	$row['userId'],
					'username'	=>	$row['username'],
					'code'		=>	$coupon,
					'resellerId'=>	$couponEntity->get('resellerId'),
					'status'	=>	1,
					'actived'	=> 	date('Y-m-d H:i:s'),
					'amount'	=>	$amount,
					'class'		=>	$row['class'],
					'languages'	=>	$row['languages'],
					'creatorId' =>	pzk_session('adminId'),
					'created' 	=>	date("Y-m-d H:i:s"),
					'software'	=>	pzk_request('softwareId'),
					'site'		=>	pzk_request('siteId')
				));
				$couponUser->save();
				$row['amount']	=	$amount;
			}
		}
		if($this->validateAddData($row)) {            
            $row['creatorId']=pzk_session('adminId');
            $row['created']=date("Y-m-d H:i:s");
			$paymentId 	=	$this->add($row);
			if($couponUser) {
				$couponUser->set('userId', $paymentId);
				$couponUser->save();
			}
            pzk_notifier()->addMessage('Cập nhật thành công');
            $this->redirect('index');
        
        } else {
            pzk_validator()->setEdittingData($row);
            $this->redirect('add');
        }
    }

    public function editPostAction() {
    	$id		= pzk_request('id');
        $row 	= $this->getEditData();
        
		// check bản ghi dịch vụ
		if(isset($row['serviceId'])) {
			$service = _db()->selectAll()->fromService_packages()->whereId($row['serviceId'])->result_one();
			if($service) {
				$row['serviceType'] = $service['serviceType'];
				$row['amount'] 		= @$row['amount'] ? $row['amount'] : $service['amount'];
				$row['contestId']	= @$row['contestId']? $row['contestId'] : $service['contestId'];
				$row['categoryIds']	= @$row['categoryIds'] ? $row['categoryIds']: $service['categoryIds'];
				$row['languages'] 	= $service['languages'];
				$row['scope'] 		= @$service['scope'];
			}
		}
		$coupon		=	$row['coupon'];
		if($coupon) {
			$couponUser 	=	_db()->getTableEntity('coupon_user');
			$couponUser->loadWhere(array('paymentId', $id));
			$couponEntity 	= 	_db()->getTableEntity('coupon');
			$couponEntity->loadWhere(array('code', $coupon));
			
			if($couponEntity->get('id')) {
				$amount			=	$row['amount'];
				$amount			=	$amount - $amount * $couponEntity->getDiscount() / 100;
				$couponUser->setData(array(
					'userId'	=>	$row['userId'],
					'username'	=>	$row['username'],
					'code'		=>	$coupon,
					'resellerId'=>	$couponEntity->getResellerId(),
					'status'	=>	1,
					'actived'	=> 	date('Y-m-d H:i:s'),
					'amount'	=>	$amount,
					'class'		=>	$row['class'],
					'languages'	=>	$row['languages'],
					'modifiedId' =>	pzk_session('adminId'),
					'modified' 	=>	date("Y-m-d H:i:s"),
					'software'	=>	pzk_request('softwareId'),
					'site'		=>	pzk_request('siteId'),
					'paymentId'	=>	$id
				));
				$couponUser->save();
				$row['amount']	=	$amount;
			}
		}
		if($this->validateEditData($row)) {        	
        	$date = date("Y-m-d H:i:s");
            $row['modifiedId'] = pzk_session('adminId');
            $row['modified'] = date("Y-m-d H:i:s");            
            $row['software'] = pzk_request('softwareId');
            $row['site'] = pzk_request('siteId');
			$this->edit($row);
            pzk_notifier()->addMessage('Cập nhật thành công');
            $this->redirect('index');
        
        } else {
            pzk_validator()->setEditingData($row);
            $this->redirect('edit/' . pzk_request('id'));
        }
    }
}