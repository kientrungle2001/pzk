
<?php 
		$category = pzk_request()->getSegment(3);
		$curentcat = $data->getCategory($category);
		$curentnews = $data->getNews2($category, pzk_request('page'));
		//have subcate
		$subcategories = $data->getSubCategory($category);
		
 ?>
<div id="news-wrapper" >
     <div class="news-container">
         <?php if(!$subcategories) { ?>
            <div class="title2">
                <p> {curentcat[name]}</p>
            </div>
            {each $curentnews as $title}
            <div class="catenews-wrapper col-xs-12">
                <div class="noname col-xs-12">
                    <a href="/{title[alias]}">
                    <img style="float:left;" src="<?php echo BASE_URL.$title['img'] ; ?>">
                        </a>
                    <div class="new_des">
                        <a href="/{title[alias]}">
                            <h4 style="margin: 0px;"> {title[title]}</h4>
                        </a>
                        <span>{title[brief]}</span>
                    </div>
                </div>
            </div>
            {/each}
			<div>
			<?php 
			$total = $data->countItems($category);
			$pages = ceil($total / 5);
			$curPage = pzk_request('page');
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
                    <a style="color:white;" href="/{item[alias]}"><p> {item[name]}</p></a>
                </div>

                <?php $news= $data->getNews($item['id']);?>

                {each $news as $title}

                <div class="catenews-wrapper col-xs-12">
                    <div class="noname col-xs-12">
                        <a href="/{title[alias]}">
                            <img style="float:left;" src="<?php echo BASE_URL.$title['img'] ; ?>">
                        </a>
                        <div class="new_des">
                            <a href="/{title[alias]}">
                                <h4 style="margin: 0px;"> {title[title]}</h4>
                            </a>
                            <span>{title[brief]}</span>
                        </div>
                    </div>

                </div>

                {/each}

            {/each}

            <?php } ?>

     </div>
</div> 



 