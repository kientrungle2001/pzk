<span class="hidden"><?php echo $data->getLabel()?></span>
<select class="select2-container form-control select2" id="<?php echo $data->getIndex()?>-<?php echo $rand ?>" name="{data->getIndex()}" onchange="pzk_list.filter('{data->getType()}', '<?php echo $data->getIndex()?>', this.value);">
	<?php
$parents = _db ()->select ( '*' )->from ( $data->getTable() )->where(pzk_or($data->getCondition(), '1'))->orderBy(pzk_or($data->getOrderBy(), 'id asc'))->result ();
	if (isset ( $parents [0] ['parent'] )) {
		$parents = treefy ( $parents, 'parent', 0 );
		echo "<option value='' >--Tất cả</option>";
	} else {
		echo "<option value=''>Tất cả</option>";
	}
	?>
	<?php if($data->getNotAccept() == '1'):?>
		<option value='0'>(Trống)</option>
	<?php endif;?>
	<?php foreach($parents as $parent): ?>
	<option value="<?php echo $parent[$data->getShow_value()]; ?>"><?php if(isset($parent['parent'])){ echo str_repeat('--', @$parent['level']); } ?>
		#<?php echo @$parent['id']?> - <?php echo $parent[$data->getShow_name()]; ?>
	</option> <?php endforeach; ?>
</select>
<script type="text/javascript">
	$('#<?php echo $data->getIndex()?><?php echo $rand ?>').val('<?php echo $data->getValue()?>');
	$( "#<?php echo $data->getIndex()?><?php echo $rand ?>" ).select2( { placeholder: "<?php echo $data->getLabel()?>", maximumSelectionSize: 6 } );
</script>