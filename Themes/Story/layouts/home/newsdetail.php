<div class="container nextnobels2 text-center">
</div>
<?php $data->displayChildren('[position=breadcrumb]') ?>
<div class="container bot20">
	<div class="col-md-9 col-sm-9 col-xs-12">
		<?php $data->displayChildren('[position=newscontent]') ?>
	</div>
	<div class="col-md-3 col-sm-3 col-xs-12" style="margin-right:-10px;">
		<a href="<?php echo FL_URL; ?>">
			<div class="full mgright20 robotofont">
				<img class="image-responsive center-block" src="<?=BASE_SKIN_URL?>/Default/skin/nobel/test/Themes/Default/media/full.png">
				<p class="text-center top10"><strong>FULL LOOK</strong></p>
				<p class="text-center hidden-sm">(Phần mềm khảo sát năng lực toàn diện bằng tiếng Anh)</p>
			</div>
		</a>
		<a href="<?php echo NOBEL_URL; ?>">
			<div class="full top20 mgright20 robotofont">
				<img class="image-responsive center-block" src="<?=BASE_SKIN_URL?>/Default/skin/nobel/test/Themes/Default/media/vietvan.png">
				<p class="text-center top10"><strong>LUYÊN VIẾT VĂN MIÊU TẢ</strong></p>
				<p class="text-center hidden-sm">(Dành cho HS lớp 3,4,5,6)</p>
			</div>
		</a>
		<a href="<?php echo NOBEL_URL; ?>">
			<div class="full top20 mgright20 robotofont">
				<img class="image-responsive center-block" src="<?=BASE_SKIN_URL?>/Default/skin/nobel/test/Themes/Default/media/khaosat.png">
				<p class="text-center top10"><strong>TIẾNG VIỆT VUI</strong></p>
				<p class="text-center hidden-sm">( Phần mềm ôn tập chương trình TV Tiểu học)</p>
			</div>
		</a>
	</div> 
</div>
<div class="container ">
	<p class="t-weight text-center btnclick btn-custom8 textcl">Các tin liên quan</p>
</div>
<div class="container ">
<?php $data->displayChildren('[position=catenews]') ?>
</div>