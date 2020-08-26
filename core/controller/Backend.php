<?php
class PzkBackendController extends PzkController
{
	public $masterStructure = 'admin/home/index';
	public $masterPosition = 'left';
	
    //config level action
    public $allowIndex = array('index', 'changeStatus', 'changeOrderBy', 'filter', 'changePageSize', 'searchPost', 'changeQuickMode', 'searchFilter','search','uploadPost', 'saveOrderings', 'saveOrdering', 'updateOneField','changeView', 'columnDisplay', 'changeColumns', 'orderBys', 'read', 'view', 'verify');
    public $allowEdit = array('edit', 'editAllCatePost', 'editPost', 'edit_tnPost', 'edit_tn20Post', 'changeStoreType', 'writePost', 'command', 'importQuestions', 'importQuestionsPost', 'previewImportQuestions', 'workflow', 'edit_tlPost', 'inlineEdit');
    public $allowDel = array('del','delPost', 'delAll');
    public $allowDetails = array('details', 'updatePost');
	public $allowAdd = array('add', 'addPost', 'makePayment', 'detail', 'detailFull', 'makeContestPayment', 'makeViewPayment');

    public function __construct() {
		parent::__construct();
        $admin = pzk_session('adminUser') ;
        $level = pzk_session('adminLevel') ;

        if(!$admin) {
            $this->redirect('Admin_Login/index');
        }
        elseif($admin && ($level=='Administrator' || $level=='Headmaster' || $level =='Teacher' || $level =='HomeroomTeacher')) {
        }
        else {
            $controller = pzk_request()->getController();
            $action = pzk_request()->getAction();
            if(isset($action) && $action != 'index') {

                $adminmodel = pzk_model('Admin');
		
                $arrAlow = array();
                $checkIndex = $adminmodel->checkActionType('index', $controller, $level);
                $checkEdit = $adminmodel->checkActionType('edit', $controller, $level);
				$checkAdd = $adminmodel->checkActionType('add', $controller, $level);
                $checkDel = $adminmodel->checkActionType('del', $controller, $level);
                $checkDetails = $adminmodel->checkActionType('details', $controller, $level);
               
                if($checkIndex) {
                    $arrAlow = array_merge($arrAlow, $this->isAllowIndex());
                }
                if($checkDetails) {
                    $arrAlow = array_merge($arrAlow, $this->isAllowDetails());
                }
                if($checkEdit) {
                    $arrAlow = array_merge($arrAlow, $this->isAllowEdit());
                }
                if($checkDel) {
                    $arrAlow = array_merge($arrAlow, $this->isAllowDel());
                }
				if($checkAdd) {
                    $arrAlow = array_merge($arrAlow, $this->isAllowAdd());
                }
				
                if(!in_array($action, $arrAlow)) {
                    $checkAction = $adminmodel->checkActionType($action, $controller, $level);

                    if (!$checkAction) {

                        $view = pzk_parse('<div layout="erorr/erorr" />');
                        $view->display();
                        pzk_system()->halt();
                    }
                }
            }
            else {
                $adminmodel = pzk_model('Admin');
                $checkLogin = $adminmodel->checkAction($controller, $level);
                if(!$checkLogin) {
                    $view = pzk_parse('<div layout="erorr/erorr" />');
                    $view->display();
                    pzk_system()->halt();
                }
            }
        }

    }
	
	public function isAllowAdd() {
		return $this->allowAdd;
	}
	
	public function isAllowEdit() {
		return $this->allowEdit;
	}
	
	public function isAllowIndex() {
		return $this->allowIndex;
	}
	
	public function isAllowDel() {
		return $this->allowDel;
	}
	
	public function isAllowDetails() {
		return $this->allowDetails;
	}
}
?>