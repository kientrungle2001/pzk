<nav id="navbar">
	<div class="container">
		<div class="navbar-header">
			<button id="navbarButton" data-toggle="collapse" data-target="#myNavbar">
			</button>
			<a class="navbar-brand" rel="home" href="<?=NOBEL_URL?>">
				<img id="logo" src="/Default/skin/nobel/Themes/Story/media/logo.png" alt="logo nextnobels" />
			</a>

			<?php if(pzk_session('userId') <= 0):?>
				<a class="register_head visible-xs text-center" href="javascript:void(0)" data-toggle="modal" data-target="#RegisterModal"><span class="glyphicon glyphicon-user"></span> Đăng ký</a></br>
				<a class="login_head visible-xs text-center" href="javascript:void(0)" data-toggle="modal" data-target="#LoginModal"><span class="glyphicon glyphicon-log-in"></span> Đăng nhập</a>
				<a class="logout_btn_mobile text-center" href="/home/payment">Nạp thẻ</a>
			<!-- <a class="login_required_mobile">Đăng nhập - Đăng ký1</a> -->
			<?php elseif(pzk_session('userId') >0 ):?>
			<a class="logout_btn_mobile" href="/account/logout">Đăng xuất</a>
			<a class="logout_btn_mobile" href="/home/payment">Nạp thẻ</a>
			<?php endif;?>
			
		</div>
		
		<div id="myNavbar">
		  <ul>
			<li><a href="{? echo NOBEL_URL; ?}">Trang chủ</a></li>
			<!--li class="dropdown"><a class="dropdown-toggle" data-toggle="dropdown" href="#">Phần mềm học tập</a>
				<ul class="dropdown-menu">
					<li><a href="<?=FL_URL?>">Full Look Trần Đại Nghĩa</a></li>
					<li><a href="<?=FLSN_URL?>">Full Look Song ngữ</a></li>
					<li><a href="#">Luyện viết văn</a></li>
					<li><a href="#">Khảo sát IQ, EQ</a></li>
				</ul>
			</li-->
			<?php if(pzk_session('userId') <= 0):?>
				
			<li><a class="register_head" href="javascript:void(0)" data-toggle="modal" data-target="#RegisterModal"><span class="glyphicon glyphicon-user"></span> Đăng ký</a></li>
			<li><a class="login_head" href="javascript:void(0)" data-toggle="modal" data-target="#LoginModal"><span class="glyphicon glyphicon-log-in"></span> Đăng nhập</a></li>
			<li class="top10"><div class="btn-user btn btn-danger  "><a style="color: white;font-weight: bold;" href="/home/payment"><span class="glyphicon glyphicon-arrow-down"></span>Nạp Thẻ</a></div></li>
			<?php elseif(pzk_session('userId') >0 ):?>
			
			<li class="top10">Xin chào <div class="btn-user">{children [id=userAccountUser][position=user]}<span class="caret"></span></div></li>
			<li><a href="/account/logout">Thoát</a></li>

			<li class="top10"><div class="btn-user btn btn-danger  "><a style="color: white;font-weight: bold;" href="/home/payment"><span class="glyphicon glyphicon-arrow-down"></span>Nạp Thẻ</a></div></li>
			<?php endif;?>
			
		  </ul>
		</div>
	</div>
</nav>

<!--div class="zoom-font hidden-xs" >
Zoom: <span onclick="zoomIn();" class="zoom-in fs16">
<span class="glyphicon glyphicon-zoom-in" aria-hidden="true"></span>
</span>
<span onclick="zoomOut();" class="zoom-out fs16">
<span class="glyphicon glyphicon-zoom-out" aria-hidden="true"></span>
</span>
</div-->
<div class="item visible-xs" style="height: 45px;"></div>
<script>
	function baotri(){
		alert('Website đang trong giai đoạn nâng cấp, thay đổi giao diện. Bạn vui lòng truy cập sau 24h nữa! Trân trọng cảm ơn!');
	}
</script>

