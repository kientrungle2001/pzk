<?php 
/**
* 
*/
class PzkCommunicationFriendResultsearch extends PzkObject
{
    public $layout = 'communication/friend/resultSearch';
	public $num_record= 5;
	public function loadUserName($member)
	{
		$user=_db()->useCB()->select('user.name as name, user.username as username,user.id as userid, user.avatar as avatar')->from('user')->where(array('id',$member))->result_one();
		//$sql="select `user`.name as 'name' ,`user`.username as 'username' ,`user`.id as 'id',`user`.avatar as 'avatar'  FROM `user` WHERE `user`.id = '".$member."'";
		//$user= _db()->query($sql);
		return $user;

	}
	public function countRowSearch($searchfriend)
	{
		return $countrow=_db()->useCB()->select('count(*) as count')->from('user')->where(array('or',array('like','name',$searchfriend),array('like','username',$searchfriend)))->result_one();
		
	}
	public function numberPage($searchfriend)
	{
		$countrow= $this->countRowSearch($searchfriend);
		$num_row= $countrow['count'];
		$num_record= $this->num_record;
        $num_page=ceil($num_row/$num_record);
        return $num_page;
	}
	public function viewSearch($searchfriend)
	{
		$page=pzk_request()->getPage();
		if(!$page)
		{
			$page=1;
		}
		//$viewsearch=_db()->useCB()->select('user. *')->from('user')->where(array('or',array('like','name',$searchfriend),array('like','username',$searchfriend)))->limit(10,$page-1)->result();
		return $viewsearch=_db()->useCB()->select('user.*')
					->from('user')
					->where(array('or',array('like','name',$searchfriend),array('like','username',$searchfriend)))
					->limit($this->num_record,$page-1)
					->result('User.Account.User');
		 
	}
	/*public function testOnline($member)
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
		
	}*/
	
	/*public function testFriend($member)
	{
		$sessionUsername= pzk_session('username');

		$user=$this->loadUserName($member);
		$username_member=$user['username'];
		$friend= _db()->getEntity('communication.friend');
		$friend->loadWhere(array(array('username',$sessionUsername),array('userfriend',$username_member)));
		if($friend->getId())
		{
			 return true;
		}
		else
		{
			 return false;
		}

	}*/
	/*public function testInivitation($member)
	{
		$sessionUsername= pzk_session('username');

		$user=$this->loadUserName($member);
		$username_member=$user['username'];
		$invitation= _db()->getEntity('communication.invitation');
		$invitation->loadWhere(array(array('username',$sessionUsername),array('userinvitation',$username_member)));
		if($invitation->getId())
		{
			 return true;
		}
		else
		{
			 return false;
		}

	}*/
	/*public function testStatus($member)
	{
		
		$sessionID= pzk_session('userId');
		
		// Kiểm tra xem member có phải là bạn với sessionID không?

		if($sessionID == $member)
		{
			return $img='';
		}
		else
		{
			$checkfriend= $this->testFriend($member);
			$checkinvitation= $this->testInivitation($member);
			if($checkfriend)
			{
				return $img='<a href="'.BASE_REQUEST.'/friend/denyfriend?member='.$member.'"><img src="'.BASE_URL.'/default/skin/ptnn/media/huyketban.png" </a>';
			}
			elseif($checkinvitation)
			{
				return $img='<a href="#"><img src="'.BASE_URL.'/default/skin/nobel/ptnn/media/send_email_user_alternative.png" </a>';
			}
			else
			{
				return $img='<a href="'.BASE_REQUEST.'/invitation/invitation?member='.$member.'"><img src="'.BASE_URL.'/default/skin/nobel/ptnn/media/pr_bt_ketban.png" </a>';
			}
		}
		
	}*/
}
 ?>