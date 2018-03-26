<style>
body {
	padding-top: 0;
}
</style>
<div class="bgcolor-white">
<div class="container padding-10">
<div class="row">
<div class="col-xs-12">
<a class="navbar-brand" rel="home" href="<?=HW_URL?>">
	<img src="<?=BASE_SKIN_URL?>/Themes/pmtv/skin/media/logo.png" class="img-responsive" alt="logo nextnobels" style="max-width:275px; margin-top: -15px;" />
</a>
<h1 class="font-largest site-title text-uppercase">Hệ thống học - luyện tiếng Việt lớp 3, 4, 5 và phát triển ngôn ngữ</h1>
</div>
</div>
</div>
</div>
<nav class="navbar navbar-default nav-homepage">
	<div class="container">
		<div class="navbar-header">
			<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span> 
			</button>
			<a class="navbar-brand" rel="home" href="<?=HW_URL?>">
				<img src="<?=BASE_SKIN_URL?>/Default/skin/nobel/Themes/Story/media/logo.png" class="img-responsive hidden" alt="logo nextnobels" style="max-width:70px; margin-top: -15px;" />
			</a>
		</div>
		<div class="collapse navbar-collapse" id="myNavbar">
		  <ul class="nav navbar-nav navbar-left">
			<li><a href="{? echo HW_URL; ?}" class="auto-font text-uppercase"></span> Trang chủ</a></li>
			<li><a href="#" class="dropdown-toggle auto-font text-uppercase" data-toggle="dropdown">Giới thiệu</a>
			
			<ul class="dropdown-menu">
				<li><a href="{? echo HW_URL; ?}/gioi-thieu-cong-ty">Về công ty</a></li>
				<li><a href="{? echo HW_URL; ?}/doi-ngu">Đội ngũ</a></li>
				<li><a href="{? echo HW_URL; ?}/ve-san-pham">Về sản phẩm</a></li>
				<li><a href="{? echo HW_URL; ?}/bao-chi-ve-chung-toi">Báo chí viết về chúng tôi</a></li>
			</ul>
				</li>
			<li><a href="{? echo HW_URL; ?}/tin-tuc" class="auto-font text-uppercase">Tin tức</a></li>
			
			<li class="dropdown"><a class="dropdown-toggle auto-font text-uppercase" data-toggle="dropdown" href="#">Phần mềm học online</a>
				<ul class="dropdown-menu">
					<li><a href="#">Phần mềm tiếng Việt lớp 3</a></li>
					<li><a href="<?=PMTV4_URL?>">Phần mềm tiếng Việt lớp 4</a></li>
					<li><a href="<?=PMTV5_URL?>">Phần mềm tiếng Việt lớp 5</a></li>
				</ul>
			</li>
			<li><a href="{? echo PMTV4_URL; ?}/huong-dan-mua" class="auto-font text-uppercase">Hướng dẫn nộp học phí</a></li>
			<li><a href="{? echo HW_URL; ?}/qua-tang-hoc-bong" class="auto-font text-uppercase">Quà tặng - học bổng</a></li>
			<?php if(0):?>
			<?php if(pzk_session('userId') <= 0):?>
			<li><a class="login_required auto-font text-uppercase" href="javascript:void(0)" data-toggle="modal" data-target="#LoginModal">Đăng nhập</a></li><li><a class="login_required auto-font text-uppercase" href="javascript:void(0)" data-toggle="modal" data-target="#RegisterModal">Đăng ký</a></li>
			<?php elseif(pzk_session('userId') >0 ):?>
			<?php if(0):?>
			<li class="top15 auto-font">
			<div style="margin-top: 20px; display: inline-block;">
			Xin chào ( {children [id=userAccountUser]} )
			</div>
			</li>
			<?php endif; ?>
			<li><a href="<?=PMTV4_URL?>/huong-dan-mua#tab4" class="auto-font btn btn-danger color-white">Nạp Thẻ Cào</a></li>
			<li><a href="<?=BASE_REQUEST?>/account/logout" class="auto-font">Thoát</a></li>
			
			<?php endif;?>
			<?php endif;?>
		  </ul>
		</div>
	</div>
</nav>