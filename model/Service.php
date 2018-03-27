<?php
class PzkServiceModel {
	public function adfly($url, $key, $uid, $domain = 'j.gs', $advert_type = 'int')
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
	
	public function facebookPost($appId = '416910795159265', 
			$appSecret = '28c5401ea906bb538d773f198ce2b185',
			$version = 'v2.2', $tokenId, $link, $message, $picture) {
		require_once(BASE_DIR.'/3rdparty/Facebook/autoload.php');
		$fb = new Facebook\Facebook([
		  'app_id' => $appId,
		  'app_secret' => $appSecret,
		  'default_graph_version' => $version,
		  ]);
		$linkData = [
		  'link' => $link,
		  'message' => $message,
		  'picture' => $picture
		  ];

		try {
		  // Returns a `Facebook\FacebookResponse` object
		  $response = $fb->post('/me/feed', $linkData, $tokenId);
		} catch(Facebook\Exceptions\FacebookResponseException $e) {
		  return array('message' => 'Graph returned an error: ' . $e->getMessage(), 'success' => false, 'errorNo' => 2);
		} catch(Facebook\Exceptions\FacebookSDKException $e) {
		  return array('message' => 'Facebook SDK returned an error: ' . $e->getMessage(), 'success' => false, 'errorNo' => 2);
		  exit;
		}

		$graphNode = $response->getGraphNode();
		return array('success'	=> true, 'data' => $graphNode['id']);
	}
}