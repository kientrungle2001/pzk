<?php
$items = $data->getItems();
?>
{ifprop listType=row}
{each $items as $item}
<article class="row post">
	<?php if($data->get('showThumbnail') !== 'false') { ?>
	<div class="col-xs-3">
		<a href="/{item[alias]}">
		<img class="img-responsive img-thumbnail" src="<?php echo BASE_URL. @createThumb($item['img'], 480, 480) ; ?>" />
			</a>
	</div>
	<div class="col-xs-9">
		<a href="/{item[alias]}">
			<{data.get('titleTag')} class="entry-title text-justify"> {item[title]}</{data.get('titleTag')}>
		</a>
		<?php if($data->get('showBrief') !== 'false') { ?>
		<{data.get('briefTag')} class="article-summary text-justify">{item[brief]}</{data.get('briefTag')}>
		<?php } ?>
	</div>
	<?php } else { ?>
	<div class="col-xs-12">
		<a href="/{item[alias]}">
			<{data.get('titleTag')} class="entry-title text-justify"> {item[title]}</{data.get('titleTag')}>
		</a>
		<?php if($data->get('showBrief') !== 'false') { ?>
		<{data.get('briefTag')} class="article-summary text-justify">{item[brief]}</{data.get('briefTag')}>
		<?php } ?>
	</div>
	<?php } ?>
	
</article>
<br />
{/each}
{else}
<ul class="{data.get('ulClass')}">
{each $items as $item}
<li class="{data.get('liClass')}"><a href="/{item[alias]}">
			<{data.get('titleTag')} class="entry-title"> {item[title]}</{data.get('titleTag')}>
		</a></li>
{/each}
</ul>
{/if}