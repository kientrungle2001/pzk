<?php
class PzkAdminOrderController extends PzkGridAdminController {
    public $title = 'Quản lý Đơn hàng';
	public $addFields = 'userId,username, name,phone, address,serviceId,quantity,amount,paymentType,bank,paymentStatus,orderDate,status,activeUser,note,software';
    public $editFields = 'userId,username, name,phone, address,serviceId,quantity,amount,paymentType,bank,paymentStatus,status,activeUser,note,software';
	public $logable = true;
	public $logFields = 'userId,username, name,phone, address,serviceId,quantity,amount,paymentType,bank,paymentStatus,status,activeUser,note';
    public $table='order';
    public $sortFields = array(
        'id asc' => 'ID tăng',
        'id desc' => 'ID giảm',
        'orderDate asc' => 'Ngày tăng',
        'orderDate desc' => 'Ngày giảm',
        'username asc' => 'Username tăng',
        'username desc' => 'Username giảm'
    );
	public $joins = array(
		array(
			'table' => 'service_packages',
			'condition' => '`order`.serviceId = service_packages.id',
			'type'	=> 'left'
		),
		array(
			'table' => '`admin` as `creator`',
			'condition' => '`order`.creatorId = creator.id',
			'type' => 'left'
		),
		array(
			'table' => '`admin` as `modifier`',
			'condition' => '`order`.modifiedId = modifier.id',
			'type' => 'left'
		)
	);
	public $selectFields = '`order`.*, service_packages.serviceName, service_packages.serviceType as serviceType, creator.name as creatorName, modifier.name as modifiedName';
    public $searchFields = array('userId','username', 'name','phone', 'address','serviceId','quantity','amount','paymentType','bank','paymentStatus','orderDate','status','activeUser','note');
    public $filterFields = array(

        array(
            'index' => 'status',
            'type' => 'selectoption',
            'option' => array(
                
                '0' => 'Chờ xử lý',
                '1' => 'Đã hoàn thành',
                '-1' => 'Đã huỷ'
            ),
            'label' =>'Trạng thái hoá đơn'
        ),
        array(
            'index' => 'paymentStatus',
            'type' => 'selectoption',
            'option' => array(
                
                '0' => 'Chưa thanh toán',
                '1' => 'Đã thanh toán'
            ),
            'label' =>'Trạng thái thanh toán'
        ),
        array(
            'index' => 'paymentType',
            'type' => 'selectoption',
            'option'=>array(
                'datmuathe'=>'Đặt mua thẻ Nextnobels',
                'nganluong'=>'Thanh toán NgânLượng',
                'tienmat'=>'Tiền mặt',
                'wallets_buyservice'=>'Tài khoản NextNobels',
                'bank'=>'Ngân hàng'
            ),
            'label' =>'Hình thức thanh toán'
        )
    );
    public $listFieldSettings = array(
        
        /*array(
            'index' => 'userId',
            'type' => 'text',
            'label' => 'UserId '
        ),*/
        array(
            'index' => 'username',
            'type' => 'text',
            'label' => 'UserName',
            'link' => '/admin_order/detail/'
        ),
        array(
            'index' => 'name',
            'type' => 'text',
            'label' => 'name',
            'link' => '/admin_order/detail/'
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
		/*
        array(
            'index' => 'serviceId',
            'type' => 'text',
            'label' => 'Dịch vụ'
        ),*/
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
            'index' => 'paymentType',
            'type' => 'text',
            'label' => 'Loại thanh toán',
			'maps' => array(
				'tienmat'				=> 'Tiền mặt',
				'wallets_buyservice'	=> 'Ví cá nhân',
				'datmuathe'				=> 'Thẻ nextnobels',
				'bank'					=> 'Chuyển khoản'
			)
        ),
        array(
            'index' => 'paymentStatus',
            'type' => 'text',
            'label' => 'Trạng thái thanh toán',
			'maps'	=> array(
				'0'	=> 'Chưa thanh toán',
				'1'	=> 'Đã thanh toán'
			)
        ),
        array(
            'index' => 'orderDate',
            'type' => 'datetime',
			'format'	=> 'd/m/Y H:i',
            'label' => 'Ngày'
        ),
        array(
            'index' => 'status',
            'type' => 'workflow',
            'label' => 'Trạng thái hoá đơn',
            'states' => array(
                '0' => 'Chờ xử lý',
                '1' => 'Đã hoàn thành',
                '-1' => 'Đã huỷ'
            ),
            'rules' => array(
                '0' => array(
                    '1' => array(
                        'action' => 'Hoàn thành',
                        'model'     => 'order',
                        'handler'   => 'changeStatus'
                        )),
                '1' => array(
                    '0' => array(
						'action' => 'Chờ xử lý',
						'model' 	=> 'order',
						'handler'	=> 'changeStatus'
					),
                    '-1' => array(
						'action' =>  'Huỷ',
						'model' 	=> 'order',
						'handler'	=> 'changeStatus'
					)),
                '-1' => array(
                    '1' => array(
                        'action' => 'hoàn thành',
                        'model'     => 'order',
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
    public $addLabel = 'Thêm mới';
    public $addFieldSettings = array(
        array(
            'index' => 'username',
            'type' => 'text',
            'label' => 'Tên đăng nhập'
        ),
        array(
            'index' => 'name',
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
            'index' => 'note',
            'type' => 'select',
            'table'=>'service_packages',
            'show_value'=>'id',
            'show_name'=>'serviceName',
            'label' => 'Loại thẻ(chỉ chọn khi khách hàng đặt mua thẻ Nextnobels)'
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
            'index' => 'activeUser',
            'type' => 'selectoption',
            'option'=>array(
                '0'=>'Không kích hoạt',
                '1'=>'Kích hoạt'
            ),
            'label' => 'kích hoạt dịch vụ cho User'
        ),
        array(
            'index' => 'paymentType',
            'type' => 'selectoption',            
            'option'=>array(
                'datmuathe'=>'Đặt mua thẻ Nextnobels',
                'nganluong'=>'Thanh toán NgânLượng',
                'tienmat'=>'Tiền mặt',
                'wallets_buyservice'=>'Tài khoản NextNobels',
                'bank'=>'Ngân hàng'
            ),
            'label' => 'Hình thức thanh toán',
        ),
        array(
            'index' => 'bank',
            'type' => 'text',
            'label' => 'Ngân hàng'
        ),
        array(
            'index' => 'paymentStatus',
            'type' => 'selectoption',
            'option'=>array(
                '0'=>'Chưa thanh toán',
                '1'=>'Đã thanh toán'
            ),
            'label' => 'Trạng thái thanh toán'
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
            'index' => 'userId',
            'type' => 'text',
            'label' => 'UserId '
        ),
        array(
            'index' => 'username',
            'type' => 'text',
            'label' => 'Tên đăng nhập'
        ),
        array(
            'index' => 'name',
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
            'label' => 'Gói dịch vụ( Giành cho khách hàng mua gói dịch vụ của NextNobels)'
        ),
        array(
            'index' => 'note',
            'type' => 'select',
            'table'=>'service_packages',
            'show_value'=>'id',
            'show_name'=>'serviceName',
            'label' => 'Loại thẻ(chỉ chọn khi khách hàng đặt mua thẻ Nextnobels)'
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
            'index' => 'activeUser',
            'type' => 'selectoption',
            'option'=>array(
                '0'=>'Không kích hoạt',
                '1'=>'Kích hoạt'
            ),
            'label' => 'kích hoạt dịch vụ cho User'
        ),
        array(
            'index' => 'paymentType',
            'type' => 'selectoption',            
            'option'=>array(
                'datmuathe'=>'Đặt mua thẻ Nextnobels',
                'nganluong'=>'Thanh toán NgânLượng',
                'tienmat'=>'Tiền mặt',
                'wallets_buyservice'=>'Tài khoản NextNobels',
                'bank'=>'Ngân hàng'
            ),
            'label' => 'Hình thức thanh toán',
        ),
        array(
            'index' => 'bank',
            'type' => 'text',
            'label' => 'Ngân hàng'
        ),
        array(
            'index' => 'paymentStatus',
            'type' => 'selectoption',
            'option'=>array(
                
                '0'=>'Chưa thanh toán',
                '1'=>'Đã thanh toán'
            ),
            'label' => 'Trạng thái thanh toán'
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
    /*public $addValidator = array(
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
            'paymentType' => array(
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
            'paymentType' => array(
                'required' => 'Hình thức thanh toán không được để trống'                
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
            'paymentType' => array(
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
            'paymentType' => array(
                'required' => 'Hình thức thanh toán không được để trống'                
            ),
            'status' => array(
                'required' => 'Trạng thái đơn hàng không được để trống'                
            )
        )
    ); */
    public function detailAction($id){
        $this->initPage();
        $this->append('admin/order/detail', 'left'); 
        $this->append('admin/grid/menu', 'right'); 
        $this->display();

    }
    public function addPostAction() {
        $row = $this->getAddData();
        if($this->validateAddData($row)) {
            $row['creatorId']=pzk_session()->getUserId();
            $row['created']=date("Y-m-d H:i:s");
            $row['software']=3;
            $user= _db()->getEntity('User.Account.User');
            $username = trim(pzk_request()->getUsername());
            $row['orderDate']= date("Y-m-d H:i:s");
            //Khách hàng mua dịch vụ bằng tài khoản ngân hàng
            if($username){
                $user->loadWhere(array('username',$username));
                $userId=$user->getId();
                $row['userId']=$userId;
            }
            $orderId=$this->add($row);
            // Lưu bảng order_transaction
            if($row['paymentStatus']==1){
                $orderTrans=_db()->getEntity('payment.transaction');
                $rowTrans= array('orderId'=>$orderId,'userId'=>$row['userId'],'amount'=>$row['amount'],'paymentDate'=>date("Y-m-d H:i:s"),'paymentType'=>$row['paymentType'],'transactionStatus'=>$row['paymentStatus'],'status'=>$row['status']);
                $orderTrans->setData($rowTrans);
                $orderTrans->save();
            }
             
            // Lưu bảng order_shipping
            if($row['note'] !=0){
                $ettService= _db()->getEntity('service.service');
                $ettService->loadWhere(array('id',$row['note']));
                $shipping=_db()->getEntity('service.ordershipping');
                $price= intval($row['amount'])/intval($row['quantity']);
                $rowship=array('orderId'=>$orderId ,'name'=>$row['name'],'phone'=>$row['phone'],'address'=>$row['address'],'serviceId'=>$row['note'],'serviceType'=>$ettService->getServiceType(),'quantity'=>$row['quantity'],'price'=>$price,'amount'=>$row['amount'],'status'=>1);
                $shipping->setData($rowship);
                $shipping->save();
            }else{
                // Lưu vào bảng order_item
                
                $price= intval($row['amount'])/intval($row['quantity']);
                $orderitem=_db()->getEntity('service.orderitem');
                $row_item=array('orderId'=>$orderId,'serviceId'=>$row['serviceId'],'price'=>$price,'quantity'=>$row['quantity'],'amount'=>$row['amount'],'status'=>1);
                $orderitem->setData($row_item);
                $orderitem->save();
            } 
            //Khách hàng mua và kích hoạt dịch vụ luôn
            if(pzk_request()->getActiveUser()==1 && pzk_request()->getStatus()==1){
                $serviceId=pzk_request()->getServiceId();
                //Cập nhật bảng history_service
                $paymentType= $row['paymentType'];
                               
                $model = pzk_model('Transaction');
                $model->buyService($userId,$serviceId,$paymentType,$orderId);
            }                     
            pzk_notifier()->addMessage('Cập nhật thành công');
            $this->redirect('index');
        
        } else {
            pzk_validator()->setEditingData($row);
            $this->redirect('add');
        }
    }
    public function editPostAction() {
        $row = $this->getEditData();
        if(1) {
            $row['modifiedId']=pzk_session()->getUserId();
            $row['modified']=date("Y-m-d H:i:s");
            $row['software']=3;
            $user= _db()->getEntity('User.Account.User');
            $username = trim(pzk_request()->getUsername());            
            //Khách hàng mua dịch vụ bằng tài khoản ngân hàng
            if($username){
                $user->loadWhere(array('username',$username));
                $userId=$user->getId();
                $row['userId']=$userId;
            }
             
            $this->edit($row);
            $orderId=pzk_request()->getId();
            // Update bang order_transaction
            $orderTrans=_db()->getEntity('payment.transaction');
            $orderTrans->loadWhere(array('orderId',$orderId));
            if($orderTrans->getId()){
                $orderTrans->update(array('orderId'=>$orderId,'userId'=>$row['userId'],'amount'=>$row['amount'],'paymentDate'=>date("Y-m-d H:i:s"),'paymentType'=>$row['paymentType'],'transactionStatus'=>$row['paymentStatus'],'status'=>$row['status']));
            } 
            // Lưu bảng order_shipping
            $shipping=_db()->getEntity('service.ordershipping');
            $shipping->loadWhere(array('orderId',$orderId));
            if($shipping->getId()){
                $shipping->delete();
            }
            $orderitem=_db()->getEntity('service.orderitem');
            $orderitem->loadWhere(array('orderId',$orderId));
            if($orderitem->getId()){
                $orderitem->delete();
            }
            if($row['note'] !=0){
                $ettService= _db()->getEntity('service.service');
                $ettService->loadWhere(array('id',$row['note']));
                $price= intval($row['amount'])/intval($row['quantity']);
                $rowship=array('orderId'=>$orderId ,'name'=>$row['name'],'phone'=>$row['phone'],'address'=>$row['address'],'serviceId'=>$row['note'],'serviceType'=>$ettService->getServiceType(),'quantity'=>$row['quantity'], 'price'=>$price,'amount'=>$row['amount'],'status'=>1);
                $shipping->setData($rowship);
                $shipping->save();
            }else{
                // Lưu vào bảng order_item
                
                $price= intval($row['amount'])/intval($row['quantity']);
                $row_item=array('orderId'=>$orderId,'serviceId'=>$row['serviceId'],'price'=>$price,'quantity'=>$row['quantity'],'amount'=>$row['amount'],'status'=>1);
                $orderitem->setData($row_item);
                $orderitem->save();
            }
            //Khách hàng mua và kích hoạt dịch vụ luôn
            if(pzk_request()->getActiveUser()==1 && pzk_request()->getStatus()==1){
                $serviceId=pzk_request()->getServiceId();
                //Cập nhật bảng history_service
                $paymentType= $row['paymentType'];
                $model = pzk_model('Transaction');
                $model->buyService($userId,$serviceId,$paymentType,$orderId);
            }                        
            pzk_notifier()->addMessage('Cập nhật thành công');
            $this->redirect('index');
        
        } else {
            pzk_validator()->setEditingData($row);
            $this->redirect('edit/' . pzk_request()->getId());
        }
    }
}