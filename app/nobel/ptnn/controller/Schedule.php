<?php 
class PzkScheduleController extends PzkController 
{
	public $masterPage='index';
	public $masterPosition='left';
	
	public function facebookAction() {
		require_once(BASE_DIR.'/3rdparty/Facebook/autoload.php');
  		$fb = new Facebook\Facebook([
		  'app_id' => '1552342791689162',
		  'app_secret' => 'c5496ab5545b2eee110a17c4c114e526',
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
		$loginUrl = $helper->getLoginUrl('http://ptnn.vn/schedule/fblogin', $permissions);

		echo '<a href="' . $loginUrl . '">Log in with Facebook!</a>';
	}
	
	public function fbloginAction() {
		require_once(BASE_DIR.'/3rdparty/Facebook/autoload.php');
		$fb = new Facebook\Facebook([
		  'app_id' => '1552342791689162',
		  'app_secret' => 'c5496ab5545b2eee110a17c4c114e526',
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
		//echo '<h3>Access Token</h3>';
		//var_dump($accessToken->getValue());

		// The OAuth 2.0 client handler helps us manage access tokens
		$oAuth2Client = $fb->getOAuth2Client();

		// Get the access token metadata from /debug_token
		$tokenMetadata = $oAuth2Client->debugToken($accessToken);
		//echo '<h3>Metadata</h3>';
		//var_dump($tokenMetadata);

		// Validation (these will throw FacebookSDKException's when they fail)
		$tokenMetadata->validateAppId('1552342791689162');
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

		  //echo '<h3>Long-lived</h3>';
		  //var_dump($accessToken->getValue());
		}

		$_SESSION['fb_access_token'] = (string) $accessToken;
		// insert table social_account
		$token=$_SESSION['fb_access_token'];
		$datetime= date("Y-m-d H:i:s");
		$acc=_db()->getTableEntity('social_account');
		$acc->loadWhere(array('tokenId',$token));
		if(! $acc->getId()){
			$row= array('appId'=>2,'type'=>'facebook','tokenId'=>$token,'name'=>'','status'=>1,'created'=>$datetime);
			$acc->setData($row);
			$acc->save();
		}
		
		// User is logged in with a long-lived access token.
		// You can redirect them to a members-only page.
		//header('Location: https://example.com/members.php');
	}
	
	public function fbpostAction() {
		//echo $_SESSION['fb_access_token'];die();
		//Lấy dữ liệu từ schedule_social
		$datetime= date("Y-m-d H:i:s");
		$schedules = _db()
				->select('social_schedule.*, social_account.tokenId, social_app.appId, social_app.appSecret')
				->from('social_schedule')
					->join('social_account', 'social_schedule.accountId = social_account.id','inner')
					->join('social_app', 'social_account.appId = social_app.id','inner')
		//->where(array('published',$datetime))
		->result();
		require_once(BASE_DIR.'/3rdparty/Facebook/autoload.php');
		
		
		//$rssItem = _db()->getTableEntity('rss_feed')->loadWhere(array('posted', 0));
		
		//if(!$rssItem->getId()) return false;
		$new=_db()->getTableEntity('news');
		$acc=_db()->getTableEntity('social_account');
		foreach ($schedules as $schedule) {
			$fb = new Facebook\Facebook([
				'app_id' => $schedule['appId'],
				'app_secret' => $schedule['appSecret'],
				'default_graph_version' => 'v2.2',
			]);
				$tokenId = base64_decode($schedule['tokenId']);
				
				$new->loadWhere(array('id',$schedule['newsId']));
				if($new->getId()){
					$alias= $new->getAlias();
					$brief= $new->getBrief();
					$img= $new->getImg();
				}

				$linkData = [
			  		'link' => 'http://nextnobels.com/'.$alias,
			  		'message' => $brief,
			  		'picture' =>'http://nextnobels.com/'.$img
			  	];
				//$rssItem->update(array('posted' => 1));
			  	
				try {
				  // Returns a `Facebook\FacebookResponse` object
				  $response = $fb->post('/me/feed', $linkData, $tokenId);
				  //$response = $fb->post('/me/feed', $linkData, $tokenId);
				  
				} catch(Facebook\Exceptions\FacebookResponseException $e) {
				  echo 'Graph returned an error: ' . $e->getMessage();
				  exit;
				} catch(Facebook\Exceptions\FacebookSDKException $e) {
				  echo 'Facebook SDK returned an error: ' . $e->getMessage();
				  exit;
				}

				$graphNode = $response->getGraphNode();
				if($graphNode['id']) {
					echo 'Posted with id: ' . $graphNode['id'];
					// insert social_log
					$log= _db()->getTableEntity('social_log');
					$row_log= array('message'=>$linkData['message'], 'scheduleId'=>$schedule['id'], 'created'=>$datetime, 'status'=>1, 'appId'=>$schedule['appId'], 'accountId'=>$acc->getId(), 'newsId'=>$schedule['newsId'], 'postId'=>$graphNode['id']);
					$log->setData($row_log);
					$log->save();
				} else {
					echo 'Error!';
				}
				

			
		}
		
	}
}
 ?>