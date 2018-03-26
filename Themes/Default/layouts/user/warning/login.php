<div class="container fulllook3">
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
{children [position=top-menu]}
<div class='container'>		
	<div class="col-md-10 col-xs-10 bd-div bgclor form_search_test top10 bot20 imgbg col-md-offset-1">
		<form class="form_search_test" style="margin: 15px 0px"  method="post" onsubmit="return check_select_test()">
			<div class="col-xs-12 border-question" style="z-index: 9">
				<div class="question_content pd-0 margin-top-20">
					<div class="clearfix margin-top-10">
						<div class="col-xs-12 pd-0">
							<h3 class="pd-top-15" style="width: 100%; text-align: center;">Bạn phải <a rel="<?=$_SERVER["REQUEST_URI"];?>" class="login_required" data-toggle="modal" data-target=".bs-example-modal-lg" style="cursor:pointer;">Đăng nhập</a> thì mới truy cập được</h3>
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