{? 
$rand 		= rand(1, 100);
$xssize 	= pzk_or($data->get('xssize'), 12);
$mdsize 		= pzk_or($data->get('mdsize'), 12);
?}
<div class="col-xs-{xssize} col-md-{mdsize}">
	<div class="form-group clearfix">
		<label for="{? echo $data->get('index')?}{rand}">{? echo $data->get('label')?}</label> <select
			class="form-control" id="{? echo $data->get('index')?}{rand}"
			name="{? echo $data->get('index')?}">
			<option value="0">Chưa kích hoạt</option>
			<option value="1">Đã kích hoạt</option>
		</select>
	</div>
</div>
<script>
	$('#{? echo $data->get('index')?}{rand}').val('{? echo $data->get('value')?}');
  </script>