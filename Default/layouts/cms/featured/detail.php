
<script type="text/javascript">var switchTo5x=true;</script>
<script type="text/javascript" src="http://w.sharethis.com/button/buttons.js"></script>
<script type="text/javascript" src="http://s.sharethis.com/loader.js"></script>


<?php 
	$ip = getRealIPAddress();
	$id=pzk_request('id');
	$ip=$data->getVisitor($ip,$id);
	$featured=$data->getfeaturedContent($id);
	$nlists=$data->getfeaturedList($id);
	$lists = $nlists[0];
?>

<p><a href="/featured/subfeatured">Bài viết hay</a>
<?php if ($nlists[2]){ ?> 
>> <a href="/featured/detail?id=<?php echo $nlists[2]['id'];?>">
  <?php echo $nlists[2]['title'];?></a>
<?php }
?>
 >>   
<a href="/featured/detail?id={featured[id]}">{featured[title]}</a>
</p>

<div id="showfeatured-wrapper" style="width:95%; ">
  <div id="showfeatured-left">
    <div class="showfeatured-container">
      <div class="showfeatured-title">
	  <h3> {featured[title]}</h3>
	  </div>
	  <div class="showfeatured-brief"><h6><strong>{featured[brief]}<strong></h6></div>
      <div class="showfeatured-content" style="margin-bottom:20px;">
	  <?php 
	  $content= $featured['content'];
	  $content = PzkParser::parseTemplate($content, $data);
	  ob_start();
            eval('?>' . $content . '<?php');
            $parsedContent = ob_get_contents();
            ob_end_clean();
	 
	  echo $parsedContent."</br>";
	  ?>
	  </div>
	 <iframe src="https://www.facebook.com/plugins/like.php?href=http%3A%2F%2Fptnn.vn%2Fnews%2Fshownews&amp;width&amp;layout=button_count&amp;action=like&amp;show_faces=true&amp;share=false&amp;height=21&amp;appId=826319910759457" scrolling="no" frameborder="0" style="border:none; overflow:hidden; height:21px;" allowTransparency="true"></iframe>
   </div>
	<div class="comments">
		{children all}
	</div>
    <div class="prf_other" style="margin-top: 20px;">
      <div class="prf_title">Các bài viết khác
	  </div>
      <div class="prf_content"> 
	  {each $lists as $list}
	  <li><a href="/featured/detail?id={list[id]} ">{list[title]}<br></a></li>
	  {/each}
	  </div>
      <div class="prf_clear"> </div>
    </div>
  </div>
  
</div>
<script type="text/javascript">stLight.options({publisher: "51c0dbe4-459b-4618-825a-81abb5e257ed", doNotHash: false, doNotCopy: false, hashAddressBar: false});</script>
<script>
var options={ "publisher": "51c0dbe4-459b-4618-825a-81abb5e257ed", "position": "left", "ad": { "visible": false, "openDelay": 5, "closeDelay": 0}, "chicklets": { "items": ["facebook", "googleplus", "twitter", "email"]}};
var st_hover_widget = new sharethis.widgets.hoverbuttons(options);
</script>