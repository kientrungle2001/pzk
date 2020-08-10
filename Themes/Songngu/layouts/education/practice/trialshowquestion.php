<?php
	$showQuestions 	= $data->get('data_showQuestion');
	//shuffle($showQuestions);
	$processQuestions = array();
	$arrQuestionIds = array();
	if(count($showQuestions) > 0) {
		foreach($showQuestions as $question) {
			$processQuestions[$question['id']] = $question;
			$arrQuestionIds[] = $question['id'];
		}
		//xu li cau tra loi
		$answers = _db()->useCache(1800)
			->selectAll()
			->from('answers_question_tn')
			->where(array('in', 'question_id', $arrQuestionIds))
			->result();
		$processAnswer = array();
		foreach($answers as $val) {
			$processAnswer[$val['question_id']][] = $val;
		}	
		//debug($processAnswer);die();	
	}
	
	$check = pzk_session('checkPayment');
	$data_criteria	= $data->get('data_criteria');
	
	$category = $data->get('category');
	
	$category_id = $data->get('categoryId');
	$category_name = $data->get('categoryName');

	$class= pzk_session('lop');
	$de=pzk_request('de');
	if(pzk_request('subject')){
		$psubject = pzk_request('subject');
	}else{
		$psubject=pzk_request()->getSegment(3);
	}
	$subject=pzk_request()->getSegment(3);
	$parentSubject = 0;
	if($subject) {
		
		$subjectEntity = _db()->getTableEntity('categories')->load($subject, 1800);
		$parentSubject = $subjectEntity->get('parent');
	}
	$language = pzk_global()->get('language');
	$lang = pzk_session('language');
	$topicId = pzk_request('topic');
	$currentCate = _db()->select('*')->from('categories')->where(array('id', $topicId))->result_one();
	
	
?>
<?php $data->displayChildren('[position=public-header]') ?>	
<?php $data->displayChildren('[position=top-menu]') ?>

<div class="container hidden-xs">
	<p class="t-weight text-center btn-custom8 mgright textcl"><?php echo $class; ?> <?php echo $language['pclass'];?></p>
</div>
<div class="container top10 visible-xs">
	<p class="t-weight text-center btn-custom8 textcl"><?php echo $class; ?> <?php echo $language['pclass'];?></p>
</div>

<?php if($currentCate['trial'] == 1) { ?>

<?php if(!empty($data_criteria['category_type'])):?>
<div class="container top10 hidden-xs">
	<div class="col-md-7">
		<h3 class="text-right text-uppercase">
			<strong><?php 
				if ($lang == 'en' || $lang == 'ev'){
					echo $data_criteria['category_type_name'];
				}else{
					echo $data_criteria['category_type_name_vn'];
				}
				
				 ?>
			</strong>
		</h3>
	</div>
	
</div>
<!-- <div class="container top40 hidden-xs">
	<h2 class="title-practice text-center"><?php /*if($lang == 'en' || $lang == 'ev'){
	echo $data_criteria['category_type_name']; }else{
	echo $data_criteria['category_type_name_vn'];	
	} */?></h2>
</div> -->
<div class="container visible-xs">
	<h2 class="title-practice text-center text-uppercase"><?php if($lang == 'en' || $lang == 'ev'){
	echo $data_criteria['category_type_name']; }else{
	echo $data_criteria['category_type_name_vn'];	
	} ?></h2>
</div>
<?php else:?>
<div class=" container top40">
	<h2 class="title-practice text-center"><strong><?php 
		if ($lang == 'en' || $lang == 'ev'){
			echo $category_name['name_en'];
		}else{
			echo $category_name['name_vn'];
		} ?>
	</strong></h2>
</div>
<?php endif; ?>
<div class="container">
	<div class="row form-group view_practice margin-top-20">	
		<div class="col-md-10 col-md-offset-1 col-sm-10 col-sm-offset-1 col-xs-12 text-center">
			<?php $data->displayChildren('[position=choice]') ?>
			<div class="dropdown col-md-4 col-sm-4 col-xs-12 mgleft pd0 mg0">
				<button class="btn fix_hover btn-default dropdown-toggle col-md-12 col-sm-12 col-xs-12 sharp" type="button" data-toggle="dropdown">
					<div class="row">
						<span id="chonde" class="fontsize19 col-md-10 col-sm-12 col-xs-12" style="overflow-x: hidden;">
						<?php if($psubject == 88) { ?>
							<?php echo $de ?>
						<?php } else { ?>
							<?php 
							if($check == 0){ ?>
								<?php echo $language['trialpractice']; ?>
							<?php }else{ ?>
								<?php echo $language['lesson'];?> <?php echo $de ?>
							<?php } ?>
							
						<?php } ?>
						</span>
						<span class="pull-right col-md-2 hidden-xs hidden-sm">
							<img class="img-responsive imgwh " src="<?=BASE_SKIN_URL?>/Default/skin/nobel/Themes/Story/media/icon1.png" />
						</span>
					</div>
				</button>
					<ul class="dropdown-menu col-md-12 col-sm-12 col-xs-12 list-group" style="top:40px; max-height:350px; overflow-y: scroll;">
					<?php if($psubject == 88) {
						$dataCategoryCurrent =  $data->get('categoryCurrentObservation');
						$subjectPost 	= $psubject;
						$topicPost= $subject;
						if(@$dataCategoryCurrent['child'])
						foreach($dataCategoryCurrent['child'] as $k =>$value):
						if(strpos($value['classes'], $class) === false) continue;
						?>
						<li  class="list-group-item <?php if(pzk_request('topic') == $value['id']) echo 'active' ;?>"><a onclick="subject = <?php echo @$value['id']?>;document.getElementById('chonde').innerHTML = '<?php echo @$value['name']?>'; return check_display(<?php echo @$value['trial']?>);" data-de="<?php echo @$value['name']?>" class="getdata" href="/practice/doQuestion/<?php echo @$value['id']?>?subject=<?php echo $psubject ?>&class=<?php echo $class ?>&de=<?php echo @$value['name']?>"><?php echo @$value['name']?></a></li>
					<?php endforeach;
					} else { ?>
						<?php 
								$topicPost= pzk_request('topic');
								$subjectPost= $subject;
								$level = $data -> getLevel($subject);
								if($level == '1'){
									$catetype = $data -> getCatetype($subject);
									$practices = $data->getPracticesSN($class,$subject);
									for($i = 1; $i <= $practices; $i++){  ?>
										<li class="list-group-item <?php if(pzk_request('de') == $i) echo 'active'; ?>"><a style="padding-left: 40px;" onclick="document.getElementById('chonde').innerHTML = '<?php echo $language['lesson'].$i; ?>'; de=<?php echo $i ?>; return check_display(<?php echo @$catetype['trial']?>);" data-de="<?php echo $i; ?>" class="getdata" href="/practice/class-<?php echo $class ?>/subject-<?php echo $subjectEntity->get('alias')?>-<?php echo $subject ?>/examination-<?php echo $i ?>"><?php echo $language['lesson'].$i;?></a></li>
									<?php } //end for
								}elseif($level == '2'){
									$topics= $data->getTopicsSN($subject, $class);								
									foreach ($topics as $topic) {
										echo '<li class="left20" style="color:#d9534f;cursor: pointer;" onclick="$(\'.exercise-of-topic-'.$topic['id'].'\').toggle();"  onmouseover="$(this).css(\'border-bottom\', \'1px solid #333\');" onmouseout="$(this).css(\'border-bottom\', \'none\');"><h5><strong>'.(pzk_user_special()? '#' . $topic['id'] . ' ':'').$topic['name'].'</strong><span class="glyphicon glyphicon-play-circle" style="float: right;"></span></h5></li>';
										$practices = $data->getPracticesSN($class,$topic['id']);
										for($i = 1; $i <= $practices; $i++){  ?>
											<li class="list-group-item exercise-of-topic-<?php echo @$topic['id']?> <?php if(pzk_request('topic') == $topic['id'] && pzk_request('de') == $i) echo 'active'; ?>" style="<?php if(pzk_request('topic') != $topic['id']):?>display: none;<?php endif;?>" ><a style="padding-left: 40px;" onclick="document.getElementById('chonde').innerHTML = '<?php echo $language['lesson'].$i; ?>'; de=<?php echo $i ?>; return check_display(<?php echo @$topic['trial']?>);" data-de="<?php echo $i; ?>" class="getdata" href="/practice/class-<?php echo $class ?>/subject-<?php echo $subjectEntity->get('alias')?>-<?php echo $subject ?>/topic-<?php echo @$topic['alias']?>-<?php echo @$topic['id']?>/examination-<?php echo $i ?>"><?php echo $language['lesson'].$i;?></a></li>
										<?php } //end for
									} //end foreach
								}elseif ($level == '3') {
									$sections= $data->getTopicsSN($subject, $class);
									foreach ($sections as $section) {
										echo '<li class="left10'.(@$section['trial'] ? ' trial-3-level-1': '').'" style="color:#2696c4;cursor: pointer;" onclick="$(\'.exercise-of-topic-'.$section['id'].'\').toggle();" onmouseover="$(this).css(\'border-bottom\', \'1px solid #333\');" onmouseout="$(this).css(\'border-bottom\', \'none\');"><h5><strong>'.(pzk_user_special()? '#' . $section['id'] . ' ':'').$section['name'].'</strong><span class="glyphicon glyphicon-play-circle" style="float: right;"></span></h5></li>';
										$topicChilds= $data->getTopicsSN($section['id'], $class);
										if(count($topicChilds) == 0) {
											$practices = $data->getPracticesSN($class,$section['id']);
											for($i = 1; $i <= $practices; $i++){  ?>
												<li class="list-group-item exercise-of-topic-<?php echo @$section['id']?> <?php if(pzk_request('topic')==$section['id'] && pzk_request('de') == $i) echo 'active'; ?>" style="<?php if(!@$section['trial'] && pzk_request('topic')!=$section['id']):?>display: none;<?php endif;?>"><a style="padding-left: 40px;" onclick="document.getElementById('chonde').innerHTML = '<?php echo $language['lesson'].$i; ?>'; de=<?php echo $i ?>; return check_display(<?php echo @$section['trial']?>);" data-de="<?php echo $i; ?>" class="getdata" href="/practice/class-<?php echo $class ?>/subject-<?php echo $subjectEntity->get('alias')?>-<?php echo $subject ?>/topic-<?php echo @$section['alias']?>-<?php echo @$section['id']?>/examination-<?php echo $i ?>"><?php echo $language['lesson'].$i;?></a></li>
											<?php 
											}
										} else {										
											foreach ($topicChilds as $topic) {
												echo '<li class="left20'.(@$topic['trial'] ? ' trial-3-level-2': '').'" style="color:#d9534f;cursor: pointer;" onclick="$(\'.exercise-of-topic-'.$topic['id'].'\').toggle();" onmouseover="$(this).css(\'border-bottom\', \'1px solid #333\');" onmouseout="$(this).css(\'border-bottom\', \'none\');"><strong>'.(pzk_user_special()? '#' . $topic['id'] . ' ':'').$topic['name'].'</strong><span class="glyphicon glyphicon-play-circle" style="float: right;"></span></li>';

												$practices = $data->getPractices($class,$topic['id'], $check);
												//$practices = $data->getPractices($class,$topic['id']);
												//$practices = $data->getPracticesSN($class,$topic['id']);

												for($i = 1; $i <= $practices; $i++){  ?>
													<li class="list-group-item exercise-of-topic-<?php echo @$topic['id']?> <?php if(pzk_request('topic')==$topic['id'] && pzk_request('de') == $i) echo'active'; ?>" style="<?php if(!@$topic['trial'] && pzk_request('topic')!=$topic['id']):?>display: none;<?php endif;?>"><a style="padding-left: 40px;" onclick="document.getElementById('chonde').innerHTML = '<?php echo $language['lesson'].$i; ?>'; de=<?php echo $i ?>; return check_display(<?php echo @$topic['trial']?>);" data-de="<?php echo $i; ?>" class="getdata" href="/practice/class-<?php echo $class ?>/subject-<?php echo $subjectEntity->get('alias')?>-<?php echo $subject ?>/topic-<?php echo @$topic['alias']?>-<?php echo @$topic['id']?>/examination-<?php echo $i ?>"><?php echo $language['lesson'].$i;?></a></li>
												<?php 
												} 
											}
										}
									}
								}elseif($level == '4'){
									$sections1= $data->getTopicsSN($subject, $class);
									foreach ($sections1 as $section1) {
										echo '<li class="left10'.(@$section1['trial'] ? ' trial-4-level-1': '').'" style="color:#B6D452"><h5><strong>'.(pzk_user_special()? '#' . $section1['id'] . ' ':'').$section1['name'].'</strong></h5></li>';
										$sections2= $data->getTopicsSN($section1['id'], $class);
										if(count($sections2) == 0) {
											$practices = $data->getPracticesSN($class,$section1['id']);
											for($i = 1; $i <= $practices; $i++){  ?>
												<li class="list-group-item exercise-of-topic-<?php echo @$section1['id']?> <?php if(pzk_request('topic')==$section1['id'] && pzk_request('de') == $i) echo 'active'; ?>" style="<?php if(!@$section1['trial'] && pzk_request('topic')!=$section1['id']):?>display: none;<?php endif;?>"><a style="padding-left: 50px;" onclick="document.getElementById('chonde').innerHTML = '<?php echo $language['lesson'].$i; ?>'; de=<?php echo $i ?>; return check_display(<?php echo @$section1['trial']?>);" data-de="<?php echo $i; ?>" class="getdata" href="/practice/class-<?php echo $class ?>/subject-<?php echo $subjectEntity->get('alias')?>-<?php echo $subject ?>/topic-<?php echo @$section1['alias']?>-<?php echo @$section1['id']?>/examination-<?php echo $i ?>"><?php echo $language['lesson'].$i;?></a></li>
											<?php 
											}
										} else {
											foreach ($sections2 as $section2) {
												echo '<li onclick="$(\'.exercise-of-topic-'.$section2['id'].'\').toggle();" onmouseover="$(this).css(\'border-bottom\', \'1px solid #333\');" onmouseout="$(this).css(\'border-bottom\', \'none\');" class="left20'.(@$section2['trial'] ? ' trial-4-level-2': '').'" style="color:#2696c4;cursor: pointer;"><h5><strong>'. (pzk_user_special()? '#' . $section2['id'] . ' ':'') .$section2['name'].'</strong><span class="glyphicon glyphicon-play-circle" style="float: right;"></span></h5>';
												$topicChilds= $data->getTopicsSN($section2['id'], $class);
												if(count($topicChilds) == 0) {
													$practices = $data->getPracticesSN($class,$section2['id']);
													for($i = 1; $i <= $practices; $i++){  ?>
														<li class="list-group-item exercise-of-topic-<?php echo @$section2['id']?> <?php if(pzk_request('topic')==$section2['id'] && pzk_request('de') == $i) echo 'active'; ?>" style="<?php if(!@$section2['trial'] && pzk_request('topic')!=$section2['id']):?>display: none;<?php endif;?>"><a style="padding-left: 50px;" onclick="document.getElementById('chonde').innerHTML = '<?php echo $language['lesson'].$i; ?>'; de=<?php echo $i ?>; return check_display(<?php echo @$section2['trial']?>);" data-de="<?php echo $i; ?>" class="getdata" href="/practice/class-<?php echo $class ?>/subject-<?php echo $subjectEntity->get('alias')?>-<?php echo $subject ?>/topic-<?php echo @$section2['alias']?>-<?php echo @$section2['id']?>/examination-<?php echo $i ?>"><?php echo $language['lesson'].$i;?></a></li>
													<?php 
													}
												} else {
													foreach ($topicChilds as $topic) {
														echo '<li onclick="$(\'.exercise-of-topic-'.$topic['id'].'\').toggle();" class="'.(@$topic['trial'] ? ' trial-4-level-3': '').'" style="color:#d9534f; padding-left: 40px;cursor: pointer;" onmouseover="$(this).css(\'border-bottom\', \'1px solid #333\');" onmouseout="$(this).css(\'border-bottom\', \'none\');"><h5><strong>'.(pzk_user_special()? '#' . $topic['id'] . ' ':'' ).$topic['name'].'</strong><span class="glyphicon glyphicon-play-circle" style="float: right;"></span></h5></li>';
														$practices = $data->getPracticesSN($class,$topic['id']);
														for($i = 1; $i <= $practices; $i++){  ?>
															<li class="list-group-item exercise-of-topic-<?php echo @$topic['id']?> <?php if(pzk_request('topic')==$topic['id'] && pzk_request('de') == $i) echo'active'; ?>" style="<?php if(pzk_request('topic')!=$topic['id']):?>display: none;<?php endif;?>"><a style="padding-left: 50px;" onclick="document.getElementById('chonde').innerHTML = '<?php echo $language['lesson'].$i; ?>'; de=<?php echo $i ?>; return check_display(<?php echo @$topic['trial']?>);" data-de="<?php echo $i; ?>" class="getdata" href="/practice/class-<?php echo $class ?>/subject-<?php echo $subjectEntity->get('alias')?>-<?php echo $subject ?>/topic-<?php echo @$topic['alias']?>-<?php echo @$topic['id']?>/examination-<?php echo $i ?>"><?php echo $language['lesson'].$i;?></a></li>
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
			<div class="col-xs-12 col-md-4 col-sm-2 bd pull-right mgleft">
				<div class="row text-center">
					<div class="col-md-3 hidden-xs hidden-sm">
						<img  src="<?=BASE_SKIN_URL?>/Default/skin/nobel/Themes/Story/media/dongho.png"  class="wh40 img-responsive"/>
					</div>
					<div class="col-md-9 col-sm-9 col-xs-12">
						<h4 id="countdown" class="num-time robotofont"><strong><?=$data_criteria['question_time']?></strong></h4>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="row">
		<div class="change col-md-10 col-md-offset-1 col-sm-10 col-sm-offset-1 col-xs-12 bd-div bgclor">
			<div class="content">
				
				<form id="form_question_nn" class="question_content pd-0 form-horizontal top20" method="post">
				<div class="col-xs-12">
				<?php $dataRow = $data->get('dataRow');?>
				<?php if($dataRow['isSort'] == 1):?>
				<div class="col-xs-12 margin-top-20">
					<?=$dataRow['content']?>
				</div>
				<div class="col-xs-12 margin-top-20 explanation hidden">
					<?=$dataRow['recommend']?>
				</div>
				<?php endif;?>
				</div>		
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
							
								<div class="order"><?php echo $language['question'];?> <?=$key+1;?>
								<?php if(pzk_user_special()) :?><br />
								(#<?php echo @$value['id']?>)
								<?php endif; ?>
								</div>
								
								<input type="hidden" name="questions[<?=$value['id']?>]" value="<?=$value['id']?>"/>
								<input type="hidden" name="questionType[<?=$value['id']?>]" value="<?=questionTypeOjb($value['questionType'])?>"/>
								<?php 
									
									$QuestionObj = pzk_obj_once('Education.Question.Type.'.ucfirst(questionTypeOjb($value['questionType'])));
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
									$QuestionObj->set('index',$i-1);
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
			</form>
				<div class="fix_da hidden-xs">				
					<button id="finish-choice" class="btn btn-primary <?php if(pzk_session('adminClassname') && pzk_session('adminLevel')== 'Monitor'){ echo "hidden" ; } ?>" name="finish-choice" onclick="finish_choice();"><span class="glyphicon glyphicon-ok"></span>
						<?php echo $language['finish'];?>
					</button>
					<button id="view-result" class="btn btn-success" data-toggle="modal" data-target="#exampleModal" name="view-result" style="display:none;"><span class="glyphicon glyphicon-list-alt"></span>
						<?php echo $language['score'];?>
					</button>
					<button id="show-answers" class="btn btn-danger <?php if(pzk_session('servicePackage') == 'classroom' && pzk_session('checkUser') == 1 && pzk_session('checkSchool') == 1){
						$topicId = pzk_request('topic');
						$exercise_number = pzk_request('de');
						$schedule  = _db()->getEntity('User.Account.Teacher');
						$time = $schedule->checkTime($subject, $topicId, $exercise_number);
						$now = date("d-m-Y H:i:s");
						if((strtotime($now) < strtotime($time)) || !$time){
							echo 'disabled';
						}
					} 
					?>" name="show-answers" onclick="show_answers();" style="display:none;"><span class="glyphicon glyphicon-check"></span>
					<?php echo $language['result'];?>
					</button>
				</div>
				<div class="visible-xs bot20">				
					
					<button id="finish-choice-mb" class="btn btn-primary <?php if(pzk_session('adminClassname')){ echo "hidden" ; } ?> col-xs-12 top10 bot20" name="finish-choice-mb" onclick="finish_choice();">
						<?php echo $language['finish'];?>
					</button>
					<button id="view-result-mb" class="btn btn-success col-xs-12 bot20" data-toggle="modal" data-target="#exampleModal" name="view-result-mb" style="display:none;">
						<?php echo $language['score'];?>
					</button>
					<button id="show-answers-mb" class="btn btn-danger col-xs-12 bot20 <?php if(pzk_session('servicePackage') == 'classroom' && pzk_session('checkUser') == 1 && pzk_session('checkSchool') == 1){
								$topicId = pzk_request('topic');
								$exercise_number = pzk_request('de');
								$schedule  = _db()->getEntity('User.Account.Teacher');
								$time = $schedule->checkTime($subject, $topicId, $exercise_number);
								$now = date("d-m-Y H:i:s");
								if((strtotime($now) < strtotime($time)) || !$time){
									echo 'disabled';
								}
							} 
							?>" name="show-answers-mb" onclick="show_answers();" style="display:none;">
						<?php echo $language['result'];?>
					</button>
				</div>
			</div>
		</div>
		
		<!-- Modal popover view-result -->
		<div class="modal fade" role="dialog" id="exampleModal" aria-labelledby="gridSystemModalLabel" aria-hidden="true">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						<h3 class="modal-title text-center title-blue" id="gridSystemModalLabel"><b><?php echo $language['final'];?></b></h3>
					</div>
					
					<div class="modal-body">
						<div class="row">
							<div class="col-xs-12 title-blue">
								<div class="col-xs-8 question_true control-label"><?php echo $language['correct'];?> </div> <div class="col-xs-4 num_true title-blue"></div>
							</div>
							<div class="col-xs-12 title-red">
								<div class="col-xs-8 question_false control-label"><?php echo $language['wrong'];?> </div> <div class="col-xs-4 num_false title-red"></div>
							</div>
							<div class="col-xs-12" style="color: #F0AD4E">
								<div class="col-xs-8 question_total control-label"><?php echo $language['total'];?> </div> <div class="col-xs-4 num_total"><?=$data_criteria['question_limit']?></div>
							</div>
						</div>
					</div>
					<div class="modal-footer">
						<div class="col-md-10 col-md-offset-2 col-sm-10 col-sm-offset-2 col-xs-12">
							<button class="btn btn-sm btn-danger col-md-4 col-sm-4 col-xs-12 top10" onclick="window.location='/?class=<?php echo $class ?>'"> <?php echo $language['other-subject'];?> <span class="glyphicon glyphicon-arrow-left hidden-xs"></span></button>
							<button id="show-answers-on-dialog" class="btn btn-sm btn-danger col-md-3 col-sm-3 col-xs-12 top10 <?php if(pzk_session('servicePackage') == 'classroom' && pzk_session('checkUser') == 1 && pzk_session('checkSchool') == 1){
								$topicId = pzk_request('topic');
								$exercise_number = pzk_request('de');
								$schedule  = _db()->getEntity('User.Account.Teacher');
								$time = $schedule->checkTime($subject, $topicId, $exercise_number);
								$now = date("Y-m-d H:i:s");
								if((strtotime($now) < strtotime($time)) || !$time){
									echo 'disabled';
								}
							} 
							?>" name="show-answers" onclick="show_answers(); $('#exampleModal').modal('hide');" type="button"><span class="glyphicon glyphicon-check"></span>
								<?php echo $language['result'];?>
							</button>
							<button type="button" class="btn btn-sm btn-success col-md-3 col-sm-3 col-xs-12 top10" onclick="window.location = '/practice/detail/<?php echo $subject ?>?class=<?php echo $class ?>&de=1'"><span class="glyphicon glyphicon-arrow-right hidden-xs"></span> <?php echo $language['other-exam'];?></button>
							<div class="row">
							</div>
						</div>
					</div>
				</div>
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
		$('#finish-choice-mb').prop( "disabled", true );
    	get_answers();
    	return formdata;
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
				$('#view-result-mb').show();
				$('#show-answers-mb').show();
		     	$('#exampleModal-mb').modal('show');
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
			$('#show-answers-mb').prop("disabled", true);
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
	var check = '<?php echo $check ?>';
	var checkLogin = '<?php $userId = pzk_session('userId'); echo $userId;?>';
	function check_display(trial){
		if(check == 1 || trial == 1){
			return true;
		}else{
			alert('Bạn cần mua tài khoản để sử dụng nội dung này !');
			return false;
		}
	};
	
	function show_question_answer(questionId){
		$.ajax({
	          	type: "Post",
		        data:{
		          	questionId:questionId,
		        },
		        url:'<?=BASE_REQUEST?>/practice/showAnswersTeacher',
		        success: function(results){
		         	var item = $.parseJSON(results);
		         	var input_value_fill = '';
			           	
		           		$('.answers_'+item.question_id+'_'+item.id).css('color', '#3e9e00');
		           		$('.answers_'+item.question_id+'_'+item.id).css('font-weight', 'bold');
		           		$('.answers_'+item.question_id+'_'+item.id).append('<span class="has-success glyphicon glyphicon-ok"></span>');
		      

		           	$('.explanation_teacher_'+item.question_id).removeClass('hidden');
		      	}
	        });
	}
	
</script>
<?php } else { ?>
<div class="container">
	<div class="text-center alert alert-danger">
		Bạn phải mua tài khoản mới xem được nội dung này!
	</div>
</div>
<?php } ?>