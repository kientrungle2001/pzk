<?php
class PzkAdminAqsquestionController extends PzkGridAdminController {
	public $title 	=	'Quản lí câu hỏi hỏi đáp nhanh';
	public $table 	= 	"aqs_question";
	
	public $childTables = array(
		array(
			'table'				=>	'aqs_answer', 
			'referenceField' 	=>	'questionId'
		)
	);
	
	public $listFieldSettings = array(
        array(
            'index' => 'question',
            'type' => 'text',
            'label' => 'Câu hỏi'
        ),
		array(
            'index' => 'username',
            'type' => 'text',
            'label' => 'Người đăng'
        ),
		array(
            'index' => 'software',
            'type' => 'text',
            'label' => 'Phần mềm'
        ),
        array(
            'index' => 'answer',
            'type' => 'text',
            'label' => 'Câu trả lời'
        )
    );
	//search fields co type la text
    public $searchFields = array('question', 'username', 'id');
    public $searchLabel = 'Tên';
	
	 //filter cho cac truong co type la select
    
    public $sortFields = array(
		'id asc' => 'ID tăng',
		'id desc' => 'ID giảm',
		'answer asc' => 'Câu trả lời tăng',
		'answer desc' => 'Câu trả lời giảm',	
	);
}