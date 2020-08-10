<?php 
$curentnews = $data->getNews2( pzk_request('page'));

?>
<div class="title2">
<h2 style="text-align:center;"><span class="label label-primary">Bài viết hay</span></h2>
</div>
<?php foreach($curentnews as $title): ?>
            <div class="catenews-wrapper col-xs-12">
                <div class="noname col-xs-12">
                    <a href="/featured/detail?id=<?php echo @$title['id']?>">
                    <img style="float:left; width:120px;height:120px; margin-bottom:10px;margin-right:10px;" src="<?php echo BASE_URL.$title['img'] ; ?>">
                        </a>
                    <div class="new_des">
                        <a href="/featured/detail?id=<?php echo @$title['id']?>">
                            <h4 style="margin: 0px;"> <?php echo @$title['title']?></h4>
                        </a>
                        <span><?php echo @$title['brief']?></span>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>
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
			<a href="/featured/subfeatured?page=<?php echo $i ?>" class="btn <?php echo $btnActive ?>"><?php echo $page ?></a>
			<?php }?>
			</p>
</div>
