<?php 
		$category = pzk_request()->getSegment(3);
		$curentcat = $data->getCategory($category);
		$curentnews = $data->getNews2($category, pzk_request()->getPage());
		//have subcate
		$subcategories = $data->getSubCategory($category);
		
 ?>
 
<div id="news-wrapper" class="box news-box">
	<h3 class="padding-10 color-white font-large text-uppercase text-center">Tin tức Happy Way</h3>
			<div class="box-content border-purple padding-20">
         <?php if(1) { ?>
                
            <?php foreach($curentnews as $title): ?>
			<div class="row top-10">
				<div class="col-xs-12 col-sm-4 col-md-3" style="overflow: hidden; height: 120px;">
					<a href="/<?php echo @$title['alias']?>">
						<img class="img-responsive img-thumbnail" src="<?php echo BASE_URL.$title['img'] ; ?>" />
					</a>
				</div>
				<div class="col-xs-12 col-sm-8 col-md-9">
					<a href="/<?php echo @$title['alias']?>">
						<h4><?php echo @$title['title']?></h4>
					</a>
					<p><?php echo @$title['brief']?></p>
				</div>
			</div>
            <?php endforeach; ?>
			<div>
			<?php 
			$total = $data->countItems($category);
			$pages = ceil($total / 5);
			$curPage = pzk_request()->getPage();
			?>
			<?php if ($pages > 1) : ?>
			Trang 
			<?php for($i = 0; $i < $pages; $i++) { 
				$btnActive = '';
				if($i == $curPage) {
					$btnActive = 'btn-default';
				}
				$page = $i + 1;
			?>
			<a href="/<?php echo @$curentcat['alias']?>?page=<?php echo $i ?>" class="btn <?php echo $btnActive ?>"><?php echo $page ?></a>
			<?php }?>
			<?php endif; ?>
			</div>
         <?php } ?>
			
            <?php
            // subcategory
            if(0 && $subcategories) {
            ?>
            <?php foreach($subcategories as $item): ?>
                <div class="title2">
                    <a href="/<?php echo @$item['alias']?>"><p> <?php echo @$item['name']?></p></a>
                </div>

                <?php $news= $data->getNews($item['id']);?>

                <?php foreach($news as $title): ?>

                <div class="col-xs-12">
                    <div class="col-xs-12">
                        <a href="/<?php echo @$title['alias']?>">
                            <img src="<?php echo BASE_URL.$title['img'] ; ?>" />
                        </a>
                        <div class="new_des">
                            <a href="/<?php echo @$title['alias']?>">
                                <h4> <?php echo @$title['title']?></h4>
                            </a>
                            <p><?php echo @$title['brief']?></p>
                        </div>
                    </div>

                </div>

                <?php endforeach; ?>

            <?php endforeach; ?>

            <?php } ?>
		</div>
	 <br />
</div>