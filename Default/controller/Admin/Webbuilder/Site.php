<?php
class PzkAdminWebbuilderSiteController extends PzkGridAdminController {
	public $table = 'webbuilder_site';
	public function alterListFieldSettings(&$listFieldSettings) {
		$this->alterField($listFieldSettings, array(
			'wbSoftwareId'	=> array(
				'label'	=>	'Phần mềm',
				'type'	=>	'nameid',
				'table'	=> 'webbuilder_software',
				'findField'	=> 'id',
				'showField'	=> 'name'
			),
			'title'			=> array(
				'label'	=>	'Tiêu đề'
			)
		));
	}
	
	public function alterAddFieldSettings(&$addFieldSettings) {
		$this->alterField($addFieldSettings, array(
			'wbSoftwareId'	=> array(
				'label'			=>	'Phần mềm',
				'type'			=>	'select',
				'table'			=>	'webbuilder_software',
				'show_name'		=>	'name',
				'show_value'	=>	'id'
			)
		));
	}
}