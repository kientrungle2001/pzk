<?php
class PzkUserbookModel {
	
	function getUserBook($id = ''){
		
		if(!empty($id)){
			
			$query = _db()->select('*') ->from('user_book') ->where("id=' $id '");
			$data =  $query->result_one();
			return $data;
		}
		return null;
	}
	/***
	 * Get data table user_book
	 * 
	 * 
	 * @param string $userBookId
	 */
	function getUserAnswerAdmin($userBookId = ''){
		$adminId = Pzk_session('adminId');
		if(!empty($userBookId)){
				
			$adminLevel = pzk_session('adminLevel');
			
			if($adminLevel != 'Administrator') {
				if($adminLevel == 'Teacher'){
					$query = _db()->select('u.*, t.teacherIds') 
					->from('user_answers u')
					->join('tests t', 'u.testId = t.id');
					$query->whereUser_book_id($userBookId);
				
					$query->likeTeacherIds("%,$adminId,%");
					$query->whereQuestion_type('TL');
				}else{
					$query = _db()->select('u.*, q.teacherIds') 
					->from('user_answers u')
					->join('questions q', 'u.questionId = q.id');
					$query->whereUser_book_id($userBookId);
				
					$query->likeTeacherIds("%,$adminId,%");
					$query->whereQuestionType(4);
				}
				
			}else{
				$query = _db()->select('*') ->from('user_answers');
				$query->whereUser_book_id($userBookId);
				$query->whereQuestion_type('TL');
			}
			
			//echo $query->getQuery();
			 
			return $query->getQuery();
			$data =  $query->result();
			
			foreach($data as $key => $value){
				
				if(@$value['user_answers_text_id'] != 0){
	
					$queryText = _db()->select('content') ->from('user_answers_text') ->where(array('id', $value['user_answers_text_id']));
	
					$content_text = $queryText->result_one();
	
					$data[$key]['content'] = $content_text;
				}
			}
			return $data;
		}
		return null;
	}
	
	function getUserAnswerAdminNs($userBookId = '', $homework = false){
		$adminId = Pzk_session('adminId');
		if(!empty($userBookId)){
				
			$adminLevel = pzk_session('adminLevel');
			
			if($adminLevel != 'Administrator' && $adminLevel != 'Headmaster') {
				if($adminLevel == 'Teacher' || $adminLevel == 'HoomroomTeacher' ){
					if($homework == 1){
							
						$query = _db()->select('u.*, t.teacherIds') 
						->from('user_answers u')
						->join('tests t', 'u.testId = t.id');
						$query->whereUser_book_id($userBookId);
					
						$query->where(['like', 't.TeacherIds', '%,'.$adminId.',%']);
						$query->whereQuestion_type('TL');
					
					}else{
						$query = _db()->select('u.*, q.teacherIds') 
						->from('user_answers u')
						->join('questions q', 'u.questionId = q.id');
						$query->whereUser_book_id($userBookId);
					
						$query->likeTeacherIds("%,$adminId,%");
						$query->whereQuestionType(4);
					}
				}
				
			}else{
				$query = _db()->select('*') ->from('user_answers');
				$query->whereUser_book_id($userBookId);
				$query->whereQuestion_type('TL');
			}
			
			//echo $query->getQuery();
			 
			//return $query->getQuery();
			$data =  $query->result();
			
			foreach($data as $key => $value){
				
				if(@$value['user_answers_text_id'] != 0){
	
					$queryText = _db()->select('content') ->from('user_answers_text') ->where(array('id', $value['user_answers_text_id']));
	
					$content_text = $queryText->result_one();
	
					$data[$key]['content'] = $content_text;
				}
			}
			return $data;
		}
		return null;
	}
	
	function getUserAnswers($userBookId = ''){
		$adminId = Pzk_session('adminId');
		if(!empty($userBookId)){
				
			
			$query = _db()->select('*') 
			->useCache(1800)
			->useCacheKey('getUserAnswers_' . $userBookId)
			->from('user_answers');
			$query->where("user_book_id=' $userBookId '");
		
			//echo $query->getQuery();
			
			$data =  $query->result();
			
			foreach($data as $key => $value){
				
				if(@$value['user_answers_text_id'] != 0){
	
					$queryText = _db()->select('content') ->from('user_answers_text') ->where(array('id', $value['user_answers_text_id']));
	
					$content_text = $queryText->result_one();
	
					$data[$key]['content'] = $content_text;
				}
			}
			return $data;
		}
		return null;
	}
	
	function getAdminName($id = ''){
		
		if(!empty($id) && $id != 0){
			
			$query = _db()->select('name') ->from('admin') ->where("id='$id'");
			$data =  $query->result_one();
			return $data;
		}
		return null;
	}
	
	function getUserName($id = ''){
	
		if(!empty($id) && $id != 0){
				
			$query = _db()->select('username') ->from('user') ->where("id='$id'");
			$data =  $query->result_one();
			return $data;
		}
		return null;
	}
	
	function getQuestionBook($id = ''){
		
		if(!empty($id)){
			
			$query = _db()->select('request, name') ->from('questions') ->where(array('id' =>$id, 'deleted' => 0));
			$data =  $query->result_one();
			return 	$data;
		}
		return null;
	}
	
	function isOwner($id, $field = "id", $isOwner, $table = "user_book"){
		
		$query = _db()->select('id') ->from($table) ->where(array('id' => $id, $field => $isOwner , 'deleted' => 0));
		$data =  $query->result();
		if(count($data)> 0){
			return true;
		}
		return false;
	}
	
	function getUserbookId($key_book){
		$query = _db()->select('id') ->from('user_book') ->where(array('keybook' => $key_book, 'deleted' => 0));
		$data =  $query->result_one();
		if(count($data)> 0){
			return $data['id'];
		}
		return false;
	}
	
	function checkContentQuestion($dataAnswerAdmin = array()){
		$query = _db()->select('question_id, content') ->from('answers_question_tn') ->where(array('question_id' => $dataAnswerAdmin['question_id']));
		$data =  $query->result();
		if(count($data) >0){
			foreach($data as $key => $value){
				
				if(trim($value['content']) == trim($dataAnswerAdmin['content'])){
					
					return false;
				}
			}
		}
		return true;
	}
	
	function checkAdminTransactionbyUserbookId( $userbookId = ""){
	
		if($userbookId !=""){
				
			$countTransaction = _db()->select('count(*) as c')->fromAdmin_transactions()->whereUserbookId($userbookId)->result();
				
			if($countTransaction['c'] >0){
				return true;
			}
		}
		return false;
	
	}
	
	function adminTransactionUserbook($adminId, $service, $amount = 0, $reason, $userbookId = NULL, $modifiedId, $sign = NULL){
		
		$datetime	=  date(DATEFORMAT);
		
		$admin_wallets	=_db()->getEntity('Admin.AdminWallets');
		
		$admin_wallets->loadWhere(array('adminId', $adminId));
		
		$adminTransactions	=	_db()->getEntity('Admin.AdminTransactions');
		
		if($admin_wallets->getId()){
			
			//	for admin_transactions
			
			$dataTransactions 	=	array(
					'adminId'		=> $adminId,
					'sign'			=> $sign,
					'paymentType'	=> 'admin wallets',
					'amount'		=> $amount,
					'paymentDate'	=> $datetime,
					'reason'		=> $reason,
					'service'		=> $service,
					'userbookId'	=> $userbookId,
					'modifiedId'	=> $modifiedId,
					'modified'		=> $datetime,
					'status'		=> 1, 
			);
			
			$adminTransactions->setData($dataTransactions);
			
			$adminTransactions->save();
			
			// for admin_wallets
			
			$admin_wallets_amount = "";
				
			if($sign !== NULL && $sign == SIGN_SUM){
			
				$admin_wallets_amount = $admin_wallets->getAmount() + $amount;
			
			}elseif($sign !== NULL && $sign == SIGN_SUB){
			
				$admin_wallets_amount = $admin_wallets->getAmount() - $amount;
			}
			
			$amount_total_sum	= _db()->select(SUM('amount'))->fromAdmin_transactions()->where(array('adminId' => $adminId, 'sign'	=> SIGN_SUM));
			
			$amount_total_sub	= _db()->select(SUM('amount'))->fromAdmin_transactions()->where(array('adminId' => $adminId, 'sign'	=> SIGN_SUB));
			
			$dataAminWallets	= array(
					'amount' 		=> $admin_wallets_amount,
					'modifiedId' 	=> $modifiedId,
					'modified' 		=> $datetime,
					'amount_total'	=> $amount_total_sum - $amount_total_sub,
			);
				
			$admin_wallets->update($dataAminWallets);
			
		}else{
			
			$admin	=	_db()->getEntity('Admin')->loadId($adminId);
			
			// for admin_transactions
			
			$dataTransactions	=	array(
					'adminId'		=> $userId,
					'sign'			=> $sign,
					'paymentType'	=> 'admin wallets',
					'amount'		=> $amount,
					'paymentDate'	=> $datetime,
					'reason'		=> $reason,
					'service'		=> $service,
					'userbookId'	=> $userbookId,
					'status'		=> 1				// admin_transactions transactions availability 
			);
			
			$adminTransactions->setData($dataTransactions);
			
			$adminTransactions->save();
			
			// for admin_wallets
			
			$dataAminWallets	=	array(
					'adminId'		=> $adminId,
					'adminName'		=> $admin->getName(),
					'amount'		=> $amount,
					'amount_total'	=> $amount,
					'created'		=> $datatime,
					'createdId'		=> $modifiedId,
					'status'		=> 1, 				// admin_wallets transactions availability
			);
			
			$admin_wallets->setData($dataAminWallets);
			
			$admin_wallets->save();
		}
	}
	
	public function getQuestionByTrytestId($trytestId) {
		$question = _db()
			->useCache(1800)
			->select('*')
			->from('questions')
			->likeTestId("%,$trytestId,%")
			->where('status = 1')
			->result();
			
		return $question;
	}
	
}