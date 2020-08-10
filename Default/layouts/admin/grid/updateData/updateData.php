<div style="margin-bottom: 10px; position: relative;" class="well well-sm item">
    <div style="position: absolute; right: 5px; top: 1px; z-index: 1;">
			<a href="#" onclick="$('#form-<?php echo $data->get('id')?>').toggle(); return false;"><span class="glyphicon glyphicon-minus"></span></a>
	  </div>
	<div id="form-<?php echo $data->get('id')?>">
		<h4><?php echo $data->get('label')?></h4>
		<div class="item">
			<form role="form" onsubmit="pzk_list.updateDataTo(this); return false;">
				<input type="hidden" name="index" value="<?php echo $data->get('index')?>">
				<?php $addFieldSettings = $data->getData(); ?>
				<?php foreach($addFieldSettings as $field): ?>
				<?php 
				if ($field['type'] == 'text' || $field['type'] == 'date' || $field['type'] == 'email' || $field['type'] == 'password') {
				$fieldObj = pzk_obj('Core.Db.Grid.Edit.Input');
				} else {
				$fieldObj = pzk_obj('Core.Db.Grid.Edit.' . ucfirst($field['type']));
				}

				foreach($field as $key => $val) {
				$fieldObj->set($key, $val);
				}
				$fieldObj->setValue(@$row[$field['index']]);
				$fieldObj->display();
				?>
				<?php endforeach; ?>
				<input style="margin-top: 5px;" class="btn btn-primary" value="Cập nhật" type="submit"/>

			</form>
		</div>
	</div>
</div>
