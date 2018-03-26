<?php 
class PzkCmsFeaturedFeatured extends PzkObject
{
	
	public function getItems()
	{
		$titles=_db()->useCB()->select("*")->from("featured")->where(array('categoryId','0'))->result();
		return($titles);
	}
}
 ?>