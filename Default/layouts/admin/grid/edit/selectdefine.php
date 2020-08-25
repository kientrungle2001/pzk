<?php  
$rand 		= rand(1, 100);
$xssize 	= pzk_or($data->getXssize(), 12);
$mdsize 		= pzk_or($data->getMdsize(), 12);
$compact	= $data->getCompact();
$nocompact	= !$compact;
if($compact) {
	$data->setSelectLabel($data->getLabel());
}
?>
<div class="col-xs-<?php echo $xssize ?> col-md-<?php echo $mdsize ?>">
	<div class="form-group clearfix">
		<?php if(${'nocompact'}): ?><label for="<?php  echo $data->getIndex()?><?php echo $rand ?>"><?php  echo $data->getLabel()?></label><?php endif; ?>
		<div style="float: left; width: 100%;" class="item">
			<select class="select2-container form-control select2" id="<?php  echo $data->getIndex()?><?php echo $rand ?>"
				name="<?php  echo $data->getIndex()?>">
				<?php if(${'compact'}): ?><option value=""><?php  echo $data->getLabel()?></option><?php endif; ?>
                <?php $options = json_decode($data->getOptions());?>
                <?php foreach($options as $key=>$val): ?>
                <option value="<?php echo $key ?>"><?php echo $val ?></option> <?php endforeach; ?>
			</select>
		</div>
	</div>
</div>
<script type="text/javascript">
	$('#<?php  echo $data->getIndex()?><?php echo $rand ?>').val('<?php  echo $data->getValue()?>');
	$( "#<?php  echo $data->getIndex()?><?php echo $rand ?>" ).select2( { placeholder: "<?php  echo $data->getLabel()?>", maximumSelectionSize: 6 } );
</script>