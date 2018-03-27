<?php
class PzkNewsModel {
	
	function getNews($id = '', $limit =''){
		
		$query = _db()->select('*')->from('news');
		
		if($limit != ''){
				
			$query->limit($limit);
		}
		
		if($id != ''){
			
			$query->where(array('id', $id));
			
			return $query->result_one();
		}
		
		return $query->result();
	}
	
}