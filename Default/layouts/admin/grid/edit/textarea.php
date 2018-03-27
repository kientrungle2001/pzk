{? 
$rand 		= rand(1, 100);
$xssize 	= pzk_or($data->get('xssize'), 12);
$mdsize 		= pzk_or($data->get('mdsize'), 12);
?}
<div class="col-xs-{xssize} col-md-{mdsize}">
	<div class="form-group clearfix">
		<label for="{? echo $data->get('index')?}{rand}">{? echo $data->get('label')?}</label>
		<textarea class="form-control" id="{? echo $data->get('index')?}{rand}"
			name="{? echo $data->get('index')?}" placeholder="{? echo $data->get('label')?}" rows="6">{? echo html_escape($data->get('value'))?}</textarea>
	</div>
</div>