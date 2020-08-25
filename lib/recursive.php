<?php 
/**
 * Function : Recursive
 * Author   : JosT
 * Date     : Dec 6, 2014
 */

	function buildArr($data, $columnName, $parentValue = 0)
	{
		recursive($data, $columnName, $parentValue, 1, $resultArr);
		return $resultArr;
	}
	
	function recursive($data,$columnName = "",$parentValue = 0, $level = 1,&$resultArr)
	{
		if(count($data) > 0){
			foreach ($data as $key => $value) {
                if(isset($value['parent'])) {
                    if($value['parent'] == $parentValue){
                        $value['level'] = $level;
                        $resultArr[] = $value;
                        $newParent = $value['id'];
                        unset($data[$key]);
                        recursive($data,$columnName,$newParent,$level+1,$resultArr);
                    }
                }elseif(isset($value['parentId'])) {
                    if($value['parentId'] == $parentValue){
                        $value['level'] = $level;
                        $resultArr[] = $value;
                        $newParent = $value['id'];
                        unset($data[$key]);
                        recursive($data,$columnName,$newParent,$level+1,$resultArr);
                    }
                }

			}
		}
	}

    function buildTree(array $elements, $parentId = 0) {
        $branch = array();
        foreach ($elements as $key1=>$element) {
            if ($element['parent'] == $parentId) {
                $children = buildTree($elements, $element['id']);
                if ($children) {
                    $element['children'] = $children;
                }
                $branch[] = $element;
            }
        }

        return $branch;
    }
	
	function makeTree(&$items) {
		$tree = array();
		$total = count($items);
		for($i = 0; $i < $total; $i++) {
			$items[$i]['itemIndex'] = $i;
			$items[$i]['hasParent'] = false;
		}
		for($i = 0; $i < $total; $i++) {
			for($j = $i + 1; $j < $total; $j++) {
				if($items[$j]['parent'] == $items[$i]['id']) {
					$items[$j]['hasParent'] = true;
					if(!isset($items[$i]['childrenIndexes'])) {
						$items[$i]['childrenIndexes'] = array();
					}
					$items[$i]['childrenIndexes'][] = $j;
				} else if($items[$i]['parent'] == $items[$j]['id']) {
					$items[$i]['hasParent'] = true;
					if(!isset($items[$j]['childrenIndexes'])) {
						$items[$j]['childrenIndexes'] = array();
					}
					$items[$j]['childrenIndexes'][] = $i;
				}
			}
		}
		
		for($i = 0; $i < $total; $i++) {
			if($items[$i]['hasParent'] == false) {
				$tree[] = $items[$i]['itemIndex'];
			}
		}
		
		return $tree;
	}
	
	function parseTree(&$items, $tree, &$result, $level = 1) {
		foreach($tree as $index) {
			$items[$index]['level'] = $level;
			$result[] = $items[$index];
			if(isset($items[$index]['childrenIndexes'])) {
				parseTree($items, $items[$index]['childrenIndexes'],$result, $level+1);
			}
		}
	}
	
	function treefy(&$items) {
		$tree = makeTree($items);
		$result = array();
		parseTree($items, $tree, $result);
		return $result;
	}

    function show_menu($array = array(), $firstUlClass='nav nav-justified multi-level', $ulClass = 'dropdown-menu', $liClass = 'dropdown', $first = true)
    {
		static $currentCategory;
		if(!$currentCategory) {
			$currentCategory = _db()->getTableEntity('categories')->load(pzk_request()->getSegment(3));
		}
        echo '<ul class="' . ( $first? $firstUlClass : $ulClass ) . '">';
        foreach ($array as $item) {
        	$class_action = ' class="'.$liClass.'"';
            echo '<li'.$class_action.'>';
			$href = '';
			if(strpos($item['router'], 'http://') !== false) {
				$href = $item['router'];
			} else {
				if(SEO_MODE && @$item['alias']) {
					$href = '/' . @$item['alias'];
				} else {
					$href = pzk_request()->build($item['router'].'/'.$item['id']);
				}
				
			}
			
			
			$active = strpos($currentCategory->getParents(), ',' . $item['id'] . ',') !== false ? 'active': '';
            echo '<a class="'.$active.' dropdown-toggle menu_item_'.$item['id'].'" href="'.$href.'">';
            echo $item['name'];
            echo '</a>';
            if (!empty($item['children']))
            {
                show_menu($item['children'], $firstUlClass, $ulClass, $liClass, false);
            }
            echo '</li>';
        }
        echo '</ul>';
    }
	
	function buildBs($data) {
		foreach($data as $val) {
			$parentId = $val['parent'];
			$dataXuli[$parentId][] = $val; 
		}
		return $dataXuli;
	}
	
	function showBsMenu($dataXuli, $parentId=0)
    {
		if(isset($dataXuli[$parentId])) {
		echo "<ul class='dropdown-menu'>";
		foreach($dataXuli[$parentId] as $key => $val) {
			echo "<li>";
			$parentId = $val['id'];
			if(isset($dataXuli[$parentId])) {
				echo "<a class='link' href='javascript:void(0);'>".$val['name']."</a>";
			}else {
				echo "<a href='#view$parentId'>".$val['name']."</a>";
			}
			unset($dataXuli[$key]);
			showBsMenu($dataXuli, $parentId);
			echo "</li>";	
		}
		echo "</ul>";
		}
    }
	
	

	function showAdminMenu($array = array(), $level = 0){
    	echo '<ul class="drop">';
        foreach ($array as $item){
        	$class_action = "";
            echo '<li'.$class_action.'>';
            if(substr($item['admin_controller'], 0, 1) == '0'){
                echo '<a href="javarscript:void(0);">';
            }else {
                echo '<a href="/'.$item['admin_controller'].'/index">';
            }
            echo $item['name'];
			if (!empty($item['children']))
            {
				if($level === 0)
					echo ' <i class="glyphicon glyphicon-chevron-down"></i>';
				else
					echo ' <i class="glyphicon glyphicon-chevron-right"></i>';
			}
            echo '</a>';
            if (!empty($item['children']))
            {
				
                showAdminMenu($item['children'], $level + 1);
            }
            echo '</li>';
        }
        echo '</ul>';
    }
	
	
	
	function get_value_question_tyle($data = array(), $question_key){
		
		if(is_array($data)){
			
			foreach($data as $key	=> $value){
				
				if($question_key == $value['question_type']){
					
					return $value;
					
					break;
				}
			}
		}
		return false;
	}
    //ma hoa chuoi
    function encrypt($pure_string, $encryption_key) {
        $iv_size = mcrypt_get_iv_size(MCRYPT_BLOWFISH, MCRYPT_MODE_ECB);
        $iv = mcrypt_create_iv($iv_size, MCRYPT_RAND);
        $encrypted_string = mcrypt_encrypt(MCRYPT_BLOWFISH, $encryption_key, utf8_encode($pure_string), MCRYPT_MODE_ECB, $iv);
        return $encrypted_string;
    }

    /**
     * Returns decrypted original string
     */
    function decrypt($encrypted_string, $encryption_key) {
        $iv_size = mcrypt_get_iv_size(MCRYPT_BLOWFISH, MCRYPT_MODE_ECB);
        $iv = mcrypt_create_iv($iv_size, MCRYPT_RAND);
        $decrypted_string = mcrypt_decrypt(MCRYPT_BLOWFISH, $encryption_key, $encrypted_string, MCRYPT_MODE_ECB, $iv);
        return $decrypted_string;
    }
    
    function setSuperType($type){
    	
    	$superType = 'choice';
    	
    	if($type == 'Q0'|| $type =='Q4' || $type =='Q19'){
    		
    		$superType = "choice";
    			
    	}elseif($type == 'Q8'){
    		
    		$superType = "choice_ex";
    			
    	}elseif($type == 'Q20'){

    		$superType = "fill_one";
    			
    	}elseif($type == 'Q1'){
    			
    		$superType = "fill_two";
    			
    	}elseif($type == 'Q9'|| $type == 'Q10'|| $type == 'Q11'|| $type == 'Q12'|| $type == 'Q13'|| $type == 'Q14'){
    			
    		$superType = "fill_one_text";
    			
    	}elseif($type == 'Q2' || $type == 'Q3' || $type == 'Q5' || $type == 'Q6' || $type == 'Q22' || $type == 'Q23'){

    		$superType = "fill_many";
    			
    	}elseif($type == 'Q15' || $type == 'Q16' || $type == 'Q17' || $type == 'Q18'){

    		$superType = "fill_many_text";
    			
    	}elseif($type == 'Q7'){
    		
    		$superType = "fill_table";
    			
    	}elseif($type == 'Q25'){
    		
    		$superType = "fill_table_text";
    			
    	}elseif($type == 'Q21' || $type == 'Q24' || $type == 'Q26' || $type == 'Q27' || $type == 'Q28' || $type == 'Q29' || $type == 'Q30'){

    		$superType = "fill_text";
    	}elseif($type == 'DT') {
			$superType = "fill_word";
		}elseif($type == 'TL'){
			$superType = "tuluan";
		}
    	
    	return $superType;
    }
    
    function setContentType($str = ''){
    	
    	if(!empty($str)){
    		
    		$content = array();
    			
	    	if(!is_array($str)){
	    		
	    		$content = convertContentArray($str);
	    	}else{
	    		
	    		$isFillTable = strpos($str['content'],'@');
	    		
	    		if(!$isFillTable){
	    			
	    			$content = convertContentArray($str['content']);
	    		}else{
	    			
	    			$content = explode('@', $str['content']);
	    			
	    			foreach($content as $key => $value){
	    				
	    				$content[$key] = convertContentArray($value);
	    			}
	    		}
	    	}
	    	return $content;
    	}
    	return null;
    }
    
    function convertContentArray($str = ''){
    	
    	if(!empty($str)){
    		
    		$content = explode('|', $str);
    		
    		foreach ($content as $key => $value){
    			 
    			$is_check = strpos($value,'_');
    			if($is_check != 0){
    		
    				$content[$key] 	 		= str_replace('_', '', $value);
    				$content['main'] 		= str_replace('_', '', $value);
    			}else{
    		
    				$content[$key]		 	= $value;
    				$content['extra'] 		= $value;
    			}
    		}
    		return $content;
    	}
    	return null;
    }
    
    function checkArray($str ="", $hashArray = array(), $k = "content"){
    	
    	if(!empty($str) && is_array($hashArray)){
    		$dataArray = array();
    		foreach ($hashArray as $key =>$value){
    			$dataArray[] = trim($value[$k]);
    		}
    		if(in_array(trim($str), $dataArray)){
    			
    			return true;
    		}
    	}
    	return false;
    }
    
    function questionTypeOjb($questionType){
    	
    	$typeOjb = '';
    	
    	if($questionType == QUESTION_TYPE_CHOICE){
    	
    		$typeOjb = "choice";
    		 
    	}elseif($questionType == QUESTION_TYPE_FILL){
    	
    		$typeOjb = "fill";
    		 
    	}elseif($questionType == QUESTION_TYPE_FILL_JOIN){
    	
    		$typeOjb = "join";
    		 
    	}
		elseif($questionType == QUESTION_TYPE_TULUAN){
    	
    		$typeOjb = "tuluan";
    		 
    	}
    	return $typeOjb;
    }
    
    function numPage($quantity){
    	$numpage= ceil($quantity/3);
    	return $numpage;
    }
    

 ?>