<?php  $src = $data->src;
$link = $data->getLink();
?>
<?php if($link): ?><a href="<?php echo $link ?>"><?php endif; ?>
<img id="<?php echo @$data->id?>" class="<?php echo @$data->class?>" src="<?php echo @$data->src?>" style="width: <?php echo @$data->width?>; height: <?php echo @$data->height?>; <?php echo @$data->style?>" />
<?php if($link): ?></a><?php endif; ?>