<style>
@font-face {
	font-family: 'Roboto Slab';
	src: url('/Themes/story/skin/media/font/RobotoSlab-Regular.ttf');
}
@font-face {
	font-family: 'Roboto Slab';
	src: url('/Themes/story/skin/media/font/RobotoSlab-Bold.ttf');
	font-weight: bold;
}
@font-face {
	font-family: 'Roboto Slab';
	src: url('/Themes/story/skin/media/font/RobotoSlab-Light.ttf');
	font-weight: lighter;
}
.robotofont{
	font-family: 'Roboto Slab', serif;
}
</style>
<?php
	$commonNews = $data->getCommonNews();
 ?>
<div class="container" style="margin-top:60px;">
	<div class="item">
		<div class="col-md-8" style="border: solid 4px #337ab7; padding: 0px;">
			{children [position=slider]}
		</div>
		<div class="col-md-4 fontutm" >
			{each $commonNews as $new}
			<div class="col-md-12" style="border-bottom: #337ab7 4px solid; margin-bottom: 10px;">
				<div class="row" style="margin-bottom: 20px;">
					<div style="padding: 0px;" class ="col-md-4 col-xs-12">
						<a href="/{new[alias]}">
						<img class="item bdimgvct" src="{new[img]}"/>
						</a>
					</div>
					<div class ="col-md-8 col-xs-12">
						<strong><a style="color: #040737;" href="/{new[alias]}"><?php echo cut_words($new['title'], 10); ?></a></strong>
						<div style="margin-bottom: 4px;"><?php echo cut_words($new['brief'], 18); ?></div>
						<p>	
							<span>
								<span class="glyphicon glyphicon-time"></span>
								<?php echo date('d-m-Y', strtotime($new['created'])); ?>  -
							</span>
							<span>
								<span class="glyphicon glyphicon-comment"></span>
								{new[comments]} -
							</span>
							<span>
								<span class="glyphicon glyphicon-eye-open"></span> {new[views]}
							</span>
							
						</p>
					</div>
				</div>
			</div>
			{/each}
		</div>
	</div>
</div>