<?php
class PzkAdminPrivilegeController extends PzkBackendController {
	public function indexAction() {
		$this->initPage()
		->append('admin/privilege/index')
		->display();
	}
	
	public function editAction()	{
		$action		=	pzk_request()->getAdmin_action();
		$controller	=	pzk_request()->getAdmin_controller();
		$role		=	pzk_request()->getRole();
		$row 	= _db()->selectAll()->from('admin_level_action')
			->whereAdmin_action($controller)
			->whereAction_type($action)
			->whereAdmin_level($role)
			->result_one();
		if($row) {
			if($row['status']	== 	0) {
				_db()->update('admin_level_action')
					->set(array( 'status'	=>	1))
					->whereId($row['id'])->result();
				echo '1';
			} else {
				_db()->update('admin_level_action')
					->set(array( 'status'	=>	0))
					->whereId($row['id'])->result();
				echo '0';
			}
			
		} else {
			$entity = _db()->getTableEntity('admin_level_action');
			$entity->setData(array(
				'admin_action'	=>	$controller,
				'action_type'	=>	$action,
				'admin_level'	=>	$role,
				'status'		=>	1,
				'software'		=>	pzk_request()->getSoftwareId()
			));
			$entity->save();
			echo '1';
		}
	}
}