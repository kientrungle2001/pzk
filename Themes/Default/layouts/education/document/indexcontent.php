<div class="col-md-12 col-xs-12" id="changecontent">	
	{? $items = $data->getName(); ?}
	{each $items as $name}
	<div class="col-md-12 col-xs-12 bdbot">
		<h3 class="text-center">{name[name]}</h3>
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
			{each $items as $item}
			<tr>
				<?php  $cates = $data->getCate($item['categoryId']); ?>
				{each $cates as $cate}
				<td class="col-md-4"><a href="/document/class-5/subject-{cate[alias]}/{item[alias]}-{item[id]}">{item[title]}</a></td>
				{/each}
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
		<p class="pull-right"><a href="/document/class-5/subject-{name[alias]}-{name[id]}">Xem thêm</a></p>
	</div>
	{/each} 	
</div>