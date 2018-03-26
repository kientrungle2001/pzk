<?php
	$contestId = $data->get('contestId');
	$contest= $data->getContest();
	$finish = $data->get('finish');
	if(($finish == 1) || (time() >= strtotime($contest['expiredDate']))) {
		?>
		<div class="container boder nomg contentheight linebg robotofont">
			<h3 class='text-center pd-top-15 h3tb'> Đã hết thời gian thi trực tuyến <?php echo $contest['name']; ?>! </h3>
		</div>
<?php
	}else{
 ?>
 
	<div class="container boder nomg contentheight linebg robotofont">
		<h3 class="pd-top-15 h3tb text-center" >Thi thử <?php echo $contest['name']; ?></a></h3>
		<div class='content text-center'>
		<br/>
		<br/>
			Đề thi gồm 2 phần: trắc nghiệm và tự luận. Học sinh thi trắc nghiệm(45') trước sau đó mới thi tự luận(45'). <br/><br/>
			Học sinh muốn thi phải mua gói thi và đăng nhập trước khi thi.<br/><br/>
			Mỗi học sinh chỉ được thi một lần trong một đợt thi.<br/><br/>
			Đến ngày thi, học sinh mới có thể vào làm bài thi.<br/><br/>
			<b class='red'>(Thời gian thi <?php echo $contest['name']; ?> 
			ngày: <?php $date = strtotime($contest['startDate']); ?><?=date('d/m/Y', $date);?>)</b><br/><br/>
			*Thời gian mở cửa phòng thi <?php echo $contest['name']; ?> từ <?php $date = strtotime($contest['startDate']); echo date('H:i:s', $date); ?> giờ sáng ngày <?=date('d/m/Y', $date);?>.. Tổng thời gian làm bài thi là 90 phút. Phòng thi đóng cửa lúc <?php $endDate = strtotime($contest['expiredDate']); echo date('H:i:s', $endDate); ?> giờ ngày <?=date('d/m/Y', $endDate);?>.<br/><br/>
			*Học sinh có thể đăng nhập bất kì thời gian nào trong ngày từ <?=date('H:i:s', $date);?> giờ sáng đến <?=date('H:i:s', $endDate);?> giờ ngày <?=date('d/m/Y', $endDate);?> để làm bài thi. <br/>  <br/>Học sinh sẽ làm bài trắc nghiệm trong thời gian tối đa 45 phút và làm bài tự luận cũng trong thời gian tối đa tương tự. 
			<br/>  <br/>Học sinh hoàn thành bài trắc nghiệm rồi mới được làm bài tự luận. 
			<br/><br/><br/>
			<?php
			if((time() >= strtotime($contest['startDate'])) || (pzk_request('showDebug') == 1)) { ?>
			<a class='btn btn-primary' href='<?=BASE_REQUEST;?>/trytest/showtn/<?=$contestId;?>'>Bắt đầu thi</a>
			<?php } ?>
		</div>
	</div>
<?php } ?>
