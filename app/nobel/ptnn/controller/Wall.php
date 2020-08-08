<?php 
class PzkWallController extends PzkFrontendController 
{
	public $masterPage='index';
	public $masterPosition='left';

	public function PostComAction()
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
			
			$userId=$request->getUserId();
			$userWrite=pzk_session()->getUserId();
			$write_wall=_db()->getEntity('communication.user_write_wall');
			//$write_wall->loadWhere(array('username',$username));
			$datewrite= date("Y-m-d H:i:s");
			$row=array('userId'=>$userId, 'userWrite'=>$userWrite,'content'=>$content,'datewrite'=>$datewrite);
			$write_wall->setData($row);
			$write_wall->save();
			$id= $write_wall->getId();
			$str = str_replace( array('-', ':',' ') , '', $datewrite );
			$str=$userId.$str;
			$ett_comm= _db()->getEntity('communication.social');
			$ett_comm->create($userId,$str,$userWrite,$datewrite,'writewall',$id,0);
			echo $id;

		}
	}

	public function viewCommentAction()
	{
		$commentId= pzk_request()->getCommentId();
		$detailnotepage=$this->parse('communication/friend/detailnotepage')	;
		$detailnotepage->display();

	}
	public function viewAction()
	{
		$member= pzk_request()->getMember();
		$sessionId= pzk_session()->getUserId();
		$this->layout();
		if($member==$sessionId){
			$this->append('user/profile/profileuser')->append('communication/wall/viewwritewall');
		}else $this->append('user/profile/profileuser1')->append('communication/wall/viewwritewall1');
		$this->display();
	}
	public function viewwritewallPageAction()
	{
		$viewwritewallpage=$this->parse('communication/wall/viewwritewallpage')	;
		$viewwritewallpage->setScriptable(false);
		$viewwritewallpage->display();	
	}
	public function viewwritewallPage1Action()
	{
		$viewwritewallpage=$this->parse('communication/wall/viewwritewallpage1')	;
		$viewwritewallpage->setScriptable(false);
		$viewwritewallpage->display();	
	}
	public function delWriteAction(){
		$id=pzk_request()->getId();
		$userId= pzk_session()->getUserId();
		$ett_comm= _db()->getEntity('communication.social');
		$ett_comm->loadWhere(array('writeWallId',$id));
		if($ett_comm->getId()){
			$ett_comm->delete();
		}
		$userWrite=_db()->getEntity('communication.user_write_wall');
		$userWrite->load($id);
		if($userWrite->getId()){
			$userWrite->delete();
			echo $userId;
		}
		
	}
}
 ?>