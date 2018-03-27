<?php 
	$id=pzk_request('id');
	$news=$data->getNewsContent($id);
	$nlists=$data->getNewsList($id);
	$lists = $nlists[0];
?>

<div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/vi_VN/sdk.js#xfbml=1&version=v2.3&appId=1428443070812396";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>
<div id="shownews-wrapper" class="col-xs-12">
    <div class="shownews-container">
		<div class="shownews-title">
			<p> {news[title]}</p>
		</div>
		<div class="shownews-brief">{news[brief]}</div>
		<div class="shownews-content" style="margin-bottom:20px;">
		<?php 
	  $content= $news['content'];
	  $content = PzkParser::parseTemplate($content, $data);
	  ob_start();
            eval('?>' . $content . '<?php');
            $parsedContent = ob_get_contents();
            ob_end_clean();
	 
	  echo $parsedContent."</br>";
	  ?>
		</div>
		<div
		  class="fb-like"
		  data-share="true"
		  data-width="450"
		  data-show-faces="true">
		</div>
	</div>
	<h3>Luyện thi tiếng Anh kiểu mới vào trường Trần Đại Nghĩa <a href="http://s1.nextnobels.com/Ngonngu/test/48">Tại Đây</a></h3>
	<div class="fb-comments" style="margin-left:150px;" data-href="http://www.nextnobels.com/{news[alias]}" data-numposts="5"></div>
    <div class="prf_other">
      <div class="other-news">Các tin liên quan</div>
      <div class="other-link"> 
	  {each $lists as $list}
		<li>
			<a href="/{list[alias]} ">{list[title]}</a>
		</li>
	  {/each}
	  </div>
    </div>
</div>
