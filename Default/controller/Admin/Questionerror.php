<?php
class PzkAdminQuestionerrorController extends PzkGridAdminController {
    public $titleController ='Các câu hỏi lỗi';
    public $table = 'question_error';
    
    //show fields on page index
    public $listFieldSettings = array(
		 array(
            'index' => 'questionId',
            'type' => 'text',
            'label' => 'Id câu hỏi'
        ),
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
			'index' => 'email',
			'type' => 'text',
			'label' => 'Email'
		),
		
		array(
			'index' => 'phone',
			'type' => 'text',
			'label' => 'Số điện thoại'
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
        ),
		array(
            'index' => 'note',
            'type' => 'text',
            'label' => 'Ghi chú'
        )

    );
	
    //search fields co type la text
    public $searchFields = array('username');
    public $searchLabel = 'Tên';
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
	
	 public $editLabel = 'Sửa';
    public $editFields = 'content, note, createdId, modifiedId, software';

    public $editFieldSettings = array(
        array(
            'index' => 'note',
            'type' => 'tinymce',
            'label' => 'Ghi chú'
        ),
		array(
            'index' => 'content',
            'type' => 'tinymce',
            'label' => 'Nội dung'
        )
       
    );

    public $editValidator = array(
        'rules' => array(
            'note' => array(
                'required' => true,
                'minlength' => 2,
                
            )
        ),
        'messages' => array(
            'note' => array(
                'required' => 'Loại trò chơi không được để trống',
                'minlength' => 'Loại trò chơi phải dài 2 ký tự trở lên',
               
            )
        )

    );


   

}