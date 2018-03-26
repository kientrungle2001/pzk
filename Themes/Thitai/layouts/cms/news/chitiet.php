<?php 
	$news	=	$data->getNews();
	$lists 	= 	$data->getRelatedNews();
?>
<div style='background: white; padding-bottom: 20px' class="item">
    <div class="col-md-12 col-sm-12 col-xs-12 text-center">
		<h2> {news[title]}</h2>
	</div>
	<div class="col-md-10 col-md-offset-1 col-sm-10 col-sm-offset-1 col-xs-12 top10">
		<div class="col-md-12 col-sm-12 col-xs-12 text-justify">{news[brief]}</div>
		<div class="col-md-12 col-sm-12 col-xs-12 text-justify robotofont">
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
