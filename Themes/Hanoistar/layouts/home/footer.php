<img class="item" src="/Themes/Hanoistar/skin/images/bg_footer.png" >

<?php if(!pzk_request()->isMobileAndTablet()):?>
<style>
#hotnew{
	display:none; position:fixed; right:3px; bottom: 200px; 
	webkit-box-shadow: 1px 1px 10px 0px rgba(50, 50, 50, 0.75);
    -moz-box-shadow: 1px 1px 10px 0px rgba(50, 50, 50, 0.75);
    box-shadow: 1px 1px 10px 0px rgba(50, 50, 50, 0.75);
    background-color: #fff;
    background-position: bottom right;
	padding: 6px 10px;
	border-radius: 3px;
	webkit-border-radius: 3px;
	cursor: pointer;
}
</style>

<div onclick='return opentb();' id='hotnew' class='tinmoi hidden-xs'>Xem tin mới</div>
<div style="width: 320px; height: 270px;" class="alert alerttb newbox alert-dismissible hidden-xs">
  <button onclick='return closetb();' type="button" class="close" ><span aria-hidden="true">&times;</span></button>
  <div class='tinmoi'>
	&nbsp;&nbsp;--------------- <b class ='f16'>Mới</b> ------------<br/>
	<img src="<?=BASE_URL;?>/Default/skin/nobel/test/Themes/Default/media/star.png" />
  </div>
  <div class="w100p">
		<?php echo pzk_config('site_footer');?>
		<?php if(0): ?>
		<h3 style="color: red; font-weight: bold;" class="text-center">KHAI GIẢNG</h3>
		<H4 style="color: red;"><a href="http://tiengviettieuhoc.vn/dung-de-viet-van-la-noi-am-anh-cua-tre">LỚP LUYỆN VIẾT VĂN MIÊU TẢ & LỚP TIẾNG VIỆT</a></H4>
		<H5 style="color: red; text-align: center">18h - 20h Thứ 5 hàng tuần<br /> tại trường Ngôi Sao</H5>
		<H4><A HREF="https://goo.gl/forms/xnymL1sFqw0LR6tq2">NHẬN TƯ VẤN VÀ ĐĂNG KÝ HỌC THỬ TẠI ĐÂY</A></H4>
		<?php endif; ?>
  </div>
</div>
<script>
function closetb() {
	$('.alerttb').hide();
	$('#hotnew').show();
	localStorage.setItem("sessionAlert", "1");
}
function opentb() {
	$('.alerttb').show();
	$('#hotnew').hide();
}
$( document ).ready(function() {
    var check = localStorage.getItem("sessionAlert");
	if(check == 1) {
		$('.newbox').hide();
		$('#hotnew').show();
		setInterval(function(){ 
			localStorage.clear(); 
		}, 1800000);
	}
	
});
</script>
<?php endif; ?>

<?php if(0 && 1){ ?>
<?php $language = pzk_global()->getLanguage(); ?>

<footer class="container-fluid footer-color">
	<div class="container">
		<div class="row">
			<div class="col-xs-12 col-md-5 info mg-top text-left">
				<img class="mgb15" src="/Themes/Songngu3/skin/images/nextnobels.png" />
				<ul class="text-left">
					<li><?php echo $language['footer-adress'];?></li>
					<li>Website: Nextnobels.com</li>
					<li><?php echo $language['footer-tel'];?></li>
					<li>Hotline: 0936 738 986</li>
				</ul>
				<!--
				<form class="form-inline">
					<input type="email" class="form-control sharp" size="30%" placeholder="Your Email" required>
					<button type="button" class="btn btn-default sharp btn-custom2 ">Gửi</button>
				</form>-->
			</div>
			<div class="row col-xs-12 col-md-6 col-md-offset-1 info2 mg-top">
				<div class="col-xs-12 col-md-4">
					<h4><?php echo $language['aboutus'];?></h4>
					<ul class="text-left">
						<li><a href="<?php echo NOBEL_URL; ?>/ho-so-cong-ty"><?php echo $language['company-profile'];?></a></li>
						<li><a href="<?php echo NOBEL_URL; ?>/tam-nhin-su-menh-cong-ty"><?php echo $language['mission'];?></a></li>
						<li><a href="<?php echo NOBEL_URL; ?>/nguoi-sang-lap-cong-ty"><?php echo $language['founders'];?></a></li>
					</ul>
				</div>
				<div class="col-xs-12 col-md-4">
					<h4><a href="<?php echo NOBEL_URL; ?>"><?php echo $language['themedia'];?></a></h4>
					<ul class="text-left">
						<li><a href="<?php echo NOBEL_URL; ?>/giam-nhe-ganh-nang-hoc-tap-nho-phan-mem-song-ngu-anh-viet"><?php echo $language['newspapers'];?></a></li>
						<li><a href="<?php echo NOBEL_URL; ?>/fulllook-phan-mem-hoc-song-ngu-anh-viet"> <?php echo $language['flsoftware'];?></a></li>
						<li><a href="<?php echo NOBEL_URL; ?>"><?php echo $language['ontv'];?></a></li>
						<!--<li><a href="<?php echo NOBEL_URL; ?>/team-building">Team building</a></li>-->
					</ul>
				</div>
				<div class="col-xs-12 col-md-4">
					<h4><a href="<?php echo NOBEL_URL; ?>/tin-tuc"><?php echo $language['news'];?></a></h4>
					<ul class="text-left">
						<li><a href="<?php echo NOBEL_URL; ?>/tin-cong-ty"><?php echo $language['company-new'];?></a></li>
						<li><a href="<?php echo NOBEL_URL; ?>/thoi-su-hoc-duong"><?php echo $language['acadimic-new'];?></a></li>
					</ul>
					
				</div>
			</div>
		</div>
	</div>
	<div class="container">
		<div class="row">
			<div class="pos col-xs-12 col-md-8 col-md-offset-2 text-center">
			<p>
				<?php echo $language['taxcode'];?>: 0105898246 | 
				<a href="http://nextnobels.com/dieu-khoan-su-dung" style="color: #fff; text-decoration: underline;">
				<?php echo $language['terms-of-service'];?></a> | 
				<a href="http://nextnobels.com/chinh-sach-bao-mat" style="color: #fff; text-decoration: underline;"><?php echo $language['privacy'];?></a>
				
			</p>
			<h4 class="mg-top"><span class="glyphicon glyphicon-copyright-mark" aria-hidden="true"></span>2015 - <?php echo $language['company-name'];?>. All Rights Reserved</h4>
			</div>
			<div class="col-xs-2 col-md-2">&nbsp;</div>
		</div>
	</div>
	<div class="row text-center">
		<div class="col-xs-10 col-xs-offset-1 col-md-4 col-md-offset-4">
				<a href="http://online.gov.vn/HomePage/CustomWebsiteDisplay.aspx?DocId=29663"><img src="/Themes/Story/skin/media/bocongthuong.png" /></a>
			</div>
		<div class="col-xs-10 col-xs-offset-1 col-md-4 col-md-offset-4 mg-top social">
			<a href="#">
				<i class="fa fa-facebook-official fa-2x"></i>
			</a>
			<a href="#">
				<i class="fa fa-twitter fa-2x"></i>
			</a>
			<a href="#">
				<i class="fa fa-pinterest fa-2x"></i>
			</a>
			<a href="#">
				<i class="fa fa-google-plus-square fa-2x"></i>
			</a>
			<a href="#">
				<i class="fa fa-instagram fa-2x"></i>
			</a>
			<a href="#">
				<i class="fa fa-youtube-square fa-2x"></i>
			</a>
			<a href="#">
				<i class="fa fa-skype fa-2x"></i>
			</a>
			<a href="#">
				<i class="fa fa-linkedin-square fa-2x"></i>
			</a>
		</div>
	</div>
</footer>
<?php } ?>
<?php if(!DEBUG_MODE): ?>
<?php if(!pzk_request()->isMobileAndTablet()):?>
<!--Start of Tawk.to Script-->
<script type="text/javascript">
if(!mobileAndTabletcheck()) {
	var Tawk_API=Tawk_API||{}, Tawk_LoadStart=new Date();
	(function(){
	var s1=document.createElement("script"),s0=document.getElementsByTagName("script")[0];
	s1.async=true;
	s1.src='https://embed.tawk.to/56d905db5ef21b26679a3cfc/Default';
	s1.charset='UTF-8';
	s1.setAttribute('crossorigin','*');
	s0.parentNode.insertBefore(s1,s0);
	})();
}
</script>
<!--End of Tawk.to Script-->
<?php endif; ?>
<?php endif; ?>
<?php if(0 && pzk_request()->getSoftwareId() == 1 && pzk_request()->getSiteId() == 2 ): ?>
<div class="modal fade" id="bannerModal" role="dialog">
    <div class="modal-dialog">
		<div class="text-left" style="width: 825px;">
			<a class="glyphicon glyphicon-remove-circle" data-toggle="tooltip" title="Đóng" style="color: yellow; font-size: 28px; text-decoration: none; position: relative; top: 20px; right: 10px;" onclick="closePopup();"></a>
		</div>
	<!--
	  <a id="runningBanner" href="/chuong-trinh-qua-tang-mua-he-cua-phan-mem-full-look">
        <img src="/Default/images/FullLook-Ikem.jpg" />
	  </a>
	  <a id="thitaiBanner" href="http://thitai.vn">
        <img src="/Default/images/thitai_banner.jpg" />
	  </a>
      -->
	  <style>
		.box-right-title {
			float: left;
			width: 100%;
			margin-left: 0%;
		}
		.relative {
			position: relative;
		}
		.title-left2 {
			position: absolute;
			left: -5px;
			top: 0px;
		}
		.title-right2 {
			position: absolute;
			right: -5px;
			top: 0px;
		}
		a.title-box {
			display: block;
			margin: 0px;
			background: #009c54;
			color: white;
			text-align: center;
			padding: 4px 0px;
			font-size: 12px;
			width: 100%;
			height: 44px;
			overflow: hidden;
		}
		.responsiveImage {
			border: 5px solid #009c54;
		}
		.mgb20 {
			margin-bottom: 20px;
		}
	  </style>
	  <?php $data->displayChildren('all') ?>
	  <div class="box-right-title mgb20 relative hidden">
			<img class="title-left2" src="/Themes/thitai/skin/media/left-title.png">
			<a target="_blank" href="http://s1.nextnobels.com/banner/bannerPost?id=2&utm_source=&utm_campaign=" class="title-box"><h3 style="margin: 0;"> THƯ GỬI CÁC  FLKER MÙA THI 2016</h3></a>
			<img class="title-right2" src="/Themes/thitai/skin/media/right-title.png">
		</div>
		
	  <!--
	  <a target="_blank" onclick="$('#bannerModal').modal('hide');" href="http://nextnobels.com/thu-gui-cac-flker-mua-thi-2016-vao-tran-dai-nghia">
	  <img src="/Themes/thitai/skin/media/chucmung.jpg" />
	  </a>-->
	  
    </div>
  </div>
<script>
$(document).ready(function() {
	if(sessionStorage.getItem('closePopup') != '1') {
		if(window.location.pathname == '' || window.location.pathname == '/' )
			$('#bannerModal').modal('show');
	}
});
function closePopup() {
	$('#bannerModal').modal('hide');
	sessionStorage.setItem('closePopup', '1');
}
/*
var turnOnDate = new Date('2016-05-31 19:15:00');
if(turnOnDate.getTime() < serverMicroTime) {
	$('#runningBanner').hide();
	$('#thitaiBanner').show();
} else {
	$('#runningBanner').show();
	$('#thitaiBanner').hide();
}
*/
</script>
<?php endif;?>

<?php if(pzk_session()->getUserId() && (pzk_request()->getSoftwareId() ==1) && (pzk_session('email') =='' || pzk_session('phone') == '')): ?>



<?php endif; ?>

<?php
if(pzk_request()->getShowLogin()): ?>
<script type="text/javascript">
	$(function()
	{
		$('#RegisterModal').modal('show');
	});
</script>
<?php endif; ?>

<script type="text/javascript" async
  src="https://cdnjs.cloudflare.com/ajax/libs/mathjax/2.7.1/MathJax.js?config=TeX-MML-AM_CHTML">
  
</script>
<style>
	.MJXc-display{display: inline !important;}
</style>