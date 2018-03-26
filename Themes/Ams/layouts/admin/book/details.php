<?php 
	$dataShowUserBook= $data->get('dataShowUserBook');
	$dataUserAnswers = $data->get('dataUserAnswers');
	//debug($dataUserAnswers);die();
	$arrQuestionIds = array();
	if(count($dataUserAnswers) > 0){
		foreach($dataUserAnswers as $userAnser) {
			$arrQuestionIds[] = $userAnser['questionId'];
		}
		//data questions
		$dataQuestions = _db()->select('id, request, name, name_vn, type, topic_id, type_id')
			->from('questions')
			->where(array('in', 'id', $arrQuestionIds))
			->whereAuto(0)
			->result();
		//xu li data questions
		$questionById = array();
		if(count($dataQuestions) > 0) {
			foreach($dataQuestions as $question){
				$questionById[$question['id']] = $question;
			}
		}
			
		//data user answers 
		
	}
?>
<form role="form" name="update_book" action="{url /Admin_Book/updatePost}" method='post'>
<div class="panel panel-default">
  	<!-- Default panel contents -->
  	<div class="panel-heading col-xs-12">
  		<input type="hidden" name="user_book_id" value="<?=$dataShowUserBook['user_book_id']?>">
  		
  		<div class="col-xs-2">Ngày làm bài : <b><?=$dataShowUserBook['start_time']?></b></div>
  		
  		<div class="col-xs-2"><?php if($dataShowUserBook['status'] != 0 ):?> Điểm các giáo viên chấm :<b><?=$dataShowUserBook['teacher_mark']?> </b><?php endif;?> </div>
  	</div>
	<div class="panel-heading col-xs-12">
	<?php if($dataShowUserBook['marked'] != $dataShowUserBook['quantity_question']){
			echo "<div class='col-xs-3'> Số câu đã chấm :<b> ";
		
			 echo $dataShowUserBook['marked'].' / '.$dataShowUserBook['quantity_question']. ' câu';
			 echo "</b></div>";
		 }
		else{ 
		echo "<div class='col-xs-3'> <b class='red'> ";
			echo 'Đã chấm xong';
			 echo "</b></div>";
		} 
		?> 
	</div>
	
	<div class="panel-heading col-xs-12">
	Họ tên: <?php echo $dataShowUserBook['username']; ?>
	</div>
	
	
	<input type='hidden' name='trytest' value="<?=$dataShowUserBook['trytest'];?>" />
	
	<?php if(count($dataUserAnswers) > 0) { ?>
		<?php foreach($dataUserAnswers as $key =>$value):
			if(!isset($questionById[$value ['questionId']])) continue;
		?>
			<?php
			$BookObj = pzk_obj_once ( 'Education.Book.Type.' . ucfirst(setSuperType ( $value ['question_type'] ) ));
			$BookObj->set('id', $value ['id'] );
			//question
			$BookObj->set('questionId', $value ['questionId'] );
			$BookObj->set('question_type', $value ['question_type'] );
			
			$questions = array();
			$questions = $questionById[$value ['questionId']];	
			//xu li teacher
			$questions['content'] = $value['content'];
			$questions['mark'] = $value['mark'];
			$questions['recommend_mark'] = $value['recommend_mark'];
			$questions['order'] 				= $key + 1;
			$questions['user_answers_id']	=	$value['id'];

			
			$BookObj->set('question', $questions);
			//cau tra loi cua hoc sinh
			$arrAnswer = array();
			$arrAnswer['content'] = $value['content'];
			$arrAnswer['content_edit'] = $value['content_edit'];
			$BookObj->set('studentAnswers', $arrAnswer);
		
			$BookObj->display();
			?>
		<?php endforeach;?>
	<?php } ?>
	<div class="panel-footer">
		<div class="col-xs-12" style="position: fixed; bottom: 50px; padding: 10px; background: #555; width: 100%;">
			<?php if(pzk_session('adminLevel') !== 'Administrator'):?>
			<div class="col-xs-6 text-center"><button type="submit" class="btn btn-primary "><span class="glyphicon glyphicon-save"></span> Cập nhật</button> <button type="submit" class="btn btn-primary " name="btn_update_and_close" value="1"><span class="glyphicon glyphicon-save"></span> Cập nhật và đóng</button></div>
			<?php else:?>
				<div class="col-xs-6 text-center"><button type="submit" name="check" value="1" class="btn btn-success "><span class="glyphicon glyphicon-check"></span> Checked</button> <button type="submit" name="btn_update_and_close" value="1" class="btn btn-success "><span class="glyphicon glyphicon-check"></span> Checked and Close</button></div>
			<?php endif;?>
		</div>
  	</div>
</div>
</form>
<script>
	setInputTinymce();

	function approval(){

	}
	function selectRecommend(that, id) {
		
		text = $(that).val();
		
		var idtext = "recommend_mark_"+id;
		
		tinymce.get(idtext).setContent(text);
		
		
	}
	
	 $(document).ready(function () {
		 
        $('.checkfalse').click(function (event) {
            if (this.checked) {
                $(this).next().css('color', 'red');
            } else {
                $(this).next().css('color', '');
            }
        });

    });


</script>