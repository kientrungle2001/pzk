<?php
$questionTopic = $data->getItem();
$i= $questionTopic->get('id');
?>
<div class="step">
 	<span><strong>Q25 Yêu Cầu: </strong> {? echo $questionTopic->getRequest(); ?}</span>
</div>
<div class="step">
	<span><strong>Đoạn văn:</strong> {? echo $questionTopic->get('name'); ?}</span>
</div>
<div class="step">
	<span><strong>Đáp án:</strong></span>
	<div class="col-xs-3 margin-top-10">
		<div class="input-group" >
			<input type="text" name="answers[<?=$i;?>][]" class="input_user_test form-control content_value"/>
		</div>
	</div>
</div>

