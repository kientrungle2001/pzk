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
<?php 
$answers = $data->showAnswer($i);
?>
<div class="step" >
	
	<?php foreach($answers as $answer): ?>
<div class="col-xs-12 margin-top-10">

<input style="width: 15px; height: 15px;" class="input_user_test" name="rdochoicerepair[<?=$i;?>]" value="<?php  echo $answer['id']?>" type="radio" /><?php  echo $answer['content']?>
</div>
<?php endforeach; ?>
</div>
<div class="step">
	<span><strong>Viết lại thành câu đúng: </strong></span>
</div>
<div class="col-xs-12 margin-top-10">
	<div class="input-group" >
		<input type="text" style="width: 700px;" name="txtchoicerepair[<?=$i?>]" class="input_user_test form-control content_value"/>
	</div>
</div>