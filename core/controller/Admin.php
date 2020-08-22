<?php
require_once __DIR__ . '/Constant.php';

class PzkAdminController extends PzkBackendController
{
	public $table = false;
	public $childTables = false;
	public $entityTableEnabled = false;

	public $customModule = false;
	public $logable = false;
	public $logFields = 'id, name';
	public function __construct()
	{
		parent::__construct(); //goi lop cha
		$controller = pzk_request()->getController();
		$contrParts = explode(UNS, $controller);
		array_shift($contrParts);
		$this->setModule(implode(UNS, $contrParts));
		if (!$this->getTable()) {
			$this->setTable($this->getModule());
		}

		$allFields = _db()->getFields($this->getTable());
		if (!$this->getAddFields()) {
			$this->setAddFields(implode(',', $allFields));
		}

		if (!$this->getEditFields()) {
			$this->setEditFields($this->getAddFields());
		}

		if (!$this->getListFieldSettings()) {
			$this->setListFieldSettings($this->getDefaultListFieldSettings());
		}

		if (method_exists($this, 'alterListFieldSettings')) {
			$this->alterListFieldSettings($this->getListFieldSettings());
		}

		if (!$this->getAddFieldSettings()) {
			$this->setAddFieldSettings($this->getDefaultEditFieldSettings());
		}

		if (method_exists($this, 'alterAddFieldSettings')) {
			$this->alterAddFieldSettings($this->getAddFieldSettings());
		}

		if (!$this->getEditFieldSettings()) {
			$this->setEditFieldSettings($this->getAddFieldSettings());
		}

		if (method_exists($this, 'alterEditFieldSettings')) {
			$this->alterEditFieldSettings($this->getEditFieldSettings());
		}
	}
	public $_session = false;
	public $_filterSession = false;

	public $editActions = array(
		array(
			'name'	=> BTN_EDIT_AND_CLOSE,
			'label'	=> 'Update'
		)
	);

	public $addActions = array(
		array(
			'name'	=> BTN_ADD_AND_CLOSE,
			'label'	=> 'Add'
		)
	);
	/**
	 * 
	 * @return PzkSGStorePrefix
	 */
	public function getSession()
	{
		if (!$this->_session) {
			$this->_session = new PzkSGStorePrefix(pzk_session());
			$this->_session->setPrefix($this->getModule() . UNS . $this->getCustomModule() . UNS);
		}
		return $this->_session;
	}

	public function getFilterSession()
	{
		if (!$this->_filterSession) {
			$this->_filterSession = new PzkSGStorePrefix($this->getSession());
			$this->_filterSession->setPrefix('filter' . UNS);
		}
		return $this->_filterSession;
	}
	public function changeStatusAction()
	{
		$id = pzk_request()->getSegment(3);
		$entity = _db()->getTableEntity($this->get('table'));
		$entity->load($id);
		$status = 1 - $entity->get('status');
		$entity->update(array('status' => $status));
		$this->redirect('index');
	}
	public function changeOrderByAction()
	{
		$request = pzk_request();
		$this->getSession()->set('orderBy', $request->get('orderBy'));
		if ($request->get('isAjax')) {
			echo 1;
		} else {
			$this->redirect('index');
		}
	}
	public function filterAction()
	{
		$request = pzk_request();
		$id = $request->getId();
		$filterValue = $request->getSelect();
		if($id) {
			$entity = _db()->getTableEntity($this->getTable());
			$entity->load($id);
			$filterValue = $entity->get($request->getIndex());
		}
		
		$this->getFilterSession()->set($request->getIndex(), $filterValue);
		if ($request->getIsAjax()) {
			echo 1;
		} else {
			$this->redirect('index');
		}
	}

	public function changePageSizeAction()
	{
		$request = pzk_request();
		$this->getSession()->set('pageSize', $request->get('pageSize'));
		if ($request->get('isAjax')) {
			echo '1';
		} else {
			$this->redirect('index');
		}
	}

	public function searchPostAction()
	{
		$request = pzk_request();
		$action	=	$request->get('submit_action');
		if ($action != ACTION_RESET) {
			$this->getSession()->set('keyword', $request->get('keyword'));
			$this->getSession()->set('pageNum', $request->get('pageNum'));
		} else {
			$this->getSession()->del('keyword');
			$this->getSession()->del('type');
			$this->getSession()->del('categoryId');
			$this->getSession()->del('topic_id');
			$this->getSession()->del('testId');
			$this->getSession()->del('trial');
			$this->getSession()->del('questionType');
			$this->getSession()->del('status');
			$this->getSession()->del('check');
			$this->getSession()->del('deleted');
			$this->getSession()->del('pageNum');
		}
		$this->redirect('index');
	}
	public function searchFilterAction()
	{
		$request = pzk_request();
		$action	=	$request->get('submit_action');
		if ($action != ACTION_RESET) {
			$this->getSession()->set('keyword', $request->get('keyword'));
			$this->getSession()->del('pageNum');
		} else {
			$this->getSession()->del('keyword');
			$this->getSession()->del('orderBy');
			$fields = $this->get('filterFields');
			if (!empty($fields)) {
				foreach ($fields as $val) {
					$this->getSession()->del($val['type'] . $val['index']);
				}
			}
		}
		if (pzk_request()->get('isAjax')) {
			echo 1;
		} else {
			$this->redirect('index');
		}
	}
	public function searchAction()
	{
		$request = pzk_request();
		$this->getSession()->set('keyword', $request->get('keyword'));
		if ($request->get('isAjax')) {
			echo 1;
		} else {
			$this->redirect('index');
		}
	}
	public function indexAction()
	{
		$this->initPage()
			->append('admin/' . pzk_or($this->get('customModule'), $this->get('module')) . '/index')
			->append('admin/' . pzk_or($this->get('customModule'), $this->get('module')) . '/menu', 'right');
		$this->prepareListDisplay();
		$this->display();
	}

	public function prepareListDisplay()
	{
	}

	public function addAction()
	{
		$module = $this->parse('admin/' . pzk_or($this->get('customModule'), $this->get('module')) . '/add');
		$module->set('module', $this->get('module'));
		$module->set('fieldSettings', $this->get('addFieldSettings'));
		$module->set('actions', $this->get('addActions'));
		$module->set('label', $this->get('addLabel'));
		$row = pzk_validator()->getEditingData();
		if ($row) {
			$module->getFormObject()->set('item', $row);
		} else {
			$row = $this->getAddData();
			if ($row) {
				if ($module->getFormObject())
					$module->getFormObject()->set('item', $row);
			}
		}
		$page = $this->initPage()
			->append($module)
			->append('admin/' . pzk_or($this->get('customModule'), $this->get('module')) . '/menu', 'right');

		$this->prepareAddDisplay();
		$page->display();
	}
	public function prepareAddDisplay()
	{
	}
	public function addPostAction()
	{
		$row 		= $this->getAddData();
		$backHref 	= pzk_request('backHref');
		if ($this->validateAddData($row)) {

			$id 	= $this->add($row);
			if ($backHref) {
				if (strpos($backHref, '?') !== false) {
					$backHref .= '&lastItemId=' . $id;
				} else {
					$backHref .= '?lastItemId=' . $id;
				}
			}
			pzk_notifier()->addMessage('Thêm thành công');
			if (pzk_request()->get(BTN_ADD_AND_CLOSE)) {
				if ($backHref) {
					$this->redirect($backHref);
				} else {
					$this->redirect('index');
				}
			} else if (pzk_request()->get(BTN_ADD_AND_CONTINUE)) {
				$this->redirect('add');
			} else if (pzk_request()->get(BTN_ADD_AND_EDIT)) {
				$this->redirect('edit/' . $id);
			} else {
				if ($backHref) {
					$this->redirect($backHref);
				} else {
					$this->redirect('index');
				}
			}
		} else {
			pzk_validator()->setEditingData($row);
			$this->redirect('add', array('backHref' => $backHref));
		}
	}
	public function getAddData()
	{
		return pzk_request()->getFilterData($this->get('addFields'));
	}
	public function validateAddData($row)
	{
		return $this->validate($row, $this->get('addValidator') ? $this->get('addValidator') : null);
	}
	public function add($row)
	{
		$row['creatorId'] = pzk_session()->get('adminId');
		$row['created'] = date(DATEFORMAT, $_SERVER['REQUEST_TIME']);
		if ($this->get('entityTableEnabled')) {
			$row['table']		= $this->get('table');
			$entityTableEntity 	= _db()->getTableEntity('entity');
			$entityTableEntity->setData($row);
			$entityTableEntity->save();
			if ($entityTableEntity->get('id')) {
				$row['id'] = $entityTableEntity->get('id');
			}
		}
		$entity = _db()->getTableEntity($this->get('table'));
		$entity->setData($row);
		$entity->save();
		if ($this->get('logable')) {
			$logEntity = _db()->getTableEntity('admin_log');
			$logFields = explodetrim(',', $this->get('logFields'));
			$brief = pzk_session()->get('adminUser') . ' Thêm mới bản ghi: ' . $this->get('module');
			foreach ($logFields as $field) {
				$brief .= '[' . $field . ': ' . (isset($row[$field]) ? $row[$field] : '') . ']';
			}
			$logEntity->set('userId', pzk_session()->get('adminId'));
			$logEntity->set('created', date('Y-m-d H:i:s'));
			$logEntity->set('actionType', 'add');
			$logEntity->set('admin_controller', 'admin_' . $this->get('module'));
			$logEntity->set('brief', $brief);
			$logEntity->save();
		}
		return $entity->get('id');
	}
	public function editAllCatePostAction()
	{
		$row = $this->getEditData();
		if (!empty($row['categoryIds'])) {
			$str = ',' . implode(',', $row['categoryIds']) . ',';
			$row['categoryIds'] = $str;
		} else {
			$row['categoryIds'] = '';
		}

		if (!empty($row['topic_id'])) {
			$str = ',' . implode(',', $row['topic_id']) . ',';
			$row['topic_id'] = $str;
		} else {
			$row['topic_id'] = '';
		}

		if ($this->validateEditData($row)) {
			$this->edit($row);
			pzk_notifier()->addMessage('Cập nhật thành công');
			$this->redirect('index');
		} else {
			pzk_validator()->setEditingData($row);
			$this->redirect('edit/' . pzk_request()->get('id'));
		}
	}
	public function editPostAction()
	{
		$row = $this->getEditData();
		$backHref 	= pzk_request('backHref');

		if ($this->validateEditData($row)) {
			if ($backHref) {
				if (strpos($backHref, '?') !== false) {
					$backHref .= '&lastItemId=' . pzk_request('id');
				} else {
					$backHref .= '?lastItemId=' . pzk_request('id');
				}
			}
			$this->edit($row);
			pzk_notifier()->addMessage('Cập nhật thành công');
			if (pzk_request()->get(BTN_EDIT_AND_CLOSE)) {
				if ($backHref) {
					$this->redirect($backHref);
				} else {
					$this->redirect('index');
				}
			} else if (pzk_request()->get(BTN_EDIT_AND_CONTINUE)) {
				$this->redirect('edit/' . pzk_request()->get('id'));
			} else if (pzk_request()->get(BTN_EDIT_AND_DETAIL)) {
				$this->redirect('detail/' . pzk_request()->get('id'));
			} else {
				if ($backHref) {
					$this->redirect($backHref);
				} else {
					$this->redirect('index');
				}
			}
		} else {
			pzk_validator()->setEditingData($row);
			$this->redirect('edit/' . pzk_request()->get('id'));
		}
	}
	public function getEditData()
	{
		return pzk_request()->getFilterData($this->get('editFields'));
	}
	public function validateEditData($row)
	{
		return $this->validate($row, $this->get('editValidator') ? $this->get('editValidator') : null);
	}
	public function edit($row)
	{
		$row['modifiedId'] = pzk_session()->get('adminId');
		$row['modified'] = date(DATEFORMAT, $_SERVER['REQUEST_TIME']);
		$row['id']		= pzk_request('id');
		if ($this->get('entityTableEnabled')) {
			$row['table']		= $this->get('table');
			$entityTableEntity 	= _db()->getTableEntity('entity');
			$entityTableEntity->setData($row);
			$entityTableEntity->save();
			if ($entityTableEntity->get('id')) {
				$row['id'] = $entityTableEntity->get('id');
			}
		}
		$entity = _db()->getTableEntity($this->get('table'));
		$entity->load(pzk_request()->get('id'));

		//set index owner
		$adminmodel = pzk_model('Admin');
		$controller = pzk_request('controller');

		$checkIndexOwner = $adminmodel->checkActionType('editOwner', $controller, pzk_session('adminLevel'));

		if ($checkIndexOwner) {
			if ($entity->get('creatorId') == pzk_session()->get('adminId')) {
				$entity->update($row);
				$entity->save();
				if ($this->get('logable')) {
					$logEntity = _db()->getTableEntity('admin_log');
					$logFields = explodetrim(',', $this->get('logFields'));
					$brief = pzk_session()->get('adminUser') . ' Sửa bản ghi: ' . $this->get('module');
					foreach ($logFields as $field) {
						if (1 || $entity->get($field) !== @$row[$field])
							$brief .= '[' . $field . ': ' . $entity->get($field) . ']';
					}
					$brief .= ' thành ';
					foreach ($logFields as $field) {
						if (1 || $entity->get($field) !== @$row[$field])
							$brief .= '[' . $field . ': ' . (isset($row[$field]) ? $row[$field] : '') . ']';
					}
					$logEntity->set('userId', pzk_session()->get('adminId'));
					$logEntity->set('created', date('Y-m-d H:i:s'));
					$logEntity->set('actionType', 'edit');
					$logEntity->set('admin_controller', 'Admin_' . $this->get('module'));
					$logEntity->set('brief', $brief);
					$logEntity->save();
				}
			}
		} else {
			file_put_contents(BASE_DIR . '/update.log', json_encode($row) . "\n", FILE_APPEND);
			file_put_contents(BASE_DIR . '/update.log', get_class($this) . "\n", FILE_APPEND);
			$entity->update($row);
			$entity->save();

			if ($this->get('logable')) {
				$logEntity = _db()->getTableEntity('admin_log');
				$logFields = explodetrim(',', $this->get('logFields'));
				$brief = pzk_session()->get('adminUser') . ' Sửa bản ghi: ' . $this->get('module');
				foreach ($logFields as $field) {
					if (1 || $entity->get($field) !== @$row[$field])
						$brief .= '[' . $field . ': ' . $entity->get($field) . ']';
				}
				$brief .= ' thành ';
				foreach ($logFields as $field) {
					if (1 || $entity->get($field) !== @$row[$field])
						$brief .= '[' . $field . ': ' . (isset($row[$field]) ? $row[$field] : '') . ']';
				}
				$logEntity->set('userId', pzk_session()->get('adminId'));
				$logEntity->set('created', date('Y-m-d H:i:s'));
				$logEntity->set('actionType', 'edit');
				$logEntity->set('admin_controller', 'Admin_' . $this->get('module'));
				$logEntity->set('brief', $brief);
				$logEntity->save();
			}
		}
	}
	public function importAction()
	{
		$this->initPage();
		$this->append('admin/' . pzk_or($this->get('customModule'), $this->get('module')) . '/import')
			->append('admin/' . pzk_or($this->get('customModule'), $this->get('module')) . '/menu', 'right');
		$this->display();
	}
	public function editAction($id)
	{

		//set edit owner
		$adminmodel = pzk_model('Admin');
		$controller = pzk_request('controller');

		$checkEditOwner = $adminmodel->checkActionType('editOwner', $controller, pzk_session('adminLevel'));

		if ($checkEditOwner) {

			$entity = _db()->getEntity('table')->setTable($this->table);
			$entity->load($id);

			if ($entity->get('creatorId') != pzk_session()->get('adminId')) {
				$view = pzk_parse('<div layout="erorr/erorr" />');
				$view->display();
				pzk_system()->halt();
			}
		}



		$module = $this->parse('admin/' . pzk_or($this->get('customModule'), $this->get('module')) . '/edit');
		$module->set('itemId', $id);
		$module->set('entityTableEnabled', $this->get('entityTableEnabled'));
		$module->set('module', $this->get('module'));
		$module->set('fieldSettings', $this->get('editFieldSettings'));
		$module->set('actions', $this->get('editActions'));
		$module->set('label', $this->get('editLabel'));
		$row = pzk_validator()->getEditingData();
		if ($row) {
			if ($module->getFormObject())
				$module->getFormObject()->set('item', $row);
		}
		$this->initPage()
			->append($module)
			->append('admin/' . pzk_or($this->get('customModule'), $this->get('module')) . '/menu', 'right');
		$this->prepareEditDisplay();
		$this->display();
	}
	public function prepareEditDisplay()
	{
	}
	public function detailAction($id)
	{
		$module = $this->parse('admin/' . pzk_or($this->get('customModule'), $this->get('module')) . '/detail');
		$module->set('itemId', $id);
		$module->set('entityTableEnabled', $this->get('entityTableEnabled'));
		$this->initPage()
			->append($module)
			->append('admin/' . pzk_or($this->get('customModule'), $this->get('module')) . '/menu', 'right');
		if ($childList = pzk_element($this->get('module') . 'Children')) {
			$childList->set('parentId', $id);
		}
		$this->prepareDetailDisplay();
		$this->display();
	}
	public function prepareDetailDisplay()
	{
		if ($detail = pzk_element()->getDetail()) {
			if ($fieldSettings = $this->get('detailFieldSettings')) {
				$detail->set('displayFields', $fieldSettings['displayFields']);
			}
		}
	}
	public function delAction($id)
	{
		$module = $this->parse('admin/' . pzk_or($this->get('customModule'), $this->get('module')) . '/del');
		$module->set('itemId', $id);
		$module->set('entityTableEnabled', $this->get('entityTableEnabled'));
		$this->initPage()
			->append($module)
			->append('admin/' . pzk_or($this->get('customModule'), $this->get('module')) . '/menu', 'right')
			->display();
	}

	public function delPostAction()
	{

		if ($this->get('childTables')) {
			foreach ($this->get('childTables') as $val) {
				_db()->useCB()->delete()->from($val['table'])
					->where(array($val['referenceField'], pzk_request()->get('id')))->result();
			}
		}
		$entity = _db()->getTableEntity($this->get('table'));
		$entity->load(pzk_request()->get('id'));

		if ($this->get('logable')) {
			$logEntity = _db()->getTableEntity('admin_log');
			$logFields = explodetrim(',', $this->get('logFields'));
			$brief = pzk_session()->get('adminUser') . ' Xóa bản ghi: ' . $this->get('module');
			foreach ($logFields as $field) {
				$brief .= '[' . $field . ': ' . $entity->get($field) . ']';
			}
			$logEntity->set('userId', pzk_session()->get('adminId'));
			$logEntity->set('created', date('Y-m-d H:i:s'));
			$logEntity->set('actionType', 'delete');
			$logEntity->set('admin_controller', 'admin_' . $this->get('module'));
			$logEntity->set('brief', $brief);
			$logEntity->save();
		}
		$entity->delete();

		if ($this->get('entityTableEnabled')) {
			$entityTableEntity 	= _db()->getTableEntity('entity');
			$entityTableEntity->load(pzk_request()->get('id'));
			$entityTableEntity->delete();
		}
		pzk_notifier()->addMessage('Xóa thành công');
		$this->redirect('index');
	}
	public function delAllAction()
	{
		if (pzk_request('ids')) {
			$arrIds = json_decode(pzk_request()->get('ids'));
			if (count($arrIds) > 0) {
				_db()->useCB()->delete()->from($this->get('table'))
					->where(array('in', 'id', $arrIds))->result();
				if ($this->get('entityTableEnabled')) {
					_db()->useCB()->delete()->from('entity')
						->where(array('in', 'id', $arrIds))->result();
				}

				echo 1;
			}
		} else {
			pzk_system()->halt();
		}
	}
	public function uploadAction()
	{
		$this->initPage()
			->append('admin/' . pzk_or($this->get('customModule'), $this->get('module')) . '/upload')
			->append('admin/' . pzk_or($this->get('customModule'), $this->get('module')) . '/menu', 'right')
			->display();
	}
	public function uploadPostAction()
	{
		$row = $this->get('uploadData');
		//debug($row);die();
		if ($this->validateUploadData($row)) {
			$this->upload($row);
			pzk_notifier()->addMessage('Thêm thành công');
			$this->redirect('index');
		} else {
			pzk_validator()->setEditingData($row);
			$this->redirect('upload');
		}
	}
	public function getUploadData()
	{
		return pzk_request()->getFilterData($this->get('uploadFields'));
	}
	public function validateUploadData($row)
	{
		return $this->validate($row, $this->get('uploadValidator') ? $this->get('uploadValidator') : null);
	}
	public function upload($row)
	{
		$entity = _db()->getTableEntity($this->get('table'));
		$entity->setData($row);
		$entity->save();
	}

	public function doUpload($filename, $dir, $allowed, $row)
	{
		if (isset($_FILES[$filename])) {
			if (!empty($_FILES[$filename]['name'])) {
				// Kiem tra xem file upload co nam trong dinh dang cho phep
				if (in_array(strtolower($_FILES[$filename]['type']), $allowed)) {
					// Neu co trong dinh dang cho phep, tach lay phan mo rong
					$ext = end(explode('.', $_FILES[$filename]['name']));
					$renamed = md5(rand(0, 200000)) . '.' . "$ext";

					if (move_uploaded_file($_FILES[$filename]['tmp_name'], $dir . $renamed)) {
						if (!empty($row)) {
							$row[$filename] = $renamed;
							$id = pzk_request('id');
							if (isset($id)) {
								if ($this->validateEditData($row)) {
									$data = _db()->useCB()->select('url')->from('video')->where(array('id', $id))->result_one();
									$url = BASE_DIR . "/3rdparty/uploads/videos/" . $data['url'];
									unlink($url);
									$this->edit($row);
									pzk_notifier()->addMessage('Cập nhật thành công');
									$this->redirect('index');
								} else {
									pzk_validator()->setEditingData($row);
									$this->redirect('edit/' . pzk_request('id'));
								}
							} else {
								if ($this->validateAddData($row)) {
									$this->add($row);
									pzk_notifier()->addMessage('Thêm thành công');
									$this->redirect('index');
								} else {
									pzk_validator()->setEditingData($row);
									$this->redirect('add');
								}
							}
						}
					} else {
						$errors = "upload error";
					}
				} else {
					// FIle upload khong thuoc dinh dang cho phep
					$errors = "File upload không thuộc định dạng cho phép!";
					$this->redirect('index');
				}
			} else {
				if (!empty($row)) {
					$id = pzk_request('id');
					if (isset($id)) {
						if ($this->validateEditData($row)) {

							$this->edit($row);
							pzk_notifier()->addMessage('Cập nhật thành công');
							$this->redirect('index');
						} else {
							pzk_validator()->setEditingData($row);
							$this->redirect('edit/' . pzk_request('id'));
						}
					} else {
						if ($this->validateAddData($row)) {
							$this->add($row);
							pzk_notifier()->addMessage('Thêm thành công');
							$this->redirect('index');
						} else {
							pzk_validator()->setEditingData($row);
							$this->redirect('add');
						}
					}
				}
			} // END isset $_FILES



		}



		// Xoa file da duoc upload va ton tai trong thu muc tam
		if (isset($_FILES[$filename]['tmp_name']) && is_file($_FILES[$filename]['tmp_name']) && is_file($_FILES[$filename]['tmp_name'])) {
			unlink($_FILES[$filename]['tmp_name']);
		}

		if (isset($errors)) {
			pzk_notifier_add_message($errors, 'danger');
		}
	}
	public function saveOrderingsAction()
	{
		$orderings = pzk_request()->get('orderings');
		$field = pzk_request()->get('field');
		foreach ($orderings as $id => $val) {
			$entity = _db()->getTableEntity($this->get('table'))->load($id);
			$entity->update(array(
				$field => $val
			));
		}
	}
	public function saveOrderingAction()
	{
		$field = pzk_request()->get('field');
		$id = pzk_request()->get('id');
		$value = pzk_request()->get('value');
		$entity = _db()->getTableEntity($this->get('table'))->load($id);
		$entity->update(array(
			$field => $value
		));
		echo $value;
	}

	public function verifyAction()
	{
		$arr = array();
		echo json_encode($arr);
	}

	public function aliasAction()
	{
		$items = _db()->selectAll()->from($this->get('table'))->whereAlias('')->result();
		foreach ($items as $item) {
			$alias = khongdauAlias(pzk_or(@$item['title'], @$item['name']));
			_db()->update($this->get('table'))
				->set(array('alias' => $alias))
				->whereId($item['id'])->result();
		}
		$this->redirect('index');
	}

	public function duplicateAction($id)
	{
		$entity = _db()->getTableEntity($this->get('table'));
		$entity->load($id);
		$row = $entity->getData();
		unset($row['id']);
		$this->add($row);
		$this->redirect('index');
	}

	public function getGridEditFields()
	{
		return array_diff(_db()->getFields($this->table), array('id', 'software', 'site', 'created', 'creatorId', 'modified', 'modifiedId'));
	}

	public function getGridListFields()
	{
		return array_diff(_db()->getFields($this->table), array('id', 'software', 'site', 'global', 'sharedSoftwares'));
	}

	public function getDefaultEditFieldSettings()
	{
		return PzkEditConstant::gets($this->getGridEditFields(), $this->table);
	}

	public function getDefaultListFieldSettings()
	{
		return PzkListConstant::gets($this->getGridListFields(), $this->table);
	}

	public function alterField(&$fields, $field, $arr = array())
	{

		// Nếu field là một chuỗi
		if (is_string($field)) {
			foreach ($fields as &$f) {
				if ($f['index'] == $field) {
					$f = merge_array($f, $arr);
				}
			}
			// Nếu field là một mảng
		} else if (is_array($field)) {
			foreach ($fields as &$f) {
				foreach ($field as $index => $settings) {
					if ($index == $f['index']) {
						$f = merge_array($f, $settings);
					}
				}
			}
		}
		return $this;
	}

	public function removeField(&$fields, $field)
	{
		foreach ($fields as $index => $f) {
			if ($f['index'] == $field) {
				array_splice($fields, $index, 1);
				break;
			}
		}
		return $this;
	}
	public function exportExcelAction($pageNum, $pageSize)
	{
		$exportFields = $this->exportFields;
		if (!$exportFields) {
			die('access denied');
		}

		//get data;

		$this->initPage()
			->append('admin/' . pzk_or($this->get('customModule'), $this->get('module')) . '/index')
			->append('admin/' . pzk_or($this->get('customModule'), $this->get('module')) . '/menu', 'right');
		$this->prepareListDisplay();
		$grid = pzk_element('list');

		if ($pageNum) {
			$grid->set('pageNum', $pageNum);
		}


		if ($pageSize) {
			$grid->set('pageSize', $pageSize);
		}

		$conditions = pzk_or($grid->get('conditions'), '1');

		$items = $grid->getItems();

		require_once BASE_DIR . '/3rdparty/phpexcel/PHPExcel.php';
		$objPHPExcel = new PHPExcel();
		// Set document properties
		$objPHPExcel->getProperties()->setCreator("Maarten Balliauw")
			->setLastModifiedBy("Maarten Balliauw")
			->setTitle("Office 2007 XLSX Test Document")
			->setSubject("Office 2007 XLSX Test Document")
			->setDescription("Test document for Office 2007 XLSX, generated using PHP classes.")
			->setKeywords("office 2007 openxml php")
			->setCategory("Test result file");
		// Create a new PHPExcel object
		$objPHPExcel->getActiveSheet()->setTitle('data');

		//set heading
		$rowNumber = 1;
		$col = 'A';

		foreach ($exportFields as $heading) {
			//set value col in file excel
			$objPHPExcel->getActiveSheet()->setCellValue($col . $rowNumber, $heading['label']);
			$col++; //A++ -> B
		}

		// lưu data to excel
		$rowNumber = 2;

		foreach ($items as $item) {
			$col = 'A';
			foreach ($exportFields as $val) {
				if ($val['type'] == 'nameid') {
					$findField = $val['findField'];
					$showField = $val['showField'];

					$ids = $item[$val['index']];

					$colValue = '';

					if (is_string($ids) && $ids) {

						$arrIds = explode(',', trim($ids, ','));
						if ($arrIds) {
							$table = $val['table'];
							if (pzk_global()->has('nameid' . $table)) {
								$arrAllField = pzk_global()->get('nameid' . $table);
							} else {
								$arrAllField = _db()->useCache(1800)->select('*')->from($table)->where($conditions)->result();
								pzk_global()->set('nameid' . $table, $arrAllField);
							}

							foreach ($arrAllField as $item) {
								if (in_array($item[$findField], $arrIds)) {
									$colValue .= $item[$showField] . ', ';
								}
							}
							$colValue = substr($colValue, 0, -2);
						}
					} else if (is_int($ids) && $ids) {
						$dataTable = _db()->useCache(1800)->select('*')->from($table)->where(array($findField, $Ids))->where($conditions)->result_one();
						$colValue = $dataTable[$showField];
					}

					$objPHPExcel->getActiveSheet()->setCellValue($col . $rowNumber, $colValue);
				} else {
					$objPHPExcel->getActiveSheet()->setCellValue($col . $rowNumber, $item[$val['index']]);
				}

				$col++;
			}

			$rowNumber++;
		}



		// Freeze pane so that the heading line won't scroll
		$objPHPExcel->getActiveSheet()->freezePane('A2');


		//excel 2003

		// Redirect output to a client’s web browser (Excel5)
		header('Content-Type: application/vnd.ms-excel');
		header('Content-Disposition: attachment;filename="userList.xls"');
		header('Cache-Control: max-age=0');
		// If you're serving to IE 9, then the following may be needed
		header('Cache-Control: max-age=1');

		// If you're serving to IE over SSL, then the following may be needed
		header('Expires: Mon, 26 Jul 1997 05:00:00 GMT'); // Date in the past
		header('Last-Modified: ' . gmdate('D, d M Y H:i:s') . ' GMT'); // always modified
		header('Cache-Control: cache, must-revalidate'); // HTTP/1.1
		header('Pragma: public'); // HTTP/1.0

		$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
		$objWriter->save('php://output');

		exit();
	}
	public function importFileAction()
	{
		require_once BASE_DIR . '/3rdparty/phpexcel/PHPExcel.php';
		$objPHPExcel = new PHPExcel();


		$path = BASE_DIR . '/uploads/filede.xlsx';


		require_once BASE_DIR . '/3rdparty/phpexcel/PHPExcel/Reader/Excel2007.php';
		$objReader = new PHPExcel_Reader_Excel2007();
		//$objReader->setReadDataOnly(true);
		$data = $objReader->load($path);
		$objWorksheet = $data->getActiveSheet();

		$objPHPExcel = PHPExcel_IOFactory::load($path);

		$sheet = $objPHPExcel->getSheet(0);
		$highestRow = $sheet->getHighestRow();
		$highestColumn = $sheet->getHighestColumn();

		//  Loop through each row of the worksheet in turn
		for ($row = 1; $row <= $highestRow; $row++) {
			//  Read a row of data into an array
			$rowData[] = $sheet->rangeToArray(
				'A' . $row . ':' . $highestColumn . $row,
				NULL,
				TRUE,
				FALSE
			);
		}
		debug($rowData);
	}
}
