<?php
$jeasyuiJsFile = pzk_or(pzk_config('plugin_jeasyui_js_src'), '/3rdparty/easyui/jquery.easyui.min.js');
$jeasyuiCssFile = pzk_or(pzk_config('plugin_jeasyui_css_src'), '/3rdparty/easyui/Themes/default/easyui.css');
?>
<script src="<?php echo $jeasyuiJsFile ?>" type="text/javascript"></script>
<link rel="stylesheet" type="text/css" href="<?php echo $jeasyuiCssFile ?>" />
<link rel="stylesheet" type="text/css" href="/3rdparty/easyui/Themes/icon.css">