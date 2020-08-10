<?php $isHomepage = strtolower(pzk_request('controller')) == 'home' && strtolower
(pzk_request('action')) == 'index';?>
<div class="home-slide <?php if($isHomepage): echo 'homepage-banner auto-height'; else: echo 'tv4 auto-height-sub';  endif;?>">
	<?php echo pzk_theme_html_open_tag('container') ?>
		<div class="row <?php if($isHomepage):?>auto-top<?php else:?>auto-top-sub<?php endif;?>">
			<div class="<?php echo pzk_theme_css_class('banner-section')?>">
					<a href="/"><h1 class="<?php echo pzk_theme_css_class('site-title')?>">Phần Mềm Học - Luyện Tiếng Việt 4 <br />và Phát Triển Ngôn Ngữ</h1></a>
					<a class="font-normal hidden-xs" href="http://tiengviettieuhoc.vn/xem-thu-bai-giang-bai-tap-de-thi-trong-phan-mem"><h2 class="font-normal">Xem thử Phần mềm</h2></a>
					<p>
						<a href="/chi-tiet-san-pham" 	class="<?php echo pzk_theme_css_class('btn-about')?>">Về sản phẩm</a>
						<a href="/huong-dan-su-dung" 	class="<?php echo pzk_theme_css_class('btn-guide')?>">Hướng dẫn sử dụng</a>
						<a href="/huong-dan-mua" 		class="<?php echo pzk_theme_css_class('btn-buy')?>">Hướng dẫn mua</a>
					</p>
					<p>
						<a class="visible-xs" href="<?php echo HW_URL?>/xem-thu-bai-giang-bai-tap-de-thi-trong-phan-mem" 	>Xem thử phần mềm</a>
					</p>
				
			</div>
		</div>
	<?php echo pzk_theme_html_close_tag('container') ?>
</div>