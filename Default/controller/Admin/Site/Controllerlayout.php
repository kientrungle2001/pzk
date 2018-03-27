<?php
class PzkAdminSiteControllerlayoutController extends PzkGridAdminController {
    public $addFields = 'name, theme, controller_name, action_name, base_controller, base_action, software, sharedSoftwares, global, status';
    public $editFields = 'name, theme, controller_name, action_name, base_controller, base_action, software, sharedSoftwares, global, status';
    public $table = 'site_controller_layout';
    public $filterStatus = true;

    public $sortFields = array(
        'id asc' 		=> 'ID tăng',
        'id desc' 		=> 'ID giảm',
        'name asc' 		=> 'Tên tăng',
        'name desc' 	=> 'Tên giảm',
    );
	public $filterFields = array(
		array(
			'index'	=> 'controller_name',
			'label'	=> 'Tên controller',
			'type'	=> 'selectoption',
			'option'	=> array(
				'home'		=> 'Trang chủ',
				'account'	=> 'Tài khoản',
				'profile'	=> 'Hồ sơ',
				'news'		=> 'Tin tức',
			)
		),
		array(
			'index'	=> 'action_name',
			'label'	=> 'Tên action',
			'type'	=> 'selectoption',
			'option'	=> array(
				'index'		=> 'Index',
				'detail'	=> 'Chi tiết',
				'edit'		=> 'Sửa',
				'login'		=> 'Đăng nhập',
				'register'	=> 'Đăng ký',
				'forgotpassword'	=> 'Quên mật khẩu'
			)
		),
		array(
			'index'	=> 'status',
			'label'	=> 'Trạng thái',
			'type'	=> 'status'
		)
	);
    public $searchFields = array('site_layout.name');
    public $Searchlabels = 'Tên Bố cục';
    public $listFieldSettings = array(
        array(
            'index' => 'none5',
            'type' => 'link',
            'label' => 'Design',
			'link'	=> '/admin_site_controllerlayout/design/'
        ),
		array(
            'index' => 'theme',
            'type' => 'text',
            'label' => 'Giao diện'
        ),
		array(
            'index' => 'controller_name',
            'type' => 'text',
            'label' => 'Controller'
        ),
		array(
            'index' => 'action_name',
            'type' => 'text',
            'label' => 'Action'
        ),
		array(
            'index' => 'name',
            'type' => 'text',
            'label' => 'Tên bố cục'
        ),
		array(
            'index' => 'base_controller',
            'type' => 'text',
            'label' => 'Base Controller'
        ),
		array(
            'index' => 'base_action',
            'type' => 'text',
            'label' => 'Base Action'
        ),
		
		array(
            'index' => 'created',
            'type' => 'datetime',
			'format' => 'd/m/Y H:i',
            'label' => 'Ngày tạo'
        ),
        array(
            'index' => 'status',
            'type' => 'status',
            'label' => 'Trạng thái'
        ),
    );
	
    public $addLabel = 'Thêm Bố cục';
    public $addFieldSettings = array(
        
		array(
            'index' => 'theme',
            'type' => 'select',
            'label' => 'Giao diện',
			'table'			=> 'themes',
			'show_value'	=> 'name',
			'show_name'		=> 'name'
        ),
		array(
            'index' => 'base_controller',
            'type' => 'text',
            'label' => 'Base Controller'
        ),
		array(
            'index' => 'base_action',
            'type' => 'text',
            'label' => 'Base Action'
        ),
		array(
            'index' => 'controller_name',
            'type' => 'text',
            'label' => 'Controller',
        ),
		array(
            'index' => 'action_name',
            'type' => 'text',
            'label' => 'Action',
        ),
		array(
            'index' => 'name',
            'type' => 'text',
            'label' => 'Tên bố cục',
        ),
        array(
            'index' => 'status',
            'type' => 'status',
            'label' => 'Trạng thái'
        )
    );
    public $editFieldSettings = array(
		array(
            'index' => 'theme',
            'type' => 'select',
            'label' => 'Giao diện',
			'table'			=> 'themes',
			'show_value'	=> 'name',
			'show_name'		=> 'name'
        ),
		array(
            'index' => 'base_controller',
            'type' => 'text',
            'label' => 'Base Controller'
        ),
		array(
            'index' => 'base_action',
            'type' => 'text',
            'label' => 'Base Action'
        ),
		array(
            'index' => 'controller_name',
            'type' => 'text',
            'label' => 'Controller',
        ),
		array(
            'index' => 'action_name',
            'type' => 'text',
            'label' => 'Action',
        ),
		array(
            'index' => 'name',
            'type' => 'text',
            'label' => 'Tên bố cục',
        ),
        array(
            'index' => 'status',
            'type' => 'status',
            'label' => 'Trạng thái'
        )
    );
    public $addValidator = array(
        'rules' => array(
            'name' => array(
                'required' => true,
                'minlength' => 2,
                'maxlength' => 50
            )

        ),
        'messages' => array(
            'name' => array(
                'required' => 'Tên menu không được để trống',
                'minlength' => 'Tên menu phải dài 2 ký tự trở lên',
                'maxlength' => 'Tên menu chỉ dài tối đa 50 ký tự'
            )

        )
    );
    public $editValidator = array(
        'rules' => array(
            'name' => array(
                'required' => true,
                'minlength' => 2,
                'maxlength' => 50
            )

        ),
        'messages' => array(
            'name' => array(
                'required' => 'Tên menu không được để trống',
                'minlength' => 'Tên menu phải dài 2 ký tự trở lên',
                'maxlength' => 'Tên menu chỉ dài tối đa 50 ký tự'
            )

        )
    );
	
	public function designAction($id) {
		$this->layout();
		$this->append('admin/site/controllerlayout/design');
		$design = pzk_element('design');
		if($design) {
			$design->set('itemId', $id);
			$item = $design->getItem();
			$design->set('layout', 'admin/site/controllerlayout/design/' . $item['name']);
		}
		$this->display();
	}
	
	public function moduleEditAction($moduleId, $id) {
		$code = pzk_request()->get('code');
		$entity = _db()->getTableEntity('site_module')->load($moduleId);
		$entity->set('code', $code);
		$entity->save();
		$this->redirect('design/' . $id);
	}
	
	public function moduleAddAction($id) {
		$data = pzk_request()->getFilterData();
		
		$module = _db()->getTableEntity('site_module');
		$module->setData($data);
		$module->set('software', pzk_request()->get('softwareId'));
		$module->set('creatorId', pzk_session()->get('adminId'));
		$module->set('created', date('Y-m-d H:i:s'));
		$module->save();
		$this->redirect('design/' . $id);
	}
	
	public function moduleDeleteAction($moduleId, $id) {
		$code = pzk_request()->getCode();
		$entity = _db()->getTableEntity('site_module')->load($moduleId);
		$entity->delete();
		$this->redirect('design/' . $id);
	}
	
	public function moduleUpAction($moduleId, $id) {
		$code = pzk_request()->getCode();
		$entity = _db()->getTableEntity('site_module')->load($moduleId);
		$front = _db()->selectAll()->fromSite_module()->lteOrdering($entity->getOrdering())->result_one('Table');
		if($front) {
			$front->setTable('site_module');
			if($entity->get('ordering') > $front->get('ordering')) {
				$entityOrdering = $entity->get('ordering');
				$frontOrdering = $front->get('ordering');
				$entity->set('ordering', $frontOrdering);
				$front->set('ordering', $entityOrdering);
				$entity->save();
				$front->save();
			} else {
				$entity->set('ordering', $front->get('ordering') - 1);
				$entity->save();
			}
		}
		$this->redirect('design/' . $id);
	}
	
	public function moduleDownAction($moduleId, $id) {
		$code = pzk_request()->getCode();
		$entity = _db()->getTableEntity('site_module')->load($moduleId);
		$front = _db()->selectAll()->fromSite_module()->gteOrdering($entity->get('ordering'))->result_one('table');
		if($front) {
			$front->setTable('site_module');
			if($entity->get('ordering') < $front->get('ordering')) {
				$entityOrdering = $entity->get('ordering');
				$frontOrdering = $front->get('ordering');
				$entity->set('ordering', $frontOrdering);
				$front->set('ordering', $entityOrdering);
				$entity->save();
				$front->save();
			} else {
				$entity->set('ordering', $front->get('ordering') + 1);
				$entity->save();
			}
		}
		$this->redirect('design/' . $id);
	}
	
	public $configActions = array(
		array(
			'name'	=> 'btn_module_config_submit',
			'label'	=> 'Submit'
		)
	);
	
	public function moduleConfigAction($moduleId, $id) {
		$this->layout();
		$entity = _db()->getTableEntity('site_module')->load($moduleId);
		$code = $entity->getCode();
		$obj = pzk_parse($code);
		//var_dump($obj);
		$class = get_class($obj);
		$module = $this->parse('admin/site/controllerlayout/module/config');
		$module->set('module', $this->get('module'));
		$module->set('moduleId', $moduleId);
		$module->set('designId', $id);
		$module->set('fieldSettings', $class::$settings);
		$module->set('actions', $this->get('configActions'));
		$module->set('object', $obj);
		$this->append($module);
		$this->display();
		//$this->redirect('design/' . $id);
	}
	
	public function moduleConfigPostAction($moduleId, $id) {
		$this->layout();
		$entity = _db()->getTableEntity('site_module')->load($moduleId);
		$code = $entity->getCode();
		$obj = pzk_parse($code);
		//var_dump($obj);
		$class = get_class($obj);
		$tagName = $obj->getTagName();
		$settings = $class::$settings;
		$data = array();
		foreach($settings as $setting) {
			if($val = pzk_request($setting['index'])) {
				$data[$setting['index']] = $val;
			}
		}
		$newCode = '<' . $tagName . ' ';
		foreach($data as $key => $val) {
			$newCode .= $key . '="' . html_escape($val) . '" ';
		}
		$newCode .= '/>';
		$entity->set('code', $newCode);
		$entity->save();
		$this->redirect('design/' . $id);
	}
}
?>