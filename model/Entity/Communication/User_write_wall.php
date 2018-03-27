<?php 
/**
* 
*/
class PzkEntityCommunicationUser_write_wallModel extends PzkEntityModel
{
	public $table="user_write_wall"; 
	public function loadUserId($member)
	{
		return _db()->useCB()->select('user.name as name, user.username as username,user.id as userid, user.avatar as avatar')->from('user')->where(array('id',$member))->result_one();
	}
	public function checkAvatar($avatar)
	{
		if($avatar == "")
		{
			$avatar='/default/skin/nobel/ptnn/media/noavatar.gif' ;
		}
		
		return $avatar;		
	}
	public function checkWall($check,$member){
		if($check >0){
			echo '<div class="pr_bt_viewmore_c"><a href="/wall/view?member='.$member.'">Xem tất cả</a></div>';
		}
	}
	public function loadWriteWall($member)
	{
		$page=pzk_request('page_wall');
		if(!$page){
			$page=1;
		}
		$write_wall=_db()->useCB()->select('user_write_wall.*')->from('user_write_wall')->where(array('userId',$member))->orderBy('id desc')->limit(6,$page-1)->result();
		return $write_wall; 
	}
	public function countWriteWall($member)
	{
		$count=_db()->useCB()->select('count(*) as count')->from('user_write_wall')->where(array('userId',$member))->result_one();
		return $count['count']; 
	}
	public function arrPage($row,$member){
		$page=array();
		if($row >0){
			$numRow=$this->countWriteWall($member);
			$num_page=ceil($numRow/6);
			for ($i=1;$i<=$num_page; $i++){
				$page[$i]=$i;
			}
		}
		return $page;
	}
	public function checkPage($row){
		if($row>0){
			echo "Trang";
		}	
	}
}
 ?>