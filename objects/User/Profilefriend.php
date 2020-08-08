<?php 
/**
* 
*/
class PzkUserProfilefriend extends PzkObject
{
	// Hiển thị tất cả các ghi chép cá nhân
	public function loadNote()
	{
			$request=pzk_request();
			$username= mysql_escape_string($request->get('member'));
			$note= _db()->selectAll()->fromUser_note()->whereUsername($username)->orderBy('id asc')->limit(8)->result();
			return ($note); 
	}
	// Hiển thị tất cả các
	public function loadWriteWall()
	{
			$request=pzk_request();
			$username= mysql_escape_string($request->get('member'));
			$write_wall= _db()->selectAll()->fromUser_write_wall()
			->whereUsername($username)->orderBy('id asc')->limit(8)->result();
			return ($write_wall); 
	}
}
 ?>