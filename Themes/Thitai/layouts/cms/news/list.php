<?php
$items = $data->getItems();
?>
{ifprop listType=row}
{each $items as $item}
<article class="row post top10">
	<?php if($data->get('showThumbnail') !== 'false') { ?>
	<div class="col-xs-3">
		<a href="/document/chitiet/{item[id]}">
		<img class="img-responsive img-thumbnail" src="<?php echo BASE_URL. @createThumb($item['img'], 200, 200) ; ?>" />
			</a>
	</div>
	<div class="col-xs-9">
		<a href="/document/chitiet/{item[id]}">
			<{data.get('titleTag')} class="entry-title"> {item[title]}</{data.get('titleTag')}>
		</a>
		<?php if($data->get('showBrief') !== 'false') { ?>
		<{data.get('briefTag')} class="article-summary">
		<?php if($data->get('briefLength')): ?>
			<?php echo cut_words($item['brief'], $data->get('briefLength')); ?>
		<?php else: ?>
		{item[brief]}
		<?php endif; ?>
		
		</{data.get('briefTag')}>
		<?php } ?>
	</div>
	<?php } else { ?>
	<div class="col-xs-12">
		<a href="/document/chitiet/{item[id]}">
			<{data.get('titleTag')} class="entry-title"> {item[title]}</{data.get('titleTag')}>
		</a>
		<?php if($data->get('showBrief') !== 'false') { ?>
		<{data.get('briefTag')} class="article-summary">{item[brief]}</{data.get('briefTag')}>
		<?php } ?>
	</div>
	<?php } ?>
	
</article>
{/each}
{else}
<ul class="{data.get('ulClass')}">
{each $items as $item}
<li class="{data.get('liClass')}"><a href="/document/chitiet/{item[id]}">
			<{data.get('titleTag')} class="entry-title"> {item[title]}</{data.get('titleTag')}>
		</a></li>
{/each}
</ul>
{/if}