<footer class="container-fluid footer-color" style="padding-bottom: 60px; padding-top: 50px;">
	<div class="container">
		<div class="row top-25 visible-xs">
			<div class="col-xs-12 text-center">
				<span class="glyphicon glyphicon-earphone"></span>&nbsp;&nbsp;&nbsp;Hotline: 0919.56.36.11 / 0907.71.51.81
			</div>
		</div>
		<div class="row top-25 hidden-xs">
			<div class="col-xs-12 col-md-5 info mg-top text-left">
				<ul class="text-left" style="list-style-type: none;">
					<li><span class="glyphicon glyphicon-map-marker"></span>&nbsp;&nbsp;&nbsp;Địa chỉ: Nhà số 6, Ngõ 115 Nguyễn Khang, Cầu Giấy Hà Nội</li>
					<li><span class="glyphicon glyphicon-globe"></span>&nbsp;&nbsp;&nbsp;Website: tiengviettieuhoc.vn và tiengviettieuhoc.net</li>
					<li><span class="glyphicon glyphicon-envelope"></span>&nbsp;&nbsp;&nbsp;Email: happyway.jsc@gmail.com</li>
					<li><span class="glyphicon glyphicon-earphone"></span>&nbsp;&nbsp;&nbsp;Điện thoại: 0919.56.36.11 / 0907.71.51.81</li>
				</ul>
				
			</div>
			<div class="row col-xs-12 col-md-7 info2 mg-top">
				<div class="col-xs-6 col-md-3">
					<h4 style="margin-top: 0;margin-bottom: 0;"><a href="<?php echo HW_URL; ?>/gioi-thieu">Về chúng tôi</a></h4>
					<ul class="text-left" style="list-style-type: none; padding: 0;">
						<li><a href="<?php echo HW_URL; ?>/gioi-thieu-cong-ty">Chúng tôi là ai</a></li>
						<li><a href="<?php echo HW_URL; ?>/doi-ngu">Đội ngũ</a></li>
						<li><a href="<?php echo HW_URL; ?>/ve-san-pham">Về sản phẩm</a></li>
					</ul>
				</div>
				<div class="col-xs-6 col-md-3">
					<h4 style="margin-top: 0;margin-bottom: 0;"><a href="<?php echo HW_URL; ?>/thu-vien-anh">Thư viện ảnh</a></h4>
					<ul class="text-left" style="list-style-type: none; padding: 0;">
						<li><a href="<?php echo HW_URL; ?>/da-ngoai">Dã ngoại</a></li>
						<li><a href="<?php echo HW_URL; ?>/hoat-dong-tu-thien">Hoạt động từ thiện</a></li>
						<li><a href="<?php echo HW_URL; ?>/team-building">Team building</a></li>
					</ul>
				</div>
				<div class="col-xs-6 col-md-3">
					<h4 style="margin-top: 0;margin-bottom: 0;"><a href="<?php echo HW_URL; ?>/tin-tuc">Tin tức</a></h4>
					<ul class="text-left" style="list-style-type: none; padding: 0;">
						<li><a href="<?php echo HW_URL; ?>/tin-cong-ty">Tin công ty</a></li>
						<li><a href="<?php echo HW_URL; ?>/thoi-su-hoc-duong">Thời sự học đường</a></li>
					</ul>
					
				</div>
				<div class="col-xs-6 col-md-3">
				<h4 style="margin-top: 0;margin-bottom: 0;"><a href="<?php echo HW_URL; ?>/">Thống kê</a></h4>
				<?php $data->displayChildren('all') ?>
				</div>
				<div class="row">
					<div class="col-md-7">
						<form class="form-inline">
							<input type="email" class="form-control sharp" size="30%" placeholder="Your Email">
							<button type="button" class="btn btn-default sharp btn-custom2 ">Gửi</button>
						</form>
					</div>
					<div class="col-md-5">
						<a href="#">
							<i class="fa fa-facebook-official fa-3x"></i>
						</a>
						<a href="#">
							<i class="fa fa-twitter fa-3x" style="border-radius: 50%;"></i>
						</a>
						
						<a href="#">
							<i class="fa fa-google-plus-square fa-3x" style="border-radius: 50%;"></i>
						</a>
						<a href="#">
							<i class="fa fa-youtube-square fa-3x" style="border-radius: 50%;"></i>
						</a>
						<a href="#">
							<i class="fa fa-skype fa-3x" style="border-radius: 50%;"></i>
						</a>
						
					</div>
				</div>
			</div>
		</div>
		
		<div class="row top-25">
			<div class="col-xs-12 text-center">
				<p>
				MST: 0107658842 | 
				<a href="<?php  echo HW_URL?>/dieu-khoan-su-dung" style="color: #fff; text-decoration: underline;">Điều khoản sử dụng</a> | 
				<a href="<?php  echo HW_URL?>/chinh-sach-bao-mat" style="color: #fff; text-decoration: underline;">Chính sách bảo mật</a>
				
			</p>
			<h4 class="top-5 font-normal"><span class="glyphicon glyphicon-copyright-mark" aria-hidden="true"></span>2017 - Công Ty Cổ Phần Giáo Dục Happy Way. All Rights Reserved</h4>
			</div>
		</div>
	</div>
</footer>
<?php if(!DEBUG_MODE): ?>
<!--Start of Tawk.to Script-->
<script type="text/javascript">
var Tawk_API=Tawk_API||{}, Tawk_LoadStart=new Date();
(function(){
var s1=document.createElement("script"),s0=document.getElementsByTagName("script")[0];
s1.async=true;
s1.src='https://embed.tawk.to/56d905db5ef21b26679a3cfc/default';
s1.charset='UTF-8';
s1.setAttribute('crossorigin','*');
s0.parentNode.insertBefore(s1,s0);
})();
</script>
<!--End of Tawk.to Script-->
<?php endif; ?>