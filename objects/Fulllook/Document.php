<?php
class PzkFulllookDocument extends PzkObject
{
	public function getName()
	{
		$test=_db()->useCB()->select("*")->from("categories")->where( array('parent',47))->where( array('display',1))->result();
		return($test);
	}
	public function getDocument($id)
	{
		$practice=_db()->useCB()->select("*")->from("document")->where( array('categoryId',$id))->where( array('type',"document"))->where( array('status',1))->orderBy('id desc')->limit(2)->result();
		return($practice);
	}
	public function getCate($id)
	{
		$cate=_db()->useCB()->select("*")->from("categories")->where( array('id',$id))->result();
		return($cate);
	}
	public function getOther($id)
	{	
		$cateid=_db()->useCB()->select('categoryId')->from("document")->where( array('id',$id))->result_one();
		
		$practice=_db()->useCB()->select("*")->from("document")->where( array('categoryId',$cateid))->where( array('type',"document"))->where( array('status',1))->orderBy('id desc')->limit(5)->result();
		
		return($practice);
	}
		
}

?>