<?php
$rand = rand(0, 100000);
?>
	<span class="hidden"><?php echo $data->getLabel()?></span>
	<select class="select2-container form-control select2" id="<?php echo $data->getIndex()?>-<?php echo $rand ?>" name="<?php echo $data->getIndex()?>" onchange="pzk_list.filter('<?php echo $data->getType()?>', '<?php echo $data->getIndex()?>', this.value);" >
		<option value="">Tất cả</option>
		<?php foreach($data->getOption() as $key=>$val): ?>
		<option value="<?php echo $key ?>"><?php echo $val ?></option>
		<?php endforeach; ?>
	</select>
	<script type="text/javascript">
		$('#<?php echo $data->getIndex()?>-<?php echo $rand ?>').val('<?php echo $data->getValue()?>');
	$( "#<?php echo $data->getIndex()?>-<?php echo $rand ?>" ).select2( { placeholder: "<?php echo $data->getLabel()?>", maximumSelectionSize: 6 } );
    </script>