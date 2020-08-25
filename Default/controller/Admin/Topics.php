<?php
class PzkAdminTopicsController extends PzkGridAdminController {
	
	public $titleController = 'Topics';
	public $table = 'topics';
	public function getJoins() {
		return PzkJoinConstant::gets('creator, modifier', 'topics');
	}
	public $selectFields = 'topics.*, creator.name as creatorName, modifier.name as modifiedName';
	public $detailFields = 'topics.*, creator.name as creatorName, modifier.name as modifiedName';
	public function getListFieldSettings() { 
		return PzkListConstant::gets('name, creatorName, created, modifiedName, modified, status', 'topics');
	}
	public $orderBy = 'topics.id desc';
	
	public $searchFields = array('name');
	public $searchLabel = 'Chủ đề';
	
	public function getSortFields() {
		return PzkSortConstant::gets('id, name', 'topics');
	}
	public $addFields = 'name, status';
	public $addLabel = 'Thêm chủ đề';
	
	public function getAddFieldSettings() {
		return PzkEditConstant::gets('name, status', 'topics');
	}
	public function getAddValidator() {
		return array(
			'name' => array(
				'required' => true,
				'minlength' => 2,
				'maxlength' => 1000
			)
		);
	}
	
	public $editLabel = 'Sửa chủ đề';
	public $editFields = 'name, status';
	
	public function getEditFieldSettings() {
		return PzkEditConstant::gets('name, status', 'topics');
	}
	
	public function getEditValidator() {
		return array(
			'name' => array(
				'required' => true,
				'minlength' => 2,
				'maxlength' => 1000
			)
		);
	}
	
	public function getParentDetailSettings() { 
		return array(
			PzkParentConstant::get('creator', 'featured'),
			PzkParentConstant::get('modifier', 'featured'),
		);
	}
}