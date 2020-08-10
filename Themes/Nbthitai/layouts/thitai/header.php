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
			
			<?php if(pzk_session('userId') <= 0):?>
			<li><a rel="/home/index" class="login_required" href="javascript:void(0)" data-toggle="modal" data-target=".bs-example-modal-lg"><span class="glyphicon glyphicon-user"></span> Đăng ký</a></li>
			<li><a rel="/home/index" class="login_required" href="javascript:void(0)" data-toggle="modal" data-target=".bs-example-modal-lg"><span class="glyphicon glyphicon-log-in"></span> Đăng nhập</a></li>
			<?php elseif(pzk_session('userId') >0 ):?>
			<li class="top10">Xin chào <button class="btn btn-success dropdown"><?php $data->displayChildren('[id=userAccountUser][position=user]') ?><span class="caret"></span></button></li>
			<li class="top4"><a  href="/api_account/logout?backHref=home/index">Thoát</a></li>
			<?php endif;?>
		  </ul>
		</div>
	</div>
</nav>
<div class="container header nbthitai-header top50">
	<div class="col-md-4 col-sm-4 col-xs-10 pull-right rmargin">
		<?php $data->displayChildren('[position=stat]') ?>
	</div>
</div>
<nav class="nav navbar navbar-default container nomg pdright0 mgmobile" role="navigation">
<?php $data->displayChildren('[position=menu]') ?>
</nav>

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