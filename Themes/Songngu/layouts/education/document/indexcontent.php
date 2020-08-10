<?php 
	$language = pzk_global()->get('language');
	$lang = pzk_session('language');
?>
<div class="col-md-12 col-xs-12" id="changecontent">	
	<?php  $items = $data->get('name'); ?>
	<?php foreach($items as $name): ?>
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
				<?php foreach($items as $item): ?>
				<tr>
					<?php  $cates = $data->getCate($item['categoryId']); ?>
					<?php foreach($cates as $cate): ?>
					<td class="col-md-4 col-xs-9"><a href="/document/class-5/subject-<?php echo @$cate['alias']?>/<?php echo @$item['alias']?>-<?php echo @$item['id']?>"><?php echo @$item['title']?></a></td>
					<?php endforeach; ?>
					<td class="hidden-xs"><?php echo @$item['created']?></td>
					<td class="hidden-xs">
					<?php 
					echo humanFileSize(@filesize(BASE_DIR . $item['file']));
					?></td>
					<td class="hidden-xs"><?php echo @$item['downloads']?></td>
					<td class="col-xs-3"><a href="<?php echo @$item['file']?>"><?php echo $language['download'];?></a></td>
				</tr>
				<?php endforeach; ?> 
			</tbody>
		</table> 
		<p class="pull-right"><a href="/document/class-5/subject-<?php echo @$name['alias']?>-<?php echo @$name['id']?>"><?php echo $language['more'];?></a></p>
	</div>
	<?php endforeach; ?> 	
</div>