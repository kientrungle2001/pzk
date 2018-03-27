<?php
class PzkAdminAqsanswerController extends PzkGridAdminController {
	public $title 	=	'Quản lí câu trả lời hỏi đáp nhanh';
	public $table 	= 	"aqs_answer";
	
	public function getJoins() {
		return PzkJoinConstant::gets ( 'aqs_question', 'aqs_answer' );
	}
	public $selectFields = 'aqs_answer.*, aqs_question.question as aqsQuestion';
	public $listFieldSettings = array(
        array(
            'index' => 'aqsQuestion',
            'type' => 'text',
            'label' => 'Câu hỏi'
        ),
		array(
            'index' => 'answer',
            'type' => 'text',
            'label' => 'Câu trả lời'
        ),
		array(
            'index' => 'username',
            'type' => 'text',
            'label' => 'Người đăng'
        )
    );
	//search fields co type la text
    public $searchFields = array('answer', 'username', 'id');
    public $searchlabels = 'Tên';
	
	 //filter cho cac truong co type la select
    
    public $sortFields = array(
		'id asc' => 'ID tăng',
		'id desc' => 'ID giảm',	
	);
}