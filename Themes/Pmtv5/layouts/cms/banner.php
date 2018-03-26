<?php $isHomepage = strtolower(pzk_request('controller')) == 'home' && strtolower
(pzk_request('action')) == 'index';?>
<div class="home-slide <?php if($isHomepage): echo 'homepage-banner auto-height'; else: echo 'homepage-banner auto-height-sub';  endif;?>">
	<div class="container">
		<div class="row <?php if($isHomepage):?>auto-top<?php else:?>auto-top-sub<?php endif;?>">
			<div class="col-xs-12 col-md-8 col-md-offset-2 text-left">
				<div class="hidden-xs">
					<a href="/" class="hidden-xs"><h1 class="auto-font-largest margin-0"><img src="/Themes/pmtv5/skin/media/site-title.png" /></h1></a>
					<a class="font-normal hidden-xs" href="http://tiengviettieuhoc.vn/xem-thu-bai-giang-bai-tap-de-thi-trong-phan-mem"><h2 class="font-normal">Xem thử Phần mềm</h2></a>
					<p>
						<a href="/chi-tiet-san-pham" class="btn btn-default sharp btn-custom top-10">Về sản phẩm</a>
						<a href="/huong-dan-su-dung" class="btn btn-default sharp btn-custom top-10">Hướng dẫn sử dụng</a>
						<a href="/home/about" class="btn btn-default sharp btn-custom top-10">Hướng dẫn mua</a>
					</p>
				</div>
				<div class="visible-xs">
					<a href="/"><strong class="margin-0"><img src="/Themes/pmtv5/skin/media/site-title.png" style="width: 50%; height: auto;" /></strong></a>
					<p>
						<a href="/chi-tiet-san-pham" class="btn btn-default btn-xs sharp btn-custom top-10">Về sản phẩm</a><br />
						<a href="/huong-dan-su-dung" class="btn btn-default btn-xs sharp btn-custom top-10">Hướng dẫn sử dụng</a><br />
						<a href="/home/about" class="btn btn-default btn-xs sharp btn-custom top-10">Hướng dẫn mua</a>
					</p>
				</div>
				
			</div>
		</div>
	</div>
</div>