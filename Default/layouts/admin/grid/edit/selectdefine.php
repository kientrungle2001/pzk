<?php  
$rand 		= rand(1, 100);
$xssize 	= pzk_or($data->get('xssize'), 12);
$mdsize 		= pzk_or($data->get('mdsize'), 12);
$compact	= $data->get('compact');
$nocompact	= !$compact;
if($compact) {
	$data->setSelectLabel($data->get('label'));
}
?>
<div class="col-xs-<?php echo $xssize ?> col-md-<?php echo $mdsize ?>">
	<div class="form-group clearfix">
		<?php if(${'nocompact'}): ?><label for="<?php  echo $data->get('index')?><?php echo $rand ?>"><?php  echo $data->get('label')?></label><?php endif; ?>
		<div style="float: left; width: 100%;" class="item">
			<select class="select2-container form-control select2" id="<?php  echo $data->get('index')?><?php echo $rand ?>"
				name="<?php  echo $data->get('index')?>">
				<?php if(${'compact'}): ?><option value=""><?php  echo $data->get('label')?></option><?php endif; ?>
                <?php $options = json_decode($data->get('options'));?>
                <?php foreach($options as $key=>$val): ?>
                <option value="<?php echo $key ?>"><?php echo $val ?></option> <?php endforeach; ?>
			</select>
		</div>
	</div>
</div>
<script type="text/javascript">
	$('#<?php  echo $data->get('index')?><?php echo $rand ?>').val('<?php  echo $data->get('value')?>');
	$( "#<?php  echo $data->get('index')?><?php echo $rand ?>" ).select2( { placeholder: "<?php  echo $data->get('label')?>", maximumSelectionSize: 6 } );
</script>