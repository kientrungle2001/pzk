
<?php 
		$category = pzk_request()->getSegment(3);
		$curentcat = $data->getCategory($category);
		$curentnews = $data->getNews2($category, pzk_request()->getPage());
		//have subcate
		$subcategories = $data->getSubCategory($category);
		
 ?>
<div class="container" >
     
         <?php if(!$subcategories) { ?>
			<h1> <?php echo @$curentcat['name']?></h1>
			
            <?php foreach($curentnews as $item): ?>
                <article class="row post">
					<div class="col-xs-3">
						<a href="/<?php echo @$item['alias']?>">
						<img class="img-responsive img-thumbnail" src="<?php echo BASE_URL. createThumb($item['img'], 200, 200) ; ?>" />
							</a>
					</div>
					<div class="col-xs-9">
						<a href="/<?php echo @$item['alias']?>">
							<h2 class="entry-title"> <?php echo @$item['title']?></h2>
						</a>
						<p class="article-summary"><?php echo @$item['brief']?></p>
					</div>
                </article>
            <?php endforeach; ?>
			<?php 
			$total = $data->countItems($category);
			$pages = ceil($total / 5);
			$curPage = pzk_request()->getPage();
			?>
			<?php if ($pages > 1) : ?>
			<div class="row">
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
			</div>
			<?php endif; ?>
			
         <?php } ?>
			
            <?php
            // subcategory
            if($subcategories) {
            ?>
            <?php foreach($subcategories as $item): ?>
                <div class="title2">
                    <a style="color:white;" href="/<?php echo @$item['alias']?>"><p> <?php echo @$item['name']?></p></a>
                </div>

                <?php $news= $data->getNews($item['id']);?>

                <?php foreach($news as $title): ?>

                <div class="catenews-wrapper col-xs-12">
                    <div class="noname col-xs-12">
                        <a href="/<?php echo @$title['alias']?>">
                            <img style="float:left;" src="<?php echo BASE_URL.$title['img'] ; ?>">
                        </a>
                        <div class="new_des">
                            <a href="/<?php echo @$title['alias']?>">
                                <h4 style="margin: 0px;"> <?php echo @$title['title']?></h4>
                            </a>
                            <span><?php echo @$title['brief']?></span>
                        </div>
                    </div>

                </div>

                <?php endforeach; ?>

            <?php endforeach; ?>

            <?php } ?>
</div> 



 