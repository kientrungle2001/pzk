<?php
$timepickerJsFile = pzk_or(pzk_config('plugin_timepicker_js_src'), '/3rdparty/ui/jquery-ui-timepicker-addon.min.js');
$timepickerCssFile = pzk_or(pzk_config('plugin_timepicker_css_src'), '/3rdparty/ui/jquery-ui-timepicker-addon.min.css');
?>
<link rel="stylesheet" type="text/css" href="<?php echo $timepickerCssFile ?>"/>
<script src="<?php echo $timepickerJsFile ?>" type="text/javascript"></script>