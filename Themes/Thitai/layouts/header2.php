<nav class="navbar navbar-default navbar-fixed-top">
	<div class="container">
		<div class="navbar-header">
			<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span> 
			</button>
			<a class="navbar-brand" rel="home" href="<?=NOBEL_URL?>">
				<img src="<?=BASE_SKIN_URL?>/Default/skin/nobel/Themes/Story/media/logo.png" class="img-responsive" alt="logo nextnobels" style="max-width:70px; margin-top: -15px;" />
			</a>
		</div>
		
		<div class="collapse navbar-collapse" id="myNavbar">
		  <ul class="nav navbar-nav navbar-right">
			<li class="top4"><a href="#">Li�n h?: 0936 738 986</a></li>
			
			<?php if(pzk_session('userId') <= 0):?>
			<li><a rel="/home/index" class="login_required" href="javascript:void(0)" data-toggle="modal" data-target=".bs-example-modal-lg"><span class="glyphicon glyphicon-user"></span> �ang k�</a></li>
			<li><a rel="/home/index" class="login_required" href="javascript:void(0)" data-toggle="modal" data-target=".bs-example-modal-lg"><span class="glyphicon glyphicon-log-in"></span> �ang nh?p</a></li>
			<?php elseif(pzk_session('userId') >0 ):?>
			<li class="top10">Xin cha`o <button class="btn btn-success dropdown"><?php $data->displayChildren('[id=userAccountUser][position=user]') ?><span class="caret"></span></button></li>
			<li class="top4"><a  href="/api_account/logout?backHref=home/index">Thoa�t</a></li>
			<?php endif;?>
		  </ul>
		</div>
	</div>
</nav>
<div class='item fullpage'>
	<div class="container top50">
		
		<img class='item mgt20' src="/Themes/thitai/skin/media/header.png"/> 
		
		<nav class="nav mgb20 item navbar navbar-default container pdright0 mgmobile" role="navigation">
			<ul class="nav nav-justified home-menu robotofont">
				<li class="dropdown bdr">
					<a href="<?=BASE_REQUEST;?>">Trang ch?</a>
				</li> 
				<li class="dropdown bdr2">
					<a href=""> Ti?u h?c <span class="caret"></span></a>
					<ul class="dropdown-menu robotofont col-xs-12">
						
						<li><a target="_blank" href="http://tdn.thitai.vn">Thi th? tr?c tuy?n v�o tru?ng <br> Tr?n �?i Nghia</a></li>
						<li><a target="_blank" href="http://nb.thitai.vn">Ki?m tra ch?t lu?ng d?u nam 2016 <br> TT Next Nobels</a></li>
					</ul>
				</li> 
				<li class="dropdown bdr3">
					<a href="#">Trung h?c co s? </a>
					
				</li> 
				<li class="dropdown bdr4">
					<a href="#">Li�n h? </a>
					
				</li>
			</ul>
		</nav>
	</div>

	<script>
	$(document).ready(function(){
		$('[data-toggle="popover"]').popover();   
	});
	</script>

