<?php 

/**
* 
*/
class PzkUserProfileDetail extends PzkObject
{
	public $css = 'user-info';
	public $layout = 'user/profile/detail';
	public function checkIdFacebook() {
		$user=_db()->useCB()->select('user.*')->from('user')->where(array('id',pzk_session()->getUserId()))->result_one();
		$idfb = $user['idFacebook'];
		$email = $user['email'];
		$password = $user['password'];
		$idGo = $user['idGoogle'];
		$check='';
		if($idfb){
			if(!$email || !$password){
				$check='<div class="editinfor_title"><a href="/editinfor/addinfor"><span class="txt_editinfor_title">BỔ XUNG THÔNG TIN TÀI KHOẢN</span> <br></a><span class="txt_editinfor_note">(Sau khi đăng nhập bằng tài khoản Facebook, bạn vui lòng bổ xung Email, Tài khoản đăng nhập, mật khẩu để lần truy cập sau bạn có thể đăng nhập trực tiếp bằng tài khoản của NextNobels)</span></div>';
			}
			return $check;
		}
		if($idGo){
			if(!$password){
				$check='<div class="editinfor_title"><a href="/editinfor/addinforgoogle"><span class="txt_editinfor_title">BỔ XUNG THÔNG TIN TÀI KHOẢN </span> <br></a><span class="txt_editinfor_note">(Sau khi đăng nhập bằng tài khoản Google, bạn vui lòng bổ xung Tài khoản đăng nhập, mật khẩu để lần truy cập sau bạn có thể đăng nhập trực tiếp bằng tài khoản của NextNobels)</span></div>';
			}
			return $check;
		}
		
	}
	public function checkSex($sex){
		if($sex=='1'){
			echo "Nam";
		}else if($sex=='0'){
			echo "Nữ";
		}
	}
	public function  getTestByUserId($userId) {
        $software = pzk_request()->getSoftwareId();
        $data = _db()->useCB()->select('ub.id, ub.startTime, ub.userId, ub.mark, ub.duringTime, ub.testId, u.username, t.name')
            ->from('user_book ub')
            ->join('user u', 'ub.userId = u.id', 'left')
            ->join('tests t', 'ub.testId = t.id', 'left')
            ->where(array('equal','userId',$userId))
            ->where('ub.testId != 0')
            ->where(array('equal','software',$software))
            ->orderBy('ub.id desc')
            ->limit($this->pageSize, $this->pageNum);
        return $data->result();
    }

    public function countTestByUserId($userId) {
        $software = pzk_request()->getSoftwareId();
        $row = _db()->useCB()->select('count(*) as c')
            ->from('user_book ub')
            ->from('user_book ub')
            ->join('user u', 'ub.userId = u.id', 'left')
            ->join('tests t', 'ub.testId = t.id', 'left')
            ->where(array('equal','userId',$userId))
            ->where(array('equal','software',$software))
            ->where('ub.testId != 0');

        $row = $row->result_one();
        return $row['c'];
    }
	
}
 ?>