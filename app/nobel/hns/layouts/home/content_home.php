<div id="content_home">
    <?php $software = pzk_request()->getSoftwareId();?>
	<?php if($software == 2) : ?>

	<img src="/Default/skin/nobel/test/media/content.jpg" usemap="#home_Map"/>
	<map name="home_Map" id="home_Map">
         <area id="quansat" shape="rect" coords="25,1200,450,1108" href="<?=BASE_REQUEST?>/Ngonngu/question/1" title="Luyện tập"/>
         <area id="mieuta"  shape="rect" coords="890,1200,460,1108" href="<?=BASE_REQUEST?>/Ngonngu/test/6" title="Bài thi"/>
    </map>
    <?php elseif($software == 1) : ?>
    	<?php  $check = pzk_user()->checkPayment('full'); ?>
    
    
   		<?php if(isset($check) && $check == 1):?>
   		
   		<div class="row">
	    	<div class="col-xs-12">
	    		<img width="100%" src="<?=BASE_URL?>/default/images/homeFull.gif" usemap="#home_Full"/>
	    		<map id="home_Full" name="home_Full">
			         <area title="Luyện tập" href="/Ngonngu/practiceHome" coords="300,280,450,355" shape="rect" id="practice">
			         <area title="Thi thử trực tuyến" href="/Online-Examination" coords="470,280,590,355" shape="rect" id="onlineTest">
			    </map>
    		</div>
    	</div>
		<?php else:?>
			
		<div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
		  	
			<!-- Wrapper for slides -->
			<div class="carousel-inner" role="listbox">
				<div class="item active">
			      	<img src="<?=BASE_URL?>/Default/skin/nobel/test/media/slider/anh1.jpg" alt="learning">
		      		<div class="carousel-caption">
	        			Phần mềm Full Look Phần mềm khảo sát và phát triển năng lực toàn diện bằng tiếng anh(dành cho học sinh tiểu học)
	      			</div>
		    	</div>
		    	<div class="item">
		      		<img src="<?=BASE_URL?>/Default/skin/nobel/test/media/slider/anh2.jpg" alt="funny">
		      		<div class="carousel-caption">
		        		Đánh giá năng lực ngôn ngữ và diễn đạt
		      		</div>
		    	</div>
		    	<div class="item">
		      		<img src="<?=BASE_URL?>/Default/skin/nobel/test/media/slider/anh3.jpg" alt="social">
		      		<div class="carousel-caption">
		        		Đánh giá năng lực hiểu biết xã hội
		      		</div>
		    	</div>
		    	<div class="item">
		      		<img src="<?=BASE_URL?>/Default/skin/nobel/test/media/slider/anh4.jpg" alt="logic">
		      		<div class="carousel-caption">
		        		Đánh giá năng lực tư duy phán đoán
		      		</div>
		    	</div>
		    	<div class="item">
		      		<img src="<?=BASE_URL?>/Default/skin/nobel/test/media/slider/anh5.jpg" alt="scientist">
		      		<div class="carousel-caption">
		        		Đánh giá năng lực vận dụng khoa học
		      		</div>
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
		  	
		  	<style>
		  		.carousel-inner > .item {
		  			text-align: center;
		  		}
		  		.item img{width: auto !important;  display: inline-block !important; height:400px !important;}
		  		
		  		
				.carousel-caption{
				    background: #000 none repeat scroll 0 0;
				    bottom: 0;
				    box-sizing: border-box;
				    color: #fff;
				    left: 0;
				    opacity: 0.62;
				    overflow: hidden;
				    padding: 5px 10px;
				    position: absolute;
				    width: 100%;
				    z-index: 8;
				}
		  	
		  	</style>
		</div>
			
		<div class="col-xs-12 margin-top-10">
		    <div class="col-xs-3"><a class="btn btn-primary margin-top-50" id="finish-choice" style="float:right" href="http://s1.nextnobels.com/Online-Examination">Dùng thử</a></div>
		    <div class="col-xs-6 text-center" id="img-auto"><img src="<?=BASE_REQUEST?>/Default/skin/nobel/test/media/funny.jpg"/></div>
		    <div class="col-xs-3"><a class="btn btn btn-danger margin-top-50" id="show-answers" href="http://nextnobels.com/payment/bank/1">Mua sản phẩm</a></div>
	    </div>
		<?php endif;?>
		
		<?php $newsModel = pzk_model('News'); ?>
		
		<div class="col-xs-12 margin-top-10 border-bottom">
			
			<?php $dataNews = $newsModel->getNews(2);?>
	    	
    		<div class="title2">Tin Tức</div>
    		
    		<div class="col-xs-3">
    			<a href="<?=BASE_REQUEST?>/News/shownews?id=<?=$dataNews['id']?>">	
    				<img class="margin-top-10" width="180" height="auto" src="<?=BASE_URL.$dataNews['img']?>"/>
    			</a>
    		</div>
    						
    		<div class="col-xs-9 margin-top-10">
	    		<p class="block-p">
	    		<span class="title-p"><a href="<?=BASE_URL?>/News/shownews?id=<?=$dataNews['id']?>"><?=$dataNews['title']?></a></span>
    				<?=$dataNews['brief']?>
	    		</p>
    		</div>
    	</div>
    
    	<div class="col-xs-12 margin-top-10 border-bottom">
			
			<?php $dataNews = $newsModel->getNews(60);?>
    		<div class="col-xs-3">
    			<a href="<?=BASE_REQUEST?>/News/shownews?id=<?=$dataNews['id']?>">	
    				<img class="margin-top-10" width="180" height="auto" src="<?=BASE_URL.$dataNews['img']?>"/>
    			</a>
    		</div>
    						
    		<div class="col-xs-9 margin-top-10">
	    		<p class="block-p">
	    		<span class="title-p"><a href="<?=BASE_URL?>/News/shownews?id=<?=$dataNews['id']?>"><?=$dataNews['title']?></a></span>
    				<?=$dataNews['brief']?>
	    		</p>
    		</div>
    	</div>
    	
    	<div class="col-xs-12 margin-top-10 border-bottom">
			
    		<div class="col-xs-3">
    			<a href="<?=BASE_REQUEST?>/payment/bank">	
    				<img class="margin-top-10" width="180" height="auto" src="<?=BASE_URL?>/Default/skin/nobel/test/media/tutorial.jpg"/>
    			</a>
    		</div>
    						
    		<div class="col-xs-9 margin-top-10">
	    		<p class="block-p">
	    			<span class="title-p"><a href="<?=BASE_URL?>/payment/bank">Hướng dẫn mua phần mềm</a></span><br/>
    				Bước 1 : Bạn đăng ký tài khoản đăng nhập của mình <a id="nextnobelsLogin" href="javascript:void(0)" class="login_required" rel="/payment/bank" data-toggle="modal" data-target=".bs-example-modal-lg"><span style="color: red;" class="glyphicon glyphicon-star"></span><span style="color: red;">TẠI ĐÂY</span></a><br/> 
					Bước 2 : Bạn có thể mua phần mềm theo 2 cách :<br/> 
					    <i style="text-indent:15px">1. Thanh toán bằng chuyển khoản ngân hàng : <a href="<?=BASE_URL?>/payment/bank">Chi tiết</a></i><br/>
					    <i style="text-indent:15px">2. Thanh toán tại văn phòng Nextnobels : <a href="<?=BASE_URL?>/payment/bank">Chi tiết</a></i> 
	    		</p>
    		</div>
    	</div>
    
	<?php endif;?>
</div>