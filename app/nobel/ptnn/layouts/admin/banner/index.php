
<?php $items = $data->getItems();
	$items = buildArr($items,'parent',0);
	$keyword = pzk_session()->getQuestionsKeyword();
	$countItems = $data->getCountItems($keyword, array('name'));
	$pages = ceil($countItems / $data->pageSize);	
?>
<table class="table">
	<tr>
		<th>#</th>
		<th>Tên Banner</th>
		<th>Ngày Tạo</th>
		<th>URL</th>
		<th>Code</th>
		<th colspan="2">Hành động</th>
	</tr>
	{each $items as $item}
	<?php 
	$tab = '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp';
	$banner = str_repeat($tab, $item['level'])
	.$item['title']
	.$item['ngaytao']
	.$item['url']
	.$item['code'];
	?>
	<tr>
		<td>{item[id]}</td>
		<td>{item[title]}</td>
		<td>{item[ngaytao]}</td>
		<td>{item[url]}</td>
		<td>{item[code]}</td>
		<td colspan="3">
		<a href="{url /admin_banner/add}/{item[id]}">Thêm 
        <a href="{url /admin_banner/edit}/{item[id]}">Sửa		
		<a href="{url /admin_banner/del}/{item[id]}">Xóa
		</td>
	
	</tr>
	{/each}
	<tr>
		<td colspan="6">
		<form class="form-inline" role="form">
		<strong>Số mục: </strong>
		<select id="pageSize" name="pageSize" class="form-control" placeholder="Số mục / trang" onchange="window.location='{url /admin_banner/changePageSize}?pageSize=' + this.value;">
			<option value="10">10</option>
			<option value="20">20</option>
			<option value="30">30</option>
			<option value="50">50</option>
			<option value="100">100</option>
			<option value="200">200</option>
		  </select>
		  <script type="text/javascript">
			$('#pageSize').val('{pageSize}');
		  </script>
		<strong>Trang: </strong>
		<?php for ($page = 0; $page < $pages; $page++) { 
			if($page == $data->pageNum) {
				$btn = 'btn-primary';
			} else {
				$btn = 'btn-default';
			}
		?>
		<a class="btn {btn}" href="{url /admin_banner/index}?page={page}">{? echo ($page + 1)?}</a>
		<?php } ?>
		</form>
		</td>
	</tr>
	
</table>