<?php

$form = $data->getFormObject();
$form->setLabel($data->getLabel());
$form->setFieldSettings($data->getFieldSettings());
$form->setActions($data->getactions());
$form->setAction('/Admin_' . $data->getModule(). '/addPost');
$form->setBackHref(pzk_or(pzk_request()->getBackHref(), '/Admin_' . $data->getModule(). '/index'));
$form->setBackLabel('Cancel');
if(pzk_request()->getBackHref()) {
	$form->setAction('/Admin_' . $data->getModule(). '/addPost?backHref='. urlencode(pzk_request()->getBackHref()));
}
$form->display();
?>
<?php if( strpos(pzk_request()->getController(), 'document') !== false ):?>
<script>
jQuery(window).bind(
    "beforeunload", 
    function() { 
        var ok = confirm("Do you really want to close?");
		if(ok) {
			return true;
		}
		jQuery('body').show();
		setTimeout(function(){
			jQuery('body').show();
		}, 100);
		return false;
    }
);
jQuery('form').submit(function() {
    jQuery(window).unbind("beforeunload");
});
</script>
<?php endif; ?>