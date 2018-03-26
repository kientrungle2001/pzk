<?php 
	$news	=	$data->getNews();
	$lists 	= 	$data->getRelatedNews();
?>

<div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/vi_VN/sdk.js#xfbml=1&version=v2.3&appId=1428443070812396";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>
<div class="container text-justify">
    <div class="row">
		<div class="col-xs-12">
			<h1 class="text-uppercase"> {news[title]}</h1>
		</div>
	</div>
	<div class="row">
		<div class="col-xs-12">{news[brief]}</div>
		<div class="col-xs-12 content-newsn">
		<?php 
	  $content= $news['content'];
	  echo $content;
	  // $content = PzkParser::parseTemplate($content, $data);
	  // ob_start();
            // eval('?'.'>' . $content . '<?'.'php');
            // $parsedContent = ob_get_contents();
            // ob_end_clean();
	 
	  // echo $parsedContent."<br/>";
	  ?>
		</div>
		<div
		  class="fb-like item"
		  data-share="true"
		  data-width="100%"
		  data-show-faces="true">
		</div>
	</div>
	<div class="fb-comments item" data-href="http://www.nextnobels.com/{news[alias]}" data-numposts="5"></div>
    <div class="row">
      <div class="col-xs-12">
		  <h4>Các tin liên quan</h4>
		  <ul> 
		  {each $lists as $item}
			<li>
				<a class="text-uppercase" href="/{item[alias]} ">{item[title]}</a>
			</li>
		  {/each}
		  </ul>
	  </div>
    </div>
</div>
