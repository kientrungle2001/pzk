<div class="container user"></div>
<div class="container">
	<h4 class="text-center">Thông tin cá nhân</h4>
	<div class="row top20">
		<div class="co-md-4 col-xs-4 avatar">
			<img src="<?=BASE_SKIN_URL?>/Default/skin/nobel/test/Themes/Default/media/11.jpg" alt="trang cá nhân" class="img-circle center-block" style="width:120px; height:120px;">
			<a href="#"><button type="button" class="btn btn-default sharp btn-custom center-block top10">Đổi avatar</button></a>
		</div>
		<div class="co-md-8 col-xs-8">
			<ul class="list-unstyled">
				<li><strong>Họ và tên:</strong> Lê Trung Kiên</li>
				<li><strong>Nick name:</strong> Kienle</li>
				<li><strong>Ngày sinh:</strong> 02/02/2002</li>
				<li><strong>Giới tính:</strong> Nam</li>
				<li><strong>Địa chỉ:</strong> 123 Đường Ba Đình, Quận Ba Đình, TP Hà Nội</li>
				<li><strong>Trường:</strong> Tiểu học Trương Định</li>
				<li><strong>Thời hạn sản phẩm 1 năm</strong></li>
			</ul>
			<div class="btncon pull-right top20">
				<a href="#" ><button type="button" class="btn btn-primary sharp">Sửa thông tin</button></a>
				<a href="#"><button type="button" class="btn btn-default sharp btn-custom">Lưu</button></a>
				<a href="#"><button type="button" class="btn btn-default sharp btn-custom">Hủy</button></a>
			</div>
			<?php $data->displayChildren('all') ?>
		</div>
	</div>
</div>