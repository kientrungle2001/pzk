<?php $items = $data->getItems(); 
$layoutType = $data->getProp('layoutType', 'div');
$displayFields = explode(',',$data->displayFields);
?>
<!-- hien thi theo kieu ul -->
<?php if(${'layoutType=ul'}): ?>
<ul>
<?php foreach($items as $item): ?>
	<li><?php echo @$item['name']?></li>
<?php endforeach; ?>
</ul>
<?php endif; ?>

<!-- hien thi theo kieu div -->
<?php if(${'layoutType=div'}): ?>
<div class="core_db_list">
<?php foreach($items as $item): ?>
	<div class="core_db_list_item">
	<?php foreach($displayFields as $field): ?>
	<?php  	$field = trim($field); 
		$fieldTag = $field . 'Tag'; 
		$fieldTag=@$data->$fieldTag?@$data->$fieldTag: 'div';
		$value = @$item[$field]; 
	?>
	<<?php echo $fieldTag ?> class="<?php echo @$data->classPrefix?><?php echo $field ?>" rel="<?php echo @$item['id']?>">
		<?php  if(@$data->titleField==$field && @$data->linkTitle) : ?>
		<a href="/<?php echo @$item['alias']?>">
		<?php  endif;?>
	<?php echo $value ?>
		<?php  if(@$data->titleField==$field && @$data->linkTitle) : ?>
		</a>
		<?php  endif;?>
	</<?php echo $fieldTag ?>>
	<?php endforeach; ?>
	</div>
<?php endforeach; ?>
</div>
<?php endif; ?>
