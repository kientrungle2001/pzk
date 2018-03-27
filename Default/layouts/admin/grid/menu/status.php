<div style="margin-bottom: 10px; position: relative;" class="well well-sm item">
	<div style="position: absolute; right: 5px; top: 1px; z-index: 1;">
		<a href="#" onclick="$('#form-{data.get('id')}').toggle(); return false;"><span class="glyphicon glyphicon-minus"></span></a>
	</div>
	<div id="form-{data.get('id')}">
		<h4>{data.get('label')}</h4>
		<div class="item">
			<form role="form" onsubmit="pzk_list.updateSelect(this, '{data.get('index')}', '{data.get('type')}'); return false;">
				<div class="form-group">
				<label for="{item[index]}">{data.get('nameField')}</label><br />
				<select class="form-control" id="{data.get('index')}" name="{data.get('index')}">
					<option value="" >{data.get('selectLabel')}</option>
					<option value="1">{data.get('enabledLabel')}</option>
					<option value="0">{data.get('disabledLabel')}</option>
				</select>
				</div>
				<input style="margin-top: 5px;" class="btn btn-primary" id="updatecate" value="Cập nhật" type="submit"/>
				
			</form>
		</div>
	</div>
</div>
