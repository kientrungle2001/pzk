<?php 
		$category = intval(pzk_request()->getSegment(3));
		$curentcat = $data->getCategory($category);
		$curentnews = $data->getNews2($category, intval(pzk_request('page')));
		//have subcate
		$subcategories = $data->getSubCategory($category);
		
 ?>
<div id="news-wrapper" >
     <div class="container">
         <?php if(!$subcategories) { ?>
                
            {each $curentnews as $title}
			<div class="row top10">
				<div class="col-xs-3">
					<a href="/{title[alias]}">
						<img class="img-responsive img-thumbnail" src="<?php echo BASE_URL.$title['img'] ; ?>" />
					</a>
				</div>
				<div class="col-xs-9">
					<a href="/{title[alias]}">
						<h4>{title[title]}</h4>
					</a>
					<p>{title[brief]}</p>
				</div>
			</div>
            {/each}
			<div>
			<?php 
			$total = $data->countItems($category);
			$pages = ceil($total / 5);
			$curPage = intval(pzk_request('page'));
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
			<a href="/{curentcat[alias]}?page={i}" class="btn {btnActive}">{page}</a>
			<?php }?>
			<?php endif; ?>
			</div>
         <?php } ?>
			
            <?php
            // subcategory
            if($subcategories) {
            ?>
            {each $subcategories as $item}
                <div class="title2">
                    <a href="/{item[alias]}"><p> {item[name]}</p></a>
                </div>

                <?php $news= $data->getNews($item['id']);?>

                {each $news as $title}

                <div class="col-xs-12">
                    <div class="col-xs-12">
                        <a href="/{title[alias]}">
                            <img src="<?php echo BASE_URL.$title['img'] ; ?>" />
                        </a>
                        <div class="new_des">
                            <a href="/{title[alias]}">
                                <h4> {title[title]}</h4>
                            </a>
                            <p>{title[brief]}</p>
                        </div>
                    </div>

                </div>

                {/each}

            {/each}

            <?php } ?>

     </div>
	 <br />
</div>