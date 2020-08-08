<?php 
class PzkNoteController extends PzkFrontendController 
{
	public $masterPage='index';
	public $masterPosition='left';

	public function PostCommentAction()
	{
		$request=pzk_request();
		if(pzk_session('login')==false)
		{
			echo "bạn phải đăng nhập mới được bình luận";
		}
		else
		{
			$content=$request->get('write_wall');//echo $content;			
			$userId=$request->get('userId');
			$userwritewall=pzk_session('userId');
			$write_wall=_db()->getEntity('communication.user_write_wall');
			//$write_wall->loadWhere(array('username',$username));
			$datewrite= date("Y-m-d H:i:s");
			$row=array('userId'=>$userId, 'userWrite'=>$userwritewall,'content'=>$content,'datewrite'=>$datewrite);
			$write_wall->setData($row);
			$write_wall->save();
			$writeWallId=$write_wall->get('id');
			// insert table user_communication

				$str = str_replace( array('-', ':',' ') , '', $datewrite );
				$str=$userId.$str;
				$ett_comm= _db()->getEntity('communication.social');
				$ett_comm->create($userId,$str,$userwritewall,$datewrite,'writewall',$writeWallId,'');
			echo $writeWallId;
		}
	}
	public function viewnoteAction()
	{	
		$member= pzk_request('member');
		$sessionId= pzk_session('userId');
		$this->layout();
		//$this->append('user/profile/profileuser')->append('communication/note/viewnote');
		if($member==$sessionId){
			$this->append('user/profile/profileuser')->append('communication/note/viewnote');
		}else $this->append('user/profile/profileuser1')->append('communication/note/viewnote1');
		
		
		$this->display();
	}
	public function viewnotePageAction()
	{
		$viewnotepage=$this->parse('communication/note/viewnotepage')	;
		$viewnotepage->setScriptable(false);
		$viewnotepage->display();	
	}
	public function viewnotePage1Action()
	{
		$viewnotepage=$this->parse('communication/note/viewnotepage1')	;
		$viewnotepage->setScriptable(false);
		$viewnotepage->display();	
	}
	public function PostDelUserNoteAction()
	{
		$request=pzk_request();
		$idnote=$request->get('del');
		$username=pzk_session('username');
		$userId= pzk_session('userId');
		$user_note=_db()->getEntity('communication.user_note');
		foreach ($idnote as $id) {
			$user_note->load($id);
			$user_note->delete();
		}
		echo $userId;		
	}
	public function detailnoteAction()
	{
		$sctiptable= false;
		$member= pzk_request('member');
		$sessionId= pzk_session('userId');
		$this->layout();
		//$this->append('user/profile/profileuser')->append('communication/note/viewnote');
		if($member==$sessionId){
			$this->append('user/profile/profileuser')->append('communication/note/detailnote');
		}else{
			$this->append('user/profile/profileuser1')->append('communication/note/detailnote1');
		}
		
		$this->display();
	}
	public function PostCommentNoteAction()
	{
		$note_id=pzk_request('note_id');
		if(pzk_session('login')==false)
		{
			echo "bạn phải đăng nhập mới được bình luận";
		}
		else
		{

			$comment_note1=pzk_request('comment_note');
			$userId=pzk_session('userId');
			$userNote=pzk_request('member');
			
			$comment_note=_db()->getEntity('communication.user_note_comment');
			//$comment_note->loadWhere(array('username',$username));
			$date= date("Y-m-d H:i:s");
			$row=array('userId'=>$userId, 'noteId'=>$note_id,'comment'=>$comment_note1,'date'=>$date);
			$comment_note->setData($row);
			$comment_note->save();
			//isert user_communication
			$ett_comm= _db()->getEntity('communication.social');
			$ett_comm->create($userNote,$note_id,$userId,$date,'comment',0,$comment_note->get('id'));
			echo $comment_note->get('id');
		}
	}
	public function PostCommentNote1Action()
	{
		$note_id=pzk_request('note_id');
		if(pzk_session('login')==false)
		{
			echo "bạn phải đăng nhập mới được bình luận";
		}
		else
		{
			
			$comment_note1=pzk_request('comment_note');
			$userId=pzk_session('userId');
			$userNote=pzk_request('userNote');
			
			$comment_note=_db()->getEntity('communication.user_note_comment');
			//$comment_note->loadWhere(array('username',$username));
			$date= date("Y-m-d H:i:s");
			$row=array('userId'=>$userId, 'noteId'=>$note_id,'comment'=>$comment_note1,'date'=>$date);
			$comment_note->setData($row);
			$comment_note->save();
			//isert user_communication
			$ett_comm= _db()->getEntity('communication.social');
			$ett_comm->create($userNote,$note_id,$userId,$date,'comment',0,$comment_note->get('id'));
			echo $comment_note->get('id');
		}
	}
	public function addnoteAction()
	{
		$this->layout();
		$this->append('user/profile/profileuser')->append('communication/note/addnote');
		$this->display();	
	}
	public function PostUserNoteAction()
	{
		$request=pzk_request();
		$titlenote=$request->get('notetitle');
		$contentnote=$request->get('notecontent');
		$datenote= date("Y-m-d H:i:s");
		$username=pzk_session('username');
		$userId=pzk_session('userId');
		$user_note=_db()->getEntity('communication.user_note');
		$rownote=array('userId'=>$userId,'username'=>$username,'titlenote'=>$titlenote,'contentnote'=>$contentnote,'datenote'=>$datenote);
		$user_note->setData($rownote);
		$user_note->save();
		//isert user_communication
		$ett_comm= _db()->getEntity('communication.social');
		$ett_comm->create($userId,$user_note->get('id'),0,$datenote,'note','');
	}
	public function viewCommentAction()
	{
		$commentId= pzk_request('commentId');
		$detailnotepage=$this->parse('communication/note/detailnotepage')	;
		$detailnotepage->setScriptable(false);
		$detailnotepage->display();
	}
	public function viewComment1Action()
	{
		$commentId= pzk_request('commentId');
		$detailnotepage1=$this->parse('communication/note/detailnotepage1')	;
		$detailnotepage1->setScriptable(false);
		$detailnotepage1->display();
	}

	public function delNoteAction(){
		$idnote=pzk_request('noteId');
		$userId= pzk_session('userId');
		$comms =_db()->useCB()->select('user_communication.*')
					->from('user_communication')
					->where(array('noteId',$idnote))		
					->result('communication.social');
		foreach ($comms as $item) {
			$item->delete();
		}
		$userNoteComm =_db()->useCB()->select('user_note_comment.*')
					->from('user_note_comment')
					->where(array('noteId',$idnote))		
					->result('communication.User_note_comment');
		foreach ($userNoteComm as $item) {
			$item->delete();
		}
		$user_note=_db()->getEntity('communication.user_note');
		$user_note->load($idnote);
		if($user_note->get('id')){
			$user_note->delete();
			echo $userId;
		}
		
	}

	public function delWriteAction(){
		$id=pzk_request('id');
		$userId= pzk_session('userId');
		$ett_comm=_db()->getEntity('communication.social');
		$ett_comm->loadWhere(array('writeWallId',$id));
		if($ett_comm->get('id')){
			$ett_comm->delete();
		}
		$user_note=_db()->getEntity('communication.user_write_wall');
		$user_note->load($id);
		if($user_note->get('id')){
			$user_note->delete();
			echo $id;
		}
		
	}
	public function delCommAction(){
		$commentId=pzk_request('commentId');
		//$commId=pzk_request('commId');
		$ett_comm=_db()->getEntity('communication.social');
		$ett_comm->loadWhere(array('commentNoteId',$commentId));
		if($ett_comm->get('id')){
			$ett_comm->delete();
		}
		$comm=_db()->getEntity('communication.User_note_comment');
		$comm->load($commentId);
		if($comm->get('id')){
			$comm->delete();
			echo 'Ok';
		}
		
	}
}
 ?>