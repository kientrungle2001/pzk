<?php 
/**
* 
*/
class PzkEntityCommunicationUser_noteModel extends PzkEntityModel
{
	public $table="user_note"; 
	public function loadNote($member){
		$page=pzk_request()->getPage();
		if(!$page){
			$page=1;
		}
		return _db()->select('user_note.*')->from('user_note')
		->where(array('userId',$member))
		->limit(6,$page-1)
		->result('Communication.User_note');
	}
	public function viewNote($member)
	{
			$page=pzk_request()->getPage();
			if(!$page){
				$page=1;
			}
			$viewnote=_db()->useCB()->select('user_note. *')->from('user_note')->where(array('username',$username))->limit($this->num_record,$page-1)->result();
			return $viewnote; 
	}
	public function checkNote($member,$count){
		
		if($count>0){
			echo '<div class="pr_bt_viewmore_c"><a href="/note/viewnote?member='.$member.'">Xem tất cả</a></div>';
		}else {
			echo '<div class="clear">Bạn không có ghi chép nào</div><div class="pr_bt_viewmore_c"><a href="/note/addnote?member='.$member.'">Thêm ghi chép mới</a></div>';
		}
	}
	public function checkNote1($member,$count){
		if($count>0){
			echo '<div class="pr_bt_viewmore_c"><a href="/note/viewnote?member='.$member.'">Xem tất cả</a></div>';
		}else {
			echo '<div class="clear">Không có ghi chép nào</div>';
		}
	}
	public function countComment($noteId)
	{
			$count=_db()->useCB()->select('count(*) as count')->from('user_note_comment')->where(array('noteId',$noteId))->result_one();
			return $count['count'];
	}
	public function formatDate($datetime){
		$arr= array();
		$arr[0]=date("d-m-Y", strtotime($datetime));
		$time= time($datetime);
		$arr[1]=date("H:i:s",strtotime($datetime));
		return $arr;
	}
	public function countNote($member)
	{
			$count=_db()->useCB()->select('count(*) as count')->from('user_note')->where(array('userId',$member))->result_one();
			return $count['count']; 
	}
	public function arrPage($member){
		$page=array();
		$num_row= $this->countNote($member);
        $num_page=ceil($num_row/6);
		for ($i=1;$i<=$num_page; $i++){
			$page[$i]=$i;
		}
		return $page;
	}
	public function loadCommentNote($noteId,$id)
	{			
			
			$comment_note=_db()->useCB()->select('user_note_comment.*')->from('user_note_comment')
				->where(array('noteId',$noteId));
			if($id)
			{
				$comment_note->where(array('lt','id', $id));
			}
			$comment_note->orderBy('id desc')->limit(6,0);
			
			return $comment_note->result();
	}
	public function loadUserName($userId)
	{
		$user=_db()->useCB()->select('user.name as name, user.username as username,user.id as userid, user.avatar as avatar')->from('user')->where(array('id',$userId))->result_one();
	
		return $user;

	}
	public function checkAvatar($avatar){
		if($avatar)
		{
			return '<img src="'.$avatar.'"  alt="" width="60" height="60">';
		}
		else
		{
			return '<img src="'.BASE_URL.'/default/skin/nobel/ptnn/media/noavatar.gif"  alt="" width="60" height="60">';	
		}
	}
	public function countCommentNote($noteId, $id)
	{
		$count_comment=_db()->useCB()->select('count(*) as count')->from('user_note_comment')->where(array('noteId',$noteId));
		if($id)
		{
			$count_comment->where(array('lt','id', $id));
		}
		$count_comment->orderBy('id desc');			
		$count= $count_comment->result_one(); 
		return $count['count'];
	}
	
}
 ?>