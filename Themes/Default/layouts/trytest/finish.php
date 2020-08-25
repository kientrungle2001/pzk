<div class="container boder nomg contentheight linebg robotofont">
	<h3 class="pd-top-15 h3tb text-center">
		Bạn đã hoàn thành đề thi thử <?php echo $data->getCamp();?> của chúng tôi! 
	</h3>
	<div class='text-center red'>
		( Kết quả và đáp án được công bố ngày <?php $date = strtotime($data->getDateFinish()); echo date('d/m/Y', $date); ?> lúc 8 giờ)
	</div>
</div>