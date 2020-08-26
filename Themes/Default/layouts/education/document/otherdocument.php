<h3>Các tài liệu cùng chuyên mục</h3>
<ul class="list-unstyled">
	<?php  $items = $data->getOther(intval(pzk_request()->getId())); ?>
	<?php foreach($items as $item): ?>
	<?php  $cates = $data->getCate($item['categoryId']); ?>
	<?php foreach($cates as $cate): ?>
	<li><a href="/document/class-5/subject-<?php echo @$cate['alias']?>/<?php echo @$item['alias']?>-<?php echo @$item['id']?>"><?php echo @$item['title']?></a></li>
	<?php endforeach; ?>
	<?php endforeach; ?>
</ul>