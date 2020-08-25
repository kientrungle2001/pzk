<?php 
$signActive = pzk_session('checkPayment');
$language = pzk_global()->getLanguage();
$languagevn = pzk_global()->getLanguagevn();
$memberlang = pzk_session('paymentLanguages');
$lang = pzk_session('language');
$login = pzk_session('userId');
$lop = pzk_session('lop');
if(!$lop){
	$lop = pzk_session('lop', 5);
}

?>

<style>
/* Bounce To Bottom */
.hvr-bounce-to-bottom {
  display: inline-block;
  vertical-align: middle;
  -webkit-transform: perspective(1px) translateZ(0);
  transform: perspective(1px) translateZ(0);
  box-shadow: 0 0 1px transparent;
  position: relative;
  -webkit-transition-property: color;
  transition-property: color;
  -webkit-transition-duration: 0.5s;
  transition-duration: 0.5s;
}
.hvr-bounce-to-bottom:before {
  content: "";
  position: absolute;
  z-index: -1;
  top: 0;
  left: 0;
  right: 0;
  bottom: 0;
  background: #2098D1;
  -webkit-transform: scaleY(0);
  transform: scaleY(0);
  -webkit-transform-origin: 50% 0;
  transform-origin: 50% 0;
  -webkit-transition-property: transform;
  transition-property: transform;
  -webkit-transition-duration: 0.5s;
  transition-duration: 0.5s;
  -webkit-transition-timing-function: ease-out;
  transition-timing-function: ease-out;
}
.hvr-bounce-to-bottom:hover, .hvr-bounce-to-bottom:focus, .hvr-bounce-to-bottom:active {
  color: white;
}
.hvr-bounce-to-bottom:hover:before, .hvr-bounce-to-bottom:focus:before, .hvr-bounce-to-bottom:active:before {
  -webkit-transform: scaleY(1);
  transform: scaleY(1);
  -webkit-transition-timing-function: cubic-bezier(0.52, 1.64, 0.37, 0.66);
  transition-timing-function: cubic-bezier(0.52, 1.64, 0.37, 0.66);
}
.modalfish{
	background: url('/Themes/Phanlop/skin/media/bg_popup.png');
	background-size: 100%;
}
</style>
<div class="container songnguheader3 hidden-xs">
	<div class="row">		
		<div class="col-xs-12 col-md-11 col-md-offset-1 col-sm-12 ">
			<div class="row pd-20 text-left">
				<h2 class="col-md-10 col-md-offset-2 col-sm-10 col-sm-offset-2"><a href="<?=FLSN_URL?>"><strong>FULL LOOK(SONG NGỮ)</strong></a></h2>
				<h3 class="col-md-10 col-md-offset-2 col-sm-10 col-sm-offset-2" style="margin-top:5px; color:#2098D1;">Phần mềm học Song ngữ Anh - Việt phát triển năng lực toàn diện cho học sinh lớp 4, 5</h3>
				<!--div class="col-md-10 col-md-offset-2 col-sm-10 col-sm-offset-2 col-xs-12">
					<div class="col-md-3 col-sm-3 col-xs-4 hvr-bounce-to-bottom bot10"  rel="#A0D4CE" onclick="comming(3);" style="height:50px; cursor:pointer;">
						<div class="col-md-4"><img src="/Themes/Phanlop/skin/media/concua.png" /></div>
						<div class="col-md-8 top10"><h4><strong>Lớp 3</strong></h4></div>
					</div>
					<div class="col-md-3 col-sm-3 col-xs-4 hvr-bounce-to-bottom bot10"  rel="#B6D452"  onclick="comming(4);" style="height:50px; cursor:pointer;">
						<div class="col-md-4"><img src="/Themes/Phanlop/skin/media/saobien.png" /></div>
						<div class="col-md-8 top10"><h4><strong>Lớp 4</strong></h4></div>
					</div>
					<div class="col-md-3 col-sm-3 col-xs-4 hvr-bounce-to-bottom bot10" rel="#E0C7A3" onclick="select_lop(5);" style="height:50px; cursor:pointer;">
						<div class="col-md-4"><img src="/Themes/Phanlop/skin/media/concua.png" /></div>
						<div class="col-md-8 top10"><h4><strong>Lớp 5</strong></h4></div>
					</div>
				</div-->
				<div class="btncon col-md-10 col-md-offset-2 col-sm-10 col-sm-offset-2 text-left" style="margin-right:-10px;">
					<?php if(!$signActive && !$login) { ?>
					<button  type="button" href="#" onclick="return false;" class="btn btn-default sharp btn-info trial" <?php if($lang == 'ev'){
					echo 'title="'.$languagevn['trial'].'"'; }?>><span class="glyphicon glyphicon-play"></span> <?php echo $language['trial'];?></button>
					<?php } ?>
					<a href="/home/detail"><button  type="button" class="btn btn-default sharp btn-danger" <?php if($lang == 'ev'){
					echo 'title="'.$languagevn['detail'].'"'; }?>><span class="glyphicon glyphicon-star"></span> <?php echo $language['detail'];?></button></a>
					<a href="/home/about"><button  type="button" class="btn btn-default sharp btn-warning" <?php if($lang == 'ev'){
					echo 'title="'.$languagevn['buy'].'"'; }?>><span class="glyphicon glyphicon-shopping-cart"></span> <?php echo $language['buy'];?></button></a>
					<a href="/huong-dan-su-dung-song-ngu"><button type="button" class="btn sharp  btn-success" <?php if($lang == 'ev'){
					echo 'title="'.$languagevn['usage-title'].'"'; }?>><span class="glyphicon glyphicon-info-sign"></span> <?php echo $language['usage'];?></button></a>
				</div>
				
				<div class="col-md-8 col-sm-12 col-xs-12 col-md-offset-2 top20" >
				<div class='item' style="background: white; border: 1px solid gray;">
					<div class="col-md-3 col-sm-3">
					   <p class="top10 text-center" style="font-size:12px;"><strong><?php echo $language['display'];?>:</strong></p>
					</div>
					<div class="col-md-9 col-sm-9 text-center" style="font-size:12px;">
    					<a href="#" onclick="select_en(); return false;"><div class="col-md-4 col-sm-4 col-xs-4 top10">
    						<img style="width:20px; height:20px;" src="<?=BASE_SKIN_URL?>/Themes/songngu/skin/media/en.png" title="English"/><span class="hidden-xs"><strong> <?php echo $language['en'];?></strong></span>
    					</div></a>
    					<a href="#" onclick="select_vn(); return false;"><div class="col-md-4 col-sm-4 col-xs-4 top10">
    						<img style="width:20px; height:20px;" src="<?=BASE_SKIN_URL?>/Themes/songngu/skin/media/vn.png" title="Việt Nam"/><span class="hidden-xs"><strong> <?php echo $language['vn'];?></strong></span>
    					</div></a>
    					<a href="#" onclick="select_ev(); return false;"><div class="col-md-4 col-sm-4 col-xs-4 top10">
    						<img style="width:20px; height:20px;" src="<?=BASE_SKIN_URL?>/Themes/songngu/skin/media/ev.png" title="Song Ngữ"/><span class="hidden-xs"><strong> <?php echo @$language['ev']?></strong></span>
    					</div></a>
					</div>
				</div>
				</div>
			</div>
		</div>
	</div>
</div>
<div class="container visible-xs top50">
	<a href="<?=FLSN_URL?>"><h2 class="text-center">FULL LOOK </br>SONG NGỮ</h2></a>
    <h4 class="text-center"><?php echo $language['class5'];?></h4>
	<div class="btncon col-xs-12 text-center">
		<?php if(!$signActive && !$login) { ?>
		<button  type="button" href="#" onclick="return false;"class="btn btn-default sharp btn-info trial" <?php if($lang == 'ev'){
		echo 'title="'.$languagevn['trial'].'"'; }?>><?php echo $language['trial'];?></button>
		<?php } ?>
		<a href="/home/about"><button  type="button" class="btn btn-default sharp btn-danger" <?php if($lang == 'ev'){
		echo 'title="'.$languagevn['detail'].'"'; }?>><span class="<?php if(!pzk_session('checkPayment')){ echo "hidden-xs"; }?>"><?php echo $language['detail'];?></span><?php if(!pzk_session('checkPayment')) { ?> <?php echo $language['buy'];?><?php } ?></button></a>
		<a href="/huong-dan-su-dung-song-ngu"><button type="button" class="btn sharp  btn-warning" <?php if($lang == 'ev'){
		echo 'title="'.$languagevn['usage-title'].'"'; }?>><?php echo $language['usage'];?></button></a>
	</div>
	<div class="col-xs-12 top20 text-center" style="background: white; border: 1px solid gray;">
		<p class="top10"><strong><?php echo $language['display'];?>:</strong></p>
		<a href="#" onclick="select_en(); return false;"><div class="col-md-4 col-sm-4 col-xs-4">
			<img style="width:20px; height:20px;" src="<?=BASE_SKIN_URL?>/Themes/songngu/skin/media/en.png" title="English"/><span class="hidden-xs"> <?php echo $language['en'];?></span>
		</div></a>
		<a href="#" onclick="select_vn(); return false;"><div class="col-md-4 col-sm-4 col-xs-4">
			<img style="width:20px; height:20px;" src="<?=BASE_SKIN_URL?>/Themes/songngu/skin/media/vn.png" title="Việt Nam"/><span class="hidden-xs"> <?php echo $language['vn'];?></span>
		</div></a>
		<a href="#" onclick="select_ev(); return false;"><div class="col-md-4 col-sm-4 col-xs-4 bot10">
			<img style="width:20px; height:20px;" src="<?=BASE_SKIN_URL?>/Themes/songngu/skin/media/ev.png" title="Song Ngữ"/><span class="hidden-xs"> <?php echo @$language['ev']?></span>
		</div></a>
	</div>
	<div class="col-md-10 col-md-offset-2 col-sm-10 col-sm-offset-2 col-xs-12">
		<div class="col-md-3 col-sm-3 col-xs-4 bot10"  rel="#A0D4CE" onclick="comming(3);" style="height:50px; cursor:pointer;">
			<div class="col-md-4 hidden-xs"><img src="/Themes/Phanlop/skin/media/concua.png" /></div>
			<div class="col-md-8 top10"><button class="btn btn-success"><h5><strong>Lớp 3</strong></h5></button></div>
		</div>
		<div class="col-md-3 col-sm-3 col-xs-4 bot10"  rel="#B6D452"  onclick="comming(4);" style="height:50px; cursor:pointer;">
			<div class="col-md-4 hidden-xs"><img src="/Themes/Phanlop/skin/media/saobien.png" /></div>
			<div class="col-md-8 top10"><button class="btn btn-success"><h5><strong>Lớp 4</strong></h5></button></div>
		</div>
		<div class="col-md-3 col-sm-3 col-xs-4 bot10" rel="#E0C7A3" onclick="select_lop(5);" style="height:50px; cursor:pointer;">
			<div class="col-md-4 hidden-xs"><img src="/Themes/Phanlop/skin/media/concua.png" /></div>
			<div class="col-md-8 top10"><button class="btn btn-success"><h5><strong>Lớp 5</strong></h5></button></div>
		</div>
	</div>
</div>

<?php if(!$lop){ ?>

<?php if(pzk_request()->isMobile()) {
	$lop = 5;
}
?>

<div class="modal fade hidden-xs ChoiceClass" role="dialog">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h4 class="modal-title text-center"><strong>Mời bạn chọn lớp</strong></h4>
			</div>
			<div class="modal-body col-md-12">
				<div class="col-md-6 col-md-offset-3">
					<select class="form-control sharp" onchange="select_lop(this.value);">
						<option <?php if(!$lop){ echo 'selected'; }?>>Chọn lớp</option>
						<option value="3" disabled <?php if($lop == 3){ echo 'selected';} ?>>Lớp 3</option>
						<option value="4" disabled <?php if($lop == 4){ echo 'selected';} ?>>Lớp 4</option>
						<option value="5" <?php if($lop == 5){ echo 'selected';} ?>>Lớp 5</option>
					</select>
				</div>
			</div>
			
		</div>
	</div>
</div>

<div class="hidden-xs modal-backdrop fade in" style="height: 660px; width: 100%; z-index: 999999;"></div>
<div style="display: none; position: fixed; top: 0px; left:20%;; z-index: 9999999" class=" hidden-xs showpopup"  role="dialog">

	<div class="modal-dialog  modal-lg">
		<div style="height: 600px; max-width: 800px;" class="modal-content modalfish">
			
			
			<div class="item" style="padding:15px 15px 0px 15px;" >
			<button onclick="return select_lop(5);" style="font-size: 40px; font-weight: bold; opacity: 1;" type="button" class="close" >&times;</button>
				<img src="/Themes/Phanlop/skin/media/crab.png" />
				<a target="_blank" href="http://nextnobels.com/tai-sao-hoc-sinh-can-dung-phan-mem-flsn"><strong style="font-size: 16px; color: #0085bc;">Tại sao học sinh cần dùng phần mềm Full Look(Song ngữ)?</strong></a>
				<p style="margin-top: 10px; padding-left: 50px;">
					Chỉ với <b style="color: #189cda">30 phút mỗi ngày</b>, bạn có thể ôn tập và mở rộng <b style="color: #f48e5c">kiến thức các môn</b> (Toán, Văn, Tiếng Anh, Khoa học…) với 3 chế độ ngôn ngữ (Tiếng Anh, Tiếng Việt, Song ngữ), đồng thời nhận biết được khoảng hơn <b style="color: #8fd68a">2.000 từ vựng tiếng Anh</b> về nội dung các môn trong 1 năm học.
				</p>
			</div>
			<div class="item hidden" style="padding:0px 15px 15px 15px;">
				<img src="/Themes/Phanlop/skin/media/star.png" />
				<span style="color: #62aa5d;">Chọn lớp tại đây: </span>
			</div>
			<div style="margin-bottom: 15px;" class="text-center hidden">
			 <button onclick="comming(3);" style="background: #189cda; color: white; min-width: 150px;" class="btn btn-lg" >Lớp 3</button>
			 <button onclick="comming(4);" style="background: #f48e5c; color: white; min-width: 150px; margin: 0px 50px;" class="btn btn-lg" >Lớp 4</button>
			 <button  onclick="select_lop(5);" style="background: #8fd68a; color: white; min-width: 150px;" class="btn btn-lg" >Lớp 5</button>
			</div>
			<marquee class="hidden" onmouseover="this.stop();" onmouseout="this.start();">
				<img style="width: 300px" src="/Themes/Phanlop/skin/media/fish11.gif?t=1" />
				<img style="width: 300px" src="/Themes/Phanlop/skin/media/fish12.gif?t=10" />
				<img style="width: 300px" src="/Themes/Phanlop/skin/media/fish13.gif?t=1" />
				<img style="width: 300px" src="/Themes/Phanlop/skin/media/fish34.gif?t=1" />
				
			</marquee>	
			
		</div>
	</div>
</div>

<?php } ?>
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
				$.ajax({url: "/language/en", success: function(result){window.location.reload();}
			});
		<?php }elseif($memberlang == 'vn'){ ?>
				alert('Bạn cần mua gói Tiếng Anh hoặc Song Ngữ để thực hiện thao tác này');
		<?php 	} ?>
		
	}
	function select_vn(){
		<?php if(!$memberlang || $memberlang == 'ev' || $memberlang == 'vn') { ?>
				$.ajax({url: "/language/vn", success: function(result){window.location.reload();}
			});
		<?php }elseif($memberlang == 'en'){ ?>
				alert('Bạn cần mua gói Tiếng Việt hoặc Song Ngữ để thực hiện thao tác này');
		<?php 	} ?>
		

		
	}
	function select_ev(){
		<?php if($memberlang == 'en' || $memberlang == 'vn') { ?>
				alert('Bạn cần mua gói Song Ngữ để thực hiện thao tác này');
		<?php }elseif(!$memberlang || $memberlang == 'ev'){ ?>
				$.ajax({url: "/language/ev", success: function(result){window.location.reload();}
		});
		<?php 	} ?>
		

		
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
