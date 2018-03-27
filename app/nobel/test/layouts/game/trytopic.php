 <?php 
 $gametype = $data->getTypeGame();
 
 if($gametype == 'muatu') {
$gameTopic = $data->getGameTopic();
$gameTopic = buildArr($gameTopic, 'parent', 0);
$i = 1;
 ?>
 <div class="form-group">
	<label  for="">Topic</label>
	<select onchange = "trygame(this);"  class="form-control input-sm" name="gameTopic" id="gameTopic">
		<!--option value="">-- Choose topic </option-->
		{each $gameTopic as $parent}
			<?php if($i ==1) { ?>
			<option <?php if(isset($getTopic) && ($getTopic == $parent['id'])){ echo 'selected';} ?> value="<?php echo $parent['id']; ?>" >
				<?php echo str_repeat('--', $parent['level']);  ?>
				<?php echo $parent['game_topic']; ?>
			</option>
			<?php } else { ?>
				<option value='trygame'>
				<?php echo str_repeat('--', $parent['level']);  ?>
				<?php echo $parent['game_topic']; ?>
				</option>
			<?php } ?>
			<?php $i++; ?>
		{/each}

	</select>
	<script>
	function trygame(that) {
		var val = $(that).val();
		if(val == 'trygame') {
			alert('Bạn phải mua sản phẩm mới truy cập được!');
			$(that).val('<?=$gameTopic['0']['id']?>');	
			return false;		
		}
		
	}
	</script>
</div>
 <?php } else if($gametype == 'dragWord'){ 
	$dataQuestion = $data->countDragWord();
	
 ?>
  <div class="form-group">
	<label  for="">Topic</label>
	<select onchange = "trygame(this);" class="form-control input-sm" name="gameTopic" id="gameTopic">
		<!--option value="">-- Choose topic </option-->
		<?php $i = 1; 
		foreach($dataQuestion as $item) { 
		if($i == 1){
		?>
		<option value="<?php echo $item['id']; ?>" >
			Topic <?php echo $i ?>
			
		</option>
		<?php } else { ?>
			<option value="trygame" >
				Topic <?php echo $i ?>
			
			</option>
		<?php } ?>
		<?php $i++; } ?>

	</select>
	<script>
	function trygame(that) {
		var val = $(that).val();
		if(val == 'trygame') {
			alert('Bạn phải mua sản phẩm mới truy cập được!');
			$(that).val('<?=$dataQuestion['0']['id']?>');	
			return false;		
		}
		
	}
	</script>
</div>
 <?php } ?>