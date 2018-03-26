<?php 

/**
* 
*/
class PzkCmsNewsComments extends PzkObject
{
	public $layout = 'cms/news/comments';
	public function getComments($newsid)
	{
		$allcomments=_db()->useCB()->select("comment.*, user.avatar,user.name,user.username")->from("comment")->join('user', 'comment.userId=user.id')->where(array('newsId',$newsid))->orderBy('id desc')->result();
		return($allcomments);
	}
	public function getCountComment($newsid)
	{
		$allcomments=_db()->useCB()->select("comment")->from("comment")->where(array('newsId',$newsid))->result();
		$count=count($allcomments);
		return($count);
	}
	public function getInfo($username){
		$info=_db()->useCB()->select("*")->from("user")->where(array('username',$username))->result_one();
		return($info);
	}
}
 ?>