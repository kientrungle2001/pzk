{? 
$rand 		= rand(1, 100);
$xssize 	= pzk_or($data->get('xssize'), 12);
$mdsize 		= pzk_or($data->get('mdsize'), 12);
?}
<div class="col-xs-{xssize} col-md-{mdsize}">
	<div class="form-group clearfix">
		<label for="{? echo $data->get('index')?}{rand}">{? echo $data->get('label')?}</label> <input
			id="{? echo $data->get('index')?}{rand}" name="{? echo $data->get('index')?}"
			value="{? if ($data->get('type') != 'password') { if(@$data->get('value') != '0000-00-00 00:00:00'){ echo @$data->get('value'); } } ?}"
			type='text' class="form-control" />
		<script type="text/javascript">

        $(function () {

            $("#{? echo $data->get('index')?}{rand}").datetimepicker({
                dateFormat: 'yy-mm-dd',
                timeFormat: 'HH:mm:ss'
            });
        });
    </script>
	</div>
</div>