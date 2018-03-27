<?php

class PzkEntityUserbookUsercontestModel extends PzkEntityModel {
	public $table = 'user_contest';
	
	// xep hang bai thi thu
    function getRatingUserTest($camp,$page,$pageSize){
        
        $data = _db()->select('user_contest.id, user_contest.userId, user.username, user_contest.teacherMark, user_contest.mark, user_contest.totalMark, user_contest.duringTime, user_contest.created')
				->useCache(1800)
				->useCacheKey('getRatingUserTest_' . $camp . '_' . $page . '_' . $pageSize)
				->from('user_contest')
				->join('user', 'user_contest.userId = user.id', 'inner')
        		->where(array('camp', $camp))        
        		->orderBy('user_contest.totalMark  DESC, user_contest.duringTime ASC')
                ->limit( $pageSize, $page)
        	 	->result();
       	return $data;
    }
	
	// xep hang bai thi trung tam
    function getRatingUserTestTt($testId,$page,$pageSize){
        
        $data = _db()->select('user_book.id, user_book.userId, user.username, user.phone, user_book.mark, user_book.duringTime, user_book.created')
				->from('user_book')
				->join('user', 'user_book.userId = user.id', 'inner')
        		->where(array('testId', $testId))        
        		->orderBy('user_book.mark  DESC, user_book.duringTime ASC')
                ->limit( $pageSize, $page)
        	 	->result();
       	return $data;
    }
	function getRatingUserTestAllTt($testIdToan, $testIdVan,$page,$pageSize){
        
        $data = _db()->select('user_book.id, user_book.testId, user_book.userId, user.username, user.phone, user_book.mark, user_book.duringTime, user_book.created')
				->from('user_book')
				->join('user', 'user_book.userId = user.id', 'inner')
        		->where(array('or', array('testId', $testIdToan), array('testId', $testIdVan)))   
				->orderBy('user.username')		
                ->limit($pageSize, $page)
        	 	->result();
       	return $data;
    }
	function countRowAllTt($testIdToan, $testIdVan){
        $count = _db()->select('count(*) as count')
                ->from('user_book')
                ->where(array('or', array('testId', $testIdToan), array('testId', $testIdVan)))
                ->result_one();
        return $count['count'];
    }
		
	function showPageAllTt($pageSize, $testIdToan, $testIdVan){
        $numRow= $this->countRowAllTt($testIdToan, $testIdVan);
        $page= ceil($numRow/$pageSize);
        return $page;
    }
	
	function countRowTt($testId){
        $count = _db()->select('count(*) as count')
                ->from('user_book')
                ->where(array('testId', $testId))
                ->result_one();
        return $count['count'];
    }
    
    function loadTime($duringTime){
        $time = $duringTime;
        $time = secondsToTime($time);
        $hour = $time['h'];
        $min = $time['m'];
        $sec = $time['s'];

        $resultStrTime = '';

        if(!empty($hour)) {
            $resultStrTime .= $hour.' giờ ';
        }

        if(!empty($min)) {
            $resultStrTime .= $min.' phút ';
        }

        if(!empty($sec)) {
            $resultStrTime .= $sec.' giây ';
        }
        return  $resultStrTime;
    }
    function countRow($camp){
        $count = _db()->select('count(*) as count')
				->useCache(1800)
				->useCacheKey('countRow_'. $camp)
                ->from('user_contest')
                ->where(array('camp', $camp))
                ->result_one();
        return $count['count'];
    }
    function showPage($pageSize, $camp){
        $numRow= $this->countRow($camp);
        $page= ceil($numRow/$pageSize);
        return $page;
    }
	
	function showPageTt($pageSize, $testId){
        $numRow= $this->countRowTt($testId);
        $page= ceil($numRow/$pageSize);
        return $page;
    }
    // end xep hang bai thi thu
	function checkContest($userId, $camp){
		$data = _db()->select('*')
			->from($this->table)
			->where(array('userId', $userId))
			->where(array('camp', $camp))
			->result_one();
		if(count($data) > 0) {
			return $data;	
		}else{
			return false;
		}
		
	}
	function checkContestCompability($userId, $parentTest){
		$data = _db()->select('*')
			->from($this->table)
			->where(array('userId', $userId))
			->where(array('parentTest', $parentTest))
			->result_one();
		if(count($data) > 0) {
			return $data;	
		}else{
			return false;
		}
		
	}
    function getListUserTest(){
        
        $test1s = _db()->select('history_payment_test.userId, user.name, user.username, user.phone, history_payment_test.test, user_contest.totalMark')
                ->from('history_payment_test')
                ->join('user', 'history_payment_test.userId = user.id', 'inner')
				->join('user_contest', 'user.id=user_contest.userId', 'inner')
                ->where(array('test', '1')) 
				->orderBy('user.username asc')
                ->result();
        $test1= array();

        foreach ($test1s as $arr) {
        $test1[$arr['userId']]=$arr;
      }
      
        
        $test2s = _db()->select('history_payment_test.userId')
                ->from('history_payment_test')
                ->where(array('test', '2'))
                ->result();
        $test2= array();
        foreach ($test2s as $arr2) {
            $test2[$arr2['userId']] = true;
        }
        $test= array();
        foreach ($test1 as $key=>$value) {
              if(isset($test2[$key])){
                
              }else $test[$key]=$value;
        }
        return $test;
    }
}