<?php
$item = $data->getItem();

$form = $data->getFormObject();
$form->set('label', $data->get('label'));
$form->set('fieldSettings', $data->get('fieldSettings'));
$form->set('item', $item);
$form->set('actions',$data->get('actions'));
$form->set('action', '/Admin_' . $data->get('module'). '/editPost');
$form->set('backHref', pzk_or(pzk_request()->get('backHref'), '/Admin_' . $data->get('module'). '/index'));
$form->set('backLabel', 'Cancel');
if(pzk_request()->get('backHref')) {
	$form->set('action', '/Admin_' . $data->get('module'). '/editPost?backHref='. urlencode(pzk_request()->get('backHref')));
}
$form->display();
?>
<?php if( strpos(pzk_request()->get('controller'), 'document') !== false ):?>
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