<?php
$language = pzk_global()->getLanguage();
$lang = pzk_session('language');
$check = pzk_session('checkPayment');
$class = 5;
if(pzk_session('lop')) {
	$class = pzk_session('lop');	
}
?>
<?php  $items = $data->getTestsOfWeek($class, 1409, 0, $check); ?>
<?php foreach($items as $firsttest): ?>
<?php 
//$firsttest= $data->getFirstTestByWeek($item['id'], 0, $check, $class);
 ?>
<div class="col-md-2 text-center col-xs-4 text-uppercase box-practice widthfix testnumber" onclick ="return false;" data-test="<?php echo @$firsttest['id']?>" data-week="1409" data-trial="0">
	<a href="" class="text-color">

	<?php echo @$firsttest['name_sn']?>

	</a>
</div>
<?php endforeach; ?>
<!--div class="col-md-2 text-center col-xs-4 text-uppercase box-practice widthfix other2" onclick ="return false;">
	<a href="" class="text-color"><?php // if(!$items){ echo "Đang cập nhật!";}else{ echo "...";} ?></a>
</div-->

<script>
$(".testnumber").click(function(){
	<?php if(pzk_session('userId')): ?>
		var check = '<?php echo $check ?>';
		var trial = $(this).data("trial");
		var week = $(this).data("week");
		var test = $(this).data("test");
		if(check == 1){
			window.location = BASE_REQUEST+'/test/class-<?php echo $class ?>/week-'+week+'/examination-'+test;
		}else{
			if(trial == 1){
				window.location = BASE_REQUEST+'/test/class-<?php echo $class ?>/week-'+week+'/examination-'+test;
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
		window.location = BASE_REQUEST+'/test/class-<?php echo $class ?>';
	<?php else: ?>
		var state = confirm("<?php echo $language['login'];?>");
		if(state == true){
			$("#LoginModal").modal();
		}
	<?php endif; ?>
		
});
</script>