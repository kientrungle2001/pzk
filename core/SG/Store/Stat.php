<?php
class PzkSGStoreStat extends PzkSGStoreLazy {
	public $arrAchievement = array(
		'rights' => 0, 
		'total' => 0,
		'totalPracticeQuestion' => 0, 
		'truePracticeQuestion' => 0, 
		'totalTestPrQuestion' => 0, 
		'trueTestPrQuestion'=>0,
		'totalTestQuestion'=>0, 
		'trueTestQuestion'=>0,
		'areacode' => 0,
		'district' => 0,
		'school' => 0,
		'class' => 0,
		'classname' => '',
		'checkUser' => 0,
		'username' => '',
		'name' => '',
		'category50' => 0,
		'category51' => 0,
		'category52' => 0,
		'category53' => 0,
		'category54' => 0,
		'category59' => 0,
		'category87' => 0,
		'category88' => 0,
		'category157' => 0,
		'category164' => 0,
		'vn_category50' => 0,
		'vn_category51' => 0,
		'vn_category52' => 0,
		'vn_category53' => 0,
		'vn_category54' => 0,
		'vn_category59' => 0,
		'vn_category87' => 0,
		'vn_category88' => 0,
		'vn_category157' => 0,
		'vn_category164' => 0,
		'en_category50' => 0,
		'en_category51' => 0,
		'en_category52' => 0,
		'en_category53' => 0,
		'en_category54' => 0,
		'en_category59' => 0,
		'en_category87' => 0,
		'en_category88' => 0,
		'en_category157' => 0,
		'en_category164' => 0,
		'ev_category50' => 0,
		'ev_category51' => 0,
		'ev_category52' => 0,
		'ev_category53' => 0,
		'ev_category54' => 0,
		'ev_category59' => 0,
		'ev_category87' => 0,
		'ev_category88' => 0,
		'ev_category157' => 0,
		'ev_category164' => 0,
		
	);
	public function log($table, $id) {
		$tables = $this->get('tables');
		if(!$tables) $tables = array();
		if(!isset($tables[$table])) $tables[$table] = array();
		if(!isset($tables[$table][$id])) $tables[$table][$id] = array(
			'hits'	=>	0,
			'ips'	=> 	array()
		);
		$tables[$table][$id]['hits']++;
		$ip	= getRealIPAddress();
		if(!in_array($ip, $tables[$table][$id]['ips'])) {
			$tables[$table][$id]['ips'][] = $ip;
		}
		$this->set('tables', $tables);
	}
	
	
	public function updateIntoDatabase() {
		$tables = $this->get('tables');
		foreach($tables as $table => $stats) {
			foreach($stats as $id => $stat) {
				$hit 		= $stat['hits'];
				$ips 		= $stat['ips'];
				$views 		= count($ips);
				$row = _db()->select('*')->from($table)->where(array('equal', 'id', $id))->result_one();
				$updation = array(
					'views'		=> $row['views'] 	+ 	$views,
					'hits'		=> $row['hits']		+	$hit
				);
				_db()->update($table)->set($updation)->where('id', $id)->result();
			}
		}
		$this->del('tables');
	}
	
	public function logGame($userId, $username, $name, $rights, $total, $areacode, $district, $school, $class, $className, $checkUser) {
		$users = $this->get('users');
		if(!$users) $users = array();
		if(!isset($users[$userId])) $users[$userId] = $this->arrAchievement;
		$users[$userId]['rights'] +=  $rights;
		$users[$userId]['total'] +=  $total;
		
		$users[$userId]['areacode'] = $areacode;
		$users[$userId]['district'] = $district;
		$users[$userId]['school'] = $school;
		$users[$userId]['class'] = $class;
		$users[$userId]['classname'] = $className;
		$users[$userId]['checkUser'] = $checkUser;
		$users[$userId]['username'] = $username;
		$users[$userId]['name'] = $name;
		
		$this->set('users', $users);
	}
	
	public function updateToAchievement(){
		$users = $this->get('users');
		$week = date("W");
		$year = date("Y");
		
		if($users){
			foreach($users as $userId => $item){
				$rights = $item['rights'];
				$total = $item['total'];
				$totalPracticeQuestion = $item['totalPracticeQuestion'];
				$truePracticeQuestion = $item['truePracticeQuestion'];
				$totalTestPrQuestion = $item['totalTestPrQuestion'];
				$trueTestPrQuestion = $item['trueTestPrQuestion'];
				$totalTestQuestion = $item['totalTestQuestion'];
				$trueTestQuestion = $item['trueTestQuestion'];
				
				$areacode = $item['areacode'];
				$district = $item['district'];
				$school = $item['school'];
				$class = $item['class'];
				$className = $item['classname'];
				$checkUser = $item['checkUser'];
				$username = $item['username'];
				$name = $item['name'];
				
				$category50 = $item['category50'];
				$category51 = $item['category51'];
				$category52 = $item['category52'];
				$category53 = $item['category53'];
				$category54 = $item['category54'];
				$category59 = $item['category59'];
				$category87 = $item['category87'];
				$category88 = $item['category88'];
				$category157 = $item['category157'];
				$category164 = $item['category164'];
				
				$vn_category50 = $item['vn_category50'];
				$vn_category51 = $item['vn_category51'];
				$vn_category52 = $item['vn_category52'];
				$vn_category53 = $item['vn_category53'];
				$vn_category54 = $item['vn_category54'];
				$vn_category59 = $item['vn_category59'];
				$vn_category87 = $item['vn_category87'];
				$vn_category88 = $item['vn_category88'];
				$vn_category157 = $item['vn_category157'];
				$vn_category164 = $item['vn_category164'];
				
				$en_category50 = $item['en_category50'];
				$en_category51 = $item['en_category51'];
				$en_category52 = $item['en_category52'];
				$en_category53 = $item['en_category53'];
				$en_category54 = $item['en_category54'];
				$en_category59 = $item['en_category59'];
				$en_category87 = $item['en_category87'];
				$en_category88 = $item['en_category88'];
				$en_category157 = $item['en_category157'];
				$en_category164 = $item['en_category164'];
				
				$ev_category50 = $item['ev_category50'];
				$ev_category51 = $item['ev_category51'];
				$ev_category52 = $item['ev_category52'];
				$ev_category53 = $item['ev_category53'];
				$ev_category54 = $item['ev_category54'];
				$ev_category59 = $item['ev_category59'];
				$ev_category87 = $item['ev_category87'];
				$ev_category88 = $item['ev_category88'];
				$ev_category157 = $item['ev_category157'];
				$ev_category164 = $item['ev_category164'];
				
				
				$entity = _db()->useCb()->getEntity('table')->setTable('achievement');
				$entity->loadWhere( array(
				'and',
					array('userId', $userId),
					array('week', $week),
					array('year', $year)
				) );
				if($entity->get('id')){
					$row = $entity->getData();
					
					
					$updation = array(
						'rights'		=> $row['rights'] 	+ 	$rights,
						'total'		=> $row['total']		+	$total,
						'totalPracticeQuestion' => $row['totalPracticeQuestion'] + $totalPracticeQuestion,
						'truePracticeQuestion' => $row['truePracticeQuestion'] + $truePracticeQuestion,
						'totalTestPrQuestion' => $row['totalTestPrQuestion'] + $totalTestPrQuestion,
						'trueTestPrQuestion' => $row['trueTestPrQuestion'] + $trueTestPrQuestion,
						'totalTestQuestion' => $row['totalTestQuestion'] + $totalTestQuestion,
						'trueTestQuestion' => $row['trueTestQuestion'] + $trueTestQuestion,
						'category50' => $row['category50'] + $category50,
						'category51' => $row['category51'] + $category51,
						'category52' => $row['category52'] + $category52,
						'category53' => $row['category53'] + $category53,
						'category54' => $row['category54'] + $category54,
						'category59' => $row['category59'] + $category59,
						'category87' => $row['category87'] + $category87,
						'category88' => $row['category88'] + $category88,
						'category157' => $row['category157'] + $category157,
						'category164' => $row['category164'] + $category164,
						
						'vn_category50' => $row['vn_category50'] + $vn_category50,
						'vn_category51' => $row['vn_category51'] + $vn_category51,
						'vn_category52' => $row['vn_category52'] + $vn_category52,
						'vn_category53' => $row['vn_category53'] + $vn_category53,
						'vn_category54' => $row['vn_category54'] + $vn_category54,
						'vn_category59' => $row['vn_category59'] + $vn_category59,
						'vn_category87' => $row['vn_category87'] + $vn_category87,
						'vn_category88' => $row['vn_category88'] + $vn_category88,
						'vn_category157' => $row['vn_category157'] + $vn_category157,
						'vn_category164' => $row['vn_category164'] + $vn_category164,
						
						'en_category50' => $row['en_category50'] + $en_category50,
						'en_category51' => $row['en_category51'] + $en_category51,
						'en_category52' => $row['en_category52'] + $en_category52,
						'en_category53' => $row['en_category53'] + $en_category53,
						'en_category54' => $row['en_category54'] + $en_category54,
						'en_category59' => $row['en_category59'] + $en_category59,
						'en_category87' => $row['en_category87'] + $en_category87,
						'en_category88' => $row['en_category88'] + $en_category88,
						'en_category157' => $row['en_category157'] + $en_category157,
						'en_category164' => $row['en_category164'] + $en_category164,
						
						'ev_category50' => $row['ev_category50'] + $ev_category50,
						'ev_category51' => $row['ev_category51'] + $ev_category51,
						'ev_category52' => $row['ev_category52'] + $ev_category52,
						'ev_category53' => $row['ev_category53'] + $ev_category53,
						'ev_category54' => $row['ev_category54'] + $ev_category54,
						'ev_category59' => $row['ev_category59'] + $ev_category59,
						'ev_category87' => $row['ev_category87'] + $ev_category87,
						'ev_category88' => $row['ev_category88'] + $ev_category88,
						'ev_category157' => $row['ev_category157'] + $ev_category157,
						'ev_category164' => $row['ev_category164'] + $ev_category164
					
						
					);
					//debug($updation);die();	
					$entity->update($updation);
					$entity->save();
					
				}else{
					$updation = array(
						'userId' => $userId,
						'rights'		=> $rights,
						'total'		=> $total,
						'totalPracticeQuestion' => $totalPracticeQuestion,
						'truePracticeQuestion' =>  $truePracticeQuestion,
						'totalTestPrQuestion' =>  $totalTestPrQuestion,
						'trueTestPrQuestion' =>  $trueTestPrQuestion,
						'totalTestQuestion' =>  $totalTestQuestion,
						'trueTestQuestion' =>  $trueTestQuestion,
						'week' => $week,
						'year' => $year,
						'software' => pzk_request()->getSoftwareId(),
						'areacode' => $areacode,
						'district' => $district,
						'school' => $school,
						'class' => $class,
						'classname' => $className,
						'checkUser' => $checkUser,
						'username' => $username,
						'name' => $name,
						'category50' => $category50,
						'category51' => $category51,
						'category52' => $category52,
						'category53' =>  $category53,
						'category54' => $category54,
						'category59' => $category59,
						'category87' => $category87,
						'category88' => $category88,
						'category157' => $category157,
						'category164' => $category164,
						
						'vn_category50' => $vn_category50,
						'vn_category51' => $vn_category51,
						'vn_category52' => $vn_category52,
						'vn_category53' =>  $vn_category53,
						'vn_category54' => $vn_category54,
						'vn_category59' => $vn_category59,
						'vn_category87' => $vn_category87,
						'vn_category88' => $vn_category88,
						'vn_category157' => $vn_category157,
						'vn_category164' => $vn_category164,
						
						'en_category50' => $en_category50,
						'en_category51' => $en_category51,
						'en_category52' => $en_category52,
						'en_category53' =>  $en_category53,
						'en_category54' => $en_category54,
						'en_category59' => $en_category59,
						'en_category87' => $en_category87,
						'en_category88' => $en_category88,
						'en_category157' => $en_category157,
						'en_category164' => $en_category164,
						
						'ev_category50' => $ev_category50,
						'ev_category51' => $ev_category51,
						'ev_category52' => $ev_category52,
						'ev_category53' =>  $ev_category53,
						'ev_category54' => $ev_category54,
						'ev_category59' => $ev_category59,
						'ev_category87' => $ev_category87,
						'ev_category88' => $ev_category88,
						'ev_category157' => $ev_category157,
						'ev_category164' => $ev_category164
						
						
						
					);
					
					$entity->setData($updation);
					$entity->save();
				}	
				
			}
		}
		
		$this->delUsers();
	}
	public function logPracticeQuestion($userId, $username, $name, $truePracticeQuestion, $totalPracticeQuestion, $areacode, $district, $school, $class, $className, $checkUser, $categoryId, $number, $lang) {
		$users = $this->get('users');
		if(!$users) $users = array();
		if(!isset($users[$userId])) $users[$userId] = $this->arrAchievement;
		$users[$userId]['totalPracticeQuestion'] +=  $totalPracticeQuestion;
		$users[$userId]['truePracticeQuestion'] +=  $truePracticeQuestion;
		$users[$userId]['category'.$categoryId] += $number;
		$users[$userId][$lang.'_category'.$categoryId] += $number;
		
		$users[$userId]['areacode'] = $areacode;
		$users[$userId]['district'] = $district;
		$users[$userId]['school'] = $school;
		$users[$userId]['class'] = $class;
		$users[$userId]['classname'] = $className;
		$users[$userId]['checkUser'] = $checkUser;
		$users[$userId]['username'] = $username;
		$users[$userId]['name'] = $name;
		
		
		$this->set('users', $users);
	}
	public function logTestPrQuestion($userId, $username, $name, $trueTestPrQuestion, $totalTestPrQuestion, $areacode, $district, $school, $class, $className, $checkUser) {
		$users = $this->get('users');
		if(!$users) $users = array();
		if(!isset($users[$userId])) $users[$userId] = $this->arrAchievement;
		$users[$userId]['totalTestPrQuestion'] +=  $totalTestPrQuestion;
		$users[$userId]['trueTestPrQuestion'] +=  $trueTestPrQuestion;
		
		$users[$userId]['areacode'] = $areacode;
		$users[$userId]['district'] = $district;
		$users[$userId]['school'] = $school;
		$users[$userId]['class'] = $class;
		$users[$userId]['classname'] = $className;
		$users[$userId]['checkUser'] = $checkUser;
		$users[$userId]['username'] = $username;
		$users[$userId]['name'] = $name;
		
		$this->set('users', $users);
	}
	public function logTestQuestion($userId, $username, $name, $trueTestQuestion, $totalTestQuestion, $areacode, $district, $school, $class, $className, $checkUser) {
		$users = $this->get('users');
		if(!$users) $users = array();
		if(!isset($users[$userId])) $users[$userId] = $this->arrAchievement;
		$users[$userId]['totalTestQuestion'] +=  $totalTestQuestion;
		$users[$userId]['trueTestQuestion'] +=  $trueTestQuestion;
		
		$users[$userId]['areacode'] = $areacode;
		$users[$userId]['district'] = $district;
		$users[$userId]['school'] = $school;
		$users[$userId]['class'] = $class;
		$users[$userId]['classname'] = $className;
		$users[$userId]['checkUser'] = $checkUser;
		$users[$userId]['username'] = $username;
		$users[$userId]['name'] = $name;
		
		$this->set('users', $users);
	}
}