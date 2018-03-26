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
<div class="row text-justify">
	<h1 class="text-center">{news[title]}</h1>
	<div class="row">
		<div class="col-md-12  col-sm-12  col-xs-12">{news[brief]}</div>
		<div class="col-md-12  col-sm-12  col-xs-12">
		<?php 
		$content= $news['content'];
		echo $content."<br/>";
		?>
		</div>
		<div
		  class="fb-like"
		  data-share="true"
		  data-width="450"
		  data-show-faces="true">
		</div>
	</div>
	<h3 class="col-md-12  col-sm-12 col-xs-12">Luyện thi tiếng Anh kiểu mới vào trường Trần Đại Nghĩa <a href="http://s1.nextnobels.com/">Tại Đây</a></h3>
	<div class="fb-comments col-md-12  col-sm-12 col-xs-12" style="margin-left:150px;" data-href="http://www.nextnobels.com/{news[alias]}" data-numposts="5"></div>
    <div class="row">
      <div class="col-md-12  col-sm-12 col-xs-12">
		  <h4>Các tin liên quan</h4>
		  <ul> 
		  {each $lists as $item}
			<li>
				<a href="/{item[alias]} ">{item[title]}</a>
			</li>
		  {/each}
		  </ul>
	  </div>
    </div>
</div>
