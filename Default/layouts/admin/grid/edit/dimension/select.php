<?php
$rand = $data->getRand();
$i = $data->getColIndex();
$compact	= $data->getCompact();
$nocompact	= !$compact;
if($compact) {
	$data->setSelectLabel($data->getLabel());
}
?>

<select
	class="form-control"
	name="<?php  echo $data->getIndex()?>_flat[col<?php echo $i ?>][]"  placeholder="<?php  echo $data->getLabel()?>">
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
	<?php foreach($parents as $parent): ?>
	<option value="<?php echo $parent[$data->getShow_value()]; ?>">
		<?php if(isset($parent['parent'])){ echo str_repeat('--', $parent['level']); } ?>
		#<?php echo @$parent['id']?> - <?php echo $parent[$data->getShow_name()]; ?>
	</option> <?php endforeach; ?>

</select>