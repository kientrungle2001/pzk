<?php
class PzkAdminWalletsController extends PzkGridAdminController {
	public $addFields = ' username, amount, status';
	public $editFields = ' username, amount, status';
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
	public $addFieldSettings = array(
		
		array(
			'index' => 'username',
			'type' => 'text',
			'label' => 'Tên đăng nhập'
		),
		array(
			'index' => 'amount',
			'type' => 'text',
			'label' => 'Tổng tiền '
		),
		array(
			'index' => 'status',
			'type' => 'status',
			'label' => 'Trạng thái',
			
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
	public $editFieldSettings = array(
		
		array(
			'index' => 'username',
			'type' => 'text',
			'label' => 'Tên đăng nhập'
		),
		array(
			'index' => 'amount',
			'type' => 'text',
			'label' => 'Tổng tiền '
		),
		array(
			'index' => 'status',
			'type' => 'status',
			'label' => 'Trạng thái',
			
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
        	$username = $row['username'];            
            $user =_db()->getEntity('User.Account.User');
            if($username){
            	$user->loadWhere(array('username',$username));
            	if($user->get('id')){
            		$wallets =_db()->getEntity('User.Account.Wallets');
            		$wallets->loadWhere(array('username',$username));
            		if($wallets->get('id')){
            			
		            	$this->redirect('add');
		            	pzk_notifier()->addMessage('Username này đã có ví, bạn chỉ có thể sửa');
            		}else{
            			$row['userId'] = $user->get('id');
	            		$row['creatorId']=pzk_session('adminId');
	            		$row['created']=date("Y-m-d H:i:s");
	            		$this->add($row);                    
	            		pzk_notifier()->addMessage('Cập nhật thành công');
	            		$this->redirect('index');
            		}
            		
            	}
            	else {
		            pzk_validator()->setEditingData($row);
		            $this->redirect('add');
		            pzk_notifier()->addMessage('Username chưa tồn tại trên hệ thống');
            	}
         	} else {
	            pzk_validator()->setEditingData($row);
	            $this->redirect('add');
	            
        	}
        }
    }
    public function editPostAction() {
    	$id= pzk_request('id');
        $row = $this->getEditData();
        if($this->validateEditData($row)) {
        	$username = $row['username'];            
            $user =_db()->getEntity('User.Account.User');
            if($username){
            	$user->loadWhere(array('username',$username));
            	$row['userId'] = $user->get('id');
            }
        	$date=date("Y-m-d H:i:s");
            $row['modifiedId']=pzk_session('adminId');
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