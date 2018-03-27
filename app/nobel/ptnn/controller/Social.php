<?php 
class PzkSocialController extends PzkFrontendController 
{
	public $masterPage='index';
	public $masterPosition='left';

	public function homeAction() 
	{	
		$sctiptable= false;	
		$this->layout();		
		$this->append('user/profile/profileuser')->append('communication/social/home');
		$this->display();
	}
	public function viewContentAction()
	{
		
		$detail=$this->parse('communication/social/detail')	;
		$detail->setScriptable(false);
		$detail->display();
	}

	public function viewCommentAction()
	{
		$detail=$this->parse('communication/social/detailcomment')	;
		$detail->setScriptable(false);
		$detail->display();
	}
	public function delAlertAction(){
		$ett_comm=_db()->getEntity('communication.social');
		$arr= $ett_comm->listFriend();
		$rows= _db()->select('user_communication.*')
				->from('user_communication')
				->where(array('or',array('in','userNote',$arr),array('in','userComment',$arr)))
				->where(array('status',1))
				->result('communication.social');
		
		foreach ($rows as $row) {
			$row->update(array('status'=>0));
			
		}
	}
	public function delInviAction(){
		$rows= _db()->select('invitation.*')
				->from('invitation')
				->where(array('userId',pzk_session('userId')))
				->where(array('status',0))
				->result('communication.invitation');
		
		foreach ($rows as $row) {
			$row->update(array('status'=>1));
			
		}
	}
}
 ?>