<?php
class PzkAQsController extends PzkController {
	public $masterPage='index';
	public $masterPosition='right';
	
	public function AQshomeAction(){
		
		$this->initPage()->append('cms/AQs/AQshome','right');
		$this->display();
	}
	
	public function pageAction(){
		$obj = $this->parse('cms/AQs/AQshome');
		$obj->setIsAjax(true);
		$obj->setPage(pzk_request()->getPage());
		$obj->display();
	}
	
	public function questionPostAction()
	{	
		if(pzk_session('login'))
		{
			$question=pzk_request('question');				
			$username=pzk_session('username');					
			if(!empty($question)){
				$addquestion=array('question'=>$question,'username'=>$username);
				$entity = _db()->useCB()->getEntity('Table')->setTable('aqs_question');
				$entity->setData($addquestion);
				$entity->save();
			}
			$this->redirect('home/index');
		}
		else
		{
			$this->redirect('account/login');
		}
			

	}
	public function answerPostAction()
	{
		if(pzk_session('login'))
		{
			$answer=pzk_request('answer');
			$questionid=pzk_request('questionid');
			$userid=pzk_session('id');
			$username=pzk_session('username');
			if(!empty($answer)){
				$addanswer=array('questionId'=>$questionid,'answer'=>$answer,'userId'=>$userid,'username'=>$username);
				$entity = _db()->useCb()->getEntity('Table')->setTable('aqs_answer');
				$entity->setData($addanswer);
				$entity->save();
				$allanswer=_db()->useCB()->select("answer")->from("aqs_answer")->where(array('questionId',$questionid))->result();
				$count=count($allanswer);
				_db()->useCB()->update('aqs_question')->set(array('answer' => $count))->where(array('id',$questionid))->result();
			}
			$this->redirect('home/index');
		}
		else
		{
			$this->redirect('user/login');
		}
	}
}
?>