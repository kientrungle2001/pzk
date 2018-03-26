<?php 
pzk_import('Core.Db.Detail');
class PzkCmsHtmlbox extends PzkCoreDbDetail
{
	public $layout = 'cms/htmlbox';
	public $table = 'htmlbox';
	public static $settings = array(
		array(
			'index' 	=> 'id',
			'type'		=> 'text',
			'label'		=> 'ID'
		),
		array(
			'index' 	=> 'itemId',
			'type'		=> 'select',
			'label'		=> 'Htmlbox',
			'table'		=> 'htmlbox',
			'show_name'	=> 'name',
			'show_value'=> 'id'
		)
	);
}
 ?>