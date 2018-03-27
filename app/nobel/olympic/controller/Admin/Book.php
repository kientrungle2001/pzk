<?php
class PzkAdminBookController extends PzkGridAdminController {
	public $title = "Quản lí bài tập";
	public $table = 'user_book';
	public $listFieldSettings = array(
			
			array(
					'index' => 'name',
					'type' 	=> 'text',
					'label' => 'Danh mục',
					'link'	=> '/admin_book/details/'
			),
			
			array(
					'index' => 'quantity_question',
					'type' 	=> 'text',
					'label' => 'Số câu'
			),
			array(
					'index' => 'mark',
					'type' 	=> 'text',
					'label' => 'Số điểm'
			),
			
			array(
					'index' => 'duringTime',
					'type' 	=> 'text',
					'label' => 'Thời gian'
			),
			
	);
	
	
	
	
	
	function updateCreateTimeAction(){
		
		$condition1 = date(DATEFORMAT);
		$condition2 = date(DATEFORMAT);
		$condition2_int 	= $_SERVER['REQUEST_TIME'] - 12*60*60;
		$condition2_date 	= date(DATEFORMAT, $condition2_int);
 		debug($_SERVER['REQUEST_TIME']);
		debug($condition1);
		debug($condition2);
		debug($condition2_int);
		debug($condition2_date);
	}
	
}