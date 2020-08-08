<?php 

/**
* 
*/
class PzkUserProfileAllinfor extends PzkObject
{
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
}
 ?>