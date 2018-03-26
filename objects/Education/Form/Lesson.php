<?php 
class PzkEducationFormLesson extends PzkObject {
	function getParentById($parentId) {
		$query = _db()->select('*')
			->from('categories')
			->where("id='$parentId'");
			$data = $query->result_one();
			
			return $data;
	}
	
	function getDocumentById($id) {
		$query = _db()->select('*')
			->from('document')
			->where("categoryId='$id'");
			$data = $query->result_one();
			
			return $data;
	}
}
?>