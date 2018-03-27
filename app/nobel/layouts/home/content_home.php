<div id="content_home">
    <?php if(pzk_request('softwareId') == 4) :?>
		<div class="row">
			<div class="col-xs-12">
			
				<div class="col-xs-8">
					<div class="slideBox margin-top-5">
						<div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
							<!-- Indicators -->
						  	<!--ol class="carousel-indicators">
							    <li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
							    <li data-target="#carousel-example-generic" data-slide-to="1"></li>
							    <li data-target="#carousel-example-generic" data-slide-to="2"></li>
							    <li data-target="#carousel-example-generic" data-slide-to="3"></li>
								<li data-target="#carousel-example-generic" data-slide-to="4"></li>
						  	</ol-->
						
						  	<!-- Wrapper for slides -->
						  	<div class="carousel-inner" role="listbox">
								<div class="item active">
							    	<img src="<?=BASE_URL?>/default/skin/nobel/slide/s1.jpg" alt="...">
							      	<div class="carousel-caption">
							        	
							      	</div>
							    </div>
							    <div class="item">
							      	<img src="<?=BASE_URL?>/default/skin/nobel/slide/s2.jpg" alt="...">
						      		<div class="carousel-caption">
						        		
						      		</div>
							    </div>
						    	<div class="item">
							      	<img src="<?=BASE_URL?>/default/skin/nobel/slide/s3.jpg" alt="...">
						      		<div class="carousel-caption">
						        		
						      		</div>
							    </div>
							    <div class="item">
							      	<img src="<?=BASE_URL?>/default/skin/nobel/slide/s4.jpg" alt="...">
						      		<div class="carousel-caption">
						        		
						      		</div>
							    </div>
								<div class="item">
							      	<img src="<?=BASE_URL?>/default/skin/nobel/slide/s5.jpg" alt="...">
						      		<div class="carousel-caption">
						        		
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
						</div>
					</div>
				</div>
				
				<div class="col-xs-4">
					<div class="boxNews text-center margin-top-5">
						<div class="title-hot-news btn">
							<span class="glyphicon glyphicon-fast-forward white pd-right-10"></span> <span class="label-hot"> TIN MỚI NHẤT</span> <span class="glyphicon glyphicon-fast-backward white pd-left-10"></span> 
						</div>
					</div>
					<div class="newshot">
					<?php 
						$newshot  = pzk_obj('cms.news.index');
						$pageNews = pzk_request('pageNews');
						
						$dataNews = $newshot->getHotNews(5, $pageNews);
					?>
					<?php if(count($dataNews) >0):?>
						<?php foreach($dataNews as $key => $value):?>
							
								<p class="block-p margin-top-5"><span class="title-p"><a href="<?=BASE_URL?>/<?=$value['alias']?>"><?=$value['title']?></a></span> <?php if(($value['brief'] !='')&& (substr_count($value['brief'], ' ') > 25)) echo substr(strip_tags($value['brief']), 0, strpos(strip_tags($value['brief']), ' ', 100));?> ...</p>
								<div class="line-dot clearfix"></div>
							
						<?php endforeach;?>
					<?php endif;?>
					<?php $dataAll = $newshot->getHotNews();
							$numpage = (int)count($dataAll)/5;
					?>
					<?php if($numpage >1):?>
					<div class="page-view">
				    	<nav>
						  	<ul class="pagination">
						    	<li class="li_page curent_0">
						      		<a href="<?=BASE_REQUEST?>/Home?pageNews=<?=$pageNews-1?>" aria-label="Previous">
						        		<span aria-hidden="true">&laquo;</span>
						      		</a>
						    	</li>
						    	
						    	<?php for($page_i = 1; $page_i <= $numpage; $page_i ++):?>
						    		<?php if(($page_i <5 ) || ($page_i > ($numpage -2))):?>
							    		<li class="li_page curent_<?=$page_i?> <?php if($pageNews == $page_i) echo "active"?>"><a href="<?=BASE_REQUEST?>/Home?pageNews=<?=$page_i?>"><?=$page_i?></a></li>
							    	<?php endif;?>
							    <?php endfor;?>
							    <li class="li_page curent_<?=$numpage?>">
							    	<a href="<?=BASE_REQUEST?>/Home?pageNews=<?=$pageNews+1?>" aria-label="Next">
						        		<span aria-hidden="true">&raquo;</span>
						     	 	</a>
						    	</li>
						  	</ul>
						</nav>
				    </div>
						
					<?php endif;?>
					</div>
					
				</div>
			
			</div>
			
			<div class="col-xs-12 margin-top-40">
				<style>
				
				.title2 a{color:white}
				
				</style>
			
				<?php 
					$categoryId  = 36;
					$category36 = $newshot->getCategory($categoryId);
					
					//$pageNews = pzk_request('pageNews');
					
					$pageNews36 = 0;
					$data36 = $newshot->getHotNews(3, $pageNews36, $categoryId);
				?>
				<div class="title2"><a href="<?=BASE_REQUEST?>/<?=$category36['alias']?>"><?=$category36['name']?></a></div>
				
				<?php if(isset($data36) && count($data36) >0):?>
					<?php foreach($data36 as $key => $value):?>
					<div class="col-xs-3">
						<a href="<?=BASE_URL?>/<?=$value['alias']?>">	
							<img width="180" height="auto" src="<?=BASE_URL. createThumb('/'.$value['img'], '180', '120')?>"/>
						</a>
					</div>
					
					<div class="col-xs-9">
						<p class="block-p">
							<span class="title-p"><a href="<?=BASE_URL?>/<?=$value['alias']?>"><?=$value['title']?></a></span>
							<?=$value['brief']?>
						</p>
					</div>
					<div class="clearfix"></div>
					<?php endforeach;?>
				<?php endif;?>
			</div>
			
			<div class="col-xs-12">
				<?php 
					$categoryId  = 37;
					$category37 = $newshot->getCategory($categoryId);
					
					//$pageNews = pzk_request('pageNews');
					
					$pageNews37 = 0;
					$data37 = $newshot->getHotNews(3, $pageNews37, $categoryId);
				?>
				<div class="title2"><a href="<?=BASE_REQUEST?>/<?=$category37['alias']?>"><?=$category37['name']?></a></div>
				
				<?php if(isset($data37) && count($data37) >0):?>
					<?php foreach($data37 as $key => $value):?>
					<div class="col-xs-3">
						<a href="<?=BASE_URL?>/<?=$value['alias']?>">	
							<img width="180" height="auto" src="<?=BASE_URL. createThumb('/'.$value['img'], '180', '120')?>"/>
						</a>
					</div>
					
					<div class="col-xs-9">
						<p class="block-p">
							<span class="title-p"><a href="<?=BASE_URL?>/<?=$value['alias']?>"><?=$value['title']?></a></span>
							<?=$value['brief']?>
						</p>
					</div>
					<div class="clearfix"></div>
					<?php endforeach;?>
				<?php endif;?>
			</div>
			
			<div class="col-xs-12">
				<?php 
					$category38 = $newshot->getCategory(38);
					
					//$pageNews = pzk_request('pageNews');
					
					$pageNews38 = 0;
					$data38 = $newshot->getHotNews(3, $pageNews38, 38);
				?>
				<div class="title2"><a href="<?=BASE_REQUEST?>/<?=$category38['alias']?>"><?=$category38['name']?></a></div>
				
				<?php if(isset($data38) && count($data38) >0 ):?>
					<?php foreach($data38 as $key => $value):?>
					<div class="col-xs-3">
						<a href="<?=BASE_URL?>/<?=$value['alias']?>">	
							<img width="180" height="auto" src="<?=BASE_URL. createThumb('/'.$value['img'], '180', '120')?>"/>
						</a>
					</div>
					
					<div class="col-xs-9 margin-top-10">
						<p class="block-p">
							<span class="title-p"><a href="<?=BASE_URL?>/<?=$value['alias']?>"><?=$value['title']?></a></span>
							<?=$value['brief']?>
						</p>
					</div>
					<div class="clearfix"></div>
					<?php endforeach;?>
				<?php endif;?>
			</div>
			
		
		</div>
		
    <?php else : ?>
        <img src="/default/skin/nobel/media/content2.png" />
    <?php endif; ?>
	
</div>
