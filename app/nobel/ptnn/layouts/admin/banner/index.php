
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
	<?php foreach($items as $item): ?>
	<?php 
	$tab = '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp';
	$banner = str_repeat($tab, $item['level'])
	.$item['title']
	.$item['ngaytao']
	.$item['url']
	.$item['code'];
	?>
	<tr>
		<td><?php echo @$item['id']?></td>
		<td><?php echo @$item['title']?></td>
		<td><?php echo @$item['ngaytao']?></td>
		<td><?php echo @$item['url']?></td>
		<td><?php echo @$item['code']?></td>
		<td colspan="3">
		<a href="<?php echo BASE_REQUEST . '/admin_banner/add' ?>/<?php echo @$item['id']?>">Thêm 
        <a href="<?php echo BASE_REQUEST . '/admin_banner/edit' ?>/<?php echo @$item['id']?>">Sửa		
		<a href="<?php echo BASE_REQUEST . '/admin_banner/del' ?>/<?php echo @$item['id']?>">Xóa
		</td>
	
	</tr>
	<?php endforeach; ?>
	<tr>
		<td colspan="6">
		<form class="form-inline" role="form">
		<strong>Số mục: </strong>
		<select id="pageSize" name="pageSize" class="form-control" placeholder="Số mục / trang" onchange="window.location='<?php echo BASE_REQUEST . '/admin_banner/changePageSize' ?>?pageSize=' + this.value;">
			<option value="10">10</option>
			<option value="20">20</option>
			<option value="30">30</option>
			<option value="50">50</option>
			<option value="100">100</option>
			<option value="200">200</option>
		  </select>
		  <script type="text/javascript">
			$('#pageSize').val('<?php echo $pageSize ?>');
		  </script>
		<strong>Trang: </strong>
		<?php for ($page = 0; $page < $pages; $page++) { 
			if($page == $data->pageNum) {
				$btn = 'btn-primary';
			} else {
				$btn = 'btn-default';
			}
		?>
		<a class="btn <?php echo $btn ?>" href="<?php echo BASE_REQUEST . '/admin_banner/index' ?>?page=<?php echo $page ?>"><?php  echo ($page + 1)?></a>
		<?php } ?>
		</form>
		</td>
	</tr>
	
</table>