<div class="row box news-box">
    <div class="box-inner col-xs-12">
	<h3 class="text-center text-uppercase font-large color-white bgcolor1-bold padding-10">Đăng ký mua sản phẩm</h3>
	<div class="box-content border-purple">
	<div class="row">
		<div class="col-sm-8 text-center">
			<img class="text-center img-responsive" src="/Themes/pmtv/skin/media/slide/slide4.png" />
		</div>
		<div class="col-sm-4">
			<form class="form" method="post"  action="/support/subscribe" >
			<h2 class="text-center text-uppercase font-large">Đăng ký mua sản phẩm</h2>
			<?php echo @$data->get('error'); ?>
			   <div class="form-group">
					<input class="form-control" placeholder="Họ và tên" type="text" name="name" value="">
				</div>
				<div class="form-group">
					<input class="form-control" placeholder="Sản phẩm muốn mua" type="text" name="email" value="">
				</div>
				<div class="form-group">
					<input class="form-control" placeholder="Số điện thoại" type="text" name="phone" value="">
				</div>
				<div class="form-group">
					<input class="form-control" placeholder="Địa chỉ nhà" type="text" name="class" value="">
				</div>
			  <div class="text-center">
			  <button type="submit" class="btn btn-danger color-white text-uppercase">Gửi Đăng ký</button>
			  </div>
			  
			</form>
		</div>
	</div>
	<div class="text-center top-20">
		<img class="text-center img-responsive" src="/Themes/pmtv/skin/media/slide/slide3.png" />
	</div>
	</div>
	</div>
</div>