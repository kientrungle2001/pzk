<?php
class PzkAdminQuestiontypeController extends PzkGridAdminController {
    public $masterStructure = 'admin/home/index';
    public $masterPosition = JOIN_TYPE_LEFT;
    
	public function getListFieldSettings() {
		return array(
			PzkListConstant::get('name', 'questiontype'),
			PzkListConstant::get('group_question', 'questiontype'),
			PzkListConstant::get('question_type', 'questiontype'),
			PzkListConstant::get('request', 'questiontype'),
		);
	}
	
	public $searchFields = array('name', 'question_type', 'request', 'group_question');
	public $searchLabel = 'Tìm kiếm';
	
	public $logable = true;
	public $logFields = 'name, request, question_type, group_question';	
	
	
	public $addFields = 'name, request, question_type, group_question';
    public $editFields = 'name, request, question_type, group_question';
	
	public function getAddFieldSettings() { 
		return array(
			PzkEditConstant::get('name', 'questiontype'),
			PzkEditConstant::get('group_question', 'questiontype'),
			PzkEditConstant::get('question_type', 'questiontype'),
			PzkEditConstant::get('request', 'questiontype'),
		
		);
	}
	
	public function getEditFieldSettings() { 
		return array(
			PzkEditConstant::get('name', 'questiontype'),
			PzkEditConstant::get('group_question', 'questiontype'),
			PzkEditConstant::get('question_type', 'questiontype'),
			PzkEditConstant::get('request', 'questiontype'),
		
		);
	}
	public function getAddValidator() {
		return PzkValidatorConstant::gets(
			array(
				'name' => array(
					'required' => true,
					'minlength' => 2,
					'maxlength' => 500
				),
				'request' => array(
					'required' => true,
					'minlength' => 2,
					'maxlength' => 500
				),
				'question_type' => array(
					'required' => true,
					'minlength' => 2,
					'maxlength' => 125
				)
				
			)
		);
	}
    
    public function getEditValidator() {
		return PzkValidatorConstant::gets(
			array(
				'name' => array(
					'required' => true,
					'minlength' => 2,
					'maxlength' => 500
				),
				'request' => array(
					'required' => true,
					'minlength' => 2,
					'maxlength' => 500
				),
				'question_type' => array(
					'required' => true,
					'minlength' => 2,
					'maxlength' => 125
				)
				
			)
		);
	}
	
}