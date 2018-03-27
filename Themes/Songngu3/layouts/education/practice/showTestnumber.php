<?php
$language = pzk_global()->get('language');
$lang = pzk_session('language');
$check = pzk_session('checkPayment');
$class = 5;
if(pzk_session('lop')) {
	$class = pzk_session('lop');	
}
?>
{? $items = $data->getTest($class); ?}
{each $items as $item}
<?php $firsttest= $data->getFirstTestByWeek($item['id'], 0, $check, $class); ?>
<div class="col-md-2 text-center col-xs-4 text-uppercase box-practice widthfix testnumber<?php if(@$item['isNew']): echo ' isNew'; endif;?>" onclick ="return false;" data-test="{firsttest[id]}" data-week="{item[id]}" data-trial="{item[trial]}" <?php if($lang == 'ev'){
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
<!--div class="col-md-2 text-center col-xs-4 text-uppercase box-practice widthfix other2" onclick ="return false;">
	<a href="" class="text-color"><?php // if(!$items){ echo "Đang cập nhật!";}else{ echo "...";} ?></a>
</div-->

<script>
$(".testnumber").click(function(){
	<?php if(pzk_session('userId')): ?>
		var check = '{check}';
		var trial = $(this).data("trial");
		var week = $(this).data("week");
		var test = $(this).data("test");
		if(check == 1){
			window.location = BASE_REQUEST+'/test/class-{class}/week-'+week+'/examination-'+test;
		}else{
			if(trial == 1){
				window.location = BASE_REQUEST+'/test/class-{class}/week-'+week+'/examination-'+test;
			}else {
				alert('Bạn cần mua tài khoản để sử dụng nội dung này !');
				return false;	
			}
		}
		
	<?php else: ?>
		var state = confirm("<?php echo $language['login'];?>");
		if(state == true){
			$("#LoginModal").modal();
		}
	<?php endif; ?>
});
$(".other2").click(function(){
	<?php if(pzk_session('userId')): ?>
		window.location = BASE_REQUEST+'/test/class-{class}';
	<?php else: ?>
		var state = confirm("<?php echo $language['login'];?>");
		if(state == true){
			$("#LoginModal").modal();
		}
	<?php endif; ?>
		
});
</script>