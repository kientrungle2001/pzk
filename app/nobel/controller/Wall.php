<?php 
class PzkWallController extends PzkFrontendController 
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

			$content=$request->getWrite_wall();
			//echo $content;
			
			$username=$request->getUsername();
			$userwritewall=pzk_session('username');
			$write_wall=_db()->getEntity('communication.user_write_wall');
			//$write_wall->loadWhere(array('username',$username));
			$datewrite= date("Y-m-d H:i:s");
			$row=array('username'=>$username, 'userwritewall'=>$userwritewall,'content'=>$content,'datewrite'=>$datewrite);
			$write_wall->setData($row);
			$write_wall->save();
			

		}
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
		$this->append('communication/wall/viewwritewall');
		
		$this->display();

	}
	public function viewwritewallPageAction()
	{
		$viewwritewallpage=$this->parse('communication/wall/viewwritewallpage')	;
		$viewwritewallpage->display();	
	}
}
 ?>