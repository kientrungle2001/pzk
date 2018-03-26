<?php
$language = pzk_global()->get('language');
$lang = pzk_session('language');
$check = pzk_session('checkPayment');
$class = 5;
if(pzk_session('lop')) {
	$class = pzk_session('lop');	
}
$school = pzk_session('school');
if($school == NS){
	$items = $data->getTestCompability($class, NS);
}else{
	$items = $data->getTestCompability($class);
}

?>

{each $items as $item}
<?php 
$testcheck = pzk_user()->checkCompabilityTestAccess($item['id']);
$donecheck = pzk_user()->checkCompabilityTestDone($item['id']);
?>
<div class="col-md-2 text-center col-xs-4 text-uppercase box-practice widthfix testcompability is_{data.action} <?php if(@$item['isNew']): echo ' isNew'; endif;?>" onclick ="return false;" data-test="{item[id]}" data-startdate="{item[startDate]}" data-enddate="{item[endDate]}" data-check="{testcheck}" data-done="{donecheck}" <?php if($lang == 'ev'){
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

<script>
$(".is_{data.action}").click(function(){
	<?php if(pzk_session('userId')): ?>
		var test = $(this).data("test");
		var check = $(this).data("check");
		var startDate = $(this).data("startdate");
		var endDate = $(this).data("enddate");
		var done = $(this).data("done");
		
		var today = date('Y-m-d H:i:s', serverTime);
		var startDateFormatted = date('H:i:s d/m/Y', (new Date(startDate)).getTime()/1000);
		var endDateFormatted = date('H:i:s d/m/Y', (new Date(endDate)).getTime()/1000);
		
		if(check != '1') {
			// chưa mua
			alert('Bạn cần mua gói thi thì mới làm được đợt thi này');
			return false;
		}
		
		if(startDate > today) {
			alert('Chưa đến thời gian thi. Thời gian thi vào ngày ' + startDateFormatted);
			return false;
		}
		
		/*
		if(today < endDate) {
			alert('Chưa đến ngày công bố kết quả. Đợt thi kết thúc ngày ' + endDateFormatted);
			return false;
		}*/
		
		if(done != '1') {
			alert('Bạn chưa làm bài thi');
			return false;
		}
		
		window.location = BASE_REQUEST+'/Compability/{data.action}/{class}/'+test;
	<?php else: ?>
		var state = confirm("<?php echo $language['login'];?>");
		if(state == true){
			$("#LoginModal").modal();
		}
	<?php endif; ?>
});

</script>