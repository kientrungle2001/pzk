<?php $item = $data->getItem(); 
$hasVideo = $data->get('hasVideo');
$others = $data->getOthers();
$exercises = $data->getExercises();
$otherSections = $data->getOtherSections();
$sections = $data->getAllSections();
?>
<div class="lecture-region">
	<div class="container">
		<!-- start check has video or content -->
		{? if($item['video'] || $item['content']):?}
		<h1 class="text-center font-larger">Bài giảng: {item[name]}</h1>
		<div class="row">
			<div class="col-sm-8 col-sm-offset-2 col-xs-12 box news-box">
				<div class="row">
					<div class="form-group col-xs-12 col-sm-6">
						<select id="video-select" class="form-control {cssclass select-background}" onchange="$('.video-wrapper').hide(); $('#video' + $(this).val()).show(); select_video($(this).val());">
							<option>Mục lục Bài giảng</option>
							<?php for($i = 0; $i < 7; $i++): ?>
								<?php if($i===0) {} else { if(!@$item['video'. $i]) continue; } ?>
								<?php if($i !== 0): ?>
									<option value="{i}"><?php echo @$item['video'. $i.'_title']?></option>
								<?php else: ?>
									<option value=""><?php echo @$item['video_title']?></option>
								<?php endif;?>
							<?php endfor;?>
						</select>
					</div>
					<div class="form-group col-xs-12 col-sm-6">
						<select id="other-topic-select" class="form-control {cssclass select-background}" onchange="window.location=$(this).val();">
							<option>Chọn Bài giảng khác trong mục {?php echo $otherSections[0]['name']; ?}</option>
							{each $otherSections as $other}
							<option value="/{other[alias]}" <?php if($other['alias'] == $item['alias']):?>selected="selected"<?php endif;?>><?php echo str_repeat('--', @$other['level']-1); ?>{other[name]}</option>
							{/each}
						</select>
					</div>
				</div>
				<div class="box-content top-20" style="background: #fff; overflow-x: hidden; height: 400px; padding: 15px;">
				<!-- start check payment failed -->
				<?php  if(!pzk_session('userId') || (!pzk_user()->checkPayment('lecture', LECTURE_SCOPE_LECTURE_ONLY ))):?>
					<?php if(!pzk_session('userId')):?>
						<h4 class="text-center">Bạn cần phải đăng nhập để học nội dung này</h4>
					<?php else:?>
						<img class="img-responsive" src="/Themes/pmtv4/skin/media/buy_required.png" />
					<?php endif;?>
				<!-- end check payment failed -->
				<?php else: ?>
				<!-- start check payment success -->
				
				<!-- start check has video -->
				<?php if($item['video']):	$file = $item['id']; ?>
				<link href="http://vjs.zencdn.net/5.19.2/video-js.css" rel="stylesheet">
				<div id="all-videos" class="all-videos">
				  <div id="video" class="video-wrapper">
					<video id="my-video" class="video-js vjs-16-9 vjs-big-play-centered" controls preload="auto" width="700" height="390"
					  poster="<?php echo pzk_or(@$item['video_image'], '/Themes/pmtv4/skin/media/video-player.png'); ?>" data-setup="{}">
						<source src="{item[video]}" type='application/x-mpegURL'>
					</video>
				  </div>
				  <?php for($i = 1; $i < 6; $i++):
				  if(!@$item['video'. $i]) continue;
				  ?>
				  <div id="video{i}" class="video-wrapper" style="display: none;">
					<video id="my-video-{i}" class="video-js vjs-16-9 vjs-big-play-centered" controls preload="auto" width="700" height="390"
					  poster="<?php echo pzk_or(@$item['video'.$i.'_image'], '/Themes/pmtv4/skin/media/video-player.png'); ?>" data-setup="{}">
						<source src="{? echo $item['video' . $i]; ?}" type='application/x-mpegURL'>
					</video>
				  </div>
				  <?php endfor;?>
				</div>
				<script src="http://vjs.zencdn.net/5.19.2/video.js"></script>
				<script src="https://cdnjs.cloudflare.com/ajax/libs/videojs-contrib-hls/5.5.2/videojs-contrib-hls.min.js"></script>

				<script type="text/javascript">
				var video = videojs('my-video').ready(function(){
				  var player = this;

				  player.on('ended', function() {
					var video1 = videojs('my-video-1');
					$('#video-select').val('1');
					$('#video-select').change();
					video1.play();
					setTimeout(function() {
						$('#video .vjs-fullscreen-control').click();
						$('#video1 .vjs-fullscreen-control').click();
					}, 1000);
					
				  });
				});
				
				<?php for($i = 1; $i < 6; $i++):
				$nextI = $i+1;
				?>
				var video{i} = videojs('my-video-{i}').ready(function(){
				  var player = this;

				  player.on('ended', function() {
					var video{nextI} = videojs('my-video-{nextI}');
					$('#video-select').val('{nextI}');
					$('#video-select').change();
					video{nextI}.play();
					setTimeout(function() {
						$('#video{i} .vjs-fullscreen-control').click();
						$('#video{nextI} .vjs-fullscreen-control').click();
					}, 1000);
				  });
				});
				<?php endfor;?>

				</script>
				<!-- end check has video -->
				<?php else:?>
				<!-- start check has content -->
				<div class="company-title text-right">
				<div class="logo text-right"><img style="width: 35%;" src="/Themes/pmtv/skin/media/logo.png" /></div>
				<hr style="color: #00ADEF;
    background: #00ADEF;
    border-bottom: 1px solid #00ADEF;" />
				</div>
				{item[content]}
				<!-- end check has content -->
				<?php endif;?>
				<!-- end check payment success -->
				<?php endif; ?>
			</div>
		</div>
		</div>
		{/if}
		<!-- end check has video or content -->
		<div class="clear"></div>
		
		<?php if($exercises):?>
		<h1 id="practice-section" class="text-center font-larger">Bài tập - {item[name]}</h1>
		
		<div class="row">
		<div class="col-sm-10 col-sm-offset-1 col-xs-12">
			<form class="form">
				<div class="row">
					<div class="form-group col-xs-12 col-sm-5">
						<select id="lecture-select" class="form-control {cssclass select-background}">
							<option disabled="disabled">Chọn dạng bài tập {?php echo $otherSections[0]['name']; ?}</option>
							{each $otherSections as $other}
							<option value="/{other[alias]}" <?php if($other['alias'] == $item['alias']):?>selected="selected"<?php endif;?>><?php echo str_repeat('--', $other['level']-1); ?>{other[name]}</option>
							{/each}
						</select>
					</div>
					<div class="form-group col-xs-12 col-sm-5">
						<select id="lecture-detail-select" style="border: 2px solid yellow;" class="form-control {cssclass select-background}">
							<option value="">Chọn bài tập</option>
							<?php for($i = 1; $i <= $exercises; $i++) :?>
							<option value="{i}">Bài {i}</option>
							<?php endfor; ?>
						</select>
					</div>
					<div class="form-group col-xs-12 col-sm-2">
						<?php if(pzk_request('exerciseNum')) : ?>
							<div class="form-control"><span id="timer"><span class="minute">00</span>:<span class="second">00</span></span></div>
							<script type="text/javascript">
							$.fn.countdown = function(options) {
								var pause = this.data('pause') || false;
								if('pause' === options) {
									pause = true;
									this.data('pause', true);
									return ;
								}
								if('resume' === options) {
									pause = false;
									this.data('pause', false);
									return ;
								}
								var min = options.min;
								var second = options.second;
								var duration = 0;
								var remaining = min * 60 + second;
								var that = this;
								
								var countdownId = setInterval(function(){
									if(that.data('pause')) {
										clearInterval(countdownId);
										return ;
									}
									options.onrun(min, second, duration, remaining);
									if(remaining <= 0) {
										clearInterval(countdownId);
										options.onstop(duration, remaining);
									} else {
										remaining--;
										duration++;
										if(second == 0) {
											second = 59;
											min--;
										} else {
											second--;
										}
									}
									that.find('.minute').text(min);
									that.find('.second').text(second);
								}, 1000);
							};
							$('#timer').countdown({min: 15, second: 0, onrun: function(min, second, duration, remaining){
								$('#countdownDuration').val(duration);
								$('#countdownRemaining').val(remaining);
							}, onstop: function(duration, remaining){
								$('#questionForm').submit();
							}});
							</script>
						<?php else: ?>
						Thời gian làm bài: 15 phút
						<?php endif; ?>
					</div>
				</div>
			</form>
			
			<div class="row">
				<div class="col-xs-12">						
					<div id="startForm" class="<?php if(pzk_request('exerciseNum')) : ?>hidden<?php endif;?>">
						<img id="start-select" src="/Themes/pmtv4/skin/media/start.png" class="img-responsive" usemap="#imagemap" width="920" height="731" />
						<map name="imagemap">
							<area id="btn-start" shape="rect" coords="340,46,580,85" href="#" />
						</map>
					</div>
					<?php if(pzk_request('exerciseNum')) : ?>
					
					<div id="doForm" style="background: #fff; padding: 10px; margin-bottom: 30px;">
						
						<?php
					if(!pzk_session('userId') || (!pzk_user()->checkPayment('lecture', LECTURE_SCOPE_EXERCISE_ONLY ) )):?>
					<?php if(!pzk_session('userId')):?>
					<h4 class="text-center">Bạn cần phải đăng nhập để học nội dung này</h4>
					<?php else:?>
					<img class="img-responsive" src="/Themes/pmtv4/skin/media/buy_required.png" />
					<?php endif;?>
					<?php else: ?>
						<form id="questionForm" class="form">
						<input type="hidden" name="totalDuration" value="15" />
						<input type="hidden" name="startTime" value="<?php echo date('Y-m-d H:i:s');?>" />
						<input type="hidden" name="duration" id="countdownDuration" value="0" />
						<input type="hidden" name="remaining" id="countdownRemaining" value="<?php echo (15 * 60)?>" />
						<?php $questions = $data->getQuestions(pzk_request('exerciseNum'));
						$index = 1;
						$questionIds = array();
						?>
						{each $questions as $question}
						<div class="row">
							<div class="col-xs-offset-1 col-xs-10 relative">
								<span class="absolute inline-block circle color-white font-large" style="width: 40px; height: 40px; background: #5E2083; padding-left: 16px; padding-top: 10px; border-radius: 50%; top: 0px; left: -35px;">{index}</span> <div style="padding-top: 5px;">{question[name]}</div><div class="clear"></div>
							</div>
						</div>
						{? 
						$questionIds[] = $question['id'];
						$answers = $data->getAnswers($question); ?}
						{? if(count($answers) == 1) { ?}
							<input type="hidden" name="question_types[{question[id]}]" value="<?php echo QUESTION_TYPE_FILL; ?>" />
							<div class="row">
								<div class="col-xs-offset-1 col-xs-10 answer-item">
									<div class="left-20 top-10">
									<label for="answers_{question[id]}_{answer[id]}" class="font-normal inline float-left">Nhập đáp án: &nbsp;&nbsp;&nbsp;</label>
									<input class="margin-0 padding-0 block" style="margin: 0; padding: 0;" id="answers_{question[id]}_{answer[id]}" type="text" name="answers[{question[id]}]" />
									
									<div class="clear"></div>
									</div>
								</div>
								
								<div class="col-xs-offset-1 col-xs-10 form-group question-explaination hidden">
									<button onclick="$('#explaination_{question[id]}').toggleClass('hidden');" type="button" class="btn btn-success">
										<span class="glyphicon glyphicon-search"></span> Giải thích
									</button>
									<div id="explaination_{question[id]}" class="well hidden font-normal"></div>
								</div>
							</div>
						{? } else { ?}
						<input type="hidden" name="question_types[{question[id]}]" value="<?php echo QUESTION_TYPE_CHOICE; ?>" />
						<div class="row">
							
							{each $answers as $answer}
							<div class="col-xs-offset-1 col-xs-10 answer-item">
								<div class="left-20 top-10">
								<span class="block circle float-left right-5" style="border: 1px solid purple; width: 14px; height: 14px;"><input class="margin-0 padding-0 block" style="margin: 0; padding: 0;" id="answers_{question[id]}_{answer[id]}" type="radio" name="answers[{question[id]}]" value="{answer[id]}" /></span> <label for="answers_{question[id]}_{answer[id]}" class="font-normal inline">{answer[content]}</label>
								<div class="clear"></div>
								</div>
							</div>
							{/each}
							
							<div class="col-xs-offset-1 col-xs-10 form-group question-explaination hidden">
								<button onclick="$('#explaination_{question[id]}').toggleClass('hidden');" type="button" class="btn btn-success">
									<span class="glyphicon glyphicon-search"></span> Giải thích
								</button>
								<div id="explaination_{question[id]}" class="well hidden font-normal"></div>
							</div>
						</div>
						{? } ?}
						
						
						{? $index++; ?}
						{/each}
						<div class="row">
							<div class="col-xs-12 form-group text-center">
								<input type="hidden" name="categoryId" value="{item[id]}" />
								<input type="hidden" name="quantity" value="{? echo ($index-1); ?}" />
								<input type="hidden" name="exerciseNum" value="{? echo pzk_request('exerciseNum'); ?}" />
								<input type="hidden" name="questionIds" value="{? echo implode(',', $questionIds); ?}" />
								<button id="saveChoiceBtn" type="submit" class="btn btn-primary">
									<span class="glyphicon glyphicon-ok"></span> Hoàn thành
								</button>
								<button type="button" class="btn btn-success btn-show-explaination hidden">
									<span class="glyphicon glyphicon-th-list"></span> Đáp án
								</button>
								<button type="button" class="btn btn-success btn-show-result hidden">
									<span class="glyphicon glyphicon-th-list"></span> Kết quả
								</button>
							</div>
							
						</div>
						</form>
					<?php endif;?>
					</div>
					<div id="resultModal" class="modal fade" tabindex="-1" role="dialog">
					  <div class="modal-dialog" role="document">
						<div class="modal-content">
						  <div class="modal-header">
							<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
							<h4 class="modal-title">Kết quả</h4>
						  </div>
						  <div class="modal-body">
							<table class="table table-bordered">
								<tr class="text text-primary">
									<td width="15px"><span class="glyphicon glyphicon-th-list"></span></td>
									<th>Tổng số câu</th>
									<td id="questionQuantity"></td>
								</tr>
								<tr class="text text-success">
									<td><span class="glyphicon glyphicon-ok"></span></td>
									<th>Số câu đúng</th>
									<td id="rightQuantity"></td>
								</tr>
								<tr class="text text-danger">
									<td><span class="glyphicon glyphicon-remove"></span></td>
									<th>Số câu sai</th>
									<td id="wrongQuantity"></td>
								</tr>
							</table>
						  </div>
						  <div class="modal-footer">
							<button type="button" class="btn btn-danger" data-dismiss="modal"> <span class="glyphicon glyphicon-remove-sign"></span> Đóng</button>
							<button type="button" class="btn btn-success btn-show-explaination"> <span class="glyphicon glyphicon-th-list"></span> Đáp án</button>
						  </div>
						</div><!-- /.modal-content -->
					  </div><!-- /.modal-dialog -->
					</div><!-- /.modal -->
					<?php endif;?>
				</div>
			</div>
			
			<script type="text/javascript">
				pzk.beforeload('{data.id}', function() {
					this.setUrl('/{item[alias]}');
					this.selectExerciseNum('<?php echo pzk_request('exerciseNum'); ?>');
				});
				pzk.onload('{data.id}', function() {
					// do nothing
				});
			</script>
		</div>
		</div>
		<?php endif;?>
	</div>
</div>