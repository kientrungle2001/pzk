<?php
class PzkGetdataController extends PzkController{
	public function insertProvinceAction() {
		
	}
	
	public function updateCityAction() {
		set_time_limit(0);
		ob_implicit_flush(true);
		echo 'Start: '. date('H:i:s') . '<br />';
		$cities = $this->getCities();
		$index = 1;
		foreach($cities as $city) {
			
			echo ($index++) . '.'. $city['name'];
			if($index == 2) continue;
			$myCity = _db()->selectAll()->fromAreacode()->whereName($city['name'])->result_one();
			if($myCity) {
				echo ' - <span style="color: red;">' . $myCity['name'] . '</span><br />';
				
				$this->updateDistrictByIdAction($myCity['id'], $city['id']);
			}
			echo '<br />';
		}
		echo 'End: '. date('H:i:s') . '<br />';
		ob_implicit_flush(false);
	}
	
	public function cityAction() {
		$cities = $this->getCities();
		debug($cities);
	}
	
	public function getCities() {
		set_time_limit(0);
		$cache = pzk_filecache()->getDangkyTrangNguyen();
		if($cache) {
			$file = $cache;
		} else {
			$opts = array(
			  'http'=>array(
				'method'=>"GET",
				'header'=>"Accept-language: en\r\n" .
						  "Cookie: foo=bar\r\n"
			  )
			);

			$context = stream_context_create($opts);
			$url = "http://trangnguyen.edu.vn/dang-ky";

			$file = file_get_contents($url, false, $context);	
			pzk_filecache()->setDangkyTrangNguyen($file);
		}
		
		//echo html_escape($file);
		$parts = explode('<option value="0">Chọn Tỉnh/Thành phố</option>', $file);
		$parts = explode('</select>', $parts[1]);
		//echo html_escape($parts[0]);
		preg_match_all('/<option value="([\d]+)">([^<]+)<\/option>/', $parts[0], $matches);
		
		$result = array();
		foreach($matches[1] as $index => $id) {
			$result[] = array(
				'id'	=> $id,
				'name'	=> trim($matches[2][$index])
			);
		}
		return $result;
	}
	
	public function updateDistrictByIdAction($id, $idweb){
		set_time_limit(0);
		$opts = array(
		  'http'=>array(
			'method'=>"GET",
			'header'=>"Accept-language: en\r\n" .
					  "Cookie: foo=bar\r\n"
		  )
		);

		$context = stream_context_create($opts);
		$url = "http://trangnguyen.edu.vn/district/api/list/".$idweb;

		$file = file_get_contents($url, false, $context);
		
		$data = json_decode($file, true);
		$data = $data['content'];
		
		foreach($data as $item){
			$name = $item['name'];
			$idhuyenweb = $item['_id'];
			$row = array(
				'name' => $name,
				'parent' => $id,
				'type' => 'district',
				'status' => 1
			);
			echo $name . '<br />';
			$entity = _db()->useCb()->getEntity('Table')->setTable('areacode');
            $entity->setData($row);
            $entity->save();
			$idHuyencurrentInsert = $entity->getId();
			
			$this->insertSchoolByIdAction($idHuyencurrentInsert, $idhuyenweb);
			
		}
		
	}
	
	public function insertSchoolByIdAction($id, $idweb){
		$opts = array(
		  'http'=>array(
			'method'=>"GET",
			'header'=>"Accept-language: en\r\n" .
					  "Cookie: foo=bar\r\n"
		  )
		);

		$context = stream_context_create($opts);
		$url = "http://trangnguyen.edu.vn/school/api/list/".$idweb;

		$file = file_get_contents($url, false, $context);
		
		$data = json_decode($file, true);
		$data = $data['content'];
		//debug($data);die();
		foreach($data as $item){
			$name = $item['name'];
			
			$row = array(
				'name' => $name,
				'parent' => $id,
				'type' => 'school',
				'status' => 1
			);
			
			$entity = _db()->useCb()->getEntity('Table')->setTable('areacode');
        
            
            $entity->setData($row);
            $entity->save();
		}
		
		
		
	}
	
	public function updateSchoolByTinh($idTinh){
		$datahuyen = _db()->useCb()->select('id')->fromAreacode()->whereParent($idTinh)->result();
		foreach($datahuyen as $item){
			
		}
	}
	
	//province: tinh thanh pho
	//district: quan huyen
	//school: truong
	// update `areacode` set `type` ='province'
}
?>