<?php
/**
 *
 * @author: Huunv
 * date: 21/4
 */
class PzkConfigAdminController extends PzkBackendController {
    public $masterStructure = 'admin/home/index';
    public $masterPosition = 'left';
    public $table = false;
    public $customModule = false;
    public $menuLinks = false;
    public $addLabel = false;
    public $databaseFieldSettings = false;
    public $writeFields = false;
    public function __construct() {
        parent::__construct();
        //get module
        $controller = pzk_request('controller');
        $contrParts = explode('_', $controller);
        array_shift($contrParts);//get first array value
        $this->set('module', implode('_', $contrParts));
        if(!$this->get('table')) {
            $this->set('table', $this->get('module'));
        }
    }

    public function indexAction()
    {
        $this->initPage()->append('admin/'.pzk_or($this->get('customModule'), $this->get('module')).'/index')
            ->append('admin/'.pzk_or($this->get('customModule'), $this->get('module')).'/menu', 'right');

        $this->display();
    }

    public function editAction() {
        $this->initPage()->append('admin/'.pzk_or($this->get('customModule'), $this->get('module')).'/edit')
            ->append('admin/'.pzk_or($this->get('customModule'), $this->get('module')).'/menu', 'right');

        $this->display();
    }
    public function getAddData() {
    	$fields = pzk_request()->get('config') . 'Fields';
        return pzk_request()->getFilterData($this->$fields);
    }
    public function writePostAction() {
    	pzk_notifier_add_message('Sửa cấu hình thành công', 'success');
        $row = $this->getAddData();
        	
        if(pzk_session()->get('storeType') == 'app') {
        	$config = pzk_app_store()->get('config');
        } else {
        	$config = pzk_site_store()->get('config');
        }
        if(!$config) {
        	$config = array();
        }
        $config = merge_array($config, $row);
        if(pzk_session()->get('storeType') == 'app') {
        	file_put_contents(BASE_DIR . "/app/".pzk_app()->getPathByName()."/configuration.php", '<?php pzk_store_instance("'.pzk_request()->getAppPath() .'")->set(\'config\', '.var_export($config, true) . ');');
        } else {
        	file_put_contents(BASE_DIR . "/app/".pzk_app()->getPathByName()."/configuration.".pzk_request()->get('softwareId').".php", '<?php pzk_store_instance("'.pzk_request()->getAppPath() . '/' . pzk_request()->get('softwareId') .'")->set(\'config\', '.var_export($config, true) . ');');
        }
        
    	$this->redirect('edit', array('config' => pzk_request()->get('config')));
    }
    
    public function changeStoreTypeAction() {
    	$storeType = pzk_request()->get('storeType');
    	pzk_session()->set('storeType', $storeType);
    	$this->redirect('edit', array('config' => pzk_request()->get('config')));
    }
}