<?php 
class PzkFriendController extends PzkFrontendController 
{
	public $masterPage='index';
	public $masterPosition='left';

	public function listAction() 
	{
		
		$this->layout();
		$list = $this->parse('communication/friend/friendlistuser');
		$list->setUserId( pzk_request()->getMember());
		$this->append($list);
		$this->display();
	}
	public function listpageAction()
	{
		$searchuser=$this->parse('communication/friend/friendlistuserpage')	;
		$searchuser->setScriptable(false);
		$searchuser->display();

	}
	public function denyfriendAction()
	{
		$member = pzk_request()->getMember();
		$friend =_db()->getEntity('User.Account.User')->load($member);
		pzk_user()->removeFriend($friend);
		$url = $_SERVER["HTTP_REFERER"];
		$this->redirect($url);
	
	}
	public function SearchAction()
	{
		$this->layout();		
		
		$this->append('communication/friend/search');
		$this->page->display();
			
	}
	public function ResultsearchAction()
	{
		$this->layout();		
		$this->append('communication/friend/resultsearch', 'left');
		$this->page->display();
	
	}
	public function searchPostAction()
	{
		$request=pzk_request();
		$searchfriend=$request->getSearchfriend();
		pzk_session()->setSearchfriend( $searchfriend);

		$this->redirect('searchResult');
	}
	public function searchResultAction() 
	{
	
		$searchfriend = pzk_session()->getSearchfriend();
		//$items_name=_db()->useCB()->select('user.*')->from('user')->where(array('or',array('like','email',$searchfriend),array('like','name',$searchfriend),array('like','username',$searchfriend)))->result();
		$this->layout();
		$pageSearch = pzk_parse(pzk_app()->getPageUri('communication/friend/resultsearch'));
		$pageSearch->setTxtsearch($searchfriend);	
		
		$this->append('communication/friend/search')->append($pageSearch);
		$this->page->display();

		
	}
	public function searchuserAction()
	{
		$searchuser=$this->parse('communication/friend/searchuser')	;
		$searchuser->display();

	}
	public function PostCommentFriendAction()
	{
		$request=pzk_request();
		if(pzk_session()->getLogin()==false)
		{
			echo "bạn phải đăng nhập mới được bình luận";
		}
		else
		{

			$content=$request->getWrite_wall();
			//echo $content;
			
			$username=$request->getUsername();
			$userwritewall=pzk_session()->getUsername();
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
		$this->append('communication/friend/viewnote');
		
		$this->display();
		//$this->render('user/payment/payment');		
	}
	public function viewnotePageAction()
	{
		$viewnotepage=$this->parse('communication/friend/viewnotepage')	;
		$viewnotepage->display();	
	}
	public function PostDelUserNoteAction()
	{
		$request=pzk_request();
		$idnote=$request->getDel();
		$username=pzk_session()->getUsername();
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
		$this->append('communication/friend/detailnote');
		
		$this->display();
	}
	public function PostCommentNoteAction()
	{
		$note_id=pzk_request()->getNote_id();
		
		
		
		if(pzk_session()->getLogin()==false)
		{
			echo "bạn phải đăng nhập mới được bình luận";
		}
		else
		{

			$comment_note1=pzk_request()->getComment_note();
			//echo $content;
			
			
			$userId=pzk_session()->getUserId();
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
		$this->append('communication/friend/addnote');
		
		$this->display();
		//$this->render('user/payment/payment');		
	}
	public function PostUserNoteAction()
	{
		$request=pzk_request();
		$titlenote=$request->getNotetitle();
		$contentnote=$request->getNotecontent();
		$datenote= date("Y-m-d H:i:s");
		$username=pzk_session()->getUsername();
		$user_note=_db()->getEntity('communication.user_note');
		
		$rownote=array('username'=>$username,'titlenote'=>$titlenote,'contentnote'=>$contentnote,'datenote'=>$datenote);
		$user_note->setData($rownote);
		$user_note->save();
		
	}
	public function viewCommentAction()
	{
		$commentId= pzk_request()->getCommentId();
		$detailnotepage=$this->parse('communication/friend/detailnotepage')	;
		$detailnotepage->display();

	}
	public function viewwritewallAction()
	{
		$this->layout();
		$this->append('communication/friend/viewwritewall');
		
		$this->display();

	}
	public function viewwritewallPageAction()
	{
		$viewwritewallpage=$this->parse('communication/friend/viewwritewallpage')	;
		$viewwritewallpage->display();	
	}
}
 ?>