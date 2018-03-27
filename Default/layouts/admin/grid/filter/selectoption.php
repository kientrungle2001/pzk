<?php 
$controller = pzk_controller(); 
$compact	= $data->get('compact');
$nocompact	= !$compact;
if($compact) {
	$data->set('selectLabel', $data->get('label'));
}
?>
<div  class="form-group col-xs-12">
	{ifvar nocompact}<label>{? echo $data->get('label')?}</label><br />{/if}
	<select class="select2-container form-control select2"  id="{? echo $data->get('index')?}" name="{? echo $data->get('index')?}" onchange="pzk_list.filter('{? echo $data->get('type')?}', '{? echo $data->get('index')?}', this.value);" >
		{ifvar nocompact}
		<option value="">Tất cả</option>
		{else}
		<option value="">{? echo $data->get('label')?}</option>
		{/if}
		{each $data->get('option') as $key=>$val}
		<option value="{key}">{val}</option>
		{/each}
	</select>
	<script type="text/javascript">
		$('#{? echo $data->get('index')?}{rand}').val('{? echo $data->get('value')?}');
		$( "#{? echo $data->get('index')?}{rand}" ).select2( { placeholder: "{? echo $data->get('label')?}", maximumSelectionSize: 6 } );
	</script>
</div>