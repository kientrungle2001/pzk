<?php 
class PzkCmsAQsAQshome extends PzkObject
{
    public $layout = "cms/AQs/AQshome";
	public function getInfo($username){
		$info=_db()->useCB()->select("*")->from("user")->where(array('username',$username))->result_one();
		return($info);
	}
	public function getQuestion($page = 0)
	{
		$allquestions=_db()->useCB()->select("*")->from("aqs_question")->orderBy('id desc')->limit(5, $page)->result();
		return($allquestions);
	}
	public function getCountAnswer($id)
	{
		$allanswer=_db()->useCB()->select("answer")->from("aqs_answer")->where(array('questionId',$id))->result();
		$count=count($allanswer);
		return($count);
	}
	public function getAnswer($id)
	{
		$allanswers=_db()->useCB()->select("*")->from("aqs_answer")->where(array('questionId',$id))->orderBy('aqs_answer.id desc')->result();
		return($allanswers);
	}
	public function countItems(){
		$item = _db()->select("question")->from("aqs_question")->result();
		return count($item);
	}
}
 ?>