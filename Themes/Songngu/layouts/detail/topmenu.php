<?php
	$language = pzk_global()->getLanguage();
	$lang = pzk_session('language');
	$languagevn = pzk_global()->getLanguagevn();
	$check = pzk_session('checkPayment');
?>
<nav class="nav navbar container nomg hidden-xs" role="navigation" style="margin-top:-50px;">
    <div style='padding-right: 0px;' class="navbar-collapse" id="bs-example-navbar-collapse-1">
        <ul class="nav nav-justified">
	        <li class="dropdown bdr">
	            <a href="#" class="dropdown-toggle fsize jumping" rel="#A0D4CE" data-class="5" data-jumping="practice" <?php if($lang == 'ev'){
					echo 'title="'.$languagevn['practice'].'"'; }?>><?php echo $language['practice'];?></a>
				<div class="dropdown-menu multi-column columns-3 tab-content">
					<ul class="nav nav-tabs nav-tabs-ct">
						<li class="active" <?php if($lang == 'ev'){
					echo 'title="'.$languagevn['practice'].'"'; }?>><a data-toggle="tab" href="#home"><?php echo $language['practice'];?></a></li>
					</ul> 
				   <div class="row tab-pane fade in active text-center pding10" id="home">
						<?php  $items = $data->getSubject(); ?>	
						<?php foreach($items as $item): ?>
							<div class="col-md-2 col-xs-3 top10 height80 width20 btn-custom3 bgcl choicesubject" onclick="return false;" data-class="5"  data-alias="<?php echo @$item['alias']?>" data-subject="<?php echo @$item['id']?>" <?php if($lang == 'ev'){
							echo 'title="'.$item['name_vn'].'"'; }?>>
								<a href=""><img src="<?=BASE_SKIN_URL?><?php echo @$item['img']?>" class="img-thumnail wheight50"/></a>
								<p class="text-uppercase robotofont weight10">
								<?php 
								if ($lang == 'en' || $lang == 'ev'){ 
									echo $item['name_en'];
								}else{ 
									echo $item['name_vn'];
								}
								 ?>
								</p>
							</div>
						<?php endforeach; ?>
		            </div>
	            </div>
	        </li>
			<li class="dropdown bdr2 tab-content">
	            <a href="#" class="dropdown-toggle fsize jumping" data-class="5" data-jumping="practice-test" rel="#B6D452" <?php if($lang == 'ev'){
					echo 'title="'.$languagevn['general-title'].'"'; }?>><?php echo $language['general'];?></a>
	            <div class="dropdown-menu multi-column columns-3 tab-content">
					<ul class="nav nav-tabs nav-tabs-ct1">
						<li class="active" <?php if($lang == 'ev'){
					echo 'title="'.$languagevn['general-title'].'"'; }?>><a data-toggle="tab" href="#menu12"><?php echo $language['general'];?></a></li>
						<li <?php if($lang == 'ev'){
					echo 'title="'.$languagevn['rating'].'"'; }?>><a href="/Home/rating?practice=1&clearTestId=1"><?php echo $language['rating'];?></a></li>
					</ul> 
					<div class="row tab-pane fade in active text-center pding10" id="menu12">
			            <?php 
						 $i=9;
						 $class=5;
						 $dem = 0;
						 ?>
						<?php  $items = $data->getWeekPractice(ROOT_WEEK_CATEGORY_ID); ?>				
						<?php foreach($items as $item): ?>
						
						<div class="col-md-2 col-xs-3 top10 height80 width20 btn-custom3 bgcl choicepractice" onclick="return false;" data-trial="<?php echo @$item['trial']?>" data-week="<?php echo @$item['id']?>" data-class="5" <?php if($lang == 'ev'){
						echo 'title="'.$item['name'].'"'; }?>>
							<a href=""><img src="<?=BASE_SKIN_URL?>/Default/skin/nobel/Themes/Story/media/de<?php echo $i;?>.png" class="img-thumnail wheight50"></a>
							<p class="text-uppercase robotofont weight10 top10"><?php 
							if ($lang == 'en' || $lang == 'ev'){
								echo $item['name_en'];
							}else{
								echo $item['name'];
							} ?></p>
						</div>
						<?php $i--;
						if($i==0){
							$i=9;
				
						}
						?>
						<?php endforeach; ?>
						<div class="col-md-2 col-xs-3 top10 height80 width20 btn-custom3 bgcl otherpractice" onclick="return false;" data-class="5" <?php if($lang == 'ev'){
						echo 'title="'.$languagevn['other'].'"'; }?>>
							<a href=""><img src="<?=BASE_SKIN_URL?>/Default/skin/nobel/Themes/Story/media/de1.png" class="img-thumnail wheight50" /></a>
							<p class="text-uppercase robotofont weight10 top10"><?php echo $language['other'];?></p>
						</div>
		            </div>
	            </div>
	        </li>
			<li class="dropdown bdr3 tab-content">
	            <a href="#" class="dropdown-toggle fsize jumping" data-class="5" data-jumping="test" rel="#E0C7A3" <?php if($lang == 'ev'){
					echo 'title="'.$languagevn['weekend-title'].'"'; }?>><?php echo $language['weekend'];?></a>
	            <div class="dropdown-menu multi-column columns-3 tab-content">
					<ul class="nav nav-tabs nav-tabs-ct2">
						<li class="active" <?php if($lang == 'ev'){
					echo 'title="'.$languagevn['weekend-title'].'"'; }?>><a data-toggle="tab" href="#menu23"><?php echo $language['weekend'];?></a></li>
						<li <?php if($lang == 'ev'){
					echo 'title="'.$languagevn['rating'].'"'; }?>><a href="/Home/rating?practice=0&clearTestId=1"><?php echo $language['rating'];?></a></li>
					</ul> 
					<div class="row tab-pane fade in active text-center pding10" id="menu23">
			            <?php 
						 $i=9;
						 $class=5;
						 ?>
						<?php  $items = $data->getWeekTest(354); ?>
						<?php foreach($items as $item): ?>
						
						<div class="col-md-2 col-xs-3 top10 height80 width20 btn-custom3 bgcl choicetest" onclick="return false;" data-trial="<?php echo @$item['trial']?>" data-week="<?php echo @$item['id']?>" data-class="5" <?php if($lang == 'ev'){
						echo 'title="'.$item['name'].'"'; }?>>
							<a href=""><img src="<?=BASE_SKIN_URL?>/Default/skin/nobel/Themes/Story/media/hinh<?php echo $i;?>.png" class="img-thumnail wheight50" /></a>
							<p class="text-uppercase robotofont weight10 top10"><?php 
							if ($lang == 'en' || $lang == 'ev' ){
								echo $item['name_en'];
							}else{
								echo $item['name'];
							} ?></p>
						</div>
						<?php $i--;
						if($i==0){
							$i=9;
					
						}
						?>
						<?php endforeach; ?>
						<div class="col-md-2 col-xs-3 top10 height80 width20 btn-custom3 bgcl othertest" onclick="return false;" data-class="5" <?php if($lang == 'ev'){
					echo 'title="'.$languagevn['other'].'"'; }?>>
							<a href=""><img src="<?=BASE_SKIN_URL?>/Default/skin/nobel/Themes/Story/media/hinh1.png" class="img-thumnail wheight50" /></a>
							<p class="text-uppercase robotofont weight10 top10"><?php echo $language['other'];?></p>
						</div>
		            </div>
	            </div>
	        </li>
			<li class="dropdown bdr6 fsize">
	            <a href="/document/home" <?php if($lang == 'ev'){
					echo 'title="'.$languagevn['materials-title'].'"'; }?>><?php echo $language['materials'];?></a>
	            
	        </li> 
			<li class="dropdown bdr4 fsize">
	            <a href="/gift" <?php if($lang == 'ev'){
					echo 'title="'.$languagevn['gift'].'"'; }?>><?php echo $language['gift'];?></a>
	            
	        </li>
	        <li class="dropdown bdr5 fsize">
	            <a href="/game" <?php if($lang == 'ev'){
					echo 'title="'.$languagevn['game'].'"'; }?>><?php echo $language['game'];?></a> 
	        </li>
        </ul>
    </div>
    <!--/.navbar-collapse-->
    <style>	
		.nowrap{white-space: nowrap;}
    </style>
</nav>
<div class="container top10 visible-xs ">
	<div class="row">
		<div class="col-xs-2 text-center nowrap">
			<a href="/home" <?php if($lang == 'ev'){
			echo 'title="'.$languagevn['home'].'"'; }?>><div class="circle">
			<div class="circle" style="background: #7f003f;"><i class="glyphicon glyphicon-home check"></i></div>						
			</div><span class="m-font"><?php echo $language['home'];?></span></a>
		</div>
		<div class="col-xs-2 text-center nowrap">		
			<a data-toggle="tab" class="visible-xs jumping" data-jumping="practice" href="#practice" <?php if($lang == 'ev'){
			echo 'title="'.$languagevn['practice'].'"'; }?>><div class="circle" style="background: #ffcc00">
				<i class="glyphicon glyphicon-tree-conifer check"></i>
			</div><span class="m-font"><?php echo $language['practice'];?></span></a>	
		</div>
		<div class="col-xs-2 text-center nowrap">
			<a data-toggle="tab" class="visible-xs jumping" data-jumping="practice-test" href="#practice-test" <?php if($lang == 'ev'){
			echo 'title="'.$languagevn['general-title'].'"'; }?>><div class="circle" style="background: #44b771;">
				<i class="glyphicon glyphicon-send check"></i>
			</div><span class="m-font"><?php echo $language['general'];?></span></a>
		</div>
		<div class="col-xs-2 text-center nowrap" >
			<a data-toggle="tab" class="visible-xs jumping" data-jumping="test" href="/#test" <?php if($lang == 'ev'){
			echo 'title="'.$languagevn['weekend-title'].'"'; }?>><div class="circle" style="background: #db3fdb;">
				<i class="glyphicon glyphicon-star check"></i>
			</div><span class="m-font"><?php echo $language['weekend'];?></span></a>		
		</div>
		<div class="col-xs-2 text-center nowrap">
			<a href="/gift" <?php if($lang == 'ev'){
			echo 'title="'.$languagevn['gift'].'"'; }?>> <div class="circle" style="background: #d14f4f;"><i class="glyphicon glyphicon-heart check"></i></div><span class="m-font"><?php echo $language['gift'];?></span></a>
		</div>
		<div class="col-xs-2 text-center nowrap">
			<a href="/game" <?php if($lang == 'ev'){
			echo 'title="'.$languagevn['game'].'"'; }?>>
			<div class="circle" style="background: #1e74b3;">
				<i class="glyphicon glyphicon-plane check"></i>
			</div>
				<span class="m-font"><?php echo $language['game'];?></span>
			</a>
		</div>
	</div>
</div>

<script>
	numberclass = 5;
	$(function() {
		$(".ajaxchange").load(BASE_REQUEST + "/home/showtestnumber?class="+numberclass, function() {
			$("#test-section .btn-custom3").css("background-color", '#E0C7A3');
		});
		$(".ajaxchangepractice").load(BASE_REQUEST + "/home/showpracticenumber?class="+numberclass, function() {
			$("#practice-test-section .btn-custom3").css("background-color", '#B6D452');
		});	
		$("#practice-section .btn-custom3").css("background-color", '#A0D4CE');
	});
	
	
	$(".choicesubject").click(function(){
		<?php if(pzk_session('userId')): ?>
		var numbersubject = $(this).data("subject");
		var subclass = $(this).data("class");
		var alias = $(this).data("alias");
		window.location = BASE_REQUEST+'/practice/class-'+subclass+'/subject-'+alias+'-'+numbersubject;
		<?php else: ?>
			alert('<?php echo $language['login'];?>');
		<?php endif; ?>
	});
	$(".choicepractice").click(function(){
		<?php if(pzk_session('userId')){ ?>
		var week = $(this).data("week");
		var numclass = $(this).data("class");
		window.location = BASE_REQUEST+'/practice-examination/class-5/week-'+week;
	<?php } else { ?>
		alert('<?php echo $language['login'];?>');
	<?php } ?>	
	});
	$(".choicetest").click(function(){
		<?php if(pzk_session('userId')){ ?>
		var week = $(this).data("week");
		var numclass = $(this).data("class");
		window.location = BASE_REQUEST+'/test/class-5/week-'+week;
	<?php }else { ?>
		alert('<?php echo $language['login'];?>');
	<?php } ?>
	});
	$(".choicedocument").click(function(){
		var numbersubject = $(this).data("subject");
		var subclass = $(this).data("class");   
		var alias = $(this).data("alias");
		window.location = BASE_REQUEST+'/document/class-'+subclass+'/subject-'+alias+'-'+numbersubject;
	});
	$(".otherpractice").click(function(){
		<?php if(pzk_session('userId')): ?>
		var subclass = $(this).data("class");
		window.location = BASE_REQUEST+'/practice-examination/class-'+subclass;
		<?php else: ?>
			alert('<?php echo $language['login'];?>');
		<?php endif; ?>
	});
	$(".othertest").click(function(){
		<?php if(pzk_session('userId')): ?>
		var subclass = $(this).data("class");
		window.location = BASE_REQUEST+'/test/class-'+subclass;
		<?php else: ?>
			alert('<?php echo $language['login'];?>');
		<?php endif; ?>
	});
	
	
	$(".tailieu").click(function(){
		window.location = BASE_REQUEST+'/document/home';
	});
	$(".quatang").click(function(){
		window.location = BASE_REQUEST+'/gift';
	});
	$(".game").click(function(){
		window.location = BASE_REQUEST+'/game';
	});
	if(window.location.pathname == '/') {
	// neu o trang chu
		// hash
		$('.jumping').click(function() {
			var jumping = $(this).data('jumping');
			window.location.hash = '#' + jumping;
			setTimeout(function() {
				$(window).scrollTop($(window).scrollTop() - 50);
			}, 200);
			return false;
		});
	} else {
	// neu ko o trang chu
		// location
		$('.jumping').click(function() {
			var jumping = $(this).data('jumping');
			window.location = BASE_REQUEST + '/#' + jumping;
			return false;
		});
	}
	
	if(window.location.hash) {
		setTimeout(function() {
			$(window).scrollTop($(window).scrollTop() - 50);
		}, 200);		
	}
</script>
