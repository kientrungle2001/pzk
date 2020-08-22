<?php
class PzkAdminPackagesController extends PzkGridAdminController {
    public $table = 'packages';
	public $logable = true;
	public $logFields = 'name, version,status';
    public $listFieldSettings = array(
        array(
            'index' => 'name',
            'type' => 'text',
            'label' => 'Tên phiên bản'
        ),
        array(
            'index' => 'version',
            'type' => 'text',
            'label' => "Phiên bản"
        ),
        array(
            'index' => 'status',
            'type' => 'status',
            'label' => 'status'
        ),
        array(
            'index' => 'none',
            'type' => 'link',
            'label' => 'Config',
            'link' => '/admin_packages/config/'
        ),
        array(
            'index' => 'none',
            'type' => 'link',
            'label' => 'Export',
            'link' => '/admin_packages/export/'
        )
    );
    //search by field
    public $searchFields = array('name');
    //search lable
    public $searchLables = 'Tên module';
    //sort by
    public $sortFields = array(
        'id desc' => 'id giảm',
        'id asc' => 'id tăng'
    );
    //add menu link
    public $links = array(

        array(
            'name' => 'update',
            'href' => '/admin_packages/update'
        )
    );

    public function updateAction() {
        $module = $this->parse('admin/'.pzk_or($this->get('customModule'), $this->get('module')).'/update');
        $module->set('module', $this->get('module'));
        $module->set('fieldSettings', $this->get('addFieldSettings'));
        $module->set('actions', $this->get('addActions'));

        $page = $this->initPage()
            ->append($module);

        $page->display();
    }
    public function updatePostAction(){
        if($_FILES) {
            $data = _db()->select('*')->fromPackages()->whereStatus('1')->whereName('jquery')->whereType('plugin')->result_one();
            $nameJquery = $data['name'];

            $targetFolder = BASE_DIR.'/packages';
            if (!is_dir($targetFolder))
                mkdir($targetFolder, 0777, true);
            chmod($targetFolder, 0777);

            $filename = 'filename';
            $fileTypes = array('zip');
            $nameConfig = str_replace('.zip','',$_FILES[$filename]['name']);
            if(!$nameJquery && $nameConfig != 'jquery' ){
                pzk_notifier_add_message('Bạn phải cài đặt jquery plugin', 'danger');
                $this->redirect('update');
            }else {

                $tempFile = $_FILES[$filename]['tmp_name'];
                $targetPath = $targetFolder;

                $tam = explode('.', $_FILES[$filename]['name']);
                $ext = end($tam);
                $renamed = md5(rand(0, 200000)) . '.' . "$ext";

                $targetFile = rtrim($targetPath, '/') . '/' . $renamed;
                // Validate the file type

                $fileParts = pathinfo($_FILES[$filename]['name']);


                if (in_array(strtolower($fileParts['extension']), $fileTypes)) {

                    move_uploaded_file($tempFile, $targetFile);
                    //xu li install plugin
                    $backupfile = pzk_model('Package');
                    $result = $backupfile->install($targetFile, $nameConfig);
                    //remove file
                    @unlink($targetFile);

                    switch ($result['errorno']) {
                        case PACKAGE_SUCCESS : {
                            pzk_notifier()->addMessage($result['message']);
                            $entity = _db()->getTableEntity($this->get('table'));
                            $entity->loadWhere(array('name', $result['data']['name']));
                            $result['data']['id'] = $entity->get('id');
                            $entity->setData($result['data']);
                            $entity->save();
                            $this->redirect('index');
                            break;
                        }
                        case PACKAGE_ERROR_VERSION: {
                            pzk_notifier_add_message($result['message'], 'danger');
                            $this->redirect('update');
                            break;
                        }
                        case PACKAGE_DEPEN: {
                            foreach($result['message'] as $error){
                                pzk_notifier_add_message($error, 'danger');
                            }
                            $this->redirect('update');
                            break;
                        }

                    }

                } else {
                    // error fomat file no zip

                    pzk_notifier_add_message('Chỉ chấp nhận file zip', 'danger');
                    $this->redirect('update');
                }

            }

        }
    }

    public function configAction($id) {
        $item = _db()->getTableEntity($this->get('table'))->load($id);
        $settings = json_decode($item->get('settings'), true);
        $module = $this->parse('<Core.Form />');
        $module->set('module', $this->get('module'));
        $module->set('fieldSettings', $settings);
        $module->set('action', '/admin_packages/configPost/'.$id);
        $module->set('actions', $this->get('editActions'));
        $module->set('backLabel', 'Quay lại');
        $module->set('backHref', '/Admin_Packages/index');
        $itemData = array();
        foreach ($settings as $setting) {
            $itemData[$setting['index']] = pzk_config($setting['index']);
        }

        $module->set('item', $itemData);
        $this->initPage()
            ->append($module)
            ->append('admin/'.pzk_or($this->get('customModule'), $this->get('module')).'/menu', 'right');
        $this->prepareEditDisplay();
        $this->display();
    }

    public function configPostAction($id) {
        $item = _db()->getTableEntity($this->get('table'))->load($id);
        $settings = json_decode($item->get('settings'), true);
        $row = array();
        foreach($settings as $setting) {
            $row[$setting['index']] = pzk_request($setting['index']);
        }
        $config = pzk_config();
        if(!$config) {
            $config = array();
        }

        $config = merge_array($config, $row);

        if(pzk_session()->get('storeType') == 'app') {
            file_put_contents("app/".pzk_app()->getPathByName()."/configuration.php", '<?php pzk_store_instance("'.pzk_request()->getAppPath() .'")->set(\'config\', '.var_export($config, true) . ');');
        } else {
            file_put_contents("app/".pzk_app()->getPathByName()."/configuration.".pzk_request()->get('softwareId').".php", '<?php pzk_store_instance("'.pzk_request()->getAppPath() . '/' . pzk_request()->get('softwareId') .'")->set(\'config\', '.var_export($config, true) . ');');
        }
        $this->redirect('admin_packages/config/'.$id);
    }
    public function exportAction($id) {
        $package = _db()->getTableEntity($this->get('table'))->load($id);
        $data = $package->data;
        $namePackage  = $data['name'];
        $folder = 'filePackages/';


        $backupfile = pzk_model('Package');
        $backupfile->build($namePackage, $folder);

        //dowload file zip
        header("Content-disposition: attachment; filename=$namePackage.zip");
        header('Content-type: application/zip');
        readfile($folder.$namePackage.'.zip');


    }
    public function editAction($id) {

        //call one obj
        $layout = pzk_obj('Core.Layout');
        $layout->set('columns', array(
            array(
                'index' => JOIN_TYPE_LEFT,
                'col'   => 3
            ),
            array(
                'index' => 'right',
                'col'   => 9
            ),

        ));
        //get list file
        $item = _db()->getTableEntity($this->table)->load($id);
        $files = json_decode($item->getFiles(), true);
        //convert page to obj
        $list = $this->parse('admin/plugin/list');
        $list->set('files', $files);
        $list->set('module', $this->get('module'));
        $list->set('itemId', $id);
        //gan new obj to property left in obj
        $list->set('column', JOIN_TYPE_LEFT);

        $edit = $this->parse('admin/plugin/edit');
        $edit->set('module', $this->get('module'));
        $edit->set('itemId', $id);
        $edit->set('column', 'right');

        $layout->append($edit);
        $layout->append($list);
        //show obj
        $this->initPage();
        $this->append($layout, 'right');
        $this->display();
    }
    public function putFileAction() {
        $file = pzk_request('file');
        $fileContent = pzk_request('content');
        $link = pzk_request('link');
        file_put_contents($file, $fileContent);
        $this->redirect($link);
    }

    public function delPostAction() {

        if($this->getChildTables()) {
            foreach($this->getChildTables() as $val) {
                _db()->useCB()->delete()->from($val['table'])
                    ->where(array($val['referenceField'], pzk_request()->get('id')))->result();
            }

        }
        $entity = _db()->getTableEntity($this->get('table'));
        $entity->load(pzk_request()->get('id'));

        $dataPlugin = $entity->data;
        $namePlugin = $dataPlugin['name'];

        $package =  pzk_model('Package');
        $package->remove($namePlugin);

        if($this->getLogable()) {
            $logEntity = _db()->getTableEntity('admin_log');
            $logFields = explodetrim(',', $this->getLogFields());
            $brief = pzk_session()->get('adminUser') . ' Xóa bản ghi: ' . $this->get('module');
            foreach ($logFields as $field) {
                $brief .= '[' . $field . ': ' . $entity->get($field) . ']';
            }
            $logEntity->set('userId', pzk_session()->get('adminId'));
            $logEntity->set('created', date('Y-m-d H:i:s'));
            $logEntity->set('actionType', 'delete');
            $logEntity->set('admin_controller', 'Admin_'.$this->get('module'));
            $logEntity->set('brief', $brief);
            $logEntity->save();
        }
        $entity->delete();
        pzk_notifier()->addMessage('Xóa thành công');
        $this->redirect('index');
    }
    public function testAction() {
        $files = dir_list(BASE_DIR.'/3rdparty/bootstrap', true);
        debug($files);
    }

    function buildTree(array $elements, $parentId = 0) {
        $branch = array();
        foreach ($elements as $key1=>$element) {
            if ($element['parent'] == $parentId) {
                $children = buildTree($elements, $element['id']);
                if ($children) {
                    $element['children'] = $children;
                }
                $branch[] = $element;
            }
        }

        return $branch;
    }
}
?>