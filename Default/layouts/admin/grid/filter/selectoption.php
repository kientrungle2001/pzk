<?php 
$controller = pzk_controller(); 
$compact	= $data->getCompact();
$nocompact	= !$compact;
if($compact) {
	$data->setSelectLabel($data->getLabel());
}
$rand = rand(1, 100000);
?>
<div  class="form-group col-xs-12">
	<?php if(${'nocompact'}): ?><label><?php  echo $data->getLabel()?></label><br /><?php endif; ?>
	<select class="select2-container form-control select2"  id="<?php  echo $data->getIndex()?>" name="<?php  echo $data->getIndex()?>" onchange="pzk_list.filter('<?php  echo $data->getType()?>', '<?php  echo $data->getIndex()?>', this.value);" >
		<?php if(${'nocompact'}): ?>
		<option value="">Tất cả</option>
		<?php else: ?>
		<option value=""><?php  echo $data->getLabel()?></option>
		<?php endif; ?>
		<?php foreach($data->getOption() as $key=>$val): ?>
		<option value="<?php echo $key ?>"><?php echo $val ?></option>
		<?php endforeach; ?>
	</select>
	<script type="text/javascript">
		$('#<?php  echo $data->getIndex()?><?php echo $rand ?>').val('<?php  echo $data->getValue()?>');
		$( "#<?php  echo $data->getIndex()?><?php echo $rand ?>" ).select2( { placeholder: "<?php  echo $data->getLabel()?>", maximumSelectionSize: 6 } );
	</script>
</div>