 <?php 
 $gametype = $data->getTypeGame();
 
 if($gametype == 'muatu') {
$gameTopic = $data->getGameTopic();
$gameTopic = buildArr($gameTopic, 'parent', 0);
 ?>
 <div class="form-group">
	<label  for="">Topic</label>
	<select class="form-control input-sm" name="gameTopic" id="gameTopic">
		<option value="">-- Choose topic </option>
		<?php foreach($gameTopic as $parent): ?>
		<option <?php if(isset($getTopic) && ($getTopic == $parent['id'])){ echo 'selected';} ?> value="<?php echo $parent['id']; ?>" >
			<?php echo str_repeat('--', $parent['level']);  ?>
			<?php echo $parent['game_topic']; ?>
		</option>
		<?php endforeach; ?>

	</select>
</div>
 <?php } else if($gametype == 'dragWord'){ 
	$dataQuestion = $data->countDragWord();
	
 ?>
  <div class="form-group">
	<label  for="">Topic</label>
	<select class="form-control input-sm" name="gameTopic" id="gameTopic">
		<option value="">-- Choose topic </option>
		<?php $i = 1; foreach($dataQuestion as $item) { ?>
		<option value="<?php echo $item['id']; ?>" >
			Topic <?php echo $i ?>
			
		</option>
		<?php $i++; } ?>

	</select>
</div>
 <?php } ?>