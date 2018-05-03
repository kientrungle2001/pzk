{? 
$rand 		= rand(1, 100);
$xssize 	= pzk_or($data->get('xssize'), 12);
$mdsize 		= pzk_or($data->get('mdsize'), 12);
?}
<div class="col-xs-{xssize} col-md-{mdsize}">
	<div class="form-group clearfix">
		<label for="{? echo $data->get('index')?}{rand}">{? echo $data->get('label')?}</label>

		<div class="input-append">
			<input onchange="closeModal(this,'#m{? echo $data->get('index')?}{rand}')"
				class="form-control" id="{? echo $data->get('index')?}{rand}"
				name="{? echo $data->get('index')?}" placeholder="{? echo $data->get('label')?}" type="text"
				value="{? if ($data->get('type') != 'password') { echo @$data->get('value'); } ?}">
			<button onclick="loadFrame{? echo $data->get('index')?}();" type="button" class="btn btn-primary" data-toggle="modal"
				data-target="#m{? echo $data->get('index')?}{rand}">Select</button>
		</div>
	</div>


	<div id="m{? echo $data->get('index')?}{rand}" class="modal fade" tabindex="-1"
		role="dialog" aria-labelledby="myLargeModalLabel">
		<div class="modal-dialog modal-lg">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal"
						aria-hidden="true">&times;</button>
					<h4 class="modal-title">{? echo $data->get('label')?}</h4>
				</div>
				<div id="load{? echo $data->get('index')?}">
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
	var load{? echo $data->get('index')?} = false;
	function loadFrame{? echo $data->get('index')?}(){
		
		if(!load{? echo $data->get('index')?}){
			var html = '<iframe width="100%" height="400"\
					src="/3rdparty/Filemanager/filemanager/dialog.php?type=0&field_id={? echo $data->get('index')?}{rand}&fldr="\
					frameborder="0"\
					style="overflow: scroll; overflow-x: hidden; overflow-y: scroll;"></iframe>';
			$('#load{? echo $data->get('index')?}').html(html);
			load{? echo $data->get('index')?} = true;
		}
	}


</script>
</div>