<?php
$rand = $data->get('rand');
$fieldIndex = $data->get('fieldIndex');
$index		= $data->get('index');
?>
<?php if(!pzk_global()->get('firstLoadFilemanager')): ?>
<input type="hidden" id="filemanagerreturningvalue" onchange="selected_filemanager_input.val(this.value); selected_filemanager_input.change();" placeholder="{? echo $data->get('label')?}"/>
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
				src="/3rdparty/Filemanager/filemanager/dialog.php?type=0&field_id=filemanagerreturningvalue&fldr="
				frameborder="0"
				style="overflow: scroll; overflow-x: hidden; overflow-y: scroll;"></iframe>
		</div>
	</div>
</div>
<?php 
pzk_global()->set('firstLoadFilemanager', true);
endif; ?>
<script type="text/javascript">
selected_filemanager_input	=	null;
</script>
<input onchange="table_change_{fieldIndex}_{rand}()" class="form-control" name="{fieldIndex}_flat[{index}][]" />
<button type="button" class="btn btn-primary" data-toggle="modal"
				data-target="#m{? echo $data->get('index')?}{rand}" onclick="selected_filemanager_input = $(this).prev();">Select</button>