<?php
$rand = $data->getRand();
$i = $data->getColIndex();
?>
<input onchange="dimension_change_<?php  echo $data->getIndex()?>_<?php echo $rand ?>()" class="form-control" name="<?php  echo $data->getIndex()?>_flat[col<?php echo $i ?>][]" id="<?php  echo $data->getIndex()?><?php echo $rand ?>" placeholder="<?php  echo $data->getLabel()?>" />
<button type="button" class="btn btn-primary" data-toggle="modal"
				data-target="#m<?php  echo $data->getIndex()?><?php echo $rand ?>">Select</button>
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
				src="/3rdparty/Filemanager/filemanager/dialog.php?type=0&field_id=<?php  echo $data->getIndex()?><?php echo $rand ?>&fldr="
				frameborder="0"
				style="overflow: scroll; overflow-x: hidden; overflow-y: scroll;"></iframe>
		</div>
	</div>
</div>