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
<div class="container-fluid top-header">
	<div class="container fs15">
		<div class="row">
			<div class="col-md-3 2f2f60 col-xs-12">
				<img src="/Themes/Songngu3/skin/images/hostline.png" /> Hotline: <b>098.119.6146</b>
			</div>
			<div class="col-md-2 2f2f60 col-xs-12">
			
			<select class="select-top xs-w100p" onchange="select_lop(this.value);">
				
				<option <?php if(!$lop){ echo 'selected'; }?>>Chọn lớp</option>
				<?php for($i = 1; $i < 10; $i++){ ?>
					<option value="<?=$i;?>"  <?php if($lop == $i){ echo 'selected';} ?>><?=$language['class'].' '.$i; ?></option>
				<?php } ?>
				
	
			</select>
			
			</div>
			<div class="col-md-2 2f2f60 col-xs-12">
			
			 
			
			</div>
			<div class="col-md-5 col-xs-12 pdl0 topright">
				<a class="text-center btn btn-success" target="_blank" href="https://goo.gl/WrbZyL"> 
				Báo lỗi
				</a>
			<?php if(pzk_session('userId') <= 0):?>
				
				<a class="login_head text-center" href="javascript:void(0)" data-toggle="modal" data-target="#LoginModal"> 
				<img src="/Themes/Songngu3/skin/images/dangnhap.png" />
				 <?php echo $language['signin'];?> </a>
				<a class="register_head text-center" href="javascript:void(0)" data-toggle="modal" data-target="#RegisterModal"> 
				<img src="/Themes/Songngu3/skin/images/signin.png" /> <?php echo $language['signup'];?>
				</a>
				
			<!-- <a class="login_required_mobile">Đăng nhập - Đăng ký1</a> -->
			<?php elseif(pzk_session('userId') >0 ):?>
			
			<div class="btn-user"><?php $data->displayChildren('[id=userAccountUser]') ?><span class="caret"></span></div> 
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
				<a href="/"><img style="max-width: 70px;" src="/Themes/Hanoistar/skin/images/logo.png" /></a>
			</div>
			<div class="col-md-10 col-xs-12">
				<?php $data->displayChildren('[id=menu]') ?>	
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
