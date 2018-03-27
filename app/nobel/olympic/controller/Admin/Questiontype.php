<?php
class PzkAdminQuestiontypeController extends PzkGridAdminController {
    public $masterStructure = 'admin/home/index';
    public $masterPosition = 'left';
    public $addFields = 'name, request, question_type, group_question, software';
    public $editFields = 'name, request, question_type, group_question, software';
	
	public $searchFields = array('name', 'question_type', 'request', 'group_question');
	public $searchLabel = 'Tìm kiếm';
	public $logable = true;
	public $logFields = 'name, request, question_type, group_question';	
	public $listFieldSettings = array(
		array(
			'index' => 'group_question',
			'type' => 'text',
			'label' => 'Dạng bài tập'
		),
		array(
			'index' => 'question_type',
			'type' => 'text',
			'label' => 'Code'
		),
		array(
			'index' => 'name',
			'type' => 'text',
			'label' => 'Tên dạng câu hỏi'
		),
		array(
			'index' => 'request',
			'type' => 'text',
			'label' => 'Yêu cầu'
		),
	);
	public $addFieldSettings = array(
		array(
			'index' => 'group_question',
			'type' => 'text',
			'label' => 'Dạng bài tập'
		),
		array(
			'index' => 'question_type',
			'type' => 'text',
			'label' => 'Code'
		),
		array(
			'index' => 'name',
			'type' => 'text',
			'label' => 'Tên dạng câu hỏi'
		),
		array(
			'index' => 'request',
			'type' => 'text',
			'label' => 'Yêu cầu'
		),
	
	);
	
	public $editFieldSettings = array(
		array(
			'index' => 'group_question',
			'type' => 'text',
			'label' => 'Dạng bài tập'
		),
		array(
			'index' => 'question_type',
			'type' => 'text',
			'label' => 'Code'
		),
		array(
			'index' => 'name',
			'type' => 'text',
			'label' => 'Tên dạng câu hỏi'
		),
		array(
			'index' => 'request',
			'type' => 'text',
			'label' => 'Yêu cầu'
		),
	
	);
	
    public $addValidator = array(
        'rules' => array(
        	'request' => array(
        		'required' => true,
        		'minlength' => 2,
        		'maxlength' => 500
        	),
            'name' => array(
                'required' => true,
                'minlength' => 2,
                'maxlength' => 500
            ),
        	'question_type' => array(
        		'required' => true,
        		'minlength' => 2,
        		'maxlength' => 125
        	)
        ),
        'messages' => array(
            'request' => array(
                'required' 	=> 'Yêu cầu dạng câu hỏi không được để trống',
                'minlength' => 'Yêu cầu dạng câu hỏi phải dài 2 ký tự trở lên',
                'maxlength' => 'Yêu cầu dạng câu hỏi chỉ dài tối đa 500 ký tự'
            ),
        	'name' => array(
        		'required' 	=> 'Tên dạng câu hỏi không được để trống',
        		'minlength' => 'Tên dạng câu hỏi phải dài 2 ký tự trở lên',
        		'maxlength' => 'Tên dạng câu hỏi chỉ dài tối đa 500 ký tự'
        	),
        	'question_type' => array(
        		'required' 	=> 'Tên dạng câu hỏi không được để trống',
        		'minlength' => 'Mã dạng câu hỏi phải dài 2 ký tự trở lên',
        		'maxlength' => 'Mã dạng câu hỏi chỉ dài tối đa 125 ký tự'
        	)
        )
    );
    
    public $editValidator = array(
        'rules' => array(
        	'request' => array(
        		'required' => true,
        		'minlength' => 2,
        		'maxlength' => 500
        	),
            'name' => array(
                'required' => true,
                'minlength' => 2,
                'maxlength' => 500
            ),
        	'question_type' => array(
        		'required' => true,
        		'minlength' => 2,
        		'maxlength' => 125
        	)
        ),
        'messages' => array(
            'request' => array(
                'required' 	=> 'Yêu cầu dạng câu hỏi không được để trống',
                'minlength' => 'Yêu cầu dạng câu hỏi phải dài 2 ký tự trở lên',
                'maxlength' => 'Yêu cầu dạng câu hỏi chỉ dài tối đa 500 ký tự'
            ),
        	'name' => array(
        		'required' 	=> 'Dạng câu hỏi không được để trống',
        		'minlength' => 'Dạng câu hỏi phải dài 2 ký tự trở lên',
        		'maxlength' => 'Dạng câu hỏi chỉ dài tối đa 500 ký tự'
        	),
        	'question_type' => array(
        		'required' 	=> 'Tên dạng câu hỏi không được để trống',
        		'minlength' => 'Mã dạng câu hỏi phải dài 2 ký tự trở lên',
        		'maxlength' => 'Mã dạng câu hỏi chỉ dài tối đa 125 ký tự'
        	)
        )
    );
	
}