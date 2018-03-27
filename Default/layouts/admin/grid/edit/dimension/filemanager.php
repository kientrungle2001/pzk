<?php
$rand = $data->get('rand');
$i = $data->get('colIndex');
?>
<input onchange="dimension_change_{? echo $data->get('index')?}_{rand}()" class="form-control" name="{? echo $data->get('index')?}_flat[col{i}][]" id="{? echo $data->get('index')?}{rand}" placeholder="{? echo $data->get('label')?}" />
<button type="button" class="btn btn-primary" data-toggle="modal"
				data-target="#m{? echo $data->get('index')?}{rand}">Select</button>
<div id="m{? echo $data->get('index')?}{rand}" class="modal fade" tabindex="-1"
		role="dialog" aria-labelledby="myLargeModalLabel">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal"
					aria-hidden="true">&times;</button>
				<h4 class="modal-title">{? echo $data->get('label')?}</h4>
			</div>
			<iframe width="100%" height="400"
				src="/3rdparty/Filemanager/filemanager/dialog.php?type=0&field_id={? echo $data->get('index')?}{rand}&fldr="
				frameborder="0"
				style="overflow: scroll; overflow-x: hidden; overflow-y: scroll;"></iframe>
		</div>
	</div>
</div>