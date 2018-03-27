{? 
$rand 		= rand(1, 100);
$xssize 	= pzk_or($data->get('xssize'), 12);
$mdsize 		= pzk_or($data->get('mdsize'), 12);
?}
<div class="col-xs-{xssize} col-md-{mdsize}">
	<div class="form-group clearfix">
		<label for="{? echo $data->get('index')?}{rand}">{? echo $data->get('label')?}</label> <select
			multiple="multiple" class="select2-container form-control select2"
			id="{? echo $data->get('index')?}{rand}" name="{? echo $data->get('index')?}[]" size="10">
        <?php
								$options = $data->get('option');
								
								?>
        {each $options as $key => $option}
        <?php
								$selected = '';
								$trimIds = trim ( $data->get('value'), ',' );
								$arrIds = explode ( ',', $trimIds );
								if (in_array ( $key, $arrIds )) {
									$selected = 'selected="selected"';
								}
								?>
        <option <?php echo $selected; ?> value="<?php echo $key; ?>">
            <?php echo $option; ?>
        </option> {/each}

		</select>
		<script type="text/javascript">
		$('#{? echo $data->get('index')?}{rand}').select2( { placeholder: "{? echo $data->get('label')?}", allowClear: true } );
		</script>
	</div>
</div>