<?php
class PzkAdminWebbuilderSoftwareresourceController extends PzkGridAdminController {
	public $table = 'webbuilder_software_resource';
	
	public function alterListFieldSettings(&$listFieldSettings) {
		$this->alterField($listFieldSettings, array(
			'wbSoftwareId'	=> array(
				'label'	=>	'Phần mềm',
				'type'	=>	'nameid',
				'table'	=> 'webbuilder_software',
				'findField'	=> 'id',
				'showField'	=> 'name'
			),
			
			'wbSoftwareResourceTypeId'	=> array(
				'label'	=>	'Tên Loại tài nguyên',
				'type'	=>	'nameid',
				'table'	=> 'webbuilder_software_resource_type',
				'findField'	=> 'id',
				'showField'	=> 'title'
			),
			'title'			=> array(
				'label'	=>	'Tiêu đề'
			),
			'wbSoftwareResourceType'	=> array(
				'label'	=>	'Loại tài nguyên'
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
			),
			'wbSoftwareResourceTypeId'	=> array(
				'label'			=>	'Loại tài nguyên',
				'type'			=>	'select',
				'table'			=>	'webbuilder_software_resource_type',
				'show_name'		=>	'title',
				'show_value'	=>	'id'
			),
			'wbSoftwareResourceType'	=> array(
				'label'			=>	'Tên Loại tài nguyên',
				'type'			=>	'select',
				'table'			=>	'webbuilder_software_resource_type',
				'show_name'		=>	'title',
				'show_value'	=>	'name'
			),
		));
	}
}