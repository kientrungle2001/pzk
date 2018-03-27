<?php
class PzkAdminInvitationController extends PzkGridAdminController {
	public $addFields = 'username, userinvitation, invitation';
	public $editFields = 'username, userinvitation, invitation';
	public $table='invitation';
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
			'index' => 'userinvitation',
			'type' => 'text',
			'label' => 'Người nhận yêu cầu kết bạn '
		),
		array(
			'index' => 'invitation',
			'type' => 'text',
			'label' => 'Lời mời'
		)
	);
	public $logable = true;
	public $logFields = 'username, invitation';
	public $addLabel = 'Thêm yêu cầu kết bạn';
	public $addFieldSettings = array(
		array(
			'index' => 'username',
			'type' => 'text',
			'label' => 'Tên đăng nhập'
		),
		array(
			'index' => 'userinvitation',
			'type' => 'text',
			'label' => 'Người nhận yêu cầu kết bạn'
			
		),
		array(
			'index' => 'invitation',
			'type' => 'text',
			'label' => 'Lời mời'
			
		)
	);
	public $editFieldSettings = array(
		array(
			'index' => 'username',
			'type' => 'text',
			'label' => 'Tên đăng nhập'
		),
		array(
			'index' => 'userinvitation',
			'type' => 'text',
			'label' => 'Người nhận yêu cầu kết bạn'
			
		),
		array(
			'index' => 'invitation',
			'type' => 'text',
			'label' => 'Lời mời'
			
		)
	);
	public $addValidator = array(
		'rules' => array(
			'username' => array(
				'required' => true
			),
			'userinvitation' => array(
				'required' => true,
				'minlength' => 5,
				'maxlength' => 50
			)

		),
		'messages' => array(
			'username' => array(
				'required' => 'Tên người dùng không được để trống'
				
			),
			'userinvitation' => array(
				'required' => 'Tên người dùng không được để trống',
				'minlength' => 'Tên người dùng phải dài 5 ký tự trở lên',
				'maxlength' => 'Tên người dùng chỉ dài tối đa 50 ký tự'
			)
		)
	);
	public $editValidator = array(
	'rules' => array(
			'username' => array(
				'required' => true
			),
			'userinvitation' => array(
				'required' => true,
				'minlength' => 5,
				'maxlength' => 50
			)

		),
		'messages' => array(
			'userinvitation' => array(
				'required' => 'Tên người dùng không được để trống'
				
			),
			'username' => array(
				'required' => 'Tên người dùng không được để trống',
				'minlength' => 'Tên người dùng phải dài 5 ký tự trở lên',
				'maxlength' => 'Tên người dùng chỉ dài tối đa 50 ký tự'
			)
		)
	);


}