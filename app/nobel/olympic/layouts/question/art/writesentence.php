<?php
$question = $data->getItem();
$i= $question['id'];
?>
<div class="step">
 	<span><strong>Yêu Cầu: </strong> <?php  echo $question['request']; ?></span>
</div>
<div class="step">
	<span><strong> Câu hỏi:</strong> <?php  echo $question['name']; ?></span>
</div>
<div class="step" >
  		<div style="clear:both;"><span><strong>Đáp án:</strong></span></div>
  		
  		<div class="col-xs-3 margin-top-10" style="position:relative; margin-top: 20px; " >
			<div class="input-group" >
			    <input type="text" style="width: 700px;" name="writesentence[<?=$i;?>]" class="input_user_test form-control content_value"/>
			</div>
		</div>
</div>

