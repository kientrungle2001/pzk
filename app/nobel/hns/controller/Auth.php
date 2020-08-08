<?php
class PzkAuthController extends PzkController {
    public function __construct() {
        $admin = pzk_session()->getAdminUser() ;
        $level = pzk_session()->getAdminLevel() ;
        if(!$admin && ($level != 'admin')) {
            $this->redirect('admin_login/index');
        }

    }
}
?>