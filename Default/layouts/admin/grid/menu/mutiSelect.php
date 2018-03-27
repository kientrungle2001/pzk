<div style="margin-bottom: 10px; position: relative;" class="well well-sm item">
	<div style="position: absolute; right: 5px; top: 1px; z-index: 1;">
		<a href="#" onclick="$('#form-{data.get('id')}').toggle(); return false;"><span class="glyphicon glyphicon-minus"></span></a>
	</div>
	<div id="form-{data.get('id')}">
		<h4>{data.get('label')}</h4>
		<div class="item">
			<form role="form" onsubmit="pzk_list.updateMutiSelect(this, '{data.get('index')}', '{data.get('type')}'); return false;">
			<div class="form-group">
			<label for="{item[index]}">{data.get('nameField')}</label><br />
			<select class="form-control" id="{data.get('index')}" name="{data.get('index')}[]" multiple="multiple" size="10">
				<option value="" >{data.get('selectLabel')}</option>
				<?php
				$parents = _db()->select('*')->from($data->get('table'))->where(pzk_or(@$data->get('condition'), '1'))->result();
				if(isset($parents[0]['parent'])) {
					$parents = treefy($parents);
				}
				?>
				{each $parents as $parent}
				<option value="<?php echo $parent[$data->get('show_value')]; ?>" >
					<?php if(isset($parent['parent'])){ echo str_repeat('-', $parent['level']); } ?>
					<?php echo $parent[$data->get('show_name')]; ?>
				</option>
				{/each}

			</select>
			</div>
			<input style="margin-top: 5px;" class="btn btn-primary" id="updatecate" value="Cập nhật" type="submit"/>
			</form>
		</div>
	</div>
</div>

