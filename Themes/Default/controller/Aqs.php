<?php
class PzkAqsController extends PzkController {
	public $masterPage = 'index';
	public $masterPosition = 'wrapper';
	
	public function indexAction() {
		$this->initPage();
		pzk_page()->set('title', 'Hỏi đáp nhanh phần mềm Full Look');
		pzk_page()->set('keywords', 'Giáo dục, hỏi đáp nhanh, full look');
		pzk_page()->set('description', 'Hỏi đáp nhanh phần mềm Full Look');
		pzk_page()->set('img', '/Default/skin/nobel/Themes/Story/media/logo.png');
		pzk_page()->set('brief', 'Hỏi đáp nhanh phần mềm Full Look');
		$this->append('aqs', 'wrapper')
		->display();
	}
	
	public function pageAction(){
		$obj = $this->parse('cms/AQs/AQshome');
		$obj->set('isAjax', true);
		$obj->set('page', pzk_request()->get('page'));
		$obj->display();
	}
	
	public function questionPostAction()
	{	
		if(pzk_session('login'))
		{
			$question=pzk_request('question');				
			$username=pzk_session('username');					
			if($question){
				$addquestion = array(
				'question' => $question,
				'username' => $username,
				'userId'	=> pzk_session('userId'),
				'software' => pzk_request()->get('softwareId')
				);
				$entity = _db()->useCB()->getEntity('table')->setTable('aqs_question');
				$entity->setData($addquestion);
				$entity->save();
			}
			$this->redirect('aqs/index');
		}
		else
		{
			$this->redirect('aqs/index');
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
			if($answer){
				$addanswer = array(
					'questionId' => $questionid,
					'answer' => $answer,
					'userId' => $userid,
					'username' => $username,
					'software' => pzk_request()->get('softwareId')
				);
				$entity = _db()->useCb()->getEntity('table')->setTable('aqs_answer');
				$entity->setData($addanswer);
				$entity->save();
				$allanswer=_db()->useCB()->select("answer")->from("aqs_answer")->where(array('questionId',$questionid))->result();
				$count=count($allanswer);
				_db()->useCB()->update('aqs_question')->set(array('answer' => $count))->where(array('id',$questionid))->result();
			}
			$this->redirect('aqs/index');
		}
		else
		{
			$this->redirect('aqs/index');
		}
	}
}