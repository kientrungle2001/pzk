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
		<?php if(${'nocompact'}): ?><label for="<?php  echo $data->get('index')?><?php echo $rand ?>"><?php  echo $data->get('label')?></label> <?php endif; ?>
		<select
			class="form-control" id="<?php  echo $data->get('index')?><?php echo $rand ?>"
			name="<?php  echo $data->get('index')?>">
            <?php
												$table = $data->get('table');
												$items = _db ()->useCB ()->select ( '*' )->from ( $table )->result ();
												if (isset ( $items [0] ['parent'] )) {
													$items = treefy ( $items );
												}
												?>
			<?php if(${'compact'}): ?>
				<option value=""><?php  echo $data->get('label')?></option>
			<?php endif; ?>
            <?php foreach($items as $val ): ?>
            <option value="<?php echo $val[$data->get('show_value')]; ?>"> 
            	<?php if(isset($val['parent'])){ echo str_repeat('&nbsp;&nbsp;', $val['level']); } ?>
            	<?php echo $val[$data->get('show_name')]; ?></option> <?php endforeach; ?>

		</select> <input id="<?php echo $data->get('hidden').$rand; ?>"
			type="hidden" name="<?php echo $data->get('hidden'); ?>"
			value="<?php  echo $data->get('value')?>" />
	</div>
</div>
<script>
        $('#<?php  echo $data->get('index')?><?php echo $rand ?>').change(function() {
            var optionSelected = $(this).find("option:selected");
            var textSelected   = optionSelected.text().trim();
            $('#{data.getHidden()}<?php echo $rand ?>').val(textSelected);
        });
        $('#<?php  echo $data->get('index')?><?php echo $rand ?>').val('<?php  echo $data->get('value')?>');
		$('#<?php  echo $data->get('index')?><?php echo $rand ?>').change();
    </script>