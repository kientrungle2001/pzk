<?php  
$rand 		= rand(1, 100);
$xssize 	= pzk_or($data->get('xssize'), 12);
$mdsize 		= pzk_or($data->get('mdsize'), 12);
?>
<div class="col-xs-<?php echo $xssize ?> col-md-<?php echo $mdsize ?>">
	<div class="form-group clearfix">
		<label for="<?php  echo $data->get('index')?><?php echo $rand ?>"><?php  echo $data->get('label')?></label>

		<div class="input-append">
			<input onchange="closeModal(this,'#m<?php  echo $data->get('index')?><?php echo $rand ?>')"
				class="form-control" id="<?php  echo $data->get('index')?><?php echo $rand ?>"
				name="<?php  echo $data->get('index')?>" placeholder="<?php  echo $data->get('label')?>" type="text"
				value="<?php  if ($data->get('type') != 'password') { echo @$data->get('value'); } ?>">
			<button onclick="loadFrame<?php  echo $data->get('index')?>();" type="button" class="btn btn-primary" data-toggle="modal"
				data-target="#m<?php  echo $data->get('index')?><?php echo $rand ?>">Select</button>
		</div>
	</div>


	<div id="m<?php  echo $data->get('index')?><?php echo $rand ?>" class="modal fade" tabindex="-1"
		role="dialog" aria-labelledby="myLargeModalLabel">
		<div class="modal-dialog modal-lg">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal"
						aria-hidden="true">&times;</button>
					<h4 class="modal-title"><?php  echo $data->get('label')?></h4>
				</div>
				<div id="load<?php  echo $data->get('index')?>">
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
	var load<?php  echo $data->get('index')?> = false;
	function loadFrame<?php  echo $data->get('index')?>(){
		
		if(!load<?php  echo $data->get('index')?>){
			var html = '<iframe width="100%" height="400"\
					src="/3rdparty/Filemanager/filemanager/dialog.php?type=0&field_id=<?php  echo $data->get('index')?><?php echo $rand ?>&fldr="\
					frameborder="0"\
					style="overflow: scroll; overflow-x: hidden; overflow-y: scroll;"></iframe>';
			$('#load<?php  echo $data->get('index')?>').html(html);
			load<?php  echo $data->get('index')?> = true;
		}
	}


</script>
</div>