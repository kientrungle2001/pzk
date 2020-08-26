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
?>

<?php $data->displayChildren('[position=public-header]') ?>
<?php $data->displayChildren('[position=top-menu]') ?>
<div class="container text-justify">
	<div class="row">
		<div class="col-md-12">
		<a href="/home/detail?tab6=1"><img src="/Themes/Phanlop/skin/media/taisao.png" class="img-responsive top10 col-md-6 col-md-offset-3 bot10" /></a>
		</div>
		<ul class="nav nav-tabs pd-20" style="font-weight: bold;">
			
			<li class="<?php if(!$tab6){ echo "active"; }else{ echo "."; } ?>"><a data-toggle="pill" href="#mucdich" class="btn-info" >Mục đích</a></li>
			<li><a data-toggle="pill" href="#doingu"  class="btn-info">Biên soạn</a></li>
			<li><a data-toggle="pill" href="#cautruc"  class="btn-info">Cấu trúc</a></li>
			<li><a data-toggle="pill" href="#tienich"  class="btn-info">Tiện ích</a></li>
			<li class="<?php if($tab6){ echo "active"; } ?>"><a data-toggle="pill" href="#visao"  class="btn-info">Vì sao phải dùng Full Look</a></li>
			<li><a data-toggle="pill" href="#cacbuoc"  class="btn-info">Các bước học với Full Look</a></li>
			<li><a data-toggle="pill" href="#tinmoi"  class="btn-info">Tin mới</a></li>
			
		</ul>
		<div class="tab-content tab-contentct">
			<div id="mucdich" class="tab-pane fade in <?php if(!$tab6){ echo "active"; }else{ echo "."; }?>  bgcolor">
			<img src="/Themes/Phanlop/skin/media/tab2.png" class="img-responsive hidden-xs" style="width:1170px; height:auto;" />
			<img src="/Themes/Phanlop/skin/media/tab2mb.png" class="img-responsive visible-xs"/>
			</div>

			<div id="doingu" class="tab-pane fade bgcolor">
			<img src="/Themes/Phanlop/skin/media/tab3.png" class="img-responsive hidden-xs" style="width:1170px; height:auto;" />
			<img src="/Themes/Phanlop/skin/media/tab3mb.png" class="img-responsive visible-xs"/>
			</div>
		  
			<div id="cautruc" class="tab-pane fade bgcolor">
			<img src="/Themes/Phanlop/skin/media/tab4.png" class="img-responsive hidden-xs" style="width:1170px; height:auto;" />
			<img src="/Themes/Phanlop/skin/media/tab4mb.png" class="img-responsive visible-xs"/>
			</div>
			<div id="tienich" class="tab-pane fade bgcolor">
			<img src="/Themes/Phanlop/skin/media/tab5.png" class="img-responsive hidden-xs" style="width:1170px; height:auto;" />
			<img src="/Themes/Phanlop/skin/media/tab5mb.png" class="img-responsive visible-xs"/>
			</div>
			<div id="visao" class="tab-pane fade in bgcolor <?php if($tab6){ echo "active"; } ?>">
				<img src="/Themes/Phanlop/skin/media/tab7.png" class="img-responsive hidden-xs" style="width:1170px; height:auto;" />
				<img src="/Themes/Phanlop/skin/media/tab7mb.png" class="img-responsive visible-xs"/>
			</div>
			<div id="cacbuoc" class="tab-pane fade bgcolor">
				<img src="/Themes/Phanlop/skin/media/tab6.png" class="img-responsive hidden-xs" style="width:1170px; height:auto;" />
				<img src="/Themes/Phanlop/skin/media/tab6mb.png" class="img-responsive visible-xs"/>
			</div>
			<div id="tinmoi" class="tab-pane fade bgcolor">
				<div class="row">
					<?php $data->displayChildren('[position=lastestnews]') ?>
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