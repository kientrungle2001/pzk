<div style="margin-bottom: 10px; position: relative;" class="well well-sm item">
	<div style="position: absolute; right: 5px; top: 1px; z-index: 1;">
		<a href="#" onclick="$('#form-{data.get('id')}').toggle(); return false;"><span class="glyphicon glyphicon-minus"></span></a>
	</div>
	<div id="form-{data.get('id')}">
		<h4>{data.get('label')}</h4>
		<div class="item">
			<form role="form" onsubmit="pzk_list.updateSelect(this, '{data.get('index')}', '{data.get('type')}'); return false;">
				<div class="form-group clearfix">
					<label for="{data.get('index')}{rand}">{data.get('label')}</label> <select
						multiple="multiple" class="form-control"
						id="{data.get('index')}{rand}" name="{data.get('index')}[]" size="10">
					<?php
											$options = $data->get('option');
											
											?>
					{each $options as $key => $option}
					<?php
											$selected = '';
											$trimIds = trim ( $data->get('value'), ',' );
											$arrIds = explode ( ',', $trimIds );
											if (in_array ( $key, $arrIds )) {
												$selected = 'selected="selected"';
											}
											?>
					<option <?php echo $selected; ?> value="<?php echo $key; ?>">
						<?php echo $option; ?>
					</option> {/each}

					</select>
					
				</div>
				<input style="margin-top: 5px;" class="btn btn-primary" id="updatecate" value="Cập nhật" type="submit"/>
			</form>
		</div>
	</div>
</div>