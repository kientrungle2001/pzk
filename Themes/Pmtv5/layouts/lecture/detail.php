<?php $item = $data->getItem(); 
$hasVideo = $data->getHasVideo();
$others = $data->getOthers();
$exercises = $data->getExercises();
?>
<div class="lecture-region">
	<div class="container">
		<?php  if($item['video'] || $item['content']):?>
		<h1 class="text-center font-larger">Bài giảng: <?php echo @$item['name']?></h1>
		<div class="row">
			<div class="col-sm-8 col-sm-offset-2 col-xs-12 box news-box">
				<div class="row">
					<div class="form-group col-xs-12 col-sm-6">
						<select id="video-select" class="form-control {cssclass select-background}" onchange="$('.video-wrapper').hide(); $('#video' + $(this).val()).show(); select_video($(this).val());">
							<option>Mục lục Bài giảng</option>
							<?php for($i = 0; $i < 7; $i++): ?>
								<?php if($i===0) {} else { if(!@$item['video'. $i]) continue; } ?>
								<?php if($i !== 0): ?>
									<option value="<?php echo $i ?>"><?php echo @$item['video'. $i.'_title']?></option>
								<?php else: ?>
									<option value=""><?php echo @$item['video_title']?></option>
								<?php endif;?>
							<?php endfor;?>
						</select>
					</div>
					<div class="form-group col-xs-12 col-sm-6">
						<select id="other-topic-select" class="form-control {cssclass select-background}" onchange="window.location=$(this).val();">
							<option>Chọn Bài giảng khác trong mục <?php php echo $otherSections[0]['name']; ?></option>
							<?php foreach($otherSections as $other): ?>
							<option value="/<?php echo @$other['alias']?>" <?php if($other['alias'] == $item['alias']):?>selected="selected"<?php endif;?>><?php echo str_repeat('--', @$other['level']-1); ?><?php echo @$other['name']?></option>
							<?php endforeach; ?>
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
				<?php if($item['video'] && !pzk_request()->getShow_content()):	$file = $item['id']; ?>
				<link href="http://vjs.zencdn.net/5.8.8/video-js.css" rel="stylesheet">
				<div id="all-videos" class="all-videos">
				  <div id="video" class="video-wrapper">
					<video id="my-video" class="video-js vjs-16-9 vjs-big-play-centered" controls preload="auto" width="700" height="390"
					  poster="<?php echo pzk_or(@$item['video_image'], '/Themes/pmtv4/skin/media/video-player.png'); ?>" <?php if(!pzk_request()->isMobile() && !pzk_request()->isTablet()):?>data-setup='{"techOrder": ["html5", "flash"]}'<?php endif;?>>
						<source src="<?php if(pzk_request()->isMobile() || pzk_request()->isTablet()):?>/videos/video-<?php echo $file ?>-0.mp4<?php else: ?>rtmp://103.15.50.19:1935/vod/video-<?php echo $file ?>-0.mp4<?php endif;?>" <?php if(!pzk_request()->isMobile() && !pzk_request()->isTablet()):?>type="rtmp/mp4"<?php else:?>type="video/mp4"<?php endif; ?>>
					</video>
				  </div>
				  <?php for($i = 1; $i < 7; $i++):
				  if(!@$item['video'. $i]) continue;
				  ?>
				  <div id="video<?php echo $i ?>" class="video-wrapper" style="display: none;">
					<video id="my-video-<?php echo $i ?>" class="video-js vjs-16-9 vjs-big-play-centered" controls preload="auto" width="700" height="390"
					  poster="<?php echo pzk_or(@$item['video'.$i.'_image'], '/Themes/pmtv4/skin/media/video-player.png'); ?>"  <?php if(!pzk_request()->isMobile() && !pzk_request()->isTablet()):?>data-setup='{"techOrder": ["html5", "flash"]}'<?php endif; ?>>
						<source src="<?php if(pzk_request()->isMobile() || pzk_request()->isTablet()):?>/videos/video-<?php echo $file ?>-<?php echo $i ?>.mp4<?php else :?>rtmp://103.15.50.19:1935/vod/video-<?php echo $file ?>-<?php echo $i ?>.mp4<?php endif; ?>" <?php if(!pzk_request()->isMobile() && !pzk_request()->isTablet()):?>type="rtmp/mp4"<?php else: ?>type="video/mp4"<?php endif;?>>
					</video>
				  </div>
				  <?php endfor;?>
				</div>
				<script src="http://vjs.zencdn.net/5.8.8/video.js"></script>
				<script type="text/javascript">
				
				var videoRequested = '<?php echo pzk_request()->getVideo()?>';
				$(function() {
					$('#video-select').val(videoRequested);
					$('#video-select').change();
				});
				
				function select_video(videoIndex) {
				}
				
				<?php 
				$allVideos = array();
				for($i = 0; $i < 7; $i++):
					$j = $i;
					if($i == 0) {
						$j = '';
					}
					if(isset($item['video' . $j]) && $item['video' . $j]) {
						$allVideos[] = $j;
					}
				endfor;
				for($i = 0; $i < count($allVideos) - 1; $i++):
				$nextI = $i+1;
				$suffix = '-' . $allVideos[$i];
				if($allVideos[$i] == '') {
					$suffix = '';
				}
				$nextSuffix = '-' . $allVideos[$nextI];
				$currentVideo = $allVideos[$i];
				$nextVideo = $allVideos[$nextI];
				?>
				var video<?php echo $currentVideo ?> = videojs('my-video<?php echo $suffix ?>').ready(function(){
				  var player = this;

				  player.on('ended', function() {
					var video<?php echo $nextVideo ?> = videojs('my-video<?php echo $nextSuffix ?>');
					$('#video-select').val('<?php echo $nextI ?>');
					$('#video-select').change();
					video<?php echo $nextVideo ?>.play();
					setTimeout(function() {
						$('#video<?php echo $currentVideo ?> .vjs-fullscreen-control').click();
						$('#video<?php echo $nextVideo ?> .vjs-fullscreen-control').click();
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
				<?php echo @$item['content']?>
				<!-- end check has content -->
				<?php endif;?>
				<!-- end check payment success -->
				<?php endif; ?>
			</div>
		</div>
		</div>
		<?php endif; ?>
		
		<!-- end check has video or content -->
		<div class="clear"></div>
		<div class="row">
		<div class="col-xs-12 text-center">
		Để xem được video này bạn cần phải cài <a href="https://get.adobe.com/flashplayer/">Flashplayer!!!</a>.<br /> Xem <a href="http://pmtv4.tiengviettieuhoc.vn/huong-dan-cai-flash-player">hướng dẫn cài đặt tại đây</a>.
		</div>
		</div>
		
		<h1 class="text-center">Bài tập - <?php echo @$item['name']?></h1>
		<div class="col-sm-10 col-sm-offset-1 col-xs-12">
			<form class="form">
				<div class="row">
					<div class="form-group col-xs-12 col-sm-5">
						<select id="lecture-select" class="form-control">
							<option disabled="disabled">Chọn dạng bài tập</option>
							<?php foreach($others as $other): ?>
							<option value="/<?php echo @$other['alias']?>"><?php echo @$other['name']?></option>
							<?php endforeach; ?>
						</select>
						<script type="text/javascript">
							$('#lecture-select').val('/<?php echo @$item['alias']?>');
							$('#lecture-select').change(function() {
								var url = $(this).val();
								if(!!url) {
									window.location = url;
								}
							});
						</script>
					</div>
					<div class="form-group col-xs-12 col-sm-5">
						<select id="lecture-detail-select" class="form-control">
							<option value="">Chọn bài tập</option>
							<?php for($i = 1; $i <= $exercises; $i++) :?>
							<option value="<?php echo $i ?>">Bài <?php echo $i ?></option>
							<?php endfor; ?>
						</select>
					</div>
					<div class="form-group col-xs-12 col-sm-2">
						<?php if(pzk_request()->getExerciseNum()) : ?>
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
						Thời gian làm bài
						<?php endif; ?>
					</div>
				</div>
			</form>
			
			<div class="row">
				<div class="col-xs-12">						
					<div id="startForm" class="<?php if(pzk_request()->getExerciseNum()) : ?>hidden<?php endif;?>">
						<img id="start-select" src="/Themes/pmtv4/skin/media/start.png" class="img-responsive" usemap="#imagemap" width="920" height="731" />
						<map name="imagemap">
							<area id="btn-start" shape="rect" coords="340,46,580,85" href="#" />
						</map>
					</div>
					<?php if(pzk_request()->getExerciseNum()) : ?>
					<div id="doForm" style="background: #fff; padding: 10px;">
						<form id="questionForm" class="form">
						<?php $questions = $data->getQuestions(pzk_request()->getExerciseNum());
						$index = 1;
						$questionIds = array();
						?>
						<?php foreach($questions as $question): ?>
						<div class="row">
							<div class="col-xs-12">
								<h4>Câu <?php echo $index ?>: <?php echo @$question['name']?></h4>
							</div>
						</div>
						<?php  
						$questionIds[] = $question['id'];
						$answers = $data->getAnswers($question); ?>
						<Blockquote>
						<div class="row">
							<?php foreach($answers as $answer): ?>
							<div class="col-xs-12 form-group answer-item">
								<input id="answers_<?php echo @$question['id']?>_<?php echo @$answer['id']?>" type="radio" name="answers[<?php echo @$question['id']?>]" value="<?php echo @$answer['id']?>" /> <label for="answers_<?php echo @$question['id']?>_<?php echo @$answer['id']?>" class="font-normal"><?php echo @$answer['content']?></label>
							</div>
							<?php endforeach; ?>
							<div class="col-xs-12 form-group question-explaination hidden">
								<button onclick="$('#explaination_<?php echo @$question['id']?>').toggleClass('hidden');" type="button" class="btn btn-success">
									<span class="glyphicon glyphicon-search"></span> Giải thích
								</button>
								<div id="explaination_<?php echo @$question['id']?>" class="well hidden font-normal"></div>
							</div>
						</div>
						
						</Blockquote>
						<?php  $index++; ?>
						<?php endforeach; ?>
						<div class="row">
							<div class="col-xs-12 form-group text-center">
								<input type="hidden" name="categoryId" value="<?php echo @$item['id']?>" />
								<input type="hidden" name="quantity" value="<?php  echo ($index-1); ?>" />
								<input type="hidden" name="exerciseNum" value="<?php  echo pzk_request()->getExerciseNum(); ?>" />
								<input type="hidden" name="questionIds" value="<?php  echo implode(',', $questionIds); ?>" />
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
				pzk.beforeload('<?php echo @$data->id?>', function() {
					this.setUrl('/<?php echo @$item['alias']?>');
					this.selectExerciseNum('<?php echo pzk_request()->getExerciseNum(); ?>');
				});
				pzk.onload('<?php echo @$data->id?>', function() {
					// do nothing
				});
			</script>
		</div>
	</div>
</div>