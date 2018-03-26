<?php 
class PzkCmsNewsIndex extends PzkObject
{
	public $layout = 'cms/news/index';
	public function getNews($category)
	{
		$data=_db()->useCB()->select("*")
            ->from("news")
            ->where(array('categoryId',$category))
            ->limit(3)
            ->orderBy('ordering desc, id desc')
            ->result();
		return($data);
	}
	public function getNews2($category, $page=0)
	{
		$data=_db()->useCB()->select("*")
            ->from("news")
            ->where(array('categoryId',$category))
            ->limit(5, $page)
            ->orderBy('ordering desc, id desc')
            ->result();
		return($data);
	}
	public function getSubnews($id)
	{
        $data=_db()->useCB()->select("*")->from("news")
            ->where(array('categoryId',$id))
            ->limit(5)
            ->orderBy('ordering desc, id desc')
            ->result();
        return $data;
	}
	public function getSubCategory($category)
	{
		$titles=_db()->useCB()->select("*")->from("categories")->where(array('parent',$category))->orderBy('ordering desc, id desc')->result();
		
		return $titles;
	}
	public function getCategory($id)
	{
		$titles=_db()->useCB()->select("*")->from("categories")->where(array('id',$id))->result_one();
		return($titles);
	}
	
	function getHotNews($limit = '', $pageNews = 0, $CategoryId = ''){
		
		if($limit == ''){
			
			$limit = LIMIT_NEWS;
		}
		
		if($pageNews >0){
			
			$pageNews = $pageNews -1;
		}
		
		$listCategory = $this->getSubCategory($CategoryId);
		
		$query = _db()->select("*")->fromNews()->orderBy('ordering desc, id DESC')->limit($limit, $pageNews);
		
		if($CategoryId !=''){
			
			if($listCategory !=null && count($listCategory) >0 ){
				
				$arrayId = array();
				
				foreach($listCategory as $key =>$value){
					
					$arrayId[] =  $value['id'];
				}
				
				$query->where(array('in','categoryId',$arrayId));
			}else{
				
				$query->whereCategoryId($CategoryId);
			}
		}
		
		return $query->result();
	}
	
	
	function countItems($category) {
		$item = _db()->select('count(*) as c')->fromNews()->whereCategoryId($category)->result_one();
		return $item['c'];
	}
	public function getCommonNews() {
		 $data=_db()->useCB()->select("*")->from("news")
            ->limit(3)
            ->orderBy('views desc')
            ->result();
        return $data;
	}
	public function getFLSN()
	{
		$data=_db()->useCB()->select("*")
            ->from("news")
            ->where(array('categoryId',1258))
            ->orderBy('ordering desc, id desc')
            ->result_one();
		return($data);
	}
	public function getListFLSN()
	{
		$data=_db()->useCB()->select("*")
            ->from("news")
            ->where(array('categoryId',1258))
			->limit(4)
            ->orderBy('ordering desc, id desc')
            ->result();
		return($data);
	}
}
 ?>