<?php  
$rand 		= rand(1, 100);
$xssize 	= pzk_or($data->getXssize(), 12);
$mdsize 	= pzk_or($data->getMdsize(), 12);
$inline		= pzk_or($data->getInline(), true);
?>
<?php if($inline):?>
	<div class="col-xs-<?php echo $xssize ?> col-md-<?php echo $mdsize ?>">
	<div class="row">
		<label class="control-label col-md-3" for="<?php  echo $data->getIndex()?><?php echo $rand ?>"><?php  echo $data->getLabel()?></label>

		<div class="col-md-9">
		<div class="input-group">
			<input onchange="closeModal(this,'#m<?php  echo $data->getIndex()?><?php echo $rand ?>')"
				class="form-control" id="<?php  echo $data->getIndex()?><?php echo $rand ?>"
				name="<?php  echo $data->getIndex()?>" placeholder="<?php  echo $data->getLabel()?>" type="text"
				value="<?php  if ($data->getType() != 'password') { echo @$data->getValue(); } ?>">
			<span class="input-group-btn">
			<button onclick="loadFrame<?php  echo $data->getIndex()?>();" type="button" class="btn btn-primary" data-toggle="modal"
				data-target="#m<?php  echo $data->getIndex()?><?php echo $rand ?>">Select</button>
			</span>
		</div>
		</div>
	</div>


	<div id="m<?php  echo $data->getIndex()?><?php echo $rand ?>" class="modal fade" tabindex="-1"
		role="dialog" aria-labelledby="myLargeModalLabel">
		<div class="modal-dialog modal-lg">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal"
						aria-hidden="true">&times;</button>
					<h4 class="modal-title"><?php  echo $data->getLabel()?></h4>
				</div>
				<div id="load<?php  echo $data->getIndex()?>">
				</div>
				
			</div>
		</div>
	</div>
	<script>

    function closeModal(that, modalSelector) {
        var url = $(that).val();
        var res = url.replace(BASE_URL, '');
        $(that).val(res);
        $(modalSelector).modal('hide');
    }
	var load<?php  echo $data->getIndex()?> = false;
	function loadFrame<?php  echo $data->getIndex()?>(){
		
		if(!load<?php  echo $data->getIndex()?>){
			var html = '<iframe width="100%" height="400"\
					src="/3rdparty/Filemanager/filemanager/dialog.php?type=0&field_id=<?php  echo $data->getIndex()?><?php echo $rand ?>&fldr="\
					frameborder="0"\
					style="overflow: scroll; overflow-x: hidden; overflow-y: scroll;"></iframe>';
			$('#load<?php  echo $data->getIndex()?>').html(html);
			load<?php  echo $data->getIndex()?> = true;
		}
	}


</script>
</div>
<?php else:?>
<div class="col-xs-<?php echo $xssize ?> col-md-<?php echo $mdsize ?>">
	<div class="form-group clearfix">
		<label for="<?php  echo $data->getIndex()?><?php echo $rand ?>"><?php  echo $data->getLabel()?></label>

		<div class="input-append">
			<input onchange="closeModal(this,'#m<?php  echo $data->getIndex()?><?php echo $rand ?>')"
				class="form-control" id="<?php  echo $data->getIndex()?><?php echo $rand ?>"
				name="<?php  echo $data->getIndex()?>" placeholder="<?php  echo $data->getLabel()?>" type="text"
				value="<?php  if ($data->getType() != 'password') { echo @$data->getValue(); } ?>">
			<button onclick="loadFrame<?php  echo $data->getIndex()?>();" type="button" class="btn btn-primary" data-toggle="modal"
				data-target="#m<?php  echo $data->getIndex()?><?php echo $rand ?>">Select</button>
		</div>
	</div>


	<div id="m<?php  echo $data->getIndex()?><?php echo $rand ?>" class="modal fade" tabindex="-1"
		role="dialog" aria-labelledby="myLargeModalLabel">
		<div class="modal-dialog modal-lg">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal"
						aria-hidden="true">&times;</button>
					<h4 class="modal-title"><?php  echo $data->getLabel()?></h4>
				</div>
				<div id="load<?php  echo $data->getIndex()?>">
				</div>
				
			</div>
		</div>
	</div>
	<script>

    function closeModal(that, modalSelector) {
        var url = $(that).val();
        var res = url.replace(BASE_URL, '');
        $(that).val(res);
        $(modalSelector).modal('hide');
    }
	var load<?php  echo $data->getIndex()?> = false;
	function loadFrame<?php  echo $data->getIndex()?>(){
		
		if(!load<?php  echo $data->getIndex()?>){
			var html = '<iframe width="100%" height="400"\
					src="/3rdparty/Filemanager/filemanager/dialog.php?type=0&field_id=<?php  echo $data->getIndex()?><?php echo $rand ?>&fldr="\
					frameborder="0"\
					style="overflow: scroll; overflow-x: hidden; overflow-y: scroll;"></iframe>';
			$('#load<?php  echo $data->getIndex()?>').html(html);
			load<?php  echo $data->getIndex()?> = true;
		}
	}


</script>
</div>
<?php endif; ?>