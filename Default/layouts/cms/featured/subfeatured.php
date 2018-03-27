<?php 
$curentnews = $data->getNews2( pzk_request('page'));

?>
<div class="title2">
<h2 style="text-align:center;"><span class="label label-primary">Bài viết hay</span></h2>
</div>
{each $curentnews as $title}
            <div class="catenews-wrapper col-xs-12">
                <div class="noname col-xs-12">
                    <a href="/featured/detail?id={title[id]}">
                    <img style="float:left; width:120px;height:120px; margin-bottom:10px;margin-right:10px;" src="<?php echo BASE_URL.$title['img'] ; ?>">
                        </a>
                    <div class="new_des">
                        <a href="/featured/detail?id={title[id]}">
                            <h4 style="margin: 0px;"> {title[title]}</h4>
                        </a>
                        <span>{title[brief]}</span>
                    </div>
                </div>
            </div>
            {/each}
<div>
			<?php 
			$total = $data->countItems();
			$pages = ceil($total / 5);
			$curPage = pzk_request('page');
			?>

			<p style="text-align:center;">Trang 
			<?php for($i = 0; $i < $pages; $i++) { 
				$btnActive = '';
				if($i == $curPage) {
					$btnActive = 'btn-default';
				}
				$page = $i + 1;
			?>
			<a href="/featured/subfeatured?page={i}" class="btn {btnActive}">{page}</a>
			<?php }?>
			</p>
</div>
