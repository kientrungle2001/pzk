<?php 
	$dataShowUserBook= $data->getDataShowUserBook();
	$dataUserAnswers = $data->getDataUserAnswers();
?>
<form role="form" name="update_book" action="<?php echo BASE_REQUEST . '/admin_book/updatePost' ?>">
<div class="panel panel-default">
  	<!-- Default panel contents -->
  	<div class="panel-heading col-xs-12">
  		<input type="hidden" name="user_book_id" value="<?=$dataShowUserBook['user_book_id']?>">
  		<div class="col-xs-2">Bài tập số :<b> <?=$dataShowUserBook['exercise_number']?> </b></div>
  		<div class="col-xs-2">Dạng bài tập : <b><?=$dataShowUserBook['category_name']['name']?></b></div>
  		<div class="col-xs-2">Học sinh : <b><?=$dataShowUserBook['student_name']['username']?></b></div>
  		<div class="col-xs-2">Ngày làm bài : <b><?=$dataShowUserBook['start_time']?></b></div>
  		<div class="col-xs-2"><?php if($dataShowUserBook['teacher_name'] != null ):?> Giáo viên chấm : <b> <?=$dataShowUserBook['teacher_name']['name']?></b><?php endif;?></div>
  		<div class="col-xs-2"><?php if($dataShowUserBook['status'] != 0 ):?> Điểm giáo viên chấm :<b><?=$dataShowUserBook['teacher_mark']?> </b><?php endif;?> </div>
  	</div>
  	<?php foreach($dataUserAnswers as $key =>$value):?>
	  	<?php
		$BookObj = pzk_obj ( 'education.book.type.' . setSuperType ( $value ['question_type'] ) );
		$BookObj->setId ( $value ['id'] );
		$BookObj->setQuestionId ( $value ['questionId'] );
		$BookObj->setQuestion_type ( $value ['question_type'] );
		$BookObj->setContent( $value['content'] );
		$BookObj->setMark( $value['mark'] );
		$BookObj->setRecommend_mark( $value['recommend_mark'] );
		$BookObj->setOrder( $key + 1 );
		$BookObj->display ();
		?>
	<?php endforeach;?>
	
	<div class="panel-footer">
		<div class="col-xs-12 ">
			<?php if(pzk_session()->getAdminLevel() !== 'Administrator'):?>
			<div class="col-xs-6 text-center"><button type="submit" class="btn btn-primary "><span class="glyphicon glyphicon-save"></span> Cập nhật</button></div>
			<?php else:?>
				<div class="col-xs-6 text-center"><button type="submit" name="check" value="1" class="btn btn-success "><span class="glyphicon glyphicon-check"></span> Checked</button></div>
			<?php endif;?>
		</div>
  	</div>
</div>
</form>
<script>
	setInputTinymce();

	function approval(){

	}
</script>