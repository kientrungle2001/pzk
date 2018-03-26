<?php 
	$news	=	$data->getNews();
	$lists 	= 	$data->getRelatedNews();
?>
<div class="cls-news-container">
    <div class="row">
		<div class="col-xs-12">
			<div class="cls-news-wrapper">
				<h1 class="cls-news-title">{news[title]}</h1>
				<em class="cls-news-description">{news[brief]}</em>
				<div class="cls-news-content">
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
				<div class="cls-news-related-wrapper">
				<h4 class="cls-news-related-title">Các tin liên quan</h4>
				  <ul class="cls-news-relateds"> 
				  {each $lists as $item}
					<li>
						<a href="/{item[alias]} ">{item[title]}</a>
					</li>
				  {/each}
				  </ul>
				</div>
				  <div
					  class="fb-like"
					  data-share="true"
					  data-width="450"
					  data-show-faces="true">
					</div>
				  <div class="fb-comments" style="margin-left:150px;" data-href="/{news[alias]}" data-numposts="5"></div>
			</div>
		</div>
	</div>
</div>
