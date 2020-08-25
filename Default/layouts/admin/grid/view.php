<?php  $item = $data->getItem();
$listSettingType = $data->getListSettingType();
$fieldSettings = $data->getFieldSettings();
$grid = $data->getChildGrid();
$detail = $data->getParentDetail();
$childrenGridSettings = $data->getChildrenGridSettings();
$parentDetailSettings = $data->getParentDetailSettings();
$gridIndex = $data->getGridIndex();
?>
	<?php  if(!$data->getIsChildModule()): ?>
	<h1 class="text-center"><?php echo @$item['name']?><?php echo @$item['title']?></h1>
	<div class="navbar-collapse collapse navbar-default">
	<ul class="nav navbar-nav">
		<li><a class="label label-info" href="/admin_<?php echo $data->getModule()?>/index">Quay lại</a></li>
		<li><a class="label label-warning" href="/admin_<?php echo $data->getModule()?>/edit/<?php echo $data->getItemId()?>">Sửa</a></li>
		<li class="<?php  if(!$gridIndex) echo 'active';?>"><a href="/Admin_<?php echo $data->getModule()?>/view/<?php echo $data->getItemId()?>">Chi tiết</a></li>
	<?php if(${'childrenGridSettings'}): ?>
	<?php foreach($childrenGridSettings as $gridFieldSettings): ?>
		<?php  if($gridFieldSettings['index'] == $gridIndex){ $active = 'active'; } else { $active = ''; } ?>
		<li class="<?php echo $active ?>"><a class="<?php echo $active ?>" href="/Admin_<?php echo $data->getModule()?>/view/<?php echo $data->getItemId()?>/<?php echo @$gridFieldSettings['index']?>"><?php echo @$gridFieldSettings['label']?></a></li>
	<?php endforeach; ?>
	<?php endif; ?>
	<?php if(${'parentDetailSettings'}): ?>
	<?php foreach($parentDetailSettings as $detailSettings): ?>
		<?php  if($detailSettings['index'] == $gridIndex){ $active = 'active'; } else { $active = ''; } ?>
		<li class="<?php echo $active ?>"><a class="<?php echo $active ?>" href="/Admin_<?php echo $data->getModule()?>/view/<?php echo $data->getItemId()?>/<?php echo @$detailSettings['index']?>"><?php echo @$detailSettings['label']?></a></li>
	<?php endforeach; ?>
	<?php endif; ?>
	</ul>
	</div>
	<?php 	endif; ?>
	<br />

<?php if(${'detail'}): ?>
	<?php  
		$detail->setItemId($item[$detail->getReferenceField()]);
		$detail->display();
		
		?>
<?php else: ?>
<?php if(${'grid'}): ?>
	<?php  $grid->display(); ?>
<?php else: ?>

<?php if(${'fieldSettings'}): ?>
<div class="jumbotron">
<?php foreach($fieldSettings as $field): ?>
	<div class="container">
		<div class="row">
			<div class="col-xs-2"><strong><?php echo @$field['label']?></strong></div>
			<div class="col-xs-10">
		<?php 					
							$fieldObj = pzk_obj('Core.Db.Grid.Field.' . ucfirst($field['type']));
							foreach($field as $key => $val) {
								$fieldObj->set($key, $val);
							}
							$fieldObj->setItemId($item['id']);
							if($fieldObj->getType() == 'parent') {
								$fieldObj->setLevel(@$item['level']);
							}
							if($listSettingType &&  $fieldObj->getType() == 'ordering') {
								$isOrderingField = true;
								$fieldObj->setLevel(@$item['level']);
							}
							$fieldObj->setRow($item);
							$fieldObj->setValue(@$item[$field['index']]);
							$fieldObj->display();
						?>
			</div>
		</div>
	</div>
<?php endforeach; ?>
</div>
<?php else: ?>
	<?php foreach($item as $val): ?>
		<?php echo $val ?><br />
	<?php endforeach; ?>
<?php endif; ?>
<?php endif; ?>
<?php endif; ?>