<?php
class PzkAdminUserWriteWallController extends PzkGridAdminController {
	public $addFields = 'username, userwritewall, content, datewrite';
	public $editFields ='username, userwritewall, content, datewrite';
	public $table='user_write_wall';
	
    public $selectFields = 'user_write_wall.*';
	public $sortFields = array(
		'id asc' => 'ID tăng',
		'id desc' => 'ID giảm'
	);
	public $searchFields = array('username', 'userwritewall', 'content', 'datewrite');
	public $listFieldSettings = array(
		
		array(
			'index' => 'username',
			'type' => 'text',
			'label' => 'UserName '
		),
		array(
			'index' => 'userwritewall',
			'type' => 'text',
			'label' => 'User Viết'
		),
		array(
			'index' => 'content',
			'type' => 'text',
			'label' => 'Nội dung'
		),
		array(
			'index' => 'datewrite',
			'type' => 'text',
			'label' => 'Ngày'
		)
	);
	public $addLabel = 'Thêm mới';
	public $addFieldSettings = array(
		
		array(
			'index' => 'username',
			'type' => 'text',
			'label' => 'UserName '
		),
		array(
			'index' => 'userwritewall',
			'type' => 'text',
			'label' => 'User Viết'
		),
		array(
			'index' => 'content',
			'type' => 'text',
			'label' => 'Nội dung'
		),
		array(
			'index' => 'datewrite',
			'type' => 'text',
			'label' => 'Ngày'
		)
	);
	public $editFieldSettings = array(
		
		array(
			'index' => 'username',
			'type' => 'text',
			'label' => 'UserName '
		),
		array(
			'index' => 'userwritewall',
			'type' => 'text',
			'label' => 'User Viết'
		),
		array(
			'index' => 'content',
			'type' => 'text',
			'label' => 'Nội dung'
		),
		array(
			'index' => 'datewrite',
			'type' => 'text',
			'label' => 'Ngày'
		)
	);
	public $addValidator = array(
		'rules' => array(
			'username' => array(
				'required' => true
			),
			'userwritewall' => array(
				'required' => true
				
			),
			'content' => array(
				'required' => true
				
			),
			'datewrite' => array(
				'required' => true
				
			)

		),
		'messages' => array(
			'username' => array(
				'required' => 'UserName không được để trống'
				
			),
			'userwritewall' => array(
				'required' => 'User viết lên tường không được để trống'
				
			),
			'content' => array(
				'required' => 'Nội dung không được để trống'
				
			),
			'datewrite' => array(
				'required' => 'Ngày không được để trống'
				
			)
		)
	);
	public $editValidator = array(
		'rules' => array(
			'username' => array(
				'required' => true
			),
			'userwritewall' => array(
				'required' => true
				
			),
			'content' => array(
				'required' => true
				
			),
			'datewrite' => array(
				'required' => true
				
			)

		),
		'messages' => array(
			'username' => array(
				'required' => 'UserName không được để trống'
				
			),
			'userwritewall' => array(
				'required' => 'User viết lên tường không được để trống'
				
			),
			'content' => array(
				'required' => 'Nội dung không được để trống'
				
			),
			'datewrite' => array(
				'required' => 'Ngày không được để trống'
				
			)
		)
	);
}