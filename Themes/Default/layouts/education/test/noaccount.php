<div class="container fulllook3 hidden-xs">
	<div class="row">
		<div class="col-md-1">&nbsp;</div>			
		<div class="col-xs-11 col-md-11 ">
			<div class="pd-20 text-center">
				<a href="<?=FL_URL?>"><h1>FULL LOOK</h1></a>	
				<h3 class="hidden-xs">Phần mềm Khảo sát và Phát triển năng lực toàn diện bằng tiếng Anh</h3>
				<?php echo partial('Themes/Default/layouts/home/aboutbtn');?>
			</div>
		</div>
	</div>
</div>
<div class="container top50 visible-xs">
	<div class="row">
		<div class="col-md-1">&nbsp;</div>			
		<div class="col-xs-11 col-md-11 ">
			<div class="pd-20 text-left">
				<a href="<?=FL_URL?>"><h1>FULL LOOK</h1></a>	
			</div>
		</div>
	</div>
</div>	
{children [position=top-menu]}
<?php if(!pzk_session('userId')){ ?>
<div class="container">
<div class="col-md-12 col-xs-12 bd-div bgclor form_search_test top10 bot20 imgbg">
			
			<form class="form_search_test" style="margin: 15px 0px" action="<?=BASE_REQUEST?>{doTestPostUrl}" method="post" onsubmit = "return check_select_test()">
				<div class="col-xs-12 border-question" style="z-index: 9">
					<div class="question_content pd-0 margin-top-20">
						<div class="clearfix margin-top-10">
							<div class="col-xs-12 pd-0">
								<h3 class="pd-top-15" style="width: 100%; text-align: center;">Bạn phải <a rel="{_SERVER[REQUEST_URI]}" class="login_required" data-toggle="modal" data-target=".bs-example-modal-lg" style="cursor:pointer;">Đăng nhập</a> thì mới được thi thử</h3>
							</div>
							<div class="col-xs-5 pd-0">
								
							</div>
						</div>
						<div class="margin-top-10">
							
						</div>
					</div>
				</div>
			</form>
		</div>	
		</div>
<?php } else { ?>

<div class="container">
	<div class="alert alert-warmning">Bạn cần mua tài khoản mới truy cập được. Xem hướng dẫn mua tài khoản <a href="/home/about">tại đây</a></div>
</div>
<?php } ?>