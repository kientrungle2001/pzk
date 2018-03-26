<?php 
	$language = pzk_global()->get('language');
	$lang = pzk_session('language');
?>
<div class="col-md-12 col-xs-12" id="changecontent">	
	{? $items = $data->get('name'); ?}
	{each $items as $name}
	<div class="col-md-12 col-xs-12 bdbot">
		<h3 class="text-center">
		<?php 
			if ($lang == 'en' || $lang == 'ev'){
				echo $name['name_en'];
			}else{
				echo $name['name_vn'];
			} 
		?>
		</h3>
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
				<?php  $items = $data->getDocument($name['id']); ?>
				{each $items as $item}
				<tr>
					<?php  $cates = $data->getCate($item['categoryId']); ?>
					{each $cates as $cate}
					<td class="col-md-4 col-xs-9"><a href="/document/class-5/subject-{cate[alias]}/{item[alias]}-{item[id]}">{item[title]}</a></td>
					{/each}
					<td class="hidden-xs">{item[created]}</td>
					<td class="hidden-xs">
					<?php 
					echo humanFileSize(@filesize(BASE_DIR . $item['file']));
					?></td>
					<td class="hidden-xs">{item[downloads]}</td>
					<td class="col-xs-3"><a href="{item[file]}"><?php echo $language['download'];?></a></td>
				</tr>
				{/each} 
			</tbody>
		</table> 
		<p class="pull-right"><a href="/document/class-5/subject-{name[alias]}-{name[id]}"><?php echo $language['more'];?></a></p>
	</div>
	{/each} 	
</div>