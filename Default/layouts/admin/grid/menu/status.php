<div style="margin-bottom: 10px; position: relative;" class="well well-sm item">
	<div style="position: absolute; right: 5px; top: 1px; z-index: 1;">
		<a href="#" onclick="$('#form-<?php echo $data->get('id')?>').toggle(); return false;"><span class="glyphicon glyphicon-minus"></span></a>
	</div>
	<div id="form-<?php echo $data->get('id')?>">
		<h4><?php echo $data->get('label')?></h4>
		<div class="item">
			<form role="form" onsubmit="pzk_list.updateSelect(this, '<?php echo $data->get('index')?>', '<?php echo $data->get('type')?>'); return false;">
				<div class="form-group">
				<label for="<?php echo @$item['index']?>"><?php echo $data->get('nameField')?></label><br />
				<select class="form-control" id="<?php echo $data->get('index')?>" name="<?php echo $data->get('index')?>">
					<option value="" ><?php echo $data->get('selectLabel')?></option>
					<option value="1"><?php echo $data->get('enabledLabel')?></option>
					<option value="0"><?php echo $data->get('disabledLabel')?></option>
				</select>
				</div>
				<input style="margin-top: 5px;" class="btn btn-primary" id="updatecate" value="Cập nhật" type="submit"/>
				
			</form>
		</div>
	</div>
</div>
