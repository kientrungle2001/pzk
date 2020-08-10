<?php 
	$news	=	$data->getNews();
	$breakcrumb = $data->getCategories();
	
	$curentcate = end($breakcrumb);
	$curentcate = $curentcate->data;
	$lists 	= 	$data->getRelatedNews();
	
	$class = 'vechungtoi';
	$color = 'colorvct';
	$ngang = 'ngangvct';
	if($curentcate['alias'] == 'tin-cong-ty'){
		$class = 'tincongty';
		$color = 'colortct';
		$ngang = 'ngangtct';
	}elseif($curentcate['alias'] == 'thoi-su-hoc-duong') {
		$class = 'thoisu';
		$color = 'colorts';
		$ngang = 'ngangts';
	}
	
?>

<div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/vi_VN/sdk.js#xfbml=1&version=v2.3&appId=1428443070812396";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>

<?php $data->displayChildren('[position=header]') ?>
<style>

</style>
<div class="container" style="margin-top:60px;">
	<div class="row">
		<div class="col-md-9" style="margin-bottom:40px;">
			
			<div class="item">
				<div class="news-title text-center"> 
					<a href="/tin-cong-ty">Tin công ty</a>
					<img style="margin-top: -5px;" src="/Default/skin/nobel/Themes/Story/media/star.png"/>
					<a href="/ve-chung-toi">Về chúng tôi</a>
					<img style="margin-top: -5px;" src="/Default/skin/nobel/Themes/Story/media/star.png"/>
					<a href="/thoi-su-hoc-duong">Thời sự học đường</a>
				</div>
				<?php if($curentcate['name']){ ?>
				<div class="item mgb10">
					<div class="col-xs-5"><h2 class="fs35 nabila <?php echo $color ?>"><?php echo @$curentcate['name']?></h2></div>
					<div class="col-xs-7"> <img class="thanhngang" src="/Themes/story/skin/media/<?php echo $ngang ?>.png" /></div>
				</div>
				<?php } ?>
				<div class="detail-new">
					<h2 class="fontutmbold" style="font-size: 20px; text-transform: uppercase; font-weight: bold;"><?php echo @$news['title']?></h2>
					<div style="border-bottom: solid 2px #bababa; padding-bottom: 5px; width: 200px; margin-bottom: 10px;">
						<span>
							<span class="glyphicon glyphicon-time"></span>
							<?php echo date('d-m-Y', strtotime($news['created'])); ?>  -
						</span>
						<span>
							<span class="glyphicon glyphicon-comment"></span>
							<?php echo @$news['comments']?> -
						</span>
						<span>
							<span class="glyphicon glyphicon-eye-open"></span> <?php echo @$news['views']?>
						</span>
						
					</div>
					
					<div class="detail-new-content">
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
				</div>
			</div>	
			<!--facebook-->
			<div>
				<div style="margin-top: 20px;"
					class="fb-like"
					data-share="true"
					data-width="550px"
					data-show-faces="true">
				</div>
				
				<h3>Luyện thi tiếng Anh kiểu mới vào trường Trần Đại Nghĩa <a href="http://s1.nextnobels.com/">Tại Đây</a></h3>
				<div class="fb-comments item" data-href="http://www.nextnobels.com/<?php echo @$news['alias']?>" data-numposts="5"></div>
			</div>	
			
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
		
		<div class="col-md-3">
			<?php $data->displayChildren('[position=banner]') ?>
		</div>
	</div>
</div>

