<?php
$items = $data->getItems();
$stt = 1;
?>
<h1 class="text-center">DANH SÁCH THI</h1>
<table class="table table-bordered">
<tr>
	<th>STT</th>
	<th>Tên đăng nhập</th>
	<th>Họ và tên</th>
	<th>Số điện thoại</th>
	<th>Email</th>
	<th>Đợt thi</th>
</tr>
{each $items as $item}
<tr>
	<td>{stt}</td>
	<td>{item[username]}</td>
	<td>{item[name]}</td>
	<td>{item[phone]}</td>
	<td>{item[email]}</td>
	<td>{item[tests]}</td>
</tr>
{? $stt++ ?}
{/each}
</table>