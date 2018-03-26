<?php 
class PzkCmsFeaturedComments extends PzkObject
{
	
	public function getComments($featuredid,$page = 0)
	{
		$allcomments=_db()->useCB()->select("featured_comment.*, user.avatar,user.name,user.username")->from("featured_comment")->join('user', 'featured_comment.userId=user.id')->where(array('featuredId',$featuredid))->orderBy('id desc')->limit(5, $page)->result();
		return($allcomments);
	}
	function countItems() {
		$item = _db()->select('count(*) as c')->from("featured_comment")->result_one();
		return $item['c'];
	}
	public function getInfo($username){
		$info=_db()->useCB()->select("*")->from("user")->where(array('username',$username))->result_one();
		return($info);
	}
}
 ?>