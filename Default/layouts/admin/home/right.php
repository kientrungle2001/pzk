<?php if(count($data->getChildren())):
$setting 	= pzk_controller();
if($setting->get('menuLinks') && count($setting->get('menuLinks'))):
pzk_global()->set('admin_right_module', 1);
?>
<div class="col-md-2">
	<?php $data->displayChildren('all') ?>
</div>
<?php endif; ?>
<?php endif; ?>