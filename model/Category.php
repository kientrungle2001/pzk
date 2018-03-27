<?php
class PzkCategoryModel {
	
	function get_category($id = ''){
		
		$data = "";
		
		if(!empty($id)){
			$query = _db()->useCache(3600)->useCacheKey('category-id-' . $id)->select('*')
			->from('categories')
			->orderBy('ordering asc')
			->where("id='$id'");
			$data = $query->result_one();
		}else{
			$query = _db()->useCache(3600)->useCacheKey('all-categories-ordering-asc')->select('*')
			->orderBy('ordering asc')
			->from('categories');
			$data = $query->result();
		}
		return $data;
	}
	
	
	function get_category_all($id = ''){
		
		if(!empty($id)){
			
			$query = _db()->useCache(3600)->select('ct.*')->useCacheKey('get-categories-all-id' . $id) ->from('categories ct') ->where("ct.id='$id'");
			
			$results = $query->result();
			
			if(count($results) >0){
				
				$category = $results[0];
				
				$category['child']	=	$this->get_category_child($id);
				
				$category['root']	=	$this->get_category_root($id);
				
				return $category;
			}
		}
		return NULL;
	}
	
	function get_category_root($id = ''){
		
		if(!empty($id)){
			
			$category_parent = $this->get_category($id);
			
			$parent_id = $category_parent['parent'];
			
			if($parent_id == 0){
				
				return $id;
			}
			
			return $this->get_category_root($parent_id);
		}
		
		return NULL;
	}
	
	function get_category_parent($id = ''){
		
		if(!empty($id)){
				
			$category_parent = $this->get_category($id);
				
			$parent_id = $category_parent['parent'];
			
			return $parent_id;
		}
		return NULL;
	}
	
	function get_category_child($id = ''){
		
		if(!empty($id)){
			
			$query = _db()->useCache(3600)->useCacheKey('get_category_child_id_'.$id)->select('ct.*') ->from('categories ct') ->where("ct.parent='$id'");
			
			if(count($query->result()) >0){
				
				return $query->result();
			}
			return NULL;
		}
		return NULL;
	}
	
	function get_category_all_display($id = '', $check = NULL){
		if(!empty($id)){
				
			$query = _db()->useCache(3600)
			->useCacheKey('get_category_all_display_id_' . $id . '_'.$check)
			->select('ct.*')
			->from('categories ct')
			->orderBy('ordering asc')
			->where("ct.id='$id'");
			
			$results = $query->result();
				
			if(count($results) >0){
	
				$category = $results[0];
	
				$category['child']	=	$this->get_category_child_display($id, $check);
	
				return $category;
			}
		}
		return NULL;
	}
	
	function get_category_child_display($id = '', $check = NULL){
	
		if(!empty($id)){
				
			$query = _db()->useCache(3600)
			->useCacheKey('get_category_child_display_id_'.$id.'_'.$check)
			->select('ct.*')
			->from('categories ct')
			->where("ct.parent='$id'")
			->orderBy('ordering asc')
			->where("ct.display='1'");
			
			if($check !== NULL && !$check){
				$query->where(array('trial', 1));
			}
			
			if(count($rows = $query->result()) >0){
	
				return $rows;
			}
		}
		return NULL;
	}
	function get_category_all_display_sn($id = '', $class , $check = NULL){
		if(!empty($id)){
				
			$query = _db()->useCache(3600)->select('*') 
			->from('categories')
			->whereId($id)
			->orderBy('ordering asc')
			->likeClasses('%,'.$class.',%');
			
			
			$results = $query->result();
			
			if(count($results) >0){
	
				$category = $results[0];
	
				$category['child']	=	$this->get_category_child_display_sn($id, $class , $check);
	
				return $category;
			}
		}
		return NULL;
	}
	
	function get_category_child_display_sn($id = '', $class , $check = NULL){
	
		if(!empty($id)){
				
			$query = _db()->useCache(3600)->select('*')
			->from('categories')
			->whereParent($id)
			->whereDisplay(1)
			->orderBy('ordering asc')
			->likeClasses('%,'.$class.',%');
			
			if($check !== NULL && !$check){
				$query->where(array('trial', 1));
			}
			
			if(count($rows = $query->result()) >0){
	
				return $rows;
			}
		}
		return NULL;
	}
	function getAllCategoryLink(){
		
		$result = $this->get_category();
		
		return $result;
	}
	
	/**
	 * get category childs of category root
	 * @param unknown $root_id
	 */
	function get_Child_Root($root_id = '', $list_category = array()){
		 
		if(!empty($root_id)){
	
			$list_category = $this->get_category_child_display($root_id);
			
			if(!empty($list_category) && is_array($list_category)){
				
				foreach($list_category as $k =>$value){
					
					$list_category[$k]['child'] = $this->get_category_child_display($value['id']);
				}
			}
			return $list_category;
		}
		return NULL;
	}
	
	function getQuestionTypes($category_id){
		
		if(!empty($category_id)){
			$query = _db()->useCache(3600)->select('question_types')
			->from('categories')
			->where("id='$category_id'");
			$data = $query->result_one();
			
			return $data['question_types'];
		}
		return null;
	}
	
	
}