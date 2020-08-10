<?php 
	$news	=	$data->getNews();
	$lists 	= 	$data->getRelatedNews();
?>
<div class="text-justify">
    <div class="row">
		<div class="col-xs-12 col-sm-12 box news-box">
			<h3 class="padding-10 color-white font-large text-uppercase text-center">Tin tức Happy Way</h3>
			<div class="box-content border-purple padding-20">
				<h1 class="text-center"><?php echo @$news['title']?></h1>
				<em><?php echo @$news['brief']?></em>
				<?php 
				  $content= $news['content'];
				  $content = PzkParser::parseTemplate($content, $data);
				  ob_start();
						eval('?>' . $content . '<?php');
						$parsedContent = ob_get_contents();
						ob_end_clean();
				 
				  echo $parsedContent."<br/>";
				  ?>
				<h4>Các tin liên quan</h4>
				  <ul> 
				  <?php foreach($lists as $item): ?>
					<li>
						<a href="/<?php echo @$item['alias']?> "><?php echo @$item['title']?></a>
					</li>
				  <?php endforeach; ?>
				  </ul>
				  <div
					  class="fb-like"
					  data-share="true"
					  data-width="450"
					  data-show-faces="true">
					</div>
				  <div class="fb-comments" style="margin-left:150px;" data-href="/<?php echo @$news['alias']?>" data-numposts="5"></div>
			</div>
		</div>
	</div>
</div>
