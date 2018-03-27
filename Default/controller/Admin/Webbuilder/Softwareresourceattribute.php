<?php
class PzkAdminWebbuilderSoftwareresourceattributeController extends PzkGridAdminController {
	public $table = 'webbuilder_software_resource_attribute';
	
	public function alterListFieldSettings(&$listFieldSettings) {
		$this->alterField($listFieldSettings, array(
			'wbSoftwareId'	=> array(
				'label'	=>	'Phần mềm',
				'type'	=>	'nameid',
				'table'	=> 'webbuilder_software',
				'findField'	=> 'id',
				'showField'	=> 'name'
			),
			'wbSoftwareResourceId'	=> array(
				'label'	=>	'Tài nguyên',
				'type'	=>	'nameid',
				'table'	=> 'webbuilder_software_resource',
				'findField'	=> 'id',
				'showField'	=> 'name'
			),
			
			'wbSoftwareResourceAttributeTypeId'	=> array(
				'label'	=>	'Tên Loại thuộc tính',
				'type'	=>	'nameid',
				'table'	=> 'webbuilder_software_resource_attribute_type',
				'findField'	=> 'id',
				'showField'	=> 'title'
			),
			'title'			=> array(
				'label'	=>	'Tiêu đề'
			),
			'wbSoftwareResourceAttributeType'	=> array(
				'label'	=>	'Loại thuộc tính'
			)
		));
		$listFieldSettings[] = array(
			'label'	=> 'Sao chép',
			'link'	=> '/Admin_Webbuilder_Softwareresourceattribute/duplicate/',
			'type'	=> 'link',
			'index'	=> 'duplicate'
		);
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
			'wbSoftwareResourceId'	=> array(
				'label'			=>	'Tài Nguyên',
				'type'			=>	'select',
				'table'			=>	'webbuilder_software_resource',
				'show_name'		=>	'name',
				'show_value'	=>	'id'
			),
			'wbSoftwareResourceAttributeTypeId'	=> array(
				'label'			=>	'Loại thuộc tính',
				'type'			=>	'select',
				'table'			=>	'webbuilder_software_resource_attribute_type',
				'show_name'		=>	'title',
				'show_value'	=>	'id'
			),
			'wbSoftwareResourceAttributeType'	=> array(
				'label'			=>	'Tên Loại thuộc tính',
				'type'			=>	'select',
				'table'			=>	'webbuilder_software_resource_attribute_type',
				'show_name'		=>	'title',
				'show_value'	=>	'name'
			),
		));
	}
}