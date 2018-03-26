<?php 
pzk_import('Core.Db.List');
class PzkCmsBannerRegion extends PzkCoreDbList
{
	public $layout 		= 'cms/banner/region';
	public $table 		= 'banner';
	public $position 	= '';
	public $fields 		= 'id';
	public $cacheable 	= true;
	public $cacheParams = 'layout, position';
	public function init() {
		parent::init();
		$this->addCondition('`position`=\'' . $this->get('position') . '\'');
		$this->addCondition('`status`=\'1\'');
	}
}
 ?>