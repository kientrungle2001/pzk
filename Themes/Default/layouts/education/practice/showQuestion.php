<?php
	$showQuestions 		= $data->get('data_showQuestion');
	$check				= pzk_session('checkPayment');
	// xu li questions
	$processQuestions 	= array();
	$arrQuestionIds 	= array();
	if(count($showQuestions) > 0) {
		foreach($showQuestions as $question) {
			$processQuestions[$question['id']] = $question;
			$arrQuestionIds[] = $question['id'];
		}
		//xu li cau tra loi
		$answers 		= _db()->useCache(1800)
			->selectAll()
			->from('answers_question_tn')
			->where(array('in', 'question_id', $arrQuestionIds))
			->result();
		$processAnswer 	= array();
		foreach($answers as $val) {
			$processAnswer[$val['question_id']][] = $val;
		}	
		//debug($processAnswer);die();	
	}
	
	
	$data_criteria		= $data->get('data_criteria');
	$category 			= $data->get('category');
	$category_id 		= $data->get('categoryId');
	$category_name 		= $data->get('categoryName');
	$class				= intval(pzk_request('class'));
	$de					= intval(pzk_request('de'));
	$subject			= intval(pzk_request()->getSegment(3));
	$parentSubject 		= 0;
	if($subject) {
		$subjectEntity 	= _db()->getTableEntity('categories')->load($subject, 1800);
		$parentSubject 	= $subjectEntity->get('parent');
	}
	$practices 			= $data->getPractices($class,$subject, $check);
	
?>
<div class="container fulllook3">
	<div class="row">
		<div class="col-md-1">&nbsp;</div>			
		<div class="col-xs-11 col-md-11 ">
			<div class="pd-20 text-center">
				<a href="<?=FL_URL?>"><h1>FULL LOOK</h1></a>	
				<h3 class="hidden-xs">Phần mềm Khảo sát và Phát triển năng lực toàn diện bằng tiếng Anh</h3>
				<?php echo partial('Themes/Default/layouts/home/aboutbtn');?>
			</div>
		</div>
	</div>
</div>	
{children [position=top-menu]}
<?php if(pzk_session('login')) { ?>
<div class="container">
	<p class="t-weight text-center btn-custom8 mgright textcl">Luyện tập - Lớp <?php echo $class; ?></p>
</div>

<?php if(!empty($data_criteria['category_type'])):?>
<div class="container top40 hidden-xs">
	<h2 class="title-practice text-center"><?=$data_criteria['category_type_name']?></h2>
</div>
<div class="container visible-xs">
	<h2 class="title-practice text-center"><?=$data_criteria['category_type_name']?></h2>
</div>
<?php else:?>
<div class=" container top40">
	<h2 class="title-practice text-center"><?=$data_criteria['category_name']?></h2>
</div>
<?php endif;?>
<div class="container">
	<div id="question-wrapper">
	<div class="row form-group view_practice margin-top-20">	
		<div class="col-xs-12 col-sm-10 col-md-7 col-md-offset-1 pull-left">
			{children [position=choice]}
			<div class="dropdown col-md-6 col-sm-6 col-xs-6 nomgin">
				<button class="btn fix_hover btn-default dropdown-toggle col-md-12 col-sm-12 col-xs-12 sharp" type="button" data-toggle="dropdown">
					<div class="row">
						<span id="chonde" class="fontsize19 col-md-10 col-sm-12 col-xs-12" style="overflow-x: hidden;">
						<?php if($parentSubject == 88) { ?>
							{de}
						<?php } else { ?>
							<?php 
							if($check == 0){
								echo "Bài ";?> {de} <?php echo " - Bài dùng thử"; ?>
							<?php }else{ ?>
								<?php echo "Bài ";?> {de}
							<?php } ?>
							
						<?php } ?>
						</span>
						<span class="pull-right col-md-2 hidden-xs hidden-sm">
							<img class="img-responsive imgwh " src="<?=BASE_SKIN_URL?>/Default/skin/nobel/Themes/Story/media/icon1.png" />
						</span>
					</div>
				</button>
					<ul class="dropdown-menu col-md-12 col-sm-12 col-xs-12" style="top:40px; max-height:350px; overflow-y: scroll;">
					
					<?php if($parentSubject == 88) {
							$dataCategoryCurrent =  $data->get('categoryCurrentObservation');
						$subjectPost 	= $parentSubject;
						$topicPost		= $subject;
						if(@$dataCategoryCurrent['child'])
						foreach($dataCategoryCurrent['child'] as $k =>$value):?>
						<li><a onclick="subject = {value[id]};document.getElementById('chonde').innerHTML = '{value[name]}';" data-de="{value[name]}" class="getdata" href="/practice/doQuestion/{value[id]}?class=5&de={value[name]}"><?php if(pzk_user_special()): ?>#{section[id]}<?php endif;?> - {value[name]}</a></li>
					<?php endforeach;
					} else { ?>
						<?php 
								$topicPost= intval(pzk_request('topic'));
								$subjectPost= $subject;
								$level = $data -> getLevel($subject);
								if($level == '1'){
									$practices = $data->getPractices($class,$subject, $check);
										for($i = 1; $i <= $practices; $i++){  ?>
											<li <?php if(pzk_request('de') == $i) echo'class="active"'; ?> ><a style="padding-left: 40px;" onclick="document.getElementById('chonde').innerHTML = '<?php echo "Bài ".$i; ?>'; de={i}; " data-de="<?php echo $i; ?>" class="getdata" href="/practice/class-5/subject-{subjectEntity.get('alias')}-{subject}/examination-{i}"><?php echo "Bài ".$i;?><?php if($check == 0){ echo " - Bài dùng thử"; }?></a></li>
									<?php } //end for
								}elseif($level == '2'){
									$topics= $data->getTopics($subject, $check);
									
										foreach ($topics as $topic) {
											echo '<li class="left20" style="color:#d9534f"><h5><strong>';?><?php if(pzk_user_special()): ?>#{topic[id]}<?php endif;?> - <?php echo $topic['name'].'</strong></h5>';
											$practices = $data->getPractices($class,$topic['id'], $check);
											for($i = 1; $i <= $practices; $i++){  ?>
												<li <?php if(pzk_request('topic') == $topic['id'] && pzk_request('de') == $i) echo'class="active"'; ?> ><a style="padding-left: 40px;" onclick="document.getElementById('chonde').innerHTML = '<?php echo "Bài ".$i; ?>'; de={i}; " data-de="<?php echo $i; ?>" class="getdata" href="/practice/class-5/subject-{subjectEntity.get('alias')}-{subject}/topic-{topic[alias]}-{topic[id]}/examination-{i}"><?php echo "Bài ".$i;?><?php if($check == 0){ echo " - Bài dùng thử"; }?></a></li>
											<?php } //end for
										} 
								}elseif ($level == '3') {
									$sections= $data->getTopics($subject, $check);
									foreach ($sections as $section) {
										echo '<li class="left10'.(@$section['trial'] ? ' trial-3-level-1': '').'" style="color:#2696c4"><h5><strong>';?><?php if(pzk_user_special()): ?>#{section[id]}<?php endif;?> - <?php echo $section['name'].'</strong></h5>';
										$topicChilds= $data->getTopics($section['id'], $check);
										if(count($topicChilds) == 0) {
											$practices = $data->getPractices($class,$section['id'], $check);
											for($i = 1; $i <= $practices; $i++){  ?>
												<li <?php if(pzk_request('topic') == $section['id'] && pzk_request('de') == $i) echo'class="active"'; ?> ><a style="padding-left: 40px;" onclick="document.getElementById('chonde').innerHTML = '<?php echo "Bài ".$i; ?>'; de={i}; " data-de="<?php echo $i; ?>" class="getdata" href="/practice/class-5/subject-{subjectEntity.get('alias')}-{subject}/topic-{section[alias]}-{section[id]}/examination-{i}"><?php echo "Bài ".$i;?><?php if($check == 0){ echo " - Bài dùng thử"; }?></a></li>
											<?php 
											}
										} else {										
											foreach ($topicChilds as $topic) {
												echo '<li class="left20'.(@$topic['trial'] ? ' trial-3-level-2': '').'" style="color:#d9534f"><strong>';?><?php if(pzk_user_special()): ?>#{topic[id]}<?php endif;?> - <?php echo $topic['name'].'</strong>';
												$practices = $data->getPractices($class,$topic['id'], $check);
												for($i = 1; $i <= $practices; $i++){  ?>
													<li <?php if(pzk_request('topic') == $topic['id'] && pzk_request('de') == $i) echo'class="active"'; ?>><a style="padding-left: 40px;" onclick="document.getElementById('chonde').innerHTML = '<?php echo "Bài ".$i; ?>'; de={i}; " data-de="<?php echo $i; ?>" class="getdata" href="/practice/class-5/subject-{subjectEntity.get('alias')}-{subject}/topic-{topic[alias]}-{topic[id]}/examination-{i}"><?php echo "Bài ".$i;?><?php if($check == 0){ echo " - Bài dùng thử"; }?></a></li>
												<?php 
												} 
											}
										}
									}
								}elseif($level == '4'){
									$sections1= $data->getTopics($subject, $check);
									foreach ($sections1 as $section1) {
										echo '<li class="left10'.(@$section1['trial'] ? ' trial-4-level-1': '').'" style="color:#B6D452"><h5><strong>';?><?php if(pzk_user_special()): ?>#{section1[id]}<?php endif;?> - <?php echo $section1['name'].'</strong></h5>';
										$sections2= $data->getTopics($section1['id'], $check);
										if(count($sections2) == 0) {
											$practices = $data->getPractices($class,$section1['id'], $check);
											for($i = 1; $i <= $practices; $i++){  ?>
												<li <?php if(pzk_request('topic') == $section1['id'] && pzk_request('de') == $i) echo'class="active"'; ?>><a style="padding-left: 50px;" onclick="document.getElementById('chonde').innerHTML = '<?php echo "Bài ".$i; ?>'; de={i}; " data-de="<?php echo $i; ?>" class="getdata" href="/practice/class-5/subject-{subjectEntity.get('alias')}-{subject}/topic-{section1[alias]}-{section1[id]}/examination-{i}"><?php echo "Bài ".$i;?><?php if($check == 0){ echo " - Bài dùng thử"; }?></a></li>
											<?php 
											}
										} else {
											foreach ($sections2 as $section2) {
												echo '<li class="left20'.(@$section2['trial'] ? ' trial-4-level-2': '').'" style="color:#2696c4"><h5><strong>';?><?php if(pzk_user_special()): ?>#{section2[id]}<?php endif;?> - <?php echo $section2['name'].'</strong></h5>';
												$topicChilds= $data->getTopics($section2['id'], $check);
												if(count($topicChilds) == 0) {
													$practices = $data->getPractices($class,$section2['id'], $check);
													for($i = 1; $i <= $practices; $i++){  ?>
														<li <?php if(pzk_request('topic') == $section2['id'] && pzk_request('de') == $i) echo'class="active"'; ?>><a style="padding-left: 50px;" onclick="document.getElementById('chonde').innerHTML = '<?php echo "Bài ".$i; ?>'; de={i}; " data-de="<?php echo $i; ?>" class="getdata" href="/practice/class-5/subject-{subjectEntity.get('alias')}-{subject}/topic-{section2[alias]}-{section2[id]}/examination-{i}"><?php echo "Bài ".$i;?><?php if($check == 0){ echo " - Bài dùng thử"; }?></a></li>
													<?php 
													}
												} else {
													foreach ($topicChilds as $topic) {
														echo '<li class="'.(@$topic['trial'] ? ' trial-4-level-3': '').'" style="color:#d9534f; padding-left: 40px;"><h5><strong>';?><?php if(pzk_user_special()): ?>#{topic[id]}<?php endif;?> - <?php echo $topic['name'].'</strong></h5>';
														$practices = $data->getPractices($class,$topic['id'], $check);
														for($i = 1; $i <= $practices; $i++){  ?>
															<li <?php if(pzk_request('topic') == $topic['id'] && pzk_request('de') == $i) echo'class="active"'; ?>><a style="padding-left: 50px;" onclick="document.getElementById('chonde').innerHTML = '<?php echo "Bài ".$i; ?>'; de={i}; " data-de="<?php echo $i; ?>" class="getdata" href="/practice/class-5/subject-{subjectEntity.get('alias')}-{subject}/topic-{topic[alias]}-{topic[id]}/examination-{i}"><?php echo "Bài ".$i;?><?php if($check == 0){ echo " - Bài dùng thử"; }?></a></li>
														<?php 
														} 
													}	
												}
												
											}	
										}
										
										
									}
								}//end if 4
						} //end else
						?>		
					</ul>
			</div>
		</div>
		<div class="col-xs-3 col-md-3 bd">
			<div class="row">
				<div class="col-md-3 col-md-offset-3 col-xs-4 hidden-xs">
					<img  src="<?=BASE_SKIN_URL?>/Default/skin/nobel/Themes/Story/media/dongho.png"  class="wh40 img-responsive"/>
				</div>
				<div class="col-md-3 col-xs-4">
					<div class="col-md-3 col-xs-4">
							<h4 id="countdown" class="text-center num-time robotofont"><strong><?=$data_criteria['question_time']?></strong></h4>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="show-question-wrapper">
		<div class="row">
		<div class="col-md-1 col-xs-1"></div>
		<div class="change col-md-10 col-xs-10 bd-div bgclor">
			<div class="content">
				<form id="form_question_nn" class="question_content pd-0 form-horizontal top20" method="post">
					<?php $dataRow = $data->get('dataRow'); ?>
						<?php if($dataRow['isSort'] == 1):?>
						<div class="col-xs-12 margin-top-20">
							<?=$dataRow['content']?>
						</div>
						<div class="col-xs-12 margin-top-20 explanation hidden">
							<?=$dataRow['recommend']?>
						</div>
						<?php endif;?>
						
					<div class="col-xs-12 margin-top-20 scrollquestion">
						
						<?php 
							$i	= 1;
							$page	= 1;
							$numpage	= numPage(count($showQuestions));
						?>
						
						<fieldset id="idFieldset">  <!-- disabled="1"  -->
						<?php foreach($showQuestions as $key =>$value):?>
							<div class="step_ answer_box question_page_<?php echo $page?>">
								<?php $i++; $page=ceil($i/$data_criteria['question_limit']);?>
								
									<div class="order">Câu : <?=$key+1;?>
									<?php if(pzk_user_special()) :?><br />
									(#{value[id]})
									<?php endif; ?>
									</div>
									
									<input type="hidden" name="questions[<?=$value['id']?>]" value="<?=$value['id']?>"/>
									<input type="hidden" name="questionType[<?=$value['id']?>]" value="<?=questionTypeOjb($value['questionType'])?>"/>
									<?php 
										
										$QuestionObj 	= pzk_obj_once('Education.Question.Type.'.ucfirst(questionTypeOjb($value['questionType'])));
										$QuestionObj->set('questionId', $value['id']);
										
										$questionChoice = _db()->getEntity('Question.Choice');
										$questionChoice->setData($processQuestions[$value['id']]);
										$QuestionObj->set('question', $questionChoice);
										
										//debug($processAnswer[$value['id']]);die();
										$answerEntitys = array();
										foreach($processAnswer[$value['id']] as $val) {
												$answerEntity = _db()->getEntity('Question.Choice.Answer');
												$answerEntity->setData($val);
												$answerEntitys[] = $answerEntity;
										}
										
										$QuestionObj->set('answers', $answerEntitys);
										
										if(CACHE_MODE && CACHE_QUESTION_MODE && CACHE_ANSWER_MODE){
											$QuestionObj->set('cacheable', 'true');
										}else{
											$QuestionObj->set('cacheable', 'false');
										}
										$QuestionObj->set('index', $i-1);
										$QuestionObj->set('subject', $subject);
										$QuestionObj->set('de', $de);
										if(file_exists(BASE_DIR .($target = '/3rdparty/Filemanager/source/practice/all/' . $value['id'] . '.mp3'))) {
											$QuestionObj->set('audio', $target);
										} else {
											if(file_exists(BASE_DIR .($audio = '/3rdparty/Filemanager/source/practice/' . $subject. '/' . $de . '/' . ($i-1) . '.mp3'))) {
												$QuestionObj->set('audio', $audio);
												if(!file_exists(BASE_DIR .($target = '/3rdparty/Filemanager/source/practice/all/' . $value['id'] . '.mp3'))) {
													copy(BASE_DIR . $audio, BASE_DIR .$target);
												}
											}
											
											if(file_exists(BASE_DIR .($audio = '/3rdparty/Filemanager/source/practice/Observation/' . $subject. '/' . ($i-1) . '.mp3'))) {
												$QuestionObj->set('audio', $audio);
												if(!file_exists(BASE_DIR .($target = '/3rdparty/Filemanager/source/practice/all/' . $value['id'] . '.mp3'))) {
													copy(BASE_DIR . $audio, BASE_DIR .$target);
												}
											}
										}
										
										
										$QuestionObj->set('cacheParams', 'layout, questionId');
										$QuestionObj->display();
									?>
							</div>
						<?php endforeach;?>
						</fieldset>
						<input type = 'hidden' name='exercise_number' value = '<?=$de?>'/>
						<input type="hidden" name="category_id" value="<?=$data_criteria['category_id']?>"/>
						<input type="hidden" name="question_time" value="<?=$data_criteria['question_time']?>"/>
						
						<input type="hidden" id="start_time" name="start_time" value="<?=$_SERVER['REQUEST_TIME'];?>" />
							<input type="hidden" id="during_time" name="during_time" value="" />
						
						
						
					</div>
					
					<!--<div class="page-view">
						<nav>
							<ul class="pagination pull-right">
								
								<li class="li_page curent_0">
									<a href="javascript:void(0)" onclick="current_page(1)" aria-label="Previous">
										<span aria-hidden="true">&laquo;</span>
									</a>
								</li>
								
								<?php for($page_i = 1; $page_i <= $numpage; $page_i ++):?>
								<li class="li_page curent_<?=$page_i?>"><a href="javascript:void(0)" onclick="current_page(<?=$page_i?>)"><?=$page_i?></a></li>
								<?php endfor;?>
								
								<li class="li_page curent_<?=$numpage?>">
									<a href="javascript:void(0)" onclick="current_page(<?=$numpage?>)" aria-label="Next">
										<span aria-hidden="true">&raquo;</span>
									</a>
								</li>
								
							</ul>
						</nav>
					</div> -->
					<div class="fix_da">
						
							<button id="finish-choice" class="btn btn-primary" name="finish-choice" onclick="finish_choice();" type="button">
								Hoàn thành 
							</button>
							<button id="view-result" class="btn btn-success" data-toggle="modal" data-target="#exampleModal" name="view-result" type="button" style="display:none;">
								Xem kết quả 
							</button>
							<button id="show-answers" class="btn btn-danger" name="show-answers" onclick="show_answers();" type="button" style="display:none;">
								Xem đáp án 
							</button>
						
					</div>
				</form>
				</div>
		</div>

			<!-- Modal popover view-result -->
			<div class="modal fade" role="dialog" id="exampleModal" aria-labelledby="gridSystemModalLabel" aria-hidden="true">
				<div class="modal-dialog">
					<div class="modal-content">
						<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
							<h3 class="modal-title text-center title-blue" id="gridSystemModalLabel"><b>Kết quả bài làm</b></h3>
						</div>
						
						<div class="modal-body">
							<div class="row">
								<div class="col-xs-12 title-blue">
									<div class="col-xs-8 question_true control-label">Số câu trả lời đúng </div> <div class="col-xs-4 num_true title-blue"></div>
								</div>
								<div class="col-xs-12 title-red">
									<div class="col-xs-8 question_false control-label">Số câu trả lời sai </div> <div class="col-xs-4 num_false title-red"></div>
								</div>
								<div class="col-xs-12" style="color: #F0AD4E">
									<div class="col-xs-8 question_total control-label">Tổng số câu </div> <div class="col-xs-4 num_total"><?=$data_criteria['question_limit']?></div>
								</div>
							</div>
						</div>
						<div class="modal-footer">
							<button type="button" class="btn btn-sm btn-danger pull-left" onclick="window.location='/?class={class}'"> Chọn luyện tập các môn khác <span class="glyphicon glyphicon-arrow-left"></span></button>
							<button id="show-answers-on-dialog" class="btn btn-danger" name="show-answers" onclick="show_answers(); $('#exampleModal').modal('hide');" type="button">
								Xem đáp án 
							</button>
							<button type="button" class="btn btn-sm btn-success pull-right" onclick="window.location = '/practice/detail/{subject}?class={class}&de=1'"><span class="glyphicon glyphicon-arrow-right"></span> Làm bài khác</button>
						</div>
					</div>
				</div>
			</div>
		<div class="col-md-1 col-xs-1"></div>
		</div>
		
	</div>
	</div>
</div>

<!-- End Modal popover view-result -->

<script>
	
	var formdata;
	
    function finish_choice(){
        
		var time_real = $('.num-time').text().split(":");
		
		var start_time = <?=$data_criteria['question_time'];?>;
		
		var during_time = parseInt(start_time)*60 - (parseInt(time_real[0])*60 + parseInt(time_real[1]));
		
		$('#during_time').val(during_time);
		
    	formdata = $('#form_question_nn').serializeForm();
    	$('#idFieldset input').prop( "disabled", true );
    	$('#finish-choice').prop( "disabled", true );
    	get_answers();
    	save_question();
    	return formdata;
    }


    function save_question(){
        
    	if(formdata	==	null){
      		alert('Click hoàn thành để xem đáp án !');
      	}else{
      		$.ajax({
	          	type: "Post",
		        data:{
		          	answers:formdata,
					keybook:"<?=$data_criteria['keybook']?>"
		        },
		        url:'<?=BASE_REQUEST?>/home/saveQuestion'
	        });
      	}
    }

	function get_answers(){
			
	       	if(formdata	==	null){
	      		alert('Click hoàn thành để xem đáp án !');
	      	}else{
	      		$.ajax({
		          	type: "Post",
			        data:{
			          	answers:formdata,
			        },
			        url:'<?=BASE_REQUEST?>/Ngonngu/showAnswersChoice',
					async: false,
			        success: function(results){
			         	var data = $.parseJSON(results);
			         	
			           	$('.num_true').text(data.total);
			           	var question_total = <?=$data_criteria['question_limit']?>;
			           	var num_false = question_total - data.total;
			           	$('.num_false').text(num_false);
			      	}
		        });
	      		$('#view-result').show();
				$('#show-answers').show();
		     	$('#exampleModal').modal('show');
	      	}
	   	}
    
    show_answers_showed = false;
	function show_answers(){
        if(show_answers_showed) return false;
		show_answers_showed = true;
       	if(formdata	==	null){
      		alert('Click hoàn thành để xem đáp án !');
      	}else{
      		$.ajax({
	          	type: "Post",
		        data:{
		          	answers:formdata,
		        },
		        url:'<?=BASE_REQUEST?>/Ngonngu/showAnswersChoice',
		        success: function(results){
		         	var data = $.parseJSON(results);
		         	var input_value_fill = '';
		           	$.each(data, function(i, item) {
			           	
		           		$('.answers_'+item.questionId+'_'+item.value).css('color', '#3e9e00');
		           		$('.answers_'+item.questionId+'_'+item.value).css('font-weight', 'bold');
		           		$('.answers_'+item.questionId+'_'+item.value).append('<span class="has-success glyphicon glyphicon-ok"></span>');
		           		
						if(item.superType =='fill' || item.superType =='join' ){
			           		$('.answers_full_'+item.questionId).css('color', '#3e9e00');
			           		
							input_value_fill =  $('input[name^= "answers['+item.questionId+']"]').val();
							if(input_value_fill == item.value_fill){
			           			$('.answers_full_'+item.questionId).append('<span class="has-success glyphicon glyphicon-ok"></span>');
							}else{
								$('.remove-input_'+item.questionId).append('<span class="title-red glyphicon glyphicon-remove"></span>');
								$('.answers_full_'+item.questionId).append('<span class="has-success"><b>'+item.value_fill+'<b></span>');
							}
						}
		           	});

		           	$('.explanation').removeClass('hidden');
					
		           	$('.num_true').text(data.total);
		           	var question_total = <?=$data_criteria['question_limit']?>;
		           	var num_false = question_total - data.total;
		           	$('.num_false').text(num_false);
					$(".popover-content img").each(function() {
						if($(this).width() > 100) {
							$(this).addClass('img-responsive');
						}
					});

		      	}
	        });
				
	     	$('#show-answers').prop("disabled", true);
	     	$('.explanation').show();
      	}
   	}
	
	var page_i = 1;
	
	function current_page(page_i){
		
	 	$('.answer_box').removeClass('active');
	   	$('.question_page_'+page_i).addClass('active');
	   	
	   	$('.li_page').removeClass('active');
		$('.curent_'+page_i).addClass('active');
	}
	
	current_page(page_i);
	
  	/* jQuery(document).ajaxStart(function () {
   		//show ajax indicator
		ajaxindicatorstart('Trò đợi một lát !','form_question_nn');
  	}).ajaxStop(function () {
		//hide ajax indicator
		ajaxindicatorstop('form_question_nn');
  	}); */

  	var CountDown = (function ($) {
  	    // Length ms 
  	    var TimeOut = 10000;
  	    // Interval ms
  	    var TimeGap = 1000;
  	    
  	    var CurrentTime = ( new Date() ).getTime();
  	    var EndTime = ( new Date() ).getTime() + TimeOut;
  	    
  	    var GuiTimer = $('#countdown');
  	    
  	    var Running = true;
  	    
  	    var UpdateTimer = function() {
  	        // Run till timeout
  	        if( CurrentTime + TimeGap < EndTime ) {
  	            setTimeout( UpdateTimer, TimeGap );
  	        }
  	        // Countdown if running
  	        if( Running ) {
  	            CurrentTime += TimeGap;
  	            if( CurrentTime >= EndTime ) {
  	                GuiTimer.css('color','red');

  	              	finish_choice();
  	            }
  	        }
  	        // Update Gui
  	        var Time = new Date();
  	        Time.setTime( EndTime - CurrentTime );
  	        var Minutes = Time.getMinutes();
  	        var Seconds = Time.getSeconds();
  	        
  	        GuiTimer.html( 
  	            (Minutes < 10 ? '0' : '') + Minutes 
  	            + ':' 
  	            + (Seconds < 10 ? '0' : '') + Seconds );
  	    };
  	    
  	    var Pause = function() {
  	        Running = false;
  	    };
  	    
  	    var Start = function( Timeout ) {
  	        TimeOut = Timeout;
  	        CurrentTime = ( new Date() ).getTime();
  	        EndTime = ( new Date() ).getTime() + TimeOut;
  	        UpdateTimer();
  	    };

  	    return {
  	        Pause: Pause,
  	        Start: Start
  	    };
  	})(jQuery);
  	
  	jQuery('#finish-choice').on('click',CountDown.Pause);

  	// ms
  	CountDown.Start(<?=$data_criteria['question_time']*60*1000?>);
	
</script>
<?php } else { ?>
<div class='container'>		
	<div class="col-md-10 col-xs-10 bd-div bgclor form_search_test top10 bot20 imgbg col-md-offset-1">
		<form class="form_search_test" style="margin: 15px 0px"  method="post" onsubmit="return check_select_test()">
			<div class="col-xs-12 border-question" style="z-index: 9">
				<div class="question_content pd-0 margin-top-20">
					<div class="clearfix margin-top-10">
						<div class="col-xs-12 pd-0">
							<h3 class="pd-top-15" style="width: 100%; text-align: center;">Bạn phải <a rel="<?=$_SERVER["REQUEST_URI"];?>" class="login_required" data-toggle="modal" data-target=".bs-example-modal-lg" style="cursor:pointer;">Đăng nhập</a> thì mới truy cập được</h3>
						</div>
						<div class="col-xs-5 pd-0">
							
						</div>
					</div>
					<div class="margin-top-10">
						
					</div>
				</div>
			</div>
		</form>
	</div>
</div>

<?php } ?>