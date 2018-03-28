<?php 

$subject = _db()->getTableEntity('categories')->load(intval(pzk_request()->getSegment(3)));
$subjects = _db()->selectAll()->fromCategories()->whereDisplay(1)->whereParent($subject->get('parent'))->result();
 ?>
<div class="col-md-12 col-xs-12 btn-custom4">
	<ul class="breadcrumb text-center">
		<li><a href="/document/home">Tài liệu học tập</a></li>
		<li class="active">
			<span class="dropdown">
			  <a class="dropdown-toggle" type="button" id="dropdownSubjectDocument" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
				{subject.get('name')}
				<span class="caret"></span>
			  </a>
			  <ul class="dropdown-menu" aria-labelledby="dropdownSubjectDocument" style="top: 12px;">
			  {each $subjects as $sbj}
				<li><a href="/document/class-5/subject-{sbj[alias]}-{sbj[id]}">{sbj[name]}</a></li>
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
		<th>Tên tài liệu</th>
		<th>Ngày gửi lên</th>
		<th>Dung lượng</th>
		<th>Lượt tải</th>
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
		 
		<td>
		
		<a href="/document/class-5/subject-{subject.get('alias')}-{subject.get('id')}/{item[alias]}-{item[id]}">{item[title]}</a>

		</td>
		
		<td>{item[created]}</td>
		<td>
		<?php 
		echo humanFileSize(@filesize(BASE_DIR . $item['file']));
		?></td>
		<td>{item[downloads]}</td>
		<td><a href="{item[file]}">Tải về</a></td>
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
		