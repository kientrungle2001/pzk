<?php
class PzkEducationQuestionShowRating extends PzkObject {

    /**
    Cac dieu kien de lay du lieu
     */
    public $table = 'user_book';
    
    public $conditions = '1';
    public $pageSize = 20;
    public $pageNum = 0;
    public $pagination = false; // none, ajax
    public $orderBy = 'id desc';

    public function getItems () {
        
        $query = _db()->select('userId, startTime, mark, duringTime, testId, username, name, name_sn')
		->useCache(1800)->fromUser_book_rating()
		->where($this->conditions)
		->orderBy('mark desc, duringTime ASC')
		->limit($this->pageSize, $this->pageNum)
		->result();


        return $query;
    }

    public function getCountItems() {
      
        $query = _db()->select('count(*) as total')->useCache(1800)
		->fromUser_book_rating()->where($this->conditions)->orderBy('mark desc, duringTime ASC')->result_one();
        return $query['total'];
    }

    public function  getTestByUserId($userId) {
        $software = pzk_request()->getSoftwareId();
        $data = _db()->useCache(1800)->select('user_book.*, u.username, t.name, ca.name as cateName')
            ->from('user_book')
            ->join('user u', 'user_book.userId = u.id', 'left')
            ->join('tests t', 'user_book.testId = t.id', 'left')
            ->join('categories ca', 'user_book.categoryId = ca.id', 'left')
            ->where(array('equal',array('column','user_book','userId'),$userId))
            //->where(array('equal','userId',$userId))
            ->where('user_book.testId != 0')
            ->orderBy('user_book.id desc')
            ->limit($this->pageSize, $this->pageNum);
        return $data->result();
    }
	 
	
	 public function  getHistoryTest($userId, $practice) {
        $software = pzk_request()->getSoftwareId();
		//$time = '2016-03-01';
        $data = _db()->useCache(1800)->select('user_book.*, u.username, t.name, t.practice')
            ->from('user_book')
            ->join('user u', 'user_book.userId = u.id', 'left')
            ->join('tests t', 'user_book.testId = t.id', 'left')
            ->where(array('equal','userId',$userId))
			->where("t.practice = $practice")
            ->where('user_book.testId != 0')
			//->where("user_book.created >= '$time'")
            ->orderBy('user_book.id desc')
            ->limit($this->pageSize, $this->pageNum);
			//echo $data->getQuery();
        return $data->result();
    }
	
	public function  countHistoryTest($userId, $practice) {
        $software = pzk_request()->getSoftwareId();
		//$time = '2016-03-01';
        $data = _db()->useCache(1800)->select('user_book.*, u.username, t.name, t.practice')
            ->from('user_book')
            ->join('user u', 'user_book.userId = u.id', 'left')
            ->join('tests t', 'user_book.testId = t.id', 'left')
            ->where(array('equal','userId',$userId))
			->where("t.practice = $practice")
            ->where('user_book.testId != 0');
        $rows =$data->result();
		return count($rows); 
    }
	
	//history test song ngu
	public function  getHistoryTestSn($userId, $practice, $startDate, $endDate) {
        $software = pzk_request()->getSoftwareId();
		//$time = '2016-03-01';
        $data = _db()->useCache(1800)->select('user_book.*, u.username, t.name, t.practice, ca.name as cateName')
            ->from('user_book')
            ->join('user u', 'user_book.userId = u.id', 'left')
            ->join('tests t', 'user_book.testId = t.id', 'left')
            ->join('categories ca', 'user_book.categoryId = ca.id', 'left')
            ->where(array('equal',array('column','user_book','userId'),$userId))
			->where("t.practice = $practice")
            ->where('user_book.testId != 0')
			->where('user_book.compability = 0')
			->where("user_book.created >= '$startDate'")
			->where("user_book.created <= '$endDate'")
			//->where("user_book.created >= '$time'")
            ->orderBy('user_book.id desc')
            ->limit($this->pageSize, $this->pageNum);
			//echo $data->getQuery();
        return $data->result();
    }
	
	public function  countHistoryTestSn($userId, $practice, $startDate, $endDate) {
        $software = pzk_request()->getSoftwareId();
		//$time = '2016-03-01';
        $data = _db()->useCache(1800)->select('user_book.*, u.username, t.name, t.practice')
            ->from('user_book')
            ->join('user u', 'user_book.userId = u.id', 'left')
            ->join('tests t', 'user_book.testId = t.id', 'left')
            ->where(array('equal','userId',$userId))
			->where("t.practice = $practice")
			->where("user_book.created >= '$startDate'")
			->where("user_book.created <= '$endDate'")
            ->where('user_book.testId != 0');
        $rows =$data->result();
		return count($rows); 
    }
	
	
	public function  countQuestionPraticeByWeek($userId, $startDate, $endDate) {
        $software = pzk_request()->getSoftwareId();
		//$time = '2016-03-01';
        $data = _db()->useCache(1800)->select('quantity_question')
            ->from('user_book')
            ->where("user_book.userId = $userId")
            ->where('user_book.testId = 0')
			->where("user_book.created >= '$startDate'")
			->where("user_book.created <= '$endDate'");
			$rows = $data->result();
		if(count($rows)>0) {
			$totalQuestion = 0;
			foreach($rows as $val) {
				$totalQuestion = $totalQuestion + $val['quantity_question'];
			}
			return $totalQuestion;
		}else{
			return false;
		}		
    }
	public function  categoryPraticeByWeek($userId, $startDate, $endDate) {
        $data = _db()->useCache(1800)->select('categoryId')
            ->from('user_book')
            ->where("user_book.userId = $userId")
            ->where('user_book.testId = 0')
			->where("user_book.created >= '$startDate'")
			->where("user_book.created <= '$endDate'");
			$rows = $data->result();
		if(count($rows)>0) {
			$totalLesson = count($rows);
			$groudCategory = array();
			foreach($rows as $val) {
				$groudCategory[$val['categoryId']][] = $val['categoryId'];
			}
			return $groudCategory;
		}else{
			return false;
		}		
    }
	public function  getTestByWeek($userId, $practice, $startDate, $endDate) {
        $data = _db()->useCache(1800)->select('count(*) as c')
            ->from('user_book')
			->join('tests t', 'user_book.testId = t.id', 'left')
            ->where("user_book.userId = $userId")
            ->where("t.practice = $practice")
            ->where('user_book.testId != 0')
			 ->where('user_book.compability = 0')
			->where("user_book.created >= '$startDate'")
			->where("user_book.created <= '$endDate'");
			$rows = $data->result_one();
		return $rows['c'];	
    }
	
	public function  getQuestionTrueByTestAndWeek($userId, $practice, $startDate, $endDate) {
        $data = _db()->useCache(1800)->select('user_book.mark, user_book.quantity_question')
            ->from('user_book')
			->join('tests t', 'user_book.testId = t.id', 'left')
            ->where("user_book.userId = $userId")
            ->where("t.practice = $practice")
            ->where('user_book.testId != 0')
			->where('user_book.compability = 0')
			->where("user_book.created >= '$startDate'")
			->where("user_book.created <= '$endDate'");
			$rows = $data->result();
		$totalTrue = 0;
		$questions = 0;
		foreach($rows as $val) {
			$totalTrue = $totalTrue + $val['mark'];
			$questions = $questions + $val['quantity_question'];
		}
		$trueCent = floor($totalTrue*100 /	$questions);
		return $trueCent;
    }
	
	public function getDateCreateUser($userId) {
		$user = _db()->useCache(1800)->select('registered, created, modified')->fromUser()->whereId($userId)->result_one();
		$result = pzk_or($user['registered'], $user['created'], $user['modified']);
		return $result;
	}
	
	public function  TotalPraticeByWeek($userId, $startDate, $endDate) {
        $data = _db()->useCache(1800)->select('count(*) as c')
            ->from('user_book')
            ->where("user_book.userId = $userId")
            ->where('user_book.testId = 0')
			->where("user_book.created >= '$startDate'")
			->where("user_book.created <= '$endDate'");
			$rows = $data->result_one();
		return $rows['c'];
    }
	
	public function getAllCategories(){
		$subject=_db()->useCache(1800)
			->select("id, name, name_vn")
			->from("categories")
			->whereParent(47)
			->whereStatus(1)
			->whereDisplay(1)
			->orderBy('ordering asc')	
			->result();
		return $subject;
	}
	
	public function  getTrueQuestionPraticeByWeek($userId, $startDate, $endDate) {
        $software = pzk_request()->getSoftwareId();
        $data = _db()->useCache(1800)->select('*')
            ->from('user_book')
            ->where("userId = $userId")
            ->where('testId = 0')
			->where("created >= '$startDate'")
			->where("created <= '$endDate'")
			->result();
			
        if(count($data) >0 ) {
			$totalQuestion = 0;
			$totalTrue = 0;
			foreach($data as $val) {
				$totalTrue = $totalTrue + $val['mark'];
				$totalQuestion = $totalQuestion + $val['quantity_question'];
			}
			return ceil($totalTrue*100/$totalQuestion);
		}else{
			return false;
		}
    }
	
	public function  getHistoryPratice($userId) {
        $software = pzk_request()->getSoftwareId();
		//$time = '2016-03-01';
        $data = _db()->useCache(1800)->select('user_book.*, u.username, t.name, c.name as namecate, tp.name as topicname')
            ->from('user_book')
            ->join('user u', 'user_book.userId = u.id', 'left')
            ->join('tests t', 'user_book.testId = t.id', 'left')
			->join('categories c', 'user_book.categoryId = c.id', 'left')
            ->join('categories tp', 'user_book.topic = tp.id', 'left')
            ->where("user_book.userId = $userId")
            ->where('user_book.testId = 0')
			//->where("user_book.created >= '$time'")
            ->orderBy('user_book.id desc')
            ->limit($this->pageSize, $this->pageNum);
        return $data->result();
    }
	
	public function  countHistoryPratice($userId) {
        $software = pzk_request()->getSoftwareId();
		//$time = '2016-03-01';
        $data = _db()->useCache(1800)->select('user_book.*, u.username, t.name, c.name as namecate')
            ->from('user_book')
            ->join('user u', 'user_book.userId = u.id', 'left')
            ->join('tests t', 'user_book.testId = t.id', 'left')
			->join('categories c', 'user_book.categoryId = c.id', 'left')
            ->where("user_book.userId = $userId")
            ->where('user_book.testId = 0');
			$rows = $data->result(); 
        return count($rows);
    }
	
	//history practice song ngu
	public function  getHistoryPraticeSn($userId, $startDate, $endDate) {
        $software = pzk_request()->getSoftwareId();
		//$time = '2016-03-01';
        $data = _db()->useCache(1800)->select('user_book.*, u.username, t.name, c.name as namecate, c.name_vn as namecatevn, tp.name as topicname')
            ->from('user_book')
            ->join('user u', 'user_book.userId = u.id', 'left')
            ->join('tests t', 'user_book.testId = t.id', 'left')
			->join('categories c', 'user_book.categoryId = c.id', 'left')
            ->join('categories tp', 'user_book.topic = tp.id', 'left')
            ->where("user_book.userId = $userId")
            ->where('user_book.testId = 0')
			->where("user_book.created >= '$startDate'")
			->where("user_book.created <= '$endDate'")
			//->where("user_book.created >= '$time'")
            ->orderBy('user_book.id desc')
            ->limit($this->pageSize, $this->pageNum);
        return $data->result();
    }
	
	public function getParentCompabilities() {
        $software = pzk_request()->getSoftwareId();
        $data = _db()->useCache(1800)->select('id, name, name_sn, name_en')
            ->from('tests')
			->where('compability = 1')
            ->where("parent = 0");
        return $data->result();
    }
	public function getCompabilities($userId, $startDate, $endDate) {
        $software = pzk_request()->getSoftwareId();
        $data = _db()->useCache(1800)->select('user_book.*, t.parent as parentTest')
            ->from('user_book')
            ->join('tests t', 'user_book.testId = t.id', 'left')
			->where("user_book.userId = $userId")
			->where('user_book.compability = 1')
            ->where("user_book.created >= '$startDate'")
			->where("user_book.created <= '$endDate'");
        return $data->result();
    }
	
	public function  countHistoryPraticeSn($userId, $startDate, $endDate) {
        $software = pzk_request()->getSoftwareId();
		//$time = '2016-03-01';
        $data = _db()->useCache(1800)->select('user_book.*, u.username, t.name, c.name as namecate')
            ->from('user_book')
            ->join('user u', 'user_book.userId = u.id', 'left')
            ->join('tests t', 'user_book.testId = t.id', 'left')
			->join('categories c', 'user_book.categoryId = c.id', 'left')
            ->where("user_book.userId = $userId")
			->where("user_book.created >= '$startDate'")
			->where("user_book.created <= '$endDate'")
            ->where('user_book.testId = 0');
			$rows = $data->result(); 
        return count($rows);
    }
	
    public function countTestByUserId($userId) {
        $software = pzk_request()->getSoftwareId();
        $row = _db()->useCache(1800)->select('count(*) as c')
            ->from('user_book ub')
            ->join('user u', 'ub.userId = u.id', 'left')
            ->join('tests t', 'ub.testId = t.id', 'left')
            ->where(array('equal','userId',$userId))
            ->where('ub.testId != 0');

        $row = $row->result_one();
        return $row['c'];
    }
    /*public function getWeekTest($subjectId){
        $check = pzk_user()->checkPayment('full');
        $query = _db()->useCache(1800)->select('*')
            ->fromCategories()
            ->whereParent($subjectId)
            ->whereDisplay(1)           
            ->orderBy('ordering asc');
        if(isset($check ) && ($check == 1)){
            return $query->result();
        }else{
            return $query->whereTrial(1)->result();
        }
    }*/
    function getWeekTest($subjectId, $practice, $check){
        $class = pzk_session()->getLop();
        $query = _db()->useCache(1800)->select('*')
            ->fromCategories()
            ->whereParent($subjectId)
            ->whereDisplay(1)
            ->wherePractice($practice)          
            ->orderBy('ordering asc');
        if($class) $query->likeClasses("%,$class,%");
        if(isset($check ) && ($check == 1)){
            return $query->result();
        }else{
            return $query->whereTrial(1)->result();
        }
    }
    public function getWeekById($subjectId){
        $query= _db()->useCache(1800)->select('categories.name as name') 
                    ->from('categories') 
                    ->where(array('id', $subjectId))
                    ->result_one();
        return $query['name'];
    }
    public function getTestById($testId){
        $query = _db()->useCache(1800)->select('*') 
                    ->from('tests') 
                    ->where(array('id', $testId));
        $results = $query->result_one();
        
        return $results;
    }
    public function getTestSN($weekId=0, $practice, $check= 0){
    
        $listTest = _db()->useCache(1800)->select('*')->fromTests();
        
        $class = pzk_session()->getLop();
        $listTest->whereStatus(1);
        if($class)
            $listTest->likeClasses("%,$class,%");
        if($weekId)
            $listTest->likeCategoryIds("%,$weekId,%");
        $listTest->wherePractice($practice);
        $listTest->where(array("or", array('displayAtSite', '0'), array('displayAtSite', pzk_request()->getSiteId())));
        
        $listTest->orderBy('ordering asc');
        if(isset($check ) && ($check == 1)){
            return $listTest->result();
        }else{
            return $listTest->whereTrial(1)->result();
        }
    }
    public function getTest($weekId, $practice){
    
        $listTest = _db()->useCache(1800)->select('*')->from('tests');
        
        $class = $this->getClass();
        $listTest->whereStatus(1);
        if($class)
            $listTest->likeClasses("%,$class,%");
        if($weekId)
            $listTest->likeCategoryIds("%,$weekId,%");
        $listTest->wherePractice($practice);
        $listTest->orderBy('ordering asc');
        return $listTest->result();
    }
	
	public function  getCentWordTrueByWeek($userId, $startDate, $endDate) {
        $data = _db()->useCache(1800)->select('*')
            ->from('gamescore')
            ->where("userId = $userId")
            ->where('documentId != 0')
			->where("created >= '$startDate'")
			->where("created <= '$endDate'")
			->result();
			
        if(count($data) >0 ) {
			$totalWords = 0;
			$totalTrue = 0;
			foreach($data as $val) {
				$totalTrue = $totalTrue + $val['score'];
				$totalWords = $totalWords + $val['totalWord'];
			}
			return ceil($totalTrue*100/$totalWords);
		}else{
			return false;
		}
    }
	
	public function getOneAchievementByUserId($userId, $week, $year){
		$data = _db()->useCache(1800)
            ->select('a.id, a.week, a.year, a.tree, a.apple, a.flower, u.name, u.username')
            ->from('achievement a')
			->join('user u', 'a.userId = u.id', 'left')
			->where(array('week', $week))
			->where(array('year', $year))
			->where(array('userId', $userId))
            ->result_one();
		return $data;
	}
	function getRateAchievement($achievementId, $week, $year, $type) {
		$orderBy = $type.' desc';
        $data = _db()->useCache(1800)
            ->select('count(*) as total')
            ->from('achievement')
			->where(array('week', $week))
			->where(array('year', $year))
            ->orderBy($orderBy)
            ->result_one();
		
		$contest = _db()->useCache(1800)->selectAll()->fromAchievement()->whereId($achievementId)->result_one();
		
        $total = $data['total'];
		
		$data = _db()->useCache(1800)
            ->select('count(*) as total')
            ->from('achievement')
			->where(array('week', $week))
			->where(array('year', $year))
            ->orderBy($orderBy);
			if($type =='tree'){
				$data->gteTree($contest[$type]);
			}elseif($type =='apple'){
				$data->gteApple($contest[$type]);
			}elseif($type =='flower'){
				$data->gteFlower($contest[$type]);
			}
			
		$data = $data->result_one();
		
		$rating	= $data['total'];
		
		$allUsers = _db()->useCache(1800)->select('count(*) as c')->fromUser()->whereStatus(1)->result_one();

        return $rating.'/'.$allUsers['c'];
    }
	
	function getRateAchievementByCity($achievementId, $week, $year, $type, $city) {
		$orderBy = $type.' desc';
        $data = _db()->useCache(1800)
            ->select('count(*) as total')
            ->from('achievement')
			->where(array('week', $week))
			->where(array('year', $year))
			->where(array('areacode', $city))
            ->orderBy($orderBy)
            ->result_one();
		
		$contest = _db()->useCache(1800)->selectAll()->fromAchievement()->whereId($achievementId)->result_one();
		
        $total = $data['total'];
		
		$data = _db()->useCache(1800)
            ->select('count(*) as total')
            ->from('achievement')
			->where(array('week', $week))
			->where(array('year', $year))
			->where(array('areacode', $city))
            ->orderBy($orderBy);
			if($type =='tree'){
				$data->gteTree($contest[$type]);
			}elseif($type =='apple'){
				$data->gteApple($contest[$type]);
			}elseif($type =='flower'){
				$data->gteFlower($contest[$type]);
			}
			
		$data = $data->result_one();
		
		$rating	= $data['total'];
		$allUsers = _db()->useCache(1800)->select('count(*) as c')->fromUser()->whereStatus(1)->result_one();
        return $rating.'/'.$allUsers['c'];
    }
	function getRateAchievementByDistrict($achievementId, $week, $year, $type, $city, $district) {
		$orderBy = $type.' desc';
        $data = _db()->useCache(1800)
            ->select('count(*) as total')
            ->from('achievement')
			->where(array('week', $week))
			->where(array('year', $year))
			->where(array('areacode', $city))
			->where(array('district', $district))
            ->orderBy($orderBy)
            ->result_one();
		
		$contest = _db()->useCache(1800)->selectAll()->fromAchievement()->whereId($achievementId)->result_one();
		
        $total = $data['total'];
		
		$data = _db()->useCache(1800)
            ->select('count(*) as total')
            ->from('achievement')
			->where(array('week', $week))
			->where(array('year', $year))
			->where(array('areacode', $city))
			->where(array('district', $district))
            ->orderBy($orderBy);
			if($type =='tree'){
				$data->gteTree($contest[$type]);
			}elseif($type =='apple'){
				$data->gteApple($contest[$type]);
			}elseif($type =='flower'){
				$data->gteFlower($contest[$type]);
			}
			
		$data = $data->result_one();
		
		$rating	= $data['total'];
		$allUsers = _db()->useCache(1800)->select('count(*) as c')->fromUser()->whereStatus(1)->result_one();
        return $rating.'/'.$allUsers['c'];
    }
	function getRateAchievementBySchool($achievementId, $week, $year, $type, $city, $district, $school, $class) {
		$orderBy = $type.' desc';
        $data = _db()->useCache(1800)
            ->select('count(*) as total')
            ->from('achievement')
			->where(array('week', $week))
			->where(array('year', $year))
			->where(array('areacode', $city))
			->where(array('district', $district))
			->where(array('school', $school))
			->where(array('class', $class))
            ->orderBy($orderBy)
            ->result_one();
		
		$contest = _db()->useCache(1800)->selectAll()->fromAchievement()->whereId($achievementId)->result_one();
		
        $total = $data['total'];
		
		$data = _db()->useCache(1800)
            ->select('count(*) as total')
            ->from('achievement')
			->where(array('week', $week))
			->where(array('year', $year))
			->where(array('areacode', $city))
			->where(array('district', $district))
			->where(array('school', $school))
			->where(array('class', $class))
            ->orderBy($orderBy);
			if($type =='tree'){
				$data->gteTree($contest[$type]);
			}elseif($type =='apple'){
				$data->gteApple($contest[$type]);
			}elseif($type =='flower'){
				$data->gteFlower($contest[$type]);
			}
			
		$data = $data->result_one();
		
		$rating	= $data['total'];
		$allUsers = _db()->useCache(1800)->select('count(*) as c')->fromUser()->whereStatus(1)->result_one();
        return $rating.'/'.$allUsers['c'];
    }
	function getRateAchievementByClassname($achievementId, $week, $year, $type, $city, $district, $school, $class, $classname) {
		$orderBy = $type.' desc';
        $data = _db()->useCache(1800)
            ->select('count(*) as total')
            ->from('achievement')
			->where(array('week', $week))
			->where(array('year', $year))
			->where(array('areacode', $city))
			->where(array('district', $district))
			->where(array('school', $school))
			->where(array('class', $class))
			->where(array('classname', $classname))
            ->orderBy($orderBy)
            ->result_one();
		
		$contest = _db()->useCache(1800)->selectAll()->fromAchievement()->whereId($achievementId)->result_one();
		
        $total = $data['total'];
		
		$data = _db()->useCache(1800)
            ->select('count(*) as total')
            ->from('achievement')
			->where(array('week', $week))
			->where(array('year', $year))
			->where(array('areacode', $city))
			->where(array('district', $district))
			->where(array('school', $school))
			->where(array('class', $class))
			->where(array('classname', $classname))
            ->orderBy($orderBy);
			if($type =='tree'){
				$data->gteTree($contest[$type]);
			}elseif($type =='apple'){
				$data->gteApple($contest[$type]);
			}elseif($type =='flower'){
				$data->gteFlower($contest[$type]);
			}
			
		$data = $data->result_one();
		
		$rating	= $data['total'];
		$allUsers = _db()->useCache(1800)->select('count(*) as c')->fromUser()->whereStatus(1)->result_one();
        return $rating.'/'.$allUsers['c'];
    }
	public function getUserById($id) {
		$user =_db()->useCache(1800)->select('*')->from('user')->where(array('id',$id))->result_one();
		return $user;
	}
	
	public function getGameByCate($cateId){
		$data =_db()->useCache(1800)
			->select('count(*) as total')
			->from('gamescore')
			->where(array('categoryId', $cateId))
		->result_one();
		if($data['total'] > 0){
			return $data['total'];	
		}else{
			return 0;
		}
		
	}
	
	public function getHomeWork($userId, $class, $week){
		$data = _db()->select('*')
					->fromUser_book()
					->whereUserId($userId)
					->whereHomework(1)
					->whereWeek($week)
					->whereClass($class);
		//return $data->getQuery();			
		return $data->result();			
	}
	public function getCompabilityNs($userId, $class){
		$data = _db()->select('*')
					->fromUser_book()
					->whereUserId($userId)
					->whereCompability(1)
					->whereClass($class)
					->result();	
		return $data;			
	}
	public function getCompabilityMonth($userId, $class, $month){
		$data = _db()->select('*')
					->fromUser_book()
					->whereUserId($userId)
					->whereCompability(1)
					->whereMonth($month)
					->whereClass($class)
					->result();	
		return $data;			
	}

}