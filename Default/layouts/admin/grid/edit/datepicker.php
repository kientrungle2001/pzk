<?php  
$rand 		= rand(1, 100);
$xssize 	= pzk_or($data->get('xssize'), 		12);
$mdsize 		= pzk_or($data->get('mdsize'), 	12);
?>
<div class="col-xs-<?php echo $xssize ?> col-md-<?php echo $mdsize ?>">
	<div class="form-group clearfix">
		<label for="<?php  echo $data->get('index')?><?php echo $rand ?>"><?php  echo $data->get('label')?></label> <input
			id="<?php  echo $data->get('index')?><?php echo $rand ?>" name="<?php  echo $data->get('index')?>"
			value="<?php  if ($data->get('type') != 'password') { echo @$data->get('value'); } ?>"
			type='text' class="form-control" />
		<script type="text/javascript">
        $(function () {
            $("#<?php  echo $data->get('index')?><?php echo $rand ?>").datepicker({
                dateFormat: 'yy-mm-dd'
            });
        });
    </script>
	</div>
</div>