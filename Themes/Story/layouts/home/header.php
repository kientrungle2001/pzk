<nav class="navbar navbar-default navbar-fixed-top">
	<div class="container">
		<div class="navbar-header">
			<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span> 
			</button>
			<a class="navbar-brand" rel="home" href="/home">
			
				<img src="<?=BASE_SKIN_URL?>/Default/skin/nobel/Themes/Story/media/logo.png" class="img-responsive" alt="logo nextnobels" style="max-width:70px; margin-top: -15px;" />
			</a>
		</div>
		<div class="collapse navbar-collapse" id="myNavbar">
		  <ul class="nav navbar-nav navbar-right">
			<li><a href="{? echo NOBEL_URL; ?}">Trang chủ</a></li>
			<li class="dropdown"><a class="dropdown-toggle" data-toggle="dropdown" href="#">Phần mềm học tập</a>
				<ul class="dropdown-menu">
					<li><a href="<?=FL_URL?>">Full Look Trần Đại Nghĩa</a></li>
					<li><a href="<?=FLSN_URL?>">Full Look Song ngữ</a></li>
					<li><a href="">Luyện viết văn</a></li>
					<li><a href="">Khảo sát IQ, EQ</a></li>
				</ul>
			</li>
			<!--
			<li><a href="http://nextnobels.com/Khoa-hoc">Khóa học</a></li>
			-->
			<?php if(0 && pzk_session('userId') <= 0):?>
			<li><a id="nobelLogin" href="javascript:void(0)" data-toggle="modal" data-target=".bs-example-modal-lg"><span class="glyphicon glyphicon-user"></span> Đăng ký</a></li>
			<li><a id="nobelLogin" href="javascript:void(0)" data-toggle="modal" data-target=".bs-example-modal-lg"><span class="glyphicon glyphicon-log-in"></span> Đăng nhập</a></li>
			<?php elseif(0 && pzk_session('userId') >0 ):?>
			<li class="top15">Xin chào ( {children [id=userAccountUser]} )</li>
			<li><a  href="<?=BASE_REQUEST?>/account/logout">Thoát</a></li>
			<?php endif;?>
		  </ul>
		</div>
	</div>
</nav>