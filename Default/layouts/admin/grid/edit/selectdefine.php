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
		{ifvar nocompact}<label for="{? echo $data->get('index')?}{rand}">{? echo $data->get('label')?}</label>{/if}
		<div style="float: left; width: 100%;" class="item">
			<select class="select2-container form-control select2" id="{? echo $data->get('index')?}{rand}"
				name="{? echo $data->get('index')?}">
				{ifvar compact}<option value="">{? echo $data->get('label')?}</option>{/if}
                <?php $options = json_decode($data->get('options'));?>
                {each $options as $key=>$val}
                <option value="{key}">{val}</option> {/each}
			</select>
		</div>
	</div>
</div>
<script type="text/javascript">
	$('#{? echo $data->get('index')?}{rand}').val('{? echo $data->get('value')?}');
	$( "#{? echo $data->get('index')?}{rand}" ).select2( { placeholder: "{? echo $data->get('label')?}", maximumSelectionSize: 6 } );
</script>