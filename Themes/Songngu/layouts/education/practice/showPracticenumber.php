<?php
$language = pzk_global()->get('language');
$lang = pzk_session('language');
$class = 5;
if(pzk_session('lop')) {
	$class = pzk_session('lop');	
}
?>
{? $items = $data->getPractice($class); ?}
{each $items as $item}
<div class="col-md-2 text-center col-xs-4 text-uppercase btn-custom3 pd-10 weight-16 widthfix practicenumber<?php if(@$item['isNew']): echo ' isNew'; endif;?>" onclick ="return false;" data-week="{item[id]}" data-trial="{item[trial]}" <?php if($lang == 'ev'){
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
{/each}

<div class="col-md-2 text-center col-xs-4 text-uppercase btn-custom3 pd-10 weight-16 widthfix other" onclick ="return false;">
	<a href="" class="text-color"><?php if(!$items){ echo "Đang cập nhật!";}else{ echo "...";} ?></a>
</div>

<script>
$(".practicenumber").click(function(){
	<?php if(pzk_session('userId')): ?>
		var week = $(this).data("week");
		window.location = BASE_REQUEST+'/practice-examination/class-{class}/week-'+week;
	<?php else: ?>
		alert('<?php echo $language['login'];?>');
	<?php endif; ?>
});
$(".other").click(function(){
	<?php if(pzk_session('userId')): ?>
		window.location = BASE_REQUEST+'/practice-examination/class-{class}';
	<?php else: ?>
		alert('<?php echo $language['login'];?>');
	<?php endif; ?>
});
</script>