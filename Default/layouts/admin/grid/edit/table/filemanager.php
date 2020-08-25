<?php
$rand = $data->getRand();
$fieldIndex = $data->getFieldIndex();
$index		= $data->getIndex();
?>
<?php if(!pzk_global()->getFirstLoadFilemanager()): ?>
<input type="hidden" id="filemanagerreturningvalue" onchange="selected_filemanager_input.val(this.value); selected_filemanager_input.change();" placeholder="<?php  echo $data->getLabel()?>"/>
<div id="m<?php  echo $data->getIndex()?><?php echo $rand ?>" class="modal fade" tabindex="-1"
		role="dialog" aria-labelledby="myLargeModalLabel">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal"
					aria-hidden="true">&times;</button>
				<h4 class="modal-title"><?php  echo $data->getLabel()?></h4>
			</div>
			<iframe width="100%" height="400"
				src="/3rdparty/Filemanager/filemanager/dialog.php?type=0&field_id=filemanagerreturningvalue&fldr="
				frameborder="0"
				style="overflow: scroll; overflow-x: hidden; overflow-y: scroll;"></iframe>
		</div>
	</div>
</div>
<?php 
pzk_global()->setFirstLoadFilemanager(true);
endif; ?>
<script type="text/javascript">
selected_filemanager_input	=	null;
</script>
<input onchange="table_change_<?php echo $fieldIndex ?>_<?php echo $rand ?>()" class="form-control" name="<?php echo $fieldIndex ?>_flat[<?php echo $index ?>][]" />
<button type="button" class="btn btn-primary" data-toggle="modal"
				data-target="#m<?php  echo $data->getIndex()?><?php echo $rand ?>" onclick="selected_filemanager_input = $(this).prev();">Select</button>