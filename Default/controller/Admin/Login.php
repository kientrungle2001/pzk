<?php
class PzkAdminLoginController extends PzkController {


    public function indexAction(){
        //$this->layout();

        if(pzk_request()->is('POST')){
            $post = pzk_request()->query;
            $user = $this->fillter($post["username"]);
            $pass = $this->fillter($post["password"]);
			
            $usermodel = pzk_model('Admin');
            $checkLogin = $usermodel->login($user, $pass);
			if(isset($checkLogin)) {
                pzk_session('adminUser', $checkLogin['name']);
                pzk_session('adminId', $checkLogin['id']);
                pzk_session('adminLevel', $checkLogin['level']);
				if(pzk_session('adminLevel') == 'HomeroomTeacher') {
					$this->redirect('Admin_Home_HomeroomTeacher/index');
				} else if(pzk_session('adminLevel') == 'Headmaster') {
					$this->redirect('Admin_Home_Headmaster/index');
				} else if(pzk_session('adminLevel') == 'Teacher') {
					$this->redirect('Admin_Schedule_Teacher/index');
				} else {
					$this->redirect('Admin_Home/index');
				}
                
            }else {
                pzk_notifier_add_message('Tên đăng nhập or mật khẩu không đúng', 'danger');
                $this->redirect('Admin_Login/index');
            }
        }else{
            $view = pzk_parse('<div layout="admin/login/login" />');
            $view->display();
        }
    }

    public function logoutAction(){
        pzk_session('adminUser', false);
        pzk_session('adminId', false);
        pzk_session('adminLevel', false);
        $this->redirect('Admin_Login/index');
    }
    public function fillter($str){
        $str = str_replace("<", "&lt;", $str);
        $str = str_replace(">", "&gt;", $str);
        $str = str_replace("&", "&amp;", $str);
        $str = str_replace("|", "&brvbar;", $str);
        $str = str_replace("~", "&tilde;", $str);
        $str = str_replace("`", "&lsquo;", $str);
        $str = str_replace("#", "&curren;", $str);
        $str = str_replace("%", "&permil;", $str);
        $str = str_replace("'", "&rsquo;", $str);
        $str = str_replace("\"", "&quot;", $str);
        $str = str_replace("\\", "&frasl;", $str);
        $str = str_replace("--", "&ndash;&ndash;", $str);
        $str = str_replace("ar(", "ar&Ccedil;", $str);
        $str = str_replace("Ar(", "Ar&Ccedil;", $str);
        $str = str_replace("aR(", "aR&Ccedil;", $str);
        $str = str_replace("AR(", "AR&Ccedil;", $str);
        return htmlspecialchars($str);
    }

}