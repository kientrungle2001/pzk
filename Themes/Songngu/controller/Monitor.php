<?php
class PzkMonitorController extends PzkController {
	public $masterPage = 'education/monitor/index';
	public $masterPosition = 'wrapper';
	public $emptyStudents = array(
		'items'			=> array(),
		'totalItems'	=> 0,
		'currentPage'	=> 0
	);
	public function showEmptyStudents() {
		echo json_encode($this->emptyStudents);
		pzk_system()->halt();
	}
	public function indexAction() {
		$this->initPage();
			pzk_page()->set('title', 'Quản lí');
			pzk_page()->set('keywords', 'Quản lí');
			pzk_page()->set('description', 'Quản lí');
			pzk_page()->set('img', '/Default/skin/nobel/Themes/Story/media/logo.png');
			pzk_page()->set('brief', 'Phần mềm Full Look, Phần mềm luyện thi vào lớp 6 Trần Đại Nghĩa');
			$this->append('education/monitor/manage');
			$this->display();
	}
	public function studentAction($id){
			$this->initPage();
			pzk_page()->set('title', 'Chi tiết học sinh');
			pzk_page()->set('keywords', 'Chi tiết học sinh');
			pzk_page()->set('description', 'Chi tiết học sinh dùng phần mềm Full Look');
			pzk_page()->set('img', '/Default/skin/nobel/Themes/Story/media/logo.png');
			pzk_page()->set('brief', 'Phần mềm Full Look, Phần mềm luyện thi vào lớp 6 Trần Đại Nghĩa');
			$this->append('education/monitor/student');
			$this->display();
	}
	public function resultAchievementByWeekAction(){
		$val = pzk_request('val');
		$userId = pzk_request('userId');
		$tam = explode('-', $val);
		$week = $tam[0];
		$year = $tam[1];
		pzk_session('resWeekAchievement', $week);
		pzk_session('resYearAchievement', $year);
        $this->redirect('monitor/student/'.$userId);
	}
	public function filterDataByWeekAction() {
		$val = pzk_request('val');
		$userId = pzk_request('userId');
		$tam = explode('-', $val);
		$week = $tam[0];
		$year = $tam[1];
		pzk_session('weekHistory', $week);
		pzk_session('yearHistory', $year);
        $this->redirect('monitor/student/'.$userId);
	}
	public function areacodeAction ($parent) {
		$adminAreacode 	= pzk_session('adminAreacode');
		$adminDistrict 	= pzk_session('adminDistrict');
		$adminSchool 	= pzk_session('adminSchool');
		$adminClass		= pzk_session('adminClass');
		$adminClassname	= pzk_session('adminClassname');
		// truong hop tinh
		if($adminAreacode && !$adminDistrict) {
			if(!$parent) {
				$parent = 0;
			}
		}
		// truong hop huyen
		if($adminDistrict && !$adminSchool) {
			if(!$parent) {
				$parent = $adminAreacode;
			}
		}
		// truong hop truong
		if($adminSchool && !$adminClass) {
			if(!$parent) {
				$parent = $adminDistrict;
			}
		}
		if(!$parent) $parent = '0';
		$parentAreacode = null;
		if($parent)
			$parentAreacode = _db()->selectAll()->fromAreacode()->whereId($parent)->result_one();
		
		$areacode = _db()->selectAll()->fromAreacode()->whereParent($parent);
		if($parent == 0) {
			if($adminAreacode) {
				$areacode->likeParents('%,' . $adminAreacode . ',%');
			}
		} else {
			
			if($parentAreacode['type'] == 'province' && $adminDistrict) {
				$areacode->whereId($adminDistrict);
			} else if($parentAreacode['type'] == 'district' && $adminSchool) {
				$areacode->whereId($adminSchool);
			}
		}
			
		
		$areacode = $areacode->result();
		foreach($areacode as &$ac) {
			$ac['text'] = $ac['name'];
			$ac['state'] = array('opened' => false);
			unset($ac['parent']); 	unset($ac['parents']); 		unset($ac['status']);
			unset($ac['type']); 	unset($ac['name']);			unset($ac['ordering']);
			unset($ac['created']); 	unset($ac['creatorId']); 	unset($ac['modified']);
			unset($ac['modifiedId']);
			$ac['children']	= true;
		}
		if(!count($areacode)){
			
			for($i = 3; $i < 6; $i++) {
				if($adminClass && $i != $adminClass) continue;
				$classNames = array();
				$allClassNames = _db()->select('distinct(className)')
					->fromUser()
					->whereClass($i)
					->whereSchool($parent);
				if($adminClassname) {
					$allClassNames->whereClassname($adminClassname);
				}
				$allClassNames = $allClassNames->result();
				foreach($allClassNames as $user) {
					$classNames[] = array(
						'text'		=> $user['className'],
						'id'		=> $parent . '-'.$i.'-' . $user['className'],
						'state'		=> array('opened' => false),
						'children'	=> false
					);
				}
				$areacode[] =  array(
					'text'		=> 'Lớp '.$i,
					'id'		=> $parent . '-' . $i,
					'state'		=> array('opened' => false),
					'children'	=> $classNames
				);
			}
		}
		if($parent == '0' && !$adminAreacode) {
			$areacode = array(
				'children'	=> $areacode,
				'text'		=> 'Cả nước',
				'id'		=> '0',
				'state'		=> array('opened' => true)
			);
		}
		
		echo json_encode($areacode);
	}
	const CLASSNAME_LEVEL 			= 1;
	const CLASS_LEVEL 				= 2;
	const SCHOOL_LEVEL 				= 3;
	const DISTRICT_LEVEL 			= 4;
	const PROVINCE_LEVEL 				= 5;
	const NATIONAL_LEVEL 			= 6;
	
	public function checkLevelGreaterThan($level) {
		$adminAreacodeLevel = $this->getAdminAreacodeLevel();
		if($adminAreacodeLevel>=$level) {
			return true;
		}
		return false;
	}
	public function checkLevelLessThan($level) {
		$adminAreacodeLevel = $this->getAdminAreacodeLevel();
		if($adminAreacodeLevel < $level) {
			return true;
		}
		return false;
	}
	public function getAdminAreacodeLevel() {
		if(!pzk_session('adminAreacode'))
			return self::NATIONAL_LEVEL;
		if(pzk_session('adminAreacode') && !pzk_session('adminDistrict'))
			return self::PROVINCE_LEVEL;
		if(pzk_session('adminDistrict') && !pzk_session('adminSchool'))
			return self::DISTRICT_LEVEL;
		if(pzk_session('adminSchool') && !pzk_session('adminClass'))
			return self::SCHOOL_LEVEL;
		if(pzk_session('adminClass') && !pzk_session('adminClassname')) {
			return self::CLASS_LEVEL;
		} 
		if(pzk_session('adminClassname')) {
			return self::CLASSNAME_LEVEL;
		}
	}
	public function studentsAction($parent, $page) {
		$adminAreacode 	= pzk_session('adminAreacode');
		$adminDistrict 	= pzk_session('adminDistrict');
		$adminSchool 	= pzk_session('adminSchool');
		$adminClass		= pzk_session('adminClass');
		$adminClassname	= pzk_session('adminClassname');
		$allProvinces 	= null;
		$areacodeType	= null;
		$areaChildLabel = null;
		if(!$parent) {
			// ca nuoc
			if($this->checkLevelLessThan(self::NATIONAL_LEVEL) ) {
				$this->showEmptyStudents();
			}
			$students = array();
			$totalItems = 0;
			
			if(!$page) {
				$page = 0;
			}
			
			// Students
			$students = _db()
				->useCache(1800)
				->useCacheKey('monitorStudents')
				->select('id, name, username, class, classname')
				->fromUser()
				->whereCheckUser(1)
				->limit(20, $page)
				->result();
			$totalItems = _db()
				->useCache(1800)
				->useCacheKey('monitorStudentsCount')
				->select('count(*) as c')
				->fromUser()
				->whereCheckUser(1)
				->result_one();
			$totalItems = $totalItems['c'];
			
			// Provinces;
			$allProvinces = _db()->select('count(*) as users, areacode.name as areacodeName')
				->fromUser()
				->join('areacode', 'user.areacode = areacode.id')
				->whereCheckUser(1)->groupBy('user.areacode')->orderBy('areacode.id asc')->result();
			
			echo json_encode(array(
				'items' 		=> $students, 
				'totalItems' 	=> intval($totalItems), 
				'currentPage' 	=> intval($page),
				'areas' 		=> $allProvinces,
				'areaChildLabel'=> 'Tỉnh'
				), true);
		} else if(is_numeric($parent)) {
			$areacode = _db()
				->useCache(1800)
				->selectAll()
				->fromAreacode()
				->whereId($parent)
				->result_one();
			$students = array();
			$totalItems = 0;
			
			if($areacode['type'] == 'province') {
				if($this->checkLevelLessThan(self::PROVINCE_LEVEL) ) {
					$this->showEmptyStudents();
				}
				if(!$page) {
					$page = 0;
				}
				$students = _db()
					->useCache(1800)
					->select('id, name, username, class, classname')
					->fromUser()
					->whereAreacode($areacode['id'])
					->whereCheckUser(1)
					->limit(20, $page)
					->result();
				$totalItems = _db()
					->useCache(1800)
					->select('count(*) as c')
					->fromUser()
					->whereAreacode($areacode['id'])
					->whereCheckUser(1)
					->result_one();
				$totalItems = $totalItems['c'];
				// District;
				$allProvinces = _db()->select('count(*) as users, areacode.name as areacodeName')
				->fromUser()
				->join('areacode', 'user.district = areacode.id')
				->whereAreacode($areacode['id'])
				->whereCheckUser(1)->groupBy('user.district')->orderBy('areacode.id asc')->result();
				$areaChildLabel = 'Huyện';
			} else if($areacode['type'] == 'district') {
				// huyen
				if($this->checkLevelLessThan(self::DISTRICT_LEVEL) ) {
					$this->showEmptyStudents();
				}
				if(!$page) {
					$page = 0;
				}
				$students = _db()
					->useCache(1800)
					->select('id, name, username, class, classname')
					->fromUser()
					->whereDistrict($areacode['id'])
					->whereCheckUser(1)
					->limit(20, $page)
					->result();
				$totalItems = _db()
					->useCache(1800)
					->select('count(*) as c')
					->fromUser()
					->whereDistrict($areacode['id'])
					->whereCheckUser(1)
					->result_one();
				$totalItems = $totalItems['c'];
				$allProvinces = _db()->select('count(*) as users, areacode.name as areacodeName')
				->fromUser()
				->join('areacode', 'user.school = areacode.id')
				->whereDistrict($areacode['id'])
				->whereCheckUser(1)->groupBy('user.school')->orderBy('areacode.id asc')->result();
				$areaChildLabel = 'Trường';
			} else if($areacode['type'] == 'school') {
				// truong
				if($this->checkLevelLessThan(self::SCHOOL_LEVEL)) {
					$this->showEmptyStudents();
				}
				if(!$page) {
					$page = 0;
				}
				$students = _db()
					->useCache(1800)
					->select('id, name, username, class, classname')
					->fromUser()
					->whereSchool($areacode['id'])
					->whereCheckUser(1)
					->limit(20, $page)
					->result();
				$totalItems = _db()
					->useCache(1800)
					->select('count(*) as c')
					->fromUser()
					->whereSchool($areacode['id'])
					->whereCheckUser(1)
					->result_one();
				$allProvinces = _db()->select('count(*) as users, class as areacodeName')
				->fromUser()
				->join('areacode', 'user.school = areacode.id')
				->whereSchool($areacode['id'])
				->whereCheckUser(1)->groupBy('user.class')->orderBy('areacode.id asc')->result();
				$areaChildLabel = 'Khối';
				$totalItems = $totalItems['c'];
			}
			echo json_encode(array(
					'items' 		=> $students, 
					'totalItems' 	=> intval($totalItems), 
					'areas'			=> $allProvinces,
					'currentPage' 	=> intval($page),
					'areaChildLabel'=> $areaChildLabel
					), true);
		} else {
			$schoolClass = explode('-', $parent);
			$students = array();
			$totalItems = 0;
			if(count($schoolClass) == 2) {
				if($this->checkLevelLessThan(self::CLASS_LEVEL)) {
					echo json_encode(array(
						'items'			=> array(),
						'totalItems'	=> 0,
						'currentPage'	=> 0
					));
					pzk_system()->halt();
				}
				$school = $schoolClass[0];
				$class = $schoolClass[1];
				if(!$page) {
					$page = 0;
				}
				$students = _db()
					->useCache(1800)
					->select('id, name, username, class, classname')
					->fromUser()
					->whereSchool($school)
					->whereClass($class)
					->whereCheckUser(1)
					->limit(20, $page)
					->result();
				$totalItems = _db()
					->useCache(1800)
					->select('count(*) as c')
					->fromUser()
					->whereSchool($school)
					->whereClass($class)
					->whereCheckUser(1)
					->result_one();
				$totalItems = $totalItems['c'];
				$allProvinces = _db()->select('count(*) as users, classname as areacodeName')
				->fromUser()
				->join('areacode', 'user.school = areacode.id')
				->whereSchool($school)
				->whereClass($class)
				->whereCheckUser(1)->groupBy('user.classname')->orderBy('areacode.id asc')->result();
				$areaChildLabel = 'Lớp';
			} else if(count($schoolClass) == 3) {
				$school = $schoolClass[0];
				$class = $schoolClass[1];
				$classname = $schoolClass[2];
				if(!$page) {
					$page = 0;
				}
				$students = _db()
					->useCache(1800)
					->select('id, name, username, class, classname')
					->fromUser()
					->whereSchool($school)
					->whereClass($class)
					->whereClassname($classname)
					->whereCheckUser(1)
					->limit(20, $page)
					->result();
				$totalItems = _db()
					->useCache(1800)
					->select('count(*) as c')
					->fromUser()
					->whereSchool($school)
					->whereClass($class)
					->whereClassname($classname)
					->whereCheckUser(1)
					->result_one();
				$totalItems = $totalItems['c'];
			}
			echo json_encode(array(
					'items' 		=> $students, 
					'totalItems' 	=> intval($totalItems), 
					'currentPage' 	=> intval($page),
					'areas'			=> $allProvinces,
					'areaChildLabel'=> $areaChildLabel
					), true);
		}
	} 
	public function reviewsAction($parent) {
		echo json_encode($parent);
		return false;
		
	}
	public function accessReviewAction($parent, $weekYear) {
		if($weekYear) {
			
			$obtain 		= explode('-', $weekYear);
			$week 			= $obtain[0];
			$year 			= $obtain[1];
			$achievement 	= array();
			$arrReview		= array();
			if(!$parent) {
				
				$achievement = _db()->select('rights, total, trueTestQuestion, totalTestQuestion, totalPracticeQuestion, truePracticeQuestion, trueTestPrQuestion, totalTestPrQuestion, category51, category52, category157, category50, category53, category164, category88, category87, category54, category59, vn_category50, vn_category51, vn_category52, vn_category53, vn_category54, vn_category59, vn_category87, vn_category88,vn_category157, vn_category164, en_category50, en_category51, en_category52, en_category53, en_category54, en_category59,en_category87, en_category88, en_category157, en_category164, ev_category50, ev_category51, ev_category52, ev_category53,ev_category54, ev_category59, ev_category87, ev_category88, ev_category157, ev_category164')->fromAchievement()->whereWeek($week)->whereYear($year)->result();
				$arrReview = $this->executeReview($achievement);
				echo json_encode(array('reviews' => $arrReview), true);
			} else if(is_numeric($parent)) {
				$areacode = _db()->selectAll()->fromAreacode()->whereId($parent)->result_one();
				
				if($areacode['type'] == 'province') {
					
					$achievement = _db()
						->select('rights, total, trueTestQuestion, totalTestQuestion, totalPracticeQuestion, truePracticeQuestion, trueTestPrQuestion, totalTestPrQuestion, category51, category52, category157, category50, category53, category164, category88, category87, category54, category59, vn_category50, vn_category51, vn_category52, vn_category53, vn_category54, vn_category59, vn_category87, vn_category88,vn_category157, vn_category164, en_category50, en_category51, en_category52, en_category53, en_category54, en_category59,en_category87, en_category88, en_category157, en_category164, ev_category50, ev_category51, ev_category52, ev_category53,ev_category54, ev_category59, ev_category87, ev_category88, ev_category157, ev_category164')
						->fromAchievement()
						->whereAreacode($areacode['id'])
						->whereWeek($week)
						->whereYear($year)
						->result();
					$arrReview = $this->executeReview($achievement);
					
				} else if($areacode['type'] == 'district') {
					
					$achievement = _db()
						->select('rights, total, trueTestQuestion, totalTestQuestion, totalPracticeQuestion, truePracticeQuestion, trueTestPrQuestion, totalTestPrQuestion, category51, category52, category157, category50, category53, category164, category88, category87, category54, category59, vn_category50, vn_category51, vn_category52, vn_category53, vn_category54, vn_category59, vn_category87, vn_category88,vn_category157, vn_category164, en_category50, en_category51, en_category52, en_category53, en_category54, en_category59,en_category87, en_category88, en_category157, en_category164, ev_category50, ev_category51, ev_category52, ev_category53,ev_category54, ev_category59, ev_category87, ev_category88, ev_category157, ev_category164')
						->fromAchievement()
						->whereDistrict($areacode['id'])
						->whereWeek($week)
						->whereYear($year)
						->result();
					$arrReview = $this->executeReview($achievement);
					
				} else if($areacode['type'] == 'school') {
					
					$achievement = _db()
						->select('rights, total, trueTestQuestion, totalTestQuestion, totalPracticeQuestion, truePracticeQuestion, trueTestPrQuestion, totalTestPrQuestion, category51, category52, category157, category50, category53, category164, category88, category87, category54, category59, vn_category50, vn_category51, vn_category52, vn_category53, vn_category54, vn_category59, vn_category87, vn_category88,vn_category157, vn_category164, en_category50, en_category51, en_category52, en_category53, en_category54, en_category59,en_category87, en_category88, en_category157, en_category164, ev_category50, ev_category51, ev_category52, ev_category53,ev_category54, ev_category59, ev_category87, ev_category88, ev_category157, ev_category164')
						->fromAchievement()
						->whereSchool($areacode['id'])
						->whereWeek($week)
						->whereYear($year)
						->result();
					$arrReview = $this->executeReview($achievement);
					
				}
				echo json_encode(array('reviews' => $arrReview), true);
			} else {
				$schoolClass = explode('-', $parent);
				
				if(count($schoolClass) == 2) {
					$school = $schoolClass[0];
					$class = $schoolClass[1];
					
					$achievement = _db()
						->select('rights, total, trueTestQuestion, totalTestQuestion, totalPracticeQuestion, truePracticeQuestion, trueTestPrQuestion, totalTestPrQuestion, category51, category52, category157, category50, category53, category164, category88, category87, category54, category59, vn_category50, vn_category51, vn_category52, vn_category53, vn_category54, vn_category59, vn_category87, vn_category88,vn_category157, vn_category164, en_category50, en_category51, en_category52, en_category53, en_category54, en_category59,en_category87, en_category88, en_category157, en_category164, ev_category50, ev_category51, ev_category52, ev_category53,ev_category54, ev_category59, ev_category87, ev_category88, ev_category157, ev_category164')
						->fromAchievement()
						->whereSchool($school)
						->whereClass($class)
						->whereWeek($week)
						->whereYear($year)
						->result();
					$arrReview = $this->executeReview($achievement);
					
				} else if(count($schoolClass) == 3) {
					$school = $schoolClass[0];
					$class = $schoolClass[1];
					$classname = $schoolClass[2];
					
					$achievement = _db()
						->select('rights, total, trueTestQuestion, totalTestQuestion, totalPracticeQuestion, truePracticeQuestion, trueTestPrQuestion, totalTestPrQuestion, category51, category52, category157, category50, category53, category164, category88, category87, category54, category59, vn_category50, vn_category51, vn_category52, vn_category53, vn_category54, vn_category59, vn_category87, vn_category88,vn_category157, vn_category164, en_category50, en_category51, en_category52, en_category53, en_category54, en_category59,en_category87, en_category88, en_category157, en_category164, ev_category50, ev_category51, ev_category52, ev_category53,ev_category54, ev_category59, ev_category87, ev_category88, ev_category157, ev_category164')
						->fromAchievement()
						->whereSchool($school)
						->whereClass($class)
						->whereClassname($classname)
						->whereWeek($week)
						->whereYear($year)
						->result();
					$arrReview = $this->executeReview($achievement);
				} 
				echo json_encode(array('reviews' => $arrReview), true);
			}
		}
	}
	
	public function accessReviewYearAction($parent, $year) {
		if($year) {
			
			$startYear = $year * 52 + 36;
			$endYear = (($year + 1) * 52) + 20;
			$achievement 	= array();
			$arrReview		= array();
			if(!$parent) {
				
				$achievement = _db()->select('rights, total, trueTestQuestion, totalTestQuestion, totalPracticeQuestion, truePracticeQuestion, trueTestPrQuestion, totalTestPrQuestion, category51, category52, category157, category50, category53, category164, category88, category87, category54, category59, vn_category50, vn_category51, vn_category52, vn_category53, vn_category54, vn_category59, vn_category87, vn_category88,vn_category157, vn_category164, en_category50, en_category51, en_category52, en_category53, en_category54, en_category59,en_category87, en_category88, en_category157, en_category164, ev_category50, ev_category51, ev_category52, ev_category53,ev_category54, ev_category59, ev_category87, ev_category88, ev_category157, ev_category164')->fromAchievement()
					->where("year * 52 + week >= $startYear AND year * 52 + week <= $endYear")
					->result();
						
				$sqlCountUser = "select count(distinct(userId)) as c  from achievement where (year * 52 + week) >= $startYear and (year * 52 + week) <= $endYear"; 
				$countUser = _db()->query_one($sqlCountUser);		
						
				$arrReview = $this->executeReview($achievement, $countUser['c']);
				
				echo json_encode(array('reviews' => $arrReview), true);
			} else if(is_numeric($parent)) {
				$areacode = _db()->selectAll()->fromAreacode()->whereId($parent)->result_one();
				
				if($areacode['type'] == 'province') {
					
					$achievement = _db()
						->select('rights, total, trueTestQuestion, totalTestQuestion, totalPracticeQuestion, truePracticeQuestion, trueTestPrQuestion, totalTestPrQuestion, category51, category52, category157, category50, category53, category164, category88, category87, category54, category59, vn_category50, vn_category51, vn_category52, vn_category53, vn_category54, vn_category59, vn_category87, vn_category88,vn_category157, vn_category164, en_category50, en_category51, en_category52, en_category53, en_category54, en_category59,en_category87, en_category88, en_category157, en_category164, ev_category50, ev_category51, ev_category52, ev_category53,ev_category54, ev_category59, ev_category87, ev_category88, ev_category157, ev_category164')
						->fromAchievement()
						->whereAreacode($areacode['id'])
						->where("year * 52 + week >= $startYear AND year * 52 + week <= $endYear")
						->result();
						
					$sqlCountUser = "select count(distinct(userId)) as c  from achievement where (year * 52 + week) >= $startYear and (year * 52 + week) <= $endYear AND areacode = {$areacode['id']}"; 
					$countUser = _db()->query_one($sqlCountUser);		
						
					$arrReview = $this->executeReview($achievement, $countUser['c']);
					
				} else if($areacode['type'] == 'district') {
					
					$achievement = _db()
						->select('rights, total, trueTestQuestion, totalTestQuestion, totalPracticeQuestion, truePracticeQuestion, trueTestPrQuestion, totalTestPrQuestion, category51, category52, category157, category50, category53, category164, category88, category87, category54, category59, vn_category50, vn_category51, vn_category52, vn_category53, vn_category54, vn_category59, vn_category87, vn_category88,vn_category157, vn_category164, en_category50, en_category51, en_category52, en_category53, en_category54, en_category59,en_category87, en_category88, en_category157, en_category164, ev_category50, ev_category51, ev_category52, ev_category53,ev_category54, ev_category59, ev_category87, ev_category88, ev_category157, ev_category164')
						->fromAchievement()
						->whereDistrict($areacode['id'])
						->where("year * 52 + week >= $startYear AND year * 52 + week <= $endYear")
						->result();
						
					$sqlCountUser = "select count(distinct(userId)) as c  from achievement where (year * 52 + week) >= $startYear and (year * 52 + week) <= $endYear AND district = {$areacode['id']}"; 
					
					$countUser = _db()->query_one($sqlCountUser);		
					$arrReview = $this->executeReview($achievement, $countUser['c']);
					
				} else if($areacode['type'] == 'school') {
					
					$achievement = _db()
						->select('rights, total, trueTestQuestion, totalTestQuestion, totalPracticeQuestion, truePracticeQuestion, trueTestPrQuestion, totalTestPrQuestion, category51, category52, category157, category50, category53, category164, category88, category87, category54, category59, vn_category50, vn_category51, vn_category52, vn_category53, vn_category54, vn_category59, vn_category87, vn_category88,vn_category157, vn_category164, en_category50, en_category51, en_category52, en_category53, en_category54, en_category59,en_category87, en_category88, en_category157, en_category164, ev_category50, ev_category51, ev_category52, ev_category53,ev_category54, ev_category59, ev_category87, ev_category88, ev_category157, ev_category164')
						->fromAchievement()
						->whereSchool($areacode['id'])
						->where("year * 52 + week >= $startYear AND year * 52 + week <= $endYear")
						->result();
						
					$sqlCountUser = "select count(distinct(userId)) as c  from achievement where (year * 52 + week) >= $startYear and (year * 52 + week) <= $endYear and school = {$areacode['id']}"; 
					
					$countUser = _db()->query_one($sqlCountUser);
						
					$arrReview = $this->executeReview($achievement, $countUser['c']);
					
				}
				echo json_encode(array('reviews' => $arrReview), true);
			} else {
				$schoolClass = explode('-', $parent);
				
				if(count($schoolClass) == 2) {
					$school = $schoolClass[0];
					$class = $schoolClass[1];
					
					$achievement = _db()
						->select('rights, total, trueTestQuestion, totalTestQuestion, totalPracticeQuestion, truePracticeQuestion, trueTestPrQuestion, totalTestPrQuestion, category51, category52, category157, category50, category53, category164, category88, category87, category54, category59, vn_category50, vn_category51, vn_category52, vn_category53, vn_category54, vn_category59, vn_category87, vn_category88,vn_category157, vn_category164, en_category50, en_category51, en_category52, en_category53, en_category54, en_category59,en_category87, en_category88, en_category157, en_category164, ev_category50, ev_category51, ev_category52, ev_category53,ev_category54, ev_category59, ev_category87, ev_category88, ev_category157, ev_category164')
						->fromAchievement()
						->whereSchool($school)
						->whereClass($class)
						->where("year * 52 + week >= $startYear AND year * 52 + week <= $endYear")
						->result();
						
					$sqlCountUser = "select count(distinct(userId)) as c  from achievement where (year * 52 + week) >= $startYear and (year * 52 + week) <= $endYear and school = $school and class = $class"; 
					
					$countUser = _db()->query_one($sqlCountUser);
					
					$arrReview = $this->executeReview($achievement, $countUser['c']);
					
				} else if(count($schoolClass) == 3) {
					$school = $schoolClass[0];
					$class = $schoolClass[1];
					$classname = $schoolClass[2];
					
					$achievement = _db()
						->select('rights, total, trueTestQuestion, totalTestQuestion, totalPracticeQuestion, truePracticeQuestion, trueTestPrQuestion, totalTestPrQuestion, category51, category52, category157, category50, category53, category164, category88, category87, category54, category59, vn_category50, vn_category51, vn_category52, vn_category53, vn_category54, vn_category59, vn_category87, vn_category88,vn_category157, vn_category164, en_category50, en_category51, en_category52, en_category53, en_category54, en_category59,en_category87, en_category88, en_category157, en_category164, ev_category50, ev_category51, ev_category52, ev_category53,ev_category54, ev_category59, ev_category87, ev_category88, ev_category157, ev_category164')
						->fromAchievement()
						->whereSchool($school)
						->whereClass($class)
						->whereClassname($classname)
						->where("year * 52 + week >= $startYear AND year * 52 + week <= $endYear")
						->result();
						
					$sqlCountUser = "select count(distinct(userId)) as c  from achievement where (year * 52 + week) >= $startYear and (year * 52 + week) <= $endYear and school = $school and class = $class and classname = $classname"; 
					
					$countUser = _db()->query_one($sqlCountUser);
						
					$arrReview = $this->executeReview($achievement, $countUser['c']);
				}
				echo json_encode(array('reviews' => $arrReview), true);
			}
		}
	}
	
	public function accessReviewSummerAction($parent, $year){
		if($year) {
			$year = $year + 1;
			$sqlWeek = "week > 20 and week < 36";
			
			$achievement 	= array();
			$arrReview		= array();
			if(!$parent) {
				
				$achievement = _db()->select('rights, total, trueTestQuestion, totalTestQuestion, totalPracticeQuestion, truePracticeQuestion, trueTestPrQuestion, totalTestPrQuestion, category51, category52, category157, category50, category53, category164, category88, category87, category54, category59, vn_category50, vn_category51, vn_category52, vn_category53, vn_category54, vn_category59, vn_category87, vn_category88,vn_category157, vn_category164, en_category50, en_category51, en_category52, en_category53, en_category54, en_category59,en_category87, en_category88, en_category157, en_category164, ev_category50, ev_category51, ev_category52, ev_category53,ev_category54, ev_category59, ev_category87, ev_category88, ev_category157, ev_category164')->fromAchievement()
					->whereYear($year)
					->where($sqlWeek)
					->result();
						
				$sqlCountUser = "select count(distinct(userId)) as c  from achievement where year = $year and $sqlWeek"; 
				$countUser = _db()->query_one($sqlCountUser);		
						
				$arrReview = $this->executeReview($achievement, $countUser['c']);
				
				echo json_encode(array('reviews' => $arrReview), true);
			} else if(is_numeric($parent)) {
				$areacode = _db()->selectAll()->fromAreacode()->whereId($parent)->result_one();
				
				if($areacode['type'] == 'province') {
					
					$achievement = _db()
						->select('rights, total, trueTestQuestion, totalTestQuestion, totalPracticeQuestion, truePracticeQuestion, trueTestPrQuestion, totalTestPrQuestion, category51, category52, category157, category50, category53, category164, category88, category87, category54, category59, vn_category50, vn_category51, vn_category52, vn_category53, vn_category54, vn_category59, vn_category87, vn_category88,vn_category157, vn_category164, en_category50, en_category51, en_category52, en_category53, en_category54, en_category59,en_category87, en_category88, en_category157, en_category164, ev_category50, ev_category51, ev_category52, ev_category53,ev_category54, ev_category59, ev_category87, ev_category88, ev_category157, ev_category164')
						->fromAchievement()
						->whereAreacode($areacode['id'])
						->whereYear($year)
						->where($sqlWeek)
						->result();
						
					$sqlCountUser = "select count(distinct(userId)) as c  from achievement where year = $year AND $sqlWeek AND areacode = {$areacode['id']}"; 
					$countUser = _db()->query_one($sqlCountUser);		
						
					$arrReview = $this->executeReview($achievement, $countUser['c']);
					
				} else if($areacode['type'] == 'district') {
					
					$achievement = _db()
						->select('rights, total, trueTestQuestion, totalTestQuestion, totalPracticeQuestion, truePracticeQuestion, trueTestPrQuestion, totalTestPrQuestion, category51, category52, category157, category50, category53, category164, category88, category87, category54, category59, vn_category50, vn_category51, vn_category52, vn_category53, vn_category54, vn_category59, vn_category87, vn_category88,vn_category157, vn_category164, en_category50, en_category51, en_category52, en_category53, en_category54, en_category59,en_category87, en_category88, en_category157, en_category164, ev_category50, ev_category51, ev_category52, ev_category53,ev_category54, ev_category59, ev_category87, ev_category88, ev_category157, ev_category164')
						->fromAchievement()
						->whereDistrict($areacode['id'])
						->whereYear($year)
						->where($sqlWeek)
						->result();
						
					$sqlCountUser = "select count(distinct(userId)) as c  from achievement where year = $year and $sqlWeek AND district = {$areacode['id']}"; 
					
					$countUser = _db()->query_one($sqlCountUser);		
					$arrReview = $this->executeReview($achievement, $countUser['c']);
					
				} else if($areacode['type'] == 'school') {
					
					$achievement = _db()
						->select('rights, total, trueTestQuestion, totalTestQuestion, totalPracticeQuestion, truePracticeQuestion, trueTestPrQuestion, totalTestPrQuestion, category51, category52, category157, category50, category53, category164, category88, category87, category54, category59, vn_category50, vn_category51, vn_category52, vn_category53, vn_category54, vn_category59, vn_category87, vn_category88,vn_category157, vn_category164, en_category50, en_category51, en_category52, en_category53, en_category54, en_category59,en_category87, en_category88, en_category157, en_category164, ev_category50, ev_category51, ev_category52, ev_category53,ev_category54, ev_category59, ev_category87, ev_category88, ev_category157, ev_category164')
						->fromAchievement()
						->whereSchool($areacode['id'])
						->whereYear($year)
						->where($sqlWeek)
						->result();
						
					$sqlCountUser = "select count(distinct(userId)) as c  from achievement where year = $year and $sqlWeek and school = {$areacode['id']}"; 
					
					$countUser = _db()->query_one($sqlCountUser);
						
					$arrReview = $this->executeReview($achievement, $countUser['c']);
					
				}
				echo json_encode(array('reviews' => $arrReview), true);
			} else {
				$schoolClass = explode('-', $parent);
				
				if(count($schoolClass) == 2) {
					$school = $schoolClass[0];
					$class = $schoolClass[1];
					
					$achievement = _db()
						->select('rights, total, trueTestQuestion, totalTestQuestion, totalPracticeQuestion, truePracticeQuestion, trueTestPrQuestion, totalTestPrQuestion, category51, category52, category157, category50, category53, category164, category88, category87, category54, category59, vn_category50, vn_category51, vn_category52, vn_category53, vn_category54, vn_category59, vn_category87, vn_category88,vn_category157, vn_category164, en_category50, en_category51, en_category52, en_category53, en_category54, en_category59,en_category87, en_category88, en_category157, en_category164, ev_category50, ev_category51, ev_category52, ev_category53,ev_category54, ev_category59, ev_category87, ev_category88, ev_category157, ev_category164')
						->fromAchievement()
						->whereSchool($school)
						->whereClass($class)
						->whereYear($year)
						->where($sqlWeek)
						->result();
						
					$sqlCountUser = "select count(distinct(userId)) as c  from achievement where year = $year and $sqlWeek and school = $school and class = $class"; 
					
					$countUser = _db()->query_one($sqlCountUser);
					
					$arrReview = $this->executeReview($achievement, $countUser['c']);
					
				} else if(count($schoolClass) == 3) {
					$school = $schoolClass[0];
					$class = $schoolClass[1];
					$classname = $schoolClass[2];
					
					$achievement = _db()
						->select('rights, total, trueTestQuestion, totalTestQuestion, totalPracticeQuestion, truePracticeQuestion, trueTestPrQuestion, totalTestPrQuestion, category51, category52, category157, category50, category53, category164, category88, category87, category54, category59, vn_category50, vn_category51, vn_category52, vn_category53, vn_category54, vn_category59, vn_category87, vn_category88,vn_category157, vn_category164, en_category50, en_category51, en_category52, en_category53, en_category54, en_category59,en_category87, en_category88, en_category157, en_category164, ev_category50, ev_category51, ev_category52, ev_category53,ev_category54, ev_category59, ev_category87, ev_category88, ev_category157, ev_category164')
						->fromAchievement()
						->whereSchool($school)
						->whereClass($class)
						->whereClassname($classname)
						->whereYear($year)
						->where($sqlWeek)
						->result();
						
					$sqlCountUser = "select count(distinct(userId)) as c  from achievement where year = $year and $sqlWeek and school = $school and class = $class and classname = $classname"; 
					
					$countUser = _db()->query_one($sqlCountUser);
						
					$arrReview = $this->executeReview($achievement, $countUser['c']);
				}
				echo json_encode(array('reviews' => $arrReview), true);
			}
		}	
	}
	
	
	public function executeReview($achievement, $countUser = false) {
		$arrReview = array();
		if(count($achievement)>0) {
			if($countUser) {
				$totalUser = $countUser;
			}else{
				$totalUser = count($achievement);
			}
			
			$allRight = $allTotal = $allTrueTestQuestion = $allTotalTestQuestion = $alltotalPracticeQuestion = $allTruePracticeQuestion = $allTrueTestPrQuestion = $allTotalTestPrQuestion = 0;

			$allCategory50 = $allCategory51 =$allCategory52 =  $allCategory53 = $allCategory54 = $allCategory59 = $allCategory87 = $allCategory88 = $allCategory157  = $allCategory164 = 0;
			
			$all_vn_category50 = $all_vn_category51 = $all_vn_category52 = $all_vn_category53 = $all_vn_category54 = $all_vn_category59 = $all_vn_category87 = $all_vn_category88 = $all_vn_category157 = $all_vn_category164 = 0;
			
			$all_en_category50 = $all_en_category51 = $all_en_category52 = $all_en_category53 = $all_en_category54 = $all_en_category59 =$all_en_category87 = $all_en_category88 = $all_en_category157 = $all_en_category164 = 0;

			$all_ev_category50 = $all_ev_category51 = $all_ev_category52 = $all_ev_category53 = $all_ev_category54 = $all_ev_category59 = $all_ev_category87 = $all_ev_category88 = $all_ev_category157 = $all_ev_category164 = 0;
			
			foreach($achievement as $item) {
				$allRight += $item['rights'];
				$allTotal += $item['total'];
				$allTrueTestQuestion += $item['trueTestQuestion'];
				$allTotalTestQuestion += $item['totalTestQuestion'];
				$alltotalPracticeQuestion += $item['totalPracticeQuestion'];
				$allTruePracticeQuestion += $item['truePracticeQuestion'];
				$allTrueTestPrQuestion += $item['trueTestPrQuestion'];
				$allTotalTestPrQuestion += $item['totalTestPrQuestion'];

				$allCategory50 += $item['category50'];
				$allCategory51 += $item['category51'];
				$allCategory52 += $item['category52'];
				$allCategory53 += $item['category53'];
				$allCategory54 += $item['category54'];
				$allCategory59 += $item['category59'];
				$allCategory87 += $item['category87'];
				$allCategory88 += $item['category88'];
				$allCategory157 += $item['category157'];
				$allCategory164 += $item['category164'];
				
				$all_vn_category50 += $item['vn_category50'];
				$all_vn_category51 += $item['vn_category51'];
				$all_vn_category52 += $item['vn_category52'];
				$all_vn_category53 += $item['vn_category53'];
				$all_vn_category54 += $item['vn_category54'];
				$all_vn_category59 += $item['vn_category59'];
				$all_vn_category87 += $item['vn_category87'];
				$all_vn_category88 += $item['vn_category88'];
				$all_vn_category157 += $item['vn_category157'];
				$all_vn_category164 += $item['vn_category164'];
				
				$all_en_category50 += $item['en_category50'];
				$all_en_category51 += $item['en_category51'];
				$all_en_category52 += $item['en_category52'];
				$all_en_category53 += $item['en_category53'];
				$all_en_category54 += $item['en_category54'];
				$all_en_category59 += $item['en_category59'];
				$all_en_category87 += $item['en_category87'];
				$all_en_category88 += $item['en_category88'];
				$all_en_category157 += $item['en_category157'];
				$all_en_category164 += $item['en_category164'];
				
				$all_ev_category50 += $item['ev_category50'];
				$all_ev_category51 += $item['ev_category51'];
				$all_ev_category52 += $item['ev_category52'];
				$all_ev_category53 += $item['ev_category53'];
				$all_ev_category54 += $item['ev_category54'];
				$all_ev_category59 += $item['ev_category59'];
				$all_ev_category87 += $item['ev_category87'];
				$all_ev_category88 += $item['ev_category88'];
				$all_ev_category157 += $item['ev_category157'];
				$all_ev_category164 += $item['ev_category164'];

			}
			$centGame = $centPratice = $centTestPratice = $centTest = 0;
			
			
			if($allRight > 0){
				$centGame = round($allRight*100/$allTotal);
			}
			if($allTruePracticeQuestion > 0){
				$centPratice = round($allTruePracticeQuestion*100/$alltotalPracticeQuestion);
			}
			if($allTrueTestPrQuestion > 0){
				$centTestPratice = round($allTrueTestPrQuestion*100/$allTotalTestPrQuestion);
			}
			if($allTrueTestQuestion > 0){
				$centTest = round($allTrueTestQuestion*100/$allTotalTestQuestion);
			}
			
			$centCategory50 = $centCategory51 = $centCategory52 = $centCategory53 = $centCategory54 = $centCategory59 = $centCategory87 = $centCategory88 = $centCategory157  = $centCategory164  = 0;
			
			$allCategory = $allCategory50 + $allCategory51 + $allCategory52 + $allCategory53 + $allCategory54  + $allCategory59 + $allCategory87 + $allCategory88 + $allCategory157 + $allCategory164;
			if($allCategory50 > 0){
				$centCategory50 = round($allCategory50*100/$allCategory, 2);
			}
			if($allCategory51 > 0){
				$centCategory51 = round($allCategory51*100/$allCategory, 2);
			}
			if($allCategory52 > 0){
				$centCategory52 = round($allCategory52*100/$allCategory, 2);
			}

			if($allCategory53 > 0){
				$centCategory53 = round($allCategory53*100/$allCategory, 2);
			}
			if($allCategory54 > 0){
				$centCategory54 = round($allCategory54*100/$allCategory, 2);
			}
			if($allCategory59 > 0){
				$centCategory59 = round($allCategory59*100/$allCategory, 2);
			}
			if($allCategory87 > 0){
				$centCategory87 = round($allCategory87*100/$allCategory, 2);
			}
			if($allCategory88 > 0){
				$centCategory88 = round($allCategory88*100/$allCategory, 2);
			}
			if($allCategory157 > 0){
				$centCategory157 = round($allCategory157*100/$allCategory, 2);
			}
			if($allCategory164 > 0){
				$centCategory164 = round($allCategory164*100/$allCategory, 2);
			}

			//xu li review theo chon ngon ngu
			$all_vn_category = $cent_vn_category50 = $cent_vn_category51 = $cent_vn_category52 = $cent_vn_category53 = $cent_vn_category54 = $cent_vn_category59 = $cent_vn_category87 = $cent_vn_category88 = $cent_vn_category157 = $cent_vn_category164 = 0;
			
			$all_vn_category = $all_vn_category50 + $all_vn_category51 + $all_vn_category52 + $all_vn_category53 + $all_vn_category54 + $all_vn_category59 + $all_vn_category87 + $all_vn_category88 + $all_vn_category157 + $all_vn_category164;
			
			if($all_vn_category50 > 0){
				$cent_vn_category50 = round($all_vn_category50*100/$all_vn_category, 2);
			}
			if($all_vn_category51 > 0){
				$cent_vn_category51 = round($all_vn_category51*100/$all_vn_category, 2);
			}
			if($all_vn_category52 > 0){
				$cent_vn_category52 = round($all_vn_category52*100/$all_vn_category, 2);
			}

			if($all_vn_category53 > 0){
				$cent_vn_category53 = round($all_vn_category53*100/$all_vn_category, 2);
			}
			if($all_vn_category54 > 0){
				$cent_vn_category54 = round($all_vn_category54*100/$all_vn_category, 2);
			}
			if($all_vn_category59 > 0){
				$cent_vn_category59 = round($all_vn_category59*100/$all_vn_category, 2);
			}
			if($all_vn_category87 > 0){
				$cent_vn_category87 = round($all_vn_category87*100/$all_vn_category, 2);
			}
			if($all_vn_category88 > 0){
				$cent_vn_category88 = round($all_vn_category88*100/$all_vn_category, 2);
			}
			if($all_vn_category157 > 0){
				$cent_vn_category157 = round($all_vn_category157*100/$all_vn_category, 2);
			}
			if($all_vn_category164 > 0){
				$cent_vn_category164 = round($all_vn_category164*100/$all_vn_category, 2);
			}
			
			//en
			$all_en_category = $cent_en_category50 = $cent_en_category51 = $cent_en_category52 = $cent_en_category53 = $cent_en_category54 = $cent_en_category59 =$cent_en_category87 = $cent_en_category88 = $cent_en_category157 = $cent_en_category164 = 0;

			$all_en_category = $all_en_category50 + $all_en_category51 + $all_en_category52 + $all_en_category53 + $all_en_category54 + $all_en_category59 + $all_en_category87 + $all_en_category88 + $all_en_category157 + $all_en_category164;
			
			if($all_en_category50 > 0){
				$cent_en_category50 = round($all_en_category50*100/$all_en_category, 2);
			}
			if($all_en_category51 > 0){
				$cent_en_category51 = round($all_en_category51*100/$all_en_category, 2);
			}
			if($all_en_category52 > 0){
				$cent_en_category52 = round($all_en_category52*100/$all_en_category, 2);
			}

			if($all_en_category53 > 0){
				$cent_en_category53 = round($all_en_category53*100/$all_en_category, 2);
			}
			if($all_en_category54 > 0){
				$cent_en_category54 = round($all_en_category54*100/$all_en_category, 2);
			}
			if($all_en_category59 > 0){
				$cent_en_category59 = round($all_en_category59*100/$all_en_category, 2);
			}
			if($all_en_category87 > 0){
				$cent_en_category87 = round($all_en_category87*100/$all_en_category, 2);
			}
			if($all_en_category88 > 0){
				$cent_en_category88 = round($all_en_category88*100/$all_en_category, 2);
			}
			if($all_en_category157 > 0){
				$cent_en_category157 = round($all_en_category157*100/$all_en_category, 2);
			}
			if($all_en_category164 > 0){
				$cent_en_category164 = round($all_en_category164*100/$all_en_category, 2);
			}
			
			
			//ev
			$all_ev_category = $cent_ev_category50 = $cent_ev_category51 = $cent_ev_category52 = $cent_ev_category53 = $cent_ev_category54 = $cent_ev_category59 = $cent_ev_category87 = $cent_ev_category88 = $cent_ev_category157 = $cent_ev_category164 = 0;
			
			$all_ev_category = $all_ev_category50 + $all_ev_category51 + $all_ev_category52 + $all_ev_category53 + $all_ev_category54 + $all_ev_category59 + $all_ev_category87 + $all_ev_category88 + $all_ev_category157 + $all_ev_category164;
			
			if($all_ev_category50 > 0){
				$cent_ev_category50 = round($all_ev_category50*100/$all_ev_category, 2);
			}
			if($all_ev_category51 > 0){
				$cent_ev_category51 = round($all_ev_category51*100/$all_ev_category, 2);
			}
			if($all_ev_category52 > 0){
				$cent_ev_category52 = round($all_ev_category52*100/$all_ev_category, 2);
			}

			if($all_ev_category53 > 0){
				$cent_ev_category53 = round($all_ev_category53*100/$all_ev_category, 2);
			}
			if($all_ev_category54 > 0){
				$cent_ev_category54 = round($all_ev_category54*100/$all_ev_category, 2);
			}
			if($all_ev_category59 > 0){
				$cent_ev_category59 = round($all_ev_category59*100/$all_ev_category, 2);
			}
			if($all_ev_category87 > 0){
				$cent_ev_category87 = round($all_ev_category87*100/$all_ev_category, 2);
			}
			if($all_ev_category88 > 0){
				$cent_ev_category88 = round($all_ev_category88*100/$all_ev_category, 2);
			}
			if($all_ev_category157 > 0){
				$cent_ev_category157 = round($all_ev_category157*100/$all_ev_category, 2);
			}
			if($all_ev_category164 > 0){
				$cent_ev_category164 = round($all_ev_category164*100/$all_ev_category, 2);
			}
			
			$allLangCategory = $all_vn_category + $all_en_category + $all_ev_category;
			
			$cent_vn_category = floor(($all_vn_category*100)/ $allLangCategory);
			$cent_en_category = floor(($all_en_category*100)/ $allLangCategory);
			$cent_ev_category = 100 - (floor(($all_vn_category*100)/ $allLangCategory) + floor(($all_en_category*100)/ $allLangCategory));
			
			$arrReview = array(
				'numberStudent' => $totalUser,
				'centGame' => $centGame,
				'centPratice' => $centPratice,
				'centTestPratice' => $centTestPratice,
				'centTest' => $centTest,
				'category50' => $centCategory50,
				'category51' => $centCategory51,
				'category52' => $centCategory52,
				'category53' => $centCategory53,
				'category54' => $centCategory54,
				'category59' => $centCategory59,
				'category87' => $centCategory87,
				'category88' => $centCategory88,
				'category157' => $centCategory157,
				'category164' => $centCategory164,
				'cent_vn_category' => $cent_vn_category,
				'cent_en_category' => $cent_en_category,
				'cent_ev_category' => $cent_ev_category,
				'allLangCategory' => $allLangCategory,
				'cent_vn_category50' => $cent_vn_category50, 
				'cent_vn_category51' => $cent_vn_category51,
				'cent_vn_category52' => $cent_vn_category52,
				'cent_vn_category53' => $cent_vn_category53,
				'cent_vn_category54' => $cent_vn_category54,
				'cent_vn_category59' => $cent_vn_category59,
				'cent_vn_category87' => $cent_vn_category87,
				'cent_vn_category88' => $cent_vn_category88,
				'cent_vn_category157' => $cent_vn_category157,
				'cent_vn_category164' => $cent_vn_category164,
				
				'cent_en_category50' => $cent_en_category50, 
				'cent_en_category51' => $cent_en_category51,
				'cent_en_category52' => $cent_en_category52,
				'cent_en_category53' => $cent_en_category53,
				'cent_en_category54' => $cent_en_category54,
				'cent_en_category59' => $cent_en_category59,
				'cent_en_category87' => $cent_en_category87,
				'cent_en_category88' => $cent_en_category88,
				'cent_en_category157' => $cent_en_category157,
				'cent_en_category164' => $cent_en_category164,
				
				'cent_ev_category50' => $cent_ev_category50, 
				'cent_ev_category51' => $cent_ev_category51,
				'cent_ev_category52' => $cent_ev_category52,
				'cent_ev_category53' => $cent_ev_category53,
				'cent_ev_category54' => $cent_ev_category54,
				'cent_ev_category59' => $cent_ev_category59,
				'cent_ev_category87' => $cent_ev_category87,
				'cent_ev_category88' => $cent_ev_category88,
				'cent_ev_category157' => $cent_ev_category157,
				'cent_ev_category164' => $cent_ev_category164
			);
		}
			
		return 	$arrReview;	
	}
	public function reviewByGame($startDate, $endDate) {
		
		
	}
}
?>
