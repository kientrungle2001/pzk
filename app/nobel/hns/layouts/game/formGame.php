<?php
$gameType = $data->getGameType();
$gameTopic = $data->getGameTopic();
$gameTopic = buildArr($gameTopic, 'parent', 0);
$post = pzk_request();
$getGameType = $post->getGameType();
$getTopic = $post->getGameTopic();
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
                    <select onchange="getGameType(this);" class="form-control input-sm" name="gameType"  id="gameType">
                        <option value="">Choose game</option>
                        {each $gameType as $topic}
                        <option <?php if(isset($getGameType) && ($getGameType == $topic['gamecode'])){ echo 'selected';} ?> value="{topic[gamecode]}"><?php echo $topic['game_type']; ?></option>
                        {/each}
                    </select>
                <?php } ?>

            </div>
			
				
				<div id='resbytype' class="col-md-4">
				<?php if($getGameType == 'muatu') { 
				?>
                    <div class="form-group">
                        <label  for="">Topic</label>
                        <select class="form-control input-sm" name="gameTopic" id="gameTopic">
                            <option value="">-- Choose topic </option>
                            {each $gameTopic as $parent}
                            <option <?php if(isset($getTopic) && ($getTopic == $parent['id'])){ echo 'selected';} ?> value="<?php echo $parent['id']; ?>" >
                                <?php echo str_repeat('--', $parent['level']);  ?>
                                <?php echo $parent['game_topic']; ?>
                            </option>
                            {/each}

                        </select>
                    </div>
				<?php } else if($getGameType == 'dragWord') { 
					$dataQuestion = $data->countDragWord();
				?>
					<div class="form-group">
						<label  for="">Topic</label>
						<select class="form-control input-sm" name="gameTopic" id="gameTopic">
							<option value="">-- Choose topic </option>
							<?php $i = 1; foreach($dataQuestion as $item) { ?>
							<option <?php if(isset($getTopic) && ($getTopic == $item['id'])){ echo 'selected';} ?> value="<?php echo $item['id']; ?>" >
								Topic <?php echo $i ?>
								
							</option>
							<?php $i++; } ?>

						</select>
					</div>
				<?php } ?>
                </div>
			
            <div class="col-md-4">
                <div class="form-group">

                    <div id='playgame' style="margin-top: 20px;"  class="btn btn-primary">
                        <span class="glyphicon fefe glyphicon glyphicon-play" aria-hidden="true"></span> Play game
                    </div>
                </div>
            </div>
        </div>
    </form>
	<style>
		
		#playgame {
		 
			text-transform: uppercase;
			background-color: #337ab7;
			animation-name: stretch;
			animation-duration: 1s; 
			animation-timing-function: ease-out; 
			animation-delay: 0;
			animation-direction: alternate;
			animation-iteration-count: infinite;
			animation-fill-mode: none;
			animation-play-state: running;
		}
				
				@keyframes stretch {
		  0% {
			transform: scale(0.9);
			background-color: #337ab7;
			
		  }
		 
		  100% {
			transform: scale(1.1);
			background-color: orange;
			
		  }
		}
	
	</style>
	<script>
		function getGameType(that) {
			var gametype = $(that).val();
			if(gametype == '') {
				alert('Please choose game');		
			}else {
				$.ajax({
					type: "Post",
					data: {gametype:gametype},
					url:'<?=BASE_REQUEST?>/Game/getTopicByType',
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
				alert('Bạn phải chọn trò chơi');
				alert('Bạn phải chọn trò chơi và click vào nút Play game!');
				$('#gameType').focus();
				return false;
			});
		});
	</script>
	<?php } ?>
</div>