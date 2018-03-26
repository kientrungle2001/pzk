<?php 

/**
* 
*/
class PzkCmsFeaturedFeaturedlist extends PzkObject
{
	public function getFeaturedContent($id)
	{
		$content=_db()->useCB()->select('*')->from('featured')->where(array('id', $id))->result_one();
		return($content);
	}
	public function getFeaturedList($id){
		$parentid=_db()->useCB()->select('categoryId,title')->from('featured')->where(array('id', $id))->result_one();
		$parent=_db()->useCB()->select('categoryId,title,id')->from('featured')->where(array('id', $parentid['categoryId']))->result_one();
		$lists=_db()->useCB()->select('*')->from('featured')->where(array('categoryId', $parentid['categoryId']))->result();
		return(array($lists,$parentid,$parent));
	}
	public function getVisitor($ip,$id){
		$datevisit=date("Y-m-d 00:00:00");
		$test=_db()->useCB()->select('id')->from('featured_visitor')->where(array('featuredId', $id))->where(array('ip', $ip))->where(array('visited', $datevisit))->result_one();
		if(!$test){
			$addVisitor=array('featuredId'=>$id,'ip'=>$ip,'visited'=>$datevisit);
			$entity = _db()->useCb()->getEntity('Table')->setTable('featured_visitor');
			$entity->setData($addVisitor);
			$entity->save();
		}
	}
	public function getRemoteIPAddress(){
		$ip = isset($_SERVER['REMOTE_ADDR']) ? $_SERVER['REMOTE_ADDR'] : '';
		return $ip;
		echo $ip;
	}
	
}
 ?>