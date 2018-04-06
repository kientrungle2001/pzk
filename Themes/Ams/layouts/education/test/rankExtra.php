<?php
$items = $data->getItems();
$countItems = $data->getCountItems();
$pages = ceil($countItems / $data->pageSize);
$parent = _db()->getTableEntity('tests')->load($data->get('parentId'), 1800);
?>
<div class="container">
<div class="row">
<div class="col-xs-12">
<h1 class="text-center"> Bảng xếp hạng cho {parent.get('name')}</h1>
<div class="table-responsive">
<table class="table">
<tr>
<th>#</th>
<th>Mã học sinh</th>
<th>Tên học sinh</th>
<th>Điểm bài 1</th>
<th>Điểm bài 2</th>
<th>Tổng điểm</th>
<th>Thời gian làm bài</th>
</tr>
{? $index = 1; ?}
{each $items as $item}
<tr>
<td>{? echo ($index + $data->pageNum * $data->pageSize) ?}</td>
<td>{item[username]}</td>
<td>{item[name]}</td>
<td>{item[test1Mark]}</td>
<td>{item[test2Mark]}</td>
<td>{item[totalMark]}</td>
<td>{? echo time_duration($item['duringTime']); ?}</td>
</tr>
{? $index++; ?}
{/each}
</table>
Trang 
<?php 
for($i = 0; $i < $pages; $i++):
?>
<a class="btn <?php if($i == $data->pageNum): ?>btn-primary<?php else: ?>btn-default<?php endif; ?>" href="/Compability/rank/5/{data.parentId}?page={i}">
	{? echo ($i + 1) ?}
</a>
<?php endfor;?>
<br /><br />
</div>
</div>
</div>
</div>