<?php 
pzk_import('Core.Db.Detail');
class PzkCmsBannerBanner extends PzkCoreDbDetail
{
	public $layout 			= 'cms/banner/banner';
	public $table 			= 'banner';
	public $cacheable		= true;
	public $cacheParams		= 'layout,itemId';
	public static $settings = array(
					array(
						'index' 	=> 'id',
						'type'		=> 'text',
						'label'		=> 'ID'
					),
					array(
						'index' 	=> 'itemId',
						'type'		=> 'select',
						'label'		=> 'Banner',
						'table'		=> 'banner',
						'show_name'	=> 'name',
						'show_value'=> 'id'
					)
	);
}
 ?>