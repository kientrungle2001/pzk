<?php
require_once BASE_DIR . '/model/Entity.php';
class PzkEntityEduTeacherModel extends PzkEntityModel {
	public $table = 'teacher';
	
	public function getClasses() {
		return _db()->select('*')->from('classes')
			->where('teacherId=' . $this->get('id') . ' and status=1')
			->result('Edu.Class');
	}
	
	public function getLastName() {
		$names = explode(' ', $this->get('name'));
		return array_pop($names);
	}
	
}
