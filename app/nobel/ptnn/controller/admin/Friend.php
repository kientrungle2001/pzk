<?php
class PzkAdminFriendController extends PzkGridAdminController {
	public $addFields = 'userId, userfriend, date';
	public $editFields ='userId, userfriend, date';
	public $table='friend';
	
	public $sortFields = array(
		'id asc' => 'ID tăng',
		'id desc' => 'ID giảm',
		'userId asc' => 'userId tăng',
		'userId desc' => 'userId giảm'
	);
	public $searchFields = array('userId');
	public $listFieldSettings = array(
		array(
			'index' => 'userId',
			'type' => 'text',
			'label' => 'Mã user'
		),
		array(
			'index' => 'userfriend',
			'type' => 'text',
			'label' => 'userFriend '
		),
		array(
			'index' => 'date',
			'type' => 'text',
			'label' => 'Ngày kết bạn '
		)
	);
	public $addLabel = 'Thêm bạn mới';
	public $addFieldSettings = array(
		array(
			'index' => 'userId',
			'type' => 'text',
			'label' => 'mã người dùng'
		),
		array(
			'index' => 'userfriend',
			'type' => 'text',
			'label' => 'userfriend'
			
		),
		array(
			'index' => 'date',
			'type' => 'date',
			'label' => 'date'
			
		)
	);
	public $editFieldSettings = array(
		array(
			'index' => 'userId',
			'type' => 'text',
			'label' => 'Mã người dùng'
		),
		array(
			'index' => 'userfriend',
			'type' => 'text',
			'label' => 'userfriend'
			
		),
		array(
			'index' => 'date',
			'type' => 'date',
			'label' => 'date'
			
		)
	);
	
	
 	
    
}