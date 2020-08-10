<?php
$language = pzk_global()->get('language');
$lang = pzk_session('language');
$check = pzk_session('checkPayment');
$class = 5;
if(pzk_session('lop')) {
	$class = pzk_session('lop');	
}
?>
<?php  $items = $data->getTest($class); ?>
<?php foreach($items as $item): ?>
<div class="col-md-2 text-center col-xs-4 text-uppercase btn-custom3 pd-10 weight-16 widthfix testnumber<?php if(@$item['isNew']): echo ' isNew'; endif;?>" onclick ="return false;" data-week="<?php echo @$item['id']?>" data-trial="<?php echo @$item['trial']?>" <?php if($lang == 'ev'){
					echo 'title="'.$item['name'].'"'; }?>>
	<a href="" class="text-color">
	<?php 
	if ($lang == 'en' || $lang == 'ev'){
		echo $item['name_en'];
	}else{
		echo $item['name'];
	} ?>
	</a>
</div>
<?php endforeach; ?>
<div class="col-md-2 text-center col-xs-4 text-uppercase btn-custom3 pd-10 weight-16 widthfix other2" onclick ="return false;">
	<a href="" class="text-color"><?php if(!$items){ echo "Đang cập nhật!";}else{ echo "...";} ?></a>
</div>

<script>
$(".testnumber").click(function(){
	<?php if(pzk_session('userId')): ?>
		var week = $(this).data("week");
		window.location = BASE_REQUEST+'/test/class-<?php echo $class ?>/week-'+week;
	<?php else: ?>
		alert('<?php echo $language['login'];?>');
	<?php endif; ?>
});
$(".other2").click(function(){
	<?php if(pzk_session('userId')): ?>
		window.location = BASE_REQUEST+'/test/class-<?php echo $class ?>';
	<?php else: ?>
		alert('<?php echo $language['login'];?>');
	<?php endif; ?>
		
});
</script>