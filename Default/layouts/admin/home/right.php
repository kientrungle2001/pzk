<?php if(count($data->getChildren())):
$setting 	= pzk_controller();
if($setting->getMenuLinks() && count($setting->getMenuLinks())):
pzk_global()->setAdmin_right_module(1);
?>
<div class="col-md-2">
	<?php $data->displayChildren('all') ?>
</div>
<?php endif; ?>
<?php endif; ?>