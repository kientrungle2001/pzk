<?php  
$request 	= pzk_request();
$controller = $request->getController();
$rand 		= rand(1, 100);
$xssize 	= pzk_or($data->getXssize(), 12);
$mdsize 	= pzk_or($data->getMdsize(), 12);
$compact	= $data->getCompact();
$nocompact	= !$compact;
if($compact) {
	$data->setSelectLabel($data->getLabel());
}
?>
<div class="col-xs-<?php echo $xssize ?> col-md-<?php echo $mdsize ?>">
	<div class="form-group clearfix">
		<?php if(${'nocompact'}): ?><label for="<?php  echo $data->getIndex()?><?php echo $rand ?>"><?php  echo $data->getLabel()?></label><?php endif; ?><div class="col-xs-12"><select
			class="select2-container form-control select2" id="<?php  echo $data->getIndex()?><?php echo $rand ?>"
			name="<?php  echo $data->getIndex()?>" <?php if(@$data->relative): ?>onchange="loadRelativeData_<?php echo @$data->id?>_<?php echo $rand ?>('<?php echo @$data->relative?>', '<?php echo @$data->referenceField?>', this.value);"<?php endif; ?>>
            <?php
												$parents = _db ()->select ( pzk_or($data->get ('fields'), '*') )->from ( $data->get ('table') )->where ( pzk_or ( @$data->get ('condition'), '1' ) )->orderBy(pzk_or(@$data->getOrderBy(), 'id asc'))->result ();
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
		</div>
		<script type="text/javascript">
			$('#<?php  echo $data->getIndex()?><?php echo $rand ?>').val('<?php  echo $data->getValue()?>');
			$( "#<?php  echo $data->getIndex()?><?php echo $rand ?>" ).select2( { placeholder: "<?php  echo $data->getLabel()?>", maximumSelectionSize: 6 } );
			<?php if(@$data->relative): ?>
				function loadRelativeData_<?php echo @$data->id?>_<?php echo $rand ?>(relative, referenceField, value) {
					var sl = $('#<?php echo @$data->index?><?php echo $rand ?>').parents('form').find('select[name='+relative+']');
					$.ajax({
						url: '/<?php echo $controller ?>/relative',
						data: {
							relative: relative,
							referenceField: referenceField,
							value: value
						},
						success: function(resp) {
							sl.html(resp);
						}
					});
					
				}
			<?php endif; ?>
        </script>
	</div>
</div>