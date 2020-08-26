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
	$tab6 = intval(pzk_request()->getTab6());
	$tab8 = intval(pzk_request()->getTab8());
?>

<?php $data->displayChildren('[position=public-header]') ?>
<?php $data->displayChildren('[position=top-menu]') ?>
<div class="container text-justify">
	<div class="row">
		<div class="col-md-12">
		<a href="/home/detail?tab6=1"><img src="/Themes/Phanlop/skin/media/taisao.png" class="img-responsive top10 col-md-6 col-md-offset-3 bot10" /></a>
		</div>
		<ul class="nav nav-tabs " style="font-weight: bold;">
			
			<!--li class="<?php //if(!$tab6 && !$tab8){ echo "active"; }else{ echo "."; } ?>"><a data-toggle="pill" href="#mucdich" class="btn-info" >Mục đích</a></li-->
			<li class="<?php if(!$tab8){ echo "active"; } ?>"><a data-toggle="pill" href="#visao"  class="btn-info">Vì sao cần bộ đề toàn diện</a></li>
			<li><a data-toggle="pill" href="#doingu"  class="btn-info">Biên soạn</a></li>
			<li><a data-toggle="pill" href="#cautruc"  class="btn-info">Cấu trúc</a></li>
			
			<li class="<?php if($tab8){ echo "active"; } ?>"><a data-toggle="pill" href="#buynow"  class="btn-info">Mua sản phẩm</a></li>
			<li><a data-toggle="pill" href="#videoinfo"  class="btn-info">Video giới thiệu</a></li>
			
		</ul>
		<div class="tab-content tab-contentct">
			<!--div id="mucdich" class="tab-pane fade <?php //if(!$tab6 && !$tab8){ echo "in active"; }else{ echo "."; }?>  bgcolor">
			<img src="/Themes/Phanlop/skin/media/tab2.png" class="img-responsive hidden-xs"  />
			<img src="/Themes/Phanlop/skin/media/tab2mb.png" class="img-responsive visible-xs"/>
			</div-->

			<div id="doingu" class="tab-pane fade bgcolor">
			<img src="/Themes/Ams/skin/images/tab3.png" class="img-responsive hidden-xs" />
			<img src="/Themes/Ams/skin/images/tab3mb.png" class="img-responsive visible-xs"/>
			</div>
		  
			<div id="cautruc" class="tab-pane fade bgcolor">
			<img src="/Themes/Ams/skin/images/tab4.png" class="img-responsive hidden-xs" />
			<img src="/Themes/Ams/skin/images/tab4amsmb.png" class="img-responsive visible-xs"/>
			</div>

			<div id="visao" class="tab-pane fade bgcolor <?php if(!$tab8){ echo "in active"; }else{ echo "."; }?>">
				<img src="/Themes/Ams/skin/images/visao.png" class="img-responsive item hidden-xs" usemap="#visao" style="width:1170px; height:auto;" />
				<map name="visao">				
					<area title="" href="/danh-gia-nang-luc-vao-lop-6" shape="rect" coords="100,300,450,450" />
				</map>
				
				<img src="/Themes/Ams/skin/images/visaomb.png" class="img-responsive visible-xs"/>
			</div>
			
			<div id="buynow" class="tab-pane fade bgcolor <?php if($tab8){ echo "in active"; } ?>">
				
				<div class="item">
					<img src="/Themes/Ams/skin/images/tab1.png" class="img-responsive hidden-xs" usemap="#tab1" style="width:1170px; height:auto;" />
					<map name="tab1">				
						<area alt="" title="" href="javascript:void(0)" data-toggle="modal" data-target="#RegisterModal" shape="rect" coords="239,400,400,336" />
						<area alt="" title="" href="#ordercardflsn" shape="rect" coords="971,882,1027,894" />
						<area alt="" title="" href="#paycard" shape="rect" coords="944,902,999,915" />
						<area alt="" title="" href="#bank" shape="rect" coords="989,922,1040,937" />
						<area alt="" title="" href="#money" shape="rect" coords="943,943,996,955" />
						<area alt="" title="" href="javascript:void(0)" data-toggle="modal" data-target="#RegisterModal" shape="rect" coords="239,400,400,336" />
					</map>
					
					<img src="/Themes/Ams/skin/images/tab1mb.png" class="img-responsive visible-xs item" alt="" usemap="#Mapmb" />
					<map name="Mapmb" id="Mapmb">
						<area alt="" href="javascript:void(0)" data-toggle="modal" data-target="#RegisterModal" shape="rect" coords="71,1666,125,1678" />
						<area alt="" title="" href="#ordercardflsn" shape="rect" coords="176,1873,234,1885" />
						<area alt="" title="" href="#paycard" shape="rect" coords="127,1913,183,1925" />
						<area alt="" title="" href="#bank" shape="rect" coords="179,1953,236,1965" />
						<area alt="" title="" href="#money" shape="rect" coords="160,1992,213,2005" />
					</map>
				</div>
				
				
				<div class="item">
				<?php if(0): ?>
					<div class="item t-color top20" id="ordercardflsn">
						<div class="item bgnote" style="min-height: 100px;">
							<div class="col-md-10 col-md-offset-1  col-sm-10 col-sm-offset-1 hidden-xs text-center" style="height: 50px;line-height: 50px;font-size: 24px;font-weight: bold;color: white; ">
							 <h3 class="label-warning">ĐẶT MUA THẺ TẠI WEBSITE, NHẬN THẺ TẠI NHÀ</h3>
							</div>
							<div class="visible-xs text-center" style="font-weight: bold;color: white;">
							 <h3 class="label-warning">ĐẶT MUA THẺ TẠI WEBSITE, NHẬN THẺ TẠI NHÀ</h3>
							</div>
							<div class="item">
								<?php $data->displayChildren('[position=ordercardflsn]') ?>
							</div>
						</div>
					</div>
				
					<div class="item t-color" id="paycardflsn">
						<div class="item bgnote" style="min-height: 100px;">
							<div class="col-md-10 col-md-offset-1 col-sm-10 col-sm-offset-1 hidden-xs text-center" style="font-size: 24px;font-weight: bold;color: white;">
							  <span class="label label-danger ">NẠP THẺ FULL LOOK SONG NGỮ</span>
							</div>
							<div class="visible-xs item text-center" style="font-weight: bold;color: white;">
							  <h3 class="label label-danger ">NẠP THẺ FULL LOOK SONG NGỮ</h3>
							</div>
							<div class="item">	
								<?php $data->displayChildren('[position=paycardflsn]') ?>
							</div>
						</div>
					</div>
				<?php endif; ?>
					<div class="item">
						<div class="item t-color" id="paycard">
							<div class="item bgnote" >
								<div class="col-md-10 col-md-offset-1  col-sm-10 col-sm-offset-1 hidden-xs text-center" style="height: 40px;line-height: 40px; font-size: 24px;font-weight: bold;color: white; ">
								  <span class="label label-success">THANH TOÁN BẰNG THẺ CÀO ĐIỆN THOẠI</span>
								</div>
								<div class="visible-xs item text-center" style="font-weight: bold;color: white; ">
								  <h3 class="label label-success">THANH TOÁN BẰNG THẺ CÀO ĐIỆN THOẠI</h3>
								</div>
								<div class="item">
									<?php $data->displayChildren('[position=paycard]') ?>
									<?php $data->displayChildren('[position=service]') ?>
								</div>
							</div>
						</div>
						<div class="item t-color top20" id="money">
							<div class="item bgnote" style="min-height: 100px;">
								<div class="col-md-10 col-md-offset-1  col-sm-10 col-sm-offset-1 hidden-xs text-center" style="font-size: 24px;font-weight: bold;color: white;">
								  <span class="label label-info">THANH TOÁN TẠI VĂN PHÒNG CÔNG TY </span>
								</div>
								<div class="visible-xs item text-center" style="font-weight: bold;color: white;">
								  <h2 class="label label-info">THANH TOÁN TẠI VĂN PHÒNG CÔNG TY </h2>
								</div>
								<div class="item">
									<?php $data->displayChildren('[position=money]') ?>
								</div>
							</div>
						</div>
						<div class="item t-color top20" id="bank">
							<div class="col-md-12 col-sm-12  col-xs-12 bgnote" style="min-height: 100px;">
								<div class="col-md-10 col-md-offset-1  col-sm-10 col-sm-offset-1 hidden-xs text-center" style="height: 50px;line-height: 50px; font-size: 24px;font-weight: bold;color: white;">
								  <span class="label label-primary">THANH TOÁN BẰNG CHUYỂN KHOẢN NGÂN HÀNG</span>
								</div>
								<div class="visible-xs item text-center" style="font-weight: bold;color: white;">
								  <h2 class="label label-primary">THANH TOÁN BẰNG CHUYỂN KHOẢN NGÂN HÀNG</h2>
								</div>
								<div class="item">
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

					</div>
					
				</div>
				
				
				
			</div><!--end buy now-->
			
			<div id="videoinfo" class="tab-pane fade bgcolor">
				<div class="text-center" style="padding: 15px;">
					<h3 class="text-center">Full Look – Phần mềm Vinh dự được Bộ Giáo dục & Đào tạo trao tặng giải thưởng:<h3/>
					<h3 class="text-center red">CÔNG TRÌNH SÁNG KIẾN TIÊU BIỂU NHẤT NĂM 2017<h3/>
					Bộ đề trắc nghiệm năng lực được  xây dựng trên nền tảng phần mềm Full Look.<br/><br/><br/>
					
					<video width="60%" controls>
					  <source src="/uploads/video/videoinfo.mp4" type="video/mp4">
					  Your browser does not support HTML5 video.
					</video><br/><br/>
					<div style="font-size: 16px;">
					Video trích từ nguồn http://www.dailymotion.com/video/x6aufhz<br/>
					Do VTC1 thực hiện (Chương trình “Sống kết nối”, ngày 30/1/2017)
					</div>
				</div>	
			</div>
		</div>
	</div>
</div>
<script>
pzk.load('/3rdparty/jquery/jquery.rwdImageMaps.js', function(){
   $('img[usemap]').rwdImageMaps();
   setTimeout(function(){$(window).resize()}, 200);
  });
</script>