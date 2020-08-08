<?php 
/**
* 
*/
class pzkCommunicationFriendFriendlistuser extends PzkObject
{
	public $num_record= 5;
	public $userId = false;
	
	public function loadUserName($member)
	{
		$user=_db()->useCB()->select('user.name as name, user.username as username,user.id as userid, user.avatar as avatar')->from('user')->where(array('id',$member))->result_one();
		return $user;
	}
	public function loadUserId($username)
	{
		$user=_db()->useCB()->select('user.name as name, user.username as username,user.id as userid, user.avatar as avatar')->from('user')->where(array('username',$username))->result_one();
		return $user;
	}
	public function countFriend($member)
	{
			$count=_db()->useCB()->select('count(*) as count')->from('friend')->where(array('userId',$member))->result_one();
			return $count['count']; 
	}
	public function numberPage($member)
	{
		$num_row=$this->countFriend($member);		
		$num_record= $this->num_record;
        $num_page=ceil($num_row/$num_record);
        return $num_page;
	}
	public function arrPage($member){
		$page=array();
		$num_page= $this->numberPage($member);
		for ($i=1;$i<$num_page; $i++){
			$page[$i]=$i;
		}
		return $page;
	}
	/*public function viewListFriend($member)
	{
		$page=pzk_request()->getPage();
		if(!$page){
			$page=1;
		}		
		$listfriend=_db()->useCB()->select('friend. *')
			->from('friend')->where(array('username',$username))
			->limit(6,$page-1)
			->result();
		//$listfriend=_db()->useCB()->select('friend. *')->from('friend')->where(array('username',$username))->result();
		
		//$viewwritewall=_db()->useCB()->select('user_write_wall. *')->from('user_write_wall')->where(array('username',$username))->limit(6,0)->result();
		return $listfriend; 
	}*/
	public function testOnline($member)
	{
		$sessionID= pzk_session('userId');
		if($member == $sessionID)
		{
			$img='<img src="'.BASE_URL.'/default/skin/nobel/ptnn/media/online.png" alt=""> Online' ;
		}
		else
		{
			$img='<img src="'.BASE_URL.'/default/skin/nobel/ptnn/media/offline.png" alt=""> Offline' ;
		}
		 return $img;
		
	}
	public function testAvatar($avatar)
	{
		
		if($avatar == "")
		{
			$avatar=BASE_URL.'/default/skin/nobel/ptnn/media/noavatar.gif' ;
		}
		
		return $avatar;
		
	}



	
}
 ?>