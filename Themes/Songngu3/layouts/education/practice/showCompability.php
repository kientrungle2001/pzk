<?php
$language = pzk_global()->get('language');
$lang = pzk_session('language');
$check = pzk_session('checkPayment');
$class = 5;
if(pzk_session('lop')) {
	$class = pzk_session('lop');	
}
?>
<style>
	.head-box{border-radius: 5px 5px 0px 0px; color: white;font-size: 30px; font-family: 'cadena'; padding: 8px 5px;}
	.bg-white{background: white; border-radius: 5px; box-shadow: 0px 5px 2px #8cbcda;}
	.vang{background: #f6e73f;}
	.xanh{background: #13a4e1;}
	.link-box{font-size: 20px; padding: 10px 5px;font-family: 'cadena';}
	.box-body{padding-top: 20px; padding-bottom: 30px;}
	.mgb-100{margin-bottom: 100px;}
</style>

<div class="item" id="resultBox">
{? $items = $data->getTests($class, 0, 21); ?}
<?php $i =1; $j=1; ?>
{each $items as $item}
<?php $tests= $data->getTestByWeek($item['id'], 0, $check, $class); 
?>
	<div class="col-md-4 col-xs-12">
		<div class="bg-white">
			<h2 class="text-center <?php if($j % 2 == 0){ echo 'vang'; } else { echo 'xanh'; } ?> head-box"><img src="/Themes/Songngu3/skin/images/mu.png" /> &nbsp;{item[name]}</h2>
			<div class="box-body">
				{each $tests as $test}
					<div class="text-uppercase link-box testnumber text-center" onclick ="testnumber(this);return false;" data-test="{test[id]}" data-week="{item[id]}" data-trial="{item[trial]}" <?php if($lang == 'ev'){
										echo 'title="'.$test['name'].'"'; }?>>
						<a href="" class="text-color">
						<?php 
						if ($lang == 'en' || $lang == 'ev'){
							echo $test['name_en'];
						}else{
							echo $test['name'];
						} ?>
						</a>
					</div>
					<?php ?>
				{/each}
			</div>	
		</div>
	</div>
	<?php if($i % 3 == 0){ $j++; } ?>
<?php $i++; ?>	
{/each}
</div>
<div style="margin-top: 30px;" class="text-center item">
<img style="display: none;" onclick="xemthem(0, <?=$class;?>);" class="pointer xemlai" src="/Themes/Songngu3/skin/images/xemlai.png" />
<img onclick="xemthem(1, <?=$class;?>);" class="pointer xemthem" src="/Themes/Songngu3/skin/images/readmore.png" />
</div>
<script>
function xemthem(page, lop){
	if(page == 0){
		$('.xemlai').hide();
		$('.xemthem').show();
	}else{
		$('.xemlai').show();
		$('.xemthem').hide();
	}
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
		var check = '{check}';
		var trial = $(that).data("trial");
		var week = $(that).data("week");
		var test = $(that).data("test");
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
			return false;
		}
		
	<?php endif; ?>
	
}
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