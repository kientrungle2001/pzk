<?php
class PzkDemoController extends PzkController {
	public $masterPage = 'index';
	public $masterPosition = 'left';
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
		$entity->setName( 'Kieu Nghia');
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
		pzk_session()->setLogin(false);
		pzk_session()->setUsername(false);
		pzk_session()->setUserId(false);
		header('location:/demo/index');

	}
	public function indexAction() {
		// duong dan
		if(pzk_session()->getLogin()){
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
		$request= pzk_request();
		$name= $request->getName();
		$username=$request->getUsername();
		$testUser= _db()->useCB()->select('user.*')->from('user')->where(array('equal','username',$request->getUsername()))->result();
		if($testUser){
			echo 'user đã tồn tại trên hệ thống';
		}else{
		$password=$request->getPassword();
		$row = array('name' =>$name,'username'=>$username,'password'=>md5($password) );
		$items= _db()->insert('user')->fields('name,username,password')->values(array($row))->result();
	}

	}

	public function loginpostAction(){
		echo "hello";
		$request = pzk_request();
		//echo $request->getLogin();
		$items = _db()->useCB()->select('user.*')->from('user')->where(array('and', array('equal', 'username', $request->getLogin()), array('equal','password',$request->getPassword()) ))->result_one();
		if($items){
			//echo 'dang nhap thanh cong';
			//echo $items['id'];
			pzk_session()->setLogin( true);
			pzk_session()->setUsername( $request->getLogin());
			pzk_session()->setUserId($items['id']);
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
		session_->setAbc( '123', 'SessionVar');
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
    
    public function collectionAction() {
    	$col = pzk_model('Collection', true);
    	$users = $col->select('*')->from('user')->result();
    	echo count($users);
    	
    }
	
	public function facebookAction() {
		require_once(BASE_DIR.'/3rdparty/Facebook/autoload.php');
  		$fb = new Facebook\Facebook([
		  'app_id' => '416910795159265',
		  'app_secret' => '28c5401ea906bb538d773f198ce2b185',
		  'default_graph_version' => 'v2.2',
		  ]);
		
		$helper = $fb->getRedirectLoginHelper();

		$permissions = array('email',
		  'user_location',
		  'user_birthday',
		  'publish_actions',
		  'publish_pages',
		  'user_managed_groups',
		  'manage_pages',
		  'public_profile'
		); // Optional permissions
		$loginUrl = $helper->getLoginUrl('http://ptnn.vn/demo/fblogin', $permissions);

		echo '<a href="' . $loginUrl . '">Log in with Facebook!</a>';
	}
	
	public function fbloginAction() {
		require_once(BASE_DIR.'/3rdparty/Facebook/autoload.php');
		$fb = new Facebook\Facebook([
		  'app_id' => '416910795159265',
		  'app_secret' => '28c5401ea906bb538d773f198ce2b185',
		  'default_graph_version' => 'v2.2',
		  ]);

		$helper = $fb->getRedirectLoginHelper();

		try {
		  $accessToken = $helper->getAccessToken();
		  // echo $accessToken;
		} catch(Facebook\Exceptions\FacebookResponseException $e) {
		  // When Graph returns an error
		  echo 'Graph returned an error: ' . $e->getMessage();
		  exit;
		} catch(Facebook\Exceptions\FacebookSDKException $e) {
		  // When validation fails or other local issues
		  echo 'Facebook SDK returned an error: ' . $e->getMessage();
		  exit;
		}
		
		if (! isset($accessToken)) {
		  if ($helper->getError()) {
			header('HTTP/1.0 401 Unauthorized');
			echo "Error: " . $helper->getError() . "\n";
			echo "Error Code: " . $helper->getErrorCode() . "\n";
			echo "Error Reason: " . $helper->getErrorReason() . "\n";
			echo "Error Description: " . $helper->getErrorDescription() . "\n";
		  } else {
			header('HTTP/1.0 400 Bad Request');
			echo 'Bad request';
		  }
		  exit;
		}

		// Logged in
		echo '<h3>Access Token</h3>';
		var_dump($accessToken->getValue());

		// The OAuth 2.0 client handler helps us manage access tokens
		$oAuth2Client = $fb->getOAuth2Client();

		// Get the access token metadata from /debug_token
		$tokenMetadata = $oAuth2Client->debugToken($accessToken);
		echo '<h3>Metadata</h3>';
		var_dump($tokenMetadata);

		// Validation (these will throw FacebookSDKException's when they fail)
		$tokenMetadata->validateAppId('416910795159265');
		// If you know the user ID this access token belongs to, you can validate it here
		//$tokenMetadata->validateUserId('123');
		$tokenMetadata->validateExpiration();

		if (! $accessToken->isLongLived()) {
		  // Exchanges a short-lived access token for a long-lived one
		  try {
			$accessToken = $oAuth2Client->getLongLivedAccessToken($accessToken);
		  } catch (Facebook\Exceptions\FacebookSDKException $e) {
			echo "<p>Error getting long-lived access token: " . $helper->getMessage() . "</p>\n\n";
			exit;
		  }

		  echo '<h3>Long-lived</h3>';
		  var_dump($accessToken->getValue());
		}

		$_SESSION['fb_access_token'] = (string) $accessToken;

		// User is logged in with a long-lived access token.
		// You can redirect them to a members-only page.
		//header('Location: https://example.com/members.php');
	}
	
	public function fbpostAction() {
		//echo $_SESSION['fb_access_token'];die();
		require_once(BASE_DIR.'/3rdparty/Facebook/autoload.php');
		$fb = new Facebook\Facebook([
		  'app_id' => '416910795159265',
		  'app_secret' => '28c5401ea906bb538d773f198ce2b185',
		  'default_graph_version' => 'v2.2',
		  ]);
		
		//$rssItem = _db()->getTableEntity('rss_feed')->loadWhere(array('posted', 0));
		
		//if(!$rssItem->getId()) return false;
		$linkData = [
		  'link' => 'http://nextnobels.com/Chuong-trinh-hoc-he-mon-TIENG-ANH-nam-hoc-2015-2016',
		  'message' => 'Tiếng Anh và Ẩm thực - Chủ đề này nằm trong hệ thống chương trình học Tiếng Anh trải nghiệm thực tế của Trung tâm phát triển Ngôn ngữ - Công ty CP Giáo dục Phát triển Trí tuệ & Sáng tạo Next Nobels.',
		  'picture' => 'http://nextnobels.com/3rdparty/Filemanager/source/h%E1%BB%8Dc%20h%C3%A8.jpg'
		  ];
		//$rssItem->update(array('posted' => 1));

		try {
		  // Returns a `Facebook\FacebookResponse` object
		  $response = $fb->post('/me/feed', $linkData, $_SESSION['fb_access_token']);
		} catch(Facebook\Exceptions\FacebookResponseException $e) {
		  echo 'Graph returned an error: ' . $e->getMessage();
		  exit;
		} catch(Facebook\Exceptions\FacebookSDKException $e) {
		  echo 'Facebook SDK returned an error: ' . $e->getMessage();
		  exit;
		}

		$graphNode = $response->getGraphNode();

		echo 'Posted with id: ' . $graphNode['id'];
	}
	
	public function adflyAction() {
		echo adfly('http://news.zing.vn/Sao-Viet-va-cai-gia-cua-su-noi-tieng-post567838.html', 'ae4bc1b917d86f20427c10b20a176d61', '10633459');
	}
	
	public function feedAction() {
		$rss = getFeed('http://vietnamnet.vn/rss/xa-hoi.rss');
		foreach($rss as $item) {
			$rssItem = _db()->getTableEntity('rss_feed');
			$item['shorten'] = adfly($item['link'], 'ae4bc1b917d86f20427c10b20a176d61', '10633459');
			$rssItem->setData($item);
			$rssItem->save();
		}
	}
	
	public function formAction() {
		$form = $this->parse('<core.form />');
		$form->setAction('/demo/formPost');
		$form->setBackHref('/demo/form');
		$form->setBackLabel('Quay lại');
		$form->setActions(array(
			array(
				'name' 	=> 'submit',
				'label'	=> 'Thêm'
			)
		));
		$form->setFieldSettings(array(
			array(
				'index' => 'title',
				'type' => 'text',
				'label' => 'Hoạt động'
			),
			array(
				'index' => 'brief',
				'type' => 'text',
				'label' => 'Mô tả ngắn gọn'
			),
			array(
				'index' => 'date',
				'type' => 'date',
				'label' => 'Ngày diễn ra'
			),
			array(
				'index' => 'content',
				'type' => 'tinymce',
				'label' => 'Ngày diễn ra'
			)
		));
		$this->render($form);
		//$form->display();
	}
	
	public function buildAction() {
		$package = pzk_model('Package');
		$package->build('timepicker', BASE_DIR .'/packages/');
		echo 'Completed!';
	}
	
	public function emptyAction() {
		echo "Hello, world";
	}
	
	public function treeAction() {
		$items = _db()->selectAll()->fromCategories()->result();
		$result = treefy($items);
		foreach($result as $item) {
			echo str_repeat('-', $item['level']-1) . $item['name']. '<br />';
		}
	}
}

function adfly($url, $key, $uid, $domain = 'j.gs', $advert_type = 'int')
{
  // base api url
  $api = 'http://api.adf.ly/api.php?';

  // api queries
  $query = array(
    'key' => $key,
    'uid' => $uid,
    'advert_type' => $advert_type,
    'domain' => $domain,
    'url' => $url
  );

  // full api url with query string
  $api = $api . http_build_query($query);
  // get data
  if ($data = file_get_contents($api))
    return $data;
}

function getFeed($feed_url) {
     
    $content = file_get_contents($feed_url);
    $x = new SimpleXmlElement($content);
    $items = array();
     
    foreach($x->channel->item as $entry) {
		$items[] = array(
			'source' => $feed_url,
			'link' => (string)$entry->link, 
			'title' => (string)$entry->title,
			'image' => (string)$entry->image,
			'pubDate' => (string)$entry->pubDate,
			'description' => (string)$entry->description[0]
		);
    }
	return $items;
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