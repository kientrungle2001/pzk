<?php 

$subject = _db()->getTableEntity('categories')->load(intval(pzk_request()->getSegment(3)));
$subjects = _db()->selectAll()->fromCategories()->whereParent($subject->getParent())->result();
 ?>
<div class="col-md-12 col-xs-12 btn-custom4">
	<ul class="breadcrumb text-center">
		<li><a href="#">Tài liệu học tập</a></li>
		<li><a href="#">Lớp <?php echo $data->getClass()?></a></li>
		<li class="active">
			<span class="dropdown">
			  <a class="dropdown-toggle" type="button" id="dropdownSubjectDocument" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
				<?php echo $subject->getName()?>
				<span class="caret"></span>
			  </a>
			  <ul class="dropdown-menu" aria-labelledby="dropdownSubjectDocument" style="top: 12px;">
			  <?php foreach($subjects as $sbj): ?>
				<li><a href="/document/index/<?php echo @$sbj['id']?>?class=<?php  echo intval(pzk_request()->getClass())?>"><?php echo @$sbj['name']?></a></li>
			  <?php endforeach; ?>
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
	<?php  $items = $data->getItems();
		$itemTotal = $data->getCountItems();
		$pages = ceil($itemTotal / 10);
	?>
		<?php foreach($items as $item): ?>
	  <tr>
		<td><a href="/document/detail/<?php echo $data->getCategoryId()?>?class=<?php echo $data->getClass()?>&id=<?php echo @$item['id']?>"><?php echo @$item['title']?></a></td>
		<td><?php echo @$item['created']?></td>
		<td>
		<?php 
		echo humanFileSize(@filesize(BASE_DIR . $item['file']));
		?></td>
		<td><?php echo @$item['downloads']?></td>
		<td><a href="<?php echo @$item['file']?>">Tải về</a></td>
	  </tr>
		<?php endforeach; ?>
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
		<a class="btn btn-xs <?php echo $btn ?>" href="#" onclick="pzk_list.changePage(<?php echo $page ?>); return false;"><?php  echo ($page + 1)?></a>
		</li>
		<?php } ?>
			</ul>
		</div>
		<div class="col-xs-3 col-md-3"></div>
	</div>
</div>
		