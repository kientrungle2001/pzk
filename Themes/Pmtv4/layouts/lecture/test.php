<?php $item = $data->getItem(); 
$hasVideo = $data->getHasVideo();
$others = $data->getOthers();
$tests = $data->getTests();
$questions = $data->getQuestions();
$cat = _db()->getTableEntity('categories')->load($data->getCatId());
?>
<div class="lecture-region">
	<div class="container">
		<h1 class="text-center"><?php echo @$item['name']?></h1>
		<div class="row">
		<div class="<?php echo pzk_theme_css_class('test-wrapper')?>">
			<form class="form">
				<div class="row">
					<div class="<?php echo pzk_theme_css_class('test-select-wrapper')?>">
						<select id="lecture-detail-select" class="form-control <?php echo pzk_theme_css_class('select-background')?>">
							<option disabled="disabled">Chọn Đề thi</option>
							<?php foreach($others as $other): ?>
							<option rel="/<?php echo @$other['alias']?>" value="<?php echo @$other['id']?>"><?php echo @$other['name']?></option>
							<?php endforeach; ?>
						</select>
						<script type="text/javascript">
							$('#lecture-detail-select').val('<?php echo $data->getCatId()?>');
						</script>
					</div>
					<div class="<?php echo pzk_theme_css_class('time-wrapper')?>">
						<div class="<?php echo pzk_theme_css_class('time-background')?>">
							Thời gian: <span id="timer" class="<?php echo pzk_theme_css_class('num-time')?>"><span class="minute">45</span>:<span class="second">00</span></span>
						</div>
					</div>
				</div>
			</form>
			
			<div class="row">
				<div class="col-xs-12">						
					<div id="startForm" class="<?php if(pzk_request()->getStep()) : ?>hidden<?php endif;?>">
						<img id="start-select" src="/Themes/pmtv4/skin/media/start.png" class="img-responsive" usemap="#imagemap" width="920" height="731" />
						<map name="imagemap">
							<area id="btn-start" shape="rect" coords="340,46,580,85" href="#" />
						</map>
					</div>
					<?php if(1) : ?>
					<div id="doForm" class="<?php echo pzk_theme_css_class('do-form-wrapper')?>">
					<?php
					if(!pzk_session('userId') || !pzk_user()->checkPayment('lecture', 2)):?>
						<?php if(!pzk_session('userId')):?>
					<h4 class="text-center">Bạn cần phải đăng nhập để học nội dung này</h4>
					<?php else:?>
					<img class="img-responsive" src="/Themes/pmtv4/skin/media/buy_required.png" />
					<?php endif;?>
					<?php else: ?>
					<?php if(pzk_request()->getStep() == 'doing'): ?>
						<form id="questionForm" class="form">
						<div class="row">
							<div class="col-xs-12"><?php echo $cat->getContent()?></div>
						</div>
						<?php $index = 1; $questionIds = array(); ?>
						<?php foreach($questions as $question): ?>
						<?php   $questionIds[] = $question['id']; $answers = $data->getAnswers($question); ?>
						
						<div class="row">
							<div class="<?php echo pzk_theme_css_class('question-name-wrapper')?>">
								<span class="<?php echo pzk_theme_css_class('question-num')?>"><?php echo $index ?></span> <div class="padding-top-5"><?php echo @$question['name']?></div><div class="clear"></div>
							</div>
						</div>
						
						<div class="row">
							
							<?php foreach($answers as $answer): ?>
							<div class="<?php echo pzk_theme_css_class('answer-item')?>">
								<div class="<?php echo pzk_theme_css_class('answer-item-wrapper')?>">
									<span class="<?php echo pzk_theme_css_class('answer-input-wrapper')?>">
										<input id="answers_<?php echo @$question['id']?>_<?php echo @$answer['id']?>" type="radio" name="answers[<?php echo @$question['id']?>]" value="<?php echo @$answer['id']?>" class="<?php echo pzk_theme_css_class('answer-input')?>" />
									</span> 
									<label for="answers_<?php echo @$question['id']?>_<?php echo @$answer['id']?>" class="<?php echo pzk_theme_css_class('answer-content')?> inline"><?php echo @$answer['content']?></label>
									<div class="clear"></div>
								</div>
							</div>
							<?php endforeach; ?>
							
							<div class="col-xs-offset-1 col-xs-10 form-group question-explaination hidden">
								<button onclick="$('#explaination_<?php echo @$question['id']?>').toggleClass('hidden');" type="button" class="btn btn-success">
									<span class="<?php echo pzk_theme_css_class('ico-search')?>"></span> Giải thích
								</button>
								<div id="explaination_<?php echo @$question['id']?>" class="well hidden font-normal"></div>
							</div>
						</div>
						
						
						<?php  $index++; ?>
						<?php endforeach; ?>
						<div class="row">
							<div class="col-xs-12 form-group text-center">
								<input type="hidden" name="categoryId" value="<?php echo $data->getCatId()?>" />
								<input type="hidden" name="quantity" value="<?php  echo ($index-1); ?>" />
								<input type="hidden" name="startTime" value="<?php echo date('Y-m-d H:i:s');?>" />
								<input type="hidden" name="duration" id="countdownDuration" value="0" />
								<input type="hidden" name="remaining" id="countdownRemaining" value="<?php echo (45 * 60)?>" />
								<input type="hidden" name="testId" value="<?php  echo $data->getTestId(); ?>" />
								<input type="hidden" name="questionIds" value="<?php  echo implode(',', $questionIds); ?>" />
								<button id="saveChoiceBtn" type="submit" class="<?php echo pzk_theme_css_class('btn-complete')?>">
									<span class="<?php echo pzk_theme_css_class('ico-ok')?>"></span> Hoàn thành
								</button>
								<button type="button" class="<?php echo pzk_theme_css_class('btn-show-explaination')?> hidden">
									<span class="<?php echo pzk_theme_css_class('ico-list')?>"></span> Đáp án
								</button>
								<button type="button" class="<?php echo pzk_theme_css_class('btn-show-result')?>">
									<span class="<?php echo pzk_theme_css_class('ico-list')?>"></span> Kết quả
								</button>
							</div>
							
						</div>
						</form>
						<?php endif;?>
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
									<td width="15px"><span class="<?php echo pzk_theme_css_class('ico-list')?>"></span></td>
									<th>Tổng số câu</th>
									<td id="questionQuantity"></td>
								</tr>
								<tr class="text text-success">
									<td><span class="<?php echo pzk_theme_css_class('ico-ok')?>"></span></td>
									<th>Số câu đúng</th>
									<td id="rightQuantity"></td>
								</tr>
								<tr class="text text-danger">
									<td><span class="<?php echo pzk_theme_css_class('ico-remove')?>"></span></td>
									<th>Số câu sai</th>
									<td id="wrongQuantity"></td>
								</tr>
							</table>
						  </div>
						  <div class="modal-footer">
							<button type="button" class="<?php echo pzk_theme_css_class('btn-close')?>" data-dismiss="modal"> <span class="glyphicon glyphicon-remove-sign"></span> Đóng</button>
							<button type="button" class="<?php echo pzk_theme_css_class('btn-show-explaination')?>"> <span class="glyphicon glyphicon-th-list"></span> Đáp án</button>
						  </div>
						</div><!-- /.modal-content -->
					  </div><!-- /.modal-dialog -->
					</div><!-- /.modal -->
					<?php endif;?>
				</div>
			</div>
			
			<script type="text/javascript">
				pzk.beforeload('<?php echo @$data->id?>', function() {
					this.setUrl('/<?php echo @$item['alias']?>?step=doing');
					this.selectCatId('<?php echo $data->getCatId(); ?>');
				});
			
			

			pzk.onload('<?php echo @$data->id?>', function() {
				// do nothing
			});
			<?php if(pzk_request()->getStep() == 'doing' && pzk_session('userId') && pzk_user()->checkPayment('lecture', 2)):?>
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
			$('#timer').countdown({min: 45, second: 0, onrun: function(min, second, duration, remaining){
				$('#countdownDuration').val(duration);
				$('#countdownRemaining').val(remaining);
			}, onstop: function(duration, remaining){
				$('#questionForm').submit();
			}});
			jQuery('#saveChoiceBtn').on('click', function(){ $('#timer').countdown('pause') });
			<?php endif;?>
			</script>
		</div>
		</div>
	</div>
</div>