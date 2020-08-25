<?php  
	$category_id 		= 	$data->getCategoryId();
	$check				= 	$data->getCheckPayment();
	$class 				= 	$data->getClass();
	
	$category 			= 	$data->getCategory();
	$topics				= 	$data->getTopicTree();

?>
<style>
.text-wrap {
	white-space: normal !important;
}


</style>
<div class="container">
	<p class="t-weight text-center btn-custom8 mgright textcl">Luyện tập - Lớp <?php echo $class ?></p>
</div>
<h3 class="text-center text-uppercase"><strong><?php echo @$category['name']?></strong></h3>
<div class="container">
	<div class="item">
		<div class="col-xs-12">
			<div class="row">
				<div class="col-xs-12 col-md-10 pull-left mgleft">
					<?php $data->displayChildren('[position=choice]') ?>
					<div class="dropdown col-md-4 col-xs-12 mgleft">
						<button class="btn fix_hover btn-default col-md-12 col-sm-12 col-xs-12 sharp" type="button">
						<span id="chonde" class="fontsize19"> Chọn chủ đề</span>
						<img class="img-responsive imgwh hidden-xs hidden-sm pull-right" src="<?=BASE_SKIN_URL?>/Default/skin/nobel/Themes/Story/media/icon1.png" />
						</button>
						<ul id="topics" class="dropdown-menu col-md-12 col-sm-12 col-xs-12" style="top:34px; max-height:350px; overflow-y: scroll;">
						<?php foreach($topics as $topic): ?>
							<li id="topic-<?php echo @$topic['id']?>"><a class="text-wrap" href="#" onclick="reload_exercises(<?php echo @$topic['id']?>); return false;"><?php echo str_repeat('&nbsp;&nbsp;&nbsp;&nbsp;', $topic['level']); ?><?php if(pzk_user_special()):?>#<?php echo @$topic['id']?> - <?php endif;?><?php echo @$topic['name']?></a></li>
						<?php endforeach; ?>
						</ul>
					</div>	
					<div class="dropdown col-md-3 col-xs-12 mgleft">
						<div class="menu-hover">
							<button id="btn-exercises" class="blink-exercises btn fix_hover btn-default col-md-12 col-sm-12 col-xs-12 sharp" type="button">
								<span id="chonde" class="fontsize19"> Chọn bài</span>
								<img class="img-responsive imgwh hidden-xs hidden-sm pull-right" src="<?=BASE_SKIN_URL?>/Default/skin/nobel/Themes/Story/media/icon1.png" />
							</button>
							<ul id="exercises" class="dropdown-menu col-md-12 col-sm-12 col-xs-12" style="top:34px; max-height:350px; overflow-y: scroll;">
								
							</ul>
						</div>
					</div>
				</div>
				<div class="col-md-2 col-xs-12 bd">
					<div class="item">
						
						<div class="col-md-3 col-xs-4 hidden-xs">
							<img  src="<?=BASE_SKIN_URL?>/Default/skin/nobel/Themes/Story/media/dongho.png"  class=" wh40 img-responsive"/>
						</div>
						<div class="col-md-3 col-xs-4">
							<h4 class="text-center robotofont"><strong>10:00</strong></h4>
						</div>
						
					</div>
				</div>
			</div>
		</div>
		
	</div>
</div>
<div class="container">
	<h2  class="blink-exercises text-center alert alert-warning" role="alert">Chọn chủ đề sau đó chọn bài để bắt đầu làm bài</h2>
</div>
<div class="container">
	<div class="row bot20">
		<div class="col-md-1 col-xs-1"></div>
		<div class="change col-md-10 col-xs-10 bd-div bgclor imgbg">
			
		</div>
		<div class="col-md-1 col-xs-1"></div>
	</div>
</div>

<script>
	
	function reload_exercises(topicId){
		$('#topics li').removeClass('active');
		$('#topic-'+topicId).addClass('active');
		//$('.blink-exercises').addClass('blink');
		//setTimeout(function(){
		//	$('.blink-exercises').removeClass('blink');
		//}, 1000);
		$.ajax({
			url: '/practice/exercises/' + topicId,
			type: 'post',
			data: {
				topicId: topicId,
				class: <?php echo $class ?>,
				check: <?php if($check):?>1<?php else: ?>0<?php endif;?>
			},
			dataType: 'json',
			success: function(resp) {
				var exercises = resp.exercises;
				$('#exercises').html('');
				for(var i = 0; i < exercises; i++) {
					$('#exercises').append('<li><a href="/practice/class-<?php echo $class ?>/subject-<?php echo @$category['alias']?>-<?php echo @$category['id']?>/topic-'+resp.alias+'-'+resp.id+'/examination-'+(i + 1)+'">Bài ' + (i + 1) + '</a></li>');
				}
				$('#exercises').stop(true, true).delay(100).fadeIn(500);
			}
		});
	}
	
	$('.menu-hover').hover(function() {
	  $('#exercises').stop(true, true).delay(200).fadeIn(500);
	}, function() {
	  $('#exercises').stop(true, true).delay(200).fadeOut(500);
	});
	
</script>