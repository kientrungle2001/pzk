<nav class="cls-navbar-fixed-top">
	<my.container.header>
		<my.navbar-header>
			
			<a class="navbar-brand" rel="home" href="<?=HW_URL?>">
				
				<img src="<?=BASE_SKIN_URL?>/Themes/pmtv/skin/media/logo.png" class="cls-logo hidden" alt="logo happyway" style="max-width:70px; margin-top: -15px;" />
				<h1 class="visible-xs font-normal padding-0 margin-0 left-10 inline-block">PMTV 4</h1>
			</a>
			<?php if(pzk_session('userId') <= 0):?>
			<a class="login_required top-10 inline-block visible-xs" href="javascript:void(0)" data-toggle="modal" data-target="#LoginModal"><span style="color: #fff;" class="glyphicon glyphicon-user"></span> Đăng nhập</a>
			<?php else: ?>
				<a class="top-10 inline-block visible-xs" href="<?=BASE_REQUEST?>/account/logout"><span style="color: #fff;" class="glyphicon glyphicon-user"></span> Thoát</a>
			<?php endif;?>
		</my.navbar-header>
		<my.navbar>
		  <my.navbar-nav>
			<li><a style="border-top: 5px solid #a67ac0;" href="{? echo HW_URL; ?}" class="auto-font"><span style="color: #fff;" class="glyphicon glyphicon-home"></span> Trang chủ</a></li>
			<li><a style="border-top: 5px solid #fd006b;" href="{? echo HW_URL; ?}/gioi-thieu-cong-ty" class="auto-font"><span class="glyphicon glyphicon-user"></span> Về chúng tôi</a></li>
			
			<li class="dropdown"><a style="border-top: 5px solid #fdc600;" class="dropdown-toggle auto-font" data-toggle="dropdown" href="#"><span style="color: #fff;" class="glyphicon glyphicon-book"></span> Phần mềm học tập</a>
				<ul class="dropdown-menu">
					<li><a href="<?=PMTV3_URL?>">Phần mềm tiếng Việt lớp 3</a></li>
					<li><a href="<?=PMTV4_URL?>">Phần mềm tiếng Việt lớp 4</a></li>
					<li><a href="<?=PMTV5_URL?>">Phần mềm tiếng Việt lớp 5</a></li>
				</ul>
			</li>
			<li><a style="border-top: 5px solid #46b1b5;" href="{? echo HW_URL; ?}" class="auto-font"><span class="glyphicon glyphicon-gift"></span> Quà tặng học tập</a></li>
			
			<!--
			<li><a href="http://nextnobels.com/Khoa-hoc">Khóa học</a></li>
			-->
			<?php if(pzk_session('userId') <= 0):?>
			<li><a style="border-top: 5px solid #aea652;" class="login_required auto-font" href="javascript:void(0)" data-toggle="modal" data-target="#LoginModal"><span style="color: #fff;" class="glyphicon glyphicon-pencil"></span> Đăng nhập</a></li><li><a style="border-top: 5px solid #aea652;" class="login_required auto-font" href="javascript:void(0)" data-toggle="modal" data-target="#RegisterModal"><span style="color: #fff;" class="glyphicon glyphicon-pencil"></span> Đăng ký</a></li>
			<?php elseif(pzk_session('userId') >0 ):?>
			<li class="top15 auto-font">
			<div style="margin-top: 20px; display: inline-block;">
			Xin chào ( {children [id=userAccountUser]} )
			</div>
			</li>
			<li><a style="margin-top: 5px;" href="<?=BASE_REQUEST?>/account/logout" class="auto-font">Thoát</a></li>
			<?php endif;?>
			<li><a style="border-top: 5px solid #46b1b5;" href="{? echo PMTV4_URL; ?}/home/about#tab4" class="auto-font btn btn-danger"><span class="glyphicon glyphicon-gift"></span> NẠP THẺ </a></li>
			
		  </my.navbar-nav>
		</my.navbar>
	</my.container.header>
</nav>