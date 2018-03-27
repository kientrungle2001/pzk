<?php
$lessonId = $data->getLessonId();
$lessonTime = $data->getLessonTime();
$showQuestions = $data->getQuestion($lessonId);
$rootCateId = $data->getRootCateId();
$lessonType = $data->getLessonType();


if(count($showQuestions) > 0) {

?>
	<form id="form_question_nn" class="form-horizontal" method="post">
		
		<fieldset id="idFieldset">
			<div class="col-xs-12 margin-top-20">
				<?php
                
                $totalQues	= count($showQuestions);
                ?>
				
		    	<?php foreach($showQuestions as $key =>$value):?>
		    	<div class="step_ answer_box mgb10">
		    		<div class="order">Câu hỏi <?=$key+1;?>:</div>
					<input type="hidden" name="questions[<?=$value['id']?>]" value="<?=$value['id']?>" /> 
					<input type="hidden" name="questionType[<?=$value['id']?>]" value="<?=$value['type']?>" />
		    		<?php
						$QuestionObj = pzk_obj ('education.question.type.' . setSuperType ($value ['type']));
						$QuestionObj->setQuestionId ($value['id']);
						$QuestionObj->display ();
					?>
				</div>
		    	<?php endforeach;?>
		    </div>
			
			
		   
		    <input type="hidden" name="lessonId" value="<?=$lessonId;?>" />
			<input type="hidden" name="category_root" value="<?=$rootCateId;?>" />
			<input type="hidden" name="lessonType" value="<?=$lessonType;?>" />
			
			<input type="hidden" name="question_time" value="<?=$lessonTime?>" />
			<input type="hidden" name="totaltrue" />
			
			
		</fieldset>
		
		
    	<input type="hidden" id="start_time" name="start_time" value="<?=$_SERVER['REQUEST_TIME'];?>" />
    	<input type="hidden" id="during_time" name="during_time" value="" />
		
        
		<div class="col-xs-12 practice-result">
			<button id="finish-choice" class="btn col-xs-12 mgl5 mgr10 col-md-2 btn-primary" name="finish-choice" onclick="finish_choice();" type="button">
			<span class="glyphicon glyphicon-ok"></span>
				Hoàn thành 
			</button>
			<button id="view-results" class="btn col-xs-12 col-md-2 mgr10 btn-success" data-toggle="modal" data-target="#exampleModal" name="view-result" type="button" style="display:none;">	
				<span class='glyphicon glyphicon-eye-open'> </span>
				Xem kết quả 
			</button>
			<button id="show-answers" class="btn col-xs-12 col-md-2 mgr10 btn-danger" name="show-answers" onclick="show_answers();" type="button">
				<span class='glyphicon glyphicon-eye-open'> </span>
				Xem đáp án 
			</button>
			<button id="save-choice" class="btn col-xs-12 col-md-2 mgr10 btn-success" name="save-choice" onclick="save_choice();" type="button"><span class="glyphicon glyphicon-save" aria-hidden="true"></span>
				Lưu vào vở bài tập
			</button>
		</div>
	</form>
</div>
<!-- Modal popover view-result -->
<div class="modal fade" role="dialog" id="exampleModal" aria-labelledby="gridSystemModalLabel" aria-hidden="true">
  	<div class="modal-dialog">
	    <div class="modal-content">
	    	<div class="modal-header">
          		<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          		<h3 class="modal-title text-center title-blue" id="gridSystemModalLabel"><b>Kết quả bài làm</b></h3>
        	</div>
        	
	    	<div class="modal-body">
	    		<div class="row">
	    			<div class="col-xs-12 title-blue">
		    		 	<div class="col-xs-8 question_true control-label">Số điểm đạt được </div> <div class="col-xs-4 num_true title-blue"></div>
		    		</div>
		    		<!--  <div class="col-xs-12 title-red">
		    		 	<div class="col-xs-8 question_false control-label">Số câu trả lời sai </div> <div class="col-xs-4 num_false title-red"></div>
		    		</div>
		    		-->
		    		<div class="col-xs-12" style="color: #F0AD4E">
		    		 	<div class="col-xs-8 question_total control-label">Tổng số câu </div> <div class="col-xs-4 num_total"></div>
		    		</div>
	    		</div>
	    	</div>
			<!--
	    	<div class="modal-footer">
		        <button type="button" class="btn btn-sm btn-danger pull-left" onclick="history.back()"> Chọn luyện tập các môn khác <span class="glyphicon glyphicon-arrow-left"></span></button>
		        <button type="button" class="btn btn-sm btn-success pull-right" onclick="location.reload()"><span class="glyphicon glyphicon-arrow-right"></span> Làm tiếp câu mới trong </button>
	      	</div>
			-->
	    </div>
 	</div>
<!-- End Modal popover view-result -->

<?php } else { ?>
	Chưa có dữ liệu
<?php } ?>