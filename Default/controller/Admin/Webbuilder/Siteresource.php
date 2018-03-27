<?php
class PzkAdminWebbuilderSiteresourceController extends PzkGridAdminController {
	public $table = 'webbuilder_site_resource';
	
	public function alterListFieldSettings(&$listFieldSettings) {
		$this->alterField($listFieldSettings, array(
			'wbSiteId'	=> array(
				'label'	=>	'Website',
				'type'	=>	'nameid',
				'table'	=> 'webbuilder_site',
				'findField'	=> 'id',
				'showField'	=> 'name'
			),
			
			'wbSoftwareResourceId'	=> array(
				'label'	=>	'Tên tài nguyên',
				'type'	=>	'nameid',
				'table'	=> 'webbuilder_software_resource',
				'findField'	=> 'id',
				'showField'	=> 'title'
			),
			'title'			=> array(
				'label'	=>	'Tiêu đề'
			)
		));
	}
	
	public function alterAddFieldSettings(&$addFieldSettings) {
		$this->alterField($addFieldSettings, array(
			'wbSiteId'	=> array(
				'label'			=>	'Website',
				'type'			=>	'select',
				'table'			=>	'webbuilder_site',
				'show_name'		=>	'name',
				'show_value'	=>	'id'
			),
			'wbSoftwareResourceId'	=> array(
				'label'			=>	'Tên tài nguyên',
				'type'			=>	'select',
				'table'			=>	'webbuilder_software_resource',
				'show_name'		=>	'title',
				'show_value'	=>	'id'
			),
		));
	}
}