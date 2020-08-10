<nav class="nav navbar container nomg hidden-xs" role="navigation">
    <div class="navbar-collapse" id="bs-example-navbar-collapse-1">
        <ul class="nav nav-justified">
	        <li class="dropdown bdr">
	            <a href="#" class="dropdown-toggle fsize jumping" rel="#A0D4CE" data-class="5" data-jumping="practice" onclick="return false;" >Luyện tập</a>
				<div class="dropdown-menu multi-column columns-3 tab-content">
					<ul class="nav nav-tabs nav-tabs-ct">
						<li class="active"><a data-toggle="tab" href="#home">Luyện tập</a></li>
						<li><a data-toggle="tab" href="#menu3">Tài liệu</a></li>
					</ul> 
				   <div class="row tab-pane fade in active text-center pding10" id="home">
						<?php  $items = $data->getSubject(); ?>
						<?php foreach($items as $item): ?>
						<div class="col-md-2 col-xs-3 top10 height80 width20 btn-custom3 bgcl choicesubject" onclick="return false;" data-class="5"  data-alias="<?php echo @$item['alias']?>" data-subject="<?php echo @$item['id']?>">
							<a href=""><img src="<?=BASE_SKIN_URL?><?php echo @$item['img']?>" class="img-thumnail wheight50"/></a>
							<p class="text-uppercase robotofont weight10"><?php echo @$item['name']?></p>
						</div>
						<?php endforeach; ?>
		            </div>
					<div class="row tab-pane fade in text-center pding10" id="menu3">
						<?php  $items = $data->getSubject(); ?>
						<?php foreach($items as $item): ?>
						<div class="col-md-2 col-xs-3 top10 height80 width20 btn-custom3 bgcl choicedocument" onclick="return false;" data-class="5"  data-alias="<?php echo @$item['alias']?>" data-subject="<?php echo @$item['id']?>">
							<a href=""><img src="<?=BASE_SKIN_URL?><?php echo @$item['img']?>" class="img-thumnail wheight50"/></a>
							<p class="text-uppercase robotofont weight10"><?php echo @$item['name']?></p>
						</div>
						<?php endforeach; ?>
		            </div>
	            </div>
	        </li>
			<li class="dropdown bdr2 tab-content">
	            <a href="#" class="dropdown-toggle fsize jumping" data-class="5" data-jumping="practice-test" rel="#B6D452" onclick="return false;">Đề luyện tập</a>
	            <div class="dropdown-menu multi-column columns-3 tab-content">
					<ul class="nav nav-tabs nav-tabs-ct1">
						<li class="active"><a data-toggle="tab" href="#menu12">Đề luyện tập</a></li>
						<li><a href="/Home/rating?practice=1&clearTestId=1">Xếp hạng</a></li>
					</ul> 
					<div class="row tab-pane fade in active text-center pding10" id="menu12">
			            <?php 
						 $i=9;
						 $class=5;
						 ?>
						<?php  $items = $data->getPractice($class); ?>
						
						<?php foreach($items as $item): ?>
						
						<div class="col-md-2 col-xs-3 top10 height80 width20 btn-custom3 bgcl choicepractice" onclick="return false;" data-number="<?php echo @$item['id']?>" data-class="5">
							<a href=""><img src="<?=BASE_SKIN_URL?>/Default/skin/nobel/Themes/Story/media/de<?php echo $i;?>.png" class="img-thumnail wheight50"></a>
							<p class="text-uppercase robotofont weight10 top10"><?php echo @$item['name']?></p>
						</div>
						<?php $i--;
						if($i==0){
							$i=9;
						}
						?>
						<?php endforeach; ?>
						<div class="col-md-2 col-xs-3 top10 height80 width20 btn-custom3 bgcl otherpractice" onclick="return false;" data-class="5">
							<a href=""><img src="<?=BASE_SKIN_URL?>/Default/skin/nobel/Themes/Story/media/de1.png" class="img-thumnail wheight50" /></a>
							<p class="text-uppercase robotofont weight10 top10">Làm bài khác</p>
						</div>
		            </div>
	            </div>
	        </li>
			<li class="dropdown bdr3 tab-content">
	            <a href="#" class="dropdown-toggle fsize jumping" data-class="5" data-jumping="test" rel="#E0C7A3" onclick="return false;">Đề thi</a>
	            <div class="dropdown-menu multi-column columns-3 tab-content">
					<ul class="nav nav-tabs nav-tabs-ct2">
						<li class="active"><a data-toggle="tab" href="#menu23">Đề thi</a></li>
						<li><a href="/Home/rating?practice=0&clearTestId=1">Xếp hạng</a></li>
					</ul> 
					<div class="row tab-pane fade in active text-center pding10" id="menu23">
			            <?php 
						 $i=9;
						 $class=5;
						 ?>
						<?php  $items = $data->getTest($class); ?>
						<?php foreach($items as $item): ?>
						<div class="col-md-2 col-xs-3 top10 height80 width20 btn-custom3 bgcl choicetest" onclick="return false;" data-number="<?php echo @$item['id']?>" data-class="5">
							<a href=""><img src="<?=BASE_SKIN_URL?>/Default/skin/nobel/Themes/Story/media/hinh<?php echo $i;?>.png" class="img-thumnail wheight50" /></a>
							<p class="text-uppercase robotofont weight10 top10"><?php echo @$item['name']?></p>
						</div>
						<?php $i--;
						if($i==0){
							$i=9;
						}
						?>
						<?php endforeach; ?>
						<div class="col-md-2 col-xs-3 top10 height80 width20 btn-custom3 bgcl othertest" onclick="return false;" data-class="5">
							<a href=""><img src="<?=BASE_SKIN_URL?>/Default/skin/nobel/Themes/Story/media/hinh1.png" class="img-thumnail wheight50" /></a>
							<p class="text-uppercase robotofont weight10 top10">Làm đề khác</p>
						</div>
		            </div>
	            </div>
	        </li>
			<li class="dropdown bdr6 fsize">
	            <a href="/document/home">Kinh nghiệm ôn thi</a>
	            
	        </li> 
			<li class="dropdown bdr4 fsize">
	            <a href="/gift">Quà tặng</a>
	            
	        </li>
	        <li class="dropdown bdr5 fsize">
	            <a href="/game">Game</a> 
	        </li>
        </ul>
    </div>
    <!--/.navbar-collapse-->
</nav>

<div class="container top10 visible-xs " style="padding-top: 50px;">
	<div class="row">
		<div class="col-xs-2 text-center nowrap">
			<a href="/home"><div class="circle">
			<div class="circle"><i class="glyphicon glyphicon-home check"></i></div>						
			</div><span class="m-font">Trang chủ</span></a>
		</div>
		<div class="col-xs-2 text-center nowrap">		
			<a data-toggle="tab" class="visible-xs jumping" data-jumping="practice" href="#practice"><div class="circle">
				<i class="glyphicon glyphicon-tree-conifer check"></i>
			</div><span class="m-font">Luyện tập</span></a>	
		</div>
		<div class="col-xs-2 text-center nowrap">
			<a data-toggle="tab" class="visible-xs jumping" data-jumping="practice-test" href="#practice-test"><div class="circle">
				<i class="glyphicon glyphicon-send check"></i>
			</div><span class="m-font">Đề luyện tập</span></a>
		</div>
		<div class="col-xs-2 text-center nowrap" >
			<a data-toggle="tab" class="visible-xs jumping" data-jumping="test" href="/#test"><div class="circle">
				<i class="glyphicon glyphicon-star check"></i>
			</div><span class="m-font">Đề thi</span></a>		
		</div>
		<div class="col-xs-2 text-center nowrap">
			<a href="/gift"> <div class="circle"><i class="glyphicon glyphicon-heart check"></i></div><span class="m-font">Quà tặng</span></a>
		</div>
		<div class="col-xs-2 text-center nowrap">
			<a href="/game">
			<div class="circle">
				<i class="glyphicon glyphicon-plane check"></i>
			</div>
				<span class="m-font">Game</span>
			</a>
		</div>
	</div>
</div>

<script>
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