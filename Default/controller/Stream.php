<?php
class PzkStreamController extends PzkController {
	public function videoAction($id, $time, $token, $index) {
		if(time() - $time > 30000) {
			pzk_system()->halt('Time out');
		}
		$file = $id;
		$match = md5(encrypt($file . $time, SECRETKEY));
		if($match !== $token) {
			echo $match. '<br />';
			echo $token. '<br />';
			pzk_system()->halt('Not match token');
		}
		require_once BASE_DIR . '/lib/stream.php';
		$item = _db()->select('*')->fromCategories()->whereId($id)->result_one();
		
		if(file_exists($fileName = BASE_DIR . '/videos/video-' . $item['id'] . '-'.($index ? $index: '0') . '.mp4')) {
			$stream = new VideoStream($fileName);
			$stream->start();
		} else {
			$video = @$item['video'.$index];
			if(!$index) {
				$video = $item['video'];
				$index = 0;
			}
			$video = strval(str_replace("\0", "", $video));
			$video = urldecode($video);
			if(file_exists(BASE_DIR . $video)) {
				$stream = new VideoStream(BASE_DIR . $video);
				$stream->start();
			} else {
				echo $video;
				die('File not found');
			}	
		}
		
		
	}
}