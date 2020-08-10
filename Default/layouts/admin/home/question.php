<?php 
	$question = $data->listQuestion();
	$answer = $data->listAnswer();
 ?>
 <form action="" method="post">
	<?php foreach($question as $valueQue): ?>
	<?php echo @$valueQue['name']?> ?<br />
	<?php foreach($answer as $valueAns): ?>
	<?php 
	 	$tab = '&nbsp;&nbsp;&nbsp;&nbsp;';
	 	if($valueAns['questionId'] == $valueQue['id'])
	 	{
	 		if($valueAns['valueTrue'] == 1)
	 		{
	 			echo $tab.'<input type="radio" name="'.$valueAns['questionId'].'" value="'.$valueAns['id'].'" placeholder="" disabled checked/> '.$valueAns['value'].'.<br />';
	 		}
	 		echo $tab.'<input type="radio" name="'.$valueAns['questionId'].'" value="'.$valueAns['id'].'" placeholder="" disabled/> '.$valueAns['value'].'.<br />';
	 	}
	?>
	<?php endforeach; ?>
	<?php endforeach; ?>
 </form>