<?php
$language = pzk_global()->getLanguage();
$lang = pzk_session('language');
$check = pzk_session('checkPayment');
$class = 5;
$pageSize = 15;
if(pzk_session('lop')) {
	$class = pzk_session('lop');	
}
?>
<style>
	.head-box{border-radius: 5px 5px 0px 0px; color: white;font-size: 30px; font-family: 'cadena'; padding: 8px 5px;}
	.bg-white{background: white; border-radius: 5px; box-shadow: 0px 5px 2px #8cbcda;}
	.vang{background: #f6e73f;}
	.xanh{background: #13a4e1;}
	.xanh img{width: 40px; margin-bottom: 2px;}
	.link-box{font-size: 20px; padding: 10px 5px;font-family: 'cadena';}
	.box-body{padding-top: 20px; padding-bottom: 30px;}
	.mgb-100{margin-bottom: 100px;}
	.pagecompability{margin-top: 30px;}
	.pagecompability .active{background: #ff0167;}
	.pagecompability .page{font-size: 20px; padding: 10px 25px; margin-right: 15px; font-family: 'cadena'; border: none;}
</style>

<div class="item" id="resultBox">
<?php  $items = $data->getTests($class, 1410, 0, $pageSize); ?>

<?php foreach($items as $item): ?>
<?php $tests= $data->getTestByWeek($item['id'], 0, $check, $class); 
$pattern = '/(\(.+\))/i';
$replacement = ''; 
?>
	<div class="col-md-4 col-xs-12">
		<div class="bg-white">
			<h2 class="text-center xanh head-box"><img src="/Themes/Songngu3/skin/images/nguyetque.png" /> &nbsp;
			<?php
				
				if ($lang == 'en' || $lang == 'ev'){
					$tam = explode('-', $item['name_en']);
					echo $tam[0];
				}else{
					$tam = explode('-', $item['name']);
					echo $tam[0];
				}
				 
			?>
			</h2>
			<div class="box-body">
				<?php $i =1;?>
				<?php foreach($tests as $test): ?>
					<div class="text-uppercase link-box testnumber text-center" onclick ="testnumber(this);return false;" data-test="<?php echo @$test['id']?>" data-week="<?php echo @$item['id']?>" data-trial="<?php echo @$item['trial']?>" <?php if($lang == 'ev'){
										echo 'title="'.$test['name'].'"'; }?>>
						<a href="" class="text-color">
						<?php 
						if ($lang == 'en' || $lang == 'ev'){
							echo 'Combination '.$i.': '.preg_replace($pattern, $replacement, $test['name_en']);
						}else{
							echo 'Tổ Hợp '.$i.': '.preg_replace($pattern, $replacement, $test['name']);
						} ?>
						</a>
					</div>
					<?php ?>
					<?php $i++; ?>	
				<?php endforeach; ?>
			</div>	
		</div>
	</div>

<?php endforeach; ?>
</div>
<?php 
	$totalPage = $data->countTests($class, 1410);
	
	$page = ceil($totalPage / $pageSize);
	if($page > 1){
		echo '<div class="text-center item pagecompability">';
		for($i = 0; $i < $page; $i++){
			$j = $i + 1;
			$active = '';
			if($i==0){ $active = 'active'; }
			echo '<div onclick="xemthem(this, '.$i.','.$class.')" class="btn btn-large page pointer '.$active.' btn-primary">'.$j.'</div>';
		}
		echo '</div>';
	}	
	
?>

<script>
function xemthem(that, page, lop){
	
	$('.page').removeClass('active');
	$(that).addClass('active');
	
	$.ajax({
	  method: "POST",
	  url: BASE_REQUEST+'/Test/ajaxTest',
	  data: { page: page, lop: lop}
	})
	.done(function( data ) {
		$('#resultBox').html(data);
	});
}
function testnumber(that){
	<?php if(pzk_session('userId')): ?>
		var check = '<?php echo $check ?>';
		var trial = $(that).data("trial");
		var week = $(that).data("week");
		var test = $(that).data("test");
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
			return false;
		}
		
	<?php endif; ?>
	
}
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