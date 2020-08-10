<?php $contest = $data->get('contest'); 
?>
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
			<li class="top4"><a href="#">Hỗ trợ thanh toán: 0936 738 896</a></li>
			<li class="top4"><a href="#">Hỗ trợ thi: 0936 738 986, 0907715181, 0898463631</a></li>
			
			<?php if(pzk_session('userId') <= 0):?>
			<li><a rel="/contest/index" class="login_required" href="javascript:void(0)" data-toggle="modal" data-target=".bs-example-modal-lg"><span class="glyphicon glyphicon-user"></span> Đăng ký</a></li>
			<li><a rel="/contest/index" class="login_required" href="javascript:void(0)" data-toggle="modal" data-target=".bs-example-modal-lg"><span class="glyphicon glyphicon-log-in"></span> Đăng nhập</a></li>
			<?php elseif(pzk_session('userId') >0 ):?>
			<li class="top10">Xin chào <div class="btn btn-success dropdown"><?php $data->displayChildren('[id=userAccountUser][position=user]') ?><span class="caret"></span></div></li>
			<li class="top4"><a  href="/api_account/logout?backHref=contest/index">Thoát</a></li>
			<?php endif;?>
		  </ul>
		</div>
	</div>
</nav>
<div class="container header top50">
	<div class="col-md-4 col-sm-4 col-xs-10 pull-right rmargin">
		<?php $data->displayChildren('[position=stat]') ?>
	</div>
</div>
<nav class="nav navbar navbar-default container nomg pdright0 mgmobile" role="navigation">
	<ul class="nav nav-justified robotofont">
		<li class="dropdown bdr">
			<a href="<?=BASE_REQUEST;?>">Trang chủ</a>
		</li> 
		<li class="dropdown bdr2">
			<a href="<?=BASE_REQUEST;?>#">Về cuộc thi <span class="caret"></span></a>
			<ul class="dropdown-menu robotofont">
				<li><a href="<?=BASE_REQUEST;?>/contest/news/105">Giới thiệu cuộc thi</a></li>
				<li><a href="/contest/news/106">Đội ngũ ra đề và chấm</a></li>
				<li><a href="/contest/news/107">Tiện ích của gói thi thử</a></li>
				<li><a href="/contest/news/108">Giải thưởng</a></li>
				
				<li><a href="/contest/news/109">Hướng dẫn thi</a></li>
				<li><a href="/contest/dsthi">Danh sách thi</a></li>
				<li><a href="/contest/news/111">Chi tiết cuộc thi</a></li>
			</ul>
		</li> 
		<li class="dropdown bdr3">
			<a href="<?=BASE_REQUEST;?>/contest/dotest">Vào thi <span class="caret"></span></a>
			<ul class="dropdown-menu robotofont col-xs-12">
				<?php foreach($contest as $item) { ?>
				<li><a href="<?=BASE_REQUEST;?>/trytest/do/<?=$item['id'];?>"><?=$item['name'];?></a></li>
				<?php } ?>
			</ul>
		</li> 
		<li class="dropdown bdr5">
			<a href="<?=BASE_REQUEST;?>/contest/dotest">Kết quả thi <span class="caret"></span></a>
			<ul class="dropdown-menu robotofont col-xs-12">
				<?php foreach($contest as $item) { ?>
				<li><a href="<?=BASE_REQUEST;?>/trytest/showresult/<?=$item['id'];?>"><?=$item['name'];?></a></li>
				<?php } ?>
				
			</ul>
		</li>
		<li class="dropdown bdr4">
			<a href="<?=BASE_REQUEST;?>/contest/rating">Bảng xếp hạng <span class="caret"></span></a>
			<ul class="dropdown-menu robotofont col-xs-12">
			<?php foreach($contest as $item) { ?>
				<li><a href="<?=BASE_REQUEST;?>/contest/rating?camp=<?=$item['id'];?>"><?=$item['name'];?></a></li>
			<?php } ?>
				
			</ul>
		</li>
		<li class="dropdown bdr3">
			<a href="<?=BASE_REQUEST;?>/contest/rating">Đề và đáp án <span class="caret"></span></a>
			<ul style="width: 220px;" class="dropdown-menu robotofont col-xs-12">
			<?php foreach($contest as $item) { ?>
				<li><a href="<?=BASE_REQUEST;?>/trytest/showtest/<?=$item['id'];?>">Đề <?=$item['name'];?></a></li>
				<li><a href="<?=BASE_REQUEST;?>/trytest/showtestanswer/<?=$item['id'];?>">Đáp án <?=$item['name'];?></a></li>
			<?php } ?>
			</ul>
		</li>
		<li class="dropdown bdr5">
			<a href="<?=BASE_REQUEST;?>/contest/about">Nộp lệ phí thi</a>
		</li>
		<li class="dropdown bdr6">
			<a href="<?=BASE_REQUEST;?>/contest/onthi">Kinh nghiệm ôn thi</a>
		</li>
	</ul>
</nav>

<a href="http://luyenthitrandainghia.vn/bai-viet-Tai-sao-can-dung-Phan-mem-Full-Look-de-luyen-thi-vao-lop-6-Tran-Dai-Nghia-134.html"><div class="hbanner2 visible-lg visible-md" style='width:90px; position:fixed; right:0; top:53px; background-color:#0072BC; height:550px;'>
	<p style="color:white; fontsize:24px!important; text-align:center; margin-top:60px;">Phần<br/>mềm<br/>Full<br/>Look<br/>luyện<br/>thi<br/>vào<br/>lớp<br/>6<br/>Trần<br/>Đại<br/>Nghĩa<br/>hiệu<br/>quả</p>
</div></a>
<a href="/contest/news/111"><div class="hbanner2 visible-lg visible-md" style='width:90px; position:fixed; left:0; top:53px; background-color:#0072BC; height:550px;'>
	<p style="color:white; fontsize:24px!important; text-align:center; margin-top:60px;">Gói<br/>xem<br/>đề<br/>và<br/>đáp<br/>án<br/>thi<br/>thử<br/>trắc<br/>nghiệm<br/>và<br/>tự<br/>luận<br/>đợt<br/>1,2</p>
</div></a>

<script>
$(document).ready(function(){
    $('[data-toggle="popover"]').popover();   
});
</script>
<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-78990614-1', 'auto');
  ga('send', 'pageview');

</script>