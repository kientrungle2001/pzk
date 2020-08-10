<?php 
	if(@$data->get('value') == '' || @$data->get('value') == '1970-01-01' || @$data->get('value') == '1970-01-01 00:00:00' || @$data->get('value') == '0000-00-00 00:00:00') {
		$dateFormated = '(Trống)';
	} else {
		$dateFormated = date($data->get('format'), strtotime(@$data->value));
	}
	
?>
<?php if($data->get('editable')) { ?>
<span class="inline-edit" id="inline-item-<?php  echo $data->get('index') ?>-<?php  echo $data->get('itemId') ?>">
	<span class="inline-text" ondblclick="pzk_list.showInlineEdit('<?php  echo $data->get('index') ?>', <?php  echo $data->get('itemId') ?>); return false;"><?php echo $dateFormated ?></span>
	<span class="inline-input" style="display: none;">
		<input class="inline-input-field" type="text" name="<?php  echo $data->get('index') ?>" value="<?php  echo date('m/d/Y H:i', strtotime($data->get('value'))) ?>" 
			onblur="pzk_list.inlineFocus=false;" 
			onfocus="pzk_list.inlineFocus=true;"
			onkeyup="event = event||window.event; if(event.which==13) {pzk_list.saveInlineEdit('<?php  echo $data->get('index') ?>', <?php  echo $data->get('itemId') ?>); return false;}; "
			/>
		<a href="#" onclick="pzk_list.saveInlineEdit('<?php  echo $data->get('index') ?>', <?php  echo $data->get('itemId') ?>); return false;"><span class="glyphicon glyphicon-save"></span></a>
		<a href="#" onclick="pzk_list.cancelInlineEdit('<?php  echo $data->get('index') ?>', <?php  echo $data->get('itemId') ?>); return false;"><span class="glyphicon glyphicon-remove"></span></a>
	</span>
</span>
<script type="text/javascript">
	<?php if($data->get('dateType') === 'date') { ?>
	$('#inline-item-<?php  echo $data->get('index') ?>-<?php  echo $data->get('itemId') ?> .inline-input-field').datepicker({defaultDate: new Date('<?php  echo $data->get('value') ?>') });
	<?php } else { ?>
	$('#inline-item-<?php  echo $data->get('index') ?>-<?php  echo $data->get('itemId') ?> .inline-input-field').datetimepicker({defaultDate: new Date(<?php  echo strtotime($data->get('value'))?> * 1000) });
	<?php } ?>
</script>
<?php } else { ?><?php echo $dateFormated ?><?php } ?>