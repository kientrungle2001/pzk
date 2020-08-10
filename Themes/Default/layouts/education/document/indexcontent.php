<div class="col-md-12 col-xs-12" id="changecontent">	
	<?php  $items = $data->getName(); ?>
	<?php foreach($items as $name): ?>
	<div class="col-md-12 col-xs-12 bdbot">
		<h3 class="text-center"><?php echo @$name['name']?></h3>
		<table class="table">
		<thead>
		  <tr>
			<th class="col-md-4">Tên tài liệu</th>
			<th>Ngày gửi lên</th>
			<th>Dung lượng</th>
			<th>Lượt tải</th>
			<th></th>
		  </tr>
		</thead>
		<tbody>
			<?php  $items = $data->getDocument($name['id']); ?>
			<?php foreach($items as $item): ?>
			<tr>
				<?php  $cates = $data->getCate($item['categoryId']); ?>
				<?php foreach($cates as $cate): ?>
				<td class="col-md-4"><a href="/document/class-5/subject-<?php echo @$cate['alias']?>/<?php echo @$item['alias']?>-<?php echo @$item['id']?>"><?php echo @$item['title']?></a></td>
				<?php endforeach; ?>
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
		<p class="pull-right"><a href="/document/class-5/subject-<?php echo @$name['alias']?>-<?php echo @$name['id']?>">Xem thêm</a></p>
	</div>
	<?php endforeach; ?> 	
</div>