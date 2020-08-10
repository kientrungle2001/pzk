<?php  $items = $data->getItems(); ?>
<?php foreach($items as $item): ?>
<div class="<?php if($item['trial'] == 1){ echo "col-xs-12"; } else { echo "col-md-2 col-xs-4 widthfix"; } ?> text-center text-uppercase btn-custom3 pd-10 weight-16  testnumber">
	<a href="/test/testtl/<?php echo @$item['id']?>" class="text-color"><?php echo @$item['name']?></a>
</div>
<?php endforeach; ?>