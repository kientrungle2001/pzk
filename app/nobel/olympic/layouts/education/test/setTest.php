<?php 
	$lessonTime = 15;
	$testId = $data->getTestId();
	$tracnghiem = $data->getQuestionsByType('Q0');
	$dientu = $data->getQuestionsByType('DT');
	$pairs = $data->getClickWord();
	$dragWord = $data->getWordByType('dragWord');
?>
<form id="form_question" class="form-horizontal" method="post">
	<fieldset id="idFieldset">
	<input type="hidden" id="start_time" name="start_time" value="<?=$_SERVER['REQUEST_TIME'];?>" />
	<input type="hidden" id="during_time" name="during_time" value="" />
	
	<input type="hidden" id='question_time' name="question_time" value="" />
	<input type="hidden" name="testId" id= 'testId' />

	<div>

	   <!-- Nav tabs -->
	  <ul class="nav nav-tabs" role="tablist">
		<li role="presentation" class="active"><a href="#tracnghiem" aria-controls="home" role="tab" data-toggle="tab">Trang 1</a></li>
		<li role="presentation"><a href="#dientu" aria-controls="profile" role="tab" data-toggle="tab">Trang 2</a></li>
		<li role="presentation"><a href="#clickword" aria-controls="messages" role="tab" data-toggle="tab">Trang 3</a></li>
		<li role="presentation"><a href="#dragword" aria-controls="settings" role="tab" data-toggle="tab">Trang 4</a></li>
	  </ul>

	  <!-- Tab panes -->
	  <div class="tab-content">
		<div role="tabpanel" class="tab-pane active" id="tracnghiem">
			<div class='col-xs-12 mgt15'>
				<?php foreach($tracnghiem as $key =>$value):?>
		    	<div class="step_ answer_box mgb10">
		    		<div class="order">Câu hỏi <?=$key+1;?>:</div>
					<input type="hidden" name="questions[<?=$value['id']?>]" value="<?=$value['id']?>" /> 
					<input type="hidden" name="questionType[<?=$value['id']?>]" value="<?=$value['type']?>" />
		    		<?php
						$QuestionObj = pzk_obj ('education.question.type.Choice');
						$QuestionObj->setQuestionId ($value['id']);
						$QuestionObj->display ();
					?>
				</div>
		    	<?php endforeach;?>
			</div>
		</div>
		<div role="tabpanel" class="tab-pane" id="dientu">
			<div class='col-xs-12 mgt15'>
				<?php foreach($dientu as $key =>$value):?>
					<div class="step_ answer_box mgb10">
						<div class="order">Câu hỏi <?=$key+1;?>:</div>
						<input type="hidden" name="questions[<?=$value['id']?>]" value="<?=$value['id']?>" /> 
						<input type="hidden" name="questionType[<?=$value['id']?>]" value="<?=$value['type']?>" />
						<?php
							$QuestionObj = pzk_obj ('education.question.type.Fill_word');
							$QuestionObj->setQuestionId ($value['id']);
							$QuestionObj->display ();
						?>
					</div>
		    	<?php endforeach;?>
			</div>
		</div>
		<div role="tabpanel" class="tab-pane" id="clickword">
			<?php 
				$clickWord = pzk_controller()->parse('education/test/clickWord');
				$clickWord->setTestId($testId);
				$clickWord->display();
			?>
		</div>
		<div role="tabpanel" class="tab-pane" id="dragword">
			<?php 
				$clickWord = pzk_controller()->parse('education/test/dragWord');
				$clickWord->setTestId($testId);
				$clickWord->display();
			?>
		</div>
	  </div>
	  
	  
		<div class="col-xs-12 practice-result">
			<button id="finish-choice" class="btn col-xs-12 mgl5 mgr10 col-md-2 btn-primary" name="finish-choice" onclick="finish();" type="button">
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
			<!--<button id="save-choice" class="btn col-xs-12 col-md-2 mgr10 btn-success" name="save-choice" onclick="save_choice();" type="button"><span class="glyphicon glyphicon-save" aria-hidden="true"></span>
				Xem xếp hạng
			</button-->
		</div>
	 

	</div>
	<fieldset id="idFieldset">
</form>

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
		    		 	<div class="col-xs-8 question_true control-label">Điểm của bạn: </div> <div class="col-xs-4 testScore num_true title-blue"></div>
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
