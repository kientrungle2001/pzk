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
<?php 
$choiceQuestion = $question->getRealEntity();
$answers = $choiceQuestion->getAnswers();
?>
<div class="step" >
	
	{each $answers as $answer}
<div class="col-xs-12 margin-top-10">

<input style="width: 15px; height: 15px;" class="input_user_test_<?=$i?>" name="rdochoicerepair[<?=$i;?>]" value="<?php echo $answer->getId()?>" type="radio" /><?php echo $answer->getContent()?>
</div>
{/each}
</div>
<div class="step">
	<span><strong>Viết lại thành câu đúng: </strong></span>
</div>
<div class="col-xs-12 margin-top-10">
	<div class="input-group" >
		<input type="text" style="width: 700px;" name="txtchoicerepair[<?=$i?>]" class="input_user_test form-control content_value"/>
	</div>
</div>