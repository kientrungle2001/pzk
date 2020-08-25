<?php $rand = rand(1, 100000)?>
<div style="margin-bottom: 10px; position: relative;" class="well well-sm item">
	<div style="position: absolute; right: 5px; top: 1px; z-index: 1;">
		<a href="#" onclick="$('#form-<?php echo $data->getId()?>').toggle(); return false;"><span class="glyphicon glyphicon-minus"></span></a>
	</div>
	<div id="form-<?php echo $data->getId()?>">
		<h4><?php echo $data->getLabel()?></h4>
		<div class="item">
			<form role="form" onsubmit="pzk_list.updateSelect(this, '<?php echo $data->getIndex()?>', '<?php echo $data->getType()?>'); return false;">
				<div class="form-group">
				<label for="<?php echo @$item['index']?>"><?php echo $data->getNameField()?></label><br />
				<select class="form-control" id="<?php echo $data->getIndex()?>" name="<?php echo $data->getIndex()?>">
					<option value="" ><?php echo $data->getSelectLabel()?></option>
					<option value="1"><?php echo $data->getEnabledLabel()?></option>
					<option value="0"><?php echo $data->getDisabledLabel()?></option>
				</select>
				</div>
				<input style="margin-top: 5px;" class="btn btn-primary" id="updatecate" value="Cập nhật" type="submit"/>
				
			</form>
		</div>
	</div>
</div>
