<?php 
/**
* 
*/
class PzkUserProfileuserleft extends PzkObject
{
	public function loadNote()
	{
			$request=pzk_request();
			$username = pzk_session()->getUsername();
			$note= _db()->selectAll()->fromUser_note()->whereUsername($username)
			->orderBy('id asc')->limit(8)->result();
			return ($note); 
	}
	// Hiển thị tất cả các
	public function loadWriteWall()
	{
			$request=pzk_request();
			$username=pzk_session()->getUsername();
			$sql=" select * from `user_write_wall` where username='".$username."' order by id asc limit 8 ";
			$write_wall= _db()->selectAll()
			->fromUser_write_wall()
			->whereUsername($username)
			->orderBy('id asc')->limit(8)->result();
			return ($write_wall); 
	}
}
 ?>