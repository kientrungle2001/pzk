<span class="hidden">{data.get('label')}</span>
<select class="select2-container form-control select2" id="{data.get('index')}-{rand}" name="{data->get('index')}" onchange="pzk_list.filter('{data->get('type')}', '{data.get('index')}', this.value);">
	<?php
$parents = _db ()->select ( '*' )->from ( $data->get('table') )->where(pzk_or($data->get('condition'), '1'))->orderBy(pzk_or($data->get('orderBy'), 'id asc'))->result ();
	if (isset ( $parents [0] ['parent'] )) {
		$parents = treefy ( $parents, 'parent', 0 );
		echo "<option value='' >--Tất cả</option>";
	} else {
		echo "<option value=''>Tất cả</option>";
	}
	?>
	<?php if($data->get('notAccept') == '1'):?>
		<option value='0'>(Trống)</option>
	<?php endif;?>
	{each $parents as $parent}
	<option value="<?php echo $parent[$data->get('show_value')]; ?>"><?php if(isset($parent['parent'])){ echo str_repeat('--', @$parent['level']); } ?>
		#{parent[id]} - <?php echo $parent[$data->get('show_name')]; ?>
	</option> {/each}
</select>
<script type="text/javascript">
	$('#{data.get('index')}{rand}').val('{data.get('value')}');
	$( "#{data.get('index')}{rand}" ).select2( { placeholder: "{data.get('label')}", maximumSelectionSize: 6 } );
</script>