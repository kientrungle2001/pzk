<?php  $item = $data->getFLSN(); ?>
<?php $datacontent = @explode('=====',$item[content]);
 ?>
	<h2 class="text-center"><?php echo @$item['title']?></h2>
	<p class="text-justify"><?php echo @$item['brief']?></p>
	<p class="text-justify"><?=$datacontent[0];?></p>

