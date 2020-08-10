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
		<div class="col-xs-8">
			<h1> <?php echo @$news['title']?></h1>
		</div>
	</div>
	<div class="row">
		<div class="col-xs-8"><?php echo @$news['brief']?></div>
		<div class="col-xs-8">
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
		<div
		  class="fb-like"
		  data-share="true"
		  data-width="450"
		  data-show-faces="true">
		</div>
	</div>
	<h3>Luyện thi tiếng Anh kiểu mới vào trường Trần Đại Nghĩa <a href="http://s1.nextnobels.com/">Tại Đây</a></h3>
	<div class="fb-comments" style="margin-left:150px;" data-href="http://www.nextnobels.com/<?php echo @$news['alias']?>" data-numposts="5"></div>
    <div class="row">
      <div class="col-xs-8">
		  <h4>Các tin liên quan</h4>
		  <ul> 
		  <?php foreach($lists as $item): ?>
			<li>
				<a href="/<?php echo @$item['alias']?> "><?php echo @$item['title']?></a>
			</li>
		  <?php endforeach; ?>
		  </ul>
	  </div>
    </div>
</div>
