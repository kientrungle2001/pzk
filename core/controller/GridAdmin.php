<?php
class PzkGridAdminController extends PzkAdminController {
	public $masterStructure 		= 'admin/home/index';
	public $masterPosition 			= 'left';
	public $customModule 			= 'grid';
    public $moduleDetail 			= FALSE;
	public $table 					= false;
	public $joins 					= false;
	public $filterCreator 			= false;
	public $selectFields 			= '*';
	public $childTables 			= false;
	public $addFieldSettingTabs 	= false;
	public $editFieldSettingTabs 	= false;
	public $filterFields 			= false;
	public $quickFilterFields 		= false;
	public $links 					= false;
	public $listSettingType 		= false;
	public $listFieldSettings 		= array ();
	public $addLabel 				= 'Thêm bản ghi';
	public $addFields 				= false;
	public $addFieldSettings 		= array ();
	public $editFields				= false; 
	public $editFieldSettings 		= array ();
	public $searchFields 			= array ();
	public $searchLabels 			= false;
	public $filterFieldSettings 	= array ();
	
	public $sortFields 				= array ();
	public $exportFields 			= false;
	public $exportTypes 			= false;
	public $importFields 			= false;
	public $actions 				= array();
	public $title 					= false;
	public $editLabel 				= false;
	public $fixedPageSize 			= false;
	public $orderBy 				= false;
    //update menu
    public $updateData 				= false;
	public $updateDataTo 			= false;
	public $updateForms 			= array();
	public $quickMode 				= false;
	public $quickFieldSettings 		= false;
	public $detailFields 			= false;
	public $viewFieldSettings 		= false;
	public $childrenGridSettings 	= false;
	public $parentDetailSettings 	= false;
	
	// layout of grid
	public $gridLayout 				= false;
	
	public function append($obj, $position = NULL) {
		$obj = $this->parse ( $obj );
		$obj->set ('table',  $this->table );
		return parent::append ( $obj, $position );
	}
	public function prepareListDisplay() {
		$request = pzk_request();
		$grid = pzk_element ( 'list' );
		if ($grid) {
			$grid->set('sortFields', $this->get('sortFields'));
			$grid->set('fields', $this->get('filterFields'));
			$grid->set('searchFields', $this->get('searchFields'));
			$grid->set('searchLabels', $this->get('searchLabels'));
			$grid->set('listSettingType', $this->get('listSettingType'));
			$grid->set('listFieldSettings', $this->get('listFieldSettings'));
			$grid->set('exportFields', $this->get('exportFields'));
			$grid->set('exportTypes', $this->get('exportTypes'));
			$grid->set('module', $this->get('module'));
			$grid->set('quickMode', $this->get('quickMode'));
			$grid->set('quickFieldSettings', $this->get('quickFieldSettings'));
			$parentMode = $request->get('parentMode');
			if($parentMode) {
				$parentId = $request->get('parentId');
				$parentField = $request->get('parentField');
				$grid->set('parentMode', true);
				$grid->set('parentField', $parentField);
				$grid->set('parentId', $parentId);
				$grid->init();
			}
			$grid->set('columnDisplay',$this->getSession()->get('columnDisplay'));
			
			//set links
			$grid->set('links', $this->get('links'));

			//check admin level action
			$level = pzk_session('adminLevel');
			if($level == 'Administrator') {
				$grid->set('checkAdd', true);
				$grid->set('checkEdit', true);
				$grid->set('checkDel', true);
				$grid->set('checkDialog', true);
			}else {
				$controller = pzk_request('controller');
				$adminmodel = pzk_model('Admin');
				$checkAdd = $adminmodel->checkActionType('add', $controller, $level);
				$checkEdit = $adminmodel->checkActionType('edit', $controller, $level);
				$checkDel = $adminmodel->checkActionType('del', $controller, $level);
				$checkDialog = $adminmodel->checkActionType('dialog', $controller, $level);
				if($checkAdd) {
					$grid->set('checkAdd', true);
				}
				if($checkEdit) {
					$grid->set('checkEdit', true);
				}
				if($checkDel) {
					$grid->set('checkDel', true);
				}
				if($checkDialog) {
					$grid->set('checkDialog', true);
				}
			}



			if ($this->get('exportFields')) {
				$grid->set('exportFields', $this->get('exportFields'));
			}
			$orderBy = false;
			if($orderBys = $this->getSession()->get('orderBys')) {
				$orderByArr = array();
				$orderByIndexes = array();
				foreach($orderBys as $field => $order) {
					$orderByArr[] = $field . ' ' . $order;
					$orderByIndexes[$field] = ($order == 'asc')? 1: 2;
				}
				$orderBy = implode(', ', $orderByArr);
				$grid->set('orderBys', $orderBys);
				$grid->set('orderByIndexes', $orderByIndexes);
				
			}
			if(!$orderBy) {
				$orderBy = $this->getSession()->get('orderBy');
			}
			
			$orderBy = $orderBy ? $orderBy : $this->get('orderBy');
			
			if ($orderBy) {
				$grid->set('orderBy', $orderBy);
			}
			
			// joins
			if ($this->get('joins')) {
				$grid->set('joins', $this->get('joins'));
			}
            
			//filterCreator
			if ($this->get('filterCreator') && pzk_session()->get('adminLevel') == 'Reseller') {
                $grid->addFilter( array('column', $this->get('table'), 'creatorId') , pzk_session()->get('adminId'));
            }
			
			//set index owner
			$adminmodel = pzk_model('Admin');
			$controller = pzk_request('controller');
			 
			$checkIndexOwner = $adminmodel->checkActionType('indexOwner', $controller, pzk_session('adminLevel'));
			
			if($checkIndexOwner){
				 $grid->addFilter( array('column', $this->get('table'), 'creatorId') , pzk_session()->get('adminId'));
			}
			
			
			// select fields
			if ($this->get('selectFields')) {
				$grid->set('fields', $this->get('selectFields'));
			}
			// filter
			if(pzk_session()->get('adminLevel') == 'Reseller') {
				$childResellers = _db()->select('*')->from('admin')->where(array('parent', pzk_session('adminId')))->result();
				
				if(count($childResellers)) {
					$childIds	=	array(pzk_session('adminId'));
					foreach($childResellers as $reseller){
						$childIds[]= $reseller['id'];
					}
					$grid->addFilter ( array('column', $this->get('table'), 'resellerId') , $childIds , 'in');
				} else {
					$grid->addFilter ( array('column', $this->get('table'), 'resellerId') , pzk_session('adminId') , 'equal');
				}
				
			}
			
			if ($this->get('filterFields')) {
				$fields = $this->get('filterFields');
				$listFieldSettings = $this->get('listFieldSettings');
				foreach($listFieldSettings as $listFieldSetting) {
					if(isset($listFieldSetting['filter'])) {
						$found = false;
						foreach($fields as $filterField) {
							if($filterField['index'] == $listFieldSetting['filter']) {
								$found = true;
								break;
							}
						}
						if(!$found) {
							$fields[]	= $listFieldSetting['filter'];
						}
					}
					
				}
				foreach ( $fields as $val ) {
					if(isset($val['index']) && $val['index']) {
						$value = $this->getFilterSession()->get($val ['index']);
						if (isset ( $value ) && $value != NUll) {
							if($val['index'] === 'created'){
								$condition1 = date('Y:m:d 00:00:00', $_SERVER['REQUEST_TIME']+24*60*60);
								$condition2 = date('Y:m:d 00:00:00', $_SERVER['REQUEST_TIME']);
								$condition3 = date('Y:m:d 00:00:00', $_SERVER['REQUEST_TIME']-24*60*60);
								if($value === '1'){
									$grid->addFilter ( array('column', $this->get('table'), $val ['index']) , $condition1 , 'lt');
									$grid->addFilter ( array('column', $this->get('table'), $val ['index']) , $condition2 , 'gt');
								}if($value === '2'){
									$grid->addFilter ( array('column', $this->get('table'), $val ['index']) , $condition2 , 'lt');
									$grid->addFilter ( array('column', $this->get('table'), $val ['index']) , $condition3 , 'gt');
								}
							}elseif (isset($val['like']) && $val['like'] == true) {
								$grid->addFilter ( array('column', $this->get('table'), $val ['index']) , $value, 'like');
							}
							else{
								$grid->addFilter ( array('column', $this->get('table'), $val ['index']) , $value );
							}
						}
					}
				}
			}
			// end filter
			$pageSize = pzk_or(@$this->get('fixedPageSize'), $this->getSession()->get('pageSize'));
			if ($pageSize) {
				$grid->set('pageSize', $pageSize);
			}
			$requestPageNum = pzk_request()->get('page');
			$sessionPageNum = $this->getSession()->get('pageNum');
			if($requestPageNum != '') {
				$sessionPageNum = $requestPageNum;
				$this->getSession()->set('pageNum', $sessionPageNum);
			} else {
				pzk_request()->set('page', $sessionPageNum);
			}
			$grid->set('pageNum', $sessionPageNum);
			
			$keyword = $this->getSession()->get('keyword');
			$grid->set('keyword', $keyword);
			$grid->set('module', $this->get('module'));
			$grid->set('title', $this->get('title'));
			$grid->set('addLabel', $this->get('addLabel'));
			$grid->set('actions',$this->get('actions'));
			$grid->set('layout', 'admin/grid/index/view/'. pzk_or($this->gridLayout, 'grid'));
			if(pzk_request()->get('isAjax')) {
				$grid->display();
				pzk_system()->halt();
			}
			$nav = pzk_element('nav');
			//set update one field
			$nav->set('updateData', $this->get('updateData'));
			$nav->set('updateDataTo', $this->get('updateDataTo'));

			$nav->set('title', $this->get('title'));
			$nav->set('sortFields', $this->get('sortFields'));
			$nav->set('filterFields', $this->get('filterFields'));
			$nav->set('searchFields', $this->get('searchFields'));
			$nav->set('searchLabels', $this->get('searchLabels'));
			$nav->set('orderBy', $orderBy);
			$nav->set('keyword', $keyword);
			$nav->set('module', $this->get('module'));
			$nav->set('quickMode', $this->get('quickMode'));
			
			$filter = pzk_element('filter');
			$filter->set('filterFields', $this->get('quickFilterFields'));
			
			$updateForms = $this->get('updateForms');
			foreach($updateForms as $formSettings) {
				$formObject = pzk_obj('core.form');
				$formObject->setData($formSettings);
				$nav->append($formObject);
			}
			
			$export = pzk_element('export');
			$export->set('exportTypes', $this->get('exportTypes'));
			$export->set('exportFields', $this->get('exportFields'));
			$export->set('module', $this->get('module'));
			$export->set('quickMode', $this->get('quickMode'));
		}
	}
	public function getQuickMode() {
		$quickMode = $this->getSession()->get('quickMode');
		if($quickMode) return $quickMode;
		return $this->quickMode;
	}
	public function changeStatusAction() {
		$id = pzk_request()->get('id');
		$field = pzk_request()->get('field');
		if (! $field)
			$field = 'status';
		$entity = _db ()->getTableEntity ( $this->get('table') )->load ( $id );
		$status = 1 - $entity->get($field);
		$entity->update ( array (
				$field => $status 
		) );
		if(pzk_request()->get('isAjax')) {
			echo $status;
		} else {
			$this->redirect('index');
		}
		
	}
	public function columnDisplayAction() {
		$request = pzk_request();
		$columnDisplay = $request->get('columnDisplay');
		$this->getSession()->set('columnDisplay', $columnDisplay);
		if($request->get('isAjax')) {
			echo $status;
		} else {
			$this->redirect('index');
		}
		
	}
    public function updateOneFieldAction() {
        if(pzk_request('ids')) {
            $arrIds = json_decode(pzk_request('ids'));
            $field = pzk_request('field');
            $data = pzk_request('data');
            $type = pzk_request('type');

            if($type == 'mutiSelect' or $type == 'multiselectoption') {
                if($data[$field]) {
                    $strCateIds = ','.implode(',', $data[$field]).',';
                }else{
                    $strCateIds = '';
                }
            }elseif($type == 'select') {
                if($data[$field]) {
                    $strCateIds =  $data[$field];
                }else{
                    $strCateIds = '';
                }
            } else {
				if($data[$field]) {
                    $strCateIds =  $data[$field];
                }else{
                    $strCateIds = '';
                }
			}

            if(count($arrIds) >0) {
                
				_db()->update($this->table)->set(array($field => $strCateIds))->where(array('in', 'id', $arrIds))->result();
				
                echo 1;
            }

        }else {
            pzk_system()->halt();
        }
    }
	public function updateDataToAction() {
		if(pzk_request('ids')) {
			$arrIds = json_decode(pzk_request('ids'));

			$data = pzk_request('data');
			$formIndex = $data['index'];

			$updateDataTo = $this->get('updateDataTo');
			foreach($updateDataTo as $val) {
				if($val['index'] == $formIndex){
					$table = $val['table'];
					$selectField = $val['selectField'];
					break;
				}
			}

			if(count($arrIds) >0) {
				foreach($arrIds as $id) {
					foreach ($selectField as $key=>$val) {
						if($key == 'id') {
							$data[$val] = $id;
						}else{
							$entity = _db()->getTableEntity($this->get('table'))->load($id);
							$data[$val] = $entity->data[$key];
						}
					}
					unset($data['index']);
					$data['createdId'] = pzk_session()->get('adminId');
					$data['creatorId'] = pzk_session()->get('adminId');
					$data['created'] = date(DATEFORMAT, $_SERVER['REQUEST_TIME']);
					$entityInsert = _db()->getTableEntity($table);
					$entityInsert->setData($data);
					$entityInsert->save();
				}
				echo 1;
			}

		}else {
			pzk_system()->halt();
		}
	}
	public function workflowAction() {
		$id = pzk_request()->get('id');
		$field = pzk_request() ->get('field');
		$value = pzk_request()->get('value');
		if (! $field)
			$field = 'status';
		$entity = _db()->getTableEntity($this->get('table'))->load( $id );
		$oldValue = $entity->data[$field];
		$fieldSettings = null;
		foreach ($this->get('listFieldSettings') as $fs) {
			if($fs['index'] == $field) {
				$fieldSettings = $fs;
				break;
			}
		}
		$rules = $fieldSettings['rules'];
		$states = $fieldSettings['states'];
		$rule = $rules[$oldValue][$value];
		if(isset($rule['adminLevel'])) {
			$adminLevel = pzk_session()->get('adminLevel');
			$adminLevels = explodetrim(',', $rule['adminLevel']);
			if($adminLevel != 'Administrator' &&  !in_array($adminLevel, $adminLevels)) {
				pzk_notifier_add_message('Bạn không có quyền thay đổi dữ liệu này', 'danger');
				$this->redirect('index');
				return ;
			}
		}
		if(isset($rule['model'])) {
			$model = $rule['model'];
			$handler = $rule['handler'];
			$modelObj = pzk_model($model);
			$modelObj->$handler($entity, $value);	
		}
		
		$entity->update ( array (
				$field => $value
		) );
		if(pzk_request()->get('isAjax')) {
			$nextRules = $rules[$value];
			$curState = $states[$value];
			echo '<option value="'.$value.'">' . $curState . '</option>';
			foreach ($nextRules as $state => $setting) {
				echo '<option value="'.$state.'"> -&gt; ' . $setting['action'] . '</option>';
			}
		} else {
			$this->redirect('index');
		}
		
	}
	
	public function importPostAction() {
		$username = pzk_session ( )->get('adminUser');
		if (isset ( $username )) {
			$username = pzk_session ()->get('adminUser');
		} else {
			$this->redirect('admin_home/index');
		}
		$setting = pzk_controller ();
		if (empty ( $setting->importFields )) {
			$this->redirect('admin_home/index');
		}
		
		if (isset ( $_GET ['token'] )) {
			$token = $_GET ['token'];
		} else {
			$this->redirect('admin_home/index');
		}
		if (isset ( $_GET ['time'] )) {
			$time = $_GET ['time'];
		} else {
			$this->redirect('admin_home/index');
		}
		
		if ($token == md5 ( $time . $username . SECRETKEY )) {
			// upload
			if (! empty ( $_FILES ['file'] ['name'] )) {
				$allowed = array (
						'csv',
						'xlsx',
						'xls' 
				);
				$dir = BASE_DIR . "/tmp/";
				$fileParts = pathinfo ( $_FILES ['file'] ['name'] );
				// Kiem tra xem file upload co nam trong dinh dang cho phep
				if (in_array ( $fileParts ['extension'], $allowed )) {
					// Neu co trong dinh dang cho phep, tach lay phan mo rong
					$tam = explode ( '.', $_FILES ['file'] ['name'] );
					$ext = end ( $tam );
					$renamed = md5 ( rand ( 0, 200000 ) ) . '.' . "$ext";
					
					move_uploaded_file ( $_FILES ['file'] ['tmp_name'], $dir . $renamed );
				} else {
					// FIle upload khong thuoc dinh dang cho phep
					pzk_system()->halt ( "File upload không thuộc định dạng cho phép!" );
				}
			}
			
			// load file
			$path = $dir . $renamed;
			if (! is_file ( $path )) {
				pzk_system()->halt ( 'file not exist' );
			}
			require_once BASE_DIR . '/3rdparty/phpexcel/PHPExcel.php';
			
			$host = _db ()->host;
			$user = _db ()->user;
			$password = _db ()->password;
			$db = _db ()->dbName;
			// connect database
			$dbc = mysqli_connect ( $host, $user, $password, $db );
			
			if (! $dbc) {
				trigger_error ( "Could not connect to DB: " . mysqli_connect_error () );
			} else {
				mysqli_set_charset ( $dbc, 'utf8' );
			}
			
			$objPHPExcel = PHPExcel_IOFactory::load ( $path );
			
			$sheet = $objPHPExcel->getSheet ( 0 );
			$highestRow = $sheet->getHighestRow ();
			$highestColumn = $sheet->getHighestColumn ();
			
			// Loop through each row of the worksheet in turn
			for($row = 1; $row <= $highestRow; $row ++) {
				// Read a row of data into an array
				$rowData = $sheet->toArray ( 'A' . $row . ':' . $highestColumn . $row, NULL, TRUE, FALSE );
			}
			$table = mysqli_real_escape_string ( $dbc, $setting->table );
			$importFields = implode ( ',', $setting->importFields );
			$cols = mysqli_real_escape_string ( $dbc, $importFields );
			$arrfields = explode ( ',', $importFields );
			
			unset ( $rowData [0] );
			// combine array
			if ($rowData) {
				foreach ( $rowData as $item ) {
					$arrWhere [] = array_combine ( $arrfields, $item );
				}
				
				$where = '';
				foreach ( $arrWhere as $item ) {
					foreach ( $item as $key => $val ) {
						$val = mysql_escape_string ( $val );
						$where .= "$key = " . "'$val'" . " AND ";
					}
					$where = substr ( $where, 0, - 4 );
					$sql = "SELECT id from {$table} WHERE {$where}";
					$result = mysqli_query ( $dbc, $sql );
					if (mysqli_errno ( $dbc )) {
						$message = 'Invalid query: ' . mysqli_error ( $dbc ) . "\n";
						$message .= 'Whole query: ' . $sql;
						pzk_system()->halt ( $message );
					}
					$row = mysqli_fetch_assoc ( $result );
					if ($row) {
						$vals = array ();
						foreach ( $item as $key => $value ) {
							$vals [] = '`' . $key . '`=\'' . mysql_escape_string ( $value ) . '\'';
						}
						$values = implode ( ',', $vals );
						$sql = "update {$table} set $values where id = " . $row ['id'] . "";
						mysqli_query ( $dbc, $sql );
						if (mysqli_errno ( $dbc )) {
							$message = 'Invalid query: ' . mysqli_error ( $dbc ) . "\n";
							$message .= 'Whole query: ' . $sql;
							pzk_system()->halt ( $message );
						}
					} else {
						
						$columns = explode ( ',', $cols );
						$list = '';
						foreach ( $columns as $col ) {
							$col = trim ( $col );
							$col = str_replace ( '`', '', $col );
							$list .= ',' . "'" . mysql_escape_string ( $item [$col] ) . "'";
						}
						$list = substr ( $list, 1 );
						$sql = "INSERT INTO {$table}($cols)  VALUES ($list)";
						mysqli_query ( $dbc, $sql );
						if (mysqli_errno ( $dbc )) {
							$message = 'Invalid query: ' . mysqli_error ( $dbc ) . "\n";
							$message .= 'Whole query: ' . $sql;
							pzk_system()->halt ( $message );
						}
					}
					$where = '';
				}
			}
			if (is_file ( $path )) {
				unlink ( $path );
			}
			$url = "/admin_" . $setting->module . "/index";
			pzk_notifier_add_message ( 'Import thành công!', 'success' );
			header ( "location: $url" );
			exit ();
		}
	}
	public function highchartAction() {
		$this->initPage ();
		$this->append ( 'admin/' . pzk_or ( $this->get('customModule'), $this->get('module') ) . '/highchart' )
		->append ( 'admin/' . pzk_or ( $this->customModule, $this->module ) . '/menu', 'right' );
		$this->display ();
	}

    public function detailAction($id) {
    	$module = false;
    	if($this->moduleDetail) {
    		$module = $this->parse('admin/'. pzk_or ( $this->get('customModule'), $this->get('module') ).'/'.$this->moduleDetail.'/detail');
    	} else if(pzk_app()->existsPageUri('admin/'. $this->get('module') .'/detail')) {
    		$module = $this->parse('admin/'. $this->get('module') .'/detail');
    	} else if(pzk_app()->existsPageUri('admin/'. $this->get('customModule') .'/detail')) {
    		$module = $this->parse('admin/'. $this->get('customModule') .'/detail');
    	}
        if(!$module) {
        	$this->redirect('index');
        }
        $module->set('itemId', $id);
        $this->initPage()
            ->append($module)
            ->append('admin/'.pzk_or($this->get('customModule'), $this->get('module')).'/menu', 'right');
        if($childList = pzk_element(pzk_or($this->get('customModule'), $this->get('module')).$this->moduleDetail.'Children')){
            $childList->set('parentId', $id);
        }
        $this->display();
    }
	
	public function orderBysAction() {
		$this->getSession()->set('orderBys', pzk_request()->get('orderBys'));
		echo json_encode(pzk_request()->get('orderBys'));
	}
	
	public function dialogAction() {
		$id = pzk_request()->get('id');
		$module = $this->parse('admin/'.pzk_or($this->get('customModule'), $this->get('module')).'/edit');
		$module->set('table', $this->get('table'));
		$module->set('itemId', $id);
		$module->set('module', $this->get('module'));
		$module->set('fieldSettings', $this->get('editFieldSettings'));
		$module->set('actions', $this->get('editActions'));
		$module->display();
	}
	
	public function inlineEditPostAction() {
		$id = pzk_request ( )->get('id');
		$field = pzk_request ( ) ->get('field');
		$value = pzk_request()->get('value');
		$entity = _db ()->getTableEntity ( $this->get('table') )->load ( $id );
		if($entity->get('id')) {
			if($this->get('logable')) {
				$logEntity = _db()->getTableEntity('admin_log');
				$logFields = explodetrim(',', $this->get('logFields'));
				$brief = pzk_session()->get('adminUser') . ' Sửa bản ghi: ' . $this->get('module');
				$brief .= '[id: '.$entity->get('id').'][' . $field . ': ' . $entity->get($field) . ']';
				$brief .= ' thành ';
				$brief .= '[id: '.$entity->get('id').'][' . $field . ': ' . $value . ']';
				$logEntity->set('userId', pzk_session()->get('adminId'));
				$logEntity->set('created', date('Y-m-d H:i:s'));
				$logEntity->set('actionType', 'edit');
				$logEntity->set('admin_controller', 'admin_'.$this->get('module'));
				$logEntity->set('brief', $brief);
				$logEntity->save();
			}
			
			$entity->update ( array (
					$field => $value
			) );
			echo '1';
		} else {
			echo '0';
		}
	}
	
	public function changeQuickModeAction() {
		$quickMode = $this->getSession()->get('quickMode');
		$quickMode = !$quickMode;
		$this->getSession()->set('quickMode', $quickMode);
		$this->redirect('index');
	}
	
	public function viewAction($id, $gridIndex) {
		$this->initPage();
		$module = false;
    	if($this->moduleDetail) {
    		$module = $this->parse('admin/'. pzk_or ( $this->get('customModule'), $this->get('module') ).'/'.$this->moduleDetail.'/view');
    	} else if(pzk_app()->existsPageUri('admin/'. $this->get('module') .'/view')) {
    		$module = $this->parse('admin/'. $this->get('module') .'/view');
    	} else if(pzk_app()->existsPageUri('admin/'. $this->get('customModule') .'/view')) {
    		$module = $this->parse('admin/'. $this->get('customModule') .'/view');
    	} else {
			$module = $this->parse('admin/grid/view');
		} 
		
        $module->set('itemId', $id);
		$module->set('fieldSettings', pzk_or($this->get('viewFieldSettings'), $this->get('listFieldSettings')));
		$module->set('joins', $this->get('joins'));
		$module->set('fields', pzk_or($this->get('detailFields'), '`'.$this->get('table') . '`.*'));
		$module->set('listSettingType', $this->get('listSettingType'));
		$module->set('childrenGridSettings', $this->get('childrenGridSettings'));
		$module->set('parentDetailSettings', $this->get('parentDetailSettings'));
        $module->set('module', $this->get('module'));
		$module->set('gridIndex', $gridIndex);
		
		$childrenGridSettings = $module->get('childrenGridSettings');
		$gridIndex = $module->get('gridIndex');
		$selectedGridSettings = null;
		$grid = null;
		
		
		if($childrenGridSettings):
			foreach($childrenGridSettings as $gridSettings):
				if($gridIndex == $gridSettings['index']):
					$selectedGridSettings = $gridSettings;
					break;
				endif;
			endforeach;
			if($selectedGridSettings):
				$grid = pzk_parse('default/pages/admin/grid/index');
				foreach($selectedGridSettings as $key => $val) {
					$grid->set($key, $val);
				}
				$grid->set('layout', 'admin/grid/index/view/grid');
				$grid->set('parentMode', true);
				$grid->set('parentId', $id);
				$grid->init();
				$nav = pzk_element('nav');
				$nav->set('module', $selectedGridSettings['module']);
				$nav->set('sortFields', @$selectedGridSettings['sortFields']);
			endif;
		endif;
		
		$parentDetailSettings = $module->get('parentDetailSettings');
		$gridIndex = $module->get('gridIndex');
		$selectedDetailSettings = null;
		$detail = null;
		
		
		if($parentDetailSettings):
			foreach($parentDetailSettings as $detailSettings):
				if($gridIndex == $detailSettings['index']):
					$selectedDetailSettings = $detailSettings;
					break;
				endif;
			endforeach;
			if($selectedDetailSettings):
				$detail = pzk_parse('default/pages/admin/grid/view');
				$detail->set('module', $this->get('module'));
				$detail->set('isChildModule', true);
				foreach($selectedDetailSettings as $key => $val) {
					$detail->set($key, $val);
				}
				$detail->set('parentMode', true);
			endif;
		endif;
		
		$module->set('parentDetail', $detail);
		$module->set('childGrid', $grid);
		
            $this->append($module)
            ->append('admin/'.pzk_or($this->get('customModule'), $this->get('module')).'/menu', 'right');
		if(pzk_request()->get('isAjax')) {
			$module->display();
		} else {
			$this->display();
		}
        
	}
}