<?php 
/**
* 
*/
class PzkUserProfileProfileusercontent extends PzkObject
{
	public $scriptable = true;
	public function loadUserName($member)
	{
		$user=_db()->useCB()->select('user.name as name, user.username as username,user.id as userid, user.avatar as avatar')->from('user')->where(array('id',$member))->result_one();
	
		return $user;

	}
	public function loadUserID($username)
	{
		$user=_db()->useCB()->select('user.name as name, user.username as username,user.id as userid, user.avatar as avatar')->from('user')->where(array('username',$username))->result_one();
	
		return $user;

	}
	/*public function loadNote($member)
	{
			$loadUserName= $this->loadUserName($member);
			$username= $loadUserName['username'];
			$note=_db()->useCB()->select('user_note.*')->from('user_note')->where(array('username',$username))->orderBy('id desc')->limit(6,0)->result();
			return $note; 
	}*/
	
	
	// Hiển thị tất cả các
	public function loadWriteWall($member)
	{
			
			//$username=pzk_session()->getUsername();
			$loadUserName= $this->loadUserName($member);
			$username= $loadUserName['username'];
			$write_wall=_db()->useCB()->select('user_write_wall.*')->from('user_write_wall')->where(array('username',$username))->orderBy('id desc')->limit(3,0)->result();
			
			return $write_wall; 
	}
	/*public function checkWall($check){
		if($check >0){
			echo '<div class="pr_bt_viewmore_c"><a href="/wall/view?member='.$member.'">Xem tất cả</a></div>';
		}
	}*/
	public function checkMember($member)
	{
		$sessionID= pzk_session()->getUserId();
		if($member == $sessionID)
		{
			return '<a class="prf_a" href="/profile/user?member='.$member.'">XEM TẤT CẢ</a> ' ;
		}
		else
		{
			return '<a class="prf_a" href="/profile/member?member='.$member.'">XEM TẤT CẢ</a> ' ;
		}
	}
	/*public function checkAvatar($avatar)
	{
		if($avatar == "")
		{
			$avatar='/default/skin/nobel/ptnn/media/noavatar.gif' ;
		}
		
		return $avatar;
		
	}*/
	
	
}
 ?>