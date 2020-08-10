<?php 
$category = intval(pzk_request()->getSegment(3));
$curentcat = $data->getCategory($category);
$curentnews = $data->getNews2($category, intval(pzk_request('page')));
//have subcate
$subcategories = $data->getSubCategory($category);	
 ?>
 
<div class="news-title text-center"> 
	<a href="/tin-cong-ty">Tin công ty</a>
	<img style="margin-top: -5px;" src="/Default/skin/nobel/Themes/Story/media/star.png"/>
	<a href="/ve-chung-toi">Về chúng tôi</a>
	<img style="margin-top: -5px;" src="/Default/skin/nobel/Themes/Story/media/star.png"/>
	<a href="/thoi-su-hoc-duong">Thời sự học đường</a>
</div> 
 
<div class="item fontutmbold" >
	

         <?php if(!$subcategories) { ?>
			<?php 
				
				$class = 'vechungtoi';
				$classnut = 'btn-primary';
				$color = 'colorvct';
				$bdimg = 'bdimgvct';
				$ngang = 'ngangvct';
				if($curentcat['alias'] == 'tin-cong-ty'){
					$class = 'tincongty';
					$classnut = 'btn-warning';
					$color = 'colortct';
					$bdimg = 'bdimgtct';
					$ngang = 'ngangtct';
				}elseif($curentcat['alias'] == 'thoi-su-hoc-duong') {
					$class = 'thoisu';
					$classnut = 'btn-success';
					$color = 'colorts';
					$bdimg = 'bdimgts';
					$ngang = 'ngangts';
				}
				
			?>
			<div style="margin-bottom: 15px;" class="<?php echo $class ?> pull-left">
				
				<div class="item mgb10">
					<div class="col-md-5 col-xs-12"><strong class="fs35 nabila <?php echo $color ?>"><?php echo @$curentcat['name']?></strong></div>
					<div class="col-md-7 hidden-xs"> <img class="thanhngang" src="/Themes/story/skin/media/<?php echo $ngang ?>.png" /></div>
				</div>	
				
				
				<?php foreach($curentnews as $title): ?>
					<div class="item" style="margin-bottom:10px; padding-bottom: 10px; border-bottom: 1px solid #bababa">
						<div class="col-md-4">
							
							<a href="/<?php echo @$title['alias']?>">
								<img class="img-responsive w100p <?php echo $bdimg ?>" src="<?php echo BASE_URL.$title['img'] ; ?>" />
							</a>
							
						</div>
						<div class="col-md-8">
							<div class="col-md-12">
							
								<strong>
								<a style="font-size: 20px; color: #040737;" href="/<?php echo @$title['alias']?>">
									<?php echo @$title['title']?>  
								</a>									
								</strong>
								
							
							</div>
							
							<div class="col-md-12 font15">
								<?php echo @$title['brief']?>
							</div>
							
							<div style="margin-left: 15px; border-bottom: solid 2px #bababa; padding-bottom: 5px; width: 200px; margin-bottom: 10px;">
								<span>
									<span class="glyphicon glyphicon-time"></span>
									<?php echo date('d-m-Y', strtotime($title['created'])); ?>  -
								</span>
								<span>
									<span class="glyphicon glyphicon-comment"></span>
									<?php echo @$title['comments']?> -
								</span>
								<span>
									<span class="glyphicon glyphicon-eye-open"></span> <?php echo @$title['views']?>
								</span>
								
							</div>
							
						</div>
					</div>
						
				
				<?php endforeach; ?>
			</div>	
			<div class="item">
				<?php 
				$total = $data->countItems($category);
				$pages = ceil($total / 5);
				$curPage = intval(pzk_request('page'));
				?>
				<?php if ($pages > 1) : ?>
				Trang 
				<?php for($i = 0; $i < $pages; $i++) { 
					$btnActive = 'btn-default';
					if($i == $curPage) {
						$btnActive = 'btn-primary';
					}
					$page = $i + 1;
				?>
				<a href="/<?php echo @$curentcat['alias']?>?page=<?php echo $i ?>" class="btn btn-sm <?php echo $btnActive ?>"><?php echo $page ?></a>
				<?php }?>
				<?php endif; ?>
			</div>
			<?php } ?>
            <?php
            // subcategory
            if($subcategories) {
				$i =1;
            ?>
            <?php foreach($subcategories as $item): ?>
				
                <?php 
					$color = 'colorvct';
					$class = 'vechungtoi';
					$classnut = 'btn-primary';
					$bdimg = 'bdimgvct';
					$ngang = 'ngangvct';
					if($item['alias'] == 'tin-cong-ty'){
						$class = 'tincongty';
						$classnut = 'btn-warning';
						$color = 'colortct';
						$bdimg = 'bdimgtct';
						$ngang = 'ngangtct';
					}elseif($item['alias'] == 'thoi-su-hoc-duong') {
						$class = 'thoisu';
						$classnut = 'btn-success';
						$color = 'colorts';
						$bdimg = 'bdimgts';
						$ngang = 'ngangts';
					}
				?>
				<div class="item rela <?php echo $class; ?>">
					
					<div class="<?php if($i != 1){ echo "mgt20";} ?> item mgb10">
						<div class="col-md-5 col-xs-12"><a href="/<?php echo @$item['alias']?>"><strong class="fs35 nabila <?php echo $color ?>"><?php echo @$item['name']?></strong></a></div>
						<div class="col-md-7 hidden-xs"> <img class="thanhngang" src="/Themes/story/skin/media/<?php echo $ngang ?>.png" /></div>
					</div>
					
					<?php $i++; $news= $data->getNews($item['id']);?>
					<?php foreach($news as $title): ?>
                
				
					<div class="item" style="margin-bottom:20px;">
						<div class="col-md-4">
							
							<a href="/<?php echo @$title['alias']?>">
								<img class="img-responsive w100p <?php echo $bdimg ?>" src="<?php echo BASE_URL.$title['img'] ; ?>" />
							</a>
							
						</div>
						<div class="col-md-8">
							<div class="col-md-12">
							
								<strong>
								<a style="color: #040737; font-size: 20px;" href="/<?php echo @$title['alias']?>">
									<?php echo @$title['title']?>  
								</a>									
								</strong>
								
							
							</div>
							
							<div style="margin-bottom: 10px;" class="col-md-12 font15">
								<?php echo @$title['brief']?>
							</div>
							<div style="margin-left: 15px; border-bottom: solid 2px #bababa; padding-bottom: 5px; width: 200px; margin-bottom: 10px;">
								<span>
									<span class="glyphicon glyphicon-time"></span>
									<?php echo date('d-m-Y', strtotime($title['created'])); ?>  -
								</span>
								<span>
									<span class="glyphicon glyphicon-comment"></span>
									<?php echo @$title['comments']?> -
								</span>
								<span>
									<span class="glyphicon glyphicon-eye-open"></span> <?php echo @$title['views']?>
								</span>
								
							</div>
						</div>
					</div>
					
					
				
                <?php endforeach; ?>
				
				<a href="/<?php echo @$item['alias']?>"><button class="btn <?php echo $classnut ?> sharp"  style="position: absolute; left:44%; bottom: -17px;; z-index: 9999;">XEM THÊM  <span class="glyphicon glyphicon-chevron-right"></span></button></a>
				</div>
				
            <?php endforeach; ?>
            <?php } ?>
 
</div>