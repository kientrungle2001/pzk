<?php 
/**
* 
*/
class PzkEntityCommunicationSocialModel extends PzkEntityModel
{
	
	public $table="user_communication";
	// list userfriend
	public function listFriend(){
		$arr= array();
		$friends=_db()->useCB()->select('friend.userfriend as userfriend')
				->from('friend')
				->where(array('userId',pzk_session('userId')))
				->result();
		foreach ($friends as $friend) {
			$arr[]= intval($friend['userfriend']);
		}
		$count= count($arr);
		$arr[$count]=intval(pzk_session('userId'));
		return $arr;

	} 
	public function countInvi(){
		
		$counter = _db()->select('count(*) as total')
				->fromInvitation()
				->whereUserId(pzk_session('userId'))
				->whereStatus(0)
				->result_one();
		return $counter['total'];
	}
	public function viewInvi(){
		return _db()->UseCB()->select('invitation.*')
				->from('invitation')
				->where(array('userId',pzk_session('userId')))
				->orderBy('id desc')
				->limit(6,0)
				->result();
	}
	public function countAlert(){
		$arr=$this->listFriend();
		$arr=  array_slice ($arr, 0,  count($arr)-1);
		
		$counter = _db()->UseCB()->select('count(*) as total')
				->from('user_communication')
				->where(array('or',array('in','userNote',$arr),array('in','userComment',$arr)))
				->where(array('status',1))
				//->groupBy('noteId')
				->result_one();
		if($counter){
			return $counter['total'];
		}else return 0;

	}
		// hien thi cac thong bao moi
	public function showAlert(){
		$arr=$this->listFriend();
		return $show=_db()->useCB()->select('user_communication.*')
				->from('user_communication')
				->where(array('or',array('in','userNote',$arr),array('in','userComment',$arr)))
				->where(array('status',1))
				->orderBy('id desc')
				->groupBy('noteId')
				->result();
	}
	// Check thoong bao
	public function checkAlert($type,$userNote,$userComment,$noteId){
		
		$row= $this->rowNote($noteId,$type);
		$user= $this->user($userNote);
		if(intval($row[0])==1 && $userNote != pzk_session('userId')){
			return '<a href="/note/detailnote?member='.$userNote.'&id='.$noteId.'"><img src="'.$user['avatar'].'" alt="" width="60px" height="60px"><strong>'.$user['name'].'</strong> đã thêm một ghi chép mới</a>';
		}else if(intval($row[0])>1){
			$userComm= $this->user($row[1]);
			return '<a href="/note/detailnote?member='.$userNote.'&id='.$noteId.'"><img src="'.$userComm['avatar'].'" alt="" width="60px" height="60px"><strong>'.$userComm['name'].$row[3].'</strong> đã bình luận về một ghi chép của '.$user['name'].'</a>';
		}else if($type=='avatar' && $userNote != pzk_session('userId')){
			return '<a href="#"><img src="'.$user['avatar'].'" alt="" width="60px" height="60px"><strong>'.$user['name'].'</strong> đã thay đổi hình đại diện</a>';
		}else if($type=='writewall' && $userComment != pzk_session('userId')){
			$userComm= $this->user($userComment);
			return '<a href="/profile/user?member='.$userNote.'"><img src="'.$userComm['avatar'].'" alt="" width="60px" height="60px"><strong>'.$userComm['name'].'</strong> đã viết lên tường nhà'.$user['name'].' </a>';
		}
	}
	public function user($userId){
		
		$user = _db()->select('user.username as username, user.name as name, user.avatar as avatar')
				->fromUser()
				->whereId($userId)			
				->result_one();
		if(!$user['name']){
			$user['name']=$user['username'];
		}
		if(!$user['avatar']){
			$user['avatar']=BASE_URL.'/default/skin/nobel/ptnn/media/noavatar.gif';
		}
		return $user;
	}
	public function note($noteId){
		
		return  _db()->select('user_note.id as id,user_note.userId as userNote, user_note.titlenote as title, user_note.contentnote as content, user_note.datenote as date')
				->fromUser_note()
				->whereId($noteId)			
				->result_one();
	
	}
	public function formatDate($datetime){
		$arr= array();
		$arr[0]=date("d-m-Y", strtotime($datetime));
		$time= time($datetime);
		$arr[1]=date("H:i:s",strtotime($datetime));
		return $arr;
	}
	//Liet ke so ban ghi trong user_communication theo noteId
	public function rowNote($noteId,$type){
		$row=array();
		if($type=='note' || $type=='comment'){
			$rowNotes =_db()->useCB()->select('user_communication.userComment as userComment, user_communication.userNote as userNote')
					->from('user_communication')
					->where(array('noteId',$noteId))		
					->result();
			$numRow= count($rowNotes);
			if($numRow>1){
				$rows=array();
				
				foreach ($rowNotes as $rowNote) {
					$rows[]=$rowNote['userComment'];
				}
				$rows=array_reverse($rows);
				$row[0]=$numRow;
				$row[1]=$rows[0];
				$rows= array_unique($rows);
				$tamp= count($rows);
				if($tamp>2){
					
					$row[3]= ' và '.$tamp-1;
				}else $row[3]='';
				

			}else if($numRow==1){

				foreach ($rowNotes as $rowNote) {
					$rows[]=$rowNote['userNote'];
				}
				$row[0]=$numRow;
				$row[1]=$rows[0]; 
			}
			return $row;
		}else return 0;
	}
	public function showContent($id)
	{		
			$arr=$this->listFriend();		
			$content=_db()->useCB()->select('user_communication.*')->from('user_communication')
				     ->where(array('or',array('in','userNote',$arr),array('in','userComment',$arr)));

			if($id)
			{
				$content->where(array('lt','id', $id));
			}
			
			$content->orderBy('id desc');
			$content->groupBy('noteId');
			$content->limit(6,0);
			
			return $content->result();
	}
	// dem so row trong user_communication
	public function countRow($id)
	{
		$arr=$this->listFriend();
		$count=_db()->useCB()->select('count(*) as count')
		->from('user_communication')
		->where(array('or',array('in','userNote',$arr),array('in','userComment',$arr)));
		if($id)
		{
			$count->where(array('lt','id', $id));
		}
		$count->groupBy('noteId');
		$count->orderBy('id desc');			
		$count_= $count->result_one(); 
		return $count_['count'];
	}
	
	//tao 1 row trong user_communication
	public function create($userNote,$noteId,$userComment,$date,$type,$writeWallId,$commentNoteId){
		$data=array('userNote'=>$userNote,'noteId'=>$noteId,'userComment'=>$userComment,'date'=>$date,'type'=>$type,'status'=>1,'writeWallId'=>$writeWallId,'commentNoteId'=>$commentNoteId);
		$this->setData($data);
		$this->save();
	}
	// check xem user đã thay đổi avatar lần nào chưa? nếu có thì xoá đi rồi mới cập nhật mới
	public function editAvatar($userNote){
		/*return $show=_db()->useCB()->delete('user_communication.*')
				->from('user_communication')
				->where(array('and',array('userNote',$userNote),array('type','avatar')))
				->result_one();*/
		$this->loadwhere(array('and',array('userNote',$userNote),array('type','avatar')));
		if($this->get('id')){
			$this->delete();
		}
	}
	// Hien thi noi dung viet len tuong
	public function writeWall($id){
		return _db()->useCB()->select('user_write_wall.*')
				->from('user_write_wall')
				->where(array('id',$id))
				->result_one();
	}
}
 ?>