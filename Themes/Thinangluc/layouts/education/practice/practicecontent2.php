<?php
$id = pzk_request('id');
$subject = $data->getItem();
$topics = $subject->getTopics();
?>
<style>
	.hot {
    font-size: 10px;
    margin: 0;
    background: red;
    padding: 5px 10px;
    font-weight: bold;
    color: #fff;
    border-radius: 50px;
    position: unset;
	
}
.rating {
    margin: 0 15px;
    height: auto;
    padding: 0;
}
.songuoihoc {
    text-align: right;
    background: url(/Themes/Thinangluc/skin/media/songuoihoc.png) no-repeat left;
    width: 150px;
	padding-left: 35px;
}
.songuoihoc span {
    color: #fd6e23;
}
.baogom {
    margin: 0;
    padding: 0;
	list-style: none;
	float: left;
	width: 100%;
	margin-top: 15px;
}
.baogom li:nth-child(1):before {
    content: "";
    width: 20px;
    height: 20px;
    float: left;
    margin-right: 5px;
    background: url(/Themes/Thinangluc/skin/media/gift.png) no-repeat left;
}
.baogom li:before {
    content: "";
    width: 20px;
    height: 20px;
    float: left;
    margin-right: 5px;
    background-position-x: 5px;
    background: url(/Themes/Thinangluc/skin/media/check.png) no-repeat left;
}
.baogom li:nth-child(1) {
    font-weight: bold;
}

.menu-khoahoc{
    padding: 0;
	list-style: none;
	float: left;
	width: 100%;
	margin: 15px 0px;
	padding-bottom: 15px;
    border-bottom: 2px solid #2e4050;
}
.menu-khoahoc .menu-child {
    margin-right: 15px;
    font-size: 16px;
	float: left;
}
.menu-khoahoc .menu-child a {
    color: #2e4050;
    font-weight: bold;
}
.chiasekh{margin-top: 15px;}
#decuong{margin-top: 15px;}
.pl-0{padding-left: 0px;}
.item-lienquan{float: left; width: 100%; margin-bottom: 15px;}
</style>
<div class="item bgcontent">
	<div class="container">
		<div class="item fs18 top-content bold">
			&nbsp; &nbsp;
			<a href="/#practice">
			Luyện tập 
			</a>	
			&nbsp; &nbsp; &gt; &nbsp; &nbsp;
			<a href="/practice/class-5/subject-Mathematics-51">
			<?php echo $subject->getName()?>		</a>
		</div>
		
		<div class="row">
		
			<div class="col-xs-12 col-md-8">
				<iframe width="100%" height="340" src="https://www.youtube.com/embed/AzNyjWM2kt4" frameborder="0" allowfullscreen=""></iframe>
				<div class="chiasekh">
                    <b style="float: left; margin-top: 5px; margin-right: 15px;">Chia sẻ khóa học:</b>
                    <a href="" target="_blank" title="Chia sẻ">
                        <i class="fa fa-facebook-official fa-2x"></i>
                    </a>
                    <a href="" target="_blank" title="Chia sẻ">
                        <i class="fa fa-google-plus-square fa-2x"></i>
                    </a>
                    <a href="" target="_blank" title="Chia sẻ">
                        <i class="fa fa-twitter fa-2x"></i>
                    </a>
                </div>
			</div>
			
			<div class="col-xs-12 col-md-4">
				<h2 style="margin-top: 0px;"><?php echo $subject->getName()?></h2>
				
				<div class="item">
                    <span class="hot">HOT </span>
        			<img class="rating" src="/Themes/Thinangluc/skin/media/rating.png" width="70px" height="15px" alt="">
    				<span class="songuoihoc">
    					<span>2877</span> đang học
    				</span>
                </div>
				
				<ul class="baogom">
                    <li>Khóa Học Bao Gồm</li>
                    <li>0 video bài giảng</li>
                    <li>3 bài học thử</li>
                    <li>84 bài thi trắc nghiệm</li>
                    <li>Xem lại bài bất cứ lúc nào</li>
                </ul>
			</div>
		</div>
		
		<div class="row">
			<div class="col-xs-12 col-md-8">
				<ul class="menu-khoahoc">
                    <li class="menu-child"><a href="#chitiet">GIỚI THIỆU CHI TIẾT</a></li>
                    <li class="menu-child"><a href="#decuong">ĐỀ CƯƠNG</a></li>
                </ul>
				
				<div class="item">
					<div id="chitiet" class="chitiet">
						<?php echo $subject->getContent()?>
					</div>
					<div id="decuong">
						<div class="panel panel-primary">
						  <div class="panel-heading">
							<h3 class="panel-title">1. Bài học thử  <span class="pull-right">3 Bài học</span></h3>
						  </div>
						  <div class="panel-body">
							<ul class="list-group">
							  <li class="list-group-item">
								<a href="#">
								
								4. ĐÁNH GIÁ NĂNG LỰC - TOÁN HỌC VÀ ỨNG DỤNG - SỐ TỰ NHIÊN - ĐỀ 1 
								<span class="badge">14</span>
								</a>
							  </li>
							  <li class="list-group-item">
								<a href="#">
								
								4. ĐÁNH GIÁ NĂNG LỰC - TOÁN HỌC VÀ ỨNG DỤNG - SỐ TỰ NHIÊN - ĐỀ 1
								<span class="badge">14</span>
								</a>		
							  </li>
							  <li class="list-group-item">
								<a href="#">
								
								4. ĐÁNH GIÁ NĂNG LỰC - TOÁN HỌC VÀ ỨNG DỤNG - SỐ TỰ NHIÊN - ĐỀ 1
								<span class="badge">14</span>
								</a>		
							  </li>
							</ul>
						  </div>
						</div>
						
						<div class="panel panel-primary">
						  <div class="panel-heading">
							<h3 class="panel-title">1. Bài học thử  <span class="pull-right">3 Bài học</span></h3>
						  </div>
						  <div class="panel-body">
							<ul class="list-group">
							  <li class="list-group-item">
								<a href="#">
								
								4. ĐÁNH GIÁ NĂNG LỰC - TOÁN HỌC VÀ ỨNG DỤNG - SỐ TỰ NHIÊN - ĐỀ 1 
								<span class="badge">14</span>
								</a>
							  </li>
							  <li class="list-group-item">
								<a href="#">
								
								4. ĐÁNH GIÁ NĂNG LỰC - TOÁN HỌC VÀ ỨNG DỤNG - SỐ TỰ NHIÊN - ĐỀ 1
								<span class="badge">14</span>
								</a>		
							  </li>
							  <li class="list-group-item">
								<a href="#">
								
								4. ĐÁNH GIÁ NĂNG LỰC - TOÁN HỌC VÀ ỨNG DỤNG - SỐ TỰ NHIÊN - ĐỀ 1
								<span class="badge">14</span>
								</a>		
							  </li>
							</ul>
						  </div>
						</div>
						
					</div>
				</div>
			</div>
			<div class="col-xs-12 col-md-4">
				<h2 class="text-center">Giảng viên</h2>
				<div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
				  <!-- Indicators -->
				  <ol class="carousel-indicators">
					<li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
					<li data-target="#carousel-example-generic" data-slide-to="1"></li>
					
				  </ol>

				  <!-- Wrapper for slides -->
				  <div class="carousel-inner" role="listbox">
					<div class="text-center active">
					  <img class="item img-circle" src="/Themes/Thinangluc/skin/media/gv.jpg" alt="...">
					  <div class="item">
						<h3>Third slide label</h3>
						<p>
						Nơi ở hiện tại: Đống Đa – Hà Nội Học vị: Thạc sĩ Quá trình công tác và kinh nghiệm: Thầy Nguyễn Thành Long đã có kinh nghiệm 10 năm giảng dạy với hàng trăm học sinh đạt thành tích cao trong các kì thi Violympic Toán, Thi học sinh giỏi Toán. Đặc biệt, rất nhiều học sinh của thầy thi đỗ vào các trường chuyên, chất lượng cao ở Hà Nội như: Amsterdam, Giảng Võ, Chu Văn An,.... Thầy nguyên là giáo viên Hệ thống Giáo dục Anhxtanh Hà Nội. Giáo viên Hệ thống Giáo dục Vinastudy.vn. Giáo viên đội tuyển
						<p>
					  </div>
					</div>
					
					<div class="item">
					  <img class="text-center img-circle" src="/Themes/Thinangluc/skin/media/gv.jpg" alt="...">
					  <div class="item">
					  <h3>Third slide label</h3>
					  <p>
						Nơi ở hiện tại: Đống Đa – Hà Nội Học vị: Thạc sĩ Quá trình công tác và kinh nghiệm: Thầy Nguyễn Thành Long đã có kinh nghiệm 10 năm giảng dạy với hàng trăm học sinh đạt thành tích cao trong các kì thi Violympic Toán, Thi học sinh giỏi Toán. Đặc biệt, rất nhiều học sinh của thầy thi đỗ vào các trường chuyên, chất lượng cao ở Hà Nội như: Amsterdam, Giảng Võ, Chu Văn An,.... Thầy nguyên là giáo viên Hệ thống Giáo dục Anhxtanh Hà Nội. Giáo viên Hệ thống Giáo dục Vinastudy.vn. Giáo viên đội tuyển
						<p>
					  </div>
					</div>
					
				  </div>

				 
				</div>
				
				<h2 class="text-center">Khóa học liên quan</h2>
				<a href="#" class="item-lienquan">
					<div class="col-xs-12 col-md-6"> 
						<img class="item" src="/Themes/Thinangluc/skin/media/20382.jpg" alt="" />
					</div>
					<div class="col-xs-12 pl-0 col-md-6">
						<p>Ôn thi vào 6 môn Toán</p>
						<p>Giá: 1.000.000 VNĐ</p>
					</div>
				</a>
				<a href="#" class="item-lienquan">
					<div class="col-xs-12 col-md-6"> 
						<img class="item" src="/Themes/Thinangluc/skin/media/20382.jpg" alt="" />
					</div>
					<div class="col-xs-12 pl-0 col-md-6">
						<p>Ôn thi vào 6 môn Toán</p>
						<p>Giá: 1.000.000 VNĐ</p>
					</div>
				</a>
			</div>
		</div>
	</div>	
</div>
 <img class="item mgt-60" src="/Themes/Songngu3/skin/images/bottom-content.png"/>
 
 
 