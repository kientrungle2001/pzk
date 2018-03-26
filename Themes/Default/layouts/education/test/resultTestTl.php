<?php 
	//bai tu luan
	$dataUserAnswers = $data->get('dataUserAnswers');
	if($dataUserAnswers) {
		$scoreTl = $data->get('scoreTl');
?>
<div class='container robotofont'>
	
		<div class='well'>
			<div class='text-center'>
				<b>Điểm bài thi tự luận của bạn: </b> <b style='color:red;font-size: 18px;'><?php echo $scoreTl;?> điểm</b><br>
			</div>
		</div>
		<div class="item bd-div bgclor form_search_test top10 bot20">
		
  
			<?php foreach($dataUserAnswers as $key =>$value):?>
				<?php
				$BookObj = pzk_obj_once ( 'Education.Userbook.Type.Trytesttl' );
				$BookObj->set ('id', $value ['id'] );
				$BookObj->set ('questionId', $value ['questionId'] );
				$BookObj->set ('question_type', $value ['question_type'] );
				$BookObj->set('userAnswer', $value);
				$BookObj->set('content', $value['content'] );
				$BookObj->set('mark', $value['mark'] );
				$BookObj->set('recommend_mark', $value['recommend_mark'] );
				$BookObj->set('order', $key + 1 );
				$BookObj->display ();
				?>
			<?php endforeach;?>
		</div>
	
</div>
<script>
	
$(document).ready(function() {
	setInputTinymceClient();
})
	

	
</script>
<?php } else { ?>
	<div class="container alert alert-warning text-center">
		Bài đang chờ chấm.
	</div>	
<?php } ?>
