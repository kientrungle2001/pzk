<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-63651240-1', 'auto');
  ga('send', 'pageview');

</script>
{children all}
<?php 
$browser = getBrowser();
?>
<?php if($browser['name'] == 'Internet Explorer' && ($browser['version'] == 10 || $browser['version'] == '7.0')) : ?>
	<?php if (file_exists(BASE_DIR . '/default/skin/ie10.css')) : ?>
		<link type="text/css" rel="text/stylesheet" href="/default/skin/ie10.css" />
	<?php endif; ?>
	<?php if (file_exists(BASE_DIR . '/default/skin/'.pzk_app()->getPathByName().'/css/ie10.css')) : ?>
		<link type="text/css" rel="text/stylesheet" href="/default/skin/<?php echo pzk_app()->getPathByName()?>/css/ie10.css" />
	<?php endif; ?>
<?php endif; ?>

<?php if($browser['name'] == 'Internet Explorer' && $browser['version'] == 9) : ?>
	<?php if (file_exists(BASE_DIR . '/default/skin/ie9.css')) : ?>
		<link type="text/css" rel="text/stylesheet" href="/default/skin/ie9.css" />
	<?php endif; ?>
	<?php if (file_exists(BASE_DIR . '/default/skin/'.pzk_app()->getPathByName().'/css/ie9.css')) : ?>
		<link type="text/css" rel="text/stylesheet" href="/default/skin/<?php echo pzk_app()->getPathByName()?>/css/ie9.css" />
	<?php endif; ?>
<?php endif; ?>

<?php if($browser['name'] == 'Internet Explorer' && $browser['version'] == 8) : ?>
	<?php if (file_exists(BASE_DIR . '/default/skin/ie8.css')) : ?>
		<link type="text/css" rel="text/stylesheet" href="/default/skin/ie8.css" />
	<?php endif; ?>
	<?php if (file_exists(BASE_DIR . '/default/skin/'.pzk_app()->getPathByName().'/css/ie8.css')) : ?>
		<link type="text/css" rel="text/stylesheet" href="/default/skin/<?php echo pzk_app()->getPathByName()?>/css/ie8.css" />
	<?php endif; ?>
<?php endif; ?>