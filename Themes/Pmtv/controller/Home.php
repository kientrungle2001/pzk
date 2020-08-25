<?php
class PzkHomeController extends PzkController {
	public $masterPage 		= 'index';
	public $masterPosition	= 'left';
	public function indexAction() {
		if(pzk_request()->getSoftwareId() == 101) {
			$this->render('home/kid');
		} else {
			$this->render('home');
		}
		
	}
	
	public function oldAction() {
		$this->render('home');
	}
	
	public function aboutAction() {
		$this->render('about');
	}
	
	public function htmlAction() {
		$this->render('html');
	}
	
	public function kidAction() {
		$this->render('home/kid');
	}
	
	public function categoryvideoAction() {
		set_time_limit(0);
		$videoIndex = 0;
		$categories = _db()->selectAll()->fromCategories()->result();
		foreach($categories as $category) {
			if($videoIndex > 0) break;
			for($i = 0; $i < 7; $i++) {
				if($videoIndex > 0) break;
				if($i == 0) {
					$video = 'video';
				} else {
					$video = 'video'.$i;
				}
				
				if(@$category[$video]) {
					if(file_exists(BASE_DIR . '/videos/video-' . $category['id'] . '-'.$i . '.mp4')) continue;
					$content = file_get_contents(@$category[$video]);
					file_put_contents(BASE_DIR . '/videos/video-' . $category['id'] . '-'.$i . '.mp4', $content);
					$videoIndex++;
					echo @$category['name'] . ' - ' . $i . ' completed<br />';
				}
			}
		}
		echo '<script type="text/javascript">setTimeout(function(){window.location.reload();}, 10000);</script>';
	}
	
	public function downloadAction() {
		$video = 'https://player.vimeo.com/external/198955939.sd.mp4?s=19290ef35f30aea511dcca29ac5442b8bccd0301&profile_id=164';
		$content = file_get_contents($video);
		file_put_contents(BASE_DIR . '/videos/the-nao-la-ke-chuyen.mp4', $content);
		echo 'completed';
	}
	
	public function minhhoanAction() {
		for($i = 100001; $i < 101000; $i++) {
			_db()->query("INSERT INTO `card_nextnobels` (`serviceId`, `pincard`, `price`, `discount`, `serial`, `creatorId`, `created`, `modifiedId`, `modified`, `activedId`, `actived`, `status`, `campaignId`, `quantity`, `promotion`)
VALUES ('7', 'minhhoan123', '5', '', '$i', '1', now(), '1', now(), '', '', '1', '', '1', '0');");
		}
	}
	
	public function renderCodeAction(){
		
		$price = pzk_request('price');
		$languages = pzk_request('languages');
		$time = pzk_request('time');
		$class = pzk_request('class');
		$softwareId =pzk_request('softwareId');
		$siteId = pzk_request('siteId');
		$serial = pzk_request('serial');
		$quantity = pzk_request('quantity');
		$ettyCard = _db()->getEntity('Payment.Card_nextnobels');
		
		for ($i=0; $i < $quantity ; $i++) { 
			$codeId = md5(microtime().SECRETKEY.rand(100,9999))	;
			$codeId = substr($codeId , 0, 8 );
			$md5codeId = $codeId;
			
			$serial = $serial + 1;
			$row = array('pincard' => $md5codeId,
				'price' => $price,
				'serial' => $serial,
				'status'=> 1,
				'languages'=> $languages,
				'time' => $time,
				'class' => $class,
				'software'=> $softwareId,
				'site' => $siteId
			);
			$ettyCard->create($row);
			$File = BASE_DIR.'/3rdparty/thecao/cardpmtv5-50-18-09-2017.txt'; 
					$Handle = fopen($File, 'a');
					$Data = "pincard: ".$codeId." |serial: ".$serial." |languages : ".$languages."|time: ".$time. "|class: ".$class."|software: ".$softwareId."|site: ".$siteId." \r\n";
					fwrite($Handle, $Data); 
					fclose($Handle);
		}
		
	}
}