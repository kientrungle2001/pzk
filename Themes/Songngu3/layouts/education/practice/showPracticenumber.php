<?php
$language = pzk_global()->get('language');
$lang = pzk_session('language');
$class = 5;
$check = pzk_session('checkPayment');
if(pzk_session('lop')) {
	$class = pzk_session('lop');	
}
?>
<?php  $items = $data->getPractice($class); ?>

<?php foreach($items as $item): ?>
<?php $firsttest= $data->getFirstTestByWeek($item['id'], 1, $check, $class); ?>
<div class="col-md-2 text-center col-xs-4 text-uppercase box-practice widthfix practicenumber<?php if(@$item['isNew']): echo ' isNew'; endif;?>" onclick ="return false;" data-test="<?php echo @$firsttest['id']?>" data-week="<?php echo @$item['id']?>" data-trial="<?php echo @$item['trial']?>" <?php if($lang == 'ev'){
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

<!--div class="col-md-2 text-center col-xs-4 text-uppercase box-practice  widthfix other" onclick ="return false;">
	<a href="" class="text-color"><?php// if(!$items){ echo "Đang cập nhật!";}else{ echo "...";} ?></a>
</div-->

<script>
$(".practicenumber").click(function(){
	<?php if(pzk_session('userId')): ?>
		var check = '<?php echo $check ?>';
		var trial = $(this).data("trial");
		var week = $(this).data("week");
		var test = $(this).data("test");
		if(check == 1){
			window.location = BASE_REQUEST+'/practice-examination/class-<?php echo $class ?>/week-'+week+'/examination-'+test;
		}else{
			if(trial == 1){
				window.location = BASE_REQUEST+'/practice-examination/class-<?php echo $class ?>/week-'+week+'/examination-'+test;
			}else{			
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
$(".other").click(function(){
	<?php if(pzk_session('userId')): ?>
		window.location = BASE_REQUEST+'/practice-examination/class-<?php echo $class ?>';
	<?php else: ?>
		var state = confirm("<?php echo $language['login'];?>");
		if(state == true){
			$("#LoginModal").modal();
		}
	<?php endif; ?>
});
</script>