<?php
$signActive = pzk_session('checkPayment');
$language = pzk_global()->get('language');
$languagevn = pzk_global()->get('languagevn');
$memberlang = pzk_session('paymentLanguages');
$lang = pzk_session('language');
$login = pzk_session('userId');
$lop = pzk_session('lop');
if(!$lop){
	$lop = pzk_session('lop', 5);
}
if(!$lang){
	$lang = pzk_session('lang', 'vn');
}
?>
<style>
	.logo img {
		width: auto;
		height: 53px;
	}
</style>
<div class="container-fluid top-header">
	<div class="container fs15">
		<div class="row">
			<div class="col-md-3 2f2f60 col-xs-12">
				<img src="/Themes/Songngu3/skin/images/hostline.png" /> Hotline: <b>0965 90 91 95</b>
			</div>
			<div class="col-md-2 2f2f60 col-xs-12">
			
			<select id="selectlang" onchange="setLang(this.value);" class="select-top xs-w100p hidden" >
				<option <?php if(!$lang){ echo 'selected'; }?>>Chọn ngôn ngữ</option>
				<option  value="vn" <?php if($lang == 'vn'){ echo 'selected';} ?>><?=$language['vn'];?></option>
				<option  value="en" <?php if($lang == 'en'){ echo 'selected';} ?>><?=$language['en'];?></option>
				<option  value="ev" <?php if($lang == 'ev'){ echo 'selected';} ?>><?=$language['ev'];?></option>
			</select>
			</div>
			<div class="col-md-2 2f2f60 col-xs-12">
			<?php if(pzk_user_special()){ ?>
			 <select class="select-top xs-w100p hidden" onchange="select_lop(this.value);">
				
				<option <?php if(!$lop){ echo 'selected'; }?>>Chọn lớp</option>
				<option value="3"  <?php if($lop == 3){ echo 'selected';} ?>><?=$language['class']; ?> 3</option>
				<option value="4"  <?php if($lop == 4){ echo 'selected';} ?>><?=$language['class']; ?> 4</option>
				<option value="5" <?php if($lop == 5){ echo 'selected';} ?>><?=$language['class']; ?> 5</option>
			</select>
			<?php } ?>
			</div>
			<div class="col-md-5 col-xs-12 pdl0 topright">
			
			<?php if(pzk_session('userId') <= 0):?>
				<a  href="/home/detail?tab8=1">
				<img src="/Themes/Songngu3/skin/images/cart.png" />
				<?php echo $language['buynow'];?></a>
				<a  href="/home/payment">
				<img src="/Themes/Songngu3/skin/images/card.png" /> 
				<?php echo $language['recharge'];?></a>
				<a class="login_head text-center" href="javascript:void(0)" data-toggle="modal" data-target="#LoginModal"> 
				<img src="/Themes/Songngu3/skin/images/dangnhap.png" />
				 <?php echo $language['signin'];?> </a>
				<a class="register_head text-center" href="javascript:void(0)" data-toggle="modal" data-target="#RegisterModal"> 
				<img src="/Themes/Songngu3/skin/images/signin.png" /> <?php echo $language['signup'];?>
				</a>
				
			<!-- <a class="login_required_mobile">Đăng nhập - Đăng ký1</a> -->
			<?php elseif(pzk_session('userId') >0 ):?>
			<a  href="/home/detail?tab8=1">
				<img src="/Themes/Songngu3/skin/images/cart.png" />
				<?php echo $language['buynow'];?></a>
				<a  href="/home/payment">
				<img src="/Themes/Songngu3/skin/images/card.png" /> 
				<?php echo $language['recharge'];?></a>
			<div class="btn-user">{children [id=userAccountUser]}<span class="caret"></span></div> 
			<a href="/account/logout" style="color: blue; font-weight: bold;"><?php echo $language['logout'];?></a> 
			
			<?php endif;?>
			
			</div>
		</div>
	</div>
</div>
<div class="container-fluid main-menu">
	<div class="container">
		<div class="row">
			<div class="col-md-2 col-xs-12">
				<a class="logo" href="/"><img src="<?php echo pzk_or(pzk_config('site_logo') ,'/Themes/Songngu3/skin/images/logo.png');?>" /></a>
			</div>
			<div class="col-md-10 col-xs-12">
				{children [id=menu]}	
			</div>
		</div>
	</div>
</div>


<script>

	$(document).ready(function(){
		// Show the Modal on load
		$(".ChoiceClass").modal("show");
		$(".showpopup").slideDown();
		// Hide the Modal
		$("#myBtn").click(function(){
			$(".ChoiceClass").modal("hide");
		});
	});
	
	function select_en(){
		<?php if(!$memberlang || $memberlang == 'ev' || $memberlang == 'en') { ?>
				$.ajax({url: "/Language/en", success: function(result){window.location.reload();}
			});
		<?php }elseif($memberlang == 'vn'){ ?>
				alert('Bạn cần mua gói Tiếng Anh hoặc Song Ngữ để thực hiện thao tác này');
		<?php 	} ?>
		
	}
	function select_vn(){
		<?php if(!$memberlang || $memberlang == 'ev' || $memberlang == 'vn') { ?>
				$.ajax({url: "/Language/vn", success: function(result){window.location.reload();}
			});
		<?php }elseif($memberlang == 'en'){ ?>
				alert('Bạn cần mua gói Tiếng Việt hoặc Song Ngữ để thực hiện thao tác này');
		<?php 	} ?>
		

		
	}
	function select_ev(){
		<?php if($memberlang == 'en' || $memberlang == 'vn') { ?>
				alert('Bạn cần mua gói Song Ngữ để thực hiện thao tác này');
		<?php }elseif(!$memberlang || $memberlang == 'ev'){ ?>
				$.ajax({url: "/Language/ev", success: function(result){window.location.reload();}
		});
		<?php 	} ?>
		

		
	}
	function setLang(lang){
		if(lang == 'vn'){
			select_vn();
		}else if(lang == 'en'){
			select_en();
		}else if(lang == 'ev'){
			select_ev();
		}
	}
	function select_lop(lop){
		<?php if(!pzk_user_special()): ?>
		if(lop == 4){
			alert('Học sinh lớp 4 (2016 -2017) có thể sử dụng chương trình lớp 5 trong hè (2017)');
			return false;
		}
		<?php endif;?>
		
		$.ajax({
			url: "/Phanlop/lop", 
			data:{lop:lop}, 
			success: function(result){
				window.location = window.location.href.replace(/class-[\d]/,'class-'+lop);
			}
		});
		
	}
	$(".trial").click(function(){
		<?php if(!pzk_session('userId')): ?>
			window.location = BASE_REQUEST+'/home/index?showLogin=1'
		<?php endif; ?>
	});
	function comming(lop){
		<?php if(pzk_user_special()){ ?>
			$.ajax({url: "/Phanlop/lop", data:{lop:lop}, success: function(result){window.location = window.location.href.replace(/class-[\d]/,'class-'+lop);}
			});
		<?php }else{ ?>
			alert('Sản phẩm sắp ra mắt !');
		<?php } ?>
	}
</script>
