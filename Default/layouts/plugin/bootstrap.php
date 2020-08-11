<?php
$bootstrapJsFile = pzk_or(pzk_config('plugin_bootstrap_js_src'), '/3rdparty/bootstrap3/js/bootstrap.min.js');
$bootstrapCssFile = pzk_or(pzk_config('plugin_bootstrap_css_src'), '/3rdparty/bootstrap3/css/bootstrap.min.css');
$bootstrapThemeFile = pzk_or(pzk_config('plugin_bootstrap_theme_src'), '/3rdparty/bootstrap3/css/bootstrap-theme.min.css');
?>
<link rel="stylesheet" type="text/css" href="<?php echo $bootstrapCssFile ?>"/>
<script src="<?php echo $bootstrapJsFile ?>" type="text/javascript"></script>
<?php if(@$data->theme):?><link rel="stylesheet" type="text/css" href="<?php echo $bootstrapThemeFile ?>"/><?php endif; ?>

