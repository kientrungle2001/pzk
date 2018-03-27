<?php
$fieldIndex = $data->get('fieldIndex');
$index		= $data->get('index');
$rand = $data->get('rand');
$i = $data->get('colIndex');
$compact	= $data->get('compact');
$nocompact	= !$compact;
if($compact) {
	$data->set('selectLabel', $data->get('label'));
}
?>

<select onchange="table_change_{fieldIndex}_{rand}()"
	class="form-control"
	name="{fieldIndex}_flat[{index}][]" placeholder="{? echo $data->get('label')?}">
	<?php
										$parents = _db ()->select ( '*' )->from ( $data->get ('table') )->where ( pzk_or ( @$data->get ('condition'), '1' ) )->orderBy(pzk_or(@$data->get('orderBy'), 'id asc'))->result ();
										if (isset ( $parents [0] ['parent'] )) {
											$parents = treefy ( $parents );
											if($nocompact) {
												echo "<option value='0'>&nbsp;&nbsp;&nbsp;&nbsp;Danh mục gốc</option>";
											} else {
												echo "<option value='0'>" . pzk_or ( @$data->get ('selectLabel'), '&nbsp;&nbsp;&nbsp;&nbsp;Danh mục gốc' ) . " </option>";
											}
										} else {
											echo "<option value='0'>" . pzk_or ( @$data->get ('selectLabel'), '--Chọn một mục--' ) . " </option>";
										}
										?>
	{each $parents as $parent}
	<option value="<?php echo $parent[$data->get('show_value')]; ?>">
		<?php if(isset($parent['parent'])){ echo str_repeat('--', $parent['level']); } ?>
		#{parent[id]} - <?php echo $parent[$data->get('show_name')]; ?>
	</option> {/each}

</select>