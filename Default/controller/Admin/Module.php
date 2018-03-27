<?php
class PzkAdminModuleController extends PzkGridAdminController {
	public $table = 'module';
	public function alterAddFieldSettings(&$fieldSettings) {
		$this->alterEditFieldSettings($fieldSettings);
	}
	public function alterEditFieldSettings(&$fieldSettings) {
		$this->alterField($fieldSettings, array(
			'content' => array(
				'type'	=> 'textarea'
			)
		));
	}
	
	public function alterListFieldSettings(&$fieldSettings) {
		$fieldSettings[] = array(
			'type'	=> 'link',
			'index'	=> 'configuration',
			'label'	=> 'Cấu hình',
			'link'	=> '/Admin_Module/config/'
		);
	}
	
	public function configAction($id) {
		$module = pzk_obj('Core.Module.Detail');
		$module->set('itemId', $id);
		$this->initPage();
		$this->append($module);
		$this->display();
	}
}