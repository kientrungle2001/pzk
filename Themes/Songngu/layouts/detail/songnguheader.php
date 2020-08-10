<?php 
$signActive = pzk_session('checkPayment');
$language = pzk_global()->get('language');
$languagevn = pzk_global()->get('languagevn');
$lang = pzk_session('language');
$login = pzk_session('userId');
?>
<div class="container songnguheader3 hidden-xs">
	<div class="row">		
		<div class="col-xs-12 col-md-11 col-md-offset-1 col-sm-12 ">
			<div class="pd-20 text-left">
				<h2 class="col-md-10 col-md-offset-2 col-sm-10 col-sm-offset-2"><a href="<?=FLSN_URL?>"><strong>FULL LOOK SONG NGỮ</strong></a></h2>
				<h4 class="col-md-10 col-md-offset-2 col-sm-10 col-sm-offset-2" style="margin-top:5px!important; color:#337ab7;"><strong><?php echo $language['class5'];?></strong></h4>
				<h5 class="col-md-10 col-md-offset-2 col-sm-10 col-sm-offset-2" style="color:#337ab7;"><strong><?php echo $language['detail1'];?>  <br/><?php echo $language['detail2'];?></strong></h5>
				<div class="btncon col-md-10 col-md-offset-2 col-sm-10 col-sm-offset-2 text-left" style="margin-right:-10px;">
					<?php if(!$signActive && !$login) { ?>
					<button  type="button" href="#" onclick="return false;" class="btn btn-default sharp btn-info trial" <?php if($lang == 'ev'){
					echo 'title="'.$languagevn['trial'].'"'; }?>><span class="glyphicon glyphicon-play"></span> <?php echo $language['trial'];?></button>
					<?php } ?>
					<a href="/home/about"><button  type="button" class="btn btn-default sharp btn-danger" <?php if($lang == 'ev'){
					echo 'title="'.$languagevn['detail'].'"'; }?>><span class="glyphicon glyphicon-shopping-cart"></span> <?php echo $language['detail'];?><?php if(!pzk_session('checkPayment')) { ?> <?php echo $language['buy'];?><?php } ?></button></a>
					<a href="/huong-dan-su-dung-song-ngu"><button type="button" class="btn sharp  btn-warning" <?php if($lang == 'ev'){
					echo 'title="'.$languagevn['usage-title'].'"'; }?>><span class="glyphicon glyphicon-info-sign"></span> <?php echo $language['usage'];?></button></a>
				</div>
				
				<div class="col-md-7 col-sm-12 col-xs-12 col-md-offset-2 top20" >
				<div class='item' style="background: white; border: 1px solid gray;">
					<div class="col-md-3 col-sm-3">
					   <p class="top10 text-center" style="font-size:12px;"><strong><?php echo $language['display'];?>:</strong></p>
					</div>
					<div class="col-md-9 col-sm-9 text-center" style="font-size:12px;">
    					<a href="#" onclick="select_en(); return false;"><div class="col-md-4 col-sm-4 col-xs-4 top10">
    						<img style="width:20px; height:20px;" src="<?=BASE_SKIN_URL?>/Themes/Songngu/skin/media/en.png" title="English"/><span class="hidden-xs"><strong> <?php echo $language['en'];?></strong></span>
    					</div></a>
    					<a href="#" onclick="select_vn(); return false;"><div class="col-md-4 col-sm-4 col-xs-4 top10">
    						<img style="width:20px; height:20px;" src="<?=BASE_SKIN_URL?>/Themes/Songngu/skin/media/vn.png" title="Việt Nam"/><span class="hidden-xs"><strong> <?php echo $language['vn'];?></strong></span>
    					</div></a>
    					<a href="#" onclick="select_ev(); return false;"><div class="col-md-4 col-sm-4 col-xs-4 top10">
    						<img style="width:20px; height:20px;" src="<?=BASE_SKIN_URL?>/Themes/Songngu/skin/media/ev.png" title="Song Ngữ"/><span class="hidden-xs"><strong> <?php echo @$language['ev']?></strong></span>
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
			<img style="width:20px; height:20px;" src="<?=BASE_SKIN_URL?>/Themes/Songngu/skin/media/en.png" title="English"/><span class="hidden-xs"> <?php echo $language['en'];?></span>
		</div></a>
		<a href="#" onclick="select_vn(); return false;"><div class="col-md-4 col-sm-4 col-xs-4">
			<img style="width:20px; height:20px;" src="<?=BASE_SKIN_URL?>/Themes/Songngu/skin/media/vn.png" title="Việt Nam"/><span class="hidden-xs"> <?php echo $language['vn'];?></span>
		</div></a>
		<a href="#" onclick="select_ev(); return false;"><div class="col-md-4 col-sm-4 col-xs-4 bot10">
			<img style="width:20px; height:20px;" src="<?=BASE_SKIN_URL?>/Themes/Songngu/skin/media/ev.png" title="Song Ngữ"/><span class="hidden-xs"> <?php echo @$language['ev']?></span>
		</div></a>
	</div>
</div>
<script>
	function select_en(){
		$.ajax({url: "/language/en", success: function(result){window.location.reload();}
		});
	}
	function select_vn(){
		$.ajax({url: "/language/vn", success: function(result){window.location.reload();}
		});
	}
	function select_ev(){
		$.ajax({url: "/language/ev", success: function(result){window.location.reload();}
		});
	}
	$(".trial").click(function(){
		<?php if(!pzk_session('userId')): ?>
			window.location = BASE_REQUEST+'/home/index?showLogin=1'
		<?php endif; ?>
	});
</script>
