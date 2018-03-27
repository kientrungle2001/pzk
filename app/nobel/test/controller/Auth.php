<?php
class PzkAuthController extends PzkController {
    public function __construct() {
        $admin = pzk_session('adminUser') ;
        $level = pzk_session('adminLevel') ;
        if(!$admin && ($level != 'admin')) {
            $this->redirect('admin_login/index');
        }

    }
}
?>