<?php 
$controller = pzk_controller(); 
$compact	= $data->get('compact');
$nocompact	= !$compact;
if($compact) {
	$data->set('selectLabel', $data->get('label'));
}
?>
<div  class="form-group col-xs-12">
	<?php if(${'nocompact'}): ?><label><?php  echo $data->get('label')?></label><br /><?php endif; ?>
	<select class="select2-container form-control select2"  id="<?php  echo $data->get('index')?>" name="<?php  echo $data->get('index')?>" onchange="pzk_list.filter('<?php  echo $data->get('type')?>', '<?php  echo $data->get('index')?>', this.value);" >
		<?php if(${'nocompact'}): ?>
		<option value="">Tất cả</option>
		<?php else: ?>
		<option value=""><?php  echo $data->get('label')?></option>
		<?php endif; ?>
		<?php foreach($data->get('option') as $key=>$val): ?>
		<option value="<?php echo $key ?>"><?php echo $val ?></option>
		<?php endforeach; ?>
	</select>
	<script type="text/javascript">
		$('#<?php  echo $data->get('index')?><?php echo $rand ?>').val('<?php  echo $data->get('value')?>');
		$( "#<?php  echo $data->get('index')?><?php echo $rand ?>" ).select2( { placeholder: "<?php  echo $data->get('label')?>", maximumSelectionSize: 6 } );
	</script>
</div>