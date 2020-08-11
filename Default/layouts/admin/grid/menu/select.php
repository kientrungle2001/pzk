<?php $rand = rand(1, 100000)?>
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
					<?php
					$parents = _db()->select('*')->from($data->get('table'))->where(pzk_or(@$data->get('condition'), '1'))->result();
					?>
					<option value="" ><?php echo $data->get('selectLabel')?></option>
					<?php foreach($parents as $parent): ?>
					<option value="<?php echo $parent[$data->get('show_value')]; ?>" >
						<?php if(isset($parent['parent'])){ echo str_repeat('--', @$parent['level']); } ?>
						<?php echo $parent[$data->get('show_name')] ?>
					</option>
					<?php endforeach; ?>

				</select>
				</div>
				<input style="margin-top: 5px;" class="btn btn-primary" id="updatecate" value="Cập nhật" type="submit"/>
				
			</form>
		</div>
	</div>
</div>
