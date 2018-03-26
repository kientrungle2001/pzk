<?php
	$language = pzk_global()->get('language');
	$lang = pzk_session('language');
?>
<div class="container hidden-xs">
	<div id="slidebootstrap" class="carousel slide text-center" data-ride="carousel">
		<div class="carousel-inner" role="listbox">	
			<div class="row item active">
				<div class="col-sm-4  col-sm-offset-1 col-md-offset-1 col-md-4">
				  <div class="thumbnail">
					<div class="img-circle" style="display: inline-block; width: 80px; height: 80px; overflow: hidden;">
						<img src="<?=BASE_SKIN_URL?>/Default/skin/nobel/Themes/Story/media/11.jpg" alt="Sandy" style="width:80px;">
					</div>
					<p class="text-justify"><i class="fa fa-quote-left fa-2x"></i><?php echo $language['sandra_comment'];?><br>
					<?php if($lang == 'ev'){ echo '<i>Một phần mềm bắt kịp xu hướng đổi mới của nền Giáo dục, đó là xu hướng dạy học, kiểm tra đánh giá theo hướng phát triển năng lực của học sinh. Cái hay nhất của nó là tất cả những nội dung ấy được diễn đạt bằng thứ tiếng Anh vừa đơn giản, vừa chuẩn mực.</i><br>';}?>
					<strong><?php echo $language['sandra'];?></strong><i class="fa fa-quote-right fa-2x"></i></p>
				  </div>
				</div>
				<div class="col-sm-4  col-sm-offset-2 col-md-offset-2 col-md-4">
					<div class="thumbnail">
						<div class="img-circle" style="display: inline-block; width: 80px; height: 80px; overflow: hidden;">
							<img src="<?=BASE_SKIN_URL?>/Default/skin/nobel/Themes/Story/media/12.jpg" alt="Anh Tùng" style="width:80px;">
						</div>
      
						<p class="text-justify"><i class="fa fa-quote-left fa-2x"></i> <?php echo $language['mrtung_comment'];?><br>
						<strong><?php echo $language['mrtung'];?></strong><i class="fa fa-quote-right fa-2x"></i>
						</p>
					</div>
				</div>
			</div>
			<div class="row item">
				<div class="col-sm-4  col-sm-offset-1 col-md-offset-1 col-md-4">
				  <div class="thumbnail">
					<div class="img-circle" style="display: inline-block; width: 80px; height: 80px; overflow: hidden;">
						<img src="<?=BASE_SKIN_URL?>/Default/skin/nobel/Themes/Story/media/chinga.png" alt="chị Nga" style="width:80px;">
					</div>
					<p class="text-justify"><i class="fa fa-quote-left fa-2x"></i><?php echo $language['nga_comment'];?><br>
					<strong><?php echo $language['nga'];?></strong><i class="fa fa-quote-right fa-2x"></i></p>
				  </div>
				</div>
				<div class="col-sm-4  col-sm-offset-2 col-md-offset-2 col-md-4">
					<div class="thumbnail">
						<div class="img-circle" style="display: inline-block; width: 80px; height: 80px; overflow: hidden;">
							<img src="<?=BASE_SKIN_URL?>/Default/skin/nobel/Themes/Story/media/chihuyen.jpg" alt="Chị Huyền" style="width:80px;">
						</div>
      
						<p class="text-justify"><i class="fa fa-quote-left fa-2x"></i> <?php echo $language['huyen_comment'];?><br>
						<strong><?php echo $language['huyen'];?></strong><i class="fa fa-quote-right fa-2x"></i>
						</p>
					</div>
				</div>
			</div>
			<div class="row item">
				<div class="col-sm-4  col-sm-offset-1 col-md-offset-1 col-md-4">
				  <div class="thumbnail">
					<div class="img-circle" style="display: inline-block; width: 80px; height: 80px; overflow: hidden;">
						<img src="<?=BASE_SKIN_URL?>/Default/skin/nobel/Themes/Story/media/anh.png" alt="chị Nga" style="width:80px;">
					</div>
					<p class="text-justify"><i class="fa fa-quote-left fa-2x"></i><?php echo $language['anh_comment'];?><br>
					<strong><?php echo $language['anh'];?></strong><i class="fa fa-quote-right fa-2x"></i></p>
				  </div>
				</div>
				<div class="col-sm-4  col-sm-offset-2 col-md-offset-2 col-md-4">
					<div class="thumbnail">
						<div class="img-circle" style="display: inline-block; width: 80px; height: 80px; overflow: hidden;">
							<img src="<?=BASE_SKIN_URL?>/Default/skin/nobel/Themes/Story/media/duc.png" alt="Chị Huyền" style="width:80px;">
						</div>
      
						<p class="text-justify"><i class="fa fa-quote-left fa-2x"></i> <?php echo $language['duc_comment'];?><br>
						<strong><?php echo $language['duc'];?></strong><i class="fa fa-quote-right fa-2x"></i>
						</p>
					</div>
				</div>
			</div>
			<div class="row item">
				<div class="col-sm-4  col-sm-offset-1 col-md-offset-1 col-md-4">
				  <div class="thumbnail">
					<div class="img-circle" style="display: inline-block; width: 80px; height: 80px; overflow: hidden;">
						<img src="<?=BASE_SKIN_URL?>/Default/skin/nobel/Themes/Story/media/hang.png" alt="chị Hằng" style="width:80px;">
					</div>
					<p class="text-justify"><i class="fa fa-quote-left fa-2x"></i><?php echo $language['hang_comment'];?><br>
					<strong><?php echo $language['hang'];?></strong><i class="fa fa-quote-right fa-2x"></i></p>
				  </div>
				</div>
				<div class="col-sm-4  col-sm-offset-2 col-md-offset-2 col-md-4">
					<div class="thumbnail">
						<div class="img-circle" style="display: inline-block; width: 80px; height: 80px; overflow: hidden;">
							<img src="<?=BASE_SKIN_URL?>/Default/skin/nobel/Themes/Story/media/cong.png" alt="Anh Công" style="width:80px;">
						</div>
      
						<p class="text-justify"><i class="fa fa-quote-left fa-2x"></i> <?php echo $language['cong_comment'];?><br>
						<strong><?php echo $language['cong'];?></strong><i class="fa fa-quote-right fa-2x"></i>
						</p>
					</div>
				</div>
			</div>
		</div>
		<!-- Left and right controls -->
		  <a class="left carousel-control" href="#slidebootstrap" role="button" data-slide="prev">
			<span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
			<span class="sr-only">Previous</span>
		  </a>
		  <a class="right carousel-control" href="#slidebootstrap" role="button" data-slide="next">
			<span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
			<span class="sr-only">Next</span>
		  </a>
	</div>
</div>
<div class="container visible-xs">
	<div id="slidebootstrap-mb" class="carousel slide text-center" data-ride="carousel">
		<div class="carousel-inner" role="listbox">	
			<div class="row item active">
				<div class="col-xs-12">
					<div class="thumbnail">
						<div class="img-circle" style="display: inline-block; width: 80px; height: 80px; overflow: hidden;">
							<img src="<?=BASE_SKIN_URL?>/Default/skin/nobel/Themes/Story/media/11.jpg" alt="Sandy" style="width:80px;">
						</div>
						<p class="text-justify"><i class="fa fa-quote-left fa-2x"></i> <?php echo $language['sandra_comment'];?><br>
						<strong><?php echo $language['sandra'];?></strong><i class="fa fa-quote-right fa-2x"></i></p>
					</div>
				</div>
			</div>
			<div class="row item">
				<div class="col-xs-12">
					<div class="thumbnail">
						<div class="img-circle" style="display: inline-block; width: 80px; height: 80px; overflow: hidden;">
							<img src="<?=BASE_SKIN_URL?>/Default/skin/nobel/Themes/Story/media/12.jpg" alt="Anh Tùng" style="width:80px;">
						</div>
						<p class="text-justify"><i class="fa fa-quote-left fa-2x"></i> <?php echo $language['mrtung_comment'];?><br>
						<strong><?php echo $language['mrtung'];?></strong><i class="fa fa-quote-right fa-2x"></i>
						</p>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>