<?php
$id = pzk_request('id');
$subject = $data->getItem();
$topics = $subject->getTopics();
$teachers = $subject->getTeachers();
$relatedCourses = $subject->getRelatedCourses();
$class = pzk_session('lop');
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
.title-practice{margin-top: 0px; margin-bottom: 30px;}
#carousel-example-generic{margin-bottom: 30px;}
.badge{background: red;}
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
			<?php echo $subject->get('name')?>		</a>
		</div>
		
		<div class="row">
		
			<div class="col-xs-12 col-md-8">
				<iframe width="100%" height="340" src="<?php echo pzk_or($subject->getEmbedYoutubeUrl(), 'https://www.youtube.com/embed/AzNyjWM2kt4')?>" frameborder="0" allowfullscreen=""></iframe>
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
				<h2 style="margin-top: 0px;"><?php echo $subject->get('name')?></h2>
				
				<div class="item">
                    <span class="hot">HOT </span>
        			<img class="rating" src="/Themes/Thinangluc/skin/media/rating.png" width="70px" height="15px" alt="">
    				<span class="songuoihoc">
    					<span>2877</span> đang học
    				</span>
                </div>
				
				<ul class="baogom">
                    <li>Khóa Học Bao Gồm</li>
                    <!--
					<li>0 video bài giảng</li>
					-->
                    <li><?php echo $subject->getTrialTestCount();?> bài học thử</li>
                    <li><?php echo $subject->getTestCount();?> bài thi trắc nghiệm</li>
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
					<?php echo $subject->get('content')?>
					</div>
					<div id="decuong">
					<?php foreach($topics as $topic): ?>
						<?php $tests = $topic->getTests();?>
						<div class="panel panel-primary">
						  <div class="panel-heading">
							<h3 class="panel-title"><?php echo $topic->get('name')?>  <span class="pull-right"><?php echo count($tests);?> Bài học</span></h3>
						  </div>
						  <div class="panel-body">
							<ul class="list-group">
							<?php foreach($tests as $test): ?>
							  <li class="list-group-item">
								<a href="<?php echo $test->getUrl($class, $subject)?>">
								<?php echo $test->get('name')?>
								<?php if($test->get('trial')):?>
								<span class="badge">Dùng thử</span>
								<?php endif;?>
								</a>
							  </li>
							<?php endforeach; ?>
							</ul>
						  </div>
						</div>
					<?php endforeach; ?>
					</div>
				</div>
			</div>
			<div class="col-xs-12 col-md-4">
				<h2 class="text-center title-practice">Giảng viên</h2>
				<div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
				  <!-- Indicators -->
				  <ol class="carousel-indicators">
				  <?php foreach($teachers as $tIndex => $teacher):?>
					<li data-target="#carousel-example-generic" data-slide-to="<?php echo $tIndex?>" <?php if($tIndex == 0):?>class="active"<?php endif;?>></li>
					<?php endforeach;?>
					
				  </ol>

				  <!-- Wrapper for slides -->
				  <div class="carousel-inner" role="listbox">
					
					<?php foreach($teachers as $tIndex => $teacher):?>
					<div class="text-center <?php if($tIndex == 0):?>active<?php endif; ?>">
					  <img class="img-circle" src="<?php if($teacher['image']):?><?php echo $teacher['image']?><?php else:?>/Themes/Thinangluc/skin/media/gv.jpg<?php endif;?>" alt="...">
					  <div class="item">
						<h3><?php echo $teacher['name']?></h3>
						<p><?php echo $teacher['description']?></p>
					  </div>
					</div>
					<?php endforeach;?>
					
				  </div>

				 
				</div>
				
				<h2 class="text-center title-practice">Khóa học liên quan</h2>
				<?php foreach($relatedCourses as $related): ?>
				<a href="<?php echo $related['link']?>" class="item-lienquan">
					<div class="col-xs-12 col-md-6"> 
						<img class="item" src="<?php echo $related['image']?>" alt="" />
					</div>
					<div class="col-xs-12 pl-0 col-md-6">
						<p><b><?php echo $related['name']?></b></p>
						<p><b>Giá: <?php echo $related['price']?></b></p>
					</div>
				</a>
				<?php endforeach; ?>
			</div>
		</div>
	</div>	
</div>
 <img class="item mgt-60" src="/Themes/Songngu3/skin/images/bottom-content.png"/>
 
 
 