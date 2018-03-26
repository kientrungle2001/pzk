var a = {
"employees":[ "John", "Anna", "Peter" ]
};
atmpl = heredoc(function(){/*
	(* var es = data.employees*)
	<h1>(*= es[0]*)</h1>
*/});
h = template(atmpl, a);
home_content = heredoc(function(){/*
<div id="fb-root">(*= data.id*)</div>
<div class="container-fluid top-header">
	<div class="container fs15">
		<div class="row">
			<div class="col-md-3 2f2f60 col-xs-12">
				<img src="http://test1sn.vn/themes/songngu3/skin/images/hostline.png" /> Hotline: <b>0965 90 91 95</b>
			</div>
			<div class="col-md-2 2f2f60 col-xs-12">
			
			<select onchange="setLang(this.value);" class="select-top xs-w100p" >
				<option selected>Chọn ngôn ngữ</option>
				<option  value="vn" >Tiếng Việt</option>
				<option  value="en" >Tiếng Anh</option>
				<option  value="ev" >Song ngữ</option>
			</select>
			</div>
			<div class="col-md-2 2f2f60 col-xs-12">
			 
			<select class="select-top xs-w100p" onchange="select_lop(this.value);">
				
				<option >Chọn lớp</option>
				<option value="3" disabled >Lớp  3</option>
				<option value="4"  >Lớp  4</option>
				<option value="5" selected>Lớp  5</option>
			</select>
			</div>
			<div class="col-md-5 col-xs-12 pdl0 topright">
			
							<a  href="http://test1sn.vn/home/detail?tab8=1">
				<img src="http://test1sn.vn/themes/songngu3/skin/images/cart.png" />
				Mua ngay</a>
				<a  href="http://test1sn.vn/home/payment">
				<img src="http://test1sn.vn/themes/songngu3/skin/images/card.png" /> 
				Nạp thẻ</a>
				<a class="login_head text-center" href="javascript:void(0)" data-toggle="modal" data-target="#LoginModal"> 
				<img src="http://test1sn.vn/themes/songngu3/skin/images/dangnhap.png" />
				 Đăng nhập </a>
				<a class="register_head text-center" href="javascript:void(0)" data-toggle="modal" data-target="#RegisterModal"> 
				<img src="http://test1sn.vn/themes/songngu3/skin/images/signin.png" /> Đăng ký				</a>
				
			<!-- <a class="login_required_mobile">Đăng nhập - Đăng ký1</a> -->
						
			</div>
		</div>
	</div>
</div>
<div class="container-fluid main-menu">
	<div class="container">
		<div class="row">
			<div class="col-md-2 col-xs-12">
				<a href="http://test1sn.vn/"><img src="http://test1sn.vn/themes/songngu3/skin/images/logo.png" /></a>
			</div>
			<div class="col-md-10 col-xs-12">
				<div class="hidden-xs">
        <ul class="header-menu item">
			 <li class="dropdown colormenu1">
				<a href="http://test1sn.vn/"><i style="font-size: 23px;" class="fa fa-home" aria-hidden="true"></i></a>
			 </li>
			 <li class="dropdown">
				<a class="gt" href="http://test1sn.vn/home/detail">Giới thiệu</a>
			 </li>
	        <li class="dropdown colormenu2">
	            <a href="http://test1sn.vn/#practice" class="dropdown-toggle  jumping" rel="#A0D4CE" data-class="5" data-jumping="practice" >Luyện tập</a>
				<div class="dropdown-menu multi-column columns-3 tab-content">
					<ul class="nav nav-tabs nav-tabs-ct">
						<li class="active" ><a data-toggle="tab" href="#home">Luyện tập</a></li>
					</ul> 
				   <div class="row tab-pane fade in active text-center pding10" id="home">
							
													<div class="col-md-2 col-xs-3 top10 height80 width20 btn-menu bgcl choicesubject" onclick="return false;" data-class="5"  data-alias="Mathematics" data-subject="51" >
								<a href=""><img src="http://test1sn.vn/default/skin/nobel/themes/story/media/toan.png" class="img-thumnail wheight50"/></a>
								<p class="text-uppercase robotofont weight10">
								Toán học								</p>
							</div>
													<div class="col-md-2 col-xs-3 top10 height80 width20 btn-menu bgcl choicesubject" onclick="return false;" data-class="5"  data-alias="Science" data-subject="52" >
								<a href=""><img src="http://test1sn.vn/default/skin/nobel/themes/story/media/khoahoc.png" class="img-thumnail wheight50"/></a>
								<p class="text-uppercase robotofont weight10">
								Khoa học								</p>
							</div>
													<div class="col-md-2 col-xs-3 top10 height80 width20 btn-menu bgcl choicesubject" onclick="return false;" data-class="5"  data-alias="english" data-subject="164" >
								<a href=""><img src="http://test1sn.vn/default/skin/nobel/themes/story/media/tienganh.png" class="img-thumnail wheight50"/></a>
								<p class="text-uppercase robotofont weight10">
								Tiếng Anh								</p>
							</div>
													<div class="col-md-2 col-xs-3 top10 height80 width20 btn-menu bgcl choicesubject" onclick="return false;" data-class="5"  data-alias="Literature" data-subject="157" >
								<a href=""><img src="http://test1sn.vn/default/skin/nobel/themes/story/media/mt.png" class="img-thumnail wheight50"/></a>
								<p class="text-uppercase robotofont weight10">
								Văn học								</p>
							</div>
													<div class="col-md-2 col-xs-3 top10 height80 width20 btn-menu bgcl choicesubject" onclick="return false;" data-class="5"  data-alias="History" data-subject="53" >
								<a href=""><img src="http://test1sn.vn/default/skin/nobel/themes/story/media/lichsu.png" class="img-thumnail wheight50"/></a>
								<p class="text-uppercase robotofont weight10">
								Lịch sử								</p>
							</div>
													<div class="col-md-2 col-xs-3 top10 height80 width20 btn-menu bgcl choicesubject" onclick="return false;" data-class="5"  data-alias="Geography" data-subject="50" >
								<a href=""><img src="http://test1sn.vn/default/skin/nobel/themes/story/media/dialy.png" class="img-thumnail wheight50"/></a>
								<p class="text-uppercase robotofont weight10">
								Địa lý								</p>
							</div>
													<div class="col-md-2 col-xs-3 top10 height80 width20 btn-menu bgcl choicesubject" onclick="return false;" data-class="5"  data-alias="Life-skills" data-subject="87" >
								<a href=""><img src="http://test1sn.vn/default/skin/nobel/themes/story/media/kynangnghe.png" class="img-thumnail wheight50"/></a>
								<p class="text-uppercase robotofont weight10">
								Kỹ năng sống								</p>
							</div>
													<div class="col-md-2 col-xs-3 top10 height80 width20 btn-menu bgcl choicesubject" onclick="return false;" data-class="5"  data-alias="Social-understanding" data-subject="59" >
								<a href=""><img src="http://test1sn.vn/default/skin/nobel/themes/story/media/hieubiet.png" class="img-thumnail wheight50"/></a>
								<p class="text-uppercase robotofont weight10">
								Hiểu biết xã hội								</p>
							</div>
													<div class="col-md-2 col-xs-3 top10 height80 width20 btn-menu bgcl choicesubject" onclick="return false;" data-class="5"  data-alias="observing-listening" data-subject="88" >
								<a href=""><img src="http://test1sn.vn/default/skin/nobel/themes/story/media/kynangquansat.png" class="img-thumnail wheight50"/></a>
								<p class="text-uppercase robotofont weight10">
								Luyện nghe và quan sát								</p>
							</div>
													<div class="col-md-2 col-xs-3 top10 height80 width20 btn-menu bgcl choicesubject" onclick="return false;" data-class="5"  data-alias="Language-and-communication" data-subject="54" >
								<a href=""><img src="http://test1sn.vn/default/skin/nobel/themes/story/media/cay.png" class="img-thumnail wheight50"/></a>
								<p class="text-uppercase robotofont weight10">
								Ngôn ngữ và giao tiếp								</p>
							</div>
								            </div>
	            </div>
	        </li>
			
			 			<li class="dropdown colormenu3 tab-content">
	            <a href="http://test1sn.vn/#practice-test" class="dropdown-toggle fsize" data-class="5" data-jumping="practice-test" rel="#B6D452" ><span class="hidden-sm hidden-md">Đề luyện tập</span> <span class="visible-sm visible-md">Đề luyện tập</span></a>
	            <div class="dropdown-menu multi-column columns-3 tab-content">
					<ul class="nav nav-tabs nav-tabs-ct1">
						<li class="active" ><a data-toggle="tab" href="#menu12"><span class="hidden-sm hidden-md">Đề luyện tập</span> <span class="visible-sm visible-md">Đề luyện tập</span></a></li>
						<li ><a href="http://test1sn.vn/home/rating?practice=1&clearTestId=1">Xếp hạng</a></li>
					</ul> 
					<div class="row tab-pane fade in active text-center pding10" id="menu12">
					<div id="myCarousel" class="carousel col-md-11" style="margin-left:20px;" data-ride="carousel">

						  <!-- Wrapper for slides -->
						  <div class="carousel-inner" role="listbox">
							<div class="item active">
																							  																
								<div class="col-md-2 col-xs-3 top10 height80 btn-menu bgcl choicepractice" onclick="return false;" data-test="74" data-trial="1" data-week="400" data-class="5" >
									<a href=""><img src="http://test1sn.vn/default/skin/nobel/themes/story/media/de9.png" class="img-thumnail wheight50"></a>
									<p class="text-uppercase robotofont weight10 top10">
									Đề dùng thử</p>
								</div>
								
																																
								<div class="col-md-2 col-xs-3 top10 height80 btn-menu bgcl choicepractice" onclick="return false;" data-test="" data-trial="0" data-week="355" data-class="5" >
									<a href=""><img src="http://test1sn.vn/default/skin/nobel/themes/story/media/de8.png" class="img-thumnail wheight50"></a>
									<p class="text-uppercase robotofont weight10 top10">
									Tuần 1</p>
								</div>
								
																																
								<div class="col-md-2 col-xs-3 top10 height80 btn-menu bgcl choicepractice" onclick="return false;" data-test="" data-trial="0" data-week="357" data-class="5" >
									<a href=""><img src="http://test1sn.vn/default/skin/nobel/themes/story/media/de7.png" class="img-thumnail wheight50"></a>
									<p class="text-uppercase robotofont weight10 top10">
									Tuần 3</p>
								</div>
								
																																
								<div class="col-md-2 col-xs-3 top10 height80 btn-menu bgcl choicepractice" onclick="return false;" data-test="" data-trial="0" data-week="364" data-class="5" >
									<a href=""><img src="http://test1sn.vn/default/skin/nobel/themes/story/media/de6.png" class="img-thumnail wheight50"></a>
									<p class="text-uppercase robotofont weight10 top10">
									Tuần 5</p>
								</div>
								
																																
								<div class="col-md-2 col-xs-3 top10 height80 btn-menu bgcl choicepractice" onclick="return false;" data-test="" data-trial="0" data-week="366" data-class="5" >
									<a href=""><img src="http://test1sn.vn/default/skin/nobel/themes/story/media/de5.png" class="img-thumnail wheight50"></a>
									<p class="text-uppercase robotofont weight10 top10">
									Tuần 7</p>
								</div>
								
																																
								<div class="col-md-2 col-xs-3 top10 height80 btn-menu bgcl choicepractice" onclick="return false;" data-test="" data-trial="0" data-week="368" data-class="5" >
									<a href=""><img src="http://test1sn.vn/default/skin/nobel/themes/story/media/de4.png" class="img-thumnail wheight50"></a>
									<p class="text-uppercase robotofont weight10 top10">
									Tuần 9</p>
								</div>
								
																																
								<div class="col-md-2 col-xs-3 top10 height80 btn-menu bgcl choicepractice" onclick="return false;" data-test="" data-trial="0" data-week="370" data-class="5" >
									<a href=""><img src="http://test1sn.vn/default/skin/nobel/themes/story/media/de3.png" class="img-thumnail wheight50"></a>
									<p class="text-uppercase robotofont weight10 top10">
									Tuần 11</p>
								</div>
								
																																
								<div class="col-md-2 col-xs-3 top10 height80 btn-menu bgcl choicepractice" onclick="return false;" data-test="" data-trial="0" data-week="372" data-class="5" >
									<a href=""><img src="http://test1sn.vn/default/skin/nobel/themes/story/media/de2.png" class="img-thumnail wheight50"></a>
									<p class="text-uppercase robotofont weight10 top10">
									Tuần 13</p>
								</div>
								
																																
								<div class="col-md-2 col-xs-3 top10 height80 btn-menu bgcl choicepractice" onclick="return false;" data-test="" data-trial="0" data-week="374" data-class="5" >
									<a href=""><img src="http://test1sn.vn/default/skin/nobel/themes/story/media/de1.png" class="img-thumnail wheight50"></a>
									<p class="text-uppercase robotofont weight10 top10">
									Tuần 15</p>
								</div>
								
																																
								<div class="col-md-2 col-xs-3 top10 height80 btn-menu bgcl choicepractice" onclick="return false;" data-test="" data-trial="0" data-week="376" data-class="5" >
									<a href=""><img src="http://test1sn.vn/default/skin/nobel/themes/story/media/de10.png" class="img-thumnail wheight50"></a>
									<p class="text-uppercase robotofont weight10 top10">
									Tuần 17</p>
								</div>
								
																							  
							</div>
							<div class="item">
														  																<div class="col-md-2 col-xs-3 top10 height80 btn-menu bgcl choicepractice" onclick="return false;" data-test="" data-trial="0" data-week="378" data-class="5" >
									<a href=""><img src="http://test1sn.vn/default/skin/nobel/themes/story/media/de9.png" class="img-thumnail wheight50"></a>
									<p class="text-uppercase robotofont weight10 top10">
									Tuần 19</p>
								</div>
																							  
							</div>
						  </div>

						  <!-- Left and right controls -->
						  <a class="left carousel-control" style="margin-left:-35px;" href="#myCarousel" role="button" data-slide="prev">
							<span class="glyphicon glyphicon-chevron-left" aria-hidden="true" style="margin-right:20px;"></span>
							<span class="sr-only">Previous</span>
						  </a>
						  <a class="right carousel-control" style="margin-right:-27px;" href="#myCarousel" role="button" data-slide="next">
							<span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
							<span class="sr-only">Next</span>
						  </a>
						</div>
		            </div>
	            </div>
	        </li>
			
						
			
			<li class="dropdown colormenu4 tab-content">
	            <a href="http://test1sn.vn/#test" class="dropdown-toggle fsize" data-class="5" data-jumping="test" rel="#E0C7A3" >Đề kiểm tra</a>
	            <div class="dropdown-menu multi-column columns-3 tab-content">
					<ul class="nav nav-tabs nav-tabs-ct2">
						<li class="active" ><a data-toggle="tab" href="#menu23">Đề kiểm tra</a></li>
						<li ><a href="http://test1sn.vn/home/rating?practice=0&clearTestId=1">Xếp hạng</a></li>
					</ul> 
					<div class="row tab-pane fade in active text-center pding10" id="menu23">
					   <div id="myCarousel1" class="carousel col-md-11" style="margin-left:20px;" data-ride="carousel">

						  <!-- Wrapper for slides -->
						  <div class="carousel-inner" role="listbox">
							<div class="item active">
																												 
							
							<div class="col-md-2 col-xs-3 top10 height80 btn-menu bgcl choicetest" onclick="return false;" data-test="25" data-trial="1" data-week="401" data-class="5" >
								<a href=""><img src="http://test1sn.vn/default/skin/nobel/themes/story/media/hinh9.png" class="img-thumnail wheight50" /></a>
								<p class="text-uppercase robotofont weight10 top10">
								Đề dùng thử</p>
							</div>
																					 
							
							<div class="col-md-2 col-xs-3 top10 height80 btn-menu bgcl choicetest" onclick="return false;" data-test="" data-trial="0" data-week="356" data-class="5" >
								<a href=""><img src="http://test1sn.vn/default/skin/nobel/themes/story/media/hinh8.png" class="img-thumnail wheight50" /></a>
								<p class="text-uppercase robotofont weight10 top10">
								Tuần 2</p>
							</div>
																					 
							
							<div class="col-md-2 col-xs-3 top10 height80 btn-menu bgcl choicetest" onclick="return false;" data-test="" data-trial="0" data-week="363" data-class="5" >
								<a href=""><img src="http://test1sn.vn/default/skin/nobel/themes/story/media/hinh7.png" class="img-thumnail wheight50" /></a>
								<p class="text-uppercase robotofont weight10 top10">
								Tuần 4</p>
							</div>
																					 
							
							<div class="col-md-2 col-xs-3 top10 height80 btn-menu bgcl choicetest" onclick="return false;" data-test="" data-trial="0" data-week="365" data-class="5" >
								<a href=""><img src="http://test1sn.vn/default/skin/nobel/themes/story/media/hinh6.png" class="img-thumnail wheight50" /></a>
								<p class="text-uppercase robotofont weight10 top10">
								Tuần 6</p>
							</div>
																					 
							
							<div class="col-md-2 col-xs-3 top10 height80 btn-menu bgcl choicetest" onclick="return false;" data-test="" data-trial="0" data-week="367" data-class="5" >
								<a href=""><img src="http://test1sn.vn/default/skin/nobel/themes/story/media/hinh5.png" class="img-thumnail wheight50" /></a>
								<p class="text-uppercase robotofont weight10 top10">
								Tuần 8</p>
							</div>
																					 
							
							<div class="col-md-2 col-xs-3 top10 height80 btn-menu bgcl choicetest" onclick="return false;" data-test="" data-trial="0" data-week="369" data-class="5" >
								<a href=""><img src="http://test1sn.vn/default/skin/nobel/themes/story/media/hinh4.png" class="img-thumnail wheight50" /></a>
								<p class="text-uppercase robotofont weight10 top10">
								Tuần 10</p>
							</div>
																					 
							
							<div class="col-md-2 col-xs-3 top10 height80 btn-menu bgcl choicetest" onclick="return false;" data-test="" data-trial="0" data-week="371" data-class="5" >
								<a href=""><img src="http://test1sn.vn/default/skin/nobel/themes/story/media/hinh3.png" class="img-thumnail wheight50" /></a>
								<p class="text-uppercase robotofont weight10 top10">
								Tuần 12</p>
							</div>
																					 
							
							<div class="col-md-2 col-xs-3 top10 height80 btn-menu bgcl choicetest" onclick="return false;" data-test="" data-trial="0" data-week="373" data-class="5" >
								<a href=""><img src="http://test1sn.vn/default/skin/nobel/themes/story/media/hinh2.png" class="img-thumnail wheight50" /></a>
								<p class="text-uppercase robotofont weight10 top10">
								Tuần 14</p>
							</div>
																					 
							
							<div class="col-md-2 col-xs-3 top10 height80 btn-menu bgcl choicetest" onclick="return false;" data-test="" data-trial="0" data-week="375" data-class="5" >
								<a href=""><img src="http://test1sn.vn/default/skin/nobel/themes/story/media/hinh1.png" class="img-thumnail wheight50" /></a>
								<p class="text-uppercase robotofont weight10 top10">
								Tuần 16</p>
							</div>
																					 
							
							<div class="col-md-2 col-xs-3 top10 height80 btn-menu bgcl choicetest" onclick="return false;" data-test="" data-trial="0" data-week="377" data-class="5" >
								<a href=""><img src="http://test1sn.vn/default/skin/nobel/themes/story/media/hinh10.png" class="img-thumnail wheight50" /></a>
								<p class="text-uppercase robotofont weight10 top10">
								Tuần 18</p>
							</div>
																					  
							</div>
							<div class="item">
																					 
							
							<div class="col-md-2 col-xs-3 top10 height80 btn-menu bgcl choicetest" onclick="return false;" data-test="" data-trial="0" data-week="379" data-class="5" >
								<a href=""><img src="http://test1sn.vn/default/skin/nobel/themes/story/media/hinh9.png" class="img-thumnail wheight50" /></a>
								<p class="text-uppercase robotofont weight10 top10">
								Tuần 20</p>
							</div>
																					 
							
							<div class="col-md-2 col-xs-3 top10 height80 btn-menu bgcl choicetest" onclick="return false;" data-test="" data-trial="0" data-week="381" data-class="5" >
								<a href=""><img src="http://test1sn.vn/default/skin/nobel/themes/story/media/hinh8.png" class="img-thumnail wheight50" /></a>
								<p class="text-uppercase robotofont weight10 top10">
								Tuần 22</p>
							</div>
																					 
							
							<div class="col-md-2 col-xs-3 top10 height80 btn-menu bgcl choicetest" onclick="return false;" data-test="" data-trial="0" data-week="383" data-class="5" >
								<a href=""><img src="http://test1sn.vn/default/skin/nobel/themes/story/media/hinh7.png" class="img-thumnail wheight50" /></a>
								<p class="text-uppercase robotofont weight10 top10">
								Tuần 24</p>
							</div>
																					 
							
							<div class="col-md-2 col-xs-3 top10 height80 btn-menu bgcl choicetest" onclick="return false;" data-test="" data-trial="0" data-week="385" data-class="5" >
								<a href=""><img src="http://test1sn.vn/default/skin/nobel/themes/story/media/hinh6.png" class="img-thumnail wheight50" /></a>
								<p class="text-uppercase robotofont weight10 top10">
								Tuần 26</p>
							</div>
																					 
							
							<div class="col-md-2 col-xs-3 top10 height80 btn-menu bgcl choicetest" onclick="return false;" data-test="" data-trial="0" data-week="387" data-class="5" >
								<a href=""><img src="http://test1sn.vn/default/skin/nobel/themes/story/media/hinh5.png" class="img-thumnail wheight50" /></a>
								<p class="text-uppercase robotofont weight10 top10">
								Tuần 28</p>
							</div>
																					 
							
							<div class="col-md-2 col-xs-3 top10 height80 btn-menu bgcl choicetest" onclick="return false;" data-test="" data-trial="0" data-week="389" data-class="5" >
								<a href=""><img src="http://test1sn.vn/default/skin/nobel/themes/story/media/hinh4.png" class="img-thumnail wheight50" /></a>
								<p class="text-uppercase robotofont weight10 top10">
								Tuần 30</p>
							</div>
																					 
							
							<div class="col-md-2 col-xs-3 top10 height80 btn-menu bgcl choicetest" onclick="return false;" data-test="" data-trial="0" data-week="391" data-class="5" >
								<a href=""><img src="http://test1sn.vn/default/skin/nobel/themes/story/media/hinh3.png" class="img-thumnail wheight50" /></a>
								<p class="text-uppercase robotofont weight10 top10">
								Tuần 32</p>
							</div>
																					 
							
							<div class="col-md-2 col-xs-3 top10 height80 btn-menu bgcl choicetest" onclick="return false;" data-test="" data-trial="0" data-week="393" data-class="5" >
								<a href=""><img src="http://test1sn.vn/default/skin/nobel/themes/story/media/hinh2.png" class="img-thumnail wheight50" /></a>
								<p class="text-uppercase robotofont weight10 top10">
								Tuần 34</p>
							</div>
																						  
							</div>
						  </div>

						  <!-- Left and right controls -->
						  <a class="left carousel-control" style="margin-left:-35px;" href="#myCarousel1" role="button" data-slide="prev">
							<span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
							<span class="sr-only">Previous</span>
						  </a>
						  <a class="right carousel-control" style="margin-right:-27px;" href="#myCarousel1" role="button" data-slide="next">
							<span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
							<span class="sr-only">Next</span>
						  </a>
						</div>
		            </div>
	            </div>
	        </li>
			
			
			
			<li class="dropdown colormenu5 ">
	            <a href="http://test1sn.vn/gift" >Quà tặng</a>
	            
	        </li>
	        <li class="dropdown colormenu6 ">
	            <a href="http://test1sn.vn/game" >Trò chơi</a> 
	        </li>
			
			 <li class="dropdown">
				<a class="hd" href="http://test1sn.vn/huong-dan-su-dung-song-ngu">Hướng dẫn sử dụng</a>
			 </li>
        </ul>

    <style>	
		.nowrap{white-space: nowrap;}
    </style>
</div>


<div class="container top10 visible-xs ">
	<div class="row">
		<div class="menu-mb text-center nowrap">
			<a href="http://test1sn.vn/home" ><div class="circle">
			<div class="circle" style="background: #7f003f;"><i class="glyphicon glyphicon-home check"></i></div>						
			</div><span class="m-font">Trang chủ</span></a>
		</div>
		<div class="menu-mb text-center nowrap">		
			<a data-toggle="tab" class="visible-xs jumping" data-jumping="practice" href="#practice" ><div class="circle" style="background: #ffcc00">
				<i class="glyphicon glyphicon-tree-conifer check"></i>
			</div><span class="m-font">Luyện tập</span></a>	
		</div>
		<div class="menu-mb text-center nowrap">
			<a data-toggle="tab" class="visible-xs jumping" data-jumping="practice-test" href="#practice-test" ><div class="circle" style="background: #44b771;">
				<i class="glyphicon glyphicon-send check"></i>
			</div><span class="m-font"><span class="hidden-sm hidden-md">Đề luyện tập</span> <span class="visible-sm visible-md">Đề luyện tập</span></span></a>
		</div>
		<div class="menu-mb text-center nowrap" >
			<a data-toggle="tab" class="visible-xs jumping" data-jumping="test" href="http://test1sn.vn/#test" ><div class="circle" style="background: #db3fdb;">
				<i class="glyphicon glyphicon-star check"></i>
			</div><span class="m-font">Đề kiểm tra</span></a>		
		</div>
		
		<div class="menu-mb text-center nowrap">
			<a href="http://test1sn.vn/game" >
			<div class="circle" style="background: #1e74b3;">
				<i class="glyphicon glyphicon-plane check"></i>
			</div>
				<span class="m-font">Trò chơi</span>
			</a>
		</div>
	</div>
</div>

<script>


	numberclass = 5;
	$(function() {
		$(".ajaxchange").load(BASE_REQUEST + "/home/showtestnumber?class="+numberclass, function() {
			$("#test-section .btn-menu").css("background-color", '#E0C7A3');
		});
		$(".ajaxchangepractice").load(BASE_REQUEST + "/home/showpracticenumber?class="+numberclass, function() {
			$("#practice-test-section .btn-menu").css("background-color", '#B6D452');
		});	
		$("#practice-section .btn-menu").css("background-color", '#A0D4CE');
	});
	
	
	$(".choicesubject").click(function(){
					var state = confirm("Bạn cần đăng nhập/ đăng kí mới được dùng thử");
			if(state == true){
				$("#LoginModal").modal();
			}
			});
	$(".choicepractice").click(function(){
					var state = confirm("Bạn cần đăng nhập/ đăng kí mới được dùng thử");
				if(state == true){
					$("#LoginModal").modal();
				}
			
	});
	$(".choicetest").click(function(){
					var state = confirm("Bạn cần đăng nhập/ đăng kí mới được dùng thử");
				if(state == true){
					$("#LoginModal").modal();
				}
			});
	$(".choicedocument").click(function(){
		var numbersubject = $(this).data("subject");
		var subclass = $(this).data("class");   
		var alias = $(this).data("alias");
		window.location = BASE_REQUEST+'/document/class-'+subclass+'/subject-'+alias+'-'+numbersubject;
	});
	$(".otherpractice").click(function(){
					var state = confirm("Bạn cần đăng nhập/ đăng kí mới được dùng thử");
			if(state == true){
				$("#LoginModal").modal();
			}
			});
	$(".othertest").click(function(){
					var state = confirm("Bạn cần đăng nhập/ đăng kí mới được dùng thử");
			if(state == true){
				$("#LoginModal").modal();
			}
			});
	
	
	$(".tailieu").click(function(){
		window.location = BASE_REQUEST+'/document/home';
	});
	$(".quatang").click(function(){
		window.location = BASE_REQUEST+'/gift';
	});
	$(".game").click(function(){
		window.location = BASE_REQUEST+'/game';
	});
	if(window.location.pathname == '/') {
	// neu o trang chu
		// hash
		$('.jumping').click(function() {
			var jumping = $(this).data('jumping');
			window.location.hash = '#' + jumping;
			setTimeout(function() {
				$(window).scrollTop($(window).scrollTop() - 50);
			}, 200);
			return false;
		});
	} else {
	// neu ko o trang chu
		// location
		$('.jumping').click(function() {
			var jumping = $(this).data('jumping');
			window.location = BASE_REQUEST + '/#' + jumping;
			return false;
		});
	}
	
	if(window.location.hash) {
		setTimeout(function() {
			$(window).scrollTop($(window).scrollTop() - 50);
		}, 200);		
	}
</script>
	
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
				if(lop == 4){
			alert('Học sinh lớp 4 (2016 -2017) có thể sử dụng chương trình lớp 5 trong hè (2017)');
			return false;
		}
				
		$.ajax({
			url: "/phanlop/lop", 
			data:{lop:lop}, 
			success: function(result){
				window.location = window.location.href.replace(/class-[\d]/,'class-'+lop);
			}
		});
		
	}
	$(".trial").click(function(){
					window.location = BASE_REQUEST+'/home/index?showLogin=1'
			});
	function comming(lop){
					alert('Sản phẩm sắp ra mắt !');
			}
</script>



<div id="carousel-example-generic" class="carousel item slide" data-ride="carousel">


<style style="text/css">
.example1 {
 height: 50px;	
 overflow: hidden;
 width: 100%; float: left;
}
.example1 h4 {
 color: white;
 position: absolute;
 width: 100%;
 height: 100%;
 margin: 0;
 line-height: 50px;
 text-align: center;
 -moz-transform:translateX(100%);
 -webkit-transform:translateX(100%);	
 transform:translateX(100%);
 -moz-animation: example1 20s linear infinite;
 -webkit-animation: example1 20s linear infinite;
 animation: example1 20s linear infinite;
}
@-moz-keyframes example1 {
 0%   { -moz-transform: translateX(100%); }
 100% { -moz-transform: translateX(-100%); }
}
@-webkit-keyframes example1 {
 0%   { -webkit-transform: translateX(100%); }
 100% { -webkit-transform: translateX(-100%); }
}
@keyframes example1 {
 0%   { 
 -moz-transform: translateX(100%);
 -webkit-transform: translateX(100%);
 transform: translateX(100%); 		
 }
 100% { 
 -moz-transform: translateX(-100%);
 -webkit-transform: translateX(-100%);
 transform: translateX(-100%); 
 }
}
</style>

<!-- HTML -->	
<!--div  style="position: absolute; top: 5px; z-index: 99;" class="example1">
<h4>HỌC HÈ CÙNG FULL LOOK (GIẢM 30% GIÁ GỐC) </h4>
</div-->

  
<ol class="carousel-indicators">
    <li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
    <li data-target="#carousel-example-generic" data-slide-to="1"></li>
    <li data-target="#carousel-example-generic" data-slide-to="2"></li>
	<li data-target="#carousel-example-generic" data-slide-to="3"></li>
  </ol>
  <!-- Wrapper for slides -->
  <div class="carousel-inner" role="listbox">
    <div class="item active">
		<div class="relative item">
							<img class="item" src="http://test1sn.vn/themes/songngu3/skin/images/slider.png" />
						<div class="absolute hidden-xs language">
				<span onclick="select_en();"><img src="http://test1sn.vn/themes/songngu3/skin/images/en.png" />Tiếng Anh</span>
				<span onclick="select_vn();"><img src="http://test1sn.vn/themes/songngu3/skin/images/vn.png" />Tiếng Việt</span>
				<span onclick="select_ev();"><img src="http://test1sn.vn/themes/songngu3/skin/images/ev.png" />Song ngữ</span>
			</div>
			<div class="absolute visible-xs language language-xs">
				<span onclick="select_en();"><img src="http://test1sn.vn/themes/songngu3/skin/images/en.png" />Tiếng Anh</span>
				<span onclick="select_vn();"><img src="http://test1sn.vn/themes/songngu3/skin/images/vn.png" />Tiếng Việt</span>
				<span onclick="select_ev();"><img src="http://test1sn.vn/themes/songngu3/skin/images/ev.png" />Song ngữ</span>
			</div>
		</div>
    </div>
    <div class="item">
							 <img class="item" src="http://test1sn.vn/themes/songngu3/skin/images/slider2.png" />
			     
    </div>
   <div class="item">
							 <img class="item" src="http://test1sn.vn/themes/songngu3/skin/images/slider3.png" />
			    </div>
	 <div class="item">
      				 <img class="item" src="http://test1sn.vn/themes/songngu3/skin/images/slider4.png" />
			    </div>
  </div>

  <!-- Controls -->
  <a class="left carousel-control" href="#carousel-example-generic" role="button" data-slide="prev">
    <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
    <span class="sr-only">Previous</span>
  </a>
  <a class="right carousel-control" href="#carousel-example-generic" role="button" data-slide="next">
    <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
    <span class="sr-only">Next</span>
  </a>
</div>

<!--div class="item mgt30">
<div class="container">
	<marquee>
	Chương trình đã được bảo hộ bản quyền bởi cục Sở hữu Trí tuệ Việt Nam. Mọi vi phạm bản quyền chương trình đều bị xử lí theo pháp luật.
	</marquee>
	
</div>
</div-->

<div class="item">
	<div class="container hidden-xs menu2">
		<a href="http://test1sn.vn/home/detail">
					<img src="http://test1sn.vn/themes/songngu3/skin/images/gioithieusanpham2.png" />
				
		</a>
		<a href="#">
					<img src="http://test1sn.vn/themes/songngu3/skin/images/dungthu2.png" />
				
		</a>
		<a href="http://test1sn.vn/home/detail?tab8=1">
					<img src="http://test1sn.vn/themes/songngu3/skin/images/muasp2.png" />
				</a>
		<a href="http://test1sn.vn/huong-dan-su-dung-song-ngu">
					<img src="http://test1sn.vn/themes/songngu3/skin/images/huongdansd2.png" />
				
		</a>
		<a href="javascript:void(0);" data-toggle="modal" data-target="#home-review" >
					<img src="http://test1sn.vn/themes/songngu3/skin/images/danhgia2.png" />
				
		</a>
	</div>
	<div class="container visible-xs mb-menu2 mgt10">
		<a class="color1" href="http://test1sn.vn/home/detail">Giới thiệu</a>
		<a class="color2" href="#">Dùng thử</a>
		<a class="color3" href="http://test1sn.vn/home/detail?tab8=1">Mua sản phẩm</a>
		<a class="color4" href="http://test1sn.vn/huong-dan-su-dung-song-ngu">Hướng dẫn sử dụng	</a>
		<a class="color5" data-toggle="modal" data-target="#home-review"  href="javascript:void(0);">Đánh giá</a>
	</div>
</div>


<!-- Modal -->
<div id="home-review" class="modal fade" role="dialog">
  <div class="modal-dialog  modal-lg">

    <!-- Modal content-->
    <div class="modal-content bg-review">
		<button style="color: white;opacity: 1;width: 30px;font-size: 30px;position: absolute;right: 0px;" type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
		<div class="box-review">
			<div class="review-top">		
				<div class="item">
				<b>Full Look (Song ngữ Anh - Việt)</b> là phần mềm học tập được tạo ra với tất cả tâm huyết của chúng tôi nhằm hướng tới một nền giáo dục phát triển năng lực cho người học, đồng thời giúp học sinh Việt Nam từng bước tiếp cận chương trình tiếng Anh tích hợp với chi phí thấp nhất, hiệu quả nhất.

				Vì thế chúng tôi rất mong nhận được sự đóng góp ý kiến quý báu từ các chuyên gia, các bậc phụ huynh và các em học sinh để chương trình được hoàn thiện. Để lại lời nhận xét góp ý hay động viên của quý vị dưới đây : 
				</div>
				<textarea id="v_content" class="item"></textarea>
				Trân trọng cảm ơn!

			</div>
			<div class="review-footer item text-center">
				<div onclick="vote();" class="send-review"> GỬI ĐÁNH GIÁ</div>
			</div>
			<img class="absolute hidden-xs girl-review" src="http://test1sn.vn/themes/songngu3/skin/images/girl-review.png" />
			<img class="absolute hidden-xs bui" src="http://test1sn.vn/themes/songngu3/skin/images/bui.png" />
		</div>
       
    </div>

  </div>
</div>
<script>
	function vote() {
					var state = confirm("Bạn cần đăng nhập/ đăng kí mới được dùng thử");
			if(state == true){
				$('#home-review').modal('hide');
				$("#LoginModal").modal();
		}
			}
</script>




<div id="practice" class="item">
	<div class="container">
		<div class="text-center btnclick textlt">
		Luyện tập  - Lớp 5</br>
		-----
		</div>
	</div>
</div>

<div class="container top10">
<marquee>
Chương trình đã được bảo hộ bản quyền bởi cục Sở hữu Trí tuệ Việt Nam. Mọi vi phạm bản quyền chương trình đều bị xử lí theo pháp luật.
</marquee>

</div>

<div class="container mgb30" id="subject">
	<div id="practice-section" class="row fivecolumns">
		<!-- desktop -->
<div class="col-lg-2 col-md-2 col-sm-2 hidden-xs pd-40">
	<a href="#" onclick ="return false;" class="subjectclick" data-subject="51" data-alias="Mathematics" data-class="5">
		<div class="heightresponsive btn-custom3 white text-uppercase weight-12 text-center relative" >
			<div class="item hidden-xs">
				<img src="http://test1sn.vn/default/skin/nobel/themes/story/media/toan.png" alt="Mathematics" class=" img-responsive center-block">
			</div>
			<div class="top20 absolute item hidden-xs">
				<p>
				Toán học				</p>
			</div>
			<div class="top50 visible-xs">
				<p style="padding-top:30px;">
				Toán học				</p>
			</div>
		</div>
	</a>
</div>
<!-- mobile -->
<div class="col-xs-6 visible-xs top10">
	<a href="#" onclick ="return false;" class="subjectclick" data-subject="51" data-alias="Mathematics" data-class="5">
		<div class="heightresponsive btn-custom3 text-color text-uppercase weight-12 text-center sharp" >
			<div>
				<img src="http://test1sn.vn/default/skin/nobel/themes/story/media/toan.png" alt="Mathematics" class=" img-responsive center-block" width="35" height="35">
			</div>
			<div class="visible-xs">
				<p style="padding-top:10px;">
				Toán học				</p>
			</div>
		</div>
	</a>
</div>
<!-- desktop -->
<div class="col-lg-2 col-md-2 col-sm-2 hidden-xs pd-40">
	<a href="#" onclick ="return false;" class="subjectclick" data-subject="52" data-alias="Science" data-class="5">
		<div class="heightresponsive btn-custom3 white text-uppercase weight-12 text-center relative" >
			<div class="item hidden-xs">
				<img src="http://test1sn.vn/default/skin/nobel/themes/story/media/khoahoc.png" alt="Science" class=" img-responsive center-block">
			</div>
			<div class="top20 absolute item hidden-xs">
				<p>
				Khoa học				</p>
			</div>
			<div class="top50 visible-xs">
				<p style="padding-top:30px;">
				Khoa học				</p>
			</div>
		</div>
	</a>
</div>
<!-- mobile -->
<div class="col-xs-6 visible-xs top10">
	<a href="#" onclick ="return false;" class="subjectclick" data-subject="52" data-alias="Science" data-class="5">
		<div class="heightresponsive btn-custom3 text-color text-uppercase weight-12 text-center sharp" >
			<div>
				<img src="http://test1sn.vn/default/skin/nobel/themes/story/media/khoahoc.png" alt="Science" class=" img-responsive center-block" width="35" height="35">
			</div>
			<div class="visible-xs">
				<p style="padding-top:10px;">
				Khoa học				</p>
			</div>
		</div>
	</a>
</div>
<!-- desktop -->
<div class="col-lg-2 col-md-2 col-sm-2 hidden-xs pd-40">
	<a href="#" onclick ="return false;" class="subjectclick" data-subject="164" data-alias="english" data-class="5">
		<div class="heightresponsive btn-custom3 white text-uppercase weight-12 text-center relative" >
			<div class="item hidden-xs">
				<img src="http://test1sn.vn/default/skin/nobel/themes/story/media/tienganh.png" alt="english" class=" img-responsive center-block">
			</div>
			<div class="top20 absolute item hidden-xs">
				<p>
				Tiếng Anh				</p>
			</div>
			<div class="top50 visible-xs">
				<p style="padding-top:30px;">
				Tiếng Anh				</p>
			</div>
		</div>
	</a>
</div>
<!-- mobile -->
<div class="col-xs-6 visible-xs top10">
	<a href="#" onclick ="return false;" class="subjectclick" data-subject="164" data-alias="english" data-class="5">
		<div class="heightresponsive btn-custom3 text-color text-uppercase weight-12 text-center sharp" >
			<div>
				<img src="http://test1sn.vn/default/skin/nobel/themes/story/media/tienganh.png" alt="english" class=" img-responsive center-block" width="35" height="35">
			</div>
			<div class="visible-xs">
				<p style="padding-top:10px;">
				Tiếng Anh				</p>
			</div>
		</div>
	</a>
</div>
<!-- desktop -->
<div class="col-lg-2 col-md-2 col-sm-2 hidden-xs pd-40">
	<a href="#" onclick ="return false;" class="subjectclick" data-subject="157" data-alias="Literature" data-class="5">
		<div class="heightresponsive btn-custom3 white text-uppercase weight-12 text-center relative" >
			<div class="item hidden-xs">
				<img src="http://test1sn.vn/default/skin/nobel/themes/story/media/mt.png" alt="Literature" class=" img-responsive center-block">
			</div>
			<div class="top20 absolute item hidden-xs">
				<p>
				Văn học				</p>
			</div>
			<div class="top50 visible-xs">
				<p style="padding-top:30px;">
				Văn học				</p>
			</div>
		</div>
	</a>
</div>
<!-- mobile -->
<div class="col-xs-6 visible-xs top10">
	<a href="#" onclick ="return false;" class="subjectclick" data-subject="157" data-alias="Literature" data-class="5">
		<div class="heightresponsive btn-custom3 text-color text-uppercase weight-12 text-center sharp" >
			<div>
				<img src="http://test1sn.vn/default/skin/nobel/themes/story/media/mt.png" alt="Literature" class=" img-responsive center-block" width="35" height="35">
			</div>
			<div class="visible-xs">
				<p style="padding-top:10px;">
				Văn học				</p>
			</div>
		</div>
	</a>
</div>
<!-- desktop -->
<div class="col-lg-2 col-md-2 col-sm-2 hidden-xs pd-40">
	<a href="#" onclick ="return false;" class="subjectclick" data-subject="53" data-alias="History" data-class="5">
		<div class="heightresponsive btn-custom3 white text-uppercase weight-12 text-center relative" >
			<div class="item hidden-xs">
				<img src="http://test1sn.vn/default/skin/nobel/themes/story/media/lichsu.png" alt="History" class=" img-responsive center-block">
			</div>
			<div class="top20 absolute item hidden-xs">
				<p>
				Lịch sử				</p>
			</div>
			<div class="top50 visible-xs">
				<p style="padding-top:30px;">
				Lịch sử				</p>
			</div>
		</div>
	</a>
</div>
<!-- mobile -->
<div class="col-xs-6 visible-xs top10">
	<a href="#" onclick ="return false;" class="subjectclick" data-subject="53" data-alias="History" data-class="5">
		<div class="heightresponsive btn-custom3 text-color text-uppercase weight-12 text-center sharp" >
			<div>
				<img src="http://test1sn.vn/default/skin/nobel/themes/story/media/lichsu.png" alt="History" class=" img-responsive center-block" width="35" height="35">
			</div>
			<div class="visible-xs">
				<p style="padding-top:10px;">
				Lịch sử				</p>
			</div>
		</div>
	</a>
</div>
<!-- desktop -->
<div class="col-lg-2 col-md-2 col-sm-2 hidden-xs pd-40">
	<a href="#" onclick ="return false;" class="subjectclick" data-subject="50" data-alias="Geography" data-class="5">
		<div class="heightresponsive btn-custom3 white text-uppercase weight-12 text-center relative" >
			<div class="item hidden-xs">
				<img src="http://test1sn.vn/default/skin/nobel/themes/story/media/dialy.png" alt="Geography" class=" img-responsive center-block">
			</div>
			<div class="top20 absolute item hidden-xs">
				<p>
				Địa lý				</p>
			</div>
			<div class="top50 visible-xs">
				<p style="padding-top:30px;">
				Địa lý				</p>
			</div>
		</div>
	</a>
</div>
<!-- mobile -->
<div class="col-xs-6 visible-xs top10">
	<a href="#" onclick ="return false;" class="subjectclick" data-subject="50" data-alias="Geography" data-class="5">
		<div class="heightresponsive btn-custom3 text-color text-uppercase weight-12 text-center sharp" >
			<div>
				<img src="http://test1sn.vn/default/skin/nobel/themes/story/media/dialy.png" alt="Geography" class=" img-responsive center-block" width="35" height="35">
			</div>
			<div class="visible-xs">
				<p style="padding-top:10px;">
				Địa lý				</p>
			</div>
		</div>
	</a>
</div>
<!-- desktop -->
<div class="col-lg-2 col-md-2 col-sm-2 hidden-xs pd-40">
	<a href="#" onclick ="return false;" class="subjectclick" data-subject="87" data-alias="Life-skills" data-class="5">
		<div class="heightresponsive btn-custom3 white text-uppercase weight-12 text-center relative" >
			<div class="item hidden-xs">
				<img src="http://test1sn.vn/default/skin/nobel/themes/story/media/kynangnghe.png" alt="Life-skills" class=" img-responsive center-block">
			</div>
			<div class="top20 absolute item hidden-xs">
				<p>
				Kỹ năng sống				</p>
			</div>
			<div class="top50 visible-xs">
				<p style="padding-top:30px;">
				Kỹ năng sống				</p>
			</div>
		</div>
	</a>
</div>
<!-- mobile -->
<div class="col-xs-6 visible-xs top10">
	<a href="#" onclick ="return false;" class="subjectclick" data-subject="87" data-alias="Life-skills" data-class="5">
		<div class="heightresponsive btn-custom3 text-color text-uppercase weight-12 text-center sharp" >
			<div>
				<img src="http://test1sn.vn/default/skin/nobel/themes/story/media/kynangnghe.png" alt="Life-skills" class=" img-responsive center-block" width="35" height="35">
			</div>
			<div class="visible-xs">
				<p style="padding-top:10px;">
				Kỹ năng sống				</p>
			</div>
		</div>
	</a>
</div>
<!-- desktop -->
<div class="col-lg-2 col-md-2 col-sm-2 hidden-xs pd-40">
	<a href="#" onclick ="return false;" class="subjectclick" data-subject="59" data-alias="Social-understanding" data-class="5">
		<div class="heightresponsive btn-custom3 white text-uppercase weight-12 text-center relative" >
			<div class="item hidden-xs">
				<img src="http://test1sn.vn/default/skin/nobel/themes/story/media/hieubiet.png" alt="Social-understanding" class=" img-responsive center-block">
			</div>
			<div class="top20 absolute item hidden-xs">
				<p>
				Hiểu biết xã hội				</p>
			</div>
			<div class="top50 visible-xs">
				<p style="padding-top:30px;">
				Hiểu biết xã hội				</p>
			</div>
		</div>
	</a>
</div>
<!-- mobile -->
<div class="col-xs-6 visible-xs top10">
	<a href="#" onclick ="return false;" class="subjectclick" data-subject="59" data-alias="Social-understanding" data-class="5">
		<div class="heightresponsive btn-custom3 text-color text-uppercase weight-12 text-center sharp" >
			<div>
				<img src="http://test1sn.vn/default/skin/nobel/themes/story/media/hieubiet.png" alt="Social-understanding" class=" img-responsive center-block" width="35" height="35">
			</div>
			<div class="visible-xs">
				<p style="padding-top:10px;">
				Hiểu biết xã hội				</p>
			</div>
		</div>
	</a>
</div>
<!-- desktop -->
<div class="col-lg-2 col-md-2 col-sm-2 hidden-xs pd-40">
	<a href="#" onclick ="return false;" class="subjectclick" data-subject="88" data-alias="observing-listening" data-class="5">
		<div class="heightresponsive btn-custom3 white text-uppercase weight-12 text-center relative" >
			<div class="item hidden-xs">
				<img src="http://test1sn.vn/default/skin/nobel/themes/story/media/kynangquansat.png" alt="observing-listening" class=" img-responsive center-block">
			</div>
			<div class="top20 absolute item hidden-xs">
				<p>
				Luyện nghe và quan sát				</p>
			</div>
			<div class="top50 visible-xs">
				<p style="padding-top:30px;">
				Luyện nghe và quan sát				</p>
			</div>
		</div>
	</a>
</div>
<!-- mobile -->
<div class="col-xs-6 visible-xs top10">
	<a href="#" onclick ="return false;" class="subjectclick" data-subject="88" data-alias="observing-listening" data-class="5">
		<div class="heightresponsive btn-custom3 text-color text-uppercase weight-12 text-center sharp" >
			<div>
				<img src="http://test1sn.vn/default/skin/nobel/themes/story/media/kynangquansat.png" alt="observing-listening" class=" img-responsive center-block" width="35" height="35">
			</div>
			<div class="visible-xs">
				<p style="padding-top:10px;">
				Luyện nghe và quan sát				</p>
			</div>
		</div>
	</a>
</div>
<!-- desktop -->
<div class="col-lg-2 col-md-2 col-sm-2 hidden-xs pd-40">
	<a href="#" onclick ="return false;" class="subjectclick" data-subject="54" data-alias="Language-and-communication" data-class="5">
		<div class="heightresponsive btn-custom3 white text-uppercase weight-12 text-center relative" >
			<div class="item hidden-xs">
				<img src="http://test1sn.vn/default/skin/nobel/themes/story/media/cay.png" alt="Language-and-communication" class=" img-responsive center-block">
			</div>
			<div class="top20 absolute item hidden-xs">
				<p>
				Ngôn ngữ và giao tiếp				</p>
			</div>
			<div class="top50 visible-xs">
				<p style="padding-top:30px;">
				Ngôn ngữ và giao tiếp				</p>
			</div>
		</div>
	</a>
</div>
<!-- mobile -->
<div class="col-xs-6 visible-xs top10">
	<a href="#" onclick ="return false;" class="subjectclick" data-subject="54" data-alias="Language-and-communication" data-class="5">
		<div class="heightresponsive btn-custom3 text-color text-uppercase weight-12 text-center sharp" >
			<div>
				<img src="http://test1sn.vn/default/skin/nobel/themes/story/media/cay.png" alt="Language-and-communication" class=" img-responsive center-block" width="35" height="35">
			</div>
			<div class="visible-xs">
				<p style="padding-top:10px;">
				Ngôn ngữ và giao tiếp				</p>
			</div>
		</div>
	</a>
</div>
	</div>
</div>
<div id="practice-test" class="item">
	<div class="relative item">
		<img class="item" src="http://test1sn.vn/themes/songngu3/skin/images/bg1.png" />
		<div  class="item visible-xs hfix"></div>
		<div class="t-weight deluyentap textlt item text-center absolute">
		Đề luyện tập   - Lớp 5</br>
		-----
	</div>
	</div>
</div>



<div class="item bg2">

	<div id="practice-test-section" class="container mgt-25">
		<div class="row">
			
<div class="col-md-2 text-center col-xs-4 text-uppercase box-practice widthfix practicenumber" onclick ="return false;" data-test="74" data-week="400" data-trial="1" >
	<a href="" class="text-color">
	Đề dùng thử	</a>
</div>
<div class="col-md-2 text-center col-xs-4 text-uppercase box-practice widthfix practicenumber" onclick ="return false;" data-test="" data-week="355" data-trial="0" >
	<a href="" class="text-color">
	Tuần 1	</a>
</div>
<div class="col-md-2 text-center col-xs-4 text-uppercase box-practice widthfix practicenumber" onclick ="return false;" data-test="" data-week="357" data-trial="0" >
	<a href="" class="text-color">
	Tuần 3	</a>
</div>
<div class="col-md-2 text-center col-xs-4 text-uppercase box-practice widthfix practicenumber" onclick ="return false;" data-test="" data-week="364" data-trial="0" >
	<a href="" class="text-color">
	Tuần 5	</a>
</div>
<div class="col-md-2 text-center col-xs-4 text-uppercase box-practice widthfix practicenumber" onclick ="return false;" data-test="" data-week="366" data-trial="0" >
	<a href="" class="text-color">
	Tuần 7	</a>
</div>
<div class="col-md-2 text-center col-xs-4 text-uppercase box-practice widthfix practicenumber" onclick ="return false;" data-test="" data-week="368" data-trial="0" >
	<a href="" class="text-color">
	Tuần 9	</a>
</div>
<div class="col-md-2 text-center col-xs-4 text-uppercase box-practice widthfix practicenumber" onclick ="return false;" data-test="" data-week="370" data-trial="0" >
	<a href="" class="text-color">
	Tuần 11	</a>
</div>
<div class="col-md-2 text-center col-xs-4 text-uppercase box-practice widthfix practicenumber" onclick ="return false;" data-test="" data-week="372" data-trial="0" >
	<a href="" class="text-color">
	Tuần 13	</a>
</div>
<div class="col-md-2 text-center col-xs-4 text-uppercase box-practice widthfix practicenumber" onclick ="return false;" data-test="" data-week="374" data-trial="0" >
	<a href="" class="text-color">
	Tuần 15	</a>
</div>
<div class="col-md-2 text-center col-xs-4 text-uppercase box-practice widthfix practicenumber" onclick ="return false;" data-test="" data-week="376" data-trial="0" >
	<a href="" class="text-color">
	Tuần 17	</a>
</div>
<div class="col-md-2 text-center col-xs-4 text-uppercase box-practice widthfix practicenumber" onclick ="return false;" data-test="" data-week="378" data-trial="0" >
	<a href="" class="text-color">
	Tuần 19	</a>
</div>

<!--div class="col-md-2 text-center col-xs-4 text-uppercase box-practice  widthfix other" onclick ="return false;">
	<a href="" class="text-color"><?php// if(!$items){ echo "Đang cập nhật!";}else{ echo "...";} ?></a>
</div-->

<script>
$(".practicenumber").click(function(){
			var state = confirm("Bạn cần đăng nhập/ đăng kí mới được dùng thử");
		if(state == true){
			$("#LoginModal").modal();
		}
	});
$(".other").click(function(){
			var state = confirm("Bạn cần đăng nhập/ đăng kí mới được dùng thử");
		if(state == true){
			$("#LoginModal").modal();
		}
	});
</script>		</div>
	</div>
	<div id="test" class="container">
		<div class="t-weight text-center textlt mgb15 item">Đề kiểm tra		 - Lớp 5</br>
		-----
		</div>
	</div>
	<div id="test-section" class="container pdb80">
		<div class="row">
			<div class="col-md-2 text-center col-xs-4 text-uppercase box-practice widthfix testnumber" onclick ="return false;" data-test="25" data-week="401" data-trial="1" >
	<a href="" class="text-color">
	Đề dùng thử	</a>
</div>
<div class="col-md-2 text-center col-xs-4 text-uppercase box-practice widthfix testnumber" onclick ="return false;" data-test="" data-week="356" data-trial="0" >
	<a href="" class="text-color">
	Tuần 2	</a>
</div>
<div class="col-md-2 text-center col-xs-4 text-uppercase box-practice widthfix testnumber" onclick ="return false;" data-test="" data-week="363" data-trial="0" >
	<a href="" class="text-color">
	Tuần 4	</a>
</div>
<div class="col-md-2 text-center col-xs-4 text-uppercase box-practice widthfix testnumber" onclick ="return false;" data-test="" data-week="365" data-trial="0" >
	<a href="" class="text-color">
	Tuần 6	</a>
</div>
<div class="col-md-2 text-center col-xs-4 text-uppercase box-practice widthfix testnumber" onclick ="return false;" data-test="" data-week="367" data-trial="0" >
	<a href="" class="text-color">
	Tuần 8	</a>
</div>
<div class="col-md-2 text-center col-xs-4 text-uppercase box-practice widthfix testnumber" onclick ="return false;" data-test="" data-week="369" data-trial="0" >
	<a href="" class="text-color">
	Tuần 10	</a>
</div>
<div class="col-md-2 text-center col-xs-4 text-uppercase box-practice widthfix testnumber" onclick ="return false;" data-test="" data-week="371" data-trial="0" >
	<a href="" class="text-color">
	Tuần 12	</a>
</div>
<div class="col-md-2 text-center col-xs-4 text-uppercase box-practice widthfix testnumber" onclick ="return false;" data-test="" data-week="373" data-trial="0" >
	<a href="" class="text-color">
	Tuần 14	</a>
</div>
<div class="col-md-2 text-center col-xs-4 text-uppercase box-practice widthfix testnumber" onclick ="return false;" data-test="" data-week="375" data-trial="0" >
	<a href="" class="text-color">
	Tuần 16	</a>
</div>
<div class="col-md-2 text-center col-xs-4 text-uppercase box-practice widthfix testnumber" onclick ="return false;" data-test="" data-week="377" data-trial="0" >
	<a href="" class="text-color">
	Tuần 18	</a>
</div>
<div class="col-md-2 text-center col-xs-4 text-uppercase box-practice widthfix testnumber" onclick ="return false;" data-test="" data-week="379" data-trial="0" >
	<a href="" class="text-color">
	Tuần 20	</a>
</div>
<div class="col-md-2 text-center col-xs-4 text-uppercase box-practice widthfix testnumber" onclick ="return false;" data-test="" data-week="381" data-trial="0" >
	<a href="" class="text-color">
	Tuần 22	</a>
</div>
<div class="col-md-2 text-center col-xs-4 text-uppercase box-practice widthfix testnumber" onclick ="return false;" data-test="" data-week="383" data-trial="0" >
	<a href="" class="text-color">
	Tuần 24	</a>
</div>
<div class="col-md-2 text-center col-xs-4 text-uppercase box-practice widthfix testnumber" onclick ="return false;" data-test="" data-week="385" data-trial="0" >
	<a href="" class="text-color">
	Tuần 26	</a>
</div>
<div class="col-md-2 text-center col-xs-4 text-uppercase box-practice widthfix testnumber" onclick ="return false;" data-test="" data-week="387" data-trial="0" >
	<a href="" class="text-color">
	Tuần 28	</a>
</div>
<div class="col-md-2 text-center col-xs-4 text-uppercase box-practice widthfix testnumber" onclick ="return false;" data-test="" data-week="389" data-trial="0" >
	<a href="" class="text-color">
	Tuần 30	</a>
</div>
<div class="col-md-2 text-center col-xs-4 text-uppercase box-practice widthfix testnumber" onclick ="return false;" data-test="" data-week="391" data-trial="0" >
	<a href="" class="text-color">
	Tuần 32	</a>
</div>
<div class="col-md-2 text-center col-xs-4 text-uppercase box-practice widthfix testnumber" onclick ="return false;" data-test="" data-week="393" data-trial="0" >
	<a href="" class="text-color">
	Tuần 34	</a>
</div>
<!--div class="col-md-2 text-center col-xs-4 text-uppercase box-practice widthfix other2" onclick ="return false;">
	<a href="" class="text-color"></a>
</div-->

<script>
$(".testnumber").click(function(){
			var state = confirm("Bạn cần đăng nhập/ đăng kí mới được dùng thử");
		if(state == true){
			$("#LoginModal").modal();
		}
	});
$(".other2").click(function(){
			var state = confirm("Bạn cần đăng nhập/ đăng kí mới được dùng thử");
		if(state == true){
			$("#LoginModal").modal();
		}
			
});
</script>		</div>
	</div>

</div>

<div class="item bg3">
	<div class=" text-center white fs30 cadena mgb30 mgt60 item">
	
		Góc giải trí</br>
		-----
	</div>
	<div class="container ">
		<div class="col-md-6 col-xs-12">
			<div class="col-md-6 col-xs-12">
				<img class="item" src="http://test1sn.vn/themes/songngu3/skin/images/quatang.png" />
			</div>
			<div class="col-md-6 col-xs-12 ">
				<div class="white uppercase  bold mgb5 fs30">
					Quà tặng:
				</div>
				<div class="white mgb10">
					Quà tặng tháng 3: FROZEN - Let It Go Sing-along, a song from Walt Disney.
				</div>
				<a href="http://test1sn.vn/gift">
											<img src="http://test1sn.vn/themes/songngu3/skin/images/nhanngay.png" />
									</a>
			</div>
		</div>
		
		<div class="col-md-6 col-xs-12">
			<div class="col-md-6 col-xs-12">
				<img class="item" src="http://test1sn.vn/themes/songngu3/skin/images/startgame.png" />
			</div>
			<div class="col-md-6 col-xs-12">
				<div class="white uppercase cadena mgb5 fs30">
					Games:
				</div>
				<div class="white mgb10">
					WORD RAIN: Choose the words that belong to the animal topic?
				</div>
				<a href="http://test1sn.vn/game">
									<img src="http://test1sn.vn/themes/songngu3/skin/images/choingay.png" />
								</a>
			</div>
		</div>
		<div class="item h145"></div>
	</div>
</div>

<div class="item bg4">
	<div class=" text-center  fs30 cadena mgt10 item">
	BẢNG VÀNG THÀNH TÍCH</br>
	- - - - -
	</div>
	
		<div class='achievement item'>
	<div class="container">
				<b class ='title-achievement item mgb15 text-center'>Bảng thành tích tuần 25<br><span style='font-weight: normal;'>(19-06-2017 đến 25-06-2017		
		)</span></b> 
		<div class="item">
			<div class="col-md-3 col-xs-12"></div>
			<div class="col-md-3 col-xs-12">
						
			
			
			</div>
			
			
			<div class="col-md-3 col-xs-12">
						 </div>
			 
			 <div class="col-md-3 col-xs-12">
						</div>
		</div>
		
		<div class="item">
			<div class="col-md-offset-3 "> 
				<a href='/home/achievement'>
									<img class="mgb40 mgt10 mgl40" src="http://test1sn.vn/themes/songngu3/skin/images/xemthem.png" />
								</a>
			</div>
		</div>
		 
	 </div>
  </div>

		


</div>

<div class="item">
			<img class="item hidden-xs" src="http://test1sn.vn/themes/songngu3/skin/images/lydo.png" />
				<img class="item visible-xs" src="http://test1sn.vn/themes/songngu3/skin/images/mb_lydo.png" />
	</div>

<div class="item bg5">
	<div class="container mgb70">
		<div class="col-md-6 col-xs-12">
			<div class="text-center item mgt70 mgb20 uppercase title_color fs30 cadena">Đăng ký tư vấn</div>
			<div class="bgeaf formdk item">
				<p>Họ và tên:</p>
				<input id="tv_name" name="" class="item" />
				<p>Số điện thoại:</p>
				<input id="tv_phone" name="phone" class="item" />
				<p>Email:</p>
				<input id="tv_email" name="email" class="item" />
				<div onclick="dangkituvan();" class="item pointer text-center">
											<img src="http://test1sn.vn/themes/songngu3/skin/images/dangki.png" />
									</div>
			</div>
		</div>
		<div class="col-md-6 col-xs-12">
			<div class="text-center item mgt70 mgb20 uppercase title_color fs30 cadena">ƯU ĐÃI HỌC PHÍ (giảm 30%)</div>
			<div class="bgeaf box-mua item">
				<div class="inline-block middle">
					<b>Gói 1. Học ôn bằng tiếng Việt</b> <br>
					(600.000 VND/ 1 năm) <br>
					CHỈ CÒN <b>420.000 VND</b> <br>				</div>
				<div class="inline-block pull-right middle">
					<a href="http://test1sn.vn/home/detail?tab8=1">
											<img src="http://test1sn.vn/themes/songngu3/skin/images/muangay.png" />
										</a>
				</div>
			</div>
			<div class="bgeaf box-mua item">
				<div class="inline-block middle">
					<b>Gói 2. Học ôn bằng tiếng Anh</b><br>
					(600.000 VND/ 1 năm)<br>
					CHỈ CÒN <b>420.000</b> VND<br>				</div>
				<div class="inline-block pull-right middle">
					<a href="http://test1sn.vn/home/detail?tab8=1">
											<img src="http://test1sn.vn/themes/songngu3/skin/images/muangay.png" />
										</a>
				</div>
			</div>
			<div class="bgeaf box-mua item">
				<div class="inline-block middle">
				<b>Gói 3. Học ôn Song ngữ Anh - Việt</b><br>
				(600.000 VND/ 5 tháng)<br>
				CHỈ CÒN <b>420.000</b> VND<br>				</div>
				<div class="inline-block pull-right middle">
					<a href="http://test1sn.vn/home/detail?tab8=1">
											<img src="http://test1sn.vn/themes/songngu3/skin/images/muangay.png" />
										</a>
				</div>
			</div>
			<div class="bgeaf box-mua item">
				<div class="inline-block middle">
				<b>Gói 4. Học ôn Song ngữ Anh - Việt</b><br>
				(900.000 VND/ 12 tháng)<br>
				CHỈ CÒN <b>630.000</b> VND<br>				</div>
				<div class="inline-block pull-right middle">
					<a href="http://test1sn.vn/home/detail?tab8=1">
											<img src="http://test1sn.vn/themes/songngu3/skin/images/muangay.png" />
										</a>
				</div>
			</div>
		</div>
	</div>
</div>

<div class="item bg6">
<div class="container hidden-xs">

	<div class=" fff223 text-center  fs30 cadena mgt30 mgb15 item">
	Ý KIẾN CHUYÊN GIA VÀ NGƯỜI DÙNG</br>
	- - - - -
	</div>
	

	<div id="slidebootstrap" class="carousel mgb40 slide text-center" data-ride="carousel">
		<div class="carousel-inner" role="listbox">	
			<div class="item active">
				<div class="col-sm-5 col-xs-12 col-sm-offset-1 col-md-offset-1 col-md-5">
				 <div class="thumbnail relative">
				 
					 <p class="text-justify"> Một phần mềm bắt kịp xu hướng đổi mới của nền Giáo dục, đó là xu hướng dạy học, kiểm tra đánh giá theo hướng phát triển năng lực của học sinh. Cái hay nhất của nó là tất cả những nội dung ấy được diễn đạt bằng thứ tiếng Anh vừa đơn giản, vừa chuẩn mực.											 </p>
					 <i class="fa absolute care white fa-sort-desc" aria-hidden="true"></i>
				  </div>
					
					<div class="media">
					  <div class="media-left">
						<a href="#">
						  
							<div class="img-circle" style="display: inline-block; width: 80px; height: 80px; overflow: hidden;">
								<img class="media-object" src="http://test1sn.vn/default/skin/nobel/themes/story/media/11.jpg" alt="Sandy" style="width:80px;">
							</div>
						</a>
					  </div>
					  <div class="media-body white text-left">
						<b>Chuyên gia Sandra</b></br> (Giảng viên khoa quốc tế, đại học quốc gia HN)					  </div>
					</div>
				
				 
					
					
					
				 
				</div>
				<div class="col-sm-5 col-xs-12 col-md-5">
					<div class="thumbnail relative">
      
						<p class="text-justify">Lần đầu tiên ở Việt Nam có phần mềm Song ngữ Anh - Việt cho mọi môn học. Đó là xu hướng của giáo dục hiện đại và nhiều trường cấp 2  trên toàn quốc đã thí điểm mô hình này. Việc xây dựng chương trình song ngữ cho cấp Tiểu học là bước đà để các em có thể bắt nhịp với xu hướng mới khi lên cấp 2, giúp các em từng bước tiếp cận kiến thức mới, tránh áp lực dồn tích, tạo nền tảng vững chắc cho quá trình tìm kiếm học bổng và quá trình hoà nhập với môi trường học tập quốc tế sau này.						</p>
						<i class="fa absolute care white fa-sort-desc" aria-hidden="true"></i>
					</div>
					
					
					<div class="media">
					  <div class="media-left">
						<a href="#">
						  
							<div class="img-circle" style="display: inline-block; width: 80px; height: 80px; overflow: hidden;">
								<img class="media-object" src="http://test1sn.vn/default/skin/nobel/themes/story/media/12.jpg" alt="Sandy" style="width:80px;">
							</div>
						</a>
					  </div>
					  <div class="media-body white text-left">
						<b>Tiến Sĩ Nguyễn Thanh Tùng</b> </br> (Đại học Sư Phạm Hà Nội)					  </div>
					</div>
					
				</div>
			</div>
			<div class="item">
				<div class="col-sm-5  col-sm-offset-1 col-md-offset-1 col-md-5 col-xs-12">
				  <div class="thumbnail relative">
					
					<p class="text-justify">Đây là cách học Song ngữ cho mọi môn học lần đầu tiên ở Việt Nam. Với 3 chế độ hiển thị ngôn ngữ (Tiếng Anh, Tiếng Việt hoặc Song ngữ) tuỳ người dùng lựa chọn, tôi thấy đây là phần mềm có khả năng ứng dụng cao với nhiều đối tượng HS khác nhau trên toàn quốc. Nội dung các câu hỏi gần gũi thực tế, cập nhật và thiết thực, đặc biệt có sức khơi mở tư duy cho HS.					</p>
					<i class="fa absolute care white fa-sort-desc" aria-hidden="true"></i>
				  </div>
				  
				  <div class="media">
					  <div class="media-left">
						<a href="#">
						  
							<div class="img-circle" style="display: inline-block; width: 80px; height: 80px; overflow: hidden;">
								<img class="media-object" src="http://test1sn.vn/default/skin/nobel/themes/story/media/chinga.png" alt="Sandy" style="width:80px;">
							</div>
						</a>
					  </div>
					  <div class="media-body white text-left">
						<b>Chị Trần Việt Nga</b> </br> (Báo Giáo dục & Thời đại)					  </div>
					</div>
				  
				  
				</div>
				<div class="col-sm-5  col-md-5 col-xs-12">
					<div class="thumbnail relative">
						
      
						<p class="text-justify"> Mình đã cho con dùng. Bạn ấy thích tiếng Anh, cho nên khi làm bài, vừa được ôn tập kiến thức các môn học khác lại được tích hợp với tiếng Anh, bạn ấy có động lực hẳn lên.<br>
						
						</p>
						<i class="fa absolute care white fa-sort-desc" aria-hidden="true"></i>
					</div>
					
					<div class="media">
					  <div class="media-left">
						<a href="#">
						  
							<div class="img-circle" style="display: inline-block; width: 80px; height: 80px; overflow: hidden;">
								<img class="media-object" src="http://test1sn.vn/default/skin/nobel/themes/story/media/chihuyen.jpg" alt="Sandy" style="width:80px;">
							</div>
						</a>
					  </div>
					  <div class="media-body white text-left">
						<b>Chị Trần Thu Huyền</b></br>(Phụ huynh HS Lương Trần Ngọc Minh, Trường Tiểu học Vinschool, Hà Nội)					  </div>
					</div>
					
					
				</div>
			</div>
			<div class="item">
				<div class="col-sm-5  col-sm-offset-1 col-md-offset-1 col-md-5 col-xs-12">
				  <div class="thumbnail relative">
					
					<p class="text-justify">Mỗi buổi tối mẹ giao cho con học 1 file từ vựng tiếng Anh trong phần mềm . Con học trong khoảng 10 - 15 phút trước khi đi ngủ. Hôm học Toán – Tiếng Anh, hôm học Khoa học – Tiếng Anh; Hôm học môn Văn…Tuy vậy, con vẫn chưa đủ tự tin để học các môn bằng chế độ tiếng Anh. Con thường xuyên ôn tập mọi môn học bằng chế độ Song ngữ (Câu hỏi các môn học được viết bằng tiếng Anh, dịch Tiếng Việt bên dưới)</p>
					<i class="fa absolute care white fa-sort-desc" aria-hidden="true"></i>
				  </div>
				  
				  <div class="media">
					  <div class="media-left">
						<a href="#">
						  
							<div class="img-circle" style="display: inline-block; width: 80px; height: 80px; overflow: hidden;">
								<img class="media-object" src="http://test1sn.vn/default/skin/nobel/themes/story/media/anh.png" alt="anh" style="width:80px;">
							</div>
						</a>
					  </div>
					  <div class="media-body white text-left">
						<b>Nguyễn Nguyên Anh</b></br>(HS Trường Tiểu học Lý Tự Trọng, TP Thanh Hoá)					  </div>
					</div>
				  
				</div>
				
				<div class="col-sm-5  col-xs-12 col-md-5">
					<div class="thumbnail relative">
						
      
						<p class="text-justify"> Con thích nhất là học Toán, Khoa học và Hiểu biết xã hội trong chương trình này. Hiện tại con mới dùng được chế độ ngôn ngữ tiếng Việt nhưng con thường xuyên chọn học mục Từ vựng tiếng Anh của các môn này. Con hy vọng từ giờ đến hè con sẽ tích luỹ đủ vốn từ để có thể chuyển sang chế độ học các môn bằng Tiếng Anh						</p>
						<i class="fa absolute care white fa-sort-desc" aria-hidden="true"></i>
					</div>
					
					 <div class="media">
					  <div class="media-left">
						<a href="#">
						  
							<div class="img-circle" style="display: inline-block; width: 80px; height: 80px; overflow: hidden;">
								<img class="media-object" src="http://test1sn.vn/default/skin/nobel/themes/story/media/duc.png" alt="duc" style="width:80px;">
							</div>
						</a>
					  </div>
					  <div class="media-body white text-left">
						<b>Nguyễn Minh Đức</b> </br>(HS lớp 5H, TH Dịch Vọng A, Hà Nội.)					  </div>
					</div>
					
				</div>
			</div>
			<div class="item">
				<div class="col-sm-5  col-sm-offset-1 col-md-offset-1 col-md-5 col-xs-12">
				  <div class="thumbnail relative">
					
					<p class="text-justify">Nhờ có phần mềm Full Look Song ngữ mà Tết năm nay gia đình tôi có thể thoải mái du xuân, không cần mang theo sách vở cũng không lo con quên kiến thức. Ngoài việc giúp con ôn tập các bài học trên lớp, phần mềm còn giúp trẻ mở rộng vốn hiểu biết và những kĩ năng cần thiết trong cuộc sống. Tôi đặc biệt thích các đề luyện tập của phần mềm vì tính thiết thực của nó</p>
					<i class="fa absolute care white fa-sort-desc" aria-hidden="true"></i>
				  </div>
				  
				  <div class="media">
					  <div class="media-left">
						<a href="#">
						  
							<div class="img-circle" style="display: inline-block; width: 80px; height: 80px; overflow: hidden;">
								<img class="media-object" src="http://test1sn.vn/default/skin/nobel/themes/story/media/hang.png" alt="hang" style="width:80px;">
							</div>
						</a>
					  </div>
					  <div class="media-body white text-left">
						<b>Chị Vũ Diễm Hằng</b></br> (Mẹ bé Trần Thanh Huyền - HS trườngTiểu học B Thị trấn Văn Điển;  Giải nhất thi IOE và giao lưu tiếng Anh cấp Huyện)					  </div>
					</div>
				  
				</div>
				<div class="col-sm-5  col-xs-12 col-md-5">
					<div class="thumbnail relative">
						
      
						<p class="text-justify">Đây là chương trình được biên soạn tâm huyết, công phu. Các con có thể ôn tổng hợp kiến thức các môn bằng tiếng Việt, đồng thời được trau dồi, cải thiện tiếng Anh của mình ở hầu hết các môn học và một số lĩnh vực đời sống, xã hội. Đây là chương trình thực sự hữu ích, nhằm bổ trợ kiến thức và văn hoá bằng cả tiếng Việt và tiếng Anh, hỗ trợ người học rất nhiều trong quá trình học tập và giao tiếp.						</p>
						<i class="fa absolute care white fa-sort-desc" aria-hidden="true"></i>
					</div>
					
					<div class="media">
					  <div class="media-left">
						<a href="#">
						  
							<div class="img-circle" style="display: inline-block; width: 80px; height: 80px; overflow: hidden;">
								<img class="media-object" src="http://test1sn.vn/default/skin/nobel/themes/story/media/cong.png" alt="cong" style="width:80px;">
							</div>
						</a>
					  </div>
					  <div class="media-body white text-left">
						<b>Anh Vũ Đức Công</b> </br>(Cán bộ cao cấp tại Đại sứ quán Úc, Hà Nội <br> PH bé Vũ Minh Hạnh, HS lớp 5B, Trường Tiểu học Quan Hoa, Hà Nội)					  </div>
					</div>
					
				</div>
			</div>
		</div>
		<!-- Left and right controls -->
		  <a class="left carousel-control" href="#slidebootstrap" role="button" data-slide="prev">
			<span class="glyphicon fff223 glyphicon-chevron-left" aria-hidden="true"></span>
			<span class="sr-only">Previous</span>
		  </a>
		  <a class="right carousel-control" href="#slidebootstrap" role="button" data-slide="next">
			<span class="glyphicon fff223 glyphicon-chevron-right" aria-hidden="true"></span>
			<span class="sr-only">Next</span>
		  </a>
	</div>
</div>
<div class="container visible-xs">
	<div id="slidebootstrap-mb" class="carousel slide text-center" data-ride="carousel">
		<div class="carousel-inner" role="listbox">	
			<div class="row item active">
				<div class="col-xs-12">
					<div class="thumbnail">
						<div class="img-circle" style="display: inline-block; width: 80px; height: 80px; overflow: hidden;">
							<img src="http://test1sn.vn/default/skin/nobel/themes/story/media/11.jpg" alt="Sandy" style="width:80px;">
						</div>
						<p class="text-justify"><i class="fa fa-quote-left fa-2x"></i>  Một phần mềm bắt kịp xu hướng đổi mới của nền Giáo dục, đó là xu hướng dạy học, kiểm tra đánh giá theo hướng phát triển năng lực của học sinh. Cái hay nhất của nó là tất cả những nội dung ấy được diễn đạt bằng thứ tiếng Anh vừa đơn giản, vừa chuẩn mực.<br>
						<strong><b>Chuyên gia Sandra</b></br> (Giảng viên khoa quốc tế, đại học quốc gia HN)</strong><i class="fa fa-quote-right fa-2x"></i></p>
					</div>
				</div>
			</div>
			<div class="row item">
				<div class="col-xs-12">
					<div class="thumbnail">
						<div class="img-circle" style="display: inline-block; width: 80px; height: 80px; overflow: hidden;">
							<img src="http://test1sn.vn/default/skin/nobel/themes/story/media/12.jpg" alt="Anh Tùng" style="width:80px;">
						</div>
						<p class="text-justify"><i class="fa fa-quote-left fa-2x"></i> Lần đầu tiên ở Việt Nam có phần mềm Song ngữ Anh - Việt cho mọi môn học. Đó là xu hướng của giáo dục hiện đại và nhiều trường cấp 2  trên toàn quốc đã thí điểm mô hình này. Việc xây dựng chương trình song ngữ cho cấp Tiểu học là bước đà để các em có thể bắt nhịp với xu hướng mới khi lên cấp 2, giúp các em từng bước tiếp cận kiến thức mới, tránh áp lực dồn tích, tạo nền tảng vững chắc cho quá trình tìm kiếm học bổng và quá trình hoà nhập với môi trường học tập quốc tế sau này.<br>
						<strong><b>Tiến Sĩ Nguyễn Thanh Tùng</b> </br> (Đại học Sư Phạm Hà Nội)</strong><i class="fa fa-quote-right fa-2x"></i>
						</p>
					</div>
				</div>
			</div>
			
			<div class="row item">
				<div class="col-xs-12">
					<div class="thumbnail">
						<div class="img-circle" style="display: inline-block; width: 80px; height: 80px; overflow: hidden;">
							<img src="http://test1sn.vn/default/skin/nobel/themes/story/media/chinga.png" alt="Chị Nga" style="width:80px;">
						</div>
						<p class="text-justify"><i class="fa fa-quote-left fa-2x"></i> Đây là cách học Song ngữ cho mọi môn học lần đầu tiên ở Việt Nam. Với 3 chế độ hiển thị ngôn ngữ (Tiếng Anh, Tiếng Việt hoặc Song ngữ) tuỳ người dùng lựa chọn, tôi thấy đây là phần mềm có khả năng ứng dụng cao với nhiều đối tượng HS khác nhau trên toàn quốc. Nội dung các câu hỏi gần gũi thực tế, cập nhật và thiết thực, đặc biệt có sức khơi mở tư duy cho HS.<br>
						<strong><b>Chị Trần Việt Nga</b> </br> (Báo Giáo dục & Thời đại)</strong><i class="fa fa-quote-right fa-2x"></i>
						</p>
					</div>
				</div>
			</div>
			<div class="row item">
				<div class="col-xs-12">
					<div class="thumbnail">
						<div class="img-circle" style="display: inline-block; width: 80px; height: 80px; overflow: hidden;">
							<img src="http://test1sn.vn/default/skin/nobel/themes/story/media/chihuyen.jpg" alt="Chị Huyền" style="width:80px;">
						</div>
						<p class="text-justify"><i class="fa fa-quote-left fa-2x"></i> Mình đã cho con dùng. Bạn ấy thích tiếng Anh, cho nên khi làm bài, vừa được ôn tập kiến thức các môn học khác lại được tích hợp với tiếng Anh, bạn ấy có động lực hẳn lên.<br>
						<strong><b>Chị Trần Thu Huyền</b></br>(Phụ huynh HS Lương Trần Ngọc Minh, Trường Tiểu học Vinschool, Hà Nội)</strong><i class="fa fa-quote-right fa-2x"></i>
						</p>
					</div>
				</div>
			</div>
			
			<div class="row item">
				<div class="col-xs-12">
					<div class="thumbnail">
						<div class="img-circle" style="display: inline-block; width: 80px; height: 80px; overflow: hidden;">
							<img src="http://test1sn.vn/default/skin/nobel/themes/story/media/anh.png" alt="Anh" style="width:80px;">
						</div>
						<p class="text-justify"><i class="fa fa-quote-left fa-2x"></i> Mỗi buổi tối mẹ giao cho con học 1 file từ vựng tiếng Anh trong phần mềm . Con học trong khoảng 10 - 15 phút trước khi đi ngủ. Hôm học Toán – Tiếng Anh, hôm học Khoa học – Tiếng Anh; Hôm học môn Văn…Tuy vậy, con vẫn chưa đủ tự tin để học các môn bằng chế độ tiếng Anh. Con thường xuyên ôn tập mọi môn học bằng chế độ Song ngữ (Câu hỏi các môn học được viết bằng tiếng Anh, dịch Tiếng Việt bên dưới)<br>
						<strong><b>Nguyễn Nguyên Anh</b></br>(HS Trường Tiểu học Lý Tự Trọng, TP Thanh Hoá)</strong><i class="fa fa-quote-right fa-2x"></i>
						</p>
					</div>
				</div>
			</div>
			<div class="row item">
				<div class="col-xs-12">
					<div class="thumbnail">
						<div class="img-circle" style="display: inline-block; width: 80px; height: 80px; overflow: hidden;">
							<img src="http://test1sn.vn/default/skin/nobel/themes/story/media/duc.png" alt="Anh Đức" style="width:80px;">
						</div>
						<p class="text-justify"><i class="fa fa-quote-left fa-2x"></i> Con thích nhất là học Toán, Khoa học và Hiểu biết xã hội trong chương trình này. Hiện tại con mới dùng được chế độ ngôn ngữ tiếng Việt nhưng con thường xuyên chọn học mục Từ vựng tiếng Anh của các môn này. Con hy vọng từ giờ đến hè con sẽ tích luỹ đủ vốn từ để có thể chuyển sang chế độ học các môn bằng Tiếng Anh<br>
						<strong><b>Nguyễn Minh Đức</b> </br>(HS lớp 5H, TH Dịch Vọng A, Hà Nội.)</strong><i class="fa fa-quote-right fa-2x"></i>
						</p>
					</div>
				</div>
			</div>
			
			<div class="row item">
				<div class="col-xs-12">
					<div class="thumbnail">
						<div class="img-circle" style="display: inline-block; width: 80px; height: 80px; overflow: hidden;">
							<img src="http://test1sn.vn/default/skin/nobel/themes/story/media/hang.png" alt="Chị Hằng" style="width:80px;">
						</div>
						<p class="text-justify"><i class="fa fa-quote-left fa-2x"></i> Nhờ có phần mềm Full Look Song ngữ mà Tết năm nay gia đình tôi có thể thoải mái du xuân, không cần mang theo sách vở cũng không lo con quên kiến thức. Ngoài việc giúp con ôn tập các bài học trên lớp, phần mềm còn giúp trẻ mở rộng vốn hiểu biết và những kĩ năng cần thiết trong cuộc sống. Tôi đặc biệt thích các đề luyện tập của phần mềm vì tính thiết thực của nó<br>
						<strong><b>Chị Vũ Diễm Hằng</b></br> (Mẹ bé Trần Thanh Huyền - HS trườngTiểu học B Thị trấn Văn Điển;  Giải nhất thi IOE và giao lưu tiếng Anh cấp Huyện)</strong><i class="fa fa-quote-right fa-2x"></i>
						</p>
					</div>
				</div>
			</div>
			<div class="row item">
				<div class="col-xs-12">
					<div class="thumbnail">
						<div class="img-circle" style="display: inline-block; width: 80px; height: 80px; overflow: hidden;">
							<img src="http://test1sn.vn/default/skin/nobel/themes/story/media/cong.png" alt="Anh Công" style="width:80px;">
						</div>
						<p class="text-justify"><i class="fa fa-quote-left fa-2x"></i> Đây là chương trình được biên soạn tâm huyết, công phu. Các con có thể ôn tổng hợp kiến thức các môn bằng tiếng Việt, đồng thời được trau dồi, cải thiện tiếng Anh của mình ở hầu hết các môn học và một số lĩnh vực đời sống, xã hội. Đây là chương trình thực sự hữu ích, nhằm bổ trợ kiến thức và văn hoá bằng cả tiếng Việt và tiếng Anh, hỗ trợ người học rất nhiều trong quá trình học tập và giao tiếp.<br>
						<strong><b>Anh Vũ Đức Công</b> </br>(Cán bộ cao cấp tại Đại sứ quán Úc, Hà Nội <br> PH bé Vũ Minh Hạnh, HS lớp 5B, Trường Tiểu học Quan Hoa, Hà Nội)</strong><i class="fa fa-quote-right fa-2x"></i>
						</p>
					</div>
				</div>
			</div>
			
			
		</div>
	</div>
</div>
	<div class=" fff223 text-center  fs30 cadena mgt10 item">
		THỐNG KÊ</br>
		- - - - -
	</div>
		<div class="container mgb50">
		<div class="col-md-3 col-xs-12"> <b class="fff223 fs28" >11287</b> <span class="fs16 white"> Thành viên </span>	</div>		
		<div class="col-md-3 col-xs-12"> <b class="fff223 fs28" >803</b> <span class="fs16 white">
		 
		Thành viên mới		</span>	</div>	
		<div class="col-md-3 col-xs-12"> <b class="fff223 fs28" >0</b> <span class="fs16 white">
		Người đang học trực tuyến		
		 </span>	</div>		
		<div class="col-md-3 col-xs-12"> <span class="fs16 white">
		Thành viên mới nhất: </span><b class="white">kienle112233</b></div>
	</div>
	
</div>	
		
<script>	
		$(".subjectclick").click(function(){
					var state = confirm("Bạn cần đăng nhập/ đăng kí mới được dùng thử");
			if(state == true){
				$("#LoginModal").modal();
			}
			});
	
	function validEmail(email){
		if (/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/.test(email)) {  
			return true;
		}  else {
			return false;
		}
		
	}
	
	function validPhone(phone){
		if (/^[0-9\-\+]{9,15}$/.test(phone)) {  
			return true;
		}  else {
			return false;
		}
		
	}
	
	function dangkituvan() {
		var name = $("#tv_name").val();
		if(name ==''){
			$("#tv_name").focus();
			return false;
		}
		
		var phone = $("#tv_phone").val();
		if(phone ==''){
			$("#tv_phone").focus();
			return false;
		}else{
			if(!validPhone(phone)) {
				alert('Số điện thoại không đúng định dạng');
				$("#tv_phone").focus();
				return false;
			}
		}
		
		var email = $("#tv_email").val();
		if(email ==''){
			$("#tv_email").focus();
			return false;
		}else{
			if(!validEmail(email)) {
				alert('Email không đúng định dạng');
				$("#tv_email").focus();
				return false;
			}
		}
		
		
		$.ajax({
				url:BASE_REQUEST + '/home/dangki',
				method: "POST",
				data:{
					name: name,
					email: email,
					phone: phone
				}, 
				success:function(result){
					if(result == 1){
						$("#tv_phone").val('');
						$("#tv_email").val('');
						$("#tv_name").val('');
						alert('Bạn đã đăng kí tư vấn thành công!');
					}
				}
			});
		return false;
	}
</script>



	
<script>
	$('nav.navbar.nav.container').after($('#notifier_user'));
</script><div style="background: #9ccb3b; padding-top: 10px;" class="item">
	<div class="container">
		<marquee style="color: white;">
		Mọi hình ảnh được sử dụng trong phần mềm đều được sưu tầm từ nguồn Google trên Internet.		</marquee>
	</div>
</div>
<div class="clear"></div>
<footer class="container-fluid footer-color">
	<div class="container">
		<div class="row">
			<div class="col-xs-12 col-md-5 info mg-top text-left">
				<img class="mgb15" src="http://test1sn.vn/themes/songngu3/skin/images/nextnobels.png" />
				<ul class="text-left">
					<li>Địa chỉ: Nhà số 6, Ngõ 115 Nguyễn Khang, Cầu Giấy, Hà Nội</li>
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
						<li><a href="http://nextnobels.com/ho-so-cong-ty">Hồ sơ công ty</a></li>
						<li><a href="http://nextnobels.com/tam-nhin-su-menh-cong-ty">Tầm nhìn, sứ mệnh</a></li>
						<li><a href="http://nextnobels.com/nguoi-sang-lap-cong-ty">Người sáng lập</a></li>
					</ul>
				</div>
				<div class="col-xs-12 col-md-4">
					<h4><a href="http://nextnobels.com">Truyền thông nói về chúng tôi</a></h4>
					<ul class="text-left">
						<li><a href="http://nextnobels.com/giam-nhe-ganh-nang-hoc-tap-nho-phan-mem-song-ngu-anh-viet">Báo chí</a></li>
						<li><a href="http://nextnobels.com/fulllook-phan-mem-hoc-song-ngu-anh-viet"> Full Look - Phần mềm song ngữ phát triển năng lực toàn diện</a></li>
						<li><a href="http://nextnobels.com">Truyền hình</a></li>
						<!--<li><a href="http://nextnobels.com/team-building">Team building</a></li>-->
					</ul>
				</div>
				<div class="col-xs-12 col-md-4">
					<h4><a href="http://nextnobels.com/tin-tuc">Tin tức</a></h4>
					<ul class="text-left">
						<li><a href="http://nextnobels.com/tin-cong-ty">Tin công ty</a></li>
						<li><a href="http://nextnobels.com/thoi-su-hoc-duong">Thời sự học đường</a></li>
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
				<a href="http://nextnobels.com/dieu-khoan-su-dung" style="color: #fff; text-decoration: underline;">
				Điều khoản sử dụng</a> | 
				<a href="http://nextnobels.com/chinh-sach-bao-mat" style="color: #fff; text-decoration: underline;">Chính sách bảo mật</a>
				
			</p>
			<h4 class="mg-top"><span class="glyphicon glyphicon-copyright-mark" aria-hidden="true"></span>2015 - Công Ty Cổ Phần Giáo Dục Phát Triển Trí Tuệ Và Sáng Tạo Next Nobels. All Rights Reserved</h4>
			</div>
			<div class="col-xs-2 col-md-2">&nbsp;</div>
		</div>
	</div>
	<div class="row text-center">
		<div class="col-xs-10 col-xs-offset-1 col-md-4 col-md-offset-4">
				<a href="http://online.gov.vn/HomePage/CustomWebsiteDisplay.aspx?DocId=29663"><img src="http://test1sn.vn/themes/story/skin/media/bocongthuong.png" /></a>
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
*/});

home_content_parsed = tmpl(home_content, {id: "HomeContent"});