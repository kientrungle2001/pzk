<?php
	
	$showQuestions 	= $data->getData_showQuestion();
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
	$data_criteria	= $data->getData_criteria();
	$category = $data->getCategory();
	$category_id = $data->getCategoryId();
	$category_name = $data->getCategoryName();

	$class= pzk_session('lop');
	$de=clean_value(pzk_request()->getDe());
	if(pzk_request()->getSubject()){
		$psubject = intval(pzk_request()->getSubject());
	}else{
		$psubject= intval(pzk_request()->getSegment(3));
	}
	$subject= intval(pzk_request()->getSegment(3));
	$parentSubject = 0;
	if($subject) {
		
		$subjectEntity = _db()->getTableEntity('categories')->load($subject, 1800);
		$parentSubject = $subjectEntity->getParent();
	}
	$language = pzk_global()->getLanguage();
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
						$dataCategoryCurrent =  $data->getCategoryCurrentObservation();
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
								$topicPost= intval(pzk_request()->getTopic());
								$subjectPost= $subject;
								$level = $data -> getLevel($subject);
								//echo $level;
								if($level == '1'){
									$catetype = $data -> getCatetype($subject);
									$practices = $data->getPracticesSN($class,$subject);
									$medias		=	$data->getMedias($subject);
									foreach($medias as $media) {  ?>
										<li class="list-group-item hasa <?php if(pzk_request()->getDe() == $i) echo 'active'; ?>"><a onclick="return check_display(<?php echo @$media['trial']?>);"class="getdata" href="/practice/class-<?php echo $class ?>/subject-<?php echo $subjectEntity->getalias()?>-<?php echo $subject ?>/media-<?php echo @$media['id']?>"><?php echo @$media['name']?></a></li>
							<?php	}
									for($i = 1; $i <= $practices; $i++){  ?>
										<li class="list-group-item hasa <?php if(pzk_request()->getDe() == $i) echo 'active'; ?>"><a  onclick="de=<?php echo $i ?>; return check_display(<?php echo @$catetype['trial']?>);" data-de="<?php echo $i; ?>" class="getdata" href="/practice/class-<?php echo $class ?>/subject-<?php echo $subjectEntity->getalias()?>-<?php echo $subject ?>/examination-<?php echo $i ?>"><?php echo $language['lesson'].$i;?></a></li>
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
														<li class="list-group-item hasa <?php if(pzk_request()->getTopic() == $topic['id'] && pzk_request()->getDe() == $i) echo 'active'; ?>" style="<?php if(pzk_request()->getTopic() != $topic['id']):?>display: none;<?php endif;?>"><a  onclick="return check_display(<?php echo @$media['trial']?>);"class="getdata" href="/practice/class-<?php echo $class ?>/subject-<?php echo $subjectEntity->getalias()?>-<?php echo $subject ?>/topic-<?php echo @$topic['alias']?>-<?php echo @$topic['id']?>/media-<?php echo @$media['id']?>"><?php echo @$media['name']?></a></li>
											<?php	}
											
										for($i = 1; $i <= $practices; $i++){  ?>
											<li class="list-group-item hasa exercise-of-topic-<?php echo @$topic['id']?> <?php if(pzk_request()->getTopic() == $topic['id'] && pzk_request()->getDe() == $i) echo 'active'; ?>" style="<?php if(pzk_request()->getTopic() != $topic['id']):?>display: none;<?php endif;?>" ><a  onclick="de=<?php echo $i ?>; return check_display(<?php echo @$topic['trial']?>);" data-de="<?php echo $i; ?>" class="getdata" href="/practice/class-<?php echo $class ?>/subject-<?php echo $subjectEntity->getalias()?>-<?php echo $subject ?>/topic-<?php echo @$topic['alias']?>-<?php echo @$topic['id']?>/examination-<?php echo $i ?>"><?php echo $language['lesson'].$i;?></a></li>
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
														<li class="list-group-item hasdot hasa exercise-of-topic-<?php echo @$section['id']?> <?php if(pzk_request()->getTopic()==$section['id'] && pzk_request()->getDe() == $i) echo 'active'; ?>" style="<?php if(!@$section['trial'] && pzk_request()->getTopic()!=$section['id']):?>display: none;<?php endif;?>"><a onclick="return check_display(<?php echo @$media['trial']?>);"class="getdata" href="/practice/class-<?php echo $class ?>/subject-<?php echo $subjectEntity->getalias()?>-<?php echo $subject ?>/topic-<?php echo @$section['alias']?>-<?php echo @$section['id']?>/media-<?php echo @$media['id']?>"><?php echo @$media['name']?></a></li>
											<?php	}
											
											for($i = 1; $i <= $practices; $i++){  ?>
												<li class="list-group-item hasa hasdot exercise-of-topic-<?php echo @$section['id']?> <?php if(pzk_request()->getTopic()==$section['id'] && pzk_request()->getDe() == $i) echo 'active'; ?>" style="<?php if(!@$section['trial'] && pzk_request()->getTopic()!=$section['id']):?>display: none;<?php endif;?>"><a  onclick="de=<?php echo $i ?>; return check_display(<?php echo @$section['trial']?>);" data-de="<?php echo $i; ?>" class="getdata" href="/practice/class-<?php echo $class ?>/subject-<?php echo $subjectEntity->getalias()?>-<?php echo $subject ?>/topic-<?php echo @$section['alias']?>-<?php echo @$section['id']?>/examination-<?php echo $i ?>"><?php echo $language['lesson'].$i;?></a></li>
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
														<li class="list-group-item  hasdot exercise-of-topic-<?php echo @$topic['id']?> <?php if(pzk_request()->getTopic()==$topic['id'] && pzk_request()->getDe() == $i) echo'active'; ?>" style="<?php if(!@$topic['trial'] && pzk_request()->getTopic()!=$topic['id']):?>display: none;<?php endif;?> hasa"><a onclick="return check_display(<?php echo @$media['trial']?>);"class="getdata" href="/practice/class-<?php echo $class ?>/subject-<?php echo $subjectEntity->getalias()?>-<?php echo $subject ?>/topic-<?php echo @$topic['alias']?>-<?php echo @$topic['id']?>/media-<?php echo @$media['id']?>"><?php echo @$media['name']?></a></li>
											<?php	}
												for($i = 1; $i <= $practices; $i++){  ?>
													<li class="list-group-item hasa hasdot exercise-of-topic-<?php echo @$topic['id']?> <?php if(pzk_request()->getTopic()==$topic['id'] && pzk_request()->getDe() == $i) echo'active'; ?>" style="<?php if(!@$topic['trial'] && pzk_request()->getTopic()!=$topic['id']):?>display: none;<?php endif;?>"><a  onclick="de=<?php echo $i ?>; return check_display(<?php echo @$topic['trial']?>);" data-de="<?php echo $i; ?>" class="getdata" href="/practice/class-<?php echo $class ?>/subject-<?php echo $subjectEntity->getalias()?>-<?php echo $subject ?>/topic-<?php echo @$topic['alias']?>-<?php echo @$topic['id']?>/examination-<?php echo $i ?>"><?php echo $language['lesson'].$i;?></a></li>
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
														<li class="list-group-item hasa hasdot  exercise-of-topic-<?php echo @$section1['id']?> <?php if(pzk_request()->getTopic()==$section1['id'] && pzk_request()->getDe() == $i) echo 'active'; ?>" style="<?php if(!@$section1['trial'] && pzk_request()->getTopic()!=$section1['id']):?>display: none;<?php endif;?>"><a onclick="return check_display(<?php echo @$media['trial']?>);"class="getdata" href="/practice/class-<?php echo $class ?>/subject-<?php echo $subjectEntity->getalias()?>-<?php echo $subject ?>/topic-<?php echo @$section1['alias']?>-<?php echo @$section1['id']?>/media-<?php echo @$media['id']?>"><?php echo @$media['name']?></a></li>
											<?php	}
											for($i = 1; $i <= $practices; $i++){  ?>
												<li class="list-group-item hasa hasdot exercise-of-topic-<?php echo @$section1['id']?> <?php if(pzk_request()->getTopic()==$section1['id'] && pzk_request()->getDe() == $i) echo 'active'; ?>" style="<?php if(!@$section1['trial'] && pzk_request()->getTopic()!=$section1['id']):?>display: none;<?php endif;?>"><a  onclick="de=<?php echo $i ?>; return check_display(<?php echo @$section1['trial']?>);" data-de="<?php echo $i; ?>" class="getdata" href="/practice/class-<?php echo $class ?>/subject-<?php echo $subjectEntity->getalias()?>-<?php echo $subject ?>/topic-<?php echo @$section1['alias']?>-<?php echo @$section1['id']?>/examination-<?php echo $i ?>"><?php echo $language['lesson'].$i;?></a></li>
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
														<li class="list-group-item hasa hasdot exercise-of-topic-<?php echo @$section2['id']?> <?php if(pzk_request()->getTopic()==$section2['id'] && pzk_request()->getDe() == $i) echo 'active'; ?>" style="<?php if(!@$section2['trial'] && pzk_request()->getTopic()!=$section2['id']):?>display: none;<?php endif;?>"><a  onclick="return check_display(<?php echo @$media['trial']?>);"class="getdata" href="/practice/class-<?php echo $class ?>/subject-<?php echo $subjectEntity->getalias()?>-<?php echo $subject ?>/topic-<?php echo @$section2['alias']?>-<?php echo @$section2['id']?>/media-<?php echo @$media['id']?>"><?php echo @$media['name']?></a></li>
											<?php	}
													for($i = 1; $i <= $practices; $i++){  ?>
														<li class="list-group-item hasa hasdot exercise-of-topic-<?php echo @$section2['id']?> <?php if(pzk_request()->getTopic()==$section2['id'] && pzk_request()->getDe() == $i) echo 'active'; ?>" style="<?php if(!@$section2['trial'] && pzk_request()->getTopic()!=$section2['id']):?>display: none;<?php endif;?>"><a onclick="de=<?php echo $i ?>; return check_display(<?php echo @$section2['trial']?>);" data-de="<?php echo $i; ?>" class="getdata" href="/practice/class-<?php echo $class ?>/subject-<?php echo $subjectEntity->getalias()?>-<?php echo $subject ?>/topic-<?php echo @$section2['alias']?>-<?php echo @$section2['id']?>/examination-<?php echo $i ?>"><?php echo $language['lesson'].$i;?></a></li>
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
														<li class="list-group-item hasa hasdot exercise-of-topic-<?php echo @$topic['id']?> <?php if(pzk_request()->getTopic()==$topic['id'] && pzk_request()->getDe() == $i) echo'active'; ?>" style="<?php if(pzk_request()->getTopic()!=$topic['id']):?>display: none;<?php endif;?>"><a onclick="return check_display(<?php echo @$media['trial']?>);"class="getdata" href="/practice/class-<?php echo $class ?>/subject-<?php echo $subjectEntity->getalias()?>-<?php echo $subject ?>/topic-<?php echo @$topic['alias']?>-<?php echo @$topic['id']?>/media-<?php echo @$media['id']?>"><?php echo @$media['name']?></a></li>
											<?php	}
														for($i = 1; $i <= $practices; $i++){  ?>
															<li class="list-group-item hasa hasdot exercise-of-topic-<?php echo @$topic['id']?> <?php if(pzk_request()->getTopic()==$topic['id'] && pzk_request()->getDe() == $i) echo'active'; ?>" style="<?php if(pzk_request()->getTopic()!=$topic['id']):?>display: none;<?php endif;?>"><a  onclick="de=<?php echo $i ?>; return check_display(<?php echo @$topic['trial']?>);" data-de="<?php echo $i; ?>" class="getdata" href="/practice/class-<?php echo $class ?>/subject-<?php echo $subjectEntity->getalias()?>-<?php echo $subject ?>/topic-<?php echo @$topic['alias']?>-<?php echo @$topic['id']?>/examination-<?php echo $i ?>"><?php echo $language['lesson'].$i;?></a></li>
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
			   <a href="/practice/class-<?=$class;?>/subject-<?=$subjectEntity->getalias();?>-<?=$subjectEntity->getId();?>">
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
								$topicId = intval(pzk_request()->getTopic());
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
			
				
				<form id="form_question_tl" class="question_content pd-0 form-horizontal top20" method="post">
				<div class="col-xs-12">
				<?php $dataRow = $data->getDataRow();?>
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
							
								<div class="stt"><?php echo $language['question'];?> <?=$key+1;?> 
										<?php if(pzk_user_special()) :?><br />
									(#<?php echo @$value['id']?>)
									<?php endif; ?>
										</div>
								
								<input type="hidden" name="questions[<?=$value['id']?>]" value="<?=$value['id']?>"/>
								<input type="hidden" name="questionType[<?=$value['id']?>]" value="<?=questionTypeOjb($value['questionType'])?>"/>
								<?php 
	
									//neu la tu luan
									$QuestionObj = pzk_obj_once('Education.Question.Type.'.ucfirst(questionTypeOjb($value['questionType'])));
									
									$QuestionObj->setLayout('education/question/tuluan');
									$QuestionObj->setStt($key+1);
									
									$questionChoice = _db()->getEntity('Question.Choice');
									$questionChoice->setData($processQuestions[$value['id']]);
									$QuestionObj->setQuestion($questionChoice);
									
									$QuestionObj->setCacheParams('layout, questionId');
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
				
				<div class="fix_da">
							
							<button id="finish-choicetl" class="btn btn-primary" name="finish-choicetl" onclick="finish_choicetl();" type="button">
								<?= $language['finish']; ?>
							</button>
							
							
							<button style="display:none;" id="tlanswers" onclick="return showtlanswers();" class="btn btn-danger" name="show-answers"   type="button">
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
	
</div>

</div>



<script>
	function showtlanswers(){

		$('.showtlanswers').each(function() {
			$(this).show();
		});
	};
	
	var formdatatl;
	
    function finish_choicetl(){
        
		var time_real = $('.num-time').text().split(":");
		
		var start_time = <?=$data_criteria['question_time'];?>;
		
		var during_time = parseInt(start_time)*60 - (parseInt(time_real[0])*60 + parseInt(time_real[1]));
		
		$('#during_time').val(during_time);
		
    	formdatatl = $('#form_question_tl').serializeForm();
    	$('#idFieldset input').prop( "disabled", true );
		$('#idFieldset textarea').prop( "disabled", true );
    	$('#finish-choicetl').prop( "disabled", true );
		
    	save_choicetl();
		
    	return formdatatl;
    }

	var user_book_id_tl;
	function save_choicetl(){
		if(formdatatl	==	null){
      		alert('Click hoàn thành để xem đáp án !');
      	}else{
			if(user_book_id_tl == undefined){
	        	if(formdatatl == null){
	          		formdatatl = finish_choicetl();
	          	}
	          	$.ajax({
	              	type: "Post",
		            data:{
		            	answers: 	formdatatl,
						topicPost : "<?php echo $topicPost; ?>",
						subjectPost : "<?php echo $subjectPost; ?>"  		
		            },
		            url:'<?=BASE_REQUEST?>/home/saveTl',
		            success: function(results){
		            	if(results){
		            		
		            		$('#finish-choicetl').prop( "disabled", true );
							$('#result_score').show();
							$('#tlanswers').show();
							

		                }
		           	}
	            });
			}
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

  	              	finish_choicetl();
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
  	
  	jQuery('#finish-choicetl').on('click',CountDown.Pause);

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
