<?php
	$Start = microtime(true);
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
	$de= clean_value(pzk_request('de'));
	if(pzk_request('subject')){
		$psubject = intval(pzk_request('subject'));
	}else{
		$psubject= intval(pzk_request()->getSegment(3));
	}
	$subject= intval(pzk_request()->getSegment(3));
	$parentSubject = 0;
	if($subject) {
		
		$subjectEntity = _db()->getTableEntity('categories')->load($subject, 1800);
		$parentSubject = $subjectEntity->get('parent');
	}
	$language = pzk_global()->get('language');
	$lang = pzk_session('language');
	
?>

<?php if(pzk_session('login')) { ?>




<div class="container-fluid bgcontent">

<div class="container">
	
	<div class="row">
		<div class="col-md-3 left-navigation hidden-xs col-xs-12">
			<div class="item">
				<img src="/Themes/Songngu3/skin/images/na-left.png" class="item"/>
				<div class="item na-left" type="button" data-toggle="dropdown" data-bind="enable: !noResults()" aria-haspopup="true" aria-expanded="true">
				
					<img src="/Themes/Songngu3/skin/images/na-star.png" />
					<span id="chontu" class="fontsize19"><?php echo $language['vocabulary'];?></span>
				</div>
				<?php $data->displayChildren('[position=choice]') ?>
			</div>
			
			<div class="item ">
				<div class="item tree">
					
					<img class="absolute right-30" src="/Themes/Songngu3/skin/images/tree.png" />
				</div>
				
				<div class="item baitap">
					<img src="/Themes/Songngu3/skin/images/na-star.png" />
					<span id="chontu" class="fontsize19"><?php echo $language['choice'];?></span>
				</div>
			
				<ul class="item menu-baitap list-group">
					<?php if($psubject == 88) {
						$dataCategoryCurrent =  $data->get('categoryCurrentObservation');
						$subjectPost 	= $psubject;
						$topicPost= $subject;
						if(@$dataCategoryCurrent['child'])
						foreach($dataCategoryCurrent['child'] as $k =>$value):
						if(strpos($value['classes'], ''.$class) === false) continue;
						if(!$lang || $lang == 'vn'){
							$name_psubject = $value['name'];
						}else{
							$name_psubject = $value['name_en'];
						}
						
						
						?>
						<li  class="list-group-item hasa <?php if($subject == $value['id']) echo 'active' ;?>"><a onclick="subject = <?php echo @$value['id']?>; return check_display(<?php echo @$value['trial']?>);" data-de="<?php echo $name_psubject ?>" class="getdata" href="/practice/doQuestion/<?php echo @$value['id']?>?subject=<?php echo $psubject ?>&class=<?php echo $class ?>&de=<?php echo $name_psubject ?>"><?php echo $name_psubject ?></a></li>
					<?php endforeach;
					} else { ?>
						<?php 
								$topicPost= intval(pzk_request('topic'));
								$subjectPost= $subject;
								$level = $data -> getLevel($subject);
								//echo $level;
								if($level == '1'){
									$catetype = $data -> getCatetype($subject);
									$practices = $data->getPracticesSN($class,$subject);
									$medias		=	$data->getMedias($subject);
									foreach($medias as $media) {  ?>
										<li class="list-group-item hasa <?php if(pzk_request('de') == $i) echo 'active'; ?>"><a onclick="return check_display(<?php echo @$media['trial']?>);"class="getdata" href="/practice/class-<?php echo $class ?>/subject-<?php echo $subjectEntity->get('alias')?>-<?php echo $subject ?>/media-<?php echo @$media['id']?>"><?php echo @$media['name']?></a></li>
							<?php	}
									for($i = 1; $i <= $practices; $i++){  ?>
										<li class="list-group-item hasa <?php if(pzk_request('de') == $i) echo 'active'; ?>"><a  onclick="de=<?php echo $i ?>; return check_display(<?php echo @$catetype['trial']?>);" data-de="<?php echo $i; ?>" class="getdata" href="/practice/class-<?php echo $class ?>/subject-<?php echo $subjectEntity->get('alias')?>-<?php echo $subject ?>/examination-<?php echo $i ?>"><?php echo $language['lesson'].$i;?></a></li>
									<?php } //end for
								}elseif($level == '2'){
									$topics= $data->getTopicsSN($subject, $class);								
									foreach ($topics as $topic) {
										if ($lang == 'en' || $lang == 'ev'){
												if($topic['name_en']){
													$topic_name = $topic['name_en'];
												}else{
													$topic_name = $topic['name'];
												}
												
											}else{
												$topic_name = $topic['name'];
											}
										
										echo '<li style="background:white;border:none; text-align: left;" class="level2" onclick="$(\'.exercise-of-topic-'.$topic['id'].'\').toggle();"  onmouseover="$(this).css(\'border-bottom\', \'1px solid #333\');" onmouseout="$(this).css(\'border-bottom\', \'none\');"><div><strong>'.(pzk_user_special()? '#' . $topic['id'] . ' ':'').$topic_name.'</strong><img src="/Themes/Songngu3/skin/images/right-dr.png" style="float: right;"/></div></li>';
										$practices = $data->getPracticesSN($class,$topic['id']);
										
										$medias		=	$data->getMedias($topic['id']);
													foreach($medias as $media) {  ?>
														<li class="list-group-item hasa <?php if(pzk_request('topic') == $topic['id'] && pzk_request('de') == $i) echo 'active'; ?>" style="<?php if(pzk_request('topic') != $topic['id']):?>display: none;<?php endif;?>"><a  onclick="return check_display(<?php echo @$media['trial']?>);"class="getdata" href="/practice/class-<?php echo $class ?>/subject-<?php echo $subjectEntity->get('alias')?>-<?php echo $subject ?>/topic-<?php echo @$topic['alias']?>-<?php echo @$topic['id']?>/media-<?php echo @$media['id']?>"><?php echo @$media['name']?></a></li>
											<?php	}
											
										for($i = 1; $i <= $practices; $i++){  ?>
											<li class="list-group-item hasa exercise-of-topic-<?php echo @$topic['id']?> <?php if(pzk_request('topic') == $topic['id'] && pzk_request('de') == $i) echo 'active'; ?>" style="<?php if(pzk_request('topic') != $topic['id']):?>display: none;<?php endif;?>" ><a  onclick="de=<?php echo $i ?>; return check_display(<?php echo @$topic['trial']?>);" data-de="<?php echo $i; ?>" class="getdata" href="/practice/class-<?php echo $class ?>/subject-<?php echo $subjectEntity->get('alias')?>-<?php echo $subject ?>/topic-<?php echo @$topic['alias']?>-<?php echo @$topic['id']?>/examination-<?php echo $i ?>"><?php echo $language['lesson'].$i;?></a></li>
										<?php } //end for
									} //end foreach
								}elseif ($level == '3') {
									$sections= $data->getTopicsSN($subject, $class);
									foreach ($sections as $section) {
										if ($lang == 'en' || $lang == 'ev'){
												if($section['name_en']){
													$section_name = $section['name_en'];
												}else{
													$section_name = $section['name'];
												}
												
											}else{
												$section_name = $section['name'];
											}
										echo '<li class="level3'.(@$section['trial'] ? ' trial-3-level-1': '').'" style="color:#2696c4;cursor: pointer;" onclick="$(\'.exercise-of-topic-'.$section['id'].'\').toggle();" onmouseover="$(this).css(\'border-bottom\', \'1px solid #333\');" onmouseout="$(this).css(\'border-bottom\', \'none\');"><div><strong>'.(pzk_user_special()? '#' . $section['id'] . ' ':'').$section_name.'</strong></div></li>';
										$topicChilds= $data->getTopicsSN($section['id'], $class);
										if(count($topicChilds) == 0) {
											$practices = $data->getPracticesSN($class,$section['id']);
											
											
										$medias		=	$data->getMedias($section['id']);
													foreach($medias as $media) {  ?>
														<li class="list-group-item hasdot hasa exercise-of-topic-<?php echo @$section['id']?> <?php if(pzk_request('topic')==$section['id'] && pzk_request('de') == $i) echo 'active'; ?>" style="<?php if(!@$section['trial'] && pzk_request('topic')!=$section['id']):?>display: none;<?php endif;?>"><a onclick="return check_display(<?php echo @$media['trial']?>);"class="getdata" href="/practice/class-<?php echo $class ?>/subject-<?php echo $subjectEntity->get('alias')?>-<?php echo $subject ?>/topic-<?php echo @$section['alias']?>-<?php echo @$section['id']?>/media-<?php echo @$media['id']?>"><?php echo @$media['name']?></a></li>
											<?php	}
											
											for($i = 1; $i <= $practices; $i++){  ?>
												<li class="list-group-item hasa hasdot exercise-of-topic-<?php echo @$section['id']?> <?php if(pzk_request('topic')==$section['id'] && pzk_request('de') == $i) echo 'active'; ?>" style="<?php if(!@$section['trial'] && pzk_request('topic')!=$section['id']):?>display: none;<?php endif;?>"><a  onclick="de=<?php echo $i ?>; return check_display(<?php echo @$section['trial']?>);" data-de="<?php echo $i; ?>" class="getdata" href="/practice/class-<?php echo $class ?>/subject-<?php echo $subjectEntity->get('alias')?>-<?php echo $subject ?>/topic-<?php echo @$section['alias']?>-<?php echo @$section['id']?>/examination-<?php echo $i ?>"><?php echo $language['lesson'].$i;?></a></li>
											<?php 
											}
										} else {										
											foreach ($topicChilds as $topic) {
												
												if ($lang == 'en' || $lang == 'ev'){
													if($topic['name_en']){
														$topic_name = $topic['name_en'];
													}else{
														$topic_name = $topic['name'];
													}
													
												}else{
													$topic_name = $topic['name'];
												}
												
												echo '<li style="background:white;border:none; text-align: left;" class="level3-22'.(@$topic['trial'] ? ' trial-3-level-2': '').'" style="color:#d9534f;cursor: pointer;" onclick="$(\'.exercise-of-topic-'.$topic['id'].'\').toggle();" onmouseover="$(this).css(\'border-bottom\', \'1px solid #333\');" onmouseout="$(this).css(\'border-bottom\', \'none\');"><strong>'.(pzk_user_special()? '#' . $topic['id'] . ' ':'').$topic_name.'</strong><img src="/Themes/Songngu3/skin/images/right-dr.png" style="float: right;"/></li>';

												$practices = $data->getPractices($class,$topic['id'], $check);
												//$practices = $data->getPractices($class,$topic['id']);
												//$practices = $data->getPracticesSN($class,$topic['id']);
												
										$medias		=	$data->getMedias($topic['id']);
													foreach($medias as $media) {  ?>
														<li class="list-group-item  hasdot exercise-of-topic-<?php echo @$topic['id']?> <?php if(pzk_request('topic')==$topic['id'] && pzk_request('de') == $i) echo'active'; ?>" style="<?php if(!@$topic['trial'] && pzk_request('topic')!=$topic['id']):?>display: none;<?php endif;?> hasa"><a onclick="return check_display(<?php echo @$media['trial']?>);"class="getdata" href="/practice/class-<?php echo $class ?>/subject-<?php echo $subjectEntity->get('alias')?>-<?php echo $subject ?>/topic-<?php echo @$topic['alias']?>-<?php echo @$topic['id']?>/media-<?php echo @$media['id']?>"><?php echo @$media['name']?></a></li>
											<?php	}
												for($i = 1; $i <= $practices; $i++){  ?>
													<li class="list-group-item hasa hasdot exercise-of-topic-<?php echo @$topic['id']?> <?php if(pzk_request('topic')==$topic['id'] && pzk_request('de') == $i) echo'active'; ?>" style="<?php if(!@$topic['trial'] && pzk_request('topic')!=$topic['id']):?>display: none;<?php endif;?>"><a  onclick="de=<?php echo $i ?>; return check_display(<?php echo @$topic['trial']?>);" data-de="<?php echo $i; ?>" class="getdata" href="/practice/class-<?php echo $class ?>/subject-<?php echo $subjectEntity->get('alias')?>-<?php echo $subject ?>/topic-<?php echo @$topic['alias']?>-<?php echo @$topic['id']?>/examination-<?php echo $i ?>"><?php echo $language['lesson'].$i;?></a></li>
												<?php 
												} 
											}
										}
									}
								}elseif($level == '4'){
									$sections1= $data->getTopicsSN($subject, $class);
									foreach ($sections1 as $section1) {
										
										if ($lang == 'en' || $lang == 'ev'){
											if($section1['name_en']){
												$section1_name = $section1['name_en'];
											}else{
												$section1_name = $section1['name'];
											}
											
										}else{
											$section1_name = $section1['name'];
										}
										
										echo '<li class="'.(@$section1['trial'] ? ' trial-4-level-1': '').'" style="color:#B6D452"><div><strong>'.(pzk_user_special()? '#' . $section1['id'] . ' ':'').$section1_name.'</strong></div></li>';
										$sections2= $data->getTopicsSN($section1['id'], $class);
										if(count($sections2) == 0) {
											$practices = $data->getPracticesSN($class,$section1['id']);
											
										$medias		=	$data->getMedias($section1['id']);
													foreach($medias as $media) {  ?>
														<li class="list-group-item hasa hasdot  exercise-of-topic-<?php echo @$section1['id']?> <?php if(pzk_request('topic')==$section1['id'] && pzk_request('de') == $i) echo 'active'; ?>" style="<?php if(!@$section1['trial'] && pzk_request('topic')!=$section1['id']):?>display: none;<?php endif;?>"><a onclick="return check_display(<?php echo @$media['trial']?>);"class="getdata" href="/practice/class-<?php echo $class ?>/subject-<?php echo $subjectEntity->get('alias')?>-<?php echo $subject ?>/topic-<?php echo @$section1['alias']?>-<?php echo @$section1['id']?>/media-<?php echo @$media['id']?>"><?php echo @$media['name']?></a></li>
											<?php	}
											for($i = 1; $i <= $practices; $i++){  ?>
												<li class="list-group-item hasa hasdot exercise-of-topic-<?php echo @$section1['id']?> <?php if(pzk_request('topic')==$section1['id'] && pzk_request('de') == $i) echo 'active'; ?>" style="<?php if(!@$section1['trial'] && pzk_request('topic')!=$section1['id']):?>display: none;<?php endif;?>"><a  onclick="de=<?php echo $i ?>; return check_display(<?php echo @$section1['trial']?>);" data-de="<?php echo $i; ?>" class="getdata" href="/practice/class-<?php echo $class ?>/subject-<?php echo $subjectEntity->get('alias')?>-<?php echo $subject ?>/topic-<?php echo @$section1['alias']?>-<?php echo @$section1['id']?>/examination-<?php echo $i ?>"><?php echo $language['lesson'].$i;?></a></li>
											<?php 
											}
										} else {
											foreach ($sections2 as $section2) {
												
												if ($lang == 'en' || $lang == 'ev'){
													if($section2['name_en']){
														$section2_name = $section2['name_en'];
													}else{
														$section2_name = $section2['name'];
													}
													
												}else{
													$section2_name = $section2['name'];
												}
												
												echo '<li style="background:white;border:none; text-align: left;" class="level4-22" onclick="$(\'.exercise-of-topic-'.$section2['id'].'\').toggle();" onmouseover="$(this).css(\'border-bottom\', \'1px solid #333\');" onmouseout="$(this).css(\'border-bottom\', \'none\');" class="'.(@$section2['trial'] ? ' trial-4-level-2': '').'" style="color:#2696c4;cursor: pointer;"><div><strong>'. (pzk_user_special()? '#' . $section2['id'] . ' ':'') .$section2_name.'</strong><img src="/Themes/Songngu3/skin/images/right-dr.png" style="float: right;"/></div>';
												$topicChilds= $data->getTopicsSN($section2['id'], $class);
												if(count($topicChilds) == 0) {
													$practices = $data->getPracticesSN($class,$section2['id']);
													
										$medias		=	$data->getMedias($section2['id']);
													foreach($medias as $media) {  ?>
														<li class="list-group-item hasa hasdot exercise-of-topic-<?php echo @$section2['id']?> <?php if(pzk_request('topic')==$section2['id'] && pzk_request('de') == $i) echo 'active'; ?>" style="<?php if(!@$section2['trial'] && pzk_request('topic')!=$section2['id']):?>display: none;<?php endif;?>"><a  onclick="return check_display(<?php echo @$media['trial']?>);"class="getdata" href="/practice/class-<?php echo $class ?>/subject-<?php echo $subjectEntity->get('alias')?>-<?php echo $subject ?>/topic-<?php echo @$section2['alias']?>-<?php echo @$section2['id']?>/media-<?php echo @$media['id']?>"><?php echo @$media['name']?></a></li>
											<?php	}
													for($i = 1; $i <= $practices; $i++){  ?>
														<li class="list-group-item hasa hasdot exercise-of-topic-<?php echo @$section2['id']?> <?php if(pzk_request('topic')==$section2['id'] && pzk_request('de') == $i) echo 'active'; ?>" style="<?php if(!@$section2['trial'] && pzk_request('topic')!=$section2['id']):?>display: none;<?php endif;?>"><a onclick="de=<?php echo $i ?>; return check_display(<?php echo @$section2['trial']?>);" data-de="<?php echo $i; ?>" class="getdata" href="/practice/class-<?php echo $class ?>/subject-<?php echo $subjectEntity->get('alias')?>-<?php echo $subject ?>/topic-<?php echo @$section2['alias']?>-<?php echo @$section2['id']?>/examination-<?php echo $i ?>"><?php echo $language['lesson'].$i;?></a></li>
													<?php 
													}
												} else {
													foreach ($topicChilds as $topic) {
														
														if ($lang == 'en' || $lang == 'ev'){
															if($topic['name_en']){
																$topic_name = $topic['name_en'];
															}else{
																$topic_name = $topic['name'];
															}
															
														}else{
															$topic_name = $topic['name'];
														}
														
														echo '<li style="background:white; border:none; text-align: left;" onclick="$(\'.exercise-of-topic-'.$topic['id'].'\').toggle();" class="'.(@$topic['trial'] ? ' trial-4-level-3': '').'"  onmouseover="$(this).css(\'border-bottom\', \'1px solid #333\');" onmouseout="$(this).css(\'border-bottom\', \'none\');"><div><strong>'.(pzk_user_special()? '#' . $topic['id'] . ' ':'' ).$topic_name.'</strong><img src="/Themes/Songngu3/skin/images/right-dr.png" style="float: right;"/></div></li>';
														$practices = $data->getPracticesSN($class,$topic['id']);
														
										$medias		=	$data->getMedias($topic['id']);
													foreach($medias as $media) {  ?>
														<li class="list-group-item hasa hasdot exercise-of-topic-<?php echo @$topic['id']?> <?php if(pzk_request('topic')==$topic['id'] && pzk_request('de') == $i) echo'active'; ?>" style="<?php if(pzk_request('topic')!=$topic['id']):?>display: none;<?php endif;?>"><a onclick="return check_display(<?php echo @$media['trial']?>);"class="getdata" href="/practice/class-<?php echo $class ?>/subject-<?php echo $subjectEntity->get('alias')?>-<?php echo $subject ?>/topic-<?php echo @$topic['alias']?>-<?php echo @$topic['id']?>/media-<?php echo @$media['id']?>"><?php echo @$media['name']?></a></li>
											<?php	}
														for($i = 1; $i <= $practices; $i++){  ?>
															<li class="list-group-item hasa hasdot exercise-of-topic-<?php echo @$topic['id']?> <?php if(pzk_request('topic')==$topic['id'] && pzk_request('de') == $i) echo'active'; ?>" style="<?php if(pzk_request('topic')!=$topic['id']):?>display: none;<?php endif;?>"><a  onclick="de=<?php echo $i ?>; return check_display(<?php echo @$topic['trial']?>);" data-de="<?php echo $i; ?>" class="getdata" href="/practice/class-<?php echo $class ?>/subject-<?php echo $subjectEntity->get('alias')?>-<?php echo $subject ?>/topic-<?php echo @$topic['alias']?>-<?php echo @$topic['id']?>/examination-<?php echo $i ?>"><?php echo $language['lesson'].$i;?></a></li>
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
		<!--bai tap-->
		<div class="col-md-9 content-full  col-sm-12  col-xs-12">
			<div class="item fs18 top-content bold">	
			  <?php //echo 'Lớp '. $class; ?>
			  <a href="/#practice"><?php echo $language['pclass'];?></a> &nbsp; > &nbsp;
			   <a href="/practice/class-<?=$class;?>/subject-<?=$subjectEntity->get('alias');?>-<?=$subjectEntity->get('id');?>">
			  <?php if(!empty($data_criteria['category_type'])):?>

					<?php 
							if($psubject == 88){ echo $language['special88'];}else{
							if ($lang == 'en' || $lang == 'ev'){
								echo $data_criteria['category_type_name'];
							}else{
								echo $data_criteria['category_type_name_vn'];
							}}
							
					?>

				<?php else:?>
					<?php 
						if($psubject == 88){ echo $language['special88'];}else{
						if ($lang == 'en' || $lang == 'ev'){
							echo $category_name['name_en'];
						}else{
							echo $category_name['name_vn'];
						}} ?>

				<?php endif; ?>
				</a>
			</div>	
		
			
		
			<div class="content-lt change  item">
			
				<div style="margin: 15px 0px;" class="item ">
					
					
					<div class="name-detail col-md-8 col-xs-12">
						
						<?php if($psubject == 88) { ?>
							<?php echo $de ?>
						<?php } else { 
							if($check == 0){ 
								echo $language['trialpractice']; 
							}else{ 
								$topicId = intval(pzk_request('topic'));
								$topic = $data->getTopicsName($topicId, $class);
								if($lang == 'en' || $lang == 'ev'){ echo $topic['name_en']; }else{ echo $topic['name_vn']; }
								echo " - ".$language['lesson'].$de; 
							} ?>
							
						<?php } ?>
					
					</div>
					
					<div class="col-md-4 col-xs-12 pr0 relative">
						
						<div onclick="fullscreen();" style="position: absolute; right: -1px; top: -15px; z-index: 999999;" class="btn btn-primary hidden-xs">
							<i  class="fa fa-arrows-alt fa-1x" aria-hidden="true"></i>
						</div>
						
						<img style="top: 0px; right: 0px; width: 100%;" class="absolute"  src="/Themes/Songngu3/skin/images/canh.png"/>
						<div style="margin: 0px auto; margin-top: 26%;" class="time">
							<img  src="<?=BASE_SKIN_URL?>/Themes/Songngu3/skin/images/watch.png"/>
							<div id="countdown" class="num-time robotofont"><strong><?=$data_criteria['question_time']?></strong></div>
						</div>
					</div>
					
					
					
				</div>
			
				
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
						<div class="step_<?php $stt=$key+1; echo $stt; ?> question_page">
							<?php $i++; $page=ceil($i/$data_criteria['question_limit']);?>
							
								
								
								<input type="hidden" name="questions[<?=$value['id']?>]" value="<?=$value['id']?>"/>
								<input type="hidden" name="questionType[<?=$value['id']?>]" value="<?=questionTypeOjb($value['questionType'])?>"/>
								<?php 
									
									
									if($value['questionType'] == 4){
										//neu la tu luan
										$QuestionObj = pzk_obj_once('Education.Question.Type.'.ucfirst(questionTypeOjb($value['questionType'])));
										
										$QuestionObj->set('layout', 'education/question/tuluan');
										$QuestionObj->set('stt', $key+1);
										
										$questionChoice = _db()->getEntity('Question.Choice');
										$questionChoice->setData($processQuestions[$value['id']]);
										$QuestionObj->set('question', $questionChoice);
									}else{
										$QuestionObj = pzk_obj_once('Education.Question.Type.'.ucfirst(questionTypeOjb($value['questionType'])));
									
										$QuestionObj->set('questionId', $value['id']);
										$QuestionObj->set('stt', $key+1);
										
										$questionChoice = _db()->getEntity('Question.Choice');
										$questionChoice->setData($processQuestions[$value['id']]);
										$QuestionObj->set('question', $questionChoice);
										
										//debug($processAnswer[$value['id']]);die();
										$answerEntitys = array();
										if(isset($processAnswer[$value['id']]))
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
				<?php if(pzk_session('adminClassname') && pzk_session('adminLevel')== 'Monitor'){ ?>
					<style>
						.cau .volume{font-size: 40px !important;}
						.cau {font-size: 40px !important;}
						.ptnn-title{font-size: 50px !important; text-align: justify;}
						.choice{font-size: 50px !important;}
						img.latex{width: 25px;}
						.content table{font-size: 50px !important;}
						.choice table tr td input {width: 40px; height: 60px; }
						.explanation {font-size: 30px !important;}
						.fs30{font-size: 30px;}
						.top10 .btn-primary{font-size: 30px !important;}
						.explanation_teacher {font-size: 30px;}
						.order{font-size: 30px !important;}
						.mjx-math{font-size: 35px; font-weight: bold; font-family: roboto;}
					</style>
					<div class="item text-center">
					
					<div id="preStep" onclick="preSteps(this);" page="1" class="btn btn-danger fs30">Preview</div>
					<div id="nextStep" onclick="nextStep(this);" page="1" class="btn btn-danger fs30">Next</div>
					
					</div>
					<script>
						
						function nextStep(that) {
							$('#preStep').show();
							$('#preStep').removeAttr("disabled");
							var page = $(that).attr('page');			
							$('.question_page').hide();
							step = parseInt(page) + 1;
							$('.step_'+step).show();
							var page = $(that).attr('page', step);
							$('#preStep').attr('page', step);
							if(step >= 5){
								$(that).attr('disabled','disabled');  
								$(that).hide();
							}
							
						}
						
						
						
						function preSteps(that) {
							 $('#nextStep').show();
							 $('#nextStep').removeAttr("disabled");
							var page = $(that).attr('page');			
							$('.question_page').hide();
							step = parseInt(page) - 1;
							$('.step_'+step).show();
							var page = $(that).attr('page', step);
							$('#nextStep').attr('page', step);
							if(step <= 1){
								$(that).attr('disabled','disabled');  
								$(that).hide();
							}
							
						}
						$(document).ready(function() {
							$('.question_page').hide();
							$('.step_1').show();
							$('#preStep').hide();
						});
						
					</script>
				<?php } ?>
			</form>
				<div class="fix_da relative hidden-xs">				
					<button id="finish-choice" class="btn btn-primary btt-practice <?php if(pzk_session('adminClassname') && pzk_session('adminLevel')== 'Monitor'){ echo "hidden" ; } ?>" name="finish-choice" onclick="finish_choice();"><span class="glyphicon glyphicon-ok"></span>
						<?php echo $language['finish'];?>
					</button>
					<button id="view-result" class="btn btt-practice btn-success" data-toggle="modal" data-target="#exampleModal" name="view-result" style="display:none;"><span class="glyphicon glyphicon-list-alt"></span>
						<?php echo $language['score'];?>
					</button>
					<button id="show-answers" class="btn btt-practice btn-danger <?php if(pzk_session('servicePackage') == 'classroom' && pzk_session('checkUser') == 1 && pzk_session('checkSchool') == 1){
						$topicId = intval(pzk_request('topic'));
						$exercise_number = intval(pzk_request('de'));
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
				<div class="visible-xs relative bot20">				
					
					<button id="finish-choice-mb" class="btn btn-primary <?php if(pzk_session('adminClassname')){ echo "hidden" ; } ?> col-xs-12 top10 bot20" name="finish-choice-mb" onclick="finish_choice();">
						<?php echo $language['finish'];?>
					</button>
					<button id="view-result-mb" class="btn btn-success col-xs-12 bot20" data-toggle="modal" data-target="#exampleModal" name="view-result-mb" style="display:none;">
						<?php echo $language['score'];?>
					</button>
					<button id="show-answers-mb" class="btn btn-danger col-xs-12 bot20 <?php if(pzk_session('servicePackage') == 'classroom' && pzk_session('checkUser') == 1 && pzk_session('checkSchool') == 1){
								$topicId = intval(pzk_request('topic'));
								$exercise_number = intval(pzk_request('de'));
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
			
			
				<!--bottom content-->
				<div style="height: 103px;" class="relative item">
					<img style="left: 0px; bottom: 0px; border-radius: 0px 0px 0px 5px;" class="absolute hidden-xs" src="/Themes/Songngu3/skin/images/bottom-left.png" />
					<img style="right: 0px; bottom: 0px; border-radius: 0px 0px 5px 0px;" class="absolute hidden-xs" src="/Themes/Songngu3/skin/images/bottom-right.png" />
					
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
								$topicId = intval(pzk_request('topic'));
								$exercise_number = intval(pzk_request('de'));
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
					keybook:"<?=$data_criteria['keybook']?>",
					topicPost : "<?php echo $topicPost; ?>",
					subjectPost : "<?php echo $subjectPost; ?>"  
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
	function check_display(trial){
		if(check == 1){
			return true;
		}else{
			if(trial == 1){
				return true;
			}else{
				alert('Bạn cần mua tài khoản để sử dụng nội dung này !');
				return false;
			}
			
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
	$('.dropdown').hover(function(){
		$(this).find(".dropdown-menu li.active a").focus()
	});
	<!--mobile click -->
	$(".dropdown.focus-active").on("shown.bs.dropdown", function() {
		$(this).find(".dropdown-menu li.active a").focus()
	});
	
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
<img class="item mgt-60" src="/Themes/Songngu3/skin/images/bottom-content.png"/>
