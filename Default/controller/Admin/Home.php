<?php
class PzkAdminHomeController extends PzkAdminController {
	/*nguyenson*/
	function __construct(){
		
		$admin = pzk_session('adminUser') ;
		
		if(!$admin){
			 $this->redirect('Admin_Login/index');
		}
		
		$menu =  pzk_session(MENU, 'admin_home');
	}
	public $masterPage = 'admin/home/index';
	public $masterPosition = 'left';
	public function indexAction() {
		$this->initPage();
		$this->append('admin/home/shortcut');
		$this->display();
	}
	
	public function datagridAction() {
		$this->initPage();
		$this->append('admin/home/datagrid');
		$this->display();
	}
	
	public function jeasyuiAction() {
		$this->render('admin/home/jeasyui');
	}
	
	public function datagridJsonAction() {
		
		$options	=	pzk_request()->getFilterData();
		$datagrid 	= 	pzk_model('Datagrid');
		$result		=	$datagrid->fetchAll($options);
		echo json_encode($result);
	}
}