<?php
$fieldIndex = $data->getFieldIndex();
$index		= $data->getIndex();
$rand = $data->getRand();
$i = $data->getColIndex();
$compact	= $data->getCompact();
$nocompact	= !$compact;
if($compact) {
	$data->setSelectLabel($data->getLabel());
}
?>

<select onchange="table_change_<?php echo $fieldIndex ?>_<?php echo $rand ?>()"
	class="form-control"
	name="<?php echo $fieldIndex ?>_flat[<?php echo $index ?>][]" placeholder="<?php  echo $data->getLabel()?>">
	<?php
										$parents = _db ()->select ( '*' )->from ( $data->get ('table') )->where ( pzk_or ( @$data->get ('condition'), '1' ) )->orderBy(pzk_or(@$data->getOrderBy(), 'id asc'))->result ();
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
	<?php foreach($parents as $parent): ?>
	<option value="<?php echo $parent[$data->getShow_value()]; ?>">
		<?php if(isset($parent['parent'])){ echo str_repeat('--', $parent['level']); } ?>
		#<?php echo @$parent['id']?> - <?php echo $parent[$data->getShow_name()]; ?>
	</option> <?php endforeach; ?>

</select>