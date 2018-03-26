home_header = heredoc(function(){/*
<div class="container-fluid top-header">
	<div class="container fs15">
		<div class="row">
			<div class="col-md-3 2f2f60 col-xs-12">
				<img src="/themes/songngu3/skin/images/hostline.png" /> Hotline: <b>0965 90 91 95</b>
			</div>
			<div class="col-md-2 2f2f60 col-xs-12">
			
			<select onchange="selectLanguage(this.value);" class="select-top xs-w100p" >
				<option selected>Chọn ngôn ngữ</option>
				<option  value="vn" >Tiếng Việt</option>
				<option  value="en" >Tiếng Anh</option>
				<option  value="ev" >Song ngữ</option>
			</select>
			</div>
			<div class="col-md-2 2f2f60 col-xs-12">
			 
			<select class="select-top xs-w100p" onchange="selectClass(this.value);">
				
				<option value="">Chọn lớp</option>
				<option value="3" disabled >Lớp  3</option>
				<option value="4"  >Lớp  4</option>
				<option value="5" selected>Lớp  5</option>
			</select>
			</div>
			<div class="col-md-5 col-xs-12 pdl0 topright">
			
				<a  href="/home/detail?tab8=1">
				<img src="/themes/songngu3/skin/images/cart.png" />
				Mua ngay</a>
				<a  href="/home/payment">
				<img src="/themes/songngu3/skin/images/card.png" /> 
				Nạp thẻ</a>
				<a class="login_head text-center" href="javascript:void(0)" data-toggle="modal" data-target="#LoginModal"> 
				<img src="/themes/songngu3/skin/images/dangnhap.png" />
				 Đăng nhập </a>
				<a class="register_head text-center" href="javascript:void(0)" data-toggle="modal" data-target="#RegisterModal"> 
				<img src="/themes/songngu3/skin/images/signin.png" /> Đăng ký				</a>
				
			<!-- <a class="login_required_mobile">Đăng nhập - Đăng ký1</a> -->
						
			</div>
		</div>
	</div>
</div>
*/});

function selectLanguage(language) {
	alert(language);
}

function selectClass(classNum) {
	alert(classNum);
}

function checkLogin() {
	if(pzk.has('isLogined')) {
		return pzk.get('isLogined');
	} else {
		$.ajax({
			url: '/getUserInfo.php',
			type: 'post',
			dataType: 'json',
			async: false,
			success: function(userInfo) {
				if(userInfo) {
					pzk.set('isLogined', true);
					pzk.set('user', userInfo);
				} else {
					pzk.set('isLogined', false);
					pzk.set('user', false);
				}
			}
		})
	}
}

user_menu = heredoc(function() {/*
<div class="btn-user btn btn-info dropdown">	
	<span class="dropdown-toggle" data-toggle="dropdown" id="menu_user">
		<span class="color-white"><b class="user-name"></b></span>
	</span>
	<ul class="dropdown-menu col-xs-12 ">
		<li class="bdbottom bg-danger hidden-xs"><a href="#">Tài khoản :<span class="user-amount"></span>đ</a></li>
				<li class="bdbottom bg-danger hidden-xs"><a href="/home/about">Mua tài khoản</a></li>
		<li class="bg-danger"><a href="/Profile/detail">Trang cá nhân</a></li>
	</ul>
	<span class="caret"></span>
</div>
<a href="/account/logout">Thoát</a>
*/});

function load_header() {
	$('#page-content').append(home_header);
	checkLogin();
	if(pzk.get('isLogined')) {
		// remove login register
		$('.login_head').remove();
		$('.register_head').remove();
		// load user menu
		$('.top-header .topright').append(user_menu);
		var user = pzk.get('user');
		for(var key in user) {
			$('.user-'+key).text(user[key]);
		}
	} else {
		// load login dialog, register dialog
		pzk.load('/themes/songngu3/layouts/user/account/login.js');
		pzk.load('/themes/songngu3/layouts/user/account/register.js');
	}
}