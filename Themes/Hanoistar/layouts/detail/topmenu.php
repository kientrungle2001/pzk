<?php
	$language = pzk_global()->getLanguage();
	$lang = pzk_session('language');
	$languagevn = pzk_global()->getLanguagevn();
	$check = pzk_session('checkPayment');
	$class = 5;
	if(pzk_session('lop')) {
		$class = pzk_session('lop');	
	}
	
?>
<div class="hidden-xs">
        <ul class="header-menu item">
			 <li class="dropdown colormenu1">
				<a href="/"><i style="font-size: 23px;" class="fa fa-home" aria-hidden="true"></i></a>
			 </li>
			 <!--
			 <li class="dropdown">
				<a class="gt" href="/Home/detail"><?=$language['introduction']?></a>
			 </li>-->
	        <li class="dropdown colormenu2">
	            <a href="/#practice" class="dropdown-toggle  jumping" rel="#A0D4CE" data-class="5" data-jumping="practice" <?php if($lang == 'ev'){
					echo 'title="'.$languagevn['practice'].'"'; }?>><?php echo $language['practice'];?></a>
				<div class="dropdown-menu multi-column columns-3 tab-content">
					<ul class="nav nav-tabs nav-tabs-ct">
						<li class="active" <?php if($lang == 'ev'){
					echo 'title="'.$languagevn['practice'].'"'; }?>><a data-toggle="tab" href="#home"><?php echo $language['practice'];?></a></li>
					</ul> 
				   <div class="row tab-pane fade in active text-center pding10" id="home">
						<?php  $items = $data->getSubjectByClass($class); ?>	
						<?php foreach($items as $item): ?>
							<div class="col-md-2 col-xs-3 top10 height80 width20 btn-menu bgcl choicesubject" onclick="return false;" data-class="5"  data-alias="<?php echo @$item['alias']?>" data-subject="<?php echo @$item['id']?>" <?php if($lang == 'ev'){
							echo 'title="'.$item['name_vn'].'"'; }?>>
								<a href=""><img src="<?=BASE_SKIN_URL?><?php echo @$item['img']?>" class="img-thumnail wheight50"/></a>
								<p class="text-uppercase robotofont weight10">
								<?php 
								if(pzk_user_special()) { echo '#' . $item['id']; }
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
			
			<?php 
				$i=1;
					
				?>
			
			
			<li class="dropdown colormenu4 tab-content">
	            <a href="/#test" class="dropdown-toggle fsize" data-class="<?php echo pzk_session('lop') ?>" data-jumping="test" rel="#E0C7A3" <?php if($lang == 'ev'){
					echo 'title="'.$languagevn['weekend-title'].'"'; }?>>Đề khảo sát theo định kì</a>
	            <div class="dropdown-menu multi-column columns-3 tab-content">
					
					<div class="row tab-pane fade in active text-center pding10" id="menu23">
					   <div id="myCarousel1" class="carousel col-md-11" style="margin-left:20px;" data-ride="carousel">

						  <!-- Wrapper for slides -->
						  <div class="carousel-inner" role="listbox">
							<div class="item active">
							
							  
							</div>
							
						  </div>

						 
						</div>
		            </div>
	            </div>
	        </li>
			
			<?php 
				$i=1;
					
				?>
			
			
			<li class="dropdown colormenu3 tab-content">
	            <a href="/#test" class="dropdown-toggle fsize" data-class="<?php echo pzk_session('lop') ?>" data-jumping="test" rel="#E0C7A3" <?php if($lang == 'ev'){
					echo 'title="'.$languagevn['weekend-title'].'"'; }?>>Đề thi trực tuyến</a>
	            <div class="dropdown-menu multi-column columns-3 tab-content">
					
					<div class="row tab-pane fade in active text-center pding10" id="menu23">
					   <div id="myCarousel1" class="carousel col-md-11" style="margin-left:20px;" data-ride="carousel">

						  <!-- Wrapper for slides -->
						  <div class="carousel-inner" role="listbox">
							<div class="item active">
							<?php
								$classroomIds = pzk_user()->getClassroomIds();

								$items = $data->getMonthTest($class, $classroomIds);
							?>
							<?php foreach($items as $item): ?>
							
							<div class="col-md-2 col-xs-3 top10 height80 btn-menu bgcl choicetestmonth"> 
								<a href="/Compability/test/<?php echo $class ?>/<?php echo @$item['id']?>">
								<img src="<?=BASE_SKIN_URL?>/Default/skin/nobel/Themes/Story/media/hinh<?php echo $i;?>.png" class="img-thumnail wheight50" />
								</a>
								<a href="/Compability/test/<?php echo $class ?>/<?php echo @$item['id']?>">
								<p class="text-uppercase white robotofont weight10 top10">
								<?php 
								if(pzk_user_special()) { echo '#' . $item['id']; }
								if ($lang == 'en' || $lang == 'ev' ){
									echo $item['name_en'];
								}else{
									echo $item['name'];
								} ?></p>
								</a>
							</div>
							<?php $i++; ?>
							<?php endforeach; ?>
							  
							</div>
							
						  </div>

						 
						</div>
		            </div>
	            </div>
	        </li>
			
			
			
			<li class="dropdown colormenu5 ">
	            <a style="font-family: cadena;" href="/tuvan">Tư vấn</a>
	            
	        </li>
	      
			
			 <li class="dropdown">
				<a class="hd" href="/huong-dan-su-dung-song-ngu"><?=$language['guide']?></a>
			 </li>
        </ul>

    <style>	
		.nowrap{white-space: nowrap;}
    </style>
</div>


<div class="container top10 visible-xs ">
	<div class="row">
		<div class="menu-mb text-center nowrap">
			<a href="/Home" <?php if($lang == 'ev'){
			echo 'title="'.$languagevn['home'].'"'; }?>><div class="circle">
			<div class="circle" style="background: #7f003f;"><i class="glyphicon glyphicon-home check"></i></div>						
			</div><span class="m-font"><?php echo $language['home'];?></span></a>
		</div>
		<div class="menu-mb text-center nowrap">		
			<a data-toggle="tab" class="visible-xs jumping" data-jumping="practice" href="#practice" <?php if($lang == 'ev'){
			echo 'title="'.$languagevn['practice'].'"'; }?>><div class="circle" style="background: #ffcc00">
				<i class="glyphicon glyphicon-tree-conifer check"></i>
			</div><span class="m-font"><?php echo $language['practice'];?></span></a>	
		</div>
		<div class="menu-mb text-center nowrap">
			<a data-toggle="tab" class="visible-xs jumping" data-jumping="practice-test" href="#practice-test" <?php if($lang == 'ev'){
			echo 'title="'.$languagevn['general-title'].'"'; }?>><div class="circle" style="background: #44b771;">
				<i class="glyphicon glyphicon-send check"></i>
			</div><span class="m-font"><?php echo $language['general'];?></span></a>
		</div>
		<div class="menu-mb text-center nowrap" >
			<a data-toggle="tab" class="visible-xs jumping" data-jumping="test" href="/#test" <?php if($lang == 'ev'){
			echo 'title="'.$languagevn['weekend-title'].'"'; }?>><div class="circle" style="background: #db3fdb;">
				<i class="glyphicon glyphicon-star check"></i>
			</div><span class="m-font"><?php echo $language['weekend'];?></span></a>		
		</div>
		
		<div class="menu-mb text-center nowrap">
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
			$("#test-section .btn-menu").css("background-color", '#E0C7A3');
		});
		$(".ajaxchangepractice").load(BASE_REQUEST + "/home/showpracticenumber?class="+numberclass, function() {
			$("#practice-test-section .btn-menu").css("background-color", '#B6D452');
		});	
		$("#practice-section .btn-menu").css("background-color", '#A0D4CE');
	});
	
	
	$(".choicesubject").click(function(){
		<?php if(pzk_session('userId')): ?>
		var numbersubject = $(this).data("subject");
		var subclass = $(this).data("class");
		var alias = $(this).data("alias");
		window.location = BASE_REQUEST+'/practice/class-'+subclass+'/subject-'+alias+'-'+numbersubject;
		<?php else: ?>
			var state = confirm("<?php echo $language['login'];?>");
			if(state == true){
				$("#LoginModal").modal();
			}
		<?php endif; ?>
	});
	$(".choicepractice").click(function(){
		<?php if(pzk_session('userId')){ ?>
			var check = '<?php echo $check ?>';
			var trial = $(this).data("trial");
			if(check == 1){
				var week = $(this).data("week");
				var numclass = $(this).data("class");
				var test = $(this).data("test");
				window.location = BASE_REQUEST+'/practice-examination/class-5/week-'+week+'/examination-'+test;
			}else{
				if(trial == 1){
					var week = $(this).data("week");
					var numclass = $(this).data("class");
					var test = $(this).data("test");
					window.location = BASE_REQUEST+'/practice-examination/class-5/week-'+week+'/examination-'+test;
				}else{
					alert('Bạn cần mua tài khoản để sử dụng nội dung này !');
					return false;
				}
			}
		<?php } else { ?>
			var state = confirm("<?php echo $language['login'];?>");
				if(state == true){
					$("#LoginModal").modal();
				}
		<?php } ?>	
	});
	$(".choicetestmonth").click(function(){
		<?php if(!pzk_session('userId')){ ?>
			var state = confirm("<?php echo $language['login'];?>");
				if(state == true){
					$("#LoginModal").modal();
				}
			return false;	
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
			var state = confirm("<?php echo $language['login'];?>");
			if(state == true){
				$("#LoginModal").modal();
			}
		<?php endif; ?>
	});
	$(".othertest").click(function(){
		<?php if(pzk_session('userId')): ?>
		var subclass = $(this).data("class");
		window.location = BASE_REQUEST+'/test/class-'+subclass;
		<?php else: ?>
			var state = confirm("<?php echo $language['login'];?>");
			if(state == true){
				$("#LoginModal").modal();
			}
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
