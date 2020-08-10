<style>
	.cl-thi{
		color: #ce3d4c;
	}
</style>
<?php
$language = pzk_global()->get('language');
$lang = pzk_session('language');
$check = pzk_session('checkPayment');
$userId 	= pzk_session('userId');
/*$class = 5;
if(pzk_session('lop')) {
	$class = pzk_session('lop');	
}
$school = pzk_session('school');
if($school == NS){
	$items = $data->getTestCompability($class, NS);
}else{
}
*/	
$items = $data->getAllTestCompability();

$i = 1;
?>

<?php foreach($items as $item): ?>
<?php 
$testcheck = pzk_user()->checkCompabilityTestAccess($item['id']);
?>
<div class="col-md-3 col-xs-12" >
					
					
<div class="panel panel-default">
	<div style="background-color: #fff3e2; border: none;" class="panel-heading relative text-center">
		<img src="/Themes/Ams/skin/images/topcup.png" class="w100p" />
		<h3 style="bottom: 16%; left: 43%; font-size: 14px; color: white;" class="text-uppercase absolute">
			
			<?php 
			if ($lang == 'en' || $lang == 'ev'){
				echo $item['name_en'];
			}else{
				echo $item['name'];
			} ?>
				
					
		</h3>
	</div>
	<div style="background-color: #fff3e2;" class="panel-body">
		<p>Ngày thi: <span class="cl-thi"><?=date('d/m', strtotime($item['startDate'])); ?></span></p>
		<p>Ngày kết thúc: <span class="cl-thi"><?=date('d/m', strtotime($item['endDate'])); ?></span></p>
		<p>Ngày xem kết quả: <span class="cl-thi"><?=date('d/m', strtotime($item['resultDate'])); ?></span></p>
		
		<div class="btn-group btn-group-justified">
			<a class="btn btn-success" href="/Compability/dsthi/<?=$item['id']?>">Danh sách thi</a>
			<?php if($testcheck){ ?>
				
			<?php } else { ?>
				<?php if(time() < strtotime($item['endDate'])){ ?>
					<a class="btn btn-danger" href="/Home/payment">Nộp lệ phí thi</a>
				<?php } ?>
			<?php } ?>
		</div>
		<div class="btn-group btn-group-justified" style="margin-top: 15px;">
		<?php if(time() > strtotime($item['resultDate'])) { ?>
			<a class="btn btn-danger" href="/Compability/result/<?=$item['id']?>">Kết quả</a>
			<a class="btn btn-info" href="/Compability/rank/<?=$item['id']?>">Xếp hạng</a>
		<?php } ?>
		</div>

	</div>
	
	<div class="panel-footer" style="padding: 0;">
		<div class="text-uppercase text-center text-bold">
			<?php if(time() < strtotime($item['startDate'])){ ?>
			<div class="btn btn-info btn-block" style="margin: 0;border-radius: 0;">
			Chưa đến thời gian thi
			</div>
			<?php } elseif(time() > strtotime($item['startDate']) && time() < strtotime($item['endDate'])){ ?>
			<a href="/Compability/test/<?=$item['id']?>">
			<div class="btn btn-primary btn-block"  style="margin: 0;border-radius: 0;">
			Vào thi	
			</div>
			</a>
			<?php } elseif(time() > strtotime($item['endDate']) && time() < strtotime($item['resultDate'])){ ?>
			<div class="btn btn-warning btn-block" style="margin: 0;border-radius: 0;">
			Đã kết thúc thi, chờ chấm
			</div>
			<?php } else { ?>
			<div class="btn btn-danger btn-block" style="margin: 0;border-radius: 0;">
			Đã có kết quả thi
			</div>
			<?php } ?>
		</div>
	</div>
	
</div>					
	
	
	
</div>
<?php $i++; ?>
<?php endforeach; ?>

<script>
$(".is_<?php echo @$data->action?>").click(function(){
	<?php if(pzk_session('userId')): ?>
		var test = $(this).data("test");
		var check = $(this).data("check");
		var startDate = $(this).data("startdate");
		var endDate = $(this).data("enddate");
		
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
		if(today > endDate) {
			alert('Đã quá thời gian thi. Thời gian thi kết thúc ngày ' + endDateFormatted);
			return false;
		}
		
		window.location = BASE_REQUEST+'/Compability/<?php echo @$data->action?>/'+test;
	<?php else: ?>
		var state = confirm("<?php echo $language['login'];?>");
		if(state == true){
			$("#LoginModal").modal();
		}
	<?php endif; ?>
});

</script>