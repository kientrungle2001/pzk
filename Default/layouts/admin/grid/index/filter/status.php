<?php $rand = rand(0, 100000);
$controller = pzk_controller();
?>
<span class="hidden"><?php echo @$data->label?></span>
<select id="<?php echo @$data->index?>-<?php echo $rand ?>"
	name="<?php echo @$data->index?>"
	onchange="pzk_list.filter('<?php echo @$data->type?>', '<?php echo @$data->index?>', this.value);">
	<option value="">All</option>
	<option value="1">Yes</option>
	<option value="0">No</option>

</select>
<script type="text/javascript">
	<?php $status = $controller->getFilterSession()->get($data->index); ?>
	$('#<?php echo @$data->index?>-<?php echo $rand ?>').val('<?php echo $status ?>');
</script>