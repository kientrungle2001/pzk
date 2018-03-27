{? 
$rand 		= rand(1, 100);
$xssize 	= pzk_or($data->get('xssize'), 12);
$mdsize 		= pzk_or($data->get('mdsize'), 12);
?}
<div class="col-xs-{xssize} col-md-{mdsize}">
	<div class="form-group clearfix">
		<label for="{? echo $data->get('index')?}{rand}">{? echo $data->get('label')?}</label>
		<div style="float: left; width: 100%;" class="item">
			<textarea id="{? echo $data->get('index')?}{rand}" class="tinymce"
				name="{? echo $data->get('index')?}">{? echo $data->get('value')?}</textarea>
		</div>
	</div>
</div>
