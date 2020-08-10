<?php
$rand = rand(0, 100000);
?>
	<span class="hidden"><?php echo $data->get('label')?></span>
	<select class="select2-container form-control select2" id="<?php echo $data->get('index')?>-<?php echo $rand ?>" name="<?php echo $data->get('index')?>" onchange="pzk_list.filter('<?php echo $data->get('type')?>', '<?php echo $data->get('index')?>', this.value);" >
		<option value="">Tất cả</option>
		<?php foreach($data->get('option') as $key=>$val): ?>
		<option value="<?php echo $key ?>"><?php echo $val ?></option>
		<?php endforeach; ?>
	</select>
	<script type="text/javascript">
		$('#<?php echo $data->get('index')?>-<?php echo $rand ?>').val('<?php echo $data->get('value')?>');
	$( "#<?php echo $data->get('index')?>-<?php echo $rand ?>" ).select2( { placeholder: "<?php echo $data->get('label')?>", maximumSelectionSize: 6 } );
    </script>