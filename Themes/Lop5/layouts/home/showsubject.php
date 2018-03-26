{? $items = $data->getItems(); ?}
{each $items as $item}
<div class="col-lg-2 col-md-2 col-xs-6 pd-40">
	<a href="#" onclick ="return false;" class="subjectclick" data-subject="{item[id]}" data-alias="{item[alias]}">
		<div class="thumbnail fxheight btn-custom3 text-color text-uppercase weight-12 text-center sharp">
			<div class="fiximg hidden-xs">
			<img src="<?=BASE_SKIN_URL?>{item[img]}" alt="{item[alias]}" class=" img-responsive center-block">
			</div>
			<div class="hfix">
			<p class="pd-50">{item[name]}</p>
			<p>{item[viettitle]}</p>
			</div>
		</div>
	</a>
</div>
{/each}