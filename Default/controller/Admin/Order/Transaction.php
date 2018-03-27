<?php
class PzkAdminOrderTransactionController extends PzkGridAdminController {
    public $title = 'Quản lý giao dịch';
	public $addFields = 'orderId,userId,username, paymentType,amount, paymentDate,transactionId,paymentOption,transactionStatus,service,reason,status,cardType,cardAmount';
    public $editFields ='orderId,userId,username, paymentType,amount, paymentDate,transactionId,paymentOption,transactionStatus,service,reason,status,cardType,cardAmount';
	public $logable = true;
	public $logFields = 'orderId,userId,username, paymentType,amount, paymentDate,transactionId,paymentOption,transactionStatus,service,reason,status,cardType,cardAmount';
    public $table='order_transaction';
	public $joins = array(
		array(
			'table'	=> '`order`',
			'condition'	=> 'order_transaction.orderId=`order`.id',
			'type'	=> 'left'
		),
		array(
			'table'	=> 'service_packages',
			'condition'	=> 'order_transaction.service=service_packages.id',
			'type'	=> 'left'
		),
		array(
			'table' => '`admin` as `creator`',
			'condition' => '`order_transaction`.creatorId = creator.id',
			'type' => 'left'
		),
		array(
			'table' => '`admin` as `modifier`',
			'condition' => '`order_transaction`.modifiedId = modifier.id',
			'type' => 'left'
		)
	);
	public $selectFields = 'order_transaction.*, service_packages.serviceName as serviceName, creator.name as creatorName, modifier.name as modifiedName';
    public $sortFields = array(
        'order_transaction.id asc' => 'ID tăng',
        'order_transaction.id desc' => 'ID giảm',
        'order_transaction.paymentDate asc' => 'Ngày tăng',
        'order_transaction.paymentDate desc' => 'Ngày giảm',
        'order_transaction.username asc' => 'Username tăng',
        'order_transaction.username desc' => 'Username giảm'
    );
	public $orderBy = 'order_transaction.id desc';
    public $searchFields = array('orderId','userId','username', 'paymentType','amount', 'paymentDate','transactionId','paymentOption','transactionStatus','service','reason','status','cardType','cardAmount');
    public $filterFields = array(

        array(
            'index' => 'status',
            'type' => 'selectoption',
            'option' => array(
                
                '0' => 'Chưa thành công',
                '1' => 'Thành công',
                '-1' => 'Đã huỷ'
            ),
            'label' =>'Trạng thái giao dịch'
        ),        
        array(
            'index' => 'paymentType',
            'type' => 'selectoption',
            'option'=>array(
                'paycard'=>'Thẻ cào',
                'nganluong'=>'NgânLượng',
                'money'=>'Tiền mặt',
                'wallets'=>'Ví điện tử',
                'bank'=>'Ngân hàng'
            ),
            'label' =>'Hình thức thanh toán'
        )
    );
    public $listFieldSettings = array(
        
        array(
            'index' => 'orderId',
            'type' => 'text',
            'label' => 'orderId '
        ),
        array(
            'index' => 'userId',
            'type' => 'text',
            'label' => 'UserId '
        ),
        array(
            'index' => 'username',
            'type' => 'text',
            'label' => 'UserName',
            'link' => '/admin_ordertransaction/detail/'
        ),
        array(
            'index' => 'paymentType',
            'type' => 'text',
            'label' => 'paymentType',
			'maps'=>array(
                'paycard'=>'Thẻ cào',
                'nganluong'=>'NgânLượng',
                'money'=>'Tiền mặt',
                'wallets'=>'Ví điện tử',
                'bank'=>'Ngân hàng'
            ),
        ),
        
        array(
            'index' => 'serviceName',
            'type' => 'text',
            'label' => 'Dịch vụ'
        ),
        array(
            'index' => 'amount',
            'type' => 'price',
            'label' => 'Tổng tiền'
        ),
        array(
            'index' => 'paymentDate',
            'type' => 'datetime',
			'format'	=> 'd/m/Y H:i',
            'label' => 'Ngày thanh toán'
        ),
        
        array(
            'index' => 'status',
            'type' => 'workflow',
            'label' => 'Trạng thái thanh toán',
            'states' => array(
                '0' => 'Chưa thanh toán',
                '1' => 'Đã thanh toán',
                '-1' => 'Đã huỷ'
            ),
            'rules' => array(
                '0' => array(
                    '1' => array(
                        'action' => 'Hoàn thành',
                        'model'     => 'transaction',
                        'handler'   => 'changeStatus'
                )),
                '1' => array(
                    '0' => array(
                        'action' => 'Chờ xử lý',
                        'model'     => 'transaction',
                        'handler'   => 'changeStatus'
                    ),
                    '-1' => array(
                        'action' =>  'Huỷ',
                        'model'     => 'transaction',
                        'handler'   => 'changeStatus'
                )),
                '-1' => array(
                    '1' => array(
                        'action' => 'hoàn thành',
                        'model'     => 'transaction',
                        'handler'   => 'changeStatus'
                    )
                )
            ),
            'bgcolor' => '',
            'color' => ''
        ),
		array(
			'index'	=> 'none4',
			'type'	=> 'group',
			'label'	=> '<br />Người tạo<br />Người sửa',
			'delimiter'	=> '<br />',
			'fields'	=> array(
				array(
					'index' => 'creatorName',
					'type' => 'text',
					'label' => 'Người tạo'
				),
				array(
					'index' => 'modifiedName',
					'type' => 'text',
					'label' => 'Người sửa'
				),
			)
		),
		array(
			'index'	=> 'none5',
			'type'	=> 'group',
			'label'	=> '<br />Ngày tạo<br />Ngày sửa',
			'delimiter'	=> '<br />',
			'fields'	=> array(
				array(
					'index' => 'created',
					'type' => 'datetime',
					'label' => 'Ngày tạo',
					'format'	=> 'H:i d/m'
				),
				array(
					'index' => 'modified',
					'type' => 'datetime',
					'label' => 'Ngày sửa',
					'format'	=> 'H:i d/m'
				),
			)
		),
        /*array(
            'index' => 'status',
            'type' => 'text',
            'label' => 'Trạng thái hoán đơn'
        )*/

    );
    //public $addFields = 'orderId,userId,username, paymentType,amount, paymentDate,transactionId,paymentOption,transactionStatus,service,reason,status';
    public $addLabel = 'Thêm mới';
    public $addFieldSettings = array(
        array(
            'index' => 'orderId',
            'type' => 'text',
            'label' => 'Mã hoá đơn'
        ),
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
            'index' => 'paymentType',
            'type' => 'selectoption',
            'option'=>array(
                'paycard'=>'Thẻ cào',
                'nganluong'=>'NgânLượng',
                'money'=>'Tiền mặt',
                'wallets'=>'Ví điện tử',
                'bank'=>'Ngân hàng'
            ),
            'label' =>'Hình thức thanh toán'
        ),
        array(
            'index' => 'amount',
            'type' => 'text',
            'label' => 'Tổng tiền'
        ),
        array(
            'index' => 'transactionId',
            'type' => 'text',
            'label' => 'Mã giao dịch tại Ngân Lượng'
        ),
        array(
            'index' => 'paymentOption',
            'type' => 'selectoption',
            'option'=>array(
                'nganluong'=>' Ví Ngân Lượng',
                'paycard'=>'Thẻ cào',
                'bank'=>'Ngân hàng'
            ),
            'label' => 'Hình thức thanh toán của(Ngân Lượng)'
        ),
        array(
            'index' => 'cardType',
            'type' => 'text',
            'label' => 'Loại thẻ cào'
        ),
        array(
            'index' => 'cardAmount',
            'type' => 'text',
            'label' => 'Mệnh giá thẻ nạp'
        ),
        array(
            'index' => 'service',
            'type' => 'select',
            'table'=>'service_packages',
            'show_value'=>'id',
            'show_name'=>'serviceName',
            'label' => 'Dịch vụ'
        ),
        
        array(
            'index' => 'reason',
            'type' => 'text',
            'label' => 'Lý do'
        ),
        array(
            'index' => 'status',
            'type' => 'status',
            'label' => 'Trạng thái giao dịch',
            'options' => array(
                '0' => 'chưa thanh toán',
                '1' => 'Đã thanh toán'
            ),
            'actions' => array(
                '0' => 'mở',
                '1' => 'dừng'
            )
        )
    );
    public $editFieldSettings = array(
        array(
            'index' => 'orderId',
            'type' => 'text',
            'label' => 'Mã hoá đơn'
        ),
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
            'index' => 'paymentType',
            'type' => 'selectoption',
            'option'=>array(
                'paycard'=>'Thẻ cào',
                'nganluong'=>'NgânLượng',
                'money'=>'Tiền mặt',
                'wallets'=>'Ví điện tử',
                'bank'=>'Ngân hàng'
            ),
            'label' =>'Hình thức thanh toán'
        ),
        array(
            'index' => 'amount',
            'type' => 'text',
            'label' => 'Tổng tiền'
        ),
        array(
            'index' => 'transactionId',
            'type' => 'text',
            'label' => 'Mã giao dịch tại Ngân Lượng'
        ),
        array(
            'index' => 'paymentOption',
            'type' => 'selectoption',
            'option'=>array(
                'nganluong'=>'Ví Ngân Lượng',
                'paycard'=>'Thẻ cào',
                'bank'=>'Ngân hàng'
            ),
            'label' => 'Hình thức thanh toán của(Ngân Lượng)'
        ),
        array(
            'index' => 'cardType',
            'type' => 'text',
            'label' => 'Loại thẻ cào'
        ),
        array(
            'index' => 'cardAmount',
            'type' => 'text',
            'label' => 'Mệnh giá thẻ nạp'
        ),
        array(
            'index' => 'service',
            'type' => 'select',
            'table'=>'service_packages',
            'show_value'=>'id',
            'show_name'=>'serviceName',
            'label' => 'Dịch vụ'
        ),
        
        array(
            'index' => 'reason',
            'type' => 'text',
            'label' => 'Lý do'
        ),
        array(
            'index' => 'status',
            'type' => 'status',
            'label' => 'Trạng thái giao dịch',
            'options' => array(
                '0' => 'chưa thanh toán',
                '1' => 'Đã thanh toán'
            ),
            'actions' => array(
                '0' => 'mở',
                '1' => 'dừng'
            )
        )
    );
    public $addValidator = array(
        'rules' => array(
            
            'amount' => array(
                'required' => true               
            ),
            'paymentType' => array(
                'required' => true               
            ),
            'status' => array(
                'required' => true               
            )

        ),
        'messages' => array(
            
            
            'amount' => array(
                'required' => 'Tổng tiền không được để trống'                
            ),
            'paymentType' => array(
                'required' => 'Hình thức thanh toán không được để trống'                
            ),
            'status' => array(
                'required' => 'Trạng thái giao dịch không được để trống'                
            )
        )
    );
    public $editValidator = array(
        'rules' => array(
            
            'amount' => array(
                'required' => true               
            ),
            'paymentType' => array(
                'required' => true               
            ),
            'status' => array(
                'required' => true               
            )

        ),
        'messages' => array(
            
            
            'amount' => array(
                'required' => 'Tổng tiền không được để trống'                
            ),
            'paymentType' => array(
                'required' => 'Hình thức thanh toán không được để trống'                
            ),
            'status' => array(
                'required' => 'Trạng thái giao dịch không được để trống'                
            )
        )
    );
    public function detailAction($id){
        $this->initPage();
        $this->append('admin/transaction/detail', 'left'); 
        $this->append('admin/grid/menu', 'right'); 
        $this->display();

    }
    public function addPostAction() {
        $row = $this->getAddData();
        if($this->validateAddData($row)) {
            $row['creatorId']=pzk_session('userId');
            $status= pzk_request('status');
            $amount= pzk_request('amount');
            $cardAmount= pzk_request('cardAmount');
            if($cardAmount != 0){
                $amountService= $cardAmount;
            }else $amountService=$amount;
            $row['created']=date("Y-m-d H:i:s");            
            $user= _db()->getEntity('User.Account.User');
            $username = trim(pzk_request('username'));
            $row['paymentDate']= date("Y-m-d H:i:s");            
            if($username){
                $user->loadWhere(array('username',$username));
                $userId=$user->get('id');
                $row['userId']=$userId;
                // nạp tiền vào tài khoản cho user
                $wallets=_db()->getEntity('User.Account.Wallets');
                $wallets->loadWhere(array('userId',$userId));
                if($wallets->get('id')){
                    $wal_amount=$wallets->getAmount();          
                    if($status== 1){
                        $wal_amount= $wal_amount + $amountService;
                    }
                    $wallets->update(array('amount'=>$wal_amount));      
                }else{
                    $row_=array('userId'=>$userId,'username'=>$username,'amount'=>$amountService);              
                    $wallets->setData($row_);
                    $wallets->save();
                }
            }           
            $this->add($row);                    
            pzk_notifier()->addMessage('Cập nhật thành công');
            $this->redirect('index');
        
        } else {
            pzk_validator()->setEditingData($row);
            $this->redirect('add');
        }
    }
    public function editPostAction() {
        $row = $this->getEditData();
        if($this->validateEditData($row)) {
            $row['modifiedId']=pzk_session('userId');
            $row['modified']=date("Y-m-d H:i:s");
            
            $this->edit($row);                    
            pzk_notifier()->addMessage('Cập nhật thành công');
            $this->redirect('index');
        
        } else {
            pzk_validator()->setEditingData($row);
            $this->redirect('edit/' . pzk_request('id'));
        }
    }
}