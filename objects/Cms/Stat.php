<?php 

/**
* 
*/
class PzkCmsStat extends PzkObject
{
    public $layout = 'cms/stat';
	public $css = 'stat';
	public function init() {
		$this->logVisitor();
	}
	public function logVisitor() {
		$userId = pzk_session()->get('userId');
		if($userId == NULL){
			
			$userId = 0;
		}
		$ip 	= getRealIPAddress();
		$year 	= idate('Y',$_SERVER['REQUEST_TIME']);
		$month 	= idate('m',$_SERVER['REQUEST_TIME']);
		$day 	= idate('d',$_SERVER['REQUEST_TIME']);
		$test	=_db()->useCB()->useCache(3600)->select('id')->from('visitor')
			->where(array('y_time', $year))
			->where(array('m_time', $month))
			->where(array('d_time', $day))
			->where(array('ip', 	$ip))
			->where(array('userId', $userId))
		->result_one();
		if(!$test){
			$country 		= '';
			$city 			= '';
			if(0) {
				$location 	= json_decode(file_get_contents('http://freegeoip.net/json/'.$ip), true);
				$country 	= @$location['country_name'];
				$city = @$location['city'];	
			}
			
			$date			= date('Y/m/d');
			$addLog			=	array('ip'			=>	$ip,
						  'y_time'		=>	$year,
						  'm_time'		=>	$month,
						  'd_time'		=>	$day,
						  'userId'		=>	$userId,
						  'username'	=>	pzk_session()->get('username'),
						  'country'		=>	$country,
						  'city'		=>	$city,
						  'visited'		=>	$date);
			$entity = _db()->useCB()->getEntity('Table')->setTable('visitor');
			$entity->setData($addLog);
			$entity->save();
		}
	}
	public function getMember()
	{
		$content=_db()->useCB()->useCache(3600)->select('count(*) as c')->fromUser()->result_one();
		$member= $content['c'];
		return($member);
	}
	public function getOnline($ip){
		//$userId = pzk_session()->getUserId();
		$ip = getRealIPAddress();
		$time=time();
		$timecheck=time() - 300;
		//$username= _db()->useCB()->select('*')->from('user')->where(array('id',$userId))->result_one();
		$deloutmember=_db()->useCB()->delete()->from('stat_visitor')->ltTime($timecheck)->result();
		$test=_db()->useCB()->select('id')->from('stat_visitor')->where(array('ip', $ip))->result_one();
		if(!$test){
			$addLog=array('time'=>$time,
						  'ip'=>$ip
						  //'userId'=>$userId,
						  //'username'=>$username['username']
						  ) ;
			$entity = _db()->useCB()->getEntity('Table')->setTable('stat_visitor');
			$entity->setData($addLog);
			$entity->save();
		}
		$getonline=_db()->useCB()->select('count(*) as c')->from('stat_visitor')->result_one();	
		$onlinemember=$getonline['c'];
		return($onlinemember);
	}
	public function getDay($ip,$userId){
		$year=date('Y',$_SERVER['REQUEST_TIME']);
		$month=date('m',$_SERVER['REQUEST_TIME']);
		$day=date('d',$_SERVER['REQUEST_TIME']);
		$check=_db()->useCB()->useCache(3600)->select('count(*) as c')
			->from('visitor')
			->where(array('y_time', $year))
			->where(array('m_time', $month))
			->where(array('d_time', $day))
			->result_one();
		$countday=$check['c'];
		return($countday);
	}
	public function getMonth(){
		$year=date('Y',$_SERVER['REQUEST_TIME']);
		$month=date('m',$_SERVER['REQUEST_TIME']);
		$check=_db()->useCB()->useCache(3600)->select('count(*) as c')->from('visitor')
			->where(array('m_time', $month))
			->where(array('y_time', $year))
			->result_one();
		$count=$check['c'];
		return($count);
	}
	public function getName(){
		$username= _db()->useCB()->select('*')->from('stat_visitor')->limit(10)->result();
		return($username);
	}
	public function getLastday(){
		$year=date('Y',$_SERVER['REQUEST_TIME']);
		$month=date('m',$_SERVER['REQUEST_TIME']);
		$day=date('d',$_SERVER['REQUEST_TIME']);
		$result= _db()->useCB()->useCache(3600)->select('count(*) as c')->from('visitor')->where(array('m_time', $month))->where(array('y_time', $year))->where(array('d_time', $day-1))->result_one();
		$count=$result['c'];
		return($count);
	}
	public function getLastmonth(){
		$year=date('Y',$_SERVER['REQUEST_TIME']);
		$month=date('m',$_SERVER['REQUEST_TIME']);
		$result= _db()->useCB()->useCache(3600)->select('count(*) as c')->from('visitor')->where(array('m_time', $month-1))->where(array('y_time', $year))->result_one();
		$count=$result['c'];
		return($count);
	}
	public function getTotal(){
		$result= _db()->useCB()->useCache(3600)->select('count(*) as c')->from('visitor')->result_one();
		$count=$result['c'];
		return($count);
	}
	public function getShowonline(){
		$username= _db()->useCB()->useCache(3600)->select('*')->from('stat_visitor')->result();
		return($username);
	}
	
}
 ?>