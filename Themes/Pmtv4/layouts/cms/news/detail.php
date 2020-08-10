<?php 
	$news	=	$data->getNews();
	$lists 	= 	$data->getRelatedNews();
?>
<div class="<?php echo pzk_theme_css_class('news-container')?>">
    <div class="row">
		<div class="col-xs-12">
			<div class="<?php echo pzk_theme_css_class('news-wrapper')?>">
				<h1 class="<?php echo pzk_theme_css_class('news-title')?>"><?php echo @$news['title']?></h1>
				<em class="<?php echo pzk_theme_css_class('news-description')?>"><?php echo @$news['brief']?></em>
				<div class="<?php echo pzk_theme_css_class('news-content')?>">
				<?php 
				  $content= $news['content'];
				  $content = PzkParser::parseTemplate($content, $data);
				  ob_start();
						eval('?>' . $content . '<?php');
						$parsedContent = ob_get_contents();
						ob_end_clean();
				 
				  echo $parsedContent."<br/>";
				  ?>
				  </div>
				<div class="<?php echo pzk_theme_css_class('news-related-wrapper')?>">
				<h4 class="<?php echo pzk_theme_css_class('news-related-title')?>">Các tin liên quan</h4>
				  <ul class="<?php echo pzk_theme_css_class('news-relateds')?>"> 
				  <?php foreach($lists as $item): ?>
					<li>
						<a href="/<?php echo @$item['alias']?> "><?php echo @$item['title']?></a>
					</li>
				  <?php endforeach; ?>
				  </ul>
				</div>
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
