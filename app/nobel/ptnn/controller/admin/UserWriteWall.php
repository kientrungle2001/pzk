<?php
class PzkAdminUserWriteWallController extends PzkGridAdminController {
	public $title = 'Nội dung trên Tường';
	public $editFields ='userId, userWrite, content, datewrite';
	public $table='user_write_wall';
	public $joins = array(
        array(
            'table' => 'user',
            'condition' => 'user.id = user_write_wall.userWrite',
            'type' =>''
        ),
		array(
			'table' => '`admin` as `modifier`',
			'condition' => 'user_write_wall.modifiedId = modifier.id',
			'type' => 'left'
		),
    );
    public $selectFields = 'user_write_wall.*, user.username as username, modifier.name as modifiedName';
    
	public $sortFields = array(
		'id asc' => 'ID tăng',
		'id desc' => 'ID giảm'
	);
	public $searchFields = array('content', 'datewrite');
	public $listFieldSettings = array(
	
		array(
			'index' => 'username',
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
			'type' => 'datetime',
			'format' => 'd/m/Y H:i',
			'label' => 'Ngày tạo'
		),
		array(
			'index' => 'modifiedName',
			'type' => 'text',
			'label' => 'Người sửa'
		),
		array(
			'index' => 'modified',
			'type' => 'datetime',
			'label' => 'Ngày sửa',
			'format'	=> 'H:i d/m'
		),
	);
	
	public $editFieldSettings = array(
		
		array(
			'index' => 'userId',
			'type' => 'text',
			'label' => 'UserId '
		),
		array(
			'index' => 'userWrite',
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
			'type' => 'date',
			'label' => 'Ngày viết'
		)
	);
	
}