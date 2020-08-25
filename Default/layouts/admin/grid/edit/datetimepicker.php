<?php  
$rand 		= rand(1, 100);
$xssize 	= pzk_or($data->getXssize(), 12);
$mdsize 		= pzk_or($data->getMdsize(), 12);
?>
<div class="col-xs-<?php echo $xssize ?> col-md-<?php echo $mdsize ?>">
	<div class="form-group clearfix">
		<label for="<?php  echo $data->getIndex()?><?php echo $rand ?>"><?php  echo $data->getLabel()?></label> <input
			id="<?php  echo $data->getIndex()?><?php echo $rand ?>" name="<?php  echo $data->getIndex()?>"
			value="<?php  if ($data->getType() != 'password') { if(@$data->getValue() != '0000-00-00 00:00:00'){ echo @$data->getValue(); } } ?>"
			type='text' class="form-control" />
		<script type="text/javascript">

        $(function () {

            $("#<?php  echo $data->getIndex()?><?php echo $rand ?>").datetimepicker({
                dateFormat: 'yy-mm-dd',
                timeFormat: 'HH:mm:ss'
            });
        });
    </script>
	</div>
</div>