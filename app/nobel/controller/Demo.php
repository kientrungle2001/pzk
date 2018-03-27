<?php
class PzkDemoController extends PzkController {
	
	public function sendMail() {
		$mailtemplate = pzk_parse(pzk_app()->getPageUri('user/mailtemplate/register'));
		$mailtemplate->setUsername('kientrungle2001');
		$mailtemplate->setPassword('kienkien');
		$mail = pzk_mailer();
		//$mail->AddAddress('kieunghia.cntt@gmail.com');
		//$mail->Subject = 'Here is the subject';
		//$mail->Body    = $mailtemplate->getContent();
		//$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

		if(!$mail->send()) {
			echo 'Message could not be sent.';
			echo 'Mailer Error: ' . $mail->ErrorInfo;
		} else {
			echo 'Message has been sent';
		}
	}
	
	public function entityAction() {
		/*
		$entity = _db()->getTableEntity('news');
		$entity->setTitle('Tin tuc');
		$entity->setBrief('Mo ta');
		$entity->setContent('Noi dung');
		$entity->setRelated2s(array(1, 2, 3, 4));
		$entity->save();
		*/
		$entity = _db()->getTableEntity('news');
		$newss = $entity->getWhere(array('in', 'id', array(4, 5)));
		foreach($newss as $news) {
			echo $news->getTitle() . '<br />';
			var_dump($news->getRelated2s());
			//$news->setTitle($news->getTitle() . ' - updated');
			//$news->save();
		}
		
		$entity = _db()->getEntity('user');
		$entity->loadWhere(array('username', $username));
		$entity->set('name', 'Kieu Nghia');
		$entity->save();
	}
	
	public function registerAction(){
		$pageUri = $this->getApp()->getPageUri('user/register');
		// doc trang
		$page = PzkParser::parse($pageUri);

		// thao tac

		// hien thi
		$page->display();
		

	}
	public function logoutAction(){
		pzk_session('login',false);
		pzk_session('username',false);
		pzk_session('userId',false);
		header('location:/demo/index');

	}
	public function indexAction() {
		// duong dan
		if(pzk_session('login')){
			echo "Đăng nhập thành công, Xin chào ^^: ";
			//die();
		}
		$pageUri = $this->getApp()->getPageUri('user/login');
		// doc trang
		$page = PzkParser::parse($pageUri);

		// thao tac

		// hien thi
		$page->display();
		
		
		// insert
		if(0) {
		$row1 = array( 'title' => 'Bai viet 3', 'content' => 'Bai viet 3' );
		$row2 = array( 'title' => 'Bai viet 4', 'content' => 'Bai viet 4' );
		_db()->insert('news')->fields('title,content')->values(array($row1, $row2))->result();
		}

		// update
		if(0) {
		_db()->update('news')->set(array('title' => 'Bai viet 4.1'))->where('id=4')->result();
		}

		// join
		if(0){
		$items = _db()->select('news.*, new2.*')->from('news')->join('new2', 'news.id = new2.id', 'left')->result();
		var_dump($items);
		}



		// delete
		if(0) {
		_db()->delete()->from('news')->where('id=4')->result();
		}

		// entity
		if(0){

		$news = _db()->getEntity('news');
		$news->load(2);
		//echo $news->getContent();
		$news->setTitle('Bai viet 2 updated');
		$news->save();

		$author = $news->getAuthor();
		$author->setLastEditTime($_SERVER['REQUEST_TIME']);
		$author->save();
		$numberOfNews = $author->getNumberOfNews();
		echo $numberOfNews;
		}
		
		if(0) {
		//entity from query
		$newsEntities = _db()->select('*')->from('news')->result('news');
		foreach($newsEntities as $newsEntity) {
			echo $newsEntity->getTitle() .'<br />';
		}
		
		// table entity
		$news = _db()->getTableEntity('news');
		$news->load(2);
		$news->setTitle('BV 2 Updated');
		$news->save();
		
		
		$entity = _db()->getTableEntity('news');
		$entity->setTitle('Tin tuc');
		$entity->setBrief('Mo ta');
		$entity->setContent('Noi dung');
		$entity->setRelated2s(array(1, 2, 3, 4));
		$entity->save();
		
		$entity = _db()->getTableEntity('news');
		// getWhere($conditions, $orderBy);
		$newss = $entity->getWhere(array('in', 'id', array(4, 5)));
		foreach($newss as $news) {
			echo $news->getTitle() . '<br />';
			var_dump($news->getRelated2s());
			$news->setTitle($news->getTitle() . ' - updated');
			$news->save();
		}
		}
	}
	public function registerPostAction(){
		echo "register";
		$request= pzk_element('request');
		$name= $request->get('name');
		$username=$request->get('username');
		$testUser= _db()->useCB()->select('user.*')->from('user')->where(array('equal','username',$request->get('username')))->result();
		if($testUser){
			echo 'user đã tồn tại trên hệ thống';
		}else{
		$password=$request->get('password');
		$row = array('name' =>$name,'username'=>$username,'password'=>md5($password) );
		$items= _db()->insert('user')->fields('name,username,password')->values(array($row))->result();
	}

	}

	public function loginpostAction(){
		echo "hello";
		$request = pzk_element('request');
		//echo $request->get('login');
		$items = _db()->useCB()->select('user.*')->from('user')->where(array('and', array('equal', 'username', $request->get('login')), array('equal','password',$request->get('password')) ))->result_one();
		if($items){
			//echo 'dang nhap thanh cong';
			//echo $items['id'];
			pzk_session('login', true);
			pzk_session('username', $request->get('login'));
			pzk_session('userId',$items['id']);
			header('location:/demo/index');

		}else{
			
			$pageUri = $this->getApp()->getPageUri('user/login');
		// doc trang
		     $page = PzkParser::parse($pageUri);
		     $page->setError('dang nhap khong thanh cong');
		// thao tac

		// hien thi
		      $page->display();
		}
	}
	
	public function sessionAction() {
		// cach 1: su dung php $_SESSION
		// cach 2: su dung database
		// cach 3: su dung file
		session_set('abc', '123', 'SessionVar');
		$abc = session_get('abc', 'SessionVar');
		
	}
    public $events = array(
        'index.after' => array('this.indexAfter'),
        'dkx' => array('this.b', )
    );
    public function a() {
        //dang ki xong
        $this->fireEvent('dkx', $user);
    }
    public function b($user) {
        //gui mail
    }
	
	public function partialAction() {
		partial('test', array());
	}
	
	public function updateAction() {
		$updation = pzk_model('Updation');
		$updation->update('user')->set(array('status' => 1))->where(array('id', 1));
		$updation->result();
	}
	
	public function treeAction() {
		$items = _db()->selectAll()->fromCategories()->where(
			array('or',
				array('like', 'parents', '%,37,%'),
				array('like', 'parents', '%,38,%')
			)
		)->result();
		$result = treefy($items);
		foreach($result as $item) {
			echo str_repeat('-', $item['level']) . $item['name']. '<br />';
		}
	}
}

function session_set($var, $val, $storage = 'FileVar') {
	$s = new $storage('session.txt');
	$s->save($var, $val);
}

function session_get($var, $storage = 'FileVar') {
	$s = new $storage('session.txt');
	return $s->load($var);
}

class FileVar {
	public $file;
	public function __construct($file) {
		$this->file = $file;
	}
	
	public function save($var, $val) {
		$contet = file_get_contents($this->file);
		$data = json_decode($content, true);
		if(!$data) {
			$data = array();
		}
		$data[$var] = $val;
		file_put_contents($this->file, json_encode($data));
	}
	public function load($var) {
		$contet = file_get_contents($this->file);
		$data = json_decode($content, true);
		if(!$data) {
			$data = array();
		}
		if(isset($data[$var]))
			return $data[$var];
		return NULL;
	}
}

class SessionVar {
	public $file;
	public function __construct($file) {
		$this->file = $file;
	}
	public function save($var, $val) {
		$_SESSION[$var] = $val;
	}
	public function load($var) {
		return @$_SESSION[$var];
	}
}