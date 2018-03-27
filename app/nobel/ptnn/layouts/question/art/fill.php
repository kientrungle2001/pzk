<?php
$question = $data->getItem();
$i= $question['id'];
?>
<div class="step">
 	<span><strong>Yêu Cầu: </strong> {? echo $question['request']; ?}</span>
</div>
<div class="step">
	<span><strong> Câu hỏi:</strong> {? echo $question['name']; ?}</span>
</div>
	

<div class="step" >
  		<div style="clear:both;"><span><strong>Đáp án:</strong></span></div>
  		
  		<div class="col-xs-3 margin-top-10" style="position:relative; margin-top: 20px; " >
			<div class="input-group" >
			    <input type="text" name="answers[<?=$i;?>][]" class="input_user_test form-control content_value"/>
			</div>
			<div class="remove-input" ><a href="javascript:void(0)" class="color_delete" title="Xóa"><span class="glyphicon glyphicon-remove-circle"></span></a></div>
		</div>
		<div class="add_row_answer">
			<div class="itemAnswer_<?=$i;?>"  ></div>
		</div>
		<div class="btt_add_answer"><button type="button" class="btn btn-primary add-sub-input-test" onclick="addInputRow(<?=$i;?>)" style="margin-left: 15px;"><span class="glyphicon glyphicon-plus-sign"></span> Thêm đáp án</button></div>
  		
</div>


