home_menu = heredoc(function(){/*
<div class="container-fluid main-menu">
	<div class="container">
		<div class="row">
			<div class="col-md-2 col-xs-12">
				<a href="/"><img src="/themes/songngu3/skin/images/logo.png"></a>
			</div>
			<div class="col-md-10 col-xs-12">
				<div class="hidden-xs">
        <ul class="header-menu item">
			 <li class="dropdown colormenu1">
				<a href="/"><i style="font-size: 23px;" class="fa fa-home" aria-hidden="true"></i></a>
			 </li>
			 <li class="dropdown">
				<a class="gt" href="/home/detail">Giới thiệu</a>
			 </li>
	        <li class="dropdown colormenu2">
	            <a href="#practice" class="dropdown-toggle  jumping" rel="#A0D4CE" data-class="5" data-jumping="practice">Luyện tập</a>
				<div class="dropdown-menu multi-column columns-3 tab-content">
					<ul class="nav nav-tabs nav-tabs-ct">
						<li class="active"><a data-toggle="tab" href="#home">Luyện tập</a></li>
					</ul> 
				   <div class="row tab-pane fade in active text-center pding10" id="home">
						(* var subjects = _db().Select('id,name, img').From('categories').Where('parent=47').Result();*)
							(* for(var i = 0; i < subjects.length; i++) { var subject = subjects[i]; *)
							<div class="col-md-2 col-xs-3 top10 height80 width20 btn-menu bgcl choicesubject" onclick="return false;" data-class="5" data-alias="Mathematics" data-subject="51">
								<a href=""><img src="(*= subject.img*)" class="img-thumnail wheight50"></a>
								<p class="text-uppercase robotofont weight10">
								(*= subject.name*)								</p>
							</div>
							(* } *)
					</div>
	            </div>
	        </li>
			
			 			<li class="dropdown colormenu3 tab-content">
	            <a href="/#practice-test" class="dropdown-toggle fsize" data-class="5" data-jumping="practice-test" rel="#B6D452"><span class="hidden-sm hidden-md">Đề luyện tập</span> <span class="visible-sm visible-md">Đề luyện tập</span></a>
	            <div class="dropdown-menu multi-column columns-3 tab-content">
					<ul class="nav nav-tabs nav-tabs-ct1">
						<li class="active"><a data-toggle="tab" href="#menu12"><span class="hidden-sm hidden-md">Đề luyện tập</span> <span class="visible-sm visible-md">Đề luyện tập</span></a></li>
						<li><a href="/home/rating?practice=1&amp;clearTestId=1">Xếp hạng</a></li>
					</ul> 
					<div class="row tab-pane fade in active text-center pding10" id="menu12">
					<div id="myCarousel" class="carousel col-md-11" style="margin-left:20px;" data-ride="carousel">

						  <!-- Wrapper for slides -->
						  <div class="carousel-inner" role="listbox">
							<div class="item">
																							  					(* var weeks = _db().Select('*').From('categories').Where('status=1 and display=1 and practice=1 and software=1 and parent=354').Result(); *)
								<div class="col-md-2 col-xs-3 top10 height80 btn-menu bgcl choicepractice" onclick="return false;" data-test="74" data-trial="1" data-week="400" data-class="5">
									<a href=""><img src="/default/skin/nobel/themes/story/media/de9.png" class="img-thumnail wheight50"></a>
									<p class="text-uppercase robotofont weight10 top10">
									Đề dùng thử</p>
								</div>
								
																																
								<div class="col-md-2 col-xs-3 top10 height80 btn-menu bgcl choicepractice" onclick="return false;" data-test="" data-trial="0" data-week="355" data-class="5">
									<a href=""><img src="/default/skin/nobel/themes/story/media/de8.png" class="img-thumnail wheight50"></a>
									<p class="text-uppercase robotofont weight10 top10">
									Tuần 1</p>
								</div>
								
																																
								<div class="col-md-2 col-xs-3 top10 height80 btn-menu bgcl choicepractice" onclick="return false;" data-test="" data-trial="0" data-week="357" data-class="5">
									<a href=""><img src="/default/skin/nobel/themes/story/media/de7.png" class="img-thumnail wheight50"></a>
									<p class="text-uppercase robotofont weight10 top10">
									Tuần 3</p>
								</div>
								
																																
								<div class="col-md-2 col-xs-3 top10 height80 btn-menu bgcl choicepractice" onclick="return false;" data-test="" data-trial="0" data-week="364" data-class="5">
									<a href=""><img src="/default/skin/nobel/themes/story/media/de6.png" class="img-thumnail wheight50"></a>
									<p class="text-uppercase robotofont weight10 top10">
									Tuần 5</p>
								</div>
								
																																
								<div class="col-md-2 col-xs-3 top10 height80 btn-menu bgcl choicepractice" onclick="return false;" data-test="" data-trial="0" data-week="366" data-class="5">
									<a href=""><img src="/default/skin/nobel/themes/story/media/de5.png" class="img-thumnail wheight50"></a>
									<p class="text-uppercase robotofont weight10 top10">
									Tuần 7</p>
								</div>
								
																																
								<div class="col-md-2 col-xs-3 top10 height80 btn-menu bgcl choicepractice" onclick="return false;" data-test="" data-trial="0" data-week="368" data-class="5">
									<a href=""><img src="/default/skin/nobel/themes/story/media/de4.png" class="img-thumnail wheight50"></a>
									<p class="text-uppercase robotofont weight10 top10">
									Tuần 9</p>
								</div>
								
																																
								<div class="col-md-2 col-xs-3 top10 height80 btn-menu bgcl choicepractice" onclick="return false;" data-test="" data-trial="0" data-week="370" data-class="5">
									<a href=""><img src="/default/skin/nobel/themes/story/media/de3.png" class="img-thumnail wheight50"></a>
									<p class="text-uppercase robotofont weight10 top10">
									Tuần 11</p>
								</div>
								
																																
								<div class="col-md-2 col-xs-3 top10 height80 btn-menu bgcl choicepractice" onclick="return false;" data-test="" data-trial="0" data-week="372" data-class="5">
									<a href=""><img src="/default/skin/nobel/themes/story/media/de2.png" class="img-thumnail wheight50"></a>
									<p class="text-uppercase robotofont weight10 top10">
									Tuần 13</p>
								</div>
								
																																
								<div class="col-md-2 col-xs-3 top10 height80 btn-menu bgcl choicepractice" onclick="return false;" data-test="" data-trial="0" data-week="374" data-class="5">
									<a href=""><img src="/default/skin/nobel/themes/story/media/de1.png" class="img-thumnail wheight50"></a>
									<p class="text-uppercase robotofont weight10 top10">
									Tuần 15</p>
								</div>
								
																																
								<div class="col-md-2 col-xs-3 top10 height80 btn-menu bgcl choicepractice" onclick="return false;" data-test="" data-trial="0" data-week="376" data-class="5">
									<a href=""><img src="/default/skin/nobel/themes/story/media/de10.png" class="img-thumnail wheight50"></a>
									<p class="text-uppercase robotofont weight10 top10">
									Tuần 17</p>
								</div>
								
																							  
							</div>
							<div class="item active">
														  																<div class="col-md-2 col-xs-3 top10 height80 btn-menu bgcl choicepractice" onclick="return false;" data-test="" data-trial="0" data-week="378" data-class="5">
									<a href=""><img src="/default/skin/nobel/themes/story/media/de9.png" class="img-thumnail wheight50"></a>
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
	            <a href="/#test" class="dropdown-toggle fsize" data-class="5" data-jumping="test" rel="#E0C7A3">Đề kiểm tra</a>
	            <div class="dropdown-menu multi-column columns-3 tab-content">
					<ul class="nav nav-tabs nav-tabs-ct2">
						<li class="active"><a data-toggle="tab" href="#menu23">Đề kiểm tra</a></li>
						<li><a href="/home/rating?practice=0&amp;clearTestId=1">Xếp hạng</a></li>
					</ul> 
					<div class="row tab-pane fade in active text-center pding10" id="menu23">
					   <div id="myCarousel1" class="carousel col-md-11" style="margin-left:20px;" data-ride="carousel">

						  <!-- Wrapper for slides -->
						  <div class="carousel-inner" role="listbox">
							<div class="item">
																												 
							
							<div class="col-md-2 col-xs-3 top10 height80 btn-menu bgcl choicetest" onclick="return false;" data-test="25" data-trial="1" data-week="401" data-class="5">
								<a href=""><img src="/default/skin/nobel/themes/story/media/hinh9.png" class="img-thumnail wheight50"></a>
								<p class="text-uppercase robotofont weight10 top10">
								Đề dùng thử</p>
							</div>
																					 
							
							<div class="col-md-2 col-xs-3 top10 height80 btn-menu bgcl choicetest" onclick="return false;" data-test="" data-trial="0" data-week="356" data-class="5">
								<a href=""><img src="/default/skin/nobel/themes/story/media/hinh8.png" class="img-thumnail wheight50"></a>
								<p class="text-uppercase robotofont weight10 top10">
								Tuần 2</p>
							</div>
																					 
							
							<div class="col-md-2 col-xs-3 top10 height80 btn-menu bgcl choicetest" onclick="return false;" data-test="" data-trial="0" data-week="363" data-class="5">
								<a href=""><img src="/default/skin/nobel/themes/story/media/hinh7.png" class="img-thumnail wheight50"></a>
								<p class="text-uppercase robotofont weight10 top10">
								Tuần 4</p>
							</div>
																					 
							
							<div class="col-md-2 col-xs-3 top10 height80 btn-menu bgcl choicetest" onclick="return false;" data-test="" data-trial="0" data-week="365" data-class="5">
								<a href=""><img src="/default/skin/nobel/themes/story/media/hinh6.png" class="img-thumnail wheight50"></a>
								<p class="text-uppercase robotofont weight10 top10">
								Tuần 6</p>
							</div>
																					 
							
							<div class="col-md-2 col-xs-3 top10 height80 btn-menu bgcl choicetest" onclick="return false;" data-test="" data-trial="0" data-week="367" data-class="5">
								<a href=""><img src="/default/skin/nobel/themes/story/media/hinh5.png" class="img-thumnail wheight50"></a>
								<p class="text-uppercase robotofont weight10 top10">
								Tuần 8</p>
							</div>
																					 
							
							<div class="col-md-2 col-xs-3 top10 height80 btn-menu bgcl choicetest" onclick="return false;" data-test="" data-trial="0" data-week="369" data-class="5">
								<a href=""><img src="/default/skin/nobel/themes/story/media/hinh4.png" class="img-thumnail wheight50"></a>
								<p class="text-uppercase robotofont weight10 top10">
								Tuần 10</p>
							</div>
																					 
							
							<div class="col-md-2 col-xs-3 top10 height80 btn-menu bgcl choicetest" onclick="return false;" data-test="" data-trial="0" data-week="371" data-class="5">
								<a href=""><img src="/default/skin/nobel/themes/story/media/hinh3.png" class="img-thumnail wheight50"></a>
								<p class="text-uppercase robotofont weight10 top10">
								Tuần 12</p>
							</div>
																					 
							
							<div class="col-md-2 col-xs-3 top10 height80 btn-menu bgcl choicetest" onclick="return false;" data-test="" data-trial="0" data-week="373" data-class="5">
								<a href=""><img src="/default/skin/nobel/themes/story/media/hinh2.png" class="img-thumnail wheight50"></a>
								<p class="text-uppercase robotofont weight10 top10">
								Tuần 14</p>
							</div>
																					 
							
							<div class="col-md-2 col-xs-3 top10 height80 btn-menu bgcl choicetest" onclick="return false;" data-test="" data-trial="0" data-week="375" data-class="5">
								<a href=""><img src="/default/skin/nobel/themes/story/media/hinh1.png" class="img-thumnail wheight50"></a>
								<p class="text-uppercase robotofont weight10 top10">
								Tuần 16</p>
							</div>
																					 
							
							<div class="col-md-2 col-xs-3 top10 height80 btn-menu bgcl choicetest" onclick="return false;" data-test="" data-trial="0" data-week="377" data-class="5">
								<a href=""><img src="/default/skin/nobel/themes/story/media/hinh10.png" class="img-thumnail wheight50"></a>
								<p class="text-uppercase robotofont weight10 top10">
								Tuần 18</p>
							</div>
																					  
							</div>
							<div class="item active">
																					 
							
							<div class="col-md-2 col-xs-3 top10 height80 btn-menu bgcl choicetest" onclick="return false;" data-test="" data-trial="0" data-week="379" data-class="5">
								<a href=""><img src="/default/skin/nobel/themes/story/media/hinh9.png" class="img-thumnail wheight50"></a>
								<p class="text-uppercase robotofont weight10 top10">
								Tuần 20</p>
							</div>
																					 
							
							<div class="col-md-2 col-xs-3 top10 height80 btn-menu bgcl choicetest" onclick="return false;" data-test="" data-trial="0" data-week="381" data-class="5">
								<a href=""><img src="/default/skin/nobel/themes/story/media/hinh8.png" class="img-thumnail wheight50"></a>
								<p class="text-uppercase robotofont weight10 top10">
								Tuần 22</p>
							</div>
																					 
							
							<div class="col-md-2 col-xs-3 top10 height80 btn-menu bgcl choicetest" onclick="return false;" data-test="" data-trial="0" data-week="383" data-class="5">
								<a href=""><img src="/default/skin/nobel/themes/story/media/hinh7.png" class="img-thumnail wheight50"></a>
								<p class="text-uppercase robotofont weight10 top10">
								Tuần 24</p>
							</div>
																					 
							
							<div class="col-md-2 col-xs-3 top10 height80 btn-menu bgcl choicetest" onclick="return false;" data-test="" data-trial="0" data-week="385" data-class="5">
								<a href=""><img src="/default/skin/nobel/themes/story/media/hinh6.png" class="img-thumnail wheight50"></a>
								<p class="text-uppercase robotofont weight10 top10">
								Tuần 26</p>
							</div>
																					 
							
							<div class="col-md-2 col-xs-3 top10 height80 btn-menu bgcl choicetest" onclick="return false;" data-test="" data-trial="0" data-week="387" data-class="5">
								<a href=""><img src="/default/skin/nobel/themes/story/media/hinh5.png" class="img-thumnail wheight50"></a>
								<p class="text-uppercase robotofont weight10 top10">
								Tuần 28</p>
							</div>
																					 
							
							<div class="col-md-2 col-xs-3 top10 height80 btn-menu bgcl choicetest" onclick="return false;" data-test="" data-trial="0" data-week="389" data-class="5">
								<a href=""><img src="/default/skin/nobel/themes/story/media/hinh4.png" class="img-thumnail wheight50"></a>
								<p class="text-uppercase robotofont weight10 top10">
								Tuần 30</p>
							</div>
																					 
							
							<div class="col-md-2 col-xs-3 top10 height80 btn-menu bgcl choicetest" onclick="return false;" data-test="" data-trial="0" data-week="391" data-class="5">
								<a href=""><img src="/default/skin/nobel/themes/story/media/hinh3.png" class="img-thumnail wheight50"></a>
								<p class="text-uppercase robotofont weight10 top10">
								Tuần 32</p>
							</div>
																					 
							
							<div class="col-md-2 col-xs-3 top10 height80 btn-menu bgcl choicetest" onclick="return false;" data-test="" data-trial="0" data-week="393" data-class="5">
								<a href=""><img src="/default/skin/nobel/themes/story/media/hinh2.png" class="img-thumnail wheight50"></a>
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
	            <a href="/gift">Quà tặng</a>
	            
	        </li>
	        <li class="dropdown colormenu6 ">
	            <a href="/game">Trò chơi</a> 
	        </li>
			
			 <li class="dropdown">
				<a class="hd" href="/huong-dan-su-dung-song-ngu">Hướng dẫn sử dụng</a>
			 </li>
        </ul>

    <style>	
		.nowrap{white-space: nowrap;}
    </style>
</div>


<div class="container top10 visible-xs ">
	<div class="row">
		<div class="menu-mb text-center nowrap">
			<a href="/home"><div class="circle">
			<div class="circle" style="background: #7f003f;"><i class="glyphicon glyphicon-home check"></i></div>						
			</div><span class="m-font">Trang chủ</span></a>
		</div>
		<div class="menu-mb text-center nowrap">		
			<a data-toggle="tab" class="visible-xs jumping" data-jumping="practice" href="#practice"><div class="circle" style="background: #ffcc00">
				<i class="glyphicon glyphicon-tree-conifer check"></i>
			</div><span class="m-font">Luyện tập</span></a>	
		</div>
		<div class="menu-mb text-center nowrap">
			<a data-toggle="tab" class="visible-xs jumping" data-jumping="practice-test" href="#practice-test"><div class="circle" style="background: #44b771;">
				<i class="glyphicon glyphicon-send check"></i>
			</div><span class="m-font"><span class="hidden-sm hidden-md">Đề luyện tập</span> <span class="visible-sm visible-md">Đề luyện tập</span></span></a>
		</div>
		<div class="menu-mb text-center nowrap">
			<a data-toggle="tab" class="visible-xs jumping" data-jumping="test" href="/#test"><div class="circle" style="background: #db3fdb;">
				<i class="glyphicon glyphicon-star check"></i>
			</div><span class="m-font">Đề kiểm tra</span></a>		
		</div>
		
		<div class="menu-mb text-center nowrap">
			<a href="/game">
			<div class="circle" style="background: #1e74b3;">
				<i class="glyphicon glyphicon-plane check"></i>
			</div>
				<span class="m-font">Trò chơi</span>
			</a>
		</div>
	</div>
</div>
	
			</div>
		</div>
	</div>
</div>

<style>
.dropdown:hover .dropdown-menu {
    display: block;
    margin-top: 0; // remove the gap so it doesn't close
 }
</style>
*/});

function load_menu() {
	var menu = tmpl(home_menu, {});
	$('#page-content').append(menu);
}