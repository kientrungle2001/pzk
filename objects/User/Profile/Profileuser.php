<?php 

/**
* 
*/
class PzkUserProfileProfileuser extends PzkObject
{

	
	public function loadUser($member)
	{
		$user=_db()->useCB()->select('user.*')->from('user')->where(array('id',$member))->result_one();
		//$sql="select `user`.name as 'name' ,`user`.username as 'username' ,`user`.id as 'id',`user`.avatar as 'avatar'  FROM `user` WHERE `user`.id = '".$member."'";
		//$user= _db()->query($sql);
		return $user;

	}
	public function countInvitation($member)
	{
		$user=$this->loadUser($member);
		$userinvitation=$user['username'];
		$invi=_db()->useCB()->select('count(*) as invi')->from('invitation')->where(array('userinvitation',$userinvitation))->result_one();
		return $invi;
	}
	public function countFriend($member)
	{
		$user=$this->loadUser($member);
		$username=$user['username'];
		$friend=_db()->useCB()->select('count(*) as friend')->from('friend')->where(array('username',$username))->result_one();
		return $friend['friend'];
	}
	public function loadFriendUser($member)
	{
		$user=$this->loadUser($member);
		$username= $user['username'];
		$friend=_db()->useCB()->select('friend.*')->from('friend')->where(array('username',$username))->limit(3,0)->result();
		return $friend;
	}
	public function loadUserID($username)
	{
		$user=_db()->useCB()->select('user.name as name, user.username as username,user.id as userid, user.avatar as avatar')->from('user')->where(array('username',$username))->result_one();
		//$sql="select `user`.name as 'name' ,`user`.username as 'username' ,`user`.id as 'id',`user`.avatar as 'avatar'  FROM `user` WHERE `user`.id = '".$member."'";
		//$user= _db()->query($sql);
		return $user;

	}
	public function testAvatar($member)
	{
		$user=$this->loadUser($member);
		$avatar= $user['avatar'];
		if($avatar == "")
		{
			$avatar='/default/skin/nobel/ptnn/media/noavatar.gif' ;
		}
		
		return $avatar;
		
	}
	public function checkMember($member)
	{
		$sessionID= pzk_session('userId');
		if($member == $sessionID)
		{
			return '<a class="prf_a" href="/favorite/lessonfavorite?member='.$member.'">Bài học yêu thích</a> ' ;
		}
		else
		{
			 return '<a class="prf_a" href="/favorite/lessonfavoritemember?member='.$member.'">Bài học yêu thích</a> ' ;
		}
	}

	public function hash() {
		return md5($this->get('id') . pzk_session()->get('username'));
	}
	
}
 ?>