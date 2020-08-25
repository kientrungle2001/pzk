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
		<?php if(${'nocompact'}): ?><label for="<?php  echo $data->getIndex()?><?php echo $rand ?>"><?php  echo $data->getLabel()?></label> <?php endif; ?>
		<select
			class="form-control" id="<?php  echo $data->getIndex()?><?php echo $rand ?>"
			name="<?php  echo $data->getIndex()?>">
            <?php
												$table = $data->getTable();
												$items = _db ()->useCB ()->select ( '*' )->from ( $table )->result ();
												if (isset ( $items [0] ['parent'] )) {
													$items = treefy ( $items );
												}
												?>
			<?php if(${'compact'}): ?>
				<option value=""><?php  echo $data->getLabel()?></option>
			<?php endif; ?>
            <?php foreach($items as $val ): ?>
            <option value="<?php echo $val[$data->getShow_value()]; ?>"> 
            	<?php if(isset($val['parent'])){ echo str_repeat('&nbsp;&nbsp;', $val['level']); } ?>
            	<?php echo $val[$data->getShow_name()]; ?></option> <?php endforeach; ?>

		</select> <input id="<?php echo $data->getHidden().$rand; ?>"
			type="hidden" name="<?php echo $data->getHidden(); ?>"
			value="<?php  echo $data->getValue()?>" />
	</div>
</div>
<script>
        $('#<?php  echo $data->getIndex()?><?php echo $rand ?>').change(function() {
            var optionSelected = $(this).find("option:selected");
            var textSelected   = optionSelected.text().trim();
            $('#{data.getHidden()}<?php echo $rand ?>').val(textSelected);
        });
        $('#<?php  echo $data->getIndex()?><?php echo $rand ?>').val('<?php  echo $data->getValue()?>');
		$('#<?php  echo $data->getIndex()?><?php echo $rand ?>').change();
    </script>