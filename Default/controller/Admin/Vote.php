<?php
class PzkAdminVoteController extends PzkGridAdminController {
    public $titleController ='Đánh giá của người dùng';
    public $table = 'vote';
    
    //show fields on page index
    public $listFieldSettings = array(
        array(
            'index' => 'username',
            'type' => 'text',
            'label' => 'Tên'
        ),
		
		array(
			'index' => 'content',
			'type' => 'text',
			'label' => 'Nội dung'
		),
       
		array(
            'index' => 'created',
            'type' => 'datetime',
            'label' => 'Ngày',
        ),

        array(
            'index' => 'status',
            'type' => 'status',
            'label' => 'Trạng thái'
        )

    );
	
    //search fields co type la text
    public $searchFields = array('username');
    public $Searchlabels = 'Tên';
    //filter cho cac truong co type la select
    public $filterFields = array(

        array(
            'index'=>'status',
            'type' => 'status',
            'label' => 'Trạng thái'
        )

    );
    //sort by
    public $sortFields = array(
        'id asc' => 'ID tăng',
        'id desc' => 'ID giảm',

    );

   

}