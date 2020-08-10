<style>
table.tb_catruc{
	width: 100%;
	border: 1px solid #cccccc;
}
table.tb_catruc td {
	border: 1px solid #cccccc;
	padding: 10px;
	text-align: justify;
}
.tab1
{
  background: url('/Themes/Phanlop/skin/media/tab1.png');
}
</style>
<?php 
	$tab6 = intval(pzk_request('tab6'));
?>

<?php $data->displayChildren('[position=public-header]') ?>
<?php $data->displayChildren('[position=top-menu]') ?>
<div class="container text-justify">
	<div class="row">
		<div class="col-md-12">
		<a href="/home/detail?tab6=1"><img src="/Themes/Phanlop/skin/media/taisao.png" class="img-responsive top10 col-md-6 col-md-offset-3 bot10" /></a>
		</div>
		<ul class="nav nav-tabs pd-20">
			<li class="active"><a data-toggle="pill" href="#huongdan" class="btn-danger"  ><span class="glyphicon glyphicon-shopping-cart"></span> Mua sản phẩm</a></li>
		</ul>
		<div class="tab-content tab-contentct">
			<div id="huongdan" class="tab-pane fade in <?php if(!$tab6){ echo "active"; }?> bgcolor">
			<img src="/Themes/Phanlop/skin/media/tab1.png" class="img-responsive hidden-xs" usemap="#tab1" style="width:1170px; height:auto;" />
			<map name="tab1">				
				<area alt="" title="" href="javascript:void(0)" data-toggle="modal" data-target="#RegisterModal" shape="rect" coords="233,898,287,911" />
				<area alt="" title="" href="#ordercardflsn" shape="rect" coords="971,882,1027,894" />
				<area alt="" title="" href="#paycard" shape="rect" coords="944,902,999,915" />
				<area alt="" title="" href="#bank" shape="rect" coords="989,922,1040,937" />
				<area alt="" title="" href="#money" shape="rect" coords="943,943,996,955" />
			</map>
			
			<img src="/Themes/Phanlop/skin/media/tab1mb.png" class="img-responsive visible-xs col-xs-12" alt="" usemap="#Mapmb" />
			<map name="Mapmb" id="Mapmb">
				<area alt="" href="javascript:void(0)" data-toggle="modal" data-target="#RegisterModal" shape="rect" coords="71,1666,125,1678" />
				<area alt="" title="" href="#ordercardflsn" shape="rect" coords="176,1873,234,1885" />
				<area alt="" title="" href="#paycard" shape="rect" coords="127,1913,183,1925" />
				<area alt="" title="" href="#bank" shape="rect" coords="179,1953,236,1965" />
				<area alt="" title="" href="#money" shape="rect" coords="160,1992,213,2005" />
			</map>
			</div>		  
		</div>
	</div>
</div>
<div class="container t-color top20" id="ordercardflsn">
	<div class="row bgnote" style="min-height: 100px;">
		<div class="col-md-10 col-md-offset-1  col-sm-10 col-sm-offset-1 hidden-xs text-center" style="height: 50px;line-height: 50px;font-size: 24px;font-weight: bold;color: white; ">
	     <h3 class="label-warning">ĐẶT MUA THẺ TẠI WEBSITE, NHẬN THẺ TẠI NHÀ</h3>
	    </div>
		<div class="visible-xs item text-center" style="font-weight: bold;color: white;">
	     <h3 class="label-warning">ĐẶT MUA THẺ TẠI WEBSITE, NHẬN THẺ TẠI NHÀ</h3>
	    </div>
		<div class="col-md-12 col-sm-12 col-xs-12">
			<?php $data->displayChildren('[position=ordercardflsn]') ?>
		</div>
	</div>
</div>
<div class="container t-color" id="paycardflsn">
	<div class="row bgnote" style="min-height: 100px;">
		<div class="col-md-10 col-md-offset-1 col-sm-10 col-sm-offset-1 hidden-xs text-center" style="height: 60px;line-height: 60px;  font-size: 24px;font-weight: bold;color: white;">
	      <span class="label label-danger ">NẠP THẺ FULL LOOK SONG NGỮ</span>
	    </div>
		<div class="visible-xs item text-center" style="font-weight: bold;color: white;">
	      <h2 class="label label-danger ">NẠP THẺ FULL LOOK SONG NGỮ</h2>
	    </div>
	    <div class="col-md-12 col-sm-12 col-xs-12">	
			<?php $data->displayChildren('[position=paycardflsn]') ?>
		</div>
	</div>
</div>
<div class="container t-color top20" id="paycard">
	<div class="row bgnote" style="min-height: 100px;">
		<div class="col-md-10 col-md-offset-1  col-sm-10 col-sm-offset-1 hidden-xs text-center" style="height: 40px;line-height: 40px; font-size: 24px;font-weight: bold;color: white; ">
	      <span class="label label-success">THANH TOÁN BẰNG THẺ CÀO ĐIỆN THOẠI</span>
	    </div>
		<div class="visible-xs item text-center" style="font-weight: bold;color: white; ">
	      <h2 class="label label-success">THANH TOÁN BẰNG THẺ CÀO ĐIỆN THOẠI</h2>
	    </div>
	    <div class="row">
	    	<?php $data->displayChildren('[position=paycard]') ?>
			<?php $data->displayChildren('[position=service]') ?>
	    </div>
	</div>
</div>
<div class="container t-color top20" id="money">
	<div class="row bgnote" style="min-height: 100px;">
		<div class="col-md-10 col-md-offset-1  col-sm-10 col-sm-offset-1 hidden-xs text-center" style="height: 40px;line-height: 40px; font-size: 24px;font-weight: bold;color: white;">
	      <span class="label label-info">THANH TOÁN TẠI VĂN PHÒNG CÔNG TY </span>
	    </div>
		<div class="visible-xs item text-center" style="font-weight: bold;color: white;">
	      <h2 class="label label-info">THANH TOÁN TẠI VĂN PHÒNG CÔNG TY </h2>
	    </div>
	    <div class="row">
	    	<?php $data->displayChildren('[position=money]') ?>
	    </div>
	</div>
</div>
<div class="container t-color top20" id="bank">
	<div class="col-md-12 col-sm-12  col-xs-12 bgnote" style="min-height: 100px;">
		<div class="col-md-10 col-md-offset-1  col-sm-10 col-sm-offset-1 hidden-xs text-center" style="height: 50px;line-height: 50px; font-size: 24px;font-weight: bold;color: white;">
	      <span class="label label-primary">THANH TOÁN BẰNG CHUYỂN KHOẢN NGÂN HÀNG</span>
	    </div>
		<div class="visible-xs item text-center" style="font-weight: bold;color: white;">
	      <h2 class="label label-primary">THANH TOÁN BẰNG CHUYỂN KHOẢN NGÂN HÀNG</h2>
	    </div>
	    <div class="row">
	    	<?php $data->displayChildren('[position=bank]') ?>
	    </div>
	</div>
</div>



<script>
pzk.load('/3rdparty/jquery/jquery.rwdImageMaps.js', function(){
   $('img[usemap]').rwdImageMaps();
   setTimeout(function(){$(window).resize()}, 200);
  });
</script>






