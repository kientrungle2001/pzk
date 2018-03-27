<?php
$question = $data->getItem();
$i= $question->get('id');
?>
<div class="step">
 	<span><strong>Yêu Cầu: </strong> {? echo $question->getRequest(); ?}</span>
</div>
<div class="step">
	<span><strong> Câu hỏi:</strong> {? echo $question->get('name'); ?}</span>
</div>
<?php 
$choiceQuestion = $question->getRealEntity();
$answers = $choiceQuestion->getAnswers();
?>
<div class="step" >
	
	{each $answers as $answer}
<div class="col-xs-3 margin-top-10">

<input style="width: 15px; height: 15px;" class="input_user_test_<?=$i?>" name="choiceanswers[<?=$i;?>]" value="<?php echo $answer->get('id')?>" type="radio" /><?php echo $answer->getContent()?>
</div>
{/each}
</div>