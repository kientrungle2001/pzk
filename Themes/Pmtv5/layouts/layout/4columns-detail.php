<?php $items = $data->getItems(); 
$items = buildTree($items);
$root = $items[0]; ?>

<div class="category-section home-{root[alias]}">
	<div class="row">
		<div class="col-xs-12">			
			<div class="header">
				<h2 class="title">
					 <a href="{root[alias]}">
						<img src="/Themes/pmtv5/skin/media/luyentuvacau.png" style="height: 35px;" /> {root[name]}</a>
				</h2>
			</div>
			<div class="row" id="carousel-{data.id}">
			{? $children = $root['children']; $index = 0; ?}
			{each $children as $item}
			<div class="col-sm-3  carousel-item">
				<div class="bgcolor8 bdcolor8">
					<div class="carousel-thumbnail" style="padding: 10px 30px;">
						<img src="<?php echo pzk_or($item['img'],'/Themes/pmtv4/skin/media/4column-detail-image.jpg'); ?>" />
					</div>
					<h3 class="title"> <a href="/{item[alias]}">{item[name]}</a> </h3>
					<p class="lesson"><span class="intro-text">{item[content]}</span></p>
					{? 	$course 	= 	$item['children'][0]; 
						$practice	=	$item['children'][1];
					?}
					<ul class="lesson-detail">
						<li class="course">
							<a class="color7" href="/{item[alias]}"> <span class="glyphicon glyphicon-book"></span> Bài giảng cơ bản & nâng cao</a>
						</li>
						<li class="practice">
							<a class="color7" href="/{item[alias]}"> <span class="glyphicon glyphicon-pencil"></span> Luyện tập cơ bản & nâng cao</a>
						</li>
					</ul>
				</div>
			</div>
			{? $index++; ?}
			{/each}
			<div class="clear"></div>
			</div>
		</div>
	</div>
	
</div>

<script type="text/javascript">

$('#carousel-{data.id}').carousel({
	size: 1,
	childSelector: 	'.col-sm-3',
	desktop: {size: 4}
});
</script>

<style>
</style>