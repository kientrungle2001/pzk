{? 
$rand 		= rand(1, 100);
$xssize 	= pzk_or($data->get('xssize'), 12);
$mdsize 		= pzk_or($data->get('mdsize'), 12);
?}

<div class="col-xs-{xssize} col-md-{mdsize}">
	<div class="form-group clearfix">
		<label for="{? echo $data->get('index')?}{rand}">{? echo html_escape($data->get('label'))?}</label> <input
			type="{data.get('type')}" class="form-control"
			id="{? echo $data->get('index')?}{rand}" name="{? echo $data->get('index')?}"
			placeholder="{? echo html_escape($data->get('label'))?}"
			value="{? if ($data->get('type') != 'password') { 
				if($data->get('type') == 'date') {
					echo date('Y-m-d', strtotime(@$data->get('value')));
				} else {
					echo html_escape(@$data->get('value'));
				}
			} ?}" />
	</div>
</div>