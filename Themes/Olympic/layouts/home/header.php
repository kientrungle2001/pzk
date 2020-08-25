<?php // require_once(BASE_DIR.'/lib/recursive.php'); ?>
<div class='item relative'>
<div style='z-index: 99999999;' class='item absolute'>
<nav class="topheader2 navbar-default">
	<div class="container">
		<div class="navbar-header">
			<button onclick="addcolor();" type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span> 
			</button>
			<a class="navbar-brand fix-brand" rel="home" href="/">
				<img class='logo-img mgt-3 item' src="<?=BASE_SKIN_URL?>/Default/skin/nobel/olympic/Themes/olympic/image/logonextnobels.png" alt="logo nextnobels" />
			</a>
		</div>
		<div class="collapse bgtopheader navbar-collapse" id="myNavbar">
		  <ul class="nav  navbar-nav navbar-nav2 navbar-right">
			<li class="dropdown"><a class="dropdown-toggle" data-toggle="dropdown" href="#">Phần mềm học tập</a>
				<ul class="dropdown-menu">
					<li><a href="">Full Look</a></li>
					<li><a href="">Luyện viết văn</a></li>
					<li><a href="">Khảo sát IQ, EQ</a></li>
				</ul>
			</li>
			<li><a href="http://nextnobels.com/Khoa-hoc">Khóa học</a></li>
			<?php if(pzk_session('userId') <= 0):?>
			<li><a id="nobelLogin" href="javascript:void(0)" data-toggle="modal" data-target=".bs-example-modal-lg"><span class="glyphicon glyphicon-user"></span> Đăng nhập|Đăng ký</a></li>
			<?php elseif(pzk_session('userId') >0 ):?>
			<li class="mgt15 colorh2">Xin chào ( <?php $data->displayChildren('[id=userAccountUser]') ?> )</li>
			<li><a  href="<?=BASE_REQUEST?>/account/logout">Thoát</a></li>
			<?php endif;?>
		  </ul>
		</div>
	</div>
</nav>
</div>
	<img class='col-xs-2 col-sm-1 col-md-1 pull-right sun2' src="<?= BASE_URL;?>/Default/skin/nobel/olympic/Themes/olympic/image/sun.png" alt="sun" />
	
	<img class='item' src="<?= BASE_URL;?>/Default/skin/nobel/olympic/Themes/olympic/image/header.png" alt="sun" />
	<ul class='col-xs-11 col-md-6 col-sm-8 info-home2'>
		<li>Phần mềm này hữu ích cho học sinh lớp 4, 5 ôn luyện chương trình tiếng việt cơ bản và nâng cao</li>
		<li>Giúp luyện thi chương trình "Trạng nguyên tiếng việt"</li>
	</ul>
	<div class='fix-buy'>
		<div class='item'>
			
				<a class = 'btn box-buy alert-dt w180 btn-primary'>Dùng thử</a>
				<a class ='btn box-buy w180 btn-primary'>Mua sản phẩm</a>
			
		</div>
	</div>
</div>
	
<div class='container-fuild item bg-white'>
	<div class="navbar navbar-default fix-menu" role="navigation">
		<div class="container pdl0">
			<div class="navbar-header">
				<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar2">
					<span class="sr-only">Toggle navigation</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>
			</div>
			<div id='myNavbar2' class="collapse navbar-collapse">
				<?php 
					$items = $data->getItems();
					$items = buildBs($items);
					
					$currentCategory = _db()->getTableEntity('categories')->load(pzk_request()->getSegment(3));
					$controller = pzk_request()->getController();
					$action = pzk_request()->getaction();
					
					if(isset($items[0])) {
				?>
				<style>
				.menu>li.ahome.active>a, .menu>li.active>a:focus{
					background: none;
					border-bottom: 2px solid #ff4b58;
					
				}
				.menu>li.ahome.active>a img, .menu>li.active>a:focus img{-webkit-filter: saturate(1);
					filter: saturate(1);}
				<?php 
				foreach($items[0] as $key => $val) {
				?>
				ul.menu li.d<?=$val['color'];?> ul li a{ color: #<?=$val['color'];?> !important; width: 100%;} 
				ul.menu li.d<?=$val['color'];?>:hover a{border-bottom: 2px solid #<?=$val['color'];?>;}
				
				
				.menu>li.d<?=$val['color'];?>.active>a, .menu>li.active>a:focus{
					background: none;
					border-bottom: 2px solid #<?=$val['color'];?>;
					
				}
				.menu>li.d<?=$val['color'];?>.active>a img, .menu>li.active>a:focus img{-webkit-filter: saturate(1);
					filter: saturate(1);}
				
				<?php } ?>
				
				</style>
				<ul class="nav item menu navbar-nav">
					<li class ="center ahome col-md-3 <?php if($controller =='Home' && $action =='index') { echo "active"; } ?>" >
					
						<a class ='font-menu ahome' style="color: #ff4b58 !important;"  href="/" >
						<img class='mgb10' src="<?= BASE_URL;?>/Default/skin/nobel/olympic/Themes/olympic/image/icon_home.png" /><br/>
						Home </a>
					</li>
				<?php
						foreach($items[0] as $key => $val) {
						$active = strpos($currentCategory->getParents(), ',' . $val['id'] . ',') !== false ? 'active': '';
				?>
					<li class=" col-md-3 center d<?=$val['color'];?> <?php echo "$active"; ?>">
					
					<a style="color: #<?=$val['color'];?> !important;" href="<?php if(SEO_MODE && @$val['alias']) { echo BASE_REQUEST.'/'.$val['alias']; } else { echo BASE_REQUEST.'/'.$val['router'].'/'.$val['id']; }?>" class="dropdown-toggle font-menu" > 
					<img class='center mgb10' src="<?= $val['img'];?>"/><br/>
						<?php echo $val['name']; ?> 
						<?php if(isset($items[$val['id']])) { ?>
							<b class="caret"></b>
						<?php } ?>
					</a>
						<?php if(isset($items[$val['id']])) { 	
						?>
						<ul class="dropdown-menu">
						<?php	
								$data2 = $items[$val['id']];
								foreach($data2 as $key => $val) {
								$active = strpos($currentCategory->getParents(), ',' . $val['id'] . ',') !== false ? 'active': '';
						?>
							<li <?php if(isset($items[$val['id']])) { ?> class="dropdown-submenu <?php echo $active;?>" <?php } else { echo "class='$active'"; } ?> >
								<a  <?php if(@$items[$val['id']]) { ?> data-toggle="dropdown" <?php } ?> 
								href="<?php
								if(substr($val['router'], 0, 5) == 'topic'){
									echo 'javascript:void(0)';
								}else {	
								if(SEO_MODE && @$val['alias']) { echo BASE_REQUEST.'/'.$val['alias']; } else { echo BASE_REQUEST.'/'.$val['router'].'/'.$val['id']; } }
								?>" class="dropdown-toggle" >
								<?php echo $val['name']; ?></a>
								<?php if(isset($items[$val['id']])) { 
									$data3 = $items[$val['id']];
									?>
									<ul class="dropdown-menu">
									<?php
									foreach($data3 as $key => $val) {
									$active = strpos($currentCategory->getParents(), ',' . $val['id'] . ',') !== false ? 'active': '';
								?>
									<li  <?php echo "class='$active'"; ?>>
									<a href="<?php if(SEO_MODE && @$val['alias']) { echo BASE_REQUEST.'/'.$val['alias']; } else { echo BASE_REQUEST.'/'.$val['router'].'/'.$val['id']; }?>">
									<?php echo $val['name']; ?></a>
									</li>
									<li class="divider"></li>
								<?php 
									unset($data3[$key]);
									} 
								?>
									</ul>
								<?php } ?>
							</li>
							<li class="divider"></li>
						<?php 
								unset($data2[$key]); 
								} 
						?>
						</ul>
						<?php
							} 
						?>
					</li>
					<li class="divider"></li>
				<?php 
						unset($items[0][$key]);
						} 
					} 
				?>
				</ul>
			</div><!--/.nav-collapse -->
		</div>
	</div>
	<script>
		function addcolor() {
			$('.bgtopheader').css('background', '#006344');
		}
		<?php 
		if(!@pzk_session('userId')) { ?>
			$('.alert-dt').click(function(){
				alert('Bạn cần đăng nhập trước');
				return false;
			});
		<?php }
		?>
	</script>
