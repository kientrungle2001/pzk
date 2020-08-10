<!DOCTYPE html>
<html prefix="og: http://ogp.me/ns# 
				  fb: http://ogp.me/ns/fb# 
				  article: http://ogp.me/ns/article#">
	<head>
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" />
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<title><?php echo $data->title ?></title>
		<link rel="manifest" href="/manifest.json">
		<meta property="og:type"  content="og:article" />
		<meta property="og:image" content="<?php echo BASE_URL?><?php echo $data->img ?>"/> 
		<meta property="og:title" content="<?php echo $data->title ?>"/> 
		<meta property="og:site_name" content="nextnobels.com"/> 
		<meta property="og:url" content="<?php echo BASE_URL?><?php echo $_SERVER['REQUEST_URI']?>"/> 
		<meta property="og:description" content="<?php echo $data->brief ?>" />
		<meta name="keywords" content="<?php echo $data->keywords ?>" />
		<meta name="description" content="<?php echo $data->description ?>" />
		<script type="text/javascript">
		 document.createElement('header');
		 document.createElement('nav');
		 document.createElement('menu');
		 document.createElement('section');
		 document.createElement('article');
		 document.createElement('aside');
		 document.createElement('footer');
		</script>
<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
		<script type="text/javascript">
		BASE_URL = '<?php echo BASE_URL ?>';
		BASE_REQUEST = '<?php echo BASE_REQUEST ?>';
		serverTime = <?php echo $_SERVER['REQUEST_TIME']?>;
		serverMicroTime = <?php echo microtime(true) * 1000?>;
		setInterval(function() {
			serverTime++;
		}, 1000);
		setInterval(function() {
			serverMicroTime++;
		}, 1);
		function getServerTime() {
			return serverTime;
		}
		</script>
		<?php if(COMPILE_MODE && COMPILE_JS_MODE) : ?>
		<script type="text/javascript" src="/default/skin/<?php echo pzk_app()->getPathByName()?>.js?v=<?php echo filemtime(BASE_DIR . '/default/skin/' . pzk_app()->getPathByName() . '.js'); ?>"></script>
		<?php endif;?>
		<?php $data->displayChildren('[id=head]')?>
		<?php
		if(!DEBUG_MODE && strpos(pzk_request()->get('controller'), 'Admin_') === false):
		?>
		<?php if(pzk_request()->isDesktop()):?>
		<script language="JavaScript">
		<!--
		var dictionaries = "ev_ve";
		// -->
		</script>
		<script language="JavaScript1.2" src="http://vndic.net/js/vndic.js" type='text/javascript'></script>
		<?php endif;?>
		<?php if(0): ?>
		<script language="JavaScript" type="text/javascript">
		<!--
		var dictionaries = "eng2vie_vie2eng_foldoc";
		// -->
		</script>
		<script language="JavaScript1.2" src="http://static.vdict.com/js/vdict.js" type='text/javascript'></script>
		<?php endif; ?>
			

		<?php endif; ?>
		
	</head>
	<body>
	<div id="fb-root"></div>
	<?php $data->displayChildren('[id=body]')?>
	
<?php if (count($data->jsInstances)) :?>
	<script type="text/javascript">
	pzk_request = <?php echo json_encode(pzk_request()->getFilterData()); ?>;
	pzk_init(<?php echo json_encode($data->jsInstances) ?>);
	// request permission on page load
	// document.addEventListener('DOMContentLoaded', function () {
	  // if (!Notification) {
		// return;
	  // }

	  // if (Notification.permission !== "granted")
		// Notification.requestPermission();
	// });

	// function notifyMe() {
	  // if (Notification.permission !== "granted")
		// Notification.requestPermission();
	  // else {
		// var notification = new Notification('Cám ơn', {
		  // icon: '/default/skin/nobel/Themes/story/media/logo.png',
		  // body: "Cám ơn bạn đã theo dõi chúng tôi. Chúng tôi sẽ gửi đến bạn những thông tin mới và hữu ích nhất!",
		// });

		// notification.onclick = function () {
		  // window.open("http://test1sn.vn");      
		// };

	  // }

	// }
	
	//notifyMe();
	</script>
<?php endif; ?>

<?php if(defined('DEBUG_MODE') && DEBUG_MODE):?>
	<div class="clear">
	<?php 
		$debugs = _db()->getDebugs();
		foreach($debugs as $index => $debug) {
			echo ($index+1) .'. ' . $debug['query']. '<br />';
			if(DEBUG_LEVEL > 1) {
				echo '<pre>';
				echo nl2br($debug['backtrace']);
				echo '</pre>';	
			}
			
		}
	?>
	</div>
<?php endif;?>
	</body>
</html>