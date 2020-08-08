<?php
class PzkAdminFriendController extends PzkGridAdminController {
	public $addFields = 'username, userfriend, date';
	public $editFields ='username, userfriend, date';
	public $table='friend';
	/*public $joins = array(
        array(
            'table' => 'user',
            'condition' => 'friend.username = user.username',
            'type' =>''
        )
    );*/
	public $sortFields = array(
		'id asc' => 'ID tăng',
		'id desc' => 'ID giảm',
		'username asc' => 'Tên đăng nhập tăng',
		'username desc' => 'Tên đăng nhập giảm'
	);
	public $searchFields = array('username');
	public $listFieldSettings = array(
		array(
			'index' => 'username',
			'type' => 'text',
			'label' => 'Tên đăng nhập'
		),
		array(
			'index' => 'userfriend',
			'type' => 'text',
			'label' => 'Tên đăng nhập bạn bè '
		),
		array(
			'index' => 'date',
			'type' => 'text',
			'label' => 'Ngày kết bạn '
		)
	);
	public $logable = true;
	public $logFields = 'username, userfriend, date';
	public $addLabel = 'Thêm bạn mới';
	public $addFieldSettings = array(
		array(
			'index' => 'username',
			'type' => 'text',
			'label' => 'Tên đăng nhập'
		),
		array(
			'index' => 'userfriend',
			'type' => 'text',
			'label' => 'Tên đăng nhập bạn bè'
			
		)
	);
	public $editFieldSettings = array(
		array(
			'index' => 'username',
			'type' => 'text',
			'label' => 'Tên đăng nhập'
		),
		array(
			'index' => 'userfriend',
			'type' => 'text',
			'label' => 'Tên đăng nhập bạn bè'
			
		)
	);
	public $addValidator = array(
		'rules' => array(
			'username' => array(
				'required' => true
			),
			'userfriend' => array(
				'required' => true,
				'minlength' => 5,
				'maxlength' => 50
			)

		),
		'messages' => array(
			'username' => array(
				'required' => 'Tên người dùng không được để trống'
				
			),
			'userfriend' => array(
				'required' => 'Tên bạn bè không được để trống',
				'minlength' => 'Tên bạn bè phải dài 5 ký tự trở lên',
				'maxlength' => 'Tên bạn bè chỉ dài tối đa 50 ký tự'
			)
		)
	);
	public $editValidator = array(
		'rules' => array(
			'username' => array(
				'required' => true
			),
			'userfriend' => array(
				'required' => true,
				'minlength' => 5,
				'maxlength' => 50
			)

		),
		'messages' => array(
			'username' => array(
				'required' => 'Tên người dùng không được để trống'
				
			),
			'userfriend' => array(
				'required' => 'Tên bạn bè không được để trống',
				'minlength' => 'Tên bạn bè phải dài 5 ký tự trở lên',
				'maxlength' => 'Tên bạn bè chỉ dài tối đa 50 ký tự'
			)
		)
	);
 	public function addPostAction() {
        $row = $this->getAddData();
        if($this->validateAddData($row)) {
            $username = trim(pzk_request()->getUsername());
            $userfriend = trim(pzk_request()->getUserfriend());
            $user=_db()->getEntity('User.Account.User');
            $user1 =$user->loadWhere(array('username',$username));
            $user2=$user->loadWhere(array('username',$userfriend));
            if($user1->getId() && $user2->getId()) {
            	
            		$row['username'] = $username;
                	$row['userfriend']=$userfriend;
                	$row['date']=date("Y-m-d H:i:s");
                	$this->add($row);
                	$row['username'] = $userfriend;
                	$row['userfriend']=$username;
                	$row['date']=date("Y-m-d H:i:s");
                	$this->add($row);
                	pzk_notifier()->addMessage('Cập nhật thành công');
             		$this->redirect('index');
            } else {
            	pzk_notifier()->addMessage('Tên của user chưa đăng ký tài khoản');
                pzk_validator()->setEdittingData($row);
                $this->redirect('add');
            }
        } else {
            pzk_validator()->setEdittingData($row);
            $this->redirect('add');
        }
    }
    public function editPostAction() {
        $row = $this->getEditData();
       
        if($this->validateEditData($row)) {
        	$username = trim(pzk_request()->getUsername());
            $userfriend = trim(pzk_request()->getUserfriend());
            $row['username']=$username;
            $row['userfriend']=$userfriend;
            $row['date']=date("Y-m-d H:i:s");
            $user=_db()->getEntity('User.Account.User');
            $user1 =$user->loadWhere(array('username',$username));
            $user2=$user->loadWhere(array('username',$userfriend));
            if($user1->getId() && $user2->getId()) {
                $this->edit($row);
            	pzk_notifier()->addMessage('Cập nhật thành công');
            	$this->redirect('index');          
        	}
        	else{
        		pzk_notifier()->addMessage('User chưa đăng ký tài khoản');
            	$this->redirect('edit/' . pzk_request()->getId());     
        	}
        } else {
            pzk_validator()->setEdittingData($row);
            $this->redirect('edit/' . pzk_request()->getId());
        }
    }
}