<?php 
class PzkNoteController extends PzkFrontendController 
{
	public $masterPage='index';
	public $masterPosition='left';

	public function PostCommentFriendAction()
	{
		$request=pzk_request();
		if(pzk_session('login')==false)
		{
			echo "bạn phải đăng nhập mới được bình luận";
		}
		else
		{

			$content=$request->get('write_wall');
			//echo $content;
			
			$username=$request->get('username');
			$userwritewall=pzk_session('username');
			$write_wall=_db()->getEntity('communication.user_write_wall');
			//$write_wall->loadWhere(array('username',$username));
			$datewrite= date("Y-m-d H:i:s");
			$row=array('username'=>$username, 'userwritewall'=>$userwritewall,'content'=>$content,'datewrite'=>$datewrite);
			$write_wall->setData($row);
			$write_wall->save();
			

		}
	}
	public function viewnoteAction()
	{
		$this->layout();
		$this->append('communication/note/viewnote');
		
		$this->display();
		//$this->render('user/payment/payment');		
	}
	public function viewnotePageAction()
	{
		$viewnotepage=$this->parse('communication/note/viewnotepage')	;
		$viewnotepage->display();	
	}
	public function PostDelUserNoteAction()
	{
		$request=pzk_request();
		$idnote=$request->get('del');
		$username=pzk_session('username');
		$user_note=_db()->getEntity('communication.user_note');
		foreach ($idnote as $id) {
			$user_note->load($id);
			$user_note->delete();
		}
		echo "ok";
		
	}
	public function detailnoteAction()
	{
		$this->layout();
		$this->append('communication/note/detailnote');
		
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
			//echo $content;
			
			
			$userId=pzk_session('userId');
			$comment_note=_db()->getEntity('communication.user_note_comment');
			//$comment_note->loadWhere(array('username',$username));
			$date= date("Y-m-d H:i:s");
			$row=array('userId'=>$userId, 'noteId'=>$note_id,'comment'=>$comment_note1,'date'=>$date);
			$comment_note->setData($row);
			$comment_note->save();
			echo 'ok';
		}
		
		
	}
	public function addnoteAction()
	{
		$this->layout();
		$this->append('communication/note/addnote');
		
		$this->display();
		//$this->render('user/payment/payment');		
	}
	public function PostUserNoteAction()
	{
		$request=pzk_request();
		$titlenote=$request->get('notetitle');
		$contentnote=$request->get('notecontent');
		$datenote= date("Y-m-d H:i:s");
		$username=pzk_session('username');
		$user_note=_db()->getEntity('communication.user_note');
		
		$rownote=array('username'=>$username,'titlenote'=>$titlenote,'contentnote'=>$contentnote,'datenote'=>$datenote);
		$user_note->setData($rownote);
		$user_note->save();
		
	}
	public function viewCommentAction()
	{
		$commentId= pzk_request('commentId');
		$detailnotepage=$this->parse('communication/note/detailnotepage')	;
		$detailnotepage->display();

	}
	

}
 ?>