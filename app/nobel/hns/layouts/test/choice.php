<?php
$question = $data->getItem();
$i= $question->getId();
?>
<div class="step">
 	<span><strong>Yêu Cầu: </strong> <?php  echo $question->getRequest(); ?></span>
</div>
<div class="step">
	<span><strong> Câu hỏi:</strong> <?php  echo $question->getName(); ?></span>
</div>
<?php 
$choiceQuestion = $question->getRealEntity();
$answers = $choiceQuestion->getAnswers();
?>
<div class="step" >
	
	<?php foreach($answers as $answer): ?>
<div class="col-xs-3 margin-top-10">

<input style="width: 15px; height: 15px;" class="input_user_test_<?=$i?>" name="choiceanswers[<?=$i;?>]" value="<?php echo $answer->getId()?>" type="radio" /><?php echo $answer->getContent()?>
</div>
<?php endforeach; ?>
</div>