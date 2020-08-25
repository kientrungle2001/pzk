<?php
class PzkAdminLevelStatusController extends PzkGridAdminController {
    public $table = 'level_status';
    public $joins = array(
        array(
            'table' => 'admin_level',
            'condition' => 'level_status.type_id = admin_level.id',
            'type' =>''
        )
    );
    //select table
    public $selectFields = 'level_status.*, admin_level.level';
    public $listFieldSettings = array(
        array(
            'index' => 'level',
            'type' => 'text',
            'label' => 'Tên quyền'
        ),
        array(
            'index' => 'start_status',
            'type' => 'text',
            'label' => 'Tên trạng đầu'
        ),

        array(
            'index' => 'end_status',
            'type' => 'text',
            'label' => 'Tên trạng cuối'
        ),
        array(
            'index' => 'status',
            'type' => 'status',
            'label' => 'status'
        )

    );

    public $searchFields = array('value');
    public $searchLabel = 'Trạng thái';
    //filter cho cac truong co type la select
    public $filterFields = array(

        array(
            'index' => 'type_id',
            'type' => 'select',
            'label' => 'Tên quyền',
            'table' => 'admin_level',
            'show_value' => 'id',
            'show_name' => 'level',
        ),
        array(
            'index'=>'status',
            'type' => 'status',
            'label' => 'status'
        )

    );
    //sort by
    public $sortFields = array(
        'id asc' => 'ID tăng',
        'id desc' => 'ID giảm',

    );

    //add theo dang binh thuong
    public $addLabel = 'Thêm trạng thái';
    public $addFields = 'type_id, start_status, end_status, status';
    public $addFieldSettings = array(
        array(
            'index' => 'type_id',
            'type' => 'select',
            'label' => 'tên quyền',
            'table' => 'admin_level',
            'show_value' => 'id',
            'show_name' => 'level',
        ),
        array(
            'index' => 'start_status',
            'type' => 'selectoption',
            'option' => array(
                'new'=> 'New',
                'accepted'=>'Accepted',
                'processing'=>'Processing',
                'deleted'=>'Deleted'
            ),
            'label' => 'Trạng thái đầu'
        ),

        array(
            'index' => 'end_status',
            'type' => 'selectoption',
            'option' => array(
                'new'=> 'New',
                'accepted'=>'Accepted',
                'processing'=>'Processing',
                'deleted'=>'Deleted'
            ),
            'label' => 'Trạng thái cuối'
        ),

        array(
            'index' => 'status',
            'type' => 'status',
            'label' => 'Trạng thái',
            'options' => array(
                '0' => 'Không hoạt động',
                '1' => 'Hoạt động'
            ),
            'actions' => array(
                '0' => 'mở',
                '1' => 'dừng'
            )
        )
    );
    //edit
    public $editFields = 'type_id, start_status, end_status, status';
    public $editFieldSettings = array(
        array(
            'index' => 'type_id',
            'type' => 'select',
            'label' => 'tên quyền',
            'table' => 'admin_level',
            'show_value' => 'id',
            'show_name' => 'level',
        ),
        array(
            'index' => 'start_status',
            'type' => 'selectoption',
            'option' => array(
                'new'=> 'New',
                'accepted'=>'Accepted',
                'processing'=>'Processing',
                'deleted'=>'Deleted'
            ),
            'label' => 'Trạng thái đầu'
        ),

        array(
            'index' => 'end_status',
            'type' => 'selectoption',
            'option' => array(
                'new'=> 'New',
                'accepted'=>'Accepted',
                'processing'=>'Processing',
                'deleted'=>'Deleted'
            ),
            'label' => 'Trạng thái cuối'
        ),

        array(
            'index' => 'status',
            'type' => 'status',
            'label' => 'Trạng thái',
            'options' => array(
                '0' => 'Không hoạt động',
                '1' => 'Hoạt động'
            ),
            'actions' => array(
                '0' => 'mở',
                '1' => 'dừng'
            )
        )
    );


}
?>