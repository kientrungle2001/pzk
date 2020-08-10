<?php  
$rand 		= rand(1, 100);
$xssize 	= pzk_or($data->get('xssize'), 12);
$mdsize 		= pzk_or($data->get('mdsize'), 12);
?>
<div class="col-xs-<?php echo $xssize ?> col-md-<?php echo $mdsize ?>">
	<div class="form-group clearfix">
		<label for="<?php  echo $data->get('index')?><?php echo $rand ?>"><?php  echo $data->get('label')?></label> <select
			class="form-control" id="<?php  echo $data->get('index')?><?php echo $rand ?>"
			name="<?php  echo $data->get('index')?>">
			<option value="0">Chưa kích hoạt</option>
			<option value="1">Đã kích hoạt</option>
		</select>
	</div>
</div>
<script>
	$('#<?php  echo $data->get('index')?><?php echo $rand ?>').val('<?php  echo $data->get('value')?>');
  </script>