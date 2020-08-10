<p class="lead"><?php echo @$data->title?></p>
<div class="list-group">
	<?php $data->displayChildren('all') ?>
</div>