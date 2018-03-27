<?php
class PzkAdminWebbuilderSiteresourceattributeController extends PzkGridAdminController {
	public $table = 'webbuilder_site_resource_attribute';
	public function alterListFieldSettings(&$listFieldSettings) {
		$this->alterField($listFieldSettings, array(
			'wbSiteId'	=> array(
				'label'	=>	'Website',
				'type'	=>	'nameid',
				'table'	=> 'webbuilder_site',
				'findField'	=> 'id',
				'showField'	=> 'name'
			),
			
			'wbSiteResourceId'	=> array(
				'label'	=>	'Tên tài nguyên',
				'type'	=>	'nameid',
				'table'	=> 'webbuilder_site_resource',
				'findField'	=> 'id',
				'showField'	=> 'name'
			),
			'wbSoftwareResourceAttributeId'	=> array(
				'label'	=>	'Tên thuộc tính',
				'type'	=>	'nameid',
				'table'	=> 'webbuilder_software_resource_attribute',
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
			'wbSiteId'	=> array(
				'label'			=>	'Website',
				'type'			=>	'select',
				'table'			=>	'webbuilder_site',
				'show_name'		=>	'name',
				'show_value'	=>	'id'
			),
			'wbSiteResourceId'	=> array(
				'label'			=>	'Tên tài nguyên',
				'type'			=>	'select',
				'table'			=>	'webbuilder_site_resource',
				'show_name'		=>	'title',
				'show_value'	=>	'id'
			),
			'wbSoftwareResourceAttributeId'	=> array(
				'label'			=>	'Tên thuộc tính',
				'type'			=>	'select',
				'table'			=>	'webbuilder_software_resource_attribute',
				'show_name'		=>	'name',
				'show_value'	=>	'id'
			)
		));
	}
}