<?php  
$rand 		= rand(1, 100);
$xssize 	= pzk_or($data->getXssize(), 12);
$mdsize 		= pzk_or($data->getMdsize(), 12);
?>
<div class="col-xs-<?php echo $xssize ?> col-md-<?php echo $mdsize ?>">
	<div class="form-group clearfix">
		<?php $hiddenData = $data->getHiddenData(); ?>
        <label for="<?php  echo $data->getIndex()?><?php echo $rand ?>"><?php  echo $data->getLabel()?></label> <select
			class="form-control" id="<?php  echo $data->getIndex()?><?php echo $rand ?>"
			name="<?php  echo $data->getIndex()?>">
            <?php
												$table = $data->getTable();
												$items = _db ()->useCB ()->select ( '*' )->from ( $table )->result ();
												if (isset ( $items [0] ['parent'] )) {
													$items = treefy ( $items );
												}
												
												?>
            <?php foreach($items as $val ): ?>
            <option
				<?php if(is_array($hiddenData)) { foreach($hiddenData as $hidden) { echo $hidden['index']." = '".$val[$hidden['value']]."' ";} } ?>
				value="<?php echo $val[$data->getShow_value()]; ?>"> 
            	<?php if(isset($val['parent'])){ echo str_repeat('&nbsp;&nbsp;', $val['level']); } ?>
            	<?php echo $val[$data->getShow_name()]; ?></option> <?php endforeach; ?>

		</select>
		<?php
		
		if (is_array ( $hiddenData )) {
			foreach ( $hiddenData as $key => $hidden ) {
				if (isset ( $hidden ['label'] )) {
					?>
		<div class="form-group clearfix">
			<label for="<?php echo $hidden['index'].$rand; ?>"><?php echo $hidden['label']; ?></label>
			<input style="background-color: #EEEEEE;" class="form-control"
				id="<?php echo $hidden['index'].$rand; ?>"
				type="<?php echo $hidden['type']; ?>"
				name="<?php echo $hidden['index']; ?>" />
		</div>
			<?php } else { ?>
				<input class="form-control"
			id="<?php echo $hidden['index'].$rand; ?>"
			type="<?php echo $hidden['type']; ?>"
			name="<?php echo $hidden['index']; ?>" />
			<?php } ?>
		<?php } } ?>
    </div>
</div>
<script>
        $('#<?php  echo $data->getIndex()?><?php echo $rand ?>').change(function() {
            var optionSelected = $(this).find("option:selected");
			<?php if(isset($hiddenData)) { foreach ($hiddenData as $item) { ?>
				var <?php echo $item['index']; ?> = optionSelected.attr('<?php echo $item['index']; ?>').trim();
			
				$('#<?php echo $item['index'].$rand; ?>').val(<?php echo $item['index']; ?>);
			<?php }}?>
            
        });
        $('#<?php  echo $data->getIndex()?><?php echo $rand ?>').val('<?php  echo $data->getValue()?>');
		$('#<?php  echo $data->getIndex()?><?php echo $rand ?>').change();
    </script>