<div class="container relax top-35">
</div>
<script>
	$(function() {
		var inprogression = false;
		$('#bs-example-navbar-collapse-1 .nav-tabs li a').mouseover(function(){
			if(!inprogression) {
				inprogression = true;
				var that = this;
				setTimeout(function() {
					$(that).click();
					inprogression = false;
				}, 150);
			}
			
		});
	});
</script>
<nav class="nav navbar  container nomg top-35" role="navigation">
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
        <ul class="nav nav-justified">
	        <li class="dropdown bdr">
	            <a href="#" class="dropdown-toggle fsize" data-toggle="dropdown">Lớp 3</a>
				<ul class="dropdown-menu multi-column columns-3 tab-content">
		        <ul class="nav nav-tabs nav-tabs-ct">
					<li class="active"><a data-toggle="tab" href="#home">Luyện tập</a></li>
					<li><a data-toggle="tab" href="#menu1">Đề luyện tập</a></li>
					<li><a data-toggle="tab" href="#menu2">Đề thi thử</a></li>
					<li><a data-toggle="tab" href="#menu3">Tài liệu</a></li>
				</ul> 
				   <div class="row tab-pane fade in active text-center pding10" id="home">
						<div class="col-md-2 col-xs-3 top10 height80 width20 btn-custom3 bgcl">
							<a href=""><img src="<?=BASE_SKIN_URL?>/Default/skin/nobel/Themes/Story/media/khoahoc.png" class="img-thumnail wheight50"/></a>
							<p class="text-uppercase robotofont weight10">science</p>
						</div>
						<div class="col-md-2 col-xs-3 top10 height80 width20 btn-custom3 bgcl">
							<a href=""><img src="<?=BASE_SKIN_URL?>/Default/skin/nobel/Themes/Story/media/toan.png" class="img-thumnail wheight50"/></a>
							<p class="text-uppercase robotofont weight10">maths</p>
						</div>
						<div class="col-md-2 col-xs-3 top10 height80 width20 btn-custom3 bgcl">
							<a href=""><img src="<?=BASE_SKIN_URL?>/Default/skin/nobel/Themes/Story/media/dialy.png" class="img-thumnail wheight50"/></a>
							<p class="text-uppercase robotofont weight10">geography</p>
						</div>
						<div class="col-md-2 col-xs-3 top10 height80 width20 btn-custom3 bgcl">
							<a href=""><img src="<?=BASE_SKIN_URL?>/Default/skin/nobel/Themes/Story/media/kynangquansat.png" class="img-thumnail wheight50"/></a>
							<p class="text-uppercase robotofont weight10">observation skill</p>
						</div>
						<div class="col-md-2 col-xs-3 top10 height80 width20 btn-custom3 bgcl">
							<a href=""><img src="<?=BASE_SKIN_URL?>/Default/skin/nobel/Themes/Story/media/lichsu.png" class="img-thumnail wheight50"/></a>
							<p class="text-uppercase robotofont weight10">History</p>
						</div>
						<div class="col-md-2 col-xs-3 top10 height80 width20 btn-custom3 bgcl">
							<a href=""><img src="<?=BASE_SKIN_URL?>/Default/skin/nobel/Themes/Story/media/tienganh.png" class="img-thumnail wheight50"/></a>
							<p class="text-uppercase robotofont weight10">English</p>
						</div>
						<div class="col-md-2 col-xs-3 top10 height80 width20 btn-custom3 bgcl">
							<a href=""><img src="<?=BASE_SKIN_URL?>/Default/skin/nobel/Themes/Story/media/kynangnghe.png" class="img-thumnail wheight50" /></a>
							<p class="text-uppercase robotofont weight10">listening skill</p>
						</div>
						<div class="col-md-2 col-xs-3 top10 height80 width20 btn-custom3 bgcl">
							<a href=""><img src="<?=BASE_SKIN_URL?>/Default/skin/nobel/Themes/Story/media/ngonngu.png" class="img-thumnail wheight50" /></a>
							<p class="text-uppercase robotofont weight10">language communication</p>
							
						</div>
						<div class="col-md-2 col-xs-3 top10 height80 width20 btn-custom3 bgcl">
							<a href=""><img src="<?=BASE_SKIN_URL?>/Default/skin/nobel/Themes/Story/media/hieubiet.png" class="img-thumnail wheight50" /></a>
							<p class="text-uppercase robotofont weight10">social understanding</p>
						</div>
		            </div>
					<div class="row tab-pane fade text-center pding10" id="menu1">
			            <div class="col-md-2 col-xs-3 top10 height80 width20 btn-custom3 bgcl">
							<a href=""><img src="<?=BASE_SKIN_URL?>/Default/skin/nobel/Themes/Story/media/de2.png" class="img-thumnail wheight50" /></a>
							<p class="text-uppercase robotofont weight10 top10">Đề 1</p>
						</div>
						<div class="col-md-2 col-xs-3 top10 height80 width20 btn-custom3 bgcl">
							<a href=""><img src="<?=BASE_SKIN_URL?>/Default/skin/nobel/Themes/Story/media/de3.png" class="img-thumnail wheight50" /></a>
							<p class="text-uppercase robotofont weight10 top10">Đề 2</p>
						</div>
						<div class="col-md-2 col-xs-3 top10 height80 width20 btn-custom3 bgcl">
							<a href=""><img src="<?=BASE_SKIN_URL?>/Default/skin/nobel/Themes/Story/media/de4.png" class="img-thumnail wheight50" /></a>
							<p class="text-uppercase robotofont weight10 top10">Đề 3</p>
						</div>
						<div class="col-md-2 col-xs-3 top10 height80 width20 btn-custom3 bgcl">
							<a href=""><img src="<?=BASE_SKIN_URL?>/Default/skin/nobel/Themes/Story/media/de5.png" class="img-thumnail wheight50" /></a>
							<p class="text-uppercase robotofont weight10 top10">Đề 4</p>
						</div>
						<div class="col-md-2 col-xs-3 top10 height80 width20 btn-custom3 bgcl">
							<a href=""><img src="<?=BASE_SKIN_URL?>/Default/skin/nobel/Themes/Story/media/de6.png" class="img-thumnail wheight50" /></a>
							<p class="text-uppercase robotofont weight10 top10">Đề 5</p>
						</div>
						<div class="col-md-2 col-xs-3 top10 height80 width20 btn-custom3 bgcl">
							<a href=""><img src="<?=BASE_SKIN_URL?>/Default/skin/nobel/Themes/Story/media/de7.png" class="img-thumnail wheight50" /></a>
							<p class="text-uppercase robotofont weight10 top10">Đề 6</p>
						</div>
						<div class="col-md-2 col-xs-3 top10 height80 width20 btn-custom3 bgcl">
							<a href=""><img src="<?=BASE_SKIN_URL?>/Default/skin/nobel/Themes/Story/media/de8.png" class="img-thumnail wheight50" /></a>
							<p class="text-uppercase robotofont weight10 top10">Đề 7</p>
						</div>
						<div class="col-md-2 col-xs-3 top10 height80 width20 btn-custom3 bgcl">
							<a href=""><img src="<?=BASE_SKIN_URL?>/Default/skin/nobel/Themes/Story/media/de9.png" class="img-thumnail wheight50" /></a>
							<p class="text-uppercase robotofont weight10 top10">Đề 8</p>
						</div>
						<div class="col-md-2 col-xs-3 top10 height80 width20 btn-custom3 bgcl">
							<a href=""><img src="<?=BASE_SKIN_URL?>/Default/skin/nobel/Themes/Story/media/de1.png" class="img-thumnail wheight50" /></a>
							<p class="text-uppercase robotofont weight10 top10">Làm đề khác</p>
						</div>
		            </div>
					<div class="row tab-pane fade text-center pding10" id="menu2">
			            <div class="col-md-2 col-xs-3 top10 height80 width20 btn-custom3 bgcl">
							<a href=""><img src="<?=BASE_SKIN_URL?>/Default/skin/nobel/Themes/Story/media/hinh2.png" class="img-thumnail wheight50" /></a>
							<p class="text-uppercase robotofont weight10 top10">Đề 1</p>
						</div>
						<div class="col-md-2 col-xs-3 top10 height80 width20 btn-custom3 bgcl">
							<a href=""><img src="<?=BASE_SKIN_URL?>/Default/skin/nobel/Themes/Story/media/hinh3.png" class="img-thumnail wheight50" /></a>
							<p class="text-uppercase robotofont weight10 top10">Đề 2</p>
						</div>
						<div class="col-md-2 col-xs-3 top10 height80 width20 btn-custom3 bgcl">
							<a href=""><img src="<?=BASE_SKIN_URL?>/Default/skin/nobel/Themes/Story/media/hinh4.png" class="img-thumnail wheight50" /></a>
							<p class="text-uppercase robotofont weight10 top10">Đề 3</p>
						</div>
						<div class="col-md-2 col-xs-3 top10 height80 width20 btn-custom3 bgcl">
							<a href=""><img src="<?=BASE_SKIN_URL?>/Default/skin/nobel/Themes/Story/media/hinh5.png" class="img-thumnail wheight50" /></a>
							<p class="text-uppercase robotofont weight10 top10">Đề 4</p>
						</div>
						<div class="col-md-2 col-xs-3 top10 height80 width20 btn-custom3 bgcl">
							<a href=""><img src="<?=BASE_SKIN_URL?>/Default/skin/nobel/Themes/Story/media/hinh6.png" class="img-thumnail wheight50" /></a>
							<p class="text-uppercase robotofont weight10 top10">Đề 5</p>
						</div>
						<div class="col-md-2 col-xs-3 top10 height80 width20 btn-custom3 bgcl">
							<a href=""><img src="<?=BASE_SKIN_URL?>/Default/skin/nobel/Themes/Story/media/hinh7.png" class="img-thumnail wheight50" /></a>
							<p class="text-uppercase robotofont weight10 top10">Đề 6</p>
						</div>
						<div class="col-md-2 col-xs-3 top10 height80 width20 btn-custom3 bgcl">
							<a href=""><img src="<?=BASE_SKIN_URL?>/Default/skin/nobel/Themes/Story/media/hinh8.png" class="img-thumnail wheight50" /></a>
							<p class="text-uppercase robotofont weight10 top10">Đề 7</p>
						</div>
						<div class="col-md-2 col-xs-3 top10 height80 width20 btn-custom3 bgcl">
							<a href=""><img src="<?=BASE_SKIN_URL?>/Default/skin/nobel/Themes/Story/media/hinh9.png" class="img-thumnail wheight50" /></a>
							<p class="text-uppercase robotofont weight10 top10">Đề 8</p>
						</div>
						
						<div class="col-md-2 col-xs-3 top10 height80 width20 btn-custom3 bgcl">
							<a href=""><img src="<?=BASE_SKIN_URL?>/Default/skin/nobel/Themes/Story/media/hinh1.png" class="img-thumnail wheight50" /></a>
							<p class="text-uppercase robotofont weight10 top10">Làm đề khác</p>
						</div>
		            </div>
					<div class="row tab-pane fade in active text-center pding10" id="menu3">
						<div class="col-md-2 col-xs-3 top10 height80 width20 btn-custom3 bgcl">
							<a href=""><img src="<?=BASE_SKIN_URL?>/Default/skin/nobel/Themes/Story/media/khoahoc.png" class="img-thumnail wheight50"/></a>
							<p class="text-uppercase robotofont weight10">science</p>
						</div>
						<div class="col-md-2 col-xs-3 top10 height80 width20 btn-custom3 bgcl">
							<a href=""><img src="<?=BASE_SKIN_URL?>/Default/skin/nobel/Themes/Story/media/toan.png" class="img-thumnail wheight50"/></a>
							<p class="text-uppercase robotofont weight10">maths</p>
						</div>
						<div class="col-md-2 col-xs-3 top10 height80 width20 btn-custom3 bgcl">
							<a href=""><img src="<?=BASE_SKIN_URL?>/Default/skin/nobel/Themes/Story/media/dialy.png" class="img-thumnail wheight50"/></a>
							<p class="text-uppercase robotofont weight10">geography</p>
						</div>
						<div class="col-md-2 col-xs-3 top10 height80 width20 btn-custom3 bgcl">
							<a href=""><img src="<?=BASE_SKIN_URL?>/Default/skin/nobel/Themes/Story/media/kynangquansat.png" class="img-thumnail wheight50"/></a>
							<p class="text-uppercase robotofont weight10">observation skill</p>
						</div>
						<div class="col-md-2 col-xs-3 top10 height80 width20 btn-custom3 bgcl">
							<a href=""><img src="<?=BASE_SKIN_URL?>/Default/skin/nobel/Themes/Story/media/lichsu.png" class="img-thumnail wheight50"/></a>
							<p class="text-uppercase robotofont weight10">History</p>
						</div>
						<div class="col-md-2 col-xs-3 top10 height80 width20 btn-custom3 bgcl">
							<a href=""><img src="<?=BASE_SKIN_URL?>/Default/skin/nobel/Themes/Story/media/tienganh.png" class="img-thumnail wheight50"/></a>
							<p class="text-uppercase robotofont weight10">English</p>
						</div>
						<div class="col-md-2 col-xs-3 top10 height80 width20 btn-custom3 bgcl">
							<a href=""><img src="<?=BASE_SKIN_URL?>/Default/skin/nobel/Themes/Story/media/kynangnghe.png" class="img-thumnail wheight50" /></a>
							<p class="text-uppercase robotofont weight10">listening skill</p>
						</div>
						<div class="col-md-2 col-xs-3 top10 height80 width20 btn-custom3 bgcl">
							<a href=""><img src="<?=BASE_SKIN_URL?>/Default/skin/nobel/Themes/Story/media/ngonngu.png" class="img-thumnail wheight50" /></a>
							<p class="text-uppercase robotofont weight10">language communication</p>
							
						</div>
						<div class="col-md-2 col-xs-3 top10 height80 width20 btn-custom3 bgcl">
							<a href=""><img src="<?=BASE_SKIN_URL?>/Default/skin/nobel/Themes/Story/media/hieubiet.png" class="img-thumnail wheight50" /></a>
							<p class="text-uppercase robotofont weight10">social understanding</p>
						</div>
						
		            </div>
	            </ul>
	        </li>
			<li class="dropdown bdr2 tab-content">
	            <a href="#" class="dropdown-toggle fsize" data-toggle="dropdown">Lớp 4</a>
	            <ul class="dropdown-menu multi-column columns-3 tab-content">
		        <ul class="nav nav-tabs nav-tabs-ct1">
					<li class="active"><a data-toggle="tab" href="#home2">Luyện tập</a></li>
					<li><a data-toggle="tab" href="#menu12">Đề luyện tập</a></li>
					<li><a data-toggle="tab" href="#menu22">Đề thi thử</a></li>
				</ul> 
				   <div class="row tab-pane fade in active text-center pding10" id="home2">
						<div class="col-md-2 col-xs-3 top10 height80 width20 btn-custom3 bgcl">
							<a href=""><img src="<?=BASE_SKIN_URL?>/Default/skin/nobel/Themes/Story/media/khoahoc.png" class="img-thumnail wheight50"/></a>
							<p class="text-uppercase robotofont weight10">science</p>
						</div>
						<div class="col-md-2 col-xs-3 top10 height80 width20 btn-custom3 bgcl">
							<a href=""><img src="<?=BASE_SKIN_URL?>/Default/skin/nobel/Themes/Story/media/toan.png" class="img-thumnail wheight50"/></a>
							<p class="text-uppercase robotofont weight10">maths</p>
						</div>
						<div class="col-md-2 col-xs-3 top10 height80 width20 btn-custom3 bgcl">
							<a href=""><img src="<?=BASE_SKIN_URL?>/Default/skin/nobel/Themes/Story/media/dialy.png" class="img-thumnail wheight50"/></a>
							<p class="text-uppercase robotofont weight10">geography</p>
						</div>
						<div class="col-md-2 col-xs-3 top10 height80 width20 btn-custom3 bgcl">
							<a href=""><img src="<?=BASE_SKIN_URL?>/Default/skin/nobel/Themes/Story/media/kynangquansat.png" class="img-thumnail wheight50"/></a>
							<p class="text-uppercase robotofont weight10">observation skill</p>
						</div>
						<div class="col-md-2 col-xs-3 top10 height80 width20 btn-custom3 bgcl">
							<a href=""><img src="<?=BASE_SKIN_URL?>/Default/skin/nobel/Themes/Story/media/lichsu.png" class="img-thumnail wheight50"/></a>
							<p class="text-uppercase robotofont weight10">History</p>
						</div>
						<div class="col-md-2 col-xs-3 top10 height80 width20 btn-custom3 bgcl">
							<a href=""><img src="<?=BASE_SKIN_URL?>/Default/skin/nobel/Themes/Story/media/tienganh.png" class="img-thumnail wheight50"/></a>
							<p class="text-uppercase robotofont weight10">English</p>
						</div>
						<div class="col-md-2 col-xs-3 top10 height80 width20 btn-custom3 bgcl">
							<a href=""><img src="<?=BASE_SKIN_URL?>/Default/skin/nobel/Themes/Story/media/kynangnghe.png" class="img-thumnail wheight50" /></a>
							<p class="text-uppercase robotofont weight10">listening skill</p>
						</div>
						<div class="col-md-2 col-xs-3 top10 height80 width20 btn-custom3 bgcl">
							<a href=""><img src="<?=BASE_SKIN_URL?>/Default/skin/nobel/Themes/Story/media/ngonngu.png" class="img-thumnail wheight50" /></a>
							<p class="text-uppercase robotofont weight10">language communication</p>
							
						</div>
						<div class="col-md-2 col-xs-3 top10 height80 width20 btn-custom3 bgcl">
							<a href=""><img src="<?=BASE_SKIN_URL?>/Default/skin/nobel/Themes/Story/media/hieubiet.png" class="img-thumnail wheight50" /></a>
							<p class="text-uppercase robotofont weight10">social understanding</p>
						</div>
						
		            </div>
					<div class="row tab-pane fade text-center pding10" id="menu12">
			            <div class="col-md-2 col-xs-3 top10 height80 width20 btn-custom3 bgcl">
							<a href=""><img src="<?=BASE_SKIN_URL?>/Default/skin/nobel/Themes/Story/media/de2.png" class="img-thumnail wheight50" /></a>
							<p class="text-uppercase robotofont weight10 top10">Đề 1</p>
						</div>
						<div class="col-md-2 col-xs-3 top10 height80 width20 btn-custom3 bgcl">
							<a href=""><img src="<?=BASE_SKIN_URL?>/Default/skin/nobel/Themes/Story/media/de3.png" class="img-thumnail wheight50" /></a>
							<p class="text-uppercase robotofont weight10 top10">Đề 2</p>
						</div>
						<div class="col-md-2 col-xs-3 top10 height80 width20 btn-custom3 bgcl">
							<a href=""><img src="<?=BASE_SKIN_URL?>/Default/skin/nobel/Themes/Story/media/de4.png" class="img-thumnail wheight50" /></a>
							<p class="text-uppercase robotofont weight10 top10">Đề 3</p>
						</div>
						<div class="col-md-2 col-xs-3 top10 height80 width20 btn-custom3 bgcl">
							<a href=""><img src="<?=BASE_SKIN_URL?>/Default/skin/nobel/Themes/Story/media/de5.png" class="img-thumnail wheight50" /></a>
							<p class="text-uppercase robotofont weight10 top10">Đề 4</p>
						</div>
						<div class="col-md-2 col-xs-3 top10 height80 width20 btn-custom3 bgcl">
							<a href=""><img src="<?=BASE_SKIN_URL?>/Default/skin/nobel/Themes/Story/media/de6.png" class="img-thumnail wheight50" /></a>
							<p class="text-uppercase robotofont weight10 top10">Đề 5</p>
						</div>
						<div class="col-md-2 col-xs-3 top10 height80 width20 btn-custom3 bgcl">
							<a href=""><img src="<?=BASE_SKIN_URL?>/Default/skin/nobel/Themes/Story/media/de7.png" class="img-thumnail wheight50" /></a>
							<p class="text-uppercase robotofont weight10 top10">Đề 6</p>
						</div>
						<div class="col-md-2 col-xs-3 top10 height80 width20 btn-custom3 bgcl">
							<a href=""><img src="<?=BASE_SKIN_URL?>/Default/skin/nobel/Themes/Story/media/de8.png" class="img-thumnail wheight50" /></a>
							<p class="text-uppercase robotofont weight10 top10">Đề 7</p>
						</div>
						<div class="col-md-2 col-xs-3 top10 height80 width20 btn-custom3 bgcl">
							<a href=""><img src="<?=BASE_SKIN_URL?>/Default/skin/nobel/Themes/Story/media/de9.png" class="img-thumnail wheight50" /></a>
							<p class="text-uppercase robotofont weight10 top10">Đề 8</p>
						</div>
						<div class="col-md-2 col-xs-3 top10 height80 width20 btn-custom3 bgcl">
							<a href=""><img src="<?=BASE_SKIN_URL?>/Default/skin/nobel/Themes/Story/media/de1.png" class="img-thumnail wheight50" /></a>
							<p class="text-uppercase robotofont weight10 top10">Làm đề khác</p>
						</div>
		            </div>
					<div class="row tab-pane fade text-center pding10" id="menu22">
			            <div class="col-md-2 col-xs-3 top10 height80 width20 btn-custom3 bgcl">
							<a href=""><img src="<?=BASE_SKIN_URL?>/Default/skin/nobel/Themes/Story/media/hinh2.png" class="img-thumnail wheight50" /></a>
							<p class="text-uppercase robotofont weight10 top10">Đề 1</p>
						</div>
						<div class="col-md-2 col-xs-3 top10 height80 width20 btn-custom3 bgcl">
							<a href=""><img src="<?=BASE_SKIN_URL?>/Default/skin/nobel/Themes/Story/media/hinh3.png" class="img-thumnail wheight50" /></a>
							<p class="text-uppercase robotofont weight10 top10">Đề 2</p>
						</div>
						<div class="col-md-2 col-xs-3 top10 height80 width20 btn-custom3 bgcl">
							<a href=""><img src="<?=BASE_SKIN_URL?>/Default/skin/nobel/Themes/Story/media/hinh4.png" class="img-thumnail wheight50" /></a>
							<p class="text-uppercase robotofont weight10 top10">Đề 3</p>
						</div>
						<div class="col-md-2 col-xs-3 top10 height80 width20 btn-custom3 bgcl">
							<a href=""><img src="<?=BASE_SKIN_URL?>/Default/skin/nobel/Themes/Story/media/hinh5.png" class="img-thumnail wheight50" /></a>
							<p class="text-uppercase robotofont weight10 top10">Đề 4</p>
						</div>
						<div class="col-md-2 col-xs-3 top10 height80 width20 btn-custom3 bgcl">
							<a href=""><img src="<?=BASE_SKIN_URL?>/Default/skin/nobel/Themes/Story/media/hinh6.png" class="img-thumnail wheight50" /></a>
							<p class="text-uppercase robotofont weight10 top10">Đề 5</p>
						</div>
						<div class="col-md-2 col-xs-3 top10 height80 width20 btn-custom3 bgcl">
							<a href=""><img src="<?=BASE_SKIN_URL?>/Default/skin/nobel/Themes/Story/media/hinh7.png" class="img-thumnail wheight50" /></a>
							<p class="text-uppercase robotofont weight10 top10">Đề 6</p>
						</div>
						<div class="col-md-2 col-xs-3 top10 height80 width20 btn-custom3 bgcl">
							<a href=""><img src="<?=BASE_SKIN_URL?>/Default/skin/nobel/Themes/Story/media/hinh8.png" class="img-thumnail wheight50" /></a>
							<p class="text-uppercase robotofont weight10 top10">Đề 7</p>
						</div>
						<div class="col-md-2 col-xs-3 top10 height80 width20 btn-custom3 bgcl">
							<a href=""><img src="<?=BASE_SKIN_URL?>/Default/skin/nobel/Themes/Story/media/hinh9.png" class="img-thumnail wheight50" /></a>
							<p class="text-uppercase robotofont weight10 top10">Đề 8</p>
						</div>
						
						<div class="col-md-2 col-xs-3 top10 height80 width20 btn-custom3 bgcl">
							<a href=""><img src="<?=BASE_SKIN_URL?>/Default/skin/nobel/Themes/Story/media/hinh1.png" class="img-thumnail wheight50" /></a>
							<p class="text-uppercase robotofont weight10 top10">Làm đề khác</p>
						</div>
		            </div>
	            </ul>
	        </li>
			<li class="dropdown bdr3 tab-content">
	            <a href="#" class="dropdown-toggle fsize" data-toggle="dropdown">Lớp 5</a>
	            <ul class="dropdown-menu multi-column columns-3 tab-content">
		        <ul class="nav nav-tabs nav-tabs-ct2">
					<li class="active"><a data-toggle="tab" href="#home3">Luyện tập</a></li>
					<li><a data-toggle="tab" href="#menu13">Đề luyện tập</a></li>
					<li><a data-toggle="tab" href="#menu23">Đề thi thử</a></li>
				</ul> 
				   <div class="row tab-pane fade in active text-center pding10" id="home3">
						<div class="col-md-2 col-xs-3 top10 height80 width20 btn-custom3 bgcl">
							<a href=""><img src="<?=BASE_SKIN_URL?>/Default/skin/nobel/Themes/Story/media/khoahoc.png" class="img-thumnail wheight50"/></a>
							<p class="text-uppercase robotofont weight10">science</p>
						</div>
						<div class="col-md-2 col-xs-3 top10 height80 width20 btn-custom3 bgcl">
							<a href=""><img src="<?=BASE_SKIN_URL?>/Default/skin/nobel/Themes/Story/media/toan.png" class="img-thumnail wheight50"/></a>
							<p class="text-uppercase robotofont weight10">maths</p>
						</div>
						<div class="col-md-2 col-xs-3 top10 height80 width20 btn-custom3 bgcl">
							<a href=""><img src="<?=BASE_SKIN_URL?>/Default/skin/nobel/Themes/Story/media/dialy.png" class="img-thumnail wheight50"/></a>
							<p class="text-uppercase robotofont weight10">geography</p>
						</div>
						<div class="col-md-2 col-xs-3 top10 height80 width20 btn-custom3 bgcl">
							<a href=""><img src="<?=BASE_SKIN_URL?>/Default/skin/nobel/Themes/Story/media/kynangquansat.png" class="img-thumnail wheight50"/></a>
							<p class="text-uppercase robotofont weight10">observation skill</p>
						</div>
						<div class="col-md-2 col-xs-3 top10 height80 width20 btn-custom3 bgcl">
							<a href=""><img src="<?=BASE_SKIN_URL?>/Default/skin/nobel/Themes/Story/media/lichsu.png" class="img-thumnail wheight50"/></a>
							<p class="text-uppercase robotofont weight10">History</p>
						</div>
						<div class="col-md-2 col-xs-3 top10 height80 width20 btn-custom3 bgcl">
							<a href=""><img src="<?=BASE_SKIN_URL?>/Default/skin/nobel/Themes/Story/media/tienganh.png" class="img-thumnail wheight50"/></a>
							<p class="text-uppercase robotofont weight10">English</p>
						</div>
						<div class="col-md-2 col-xs-3 top10 height80 width20 btn-custom3 bgcl">
							<a href=""><img src="<?=BASE_SKIN_URL?>/Default/skin/nobel/Themes/Story/media/kynangnghe.png" class="img-thumnail wheight50" /></a>
							<p class="text-uppercase robotofont weight10">listening skill</p>
						</div>
						<div class="col-md-2 col-xs-3 top10 height80 width20 btn-custom3 bgcl">
							<a href=""><img src="<?=BASE_SKIN_URL?>/Default/skin/nobel/Themes/Story/media/ngonngu.png" class="img-thumnail wheight50" /></a>
							<p class="text-uppercase robotofont weight10">language communication</p>
							
						</div>
						<div class="col-md-2 col-xs-3 top10 height80 width20 btn-custom3 bgcl">
							<a href=""><img src="<?=BASE_SKIN_URL?>/Default/skin/nobel/Themes/Story/media/hieubiet.png" class="img-thumnail wheight50" /></a>
							<p class="text-uppercase robotofont weight10">social understanding</p>
						</div>
						
		            </div>
					<div class="row tab-pane fade text-center pding10" id="menu13">
			            <div class="col-md-2 col-xs-3 top10 height80 width20 btn-custom3 bgcl">
							<a href=""><img src="<?=BASE_SKIN_URL?>/Default/skin/nobel/Themes/Story/media/de2.png" class="img-thumnail wheight50" /></a>
							<p class="text-uppercase robotofont weight10 top10">Đề 1</p>
						</div>
						<div class="col-md-2 col-xs-3 top10 height80 width20 btn-custom3 bgcl">
							<a href=""><img src="<?=BASE_SKIN_URL?>/Default/skin/nobel/Themes/Story/media/de3.png" class="img-thumnail wheight50" /></a>
							<p class="text-uppercase robotofont weight10 top10">Đề 2</p>
						</div>
						<div class="col-md-2 col-xs-3 top10 height80 width20 btn-custom3 bgcl">
							<a href=""><img src="<?=BASE_SKIN_URL?>/Default/skin/nobel/Themes/Story/media/de4.png" class="img-thumnail wheight50" /></a>
							<p class="text-uppercase robotofont weight10 top10">Đề 3</p>
						</div>
						<div class="col-md-2 col-xs-3 top10 height80 width20 btn-custom3 bgcl">
							<a href=""><img src="<?=BASE_SKIN_URL?>/Default/skin/nobel/Themes/Story/media/de5.png" class="img-thumnail wheight50" /></a>
							<p class="text-uppercase robotofont weight10 top10">Đề 4</p>
						</div>
						<div class="col-md-2 col-xs-3 top10 height80 width20 btn-custom3 bgcl">
							<a href=""><img src="<?=BASE_SKIN_URL?>/Default/skin/nobel/Themes/Story/media/de6.png" class="img-thumnail wheight50" /></a>
							<p class="text-uppercase robotofont weight10 top10">Đề 5</p>
						</div>
						<div class="col-md-2 col-xs-3 top10 height80 width20 btn-custom3 bgcl">
							<a href=""><img src="<?=BASE_SKIN_URL?>/Default/skin/nobel/Themes/Story/media/de7.png" class="img-thumnail wheight50" /></a>
							<p class="text-uppercase robotofont weight10 top10">Đề 6</p>
						</div>
						<div class="col-md-2 col-xs-3 top10 height80 width20 btn-custom3 bgcl">
							<a href=""><img src="<?=BASE_SKIN_URL?>/Default/skin/nobel/Themes/Story/media/de8.png" class="img-thumnail wheight50" /></a>
							<p class="text-uppercase robotofont weight10 top10">Đề 7</p>
						</div>
						<div class="col-md-2 col-xs-3 top10 height80 width20 btn-custom3 bgcl">
							<a href=""><img src="<?=BASE_SKIN_URL?>/Default/skin/nobel/Themes/Story/media/de9.png" class="img-thumnail wheight50" /></a>
							<p class="text-uppercase robotofont weight10 top10">Đề 8</p>
						</div>
						<div class="col-md-2 col-xs-3 top10 height80 width20 btn-custom3 bgcl">
							<a href=""><img src="<?=BASE_SKIN_URL?>/Default/skin/nobel/Themes/Story/media/de1.png" class="img-thumnail wheight50" /></a>
							<p class="text-uppercase robotofont weight10 top10">Làm đề khác</p>
						</div>
		            </div>
					<div class="row tab-pane fade text-center pding10" id="menu23">
			            <div class="col-md-2 col-xs-3 top10 height80 width20 btn-custom3 bgcl">
							<a href=""><img src="<?=BASE_SKIN_URL?>/Default/skin/nobel/Themes/Story/media/hinh2.png" class="img-thumnail wheight50" /></a>
							<p class="text-uppercase robotofont weight10 top10">Đề 1</p>
						</div>
						<div class="col-md-2 col-xs-3 top10 height80 width20 btn-custom3 bgcl">
							<a href=""><img src="<?=BASE_SKIN_URL?>/Default/skin/nobel/Themes/Story/media/hinh3.png" class="img-thumnail wheight50" /></a>
							<p class="text-uppercase robotofont weight10 top10">Đề 2</p>
						</div>
						<div class="col-md-2 col-xs-3 top10 height80 width20 btn-custom3 bgcl">
							<a href=""><img src="<?=BASE_SKIN_URL?>/Default/skin/nobel/Themes/Story/media/hinh4.png" class="img-thumnail wheight50" /></a>
							<p class="text-uppercase robotofont weight10 top10">Đề 3</p>
						</div>
						<div class="col-md-2 col-xs-3 top10 height80 width20 btn-custom3 bgcl">
							<a href=""><img src="<?=BASE_SKIN_URL?>/Default/skin/nobel/Themes/Story/media/hinh5.png" class="img-thumnail wheight50" /></a>
							<p class="text-uppercase robotofont weight10 top10">Đề 4</p>
						</div>
						<div class="col-md-2 col-xs-3 top10 height80 width20 btn-custom3 bgcl">
							<a href=""><img src="<?=BASE_SKIN_URL?>/Default/skin/nobel/Themes/Story/media/hinh6.png" class="img-thumnail wheight50" /></a>
							<p class="text-uppercase robotofont weight10 top10">Đề 5</p>
						</div>
						<div class="col-md-2 col-xs-3 top10 height80 width20 btn-custom3 bgcl">
							<a href=""><img src="<?=BASE_SKIN_URL?>/Default/skin/nobel/Themes/Story/media/hinh7.png" class="img-thumnail wheight50" /></a>
							<p class="text-uppercase robotofont weight10 top10">Đề 6</p>
						</div>
						<div class="col-md-2 col-xs-3 top10 height80 width20 btn-custom3 bgcl">
							<a href=""><img src="<?=BASE_SKIN_URL?>/Default/skin/nobel/Themes/Story/media/hinh8.png" class="img-thumnail wheight50" /></a>
							<p class="text-uppercase robotofont weight10 top10">Đề 7</p>
						</div>
						<div class="col-md-2 col-xs-3 top10 height80 width20 btn-custom3 bgcl">
							<a href=""><img src="<?=BASE_SKIN_URL?>/Default/skin/nobel/Themes/Story/media/hinh9.png" class="img-thumnail wheight50" /></a>
							<p class="text-uppercase robotofont weight10 top10">Đề 8</p>
						</div>
						
						<div class="col-md-2 col-xs-3 top10 height80 width20 btn-custom3 bgcl">
							<a href=""><img src="<?=BASE_SKIN_URL?>/Default/skin/nobel/Themes/Story/media/hinh1.png" class="img-thumnail wheight50" /></a>
							<p class="text-uppercase robotofont weight10 top10">Làm đề khác</p>
						</div>
		            </div>
	            </ul>
	        </li>
			<li class="dropdown bdr4 fsize">
	            <a href="#" class="dropdown-toggle" data-toggle="dropdown">Quà tặng</a>
	            
	        </li>
	        <li class="dropdown bdr5 fsize">
	            <a href="#" class="dropdown-toggle" data-toggle="dropdown">Game</a>
	            
	        </li>
        </ul>
    </div>
    <!--/.navbar-collapse-->
</nav>
<div class="container fivecolumns">
	<div class="row">
		<div class="col-md-10 col-xs-10 top20">
			<div class="row">
				<div class="col-md-6 col-xs-6">
					<div class="row">
						<div class="col-md-12 col-xs-12 bdright">
							<a href=""><img src="<?=BASE_SKIN_URL?>/Default/skin/nobel/test/Themes/Default/media/ava.png" class="img-responsive imgheight center-block"/></a>
						</div>
						<div class="col-md-12 col-xs-12">
							<a href=""><h4>Nuôi gấu từ bé sẽ làm tăng tình cảm</h4></a>
							<p>Theo nghiên cứu mới đây của hiệp hội bảo vệ gấu, gấu được chủ nuôi từ bé sẽ có nhiều tình cảm hơn, tỷ lệ gấu trở thành biến dị gấu chó ...</p>
						</div>
					</div>
				</div>
				<div class="col-md-6 col-xs-6">
					<h3 class="mgtop-5">Bài viết được quan tâm</h3>
					<a href="" ><h4 class="top20">Nuôi gấu trong nhà làm cảnh, pháp luật có cho phép ?</h4></a>
					<a href=""><h4>Nuôi gấu cảnh, một thiếu nữ thiệt mạng</h4></a>
					<a href=""><h4>Quốc hội đang bỏ phiếu về luật chống nuôi gấu cảnh</h4></a>
					<a href=""><h4>Thực hư chuyện gấu cảnh báo ơn</h4></a>
					<a href=""><h4>Nuôi gấu hay nuôi chó ?</h4></a>
					<a href=""><h4>Gấu chó, nhân tạo hay tự nhiên ?</h4></a>
					<a href=""><h4>Gấu chó tốt gấp 2 lần gấu và chó !</h4></a>
				</div>
			</div>
			<div class="row bdtop top20">
				<div class="col-md-3 col-xs-6 top20">
					<button type="button" class="btn btn-default btn-block clD53D3C">Video</button>
					<button type="button" class="btn btn-default btn-block clBBDDC5">Thơ</button>
					<button type="button" class="btn btn-default btn-block clF7E285">Truyện</button>
					<button type="button" class="btn btn-default btn-block clD53D3C">Bài văn</button>
				</div>
				<div class="col-md-9 col-xs-6 top20">
					<div class="row bdbot">
						<div class="col-md-4 col-xs-4 ">
							<img src="<?=BASE_SKIN_URL?>/Default/skin/nobel/test/Themes/Default/media/ava.png" class="img-responsive thumnail center-block whimg"/>
						</div>
						<div class="col-md-8 col-xs-8 ">
							<h4>Tiêu đề</h4>
							<p>Mô tả</p>
						</div>
					</div>
					<div class="row bdbot">
						<div class="col-md-4 col-xs-4 ">
							<img src="<?=BASE_SKIN_URL?>/Default/skin/nobel/test/Themes/Default/media/ava2.png" class="img-responsive thumnail center-block whimg"/>
						</div>
						<div class="col-md-8 col-xs-8 ">
							<h4>Tiêu đề</h4>
							<p>Mô tả</p>
						</div>
					</div>
					<div class="row bdbot">
						<div class="col-md-4 col-xs-4 ">
							<img src="<?=BASE_SKIN_URL?>/Default/skin/nobel/test/Themes/Default/media/ava.png" class="img-responsive thumnail center-block whimg"/>
						</div>
						<div class="col-md-8 col-xs-8 ">
							<h4>Tiêu đề</h4>
							<p>Mô tả</p>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="col-md-2 col-xs-12">
			<div class="row">
				<div class="full mgright20 robotofont">
					<a href=""><img class="image-responsive center-block" src="<?=BASE_SKIN_URL?>/Default/skin/nobel/test/Themes/Default/media/full.png"></a>
					<p class="text-center top10"><strong>FULL LOOK</strong></p>
					<p class="text-center">(Phần mềm khảo sát năng lực toàn diện bằng tiếng Anh)</p>
				</div>
				<div class="full top20 mgright20 robotofont">
					<a href=""><img class="image-responsive center-block" src="<?=BASE_SKIN_URL?>/Default/skin/nobel/test/Themes/Default/media/vietvan.png"></a>
					<p class="text-center top10"><strong>LUYÊN VIẾT VĂN MIÊU TẢ</strong></p>
					<p class="text-center">(Dành cho HS lớp 3,4,5,6)</p>
				</div>
				<div class="full top20 mgright20 robotofont">
					<a href=""><img class="image-responsive center-block" src="<?=BASE_SKIN_URL?>/Default/skin/nobel/test/Themes/Default/media/khaosat.png"></a>
					<p class="text-center top10"><strong>TIẾNG VIỆT VUI</strong></p>
					<p class="text-center">( Phần mềm ôn tập chương trình TV Tiểu học)</p>
				</div>
			</div> 
		</div>
	</div>
</div>
<div class="container fivecolumns">
	
</div>
