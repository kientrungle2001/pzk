<?php
class PzkAdminSociallogController extends PzkGridAdminController {
    public $addFields = 'message, scheduleId,status,created ';
    public $editFields = 'message, scheduleId,status,created ';
    public $table = 'social_log';
    public $filterStatus = true;
	public $logable = true;
	public $logFields = 'message, scheduleId,status,created';
    public $sortFields = array(
        'id asc' => 'ID tăng',
        'id desc' => 'ID giảm',
        'scheduleId asc' => 'scheduleId tăng',
        'scheduleId desc' => 'scheduleId giảm',
    	'created asc' => 'Ngày tạo tăng',
    	'created desc' => 'Ngày tạo giảm',
    );
    public $searchFields = array('message','scheduleId');
    public $searchLabel = 'Tên ứng dụng';
    public $listFieldSettings = array(
        array(
            'index' => 'message',
            'type' => 'text',
            'label' => 'Thông báo'
        ),
		array(
            'index' => 'scheduleId',
            'type' => 'text',
            'label' => 'ID lịch đăng'
        ),
		
		array(
            'index' => 'created',
            'type' => 'datetime',
			'format' => 'H:i:s d/m/Y',
            'label' => 'Ngày tạo'
        ),
        array(
            'index' => 'status',
            'type' => 'status',
            'label' => 'Trạng thái'
        )
    );
	
    public $addLabel = 'Thêm Log';
    public $addFieldSettings = array(
        array(
            'index' => 'message',
            'type' => 'text',
            'label' => 'Thông báo'
        ),
        array(
            'index' => 'scheduleId',
            'type' => 'text',
            'label' => 'ID lịch đăng'
        ),
        
        array(
            'index' => 'created',
            'type' => 'date',
            'label' => 'Ngày tạo'
        ),
        array(
            'index' => 'status',
            'type' => 'status',
            'label' => 'Trạng thái'
        )
    );
    public $editFieldSettings = array(
        array(
            'index' => 'message',
            'type' => 'text',
            'label' => 'Thông báo'
        ),
        array(
            'index' => 'scheduleId',
            'type' => 'text',
            'label' => 'ID lịch đăng'
        ),
        
        array(
            'index' => 'created',
            'type' => 'date',
            'label' => 'Ngày tạo'
        ),
        array(
            'index' => 'status',
            'type' => 'status',
            'label' => 'Trạng thái'
        )
    );
    

}
?>