
<div class="container text-left">
	<div class="item">
		<a href="/home/detail"><img src="/Themes/Phanlop/skin/media/taisao.png" class="img-responsive top10 col-md-6 col-md-offset-3 bot10"></a>
	</div>
	<div class="item">

		<ul class="nav nav-tabs" style="font-weight: bold;" >
		  <li ><a href="#service" data-toggle="pill" class="btn-info">Các gói sản phẩm</a></li>
		  <li><a href="#ordercardflsn"  data-toggle="pill" class="btn-warning">Đặt mua thẻ FullLook Song Ngữ</a></li>			
		  <li class="active"><a href="#paycardflsn"  data-toggle="pill" class="btn-danger">Nạp thẻ cào FullLook Song Ngữ</a></li>
		</ul>
		<div class="tab-content bgcolor">
			<div id="service" class="tab-pane fade  bgcolor">
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
			<div id="paycardflsn" class="tab-pane in active fade">	
	  			<div class="col-md-10 col-md-offset-1 col-sm-10 col-sm-offset-1 hidden-xs text-center" style="height: 50px;line-height: 50px;font-size: 24px;font-weight: bold;color: white; ">
			     	<span class="label label-danger ">NẠP THẺ FULLLOOK SONG NGỮ</span>
			    </div>
				<div class="visible-xs text-center" style="height: 50px;line-height: 50px;font-weight: bold;color: white; ">
			     	<h2 class="label label-danger ">NẠP THẺ FULLLOOK SONG NGỮ</h2>
			    </div>
	  			<div class="row">
	  				{children [position=paycardflsn]}
	  			</div>
	  		</div>
			
			<div id="ordercardflsn" class="tab-pane fade  bgcolor" style="min-height: 200px;">	
	  			<div class="col-md-10 col-md-offset-2 col-sm-10 col-sm-offset-2 hidden-xs text-center" style="height: 50px;line-height: 50px;font-size: 24px;font-weight: bold;color: white; ">
			     	<span class="label label-warning ">ĐẶT MUA THẺ FULLLOOK SONG NGỮ</span>
			    </div>
				<div class="visible-xs text-center" style="height: 50px;line-height: 50px;font-weight: bold;color: white; ">
			     	<h2 class="label label-warning ">ĐẶT MUA THẺ FULLLOOK SONG NGỮ</h2>
			    </div>
	  			<div class="row">
	  				{children [position=ordercardflsn]}
	  			</div>
	  		</div>
		
		</div>

	</div>
</div>







