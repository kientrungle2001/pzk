<?php if(!pzk_request()->isMobileAndTablet()):?>
{children [position=box-achievement]}
<?php endif; ?>
<div class="container top10">
<marquee>
Mọi hình ảnh được sử dụng trong phần mềm đều được sưu tầm từ nguồn Google trên Internet.
</marquee>
</div>
<footer class="container-fluid footer-color">
	<div class="container">
		<div class="row">
			<div class="col-xs-12 col-md-5 info mg-top text-left">
				<h1>NEXT NOBELS</h1>
				<ul class="text-left">
					<li>Địa chỉ: Nhà số 6, Ngõ 115 Nguyễn Khang, Cầu Giấy Hà Nội</li>
					<li>Website: Nextnobels.com</li>
					<li>Điện thoại: (04)8585 2525</li>
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
					<h4>Về chúng tôi</h4>
					<ul class="text-left">
						<li><a href="<?php echo NOBEL_URL; ?>/ho-so-cong-ty">Hồ sơ công ty</a></li>
						<li><a href="<?php echo NOBEL_URL; ?>/tam-nhin-su-menh-cong-ty">Tầm nhìn, sứ mệnh</a></li>
						<li><a href="<?php echo NOBEL_URL; ?>/nguoi-sang-lap-cong-ty">Người sáng lập</a></li>
					</ul>
				</div>
				<div class="col-xs-12 col-md-4">
					<h4><a href="<?php echo NOBEL_URL; ?>">Truyền thông nói về chúng tôi</a></h4>
					<ul class="text-left">
						<li><a href="<?php echo NOBEL_URL; ?>/bao-chi">Báo chí</a></li>
						<li><a href="<?php echo NOBEL_URL; ?>/fulllook-phan-mem-hoc-song-ngu-anh-viet">Truyền hình</a></li>
						<!--<li><a href="<?php echo NOBEL_URL; ?>/team-building">Team building</a></li>-->
					</ul>
				</div>
				<div class="col-xs-12 col-md-4">
					<h4><a href="<?php echo NOBEL_URL; ?>/tin-tuc">Tin tức</a></h4>
					<ul class="text-left">
						<li><a href="<?php echo NOBEL_URL; ?>/tin-cong-ty">Tin công ty</a></li>
						<li><a href="<?php echo NOBEL_URL; ?>/thoi-su-hoc-duong">Thời sự học đường</a></li>
					</ul>
					
				</div>
			</div>
		</div>
	</div>
	<div class="container">
		<div class="row">
			<div class="pos col-xs-12 col-md-8 col-md-offset-2 text-center">
			<p>
				MST: 0105898246 | 
				<a href="http://nextnobels.com/dieu-khoan-su-dung" style="color: #fff; text-decoration: underline;">Điều khoản sử dụng</a> | 
				<a href="http://nextnobels.com/chinh-sach-bao-mat" style="color: #fff; text-decoration: underline;">Chính sách bảo mật</a>
				
			</p>
			<h4 class="mg-top"><span class="glyphicon glyphicon-copyright-mark" aria-hidden="true"></span>2015 - Công Ty Cổ Phần Giáo Dục Phát Triển Trí Tuệ Và Sáng Tạo Next Nobels. All Rights Reserved</h4>
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
<?php if(pzk_request()->get('softwareId') == 1 && pzk_request()->get('siteId') == 1 ): ?>
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
	  {children all}
	  <div class="box-right-title mgb20 relative">
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

<?php if(pzk_session()->get('userId') && (pzk_request('softwareId') ==1) && (pzk_session('email') =='' || pzk_session('phone') == '')): ?>

<div class="pd-10 pdbot-100">
<form id="addinfo" class="login form-horizontal" onsubmit="updateInfo()" method="post">

<div id="modalAddinfo" class="modal fade  sharp" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
<div class="modal-backdrop fade in" style="height: 660px;"></div>
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">

        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>

        <h4 class="modal-title">Bạn cần bổ sung thêm thông tin để dùng thử phần mềm</h4>
      </div>
      <div class="modal-body">
        	<div class="row mgb15">
	      		<div class="col-md-4 col-sm-4 col-xs-4"><label for="email">Email :</label> <span class="validate">(*)</span></div>
		    	<div class="col-md-6 col-sm-6 col-xs-6"><input type="text" class="form-control sharp" id="addemail" name="email" placeholder="Email" data-toggle="tooltip" data-placement="top" title="Email của bạn"></div>
	      	</div>
			
			<div class="row">
				<div class="col-md-4 col-sm-4 col-xs-4"><label for="phone">Điện thoại :</label> <span class="validate">(*)</span></div>
		    	<div class="col-md-6 col-sm-6 col-xs-6"><input type="text" class="form-control sharp" id="addphone" name="phone" placeholder="Điện thoại" data-toggle="tooltip" data-placement="top" title="Điện thoại phải là số"></div>
			</div>
      </div>
      <div class="modal-footer">
         <button type="submit"  class="btn btn-primary">Lưu lại</button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
</form>
</div>
<script>
  $('#modalAddinfo').modal('show');
  /*$( "#modalAddinfo" ).dialog({
    dialogClass: "no-close",
    buttons: [{
        text: "OK",
        click: function() {
            $( this ).dialog( "close" );
        }
    }]
});*/
  function updateInfo() {
  	var addemail= $('#addemail').val();
  	var addphone= $('#addphone').val();
  	if(addemail=='' || addphone ==''){
  		alert(' Bạn phải điền đầy đủ thông tin');
  		return false;
  	}
      	$.ajax({
	        url:'/Profile/addInfo',
	        data: {
	          addemail:addemail,
	          addphone:addphone	          
	        },
	        success: function(result)
	        {
				$('#modalAddinfo').modal('hide');
	        }
        });
  }

</script>
<?php endif; ?>

<?php
if(pzk_request('showLogin')): ?>
<script type="text/javascript">
	$(function()
	{
		$('#RegisterModal').modal('show');
	});
</script>
<?php endif; ?>