<div class="container boder nomg contentheight linebg robotofont">
	<h3 class="pd-top-15 h3tb text-center" ><?php echo $data->get('title'); ?> <span class='red'><?php $date = strtotime($data->get('dateCamp')); echo date('d/m/Y', $date); ?> lúc <?php echo date('H:i:s', $date); ?> giờ</span> </h3>
</div>