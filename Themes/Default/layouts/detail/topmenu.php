<nav class="nav navbar  container nomg" role="navigation">
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
        <ul class="nav nav-justified">
	        <li class="dropdown bdr">
	            <a href="#" class="dropdown-toggle fsize choiceclass" rel="#A0D4CE" data-class="3" onclick="return false;" >Lớp 3</a>
				<ul class="dropdown-menu multi-column columns-3 tab-content">
		        <ul class="nav nav-tabs nav-tabs-ct">
					<li class="active"><a data-toggle="tab" href="#home">Luyện tập</a></li>
					<li><a data-toggle="tab" href="#menu1">Bài luyện tập</a></li>
					<li><a data-toggle="tab" href="#menu2">Đề thi</a></li>
					<li><a data-toggle="tab" href="#menu3">Tài liệu</a></li>
				</ul> 
				   <div class="row tab-pane fade in active text-center pding10" id="home">
						<div class="col-md-2 col-xs-3 top10 height80 width20 btn-custom3 bgcl choicesubject" onclick="return false;" data-class="3" data-subject="52">
							<a href=""><img src="<?=BASE_SKIN_URL?>/Default/skin/nobel/Themes/Story/media/khoahoc.png" class="img-thumnail wheight50"/></a>
							<p class="text-uppercase robotofont weight10">science</p>
						</div>
						<div class="col-md-2 col-xs-3 top10 height80 width20 btn-custom3 bgcl choicesubject" onclick="return false;" data-class="3" data-subject="51">
							<a href=""><img src="<?=BASE_SKIN_URL?>/Default/skin/nobel/Themes/Story/media/toan.png" class="img-thumnail wheight50"/></a>
							<p class="text-uppercase robotofont weight10">maths</p>
						</div>
						<div class="col-md-2 col-xs-3 top10 height80 width20 btn-custom3 bgcl choicesubject" onclick="return false;" data-class="3" data-subject="50">
							<a href=""><img src="<?=BASE_SKIN_URL?>/Default/skin/nobel/Themes/Story/media/dialy.png" class="img-thumnail wheight50"/></a>
							<p class="text-uppercase robotofont weight10">geography</p>
						</div>
						<div class="col-md-2 col-xs-3 top10 height80 width20 btn-custom3 bgcl choicesubject" onclick="return false;" data-class="3" data-subject="88">
							<a href=""><img src="<?=BASE_SKIN_URL?>/Default/skin/nobel/Themes/Story/media/kynangquansat.png" class="img-thumnail wheight50"/></a>
							<p class="text-uppercase robotofont weight10">observation skill</p>
						</div>
						<div class="col-md-2 col-xs-3 top10 height80 width20 btn-custom3 bgcl choicesubject" onclick="return false;" data-class="3" data-subject="53">
							<a href=""><img src="<?=BASE_SKIN_URL?>/Default/skin/nobel/Themes/Story/media/lichsu.png" class="img-thumnail wheight50"/></a>
							<p class="text-uppercase robotofont weight10">History</p>
						</div>
						<div class="col-md-2 col-xs-3 top10 height80 width20 btn-custom3 bgcl choicesubject" onclick="return false;" data-class="3" data-subject="164">
							<a href=""><img src="<?=BASE_SKIN_URL?>/Default/skin/nobel/Themes/Story/media/tienganh.png" class="img-thumnail wheight50"/></a>
							<p class="text-uppercase robotofont weight10">English</p>
						</div>
						<div class="col-md-2 col-xs-3 top10 height80 width20 btn-custom3 bgcl choicesubject" onclick="return false;" data-class="3" data-subject="87">
							<a href=""><img src="<?=BASE_SKIN_URL?>/Default/skin/nobel/Themes/Story/media/kynangnghe.png" class="img-thumnail wheight50" /></a>
							<p class="text-uppercase robotofont weight10">listening skill</p>
						</div>
						<div class="col-md-2 col-xs-3 top10 height80 width20 btn-custom3 bgcl choicesubject" onclick="return false;" data-class="3" data-subject="54">
							<a href=""><img src="<?=BASE_SKIN_URL?>/Default/skin/nobel/Themes/Story/media/ngonngu.png" class="img-thumnail wheight50" /></a>
							<p class="text-uppercase robotofont weight10">language communication</p>
							
						</div>
						<div class="col-md-2 col-xs-3 top10 height80 width20 btn-custom3 bgcl choicesubject" onclick="return false;" data-class="3" data-subject="59">
							<a href=""><img src="<?=BASE_SKIN_URL?>/Default/skin/nobel/Themes/Story/media/hieubiet.png" class="img-thumnail wheight50" /></a>
							<p class="text-uppercase robotofont weight10">social understanding</p>
						</div>
						
		            </div>
					<div class="row tab-pane fade text-center pding10" id="menu1">
			            <?php 
						 $i=9;
						 $class=3;
						 ?>
						<?php  $items = $data->getPractice($class); ?>
						<?php foreach($items as $item): ?>
						
						<div class="col-md-2 col-xs-3 top10 height80 width20 btn-custom3 bgcl choicepractice" onclick="return false;" data-number="<?php echo @$item['id']?>" data-class="3">
							<a href=""><img src="<?=BASE_SKIN_URL?>/Default/skin/nobel/Themes/Story/media/de<?php echo $i;?>.png" class="img-thumnail wheight50" /></a>
							<p class="text-uppercase robotofont weight10 top10"><?php echo @$item['name']?></p>
						</div>
						<?php $i--;
						if($i==0){
							$i=9;
						}
						?>
						<?php endforeach; ?>
						<div class="col-md-2 col-xs-3 top10 height80 width20 btn-custom3 bgcl otherpractice" onclick="return false;" data-class="3">
							<a href=""><img src="<?=BASE_SKIN_URL?>/Default/skin/nobel/Themes/Story/media/de1.png" class="img-thumnail wheight50" /></a>
							<p class="text-uppercase robotofont weight10 top10">Làm bài khác</p>
						</div>
		            </div>
					<div class="row tab-pane fade text-center pding10" id="menu2">
			             <?php 
						 $i=9;
						 $class=3;
						 ?>
						<?php  $items = $data->getTest($class); ?>
						<?php foreach($items as $item): ?>
						<div class="col-md-2 col-xs-3 top10 height80 width20 btn-custom3 bgcl choicetest" onclick="return false;" data-number="<?php echo @$item['id']?>" data-class="3">
							<a href=""><img src="<?=BASE_SKIN_URL?>/Default/skin/nobel/Themes/Story/media/hinh<?php echo $i;?>.png" class="img-thumnail wheight50" /></a>
							<p class="text-uppercase robotofont weight10 top10"><?php echo @$item['name']?></p>
						</div>
						<?php $i--;
						if($i==0){
							$i=9;
						}
						?>
						<?php endforeach; ?>
						<div class="col-md-2 col-xs-3 top10 height80 width20 btn-custom3 bgcl othertest" onclick="return false;" data-class="3">
							<a href=""><img src="<?=BASE_SKIN_URL?>/Default/skin/nobel/Themes/Story/media/hinh1.png" class="img-thumnail wheight50" /></a>
							<p class="text-uppercase robotofont weight10 top10">Làm đề khác</p>
						</div>
		            </div>
					<div class="row tab-pane fade in text-center pding10" id="menu3">
						<div class="col-md-2 col-xs-3 top10 height80 width20 btn-custom3 bgcl choicedocument" onclick="return false;" data-class="3" data-subject="52">
							<a href=""><img src="<?=BASE_SKIN_URL?>/Default/skin/nobel/Themes/Story/media/khoahoc.png" class="img-thumnail wheight50"/></a>
							<p class="text-uppercase robotofont weight10">science</p>
						</div>
						<div class="col-md-2 col-xs-3 top10 height80 width20 btn-custom3 bgcl choicedocument" onclick="return false;" data-class="3" data-subject="51">
							<a href=""><img src="<?=BASE_SKIN_URL?>/Default/skin/nobel/Themes/Story/media/toan.png" class="img-thumnail wheight50"/></a>
							<p class="text-uppercase robotofont weight10">maths</p>
						</div>
						<div class="col-md-2 col-xs-3 top10 height80 width20 btn-custom3 bgcl choicedocument" onclick="return false;" data-class="3" data-subject="50">
							<a href=""><img src="<?=BASE_SKIN_URL?>/Default/skin/nobel/Themes/Story/media/dialy.png" class="img-thumnail wheight50"/></a>
							<p class="text-uppercase robotofont weight10">geography</p>
						</div>
						<div class="col-md-2 col-xs-3 top10 height80 width20 btn-custom3 bgcl choicedocument" onclick="return false;" data-class="3" data-subject="88">
							<a href=""><img src="<?=BASE_SKIN_URL?>/Default/skin/nobel/Themes/Story/media/kynangquansat.png" class="img-thumnail wheight50"/></a>
							<p class="text-uppercase robotofont weight10">observation skill</p>
						</div>
						<div class="col-md-2 col-xs-3 top10 height80 width20 btn-custom3 bgcl choicedocument" onclick="return false;" data-class="3" data-subject="53">
							<a href=""><img src="<?=BASE_SKIN_URL?>/Default/skin/nobel/Themes/Story/media/lichsu.png" class="img-thumnail wheight50"/></a>
							<p class="text-uppercase robotofont weight10">History</p>
						</div>
						<div class="col-md-2 col-xs-3 top10 height80 width20 btn-custom3 bgcl choicedocument" onclick="return false;" data-class="3" data-subject="160">
							<a href=""><img src="<?=BASE_SKIN_URL?>/Default/skin/nobel/Themes/Story/media/tienganh.png" class="img-thumnail wheight50"/></a>
							<p class="text-uppercase robotofont weight10">English</p>
						</div>
						<div class="col-md-2 col-xs-3 top10 height80 width20 btn-custom3 bgcl choicedocument" onclick="return false;" data-class="3" data-subject="87">
							<a href=""><img src="<?=BASE_SKIN_URL?>/Default/skin/nobel/Themes/Story/media/kynangnghe.png" class="img-thumnail wheight50" /></a>
							<p class="text-uppercase robotofont weight10">listening skill</p>
						</div>
						<div class="col-md-2 col-xs-3 top10 height80 width20 btn-custom3 bgcl choicedocument" onclick="return false;" data-class="3" data-subject="54">
							<a href=""><img src="<?=BASE_SKIN_URL?>/Default/skin/nobel/Themes/Story/media/ngonngu.png" class="img-thumnail wheight50" /></a>
							<p class="text-uppercase robotofont weight10">language communication</p>
							
						</div>
						<div class="col-md-2 col-xs-3 top10 height80 width20 btn-custom3 bgcl choicedocument" onclick="return false;" data-class="3" data-subject="59">
							<a href=""><img src="<?=BASE_SKIN_URL?>/Default/skin/nobel/Themes/Story/media/hieubiet.png" class="img-thumnail wheight50" /></a>
							<p class="text-uppercase robotofont weight10">social understanding</p>
						</div>
						
		            </div>
	            </ul>
	        </li>
			<li class="dropdown bdr2 tab-content">
	            <a href="#" class="dropdown-toggle fsize choiceclass" data-class="4" rel="#B6D452" onclick="return false;">Lớp 4</a>
	            <ul class="dropdown-menu multi-column columns-3 tab-content">
		        <ul class="nav nav-tabs nav-tabs-ct1">
					<li class="active"><a data-toggle="tab" href="#home2">Luyện tập</a></li>
					<li><a data-toggle="tab" href="#menu12">Đề luyện tập</a></li>
					<li><a data-toggle="tab" href="#menu22">Đề thi</a></li>
					<li><a data-toggle="tab" href="#menu32">Tài liệu</a></li>
				</ul> 
				   <div class="row tab-pane fade in active text-center pding10" id="home2">
						<div class="col-md-2 col-xs-3 top10 height80 width20 btn-custom3 bgcl choicesubject" onclick="return false;" data-class="4" data-subject="52">
							<a href=""><img src="<?=BASE_SKIN_URL?>/Default/skin/nobel/Themes/Story/media/khoahoc.png" class="img-thumnail wheight50"/></a>
							<p class="text-uppercase robotofont weight10">science</p>
						</div>
						<div class="col-md-2 col-xs-3 top10 height80 width20 btn-custom3 bgcl choicesubject" onclick="return false;" data-class="4" data-subject="51">
							<a href=""><img src="<?=BASE_SKIN_URL?>/Default/skin/nobel/Themes/Story/media/toan.png" class="img-thumnail wheight50"/></a>
							<p class="text-uppercase robotofont weight10">maths</p>
						</div>
						<div class="col-md-2 col-xs-3 top10 height80 width20 btn-custom3 bgcl choicesubject" onclick="return false;" data-class="4" data-subject="50">
							<a href=""><img src="<?=BASE_SKIN_URL?>/Default/skin/nobel/Themes/Story/media/dialy.png" class="img-thumnail wheight50"/></a>
							<p class="text-uppercase robotofont weight10">geography</p>
						</div>
						<div class="col-md-2 col-xs-3 top10 height80 width20 btn-custom3 bgcl choicesubject" onclick="return false;" data-class="4" data-subject="88">
							<a href=""><img src="<?=BASE_SKIN_URL?>/Default/skin/nobel/Themes/Story/media/kynangquansat.png" class="img-thumnail wheight50"/></a>
							<p class="text-uppercase robotofont weight10">observation skill</p>
						</div>
						<div class="col-md-2 col-xs-3 top10 height80 width20 btn-custom3 bgcl choicesubject" onclick="return false;" data-class="4" data-subject="53">
							<a href=""><img src="<?=BASE_SKIN_URL?>/Default/skin/nobel/Themes/Story/media/lichsu.png" class="img-thumnail wheight50"/></a>
							<p class="text-uppercase robotofont weight10">History</p>
						</div>
						<div class="col-md-2 col-xs-3 top10 height80 width20 btn-custom3 bgcl choicesubject" onclick="return false;" data-class="4" data-subject="160">
							<a href=""><img src="<?=BASE_SKIN_URL?>/Default/skin/nobel/Themes/Story/media/tienganh.png" class="img-thumnail wheight50"/></a>
							<p class="text-uppercase robotofont weight10">English</p>
						</div>
						<div class="col-md-2 col-xs-3 top10 height80 width20 btn-custom3 bgcl choicesubject" onclick="return false;" data-class="4" data-subject="87">
							<a href=""><img src="<?=BASE_SKIN_URL?>/Default/skin/nobel/Themes/Story/media/kynangnghe.png" class="img-thumnail wheight50" /></a>
							<p class="text-uppercase robotofont weight10">listening skill</p>
						</div>
						<div class="col-md-2 col-xs-3 top10 height80 width20 btn-custom3 bgcl choicesubject" onclick="return false;" data-class="4" data-subject="54">
							<a href=""><img src="<?=BASE_SKIN_URL?>/Default/skin/nobel/Themes/Story/media/ngonngu.png" class="img-thumnail wheight50" /></a>
							<p class="text-uppercase robotofont weight10">language communication</p>
							
						</div>
						<div class="col-md-2 col-xs-3 top10 height80 width20 btn-custom3 bgcl choicesubject" onclick="return false;" data-class="4" data-subject="59">
							<a href=""><img src="<?=BASE_SKIN_URL?>/Default/skin/nobel/Themes/Story/media/hieubiet.png" class="img-thumnail wheight50" /></a>
							<p class="text-uppercase robotofont weight10">social understanding</p>
						</div>
		            </div>
					<div class="row tab-pane fade text-center pding10" id="menu12">
			            <?php 
						 $i=9;
						 $class=4;
						 ?>
						<?php  $items = $data->getPractice($class); ?>
						<?php foreach($items as $item): ?>
						
						<div class="col-md-2 col-xs-3 top10 height80 width20 btn-custom3 bgcl choicepractice" onclick="return false;" data-number="<?php echo @$item['id']?>" data-class="4">
							<a href=""><img src="<?=BASE_SKIN_URL?>/Default/skin/nobel/Themes/Story/media/de<?php echo $i;?>.png" class="img-thumnail wheight50"></a>
							<p class="text-uppercase robotofont weight10 top10"><?php echo @$item['name']?></p>
						</div>
						<?php $i--;
						if($i==0){
							$i=9;
						}
						?>
						<?php endforeach; ?>
						<div class="col-md-2 col-xs-3 top10 height80 width20 btn-custom3 bgcl otherpractice" onclick="return false;" data-class="4">
							<a href=""><img src="<?=BASE_SKIN_URL?>/Default/skin/nobel/Themes/Story/media/de1.png" class="img-thumnail wheight50" /></a>
							<p class="text-uppercase robotofont weight10 top10">Làm bài khác</p>
						</div>
		            </div>
					<div class="row tab-pane fade text-center pding10" id="menu22">
			            <?php 
						 $i=9;
						 $class=4;
						 ?>
						<?php  $items = $data->getTest($class); ?>
						<?php foreach($items as $item): ?>
						<div class="col-md-2 col-xs-3 top10 height80 width20 btn-custom3 bgcl choicetest" onclick="return false;" data-number="<?php echo @$item['id']?>" data-class="4">
							<a href=""><img src="<?=BASE_SKIN_URL?>/Default/skin/nobel/Themes/Story/media/hinh<?php echo $i;?>.png" class="img-thumnail wheight50" /></a>
							<p class="text-uppercase robotofont weight10 top10"><?php echo @$item['name']?></p>
						</div>
						<?php $i--;
						if($i==0){
							$i=9;
						}
						?>
						<?php endforeach; ?>
						<div class="col-md-2 col-xs-3 top10 height80 width20 btn-custom3 bgcl othertest" onclick="return false;" data-class="4">
							<a href=""><img src="<?=BASE_SKIN_URL?>/Default/skin/nobel/Themes/Story/media/hinh1.png" class="img-thumnail wheight50" /></a>
							<p class="text-uppercase robotofont weight10 top10">Làm đề khác</p>
						</div>
		            </div>
					<div class="row tab-pane fade in text-center pding10" id="menu32">
						<div class="col-md-2 col-xs-3 top10 height80 width20 btn-custom3 bgcl choicedocument" onclick="return false;" data-class="4" data-subject="52">
							<a href=""><img src="<?=BASE_SKIN_URL?>/Default/skin/nobel/Themes/Story/media/khoahoc.png" class="img-thumnail wheight50"/></a>
							<p class="text-uppercase robotofont weight10">science</p>
						</div>
						<div class="col-md-2 col-xs-3 top10 height80 width20 btn-custom3 bgcl choicedocument" onclick="return false;" data-class="4" data-subject="51">
							<a href=""><img src="<?=BASE_SKIN_URL?>/Default/skin/nobel/Themes/Story/media/toan.png" class="img-thumnail wheight50"/></a>
							<p class="text-uppercase robotofont weight10">maths</p>
						</div>
						<div class="col-md-2 col-xs-3 top10 height80 width20 btn-custom3 bgcl choicedocument" onclick="return false;" data-class="4" data-subject="50">
							<a href=""><img src="<?=BASE_SKIN_URL?>/Default/skin/nobel/Themes/Story/media/dialy.png" class="img-thumnail wheight50"/></a>
							<p class="text-uppercase robotofont weight10">geography</p>
						</div>
						<div class="col-md-2 col-xs-3 top10 height80 width20 btn-custom3 bgcl choicedocument" onclick="return false;" data-class="4" data-subject="88">
							<a href=""><img src="<?=BASE_SKIN_URL?>/Default/skin/nobel/Themes/Story/media/kynangquansat.png" class="img-thumnail wheight50"/></a>
							<p class="text-uppercase robotofont weight10">observation skill</p>
						</div>
						<div class="col-md-2 col-xs-3 top10 height80 width20 btn-custom3 bgcl choicedocument" onclick="return false;" data-class="4" data-subject="53">
							<a href=""><img src="<?=BASE_SKIN_URL?>/Default/skin/nobel/Themes/Story/media/lichsu.png" class="img-thumnail wheight50"/></a>
							<p class="text-uppercase robotofont weight10">History</p>
						</div>
						<div class="col-md-2 col-xs-3 top10 height80 width20 btn-custom3 bgcl choicedocument" onclick="return false;" data-class="4" data-subject="160">
							<a href=""><img src="<?=BASE_SKIN_URL?>/Default/skin/nobel/Themes/Story/media/tienganh.png" class="img-thumnail wheight50"/></a>
							<p class="text-uppercase robotofont weight10">English</p>
						</div>
						<div class="col-md-2 col-xs-3 top10 height80 width20 btn-custom3 bgcl choicedocument" onclick="return false;" data-class="4" data-subject="87">
							<a href=""><img src="<?=BASE_SKIN_URL?>/Default/skin/nobel/Themes/Story/media/kynangnghe.png" class="img-thumnail wheight50" /></a>
							<p class="text-uppercase robotofont weight10">listening skill</p>
						</div>
						<div class="col-md-2 col-xs-3 top10 height80 width20 btn-custom3 bgcl choicedocument" onclick="return false;" data-class="4" data-subject="54">
							<a href=""><img src="<?=BASE_SKIN_URL?>/Default/skin/nobel/Themes/Story/media/ngonngu.png" class="img-thumnail wheight50" /></a>
							<p class="text-uppercase robotofont weight10">language communication</p>
							
						</div>
						<div class="col-md-2 col-xs-3 top10 height80 width20 btn-custom3 bgcl choicedocument" onclick="return false;" data-class="4" data-subject="59">
							<a href=""><img src="<?=BASE_SKIN_URL?>/Default/skin/nobel/Themes/Story/media/hieubiet.png" class="img-thumnail wheight50" /></a>
							<p class="text-uppercase robotofont weight10">social understanding</p>
						</div>
						
		            </div>
	            </ul>
	        </li>
			<li class="dropdown bdr3 tab-content">
	            <a href="#" class="dropdown-toggle fsize choiceclass" data-class="5" rel="#E0C7A3" onclick="return false;">Lớp 5</a>
	            <ul class="dropdown-menu multi-column columns-3 tab-content">
		        <ul class="nav nav-tabs nav-tabs-ct2">
					<li class="active"><a data-toggle="tab" href="#home3">Luyện tập</a></li>
					<li><a data-toggle="tab" href="#menu13">Đề luyện tập</a></li>
					<li><a data-toggle="tab" href="#menu23">Đề thi</a></li>
					<li><a data-toggle="tab" href="#menu33">Tài liệu</a></li>
				</ul> 
				   <div class="row tab-pane fade in active text-center pding10" id="home3">
						<div class="col-md-2 col-xs-3 top10 height80 width20 btn-custom3 bgcl choicesubject" onclick="return false;" data-class="5" data-subject="52">
							<a href=""><img src="<?=BASE_SKIN_URL?>/Default/skin/nobel/Themes/Story/media/khoahoc.png" class="img-thumnail wheight50"/></a>
							<p class="text-uppercase robotofont weight10">science</p>
						</div>
						<div class="col-md-2 col-xs-3 top10 height80 width20 btn-custom3 bgcl choicesubject" onclick="return false;" data-class="5" data-subject="51">
							<a href=""><img src="<?=BASE_SKIN_URL?>/Default/skin/nobel/Themes/Story/media/toan.png" class="img-thumnail wheight50"/></a>
							<p class="text-uppercase robotofont weight10">maths</p>
						</div>
						<div class="col-md-2 col-xs-3 top10 height80 width20 btn-custom3 bgcl choicesubject" onclick="return false;" data-class="5" data-subject="50">
							<a href=""><img src="<?=BASE_SKIN_URL?>/Default/skin/nobel/Themes/Story/media/dialy.png" class="img-thumnail wheight50"/></a>
							<p class="text-uppercase robotofont weight10">geography</p>
						</div>
						<div class="col-md-2 col-xs-3 top10 height80 width20 btn-custom3 bgcl choicesubject" onclick="return false;" data-class="5" data-subject="88">
							<a href=""><img src="<?=BASE_SKIN_URL?>/Default/skin/nobel/Themes/Story/media/kynangquansat.png" class="img-thumnail wheight50"/></a>
							<p class="text-uppercase robotofont weight10">observation skill</p>
						</div>
						<div class="col-md-2 col-xs-3 top10 height80 width20 btn-custom3 bgcl choicesubject" onclick="return false;" data-class="5" data-subject="53">
							<a href=""><img src="<?=BASE_SKIN_URL?>/Default/skin/nobel/Themes/Story/media/lichsu.png" class="img-thumnail wheight50"/></a>
							<p class="text-uppercase robotofont weight10">History</p>
						</div>
						<div class="col-md-2 col-xs-3 top10 height80 width20 btn-custom3 bgcl choicesubject" onclick="return false;" data-class="5" data-subject="160">
							<a href=""><img src="<?=BASE_SKIN_URL?>/Default/skin/nobel/Themes/Story/media/tienganh.png" class="img-thumnail wheight50"/></a>
							<p class="text-uppercase robotofont weight10">English</p>
						</div>
						<div class="col-md-2 col-xs-3 top10 height80 width20 btn-custom3 bgcl choicesubject" onclick="return false;" data-class="5" data-subject="87">
							<a href=""><img src="<?=BASE_SKIN_URL?>/Default/skin/nobel/Themes/Story/media/kynangnghe.png" class="img-thumnail wheight50" /></a>
							<p class="text-uppercase robotofont weight10">listening skill</p>
						</div>
						<div class="col-md-2 col-xs-3 top10 height80 width20 btn-custom3 bgcl choicesubject" onclick="return false;" data-class="5" data-subject="54">
							<a href=""><img src="<?=BASE_SKIN_URL?>/Default/skin/nobel/Themes/Story/media/ngonngu.png" class="img-thumnail wheight50" /></a>
							<p class="text-uppercase robotofont weight10">language communication</p>
							
						</div>
						<div class="col-md-2 col-xs-3 top10 height80 width20 btn-custom3 bgcl choicesubject" onclick="return false;" data-class="5" data-subject="59">
							<a href=""><img src="<?=BASE_SKIN_URL?>/Default/skin/nobel/Themes/Story/media/hieubiet.png" class="img-thumnail wheight50" /></a>
							<p class="text-uppercase robotofont weight10">social understanding</p>
						</div>
		            </div>
					<div class="row tab-pane fade text-center pding10" id="menu13">
			            <?php 
						 $i=9;
						 $class=5;
						 ?>
						<?php  $items = $data->getPractice($class); ?>
						<?php foreach($items as $item): ?>
						
						<div class="col-md-2 col-xs-3 top10 height80 width20 btn-custom3 bgcl choicepractice" onclick="return false;" data-number="<?php echo @$item['id']?>" data-class="5">
							<a href=""><img src="<?=BASE_SKIN_URL?>/Default/skin/nobel/Themes/Story/media/de<?php echo $i;?>.png" class="img-thumnail wheight50" /></a>
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
					<div class="row tab-pane fade text-center pding10" id="menu23">
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
					<div class="row tab-pane fade in text-center pding10" id="menu33">
						<div class="col-md-2 col-xs-3 top10 height80 width20 btn-custom3 bgcl choicedocument" onclick="return false;" data-class="5" data-subject="52">
							<a href=""><img src="<?=BASE_SKIN_URL?>/Default/skin/nobel/Themes/Story/media/khoahoc.png" class="img-thumnail wheight50"/></a>
							<p class="text-uppercase robotofont weight10">science</p>
						</div>
						<div class="col-md-2 col-xs-3 top10 height80 width20 btn-custom3 bgcl choicedocument" onclick="return false;" data-class="5" data-subject="51">
							<a href=""><img src="<?=BASE_SKIN_URL?>/Default/skin/nobel/Themes/Story/media/toan.png" class="img-thumnail wheight50"/></a>
							<p class="text-uppercase robotofont weight10">maths</p>
						</div>
						<div class="col-md-2 col-xs-3 top10 height80 width20 btn-custom3 bgcl choicedocument" onclick="return false;" data-class="5" data-subject="50">
							<a href=""><img src="<?=BASE_SKIN_URL?>/Default/skin/nobel/Themes/Story/media/dialy.png" class="img-thumnail wheight50"/></a>
							<p class="text-uppercase robotofont weight10">geography</p>
						</div>
						<div class="col-md-2 col-xs-3 top10 height80 width20 btn-custom3 bgcl choicedocument" onclick="return false;" data-class="5" data-subject="88">
							<a href=""><img src="<?=BASE_SKIN_URL?>/Default/skin/nobel/Themes/Story/media/kynangquansat.png" class="img-thumnail wheight50"/></a>
							<p class="text-uppercase robotofont weight10">observation skill</p>
						</div>
						<div class="col-md-2 col-xs-3 top10 height80 width20 btn-custom3 bgcl choicedocument" onclick="return false;" data-class="5" data-subject="53">
							<a href=""><img src="<?=BASE_SKIN_URL?>/Default/skin/nobel/Themes/Story/media/lichsu.png" class="img-thumnail wheight50"/></a>
							<p class="text-uppercase robotofont weight10">History</p>
						</div>
						<div class="col-md-2 col-xs-3 top10 height80 width20 btn-custom3 bgcl choicedocument" onclick="return false;" data-class="5" data-subject="160">
							<a href=""><img src="<?=BASE_SKIN_URL?>/Default/skin/nobel/Themes/Story/media/tienganh.png" class="img-thumnail wheight50"/></a>
							<p class="text-uppercase robotofont weight10">English</p>
						</div>
						<div class="col-md-2 col-xs-3 top10 height80 width20 btn-custom3 bgcl choicedocument" onclick="return false;" data-class="5" data-subject="87">
							<a href=""><img src="<?=BASE_SKIN_URL?>/Default/skin/nobel/Themes/Story/media/kynangnghe.png" class="img-thumnail wheight50" /></a>
							<p class="text-uppercase robotofont weight10">listening skill</p>
						</div>
						<div class="col-md-2 col-xs-3 top10 height80 width20 btn-custom3 bgcl choicedocument" onclick="return false;" data-class="5" data-subject="54">
							<a href=""><img src="<?=BASE_SKIN_URL?>/Default/skin/nobel/Themes/Story/media/ngonngu.png" class="img-thumnail wheight50" /></a>
							<p class="text-uppercase robotofont weight10">language communication</p>
							
						</div>
						<div class="col-md-2 col-xs-3 top10 height80 width20 btn-custom3 bgcl choicedocument" onclick="return false;" data-class="5" data-subject="59">
							<a href=""><img src="<?=BASE_SKIN_URL?>/Default/skin/nobel/Themes/Story/media/hieubiet.png" class="img-thumnail wheight50" /></a>
							<p class="text-uppercase robotofont weight10">social understanding</p>
						</div>
						
		            </div>
	            </ul>
	        </li>
			<li class="dropdown bdr4 fsize">
	            <a href="#" onclick="return false;" class="dropdown-toggle menuquatang" data-toggle="dropdown">Quà tặng</a>
	            
	        </li>
	        <li class="dropdown bdr5 fsize">
	            <a href="#" class="dropdown-toggle" data-toggle="dropdown">Game</a>
	            
	        </li>
        </ul>
    </div>
    <!--/.navbar-collapse-->
</nav>