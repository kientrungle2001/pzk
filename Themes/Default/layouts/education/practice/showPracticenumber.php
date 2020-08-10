<?php  $items = $data->getItems(); ?>
<?php foreach($items as $item): ?>
<div class="col-md-2 text-center col-xs-2 text-uppercase btn-custom3 pd-10 weight-16 widthfix practicenumber<?php if($item['isNew']): echo ' isNew'; endif;?>">
	<a  href="/practice-examination/class-5/examination-<?php echo @$item['id']?>" class="text-color"><?php echo @$item['name']?></a>
</div>
<?php endforeach; ?>
<div class="col-md-2 text-center col-xs-2 text-uppercase btn-custom3 pd-10 weight-16 widthfix other">
	<a href="/practice-examination/class-5" class="text-color">...</a>
</div>