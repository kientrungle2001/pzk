{? 
$rand 		= rand(1, 100);
$xssize 	= pzk_or($data->get('xssize'), 12);
$mdsize 		= pzk_or($data->get('mdsize'), 12);
$compact	= $data->get('compact');
$nocompact	= !$compact;
if($compact) {
	$data->setSelectLabel($data->get('label'));
}
?}
<div class="col-xs-{xssize} col-md-{mdsize}">
	<div class="form-group clearfix">
		{ifvar nocompact}<label for="{? echo $data->get('index')?}{rand}">{? echo $data->get('label')?}</label> {/if}
		<select
			class="form-control" id="{? echo $data->get('index')?}{rand}"
			name="{? echo $data->get('index')?}">
            <?php
												$table = $data->get('table');
												$items = _db ()->useCB ()->select ( '*' )->from ( $table )->result ();
												if (isset ( $items [0] ['parent'] )) {
													$items = treefy ( $items );
												}
												?>
			{ifvar compact}
				<option value="">{? echo $data->get('label')?}</option>
			{/if}
            {each $items as $val }
            <option value="<?php echo $val[$data->get('show_value')]; ?>"> 
            	<?php if(isset($val['parent'])){ echo str_repeat('&nbsp;&nbsp;', $val['level']); } ?>
            	<?php echo $val[$data->get('show_name')]; ?></option> {/each}

		</select> <input id="<?php echo $data->get('hidden').$rand; ?>"
			type="hidden" name="<?php echo $data->get('hidden'); ?>"
			value="{? echo $data->get('value')?}" />
	</div>
</div>
<script>
        $('#{? echo $data->get('index')?}{rand}').change(function() {
            var optionSelected = $(this).find("option:selected");
            var textSelected   = optionSelected.text().trim();
            $('#{data.getHidden()}{rand}').val(textSelected);
        });
        $('#{? echo $data->get('index')?}{rand}').val('{? echo $data->get('value')?}');
		$('#{? echo $data->get('index')?}{rand}').change();
    </script>