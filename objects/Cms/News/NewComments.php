<?php 

/**
* 
*/
class PzkCmsNewsNewComments extends PzkObject
{
	public $table = 'news_comment';
	public $layout = 'cms/news/newsComments';
	public function getComments($newsid)
	{
		$data=_db()->useCB()->select("news_comment.*, user.avatar,user.name,user.username")->from("news_comment")->join('user', 'news_comment.userId=user.id')->where(array('newsId',$newsid));
		//echo $data->getQuery();
		return $data->result();
	}
	public function getCountComment($newsid)
	{
		$allcomments=_db()->useCB()->select("content")->from("news_comment")->where(array('newsId',$newsid))->result();
		$count=count($allcomments);
		return($count);
	}
	public function getInfo($username){
		$info=_db()->useCB()->select("*")->from("user")->where(array('username',$username))->result_one();
		return($info);
	}
}
 ?>