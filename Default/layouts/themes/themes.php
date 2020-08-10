<?php $themes = $data->getThemes(); 
?>

<?php foreach($themes as $theme): ?>
	<?php if(file_exists(BASE_DIR . '/Themes/'.$theme['name'] . '/skin/css/style.css')): ?>
		<link rel="stylesheet" type="text/css" property="stylesheet" href="/Themes/<?php echo @$theme['name']?>/skin/css/style.css" />
	<?php elseif(file_exists(BASE_DIR . '/default/skin/' . pzk_request()->getAppPath() . '/Themes/'.$theme['name'] . '/css/style.css')) : ?>
		<link rel="stylesheet" type="text/css" property="stylesheet" href="/default/skin/<?php echo pzk_request()->getAppPath(); ?>/Themes/<?php echo @$theme['name']?>/css/style.css" />
	<?php endif; ?>
	<?php if(file_exists(BASE_DIR . '/Themes/'.$theme['name'] . '/skin/js/main.js')): ?>
		<script type="text/javascript" src="/Themes/<?php echo @$theme['name']?>/skin/js/main.js"></script>
	<?php elseif(file_exists(BASE_DIR . '/default/skin/' . pzk_request()->getAppPath() . '/Themes/'.$theme['name'] . '/js/main.js')) : ?>
		<script type="text/javascript" src="/default/skin/<?php echo pzk_request()->getAppPath(); ?>/Themes/<?php echo @$theme['name']?>/js/main.js"></script>
	<?php endif; ?>
<?php endforeach; ?>