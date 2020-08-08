<?php
pzk_import('Core.Db.Detail');
class PzkCmsDetail extends PzkCoreDbDetail {
	public $layout = 'cms/detail';
	public function getPlugins() {
		return array();
		$rs = array();
		$plugins = _db()->from('plugin')->whereTable($this->getTable())->result();
		foreach($plugins as $plugin) {
			$pluginObj = _db()->getEntity('Cms.Plugin.' . ucfirst($plugin['object']));
			$pluginObj->setData($plugin);
			$rs[] = $pluginObj;
		}
		return $rs;
	}
	
	public function getRelateds(){
		$item = $this->getItem();
		$lists = _db()->select('*')->from($this->getTable())
				->where(array('categoryId', $item['categoryId']))
				->limit(5)
				->orderBy('id asc')->result();
		return( $lists );
	}
	
	/**
	Lay ban ghi truoc
	*/
	public function getPrevItem($conds = false) {
		return _db()->useCB()->select($this->fields)->from($this->table)
				->where(array('and', array('gt', 'id', $this->itemId), $conds) )->result_one($this->entity);
	}
	
	/**
	Lay ban ghi ke tiep
	*/
	public function getNextItem($conds = false) {
		return _db()->useCB()->select($this->fields)->from($this->table)
				->where(array('and', array('lt', 'id', $this->itemId), $conds))->result_one($this->entity);
	}
	
	public function statVisitor(){
		$id 			= 	$this->getItemId();
		$ip				=	getRealIPAddress();
		$datevisit 		= 	date("Y-m-d 00:00:00");
		$addVisitor 	=	array(
					$this->getTable(). 'Id'		=>	$id,	
					'ip'						=>	$ip,	
					'visited'					=>	$datevisit
		);
		$entity 		= 	_db()->useCb()->getEntity('Table')
					->setTable($this->getTable().'_visitor');
		$entity->setData($addVisitor);
		$entity->save();
		
		$view			=	_db()->useCB()->select('count(*) as c')
					->from($this->getTable().'_visitor')->where(array($this->getTable().'Id', $id))
					->result_one();
		$countview = $view['c'];
		
		$updateview		=	_db()->update('news')
					->set(array('views' => $countview))
					->where(array('id', $id))->result();
	}
	
	public static $settings = array(
		array(
			'index' 	=> 'id',
			'type'		=> 'text',
			'label'		=> 'ID'
		),
		array(
			'index' 	=> 'itemId',
			'type'		=> 'select',
			'label'		=> 'Tin tức',
			'table'		=> 'news',
			'show_name'	=> 'title',
			'show_value'=> 'id'
		),
		array(
			'index' 	=> 'facebookComment',
			'type'		=> 'selectoption',
			'label'		=> 'Facebook Comment',
			'option'	=> array(
				'true'	=> 'Có',
				'false'	=> 'Không'
			)
		),
		array(
			'index' 	=> 'showNav',
			'type'		=> 'selectoption',
			'label'		=> 'Điều hướng bài viết',
			'option'	=> array(
				'true'	=> 'Có',
				'false'	=> 'Không'
			)
		),
		array(
			'index' 	=> 'showImages',
			'type'		=> 'selectoption',
			'label'		=> 'Danh sách ảnh bài viết',
			'option'	=> array(
				'true'	=> 'Có',
				'false'	=> 'Không'
			)
		),
		array(
			'index' 	=> 'displayFields',
			'type'		=> 'text',
			'label'		=> 'Các trường hiển thị'
		),
		array(
			'index' 	=> 'titleTag',
			'type'		=> 'text',
			'label'		=> 'Thẻ tiêu đề'
		),
		array(
			'index' 	=> 'briefTag',
			'type'		=> 'text',
			'label'		=> 'Thẻ Mô tả'
		),
		array(
			'index' 	=> 'contentTag',
			'type'		=> 'text',
			'label'		=> 'Thẻ Nội dung'
		),
	);
	
}
?>