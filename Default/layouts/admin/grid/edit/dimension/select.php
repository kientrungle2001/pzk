<?php
$rand = $data->getRand();
$i = $data->getColIndex();
$compact	= $data->getCompact();
$nocompact	= !$compact;
if($compact) {
	$data->setSelectLabel($data->get('label'));
}
?>

<select
	class="form-control"
	name="{? echo $data->get('index')?}_flat[col{i}][]"  placeholder="{? echo $data->get('label')?}">
	<?php
										$parents = _db ()->select ( '*' )->from ( $data->getTable () )->where ( pzk_or ( @$data->getCondition (), '1' ) )->orderBy(pzk_or(@$data->getOrderBy(), 'id asc'))->result ();
										if (isset ( $parents [0] ['parent'] )) {
											$parents = treefy ( $parents );
											if($nocompact) {
												echo "<option value='0'>&nbsp;&nbsp;&nbsp;&nbsp;Danh mục gốc</option>";
											} else {
												echo "<option value='0'>" . pzk_or ( @$data->getSelectLabel (), '&nbsp;&nbsp;&nbsp;&nbsp;Danh mục gốc' ) . " </option>";
											}
										} else {
											echo "<option value='0'>" . pzk_or ( @$data->getSelectLabel (), '--Chọn một mục--' ) . " </option>";
										}
										?>
	{each $parents as $parent}
	<option value="<?php echo $parent[$data->get('show_value')]; ?>">
		<?php if(isset($parent['parent'])){ echo str_repeat('--', $parent['level']); } ?>
		#{parent[id]} - <?php echo $parent[$data->get('show_name')]; ?>
	</option> {/each}

</select>