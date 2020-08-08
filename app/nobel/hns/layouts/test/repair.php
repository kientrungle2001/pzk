<?php
$question = $data->getItem();
$i= $question->getId();
?>
<div class="step">
 	<span><strong>Yêu Cầu: </strong> {? echo $question->getRequest(); ?}</span>
</div>
<div class="step">
	<span><strong> Câu hỏi:</strong> {? echo $question->getName(); ?}</span>
</div>
<div class="step" >
  		<div style="clear:both;"><span><strong>Điền từ sai:</strong></span></div>
  		<div class="col-xs-3 margin-top-10" style="position:relative; margin-top: 20px; " >
			<div class="input-group" >
			    <input type="text" name="repair_false[<?=$i;?>]" class="input_user_test form-control content_value"/>
			</div>
		</div>
</div>
<div class="step" >
  		<div style="clear:both;"><span><strong>Đáp án đúng:</strong></span></div>
  		<div class="col-xs-3 margin-top-10" style="position:relative; margin-top: 20px; " >
			<div class="input-group" >
			    <input type="text" name="repair_true[<?=$i;?>]" class="input_user_test form-control content_value"/>
			</div>
		</div>
</div>