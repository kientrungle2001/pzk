<?php 
/**
* Entity User Account User: Thông tin về người dùng
*/
class PzkEntityUserAccountUserModel extends PzkEntityModel
{
	public $table			=	"user";
	public $_classrooms		=	false;
	
	/**
	Thông tin về số tiền trong ví điện tử của người dùng
	*/
	public function getWallets($userId = false)
	{
		if(!$userId) {
			$userId = $this->getId();
		}
		
		$wallets=_db()->getEntity('User.Account.Wallets');
		
		$wallets->loadWhere(array('userId',$userId));
		if($wallets->getId()){
			return $wallets->getamount();
		}else return 0;
	}
	
	/**
	Tạo người dùng mới
	*/
	public function create($userData) {
		$this->setData($userData);
		$this->save();
	}
	
	/**
	Thêm bạn bè
	*/
	public function addFriend($invitation) {
		if($invitation->getId() && $invitation->getUserinvitation() != $this->getId()) {
			$friend = _db()->getEntity('Communication.Friend');
			
			// check xem đã là bạn bè chưa
			$friend->loadWhere(array('and', array('userId', $this->getId()), array('userfriend', $invitation->getUserinvitation())));
			if($friend->getId()) return false;
			
			// nếu chưa là bạn bè thì thêm bạn bè
			$friend->setUserId($invitation->getUserId());
			$friend->setUserfriend($invitation->getUserinvitation());
			$friend->setDate(date('Y-m-d H:i:s', $_SERVER['REQUEST_TIME']));
			$friend->save();
			
			// thêm cho bên kia
			$friend = _db()->getEntity('Communication.Friend');
			$friend->setUserId($invitation->getUserinvitation());
			$friend->setUserfriend($this->getId());
			$friend->setDate(date('Y-m-d H:i:s', $_SERVER['REQUEST_TIME']));
			$friend->save();
			return true;
		}
		return false;
		
	}
	
	/**
	Hủy kết bạn
	*/
	public function removeFriend($user) {
		if($user->getId()) {
			
			// hủy kết bạn bên user
			$friend = _db()->getEntity('Communication.Friend');
			$friend->loadWhere(array('and', array('username', $this->getUsername()), array('userfriend', $user->getUsername())));
			if($friend->getId()) {
				$friend->delete();
			} else {
				return false;
			}
			
			// hủy kết bạn bên friend
			$friend = _db()->getEntity('Communication.Friend');
			$friend->loadWhere(array('and', array('username', $user->getUsername()), array('userfriend', $this->getUsername())));
			if($friend->getId()) {
				$friend->delete();
			}
			return true;
		}
		return false;
	}
	
	/**
	Mời kết bạn, kèm lời nhắn
	*/
	public function inviteFriend($user, $message) {
		if($user->getId()) {
			$invitation = _db()->getEntity('Communication.Invitation');
			$invitation->setUsername($this->getUsername());
			$invitation->setUserinvitation($user->getUsername());
			$invitation->setInvitation($message);
			$invitation->save();	
		}
	}
	
	/**
	Chấp nhận lời mời kết bạn
	*/
	public function acceptInvitation($invitation) {

		if($this->getId() == $invitation->getUserId()) {
			
			$this->addFriend($invitation);
			$invitation->delete();
			return true;
		}
		return false;
		
	}
	
	/**
	Hủy lời mời kết bạn
	*/
	public function denyInvitation($invitation) {
		if($this->getId() == $invitation->getUserId()) {
			$invitation->delete();
			return true;
		}
		return false;
	}
	
	public function loadByUsername($username) {
		return $this->loadWhere(array('username', $username));
	}
	public function loadByUserId($userId) {
		return $this->loadWhere(array('id', $userId));
	}
	public function loadByKey($key) {
		return $this->loadWhere(array('key', $key));
	}
	
	public function loadByEmail($email) {
		return $this->loadWhere(array('email', $email));
	}
	public function loadByAreacode($areaId){
		if($areaId){
			$area = _db()->select('areacode.name as name')->from('areacode')->where(array('id',$areaId))->result_one();
			return $area['name'];
		}else return "Tỉnh/TP";
		
	}
	public function checkSchool(){
		$listTest = _db()->useCache(1800)->select('areacode.mark as mark')->fromAreacode()
						->whereId(pzk_session('school'))
				        ->result_one();
        return $listTest['mark'];
	}
	public function login() {

		$s = pzk_session();
		$s->set('login',true);		
		$s->setUsername($this->getUsername());
		$s->setUserId($this->getId());
		$s->setName($this->getName());
		$s->setAvatar($this->getavatar());		
		$s->setEmail($this->getEmail());	
		$s->setPhone($this->getPhone());
		$s->setAddress($this->getaddress());
		$s->setSchoolname($this->getSchoolname());
		$s->setAreacode($this->getareacode());
		$s->setBirthday($this->getBirthDate());
		if($this->getSex() == '1') $s->setSex('Nam');
		else $s->setSex('Nữ');
		$hook_login = pzk_hook('login');
		if($hook_login) require $hook_login;
		if(pzk_request()->getSoftwareId()== 1 && pzk_request()->getSiteId() == 2){
			$s->setSchool($this->getSchool());
			$s->setSchoolEnable(1);
			$s->setDistrict($this->getDistrict());
			
			$s->setClassname($this->getClassname());
			$s->setClass($this->getClass());
			$s->setServicePackage($this->getServicePackage());
			$s->setCheckUser($this->getCheckUser());
			if($this->getCheckUser()){
				//check truong
				$checkSchool = $this->checkSchool();
				$s->setCheckSchool($checkSchool);
			}
		}
		$created = pzk_or($this->getRegistered(), $this->getCreated(), $this->getModified());
		$s->setCreated($created);

		$datelogin = date("Y-m-d H:i:s");
		$this->update(array('lastlogined' => $datelogin ));
		$login_ip = getIPAndAgent();
		pzk_uservar()->set($_SERVER['HTTP_HOST'] . $this->getUsername() . '_login_ip', $login_ip);
		pzk_user()->setData($this->getData());
		if(pzk_request()->getSoftwareId() == 1){
			$checkPayment= $this->checkPayment('full');
			$s->setCheckPayment($checkPayment);
		}
		
	}
	
	// check thanh toan		
	
	public $_serviceResourcePaids = array();
	public function checkPayment($serviceType, $resourceId = 0) {
		$key = md5(json_encode($resourceId));
		if(!isset($this->_serviceResourcePaids[$serviceType.$key])){
			$service = pzk_model('Service.'.ucfirst($serviceType));
			$this->_serviceResourcePaids[$serviceType.$key] = $service->checkPayment($resourceId);
		}
		return $this->_serviceResourcePaids[$serviceType.$key];
	}
	public function getContest() {		
		$payment = _db()->getEntity('payment.HistoryPaymentTest');		
		$active = $payment->CheckPaymentTest();		
		return $active;	
	}
	public function checkContest($contestId){
		$payment = _db()->getEntity('payment.HistoryPaymentTest');		
		$active = $payment->checkContest($contestId);		
		return $active;	
	}
	public function getViewtest() {		
		$payment = _db()->getEntity('payment.Historypaymentviewtest');		
		$active = $payment->CheckPaymentViewTest();		
		return $active;	
	}
	public function getServiceInfo() {
		$softwareId = pzk_request()->getSoftwareId();
		return _db()->selectAll()->fromHistory_payment()
		 							->whereUsername($this->getUsername())
		 							->whereBuySoftware($softwareId)
		  							->wherePaymentstatus('1')
		  							->result_one('Payment.History_payment');
	}
	
	public function logout() {
		$s = pzk_session();
		if($s->getadminUser() == $s->getUsername()) {
			$s->del('adminUser');
			$s->del('adminId');
			$s->del('adminLevel');
			$s->del('adminAreacode');
			$s->del('adminDistrict');
			$s->del('adminClass');
			$s->del('adminClassname');
			$s->del('categoryIds');	
		}
		
		$s->del('login');
		$s->del('username');
		$s->del('userId');
		$s->del('name');
		$s->del('avatar');
		$s->del('email');
		$s->del('phone');
		$s->del('areacode');
		$s->del('phone');
		$s->del('schoolname');
		$s->del('classname');
		$s->del('address');
		$s->del('birthday');
		if(pzk_request()->getSoftwareId()== 1 && pzk_request()->getSiteId() == 2){
			$s->del('district');
			$s->del('school');
			$s->del('schoolEnable');
			$s->del('class');			
			$s->del('checkUser');
			$s->del('servicePackage');
			if(pzk_session('checkSchool')) $s->del('checkSchool');	
		}
		
		$s->del('ipClient');
		$s->del('login_id');
		$s->del('checkPayment');
		$s->del('created');
		$this->setData(array());
	}
	
	public function activate() {
		$this->update(array('status' => 1,'key'=>""));
		if(pzk_request()->getApp()=='test'){
			return ;
		}
		$wallets = $this->getWallets();
		$wallets->setUsername($this->getUsername());
		$wallets->setAmount(0);
		$wallets->save();
	}
	public function testOnline($member)
	{
		$sessionID= pzk_session('userId');
		if($member == $sessionID)
		{
			$img='<img src="'.BASE_URL.'/default/skin/nobel/ptnn/media/online.png" alt=""> Online' ;
		}
		else
		{
			$img='<img src="'.BASE_URL.'/default/skin/nobel/ptnn/media/offline.png" alt=""> Offline' ;
		}
		 return $img;
		
	}
	public function resetPasssword() {
		$password=md5(rand(0,9999999999) . $this->getPassword());
		$password=substr($password,0,8) . 'AH1';
		$newPassword = md5($password);
		$this->update(array('password' => $newPassword, 'key'=>''));
		return $password;
	}
	// Form tim kiem ban be
	public function testFriend($member)
	{
		$sessionUserId= pzk_session('userId');
		
		$friend= _db()->getEntity('Communication.Friend');
		$friend->loadWhere(array(array('userId',$sessionUserId),array('userfriend',$member)));
		if($friend->getId())
		{
			 return true;
		}
		else
		{
			 return false;
		}

	}
	public function testInivitation($member)
	{
		$userId= pzk_session('userId');
		$invi= _db()->getEntity('Communication.Invitation');
		$invi->loadWhere(array(array('userId',$userId),array('userinvitation',$member)));
		if($invi->getId())
		{
			 return true;
		}
		else
		{
			 return false;
		}
	}
	public function testStatus($member)
	{		
		$sessionID= pzk_session('userId');
		// Kiểm tra xem member có phải là bạn với sessionID không?

		if($sessionID == $member)
		{
			return $img='';
		}
		else
		{
			$checkfriend= $this->testFriend($member);
			$checkinvitation= $this->testInivitation($member);
			if($checkfriend)
			{
				return $img='<a href="'.BASE_REQUEST.'/friend/denyfriend?member='.$member.'"><img src="'.BASE_URL.'/default/skin/nobel/ptnn/media/huyketban.png" </a>';
			}
			elseif($checkinvitation)
			{
				return $img='<a href="#"><img src="'.BASE_URL.'/default/skin/nobel/ptnn/media/send_email_user_alternative.png" </a>';
			}
			else
			{
				return $img='<a href="'.BASE_REQUEST.'/invitation/invitation?member='.$member.'"><img src="'.BASE_URL.'/default/skin/nobel/ptnn/media/pr_bt_ketban.png" </a>';
			}
		}
		
	}
	public function dateRegister($date){
		$datetime= date("y-m-d");;
		$nowY= date('y', strtotime($datetime));				
		$nowM= date('m', strtotime($datetime));				
		$nowD= date('d', strtotime($datetime));
		$endY= date('y', strtotime($date));				
		$endM= date('m', strtotime($date));				
		$endD= date('d', strtotime($date));
		$years= intval($nowY)- intval($endY);
		$quanttDate= (intval($nowM)- intval($endM))*30+ (intval($nowD)- intval($endD));
		if($years>0){
			return  $years.' năm '.$quanttDate. ' ngày';
		}else return $quanttDate. ' ngày';
	}
	// End form tim kiem ban be
	public function countInvitation() {
		
		$counter = _db()->select('count(*) as total')->fromInvitation()->whereUserId(pzk_session('userId'))->result_one();
		return $counter['total'];
	}
	public function viewInvitation()
	{
			
		/*$items_invi=_db()->useCB()->select('invitation.*')->from('invitation')->where(array('userId',pzk_session('userId')))->result();
		return $items_invi;*/
		return _db()->select('user.*')->from('invitation')
		->joinUser(json_decode('["equal", ["column", "user", "id"], ["column", "invitation", "userinvitation"]]', true))
		->where(array('equal', array('column', 'invitation', 'userId'), pzk_session('userId')))
		->result('User.Account.User');  
	}
	
	public function countFriend() {
		if(!$this->getId()) return 0;
		$counter = _db()->select('count(*) as total')->fromFriend()->whereUserId($this->getId())->result_one();
		return $counter['total'];
	}
	
	/*public function getFriends($pageSize = 3, $pageNum = 0) {
		return _db()->select('user.*')->fromFriend()
		->joinUser(json_decode('["equal", ["column", "user", "username"], ["column", "friend", "userfriend"]]', true))
		->where(array('equal', array('column', 'friend', 'username'), $this->getUsername()))
		->limit($pageSize, $pageNum)
		->result('User.Account.User');
	}*/
	public function getFriends() {

		return _db()->select('user.*')->from('friend')
		->joinUser(json_decode('["equal", ["column", "user", "id"], ["column", "friend", "userfriend"]]', true))
		->where(array('equal', array('column', 'friend', 'userId'), $this->getId()))
		->limit(3,0)
		->result('User.Account.User'); 
	}
	public function viewFriends($member) {
		$page=pzk_request()->getPage();
		if(!$page){
			$page=1;
		}
		return _db()->select('user.*')->from('friend')
		->joinUser(json_decode('["equal", ["column", "user", "id"], ["column", "friend", "userfriend"]]', true))
		->where(array('equal', array('column', 'friend', 'userId'), $member))
		->limit(6,$page-1)
		->result('User.Account.User'); 
	}
	public function getAvatar() {
		$avatar = parent::get('avatar');
		if(!$avatar){
			$avatar= BASE_URL.'/default/skin/nobel/ptnn/media/noavatar.gif';
		}		
		return $avatar;
	}

	public function delete() {
		$friends = $this->getFriends(1000);
		foreach ($friends as $friend) {
			$this->removeFriend($friend);
		}
		$this->getWallets()->delete();
		parent::delete();
	}
	public function loadArea(){
		$area = _db()->useCache(3600)->useCacheKey('areacode_type_province')->select('*')->from('areacode')->where(array('type','province'))->result();
		return $area;
	}
	public function getAreaByParent($parent){
		$area = _db()->useCache(3600)->select('*')->from('areacode')->where(array('parent',$parent))->result();
		return $area;
	}
	public function loadProvince(){
		$area = _db()->useCache(3600)->select('*')->from('areacode')->where(array('type','province'))->result();
		return $area;
	}
	
	public function getCity() {
		$area = _db()->getEntity('User.Account.Areacode');
		if($this->getareacode())
			$area->load($this->getareacode(), 300);
		return $area;
	}
	
	public function getOldQuestions(){
		return $data = pzk_uservar()->get($this->getUsername()) ? $data : array();
	}
	
	public function appendQuestions($questions) {
		$oldQuestions = $this->getOldQuestions();
		$allQuestions = array_merge($oldQuestions, $questions);
		pzk_uservar()->set($this->getUsername(), $allQuestions);
		return true;
	}
	public function CheckDate($serviceId, $userId){
		//Kiểm tra xem có phải gói học ko?
		$service= _db()->getEntity('Service.Service');
		$service->loadWhere(array('id',$serviceId));
		$serviceType= $service->getServiceType();
		if($serviceType=='goihoc'){
			$date=_db()->getEntity('Service.Buyservice');
			$date->loadWhere(array('and',array('userId',$userId),array('serviceId',$serviceId),array('status',1)));
			if($date->getId()){
				$datetime= date("y-m-d");
				$dateActive= $date->getDateActive();
				$dateEnd= $date->getDateEnd();
				if($dateEnd> $datetime){
					$nowY= date('y', strtotime($datetime));				
					$nowM= date('m', strtotime($datetime));				
					$nowD= date('d', strtotime($datetime));
					$endY= date('y', strtotime($dateEnd));				
					$endM= date('m', strtotime($dateEnd));				
					$endD= date('d', strtotime($dateEnd));
					$dateVip=(intval($endY)- intval($nowY))*365+ (intval($endM)- intval($nowM))*30+ (intval($endD)- intval($nowD));
					//return 'Bạn có '.$dateVip. ' ngày là Vip';
					return $dateVip;
				}else{
					$date->update(array('status'=>0));
					return 0;
				} 			
			}else  return 0;	
		}else  return 0;
	}
	public function checkMember($dateVip){
		if($dateVip<=0){
			return 'Thành viên thường';
		}else return 'Bạn có '.$dateVip. ' ngày là Vip';
	}
	public function checkIdFB() {
		$idFb = parent::getidFacebook();
		$email = parent::getemail();
		if($idFb){
			if(!$email){
				$member = parent::get('id');
				
				echo '<div class="prf_friend" style="height: 45px;"><a class="userfriend" href="/profile/addinfor?member='.$member.'">Thêm thông tin cá nhân</a> </div>';
			}
			
		}
		
	}
	public function checkIdG() {
		$idG = parent::getidGoogle();
		$password = parent::getpassword();
		if($idG){
			if(!$password){
				$member = parent::get('id');
				echo '<div class="prf_friend" style="height: 45px;"><a class="userfriend" href="/profile/addinforgoogle?member='.$member.'">Thêm thông tin cá nhân</a> </div>';
			}
			
		}
		
	}
	public function checkSex($sex){
		if($sex==1){
			return "Nam";
		}else return "Nữ";
	}
	public function getGender() {
		if($this->getSex()==1){
			return "Nam";
		}else return "Nữ";
	}
	public function getBirthDate() {
		$arr = explode('-', $this->getBirthday());
		return @$arr[2] . '/' . @$arr[1] . '/' . @$arr[0];
	}
	// Tính điểm học bạ cho user
	public function learnPoint($userId){
		if(!$userId) return 0;
		$counter = _db()->select('count(*) as total')->fromUser_book()->whereUserId($userId)->result_one();
		return $counter['total'];		
	}
	// Tính điểm thành tích cho user
	public function hieghtPoint($userId){
		if(!$userId) return 0;
		// điểm bài tập >=7
		$countBook = _db()->UseCB()->select('count(*) as count')->from('user_book')
		->Where(array('userId',$userId))
		->Where(array('testId',0))
		->Where(array('or',array('gte','mark',7),array('gte','teacherMark',7)))		
		->result_one();
		// Điểm bài thi >=7
		$countTest = _db()->UseCB()->select('max(mark) as maxPoint')->from('user_book')
		->Where(array('userId',$userId))
		->Where(array('gte','testId',1))
		->Where(array('gte','mark',7))
		->groupBy('testId')
		->result();

		return $count=intval($countBook['count'])+count($countTest);

	}
	// Xếp loại học bạ
	public function sortPoint($learnPoint, $hieghtPoint){
		if($learnPoint<=60){
			return "Đang cố gắng";
		}
		if($learnPoint> 60 && $learnPoint<=100){
			return "Chăm học";
		}
		if($learnPoint>100 ){
			return "Hăng say";
		}
		if($learnPoint> 200 && $hieghtPoint>=60){
			return "Năng khiếu tốt";
		}
		if($learnPoint>= 300 && $hieghtPoint>=100){
			return "Chăm chỉ học giỏi";
		}
	}
	//Xếp loại danh hiệu
	public function sortTrophies($learnPoint, $hieghtPoint){
		if($learnPoint< 600 && $learnPoint<200){
			return "Kiến Gỗ";
		}
		if($learnPoint> 600 && $learnPoint> 200 && $learnPoint< 1000 && $learnPoint < 500){
			return "Kiến Thép";
		}
		
		if($learnPoint>= 1000 && $learnPoint>= 500 && $learnPoint< 4000 && $learnPoint < 2500){
			return "Kiến Đồng";
		}
		if($learnPoint>= 4000 && $learnPoint>= 2500 && $learnPoint< 8000 && $learnPoint < 5000){
			return "Kiến Bạc";
		}
		if($learnPoint>= 8000 && $learnPoint>= 5000 && $learnPoint< 15000 && $learnPoint < 10000){
			return "Kiến Vàng";
		}
		if($learnPoint>= 15000 && $learnPoint>= 10000){
			return "Kiến Kim Cương";
		}
	}
	//check trophies
	public function checkTrophies($sortTrophies){
		if($sortTrophies && $sortTrophies !='Kiến Gỗ'){
			$ett_mess= _db()->getEntity('User.NewMessage');
			$ett_mess->loadWhere(array('and',array('userId',pzk_session('userId')),array('trophies',$sortTrophies)));
			
			if($ett_mess->getId()){
				
			}else{
				$rowmess=array('userId'=>pzk_session('userId'),'messageType'=>'trophies','trophies'=>$sortTrophies,'date'=>date('Y-m-d H:i:s'),'status'=>0);
				$ett_mess->create($rowmess);
			}
		}
	}
	// Đếm số lượng thông báo mới
	public function countMessage(){
		$count = _db()->select('count(*) as total')->fromnew_message()->whereUserId(pzk_session('userId'))->whereStatus(1)->result_one();
		return $count['total'];
	}
	public function showMessage(){
		$arr= array();
		$mess= _db()->UseCB()->select('new_message.*')
				->from('new_message')
				->where(array('userId',pzk_session('userId')))
				->where(array('status',1))
				->groupBy('messageType')
				->result();
		foreach ($mess as $item) {
			$arr[$item['messageType']]=$item;
		}
		return $arr;
	}
	public function showDetailMess($type){
		return $mess= _db()->UseCB()->select('new_message.*')
				->from('new_message')
				->where(array('userId',pzk_session('userId')))
				->where(array('status',1))
				->where(array('messageType',$type))
				->result();
	}
	public function showLetter(){
		$arr= array();
		$mess= _db()->UseCB()->select('newsletter_newsletter.*')
				->from('newsletter_newsletter')
				->result();
		foreach ($mess as $item) {
			$arr[$item['code']]=$item;
		}
		return $arr;
	}
	public function Service($serviceId){
		$service= _db()->UseCB()->select('service_packages.serviceName as name')
				->from('service_packages')
				->where(array('id',$serviceId))
				->where(array('status',1))
				->result_one();
		return $service['name'];
	}	
	public function showContent($messageType,$trophies,$amount,$body,$userBookId,$serviceId){
		if($messageType=='register'){
			return '<span >'.$body.'</span>';
		}
		if($messageType=='trophies'){
			return '<span >'.$body.' : </span><span class="orange1">'.$trophies.'</span>';
		}
		if($messageType=='mark'){
			return '<a target="blank" href="#" title=""><span>'.$body.$userBookId.'</span></a>';

		}
		if($messageType=='payservice'){
			$service=$this->Service($serviceId);
			return '<span>'.$body.'</span>';
		}
		if($messageType=='ordercard'){
			$service=$this->Service($serviceId);
			return '<span>'.$service.$body.'</span>';
		}
		if($messageType=='deposit'){
			return '<span>'.$body.'</span> <span class="orange1">'.$amount.' <sup> vnđ</sup></span>';
		}
		if($messageType=='paycardNextnobels'){
			return '<span>'.$body.'</span>';
		}
	}
	
	public function getClassrooms() {
		if($this->_classrooms) return $this->_classrooms;
		
		$classrooms 	=	_db()->select('education_classroom_student.*, education_classroom.schoolYear, education_classroom.gradeNum, education_classroom.className, education_classroom.place')->from('education_classroom_student')
			->join('education_classroom', 'education_classroom_student.classroomId = education_classroom.id')
			->whereStudentId($this->getId())->result();
		return $this->_classrooms = $classrooms;
	}
	private $_classroomIds = null;
	public function getClassroomIds() {
		if($this->_classroomIds) return $this->_classroomIds;
		return $this->_classroomIds = array_map(function($classroom) {
			return $classroom['classroomId'];
		}, $this->getClassrooms());
	}
	
	public function checkHomeworkAccess($homework) {
		
		$classrooms 	= 	$this->getClassrooms();
		$class 			=	pzk_session('lop');
		
		$foundInClass	=	false;
		foreach($classrooms as $classroom) {
			if($classroom['gradeNum'] == $class) {
				$foundInClass	=	true;
			}
		}
		
		if(!$foundInClass) {
			return false;
		}
		
		
		$homeworkClassrooms = _db()->selectAll()->from('education_classroom_homework')
			->whereHomeworkId($homework)->result();
		if(!count($homeworkClassrooms)) {
			return true;
		}
		
		foreach($classrooms as $classroom) {
			foreach($homeworkClassrooms as $homeworkClassroom) {
				if($classroom['classroomId'] == $homeworkClassroom['classroomId']) {
					return true;
				}
			}
		}
		return false;
	}
	
	public function checkCompabilityTestAccess($testId) {
		$username = $this->getUsername();
		$today = date('Y-m-d H:i:s');
		$query = _db()->select('id')->fromHistory_payment()
			->whereUsername($username)
			->wherePaymentstatus(1)
			->gtExpiredDate($today)
			->likeContestIds('%,'.$testId.',%')
			->whereServiceType('dotest')
			->result_one();
		if($query) {
			return 1;
		}
		return 0;
	}
	
	public function checkCompabilityTestView($testId) {
		$username = $this->getUsername();
		$today = date('Y-m-d H:i:s');
		$query = _db()->select('id')->fromHistory_payment()
			->whereUsername($username)
			->wherePaymentstatus(1)
			->gtExpiredDate($today)
			->likeContestIds('%,'.$testId.',%')
			->whereServiceType('doview')
			->result_one();
		if($query) {
			return 1;
		}
		return 0;
	}
	
	public function checkCompabilityTestDone($testId) {
		$testTnId 	= null;
		$testTlId 	= null;
		$testTn = _db()->select('id')->fromTests()->whereParent($testId)->whereTrytest(1)->result_one();
		$testTl   = _db()->select('id')->fromTests()->whereParent($testId)->whereTrytest(2)->result_one();
		
		if($testTn) {
			$testTnId = $testTn['id'];
		}
		if($testTl) {
			$testTlId = $testTl['id'];
		}
		
		$userId 	= $this->getId();
		if(!$userId) {
			return 0;
		}
		$userbookTn = _db()->select('id')->fromUser_book()->whereUserId($userId)->whereTestId($testTnId)->result_one();
		$userbookTl = _db()->select('id')->fromUser_book()->whereUserId($userId)->whereTestId($testTlId)->result_one();
		if($userbookTn && $userbookTl) {
			return 1;
		}
		return 0;
	}
}
 ?>