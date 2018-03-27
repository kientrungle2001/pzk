<?php
$rand = rand(0, 100000);
?>
	<span class="hidden">{data.get('label')}</span>
	<select class="select2-container form-control select2" id="{data.get('index')}-{rand}" name="{data.get('index')}" onchange="pzk_list.filter('{data.get('type')}', '{data.get('index')}', this.value);" >
		<option value="">Tất cả</option>
		{each $data->get('option') as $key=>$val}
		<option value="{key}">{val}</option>
		{/each}
	</select>
	<script type="text/javascript">
		$('#{data.get('index')}-{rand}').val('{data.get('value')}');
	$( "#{data.get('index')}-{rand}" ).select2( { placeholder: "{data.get('label')}", maximumSelectionSize: 6 } );
    </script>