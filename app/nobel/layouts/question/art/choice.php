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
<div class="col-xs-3 margin-top-10">

<input style="width: 15px; height: 15px;" class="input_user_test" name="choiceanswers[<?=$i;?>]" value="<?php  echo $answer['content']?>" type="radio" /><?php  echo $answer['content']?>
</div>
<?php endforeach; ?>
</div>