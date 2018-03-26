<?php 

$subject = _db()->getTableEntity('categories')->load(pzk_request()->getSegment(3));
$subjects = _db()->selectAll()->fromCategories()->whereParent($subject->get('parent'))->result();
$language = pzk_global()->get('language');
$lang = pzk_session('language');
 ?>
<div class="col-md-12 col-xs-12 btn-custom4">
	<ul class="breadcrumb text-center">
		<li><a href="/document/home"><?php echo $language['materials'];?></a></li>
		<li><a href="/document/home"><?php echo $language['class'];?> {data.get('class')}</a></li>
		<li class="active">
			<span class="dropdown">
			  <a class="dropdown-toggle" type="button" id="dropdownSubjectDocument" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
				{subject.get('name')}
				<span class="caret"></span>
			  </a>
			  <ul class="dropdown-menu" aria-labelledby="dropdownSubjectDocument" style="top: 12px;">
			  {each $subjects as $sbj}
				<li><a href="/document/index/{sbj[id]}?class={? echo pzk_request()->get('class')?}">{sbj[name]}</a></li>
			  {/each}
			  </ul>
			</span>
		</li>
	</ul>
</div>
<div class="col-md-12 col-xs-12">
	<table class="table">
	<thead>
	  <tr>
		<th class="col-md-4"><?php echo $language['document'];?></th>
		<th class="hidden-xs"><?php echo $language['created'];?></th>
		<th class="hidden-xs"><?php echo $language['size'];?></th>
		<th class="hidden-xs"><?php echo $language['downloaded'];?></th>
		<th></th>
	  </tr>
	</thead>
	<tbody>
	{? $items = $data->getItems();
		$itemTotal = $data->getCountItems();
		$pages = ceil($itemTotal / 10);
	?}
		{each $items as $item}
	  <tr>
		<td><a href="/document/detail/{data.get('categoryId')}?class={data.get('class')}&id={item[id]}">{item[title]}</a></td>
		<td class="hidden-xs">{item[created]}</td>
		<td class="hidden-xs">
		<?php 
		echo humanFileSize(@filesize(BASE_DIR . $item['file']));
		?></td>
		<td class="hidden-xs">{item[downloads]}</td>
		<td><a href="{item[file]}"><?php echo $language['download'];?></a></td>
	  </tr>
		{/each}
	</tbody>
  </table>
</div>
<div class="col-xs-12 col-md-12 pd-30">
	<div class="row">
		<div class="col-md-3 col-xs-3"></div>
		<div class=" col-md-6 col-xs-6 btncon text-center">
			<ul class="pagination sharp">
			<?php for ($page = 0; $page < $pages; $page++) {
			if($pages > 10 && ($page < $data->pageNum - 5 || $page > $data->pageNum + 5) && $page != 0 && $page != $pages-1)
				continue;
			if($page == $data->pageNum) { $btn = 'btn-primary'; }
			else { $btn = 'btn-default'; }
		?>
		<li>
		<a class="btn btn-xs {btn}" href="#" onclick="pzk_list.changePage({page}); return false;">{? echo ($page + 1)?}</a>
		</li>
		<?php } ?>
			</ul>
		</div>
		<div class="col-xs-3 col-md-3"></div>
	</div>
</div>
		