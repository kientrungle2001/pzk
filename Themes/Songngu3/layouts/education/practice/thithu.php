<?php
$language = pzk_global()->get('language');
$lang = pzk_session('language');
$check = pzk_session('checkPayment');
$class = 5;
if(pzk_session('lop')) {
	$class = pzk_session('lop');	
}

$deAms = $data->getTestCompabilityBySchool($class, 19568);

$deCaugiay = $data->getTestCompabilityBySchool($class, 19567);
if($deCaugiay){
?>

<div id="testcaugiay" class="container">
	<div class="t-weight text-center textlt mgb15 item">
	Thi thử trực tuyến vào lớp 6</br>
	Trường THCS Cầu Giấy
	</br>
	-----
	</div>
</div>
<div class="container pdb80">
	<div class="row">
		<?php foreach($deCaugiay as $item): ?>

			<div class="col-md-2 text-center col-xs-4 text-uppercase box-practice widthfix testcompability is_<?php echo @$data->action?> <?php if(@$item['isNew']): echo ' isNew'; endif;?>" onclick ="return false;" data-test="<?php echo @$item['id']?>" <?php if($lang == 'ev'){
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
	</div>
</div>
<?php } 
if($deAms){
?>
<div id="testcaugiay" class="container">
	<div class="t-weight text-center textlt mgb15 item">
	Thi thử trực tuyến vào lớp 6</br>
	Trường THCS chuyên Hà Nội Amsterdam
	</br>
	-----
	</div>
</div>
<div class="container pdb80">
	<div class="row">
		<?php foreach($deAms as $item): ?>

			<div class="col-md-2 text-center col-xs-4 text-uppercase box-practice widthfix testcompability is_<?php echo @$data->action?> <?php if(@$item['isNew']): echo ' isNew'; endif;?>" onclick ="return false;" data-test="<?php echo @$item['id']?>" <?php if($lang == 'ev'){
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
	</div>
</div>
<?php } ?>
<script>
$(".is_<?php echo @$data->action?>").click(function(){
	<?php if(pzk_session('userId')): ?>
		var test = $(this).data("test")
		window.location = BASE_REQUEST+'/Compability/<?php echo @$data->action?>/<?php echo $class ?>/'+test;
	<?php else: ?>
		var state = confirm("<?php echo $language['login'];?>");
		if(state == true){
			$("#LoginModal").modal();
		}
	<?php endif; ?>
});

</script>
	