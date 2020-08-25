<p class="lead"><?php echo @$data->getTitle()?></p>
<div class="list-group">
	<?php $data->displayChildren('all') ?>
</div>