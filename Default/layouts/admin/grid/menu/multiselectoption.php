<?php $rand = rand(1, 100000)?>
<div style="margin-bottom: 10px; position: relative;" class="well well-sm item">
	<div style="position: absolute; right: 5px; top: 1px; z-index: 1;">
		<a href="#" onclick="$('#form-<?php echo $data->getId()?>').toggle(); return false;"><span class="glyphicon glyphicon-minus"></span></a>
	</div>
	<div id="form-<?php echo $data->getId()?>">
		<h4><?php echo $data->getLabel()?></h4>
		<div class="item">
			<form role="form" onsubmit="pzk_list.updateSelect(this, '<?php echo $data->getIndex()?>', '<?php echo $data->getType()?>'); return false;">
				<div class="form-group clearfix">
					<label for="<?php echo $data->getIndex()?><?php echo $rand ?>"><?php echo $data->getLabel()?></label> <select
						multiple="multiple" class="form-control"
						id="<?php echo $data->getIndex()?><?php echo $rand ?>" name="<?php echo $data->getIndex()?>[]" size="10">
					<?php
											$options = $data->getOption();
											
											?>
					<?php foreach($options as $key => $option): ?>
					<?php
											$selected = '';
											$trimIds = trim ( $data->getValue(), ',' );
											$arrIds = explode ( ',', $trimIds );
											if (in_array ( $key, $arrIds )) {
												$selected = 'selected="selected"';
											}
											?>
					<option <?php echo $selected; ?> value="<?php echo $key; ?>">
						<?php echo $option; ?>
					</option> <?php endforeach; ?>

					</select>
					
				</div>
				<input style="margin-top: 5px;" class="btn btn-primary" id="updatecate" value="Cập nhật" type="submit"/>
			</form>
		</div>
	</div>
</div>