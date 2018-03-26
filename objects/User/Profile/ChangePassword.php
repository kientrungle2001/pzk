<?php 

/**
* 
*/
class PzkUserProfileChangePassword extends PzkObject
{
	public $scriptable=true;
	public $css = 'user-info';
	public $layout = 'user/profile/changePassword';
	
	public $LBL_OLD_PASSWORD = 'Mật khẩu cũ';
	public $LBL_NEW_PASSWORD = 'Mật khẩu mới';
	public $LBL_CONFIRM_PASSWORD = 'Xác nhận mật khẩu mới';
	
	public $PLH_OLD_PASSWORD = 'Mật khẩu cũ';
	public $PLH_NEW_PASSWORD = 'Mật khẩu mới';
	public $PLH_CONFIRM_PASSWORD = 'Nhập lại mật khẩu mới';
	
	public $VLD_OLD_PASSWORD = 'Mật khẩu gồm cả chữ cái và chữ số, ít nhất 1 chữ viết hoa, 1 chữ viết thường, 1 số và không chứa khoảng trắng';
	public $VLD_NEW_PASSWORD = 'Mật khẩu mới phải gồm cả chữ cái và chữ số, ít nhất 1 chữ viết hoa, 1 chữ viết thường, 1 số và không chứa khoảng trắng';
	public $VLD_CONFIRM_PASSWORD = 'Nhập lại mật khẩu';
	
	
}
 ?>