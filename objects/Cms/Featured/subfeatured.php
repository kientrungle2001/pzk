<?php 
class PzkCmsFeaturedSubfeatured extends PzkObject
{

	public function getNews2($category, $page=0)
	{
		$data=_db()->useCB()->select("*")
            ->from("featured")
            ->limit(10, $page)
            ->orderBy('id desc')
            ->result();
		return($data);
	}

	
	
	function countItems() {
		$item = _db()->select('count(*) as c')->fromFeatured()->result_one();
		return $item['c'];
	}
}
 ?>