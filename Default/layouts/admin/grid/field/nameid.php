<?php
    $table = $data->getTable();
    $findField = $data->getFindField();
    $showField = $data->getShowField();
	$conditions = pzk_or($data->getConditions(), '1');

    $Ids = $data->getValue();
    $name = '';
    if(is_string($Ids) && $Ids) {
        $arrIds = explode(',', trim($Ids, ','));
        if($arrIds) {
			if(pzk_global()->has('nameid'.$table)) {
				$arrAllField = pzk_global()->get('nameid'.$table);
			} else {
				$arrAllField = _db()->useCache(1800)->select('*')->from($table)->where($conditions)->result();
				pzk_global()->set('nameid'.$table, $arrAllField);
			}
            
            foreach($arrAllField as $item) {
                if(in_array($item[$findField], $arrIds)){
                    $name .= $item[$showField].', ';
                }
            }
            $name = substr($name,0,-2);
        }
    }elseif(is_int($Ids) && $Ids) {
        $name = _db()->useCache(1800)->select('*')->from($table)->where(array($findField, $Ids))->where($conditions)->result_one();
        $name = $name[$showField];
    }
?>
<?php echo $name; ?>