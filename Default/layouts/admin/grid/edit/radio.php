{? 
$rand 		= rand(1, 100);
$xssize 	= pzk_or($data->get('xssize'), 12);
$mdsize 		= pzk_or($data->get('mdsize'), 12);
?}
<div class="col-xs-{xssize} col-md-{mdsize}">
	<div class="form-group clearfix">
		<label for="{? echo $data->get('index')?}{rand}">{? echo $data->get('label')?}</label>
    <?php $options = $data->get('options'); $val = $data->get('value');?>
    {each $options as $key =>$item}
        <input type="{data.get('type')}"
			<?Php if($key == $val){ echo 'checked'; } ?>
			id="{? echo $data->get('index')?}{rand}" name="{? echo $data->get('index')?}"
			placeholder="{? echo $data->get('label')?}" value="{key}" />{item} {/each}
	</div>
</div>