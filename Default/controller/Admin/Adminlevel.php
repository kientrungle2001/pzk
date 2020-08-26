<?php
//[Add level]
class PzkAdminAdminlevelController extends PzkGridAdminController
{
	public const TABLE_NAME = 'admin_level';

	public $title = 'Quyền truy cập';
	public $addFields = 'level, status';
	public $editFields = 'level, status';
	public $table = self::TABLE_NAME;
	public $childTable = array(
		array(
			'table' => 'admin_level_action',
			'findField' => 'admin_level_id'
		)
	);
	public function getSortFields()
	{
		return PzkSortConstant::gets('id, level', self::TABLE_NAME);
	}
	public $searchFields = array('level');
	public function getListFieldSettings()
	{
		return PzkListConstant::gets('level, status', self::TABLE_NAME);
	}

	public $logable = true;
	public $logFields = 'level, status';
	public $addLabel = 'Thêm nhóm người dùng';
	public $mdAddOffset = '4';
	public $mdAddSize = '4';

	public function getAddFieldSettings()
	{
		return PzkEditConstant::gets('level, status', self::TABLE_NAME);
	}
	public function getAddValidator()
	{
		return PzkValidatorConstant::gets(
			array(
				'level' => array(
					'required' => true, 'minlength' => 2, 'maxlength' => 500
				)
			)
		);
	}
}
