<?php
$gameType = $data->getGameType();
$gameTopic = $data->getGameTopic();
$gameTopic = buildArr($gameTopic, 'parent', 0);
$post = pzk_request();
$getGameType = $post->get('gameType');
$getTopic = $post->get('gameTopic');
?>

<div class="container fullgame text-left">
	<div class="row">
		<div class="col-md-1">&nbsp;</div>			
		<div class="col-xs-11 col-md-11 ">
			<div class="mgt20p text-right">
				<h1><a href="<?=FL_URL?>">FULL LOOK</a></h1>	
				<div class="btncon">
					<a href="/home/about"><button type="button" class="btn   btn-custom">Chi tiết và mua sản phẩm</button></a>
					<a href="/Huong-dan-su-dung"><button type="button" class="btn  btn-custom ">Hướng dẫn sử dụng</button></a>
				</div>
			</div>
		</div>
	</div>
</div>

{children [position=top-menu]}

<div class="container">
<div class='well'> 
    <form id = 'form_game' name="form_game" method="get" >
        <div class="row">
            <div class="col-md-4">
                <label for="">Game</label>
                <?php if(isset($gameType)) { ?>
                    <select onchange="getGameType(this);" class="form-control input-sm" name="gameType" id="gameType">
                        <option value="">Choose game</option>
                        {each $gameType as $topic}
                        <option <?php if(isset($getGameType) && ($getGameType == $topic['gamecode'])){ echo 'selected';} ?> value="{topic[gamecode]}"><?php echo $topic['game_type']; ?></option>
                        {/each}
                    </select>
                <?php } ?>

            </div>

			<div id='resbytype' class="col-md-4">
				<?php if($getGameType == 'muatu') { 
					$i =1;
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
				<?php } else if($getGameType == 'dragWord') { 
					$dataQuestion = $data->countDragWord();
				?>
					<div class="form-group">
						<label  for="">Topic</label>
						<select onchange="trygame(this);" class="form-control input-sm" name="gameTopic" id="gameTopic">
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
                </div>
			
            <div class="col-md-4">
                <div class="form-group">

                    <div id='playgame' style="margin-top: 20px;"  class="btn btn-primary">
                        <span class="glyphicon glyphicon glyphicon-play" aria-hidden="true"></span> Play game
                    </div>
                </div>
            </div>
        </div>
    </form>
	<script>
	
		function getGameType(that) {
			var gametype = $(that).val();
			if(gametype == '') {
				alert('Please choose game');		
			}else {
				$.ajax({
					type: "Post",
					data: {gametype:gametype},
					url:'<?=BASE_REQUEST?>/Game/getTryTopicByType',
					success: function(data){
						
						$('#resbytype').html(data);		
					}
				});
				return false;
			}
			
		};
	
		$('#playgame').click(function(){
			var gameType = $('#gameType').val();
			var gameTopic = $('#gameTopic').val();
			
			if(gameType == '') {
				alert('Please choose game');
				return false;
			}else if(gameTopic == '') {
				alert('Please choose topic');
				return false;
			}else{
				$('#form_game').submit();
			}
			
		});
	</script>
	</div>
	<?php if(@!($_GET['gameType'])) { ?>
	<div class='fixgame'>
	<img id="alertGame" class='item' src="<?=BASE_URL;?>/Default/skin/test/game/images/gamebg.png" />
	</div>
	<script>
		$(document).ready(function(){
			$('#alertGame').click(function(){
				alert('Bạn phải chọn trò chơi và click vào nút Play game!');
				$('#gameType').focus();
				return false;
			});
		});
	</script>
	<?php } ?>
</div>