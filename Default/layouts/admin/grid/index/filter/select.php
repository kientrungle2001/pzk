<span class="hidden"><?php echo $data->get('label')?></span>
<select class="select2-container form-control select2" id="<?php echo $data->get('index')?>-<?php echo $rand ?>" name="{data->get('index')}" onchange="pzk_list.filter('{data->get('type')}', '<?php echo $data->get('index')?>', this.value);">
	<?php
$parents = _db ()->select ( '*' )->from ( $data->get('table') )->where(pzk_or($data->get('condition'), '1'))->orderBy(pzk_or($data->get('orderBy'), 'id asc'))->result ();
	if (isset ( $parents [0] ['parent'] )) {
		$parents = treefy ( $parents, 'parent', 0 );
		echo "<option value='' >--Tất cả</option>";
	} else {
		echo "<option value=''>Tất cả</option>";
	}
	?>
	<?php if($data->get('notAccept') == '1'):?>
		<option value='0'>(Trống)</option>
	<?php endif;?>
	<?php foreach($parents as $parent): ?>
	<option value="<?php echo $parent[$data->get('show_value')]; ?>"><?php if(isset($parent['parent'])){ echo str_repeat('--', @$parent['level']); } ?>
		#<?php echo @$parent['id']?> - <?php echo $parent[$data->get('show_name')]; ?>
	</option> <?php endforeach; ?>
</select>
<script type="text/javascript">
	$('#<?php echo $data->get('index')?><?php echo $rand ?>').val('<?php echo $data->get('value')?>');
	$( "#<?php echo $data->get('index')?><?php echo $rand ?>" ).select2( { placeholder: "<?php echo $data->get('label')?>", maximumSelectionSize: 6 } );
</script>