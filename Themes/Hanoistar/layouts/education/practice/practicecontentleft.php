<div class="item bgcontent">

<!--div class="container">
<marquee>
Để tra Từ điển và nghe loa đọc của bất kì từ tiếng Anh nào trong phần mềm, bạn chỉ cần Click đúp vào từ đó.
</marquee>
</div-->

<?php  
	$category 		= 	$data->get('category');
	$category_id 	= 	$data->get('categoryId');
	$category_name 	= 	$data->get('categoryName');
	$subject		=	intval(pzk_request()->getSegment(3));
	$check 			= 	pzk_session('checkPayment');
	$class			= 	pzk_session('lop');
	
	if($subject) {
		$subjectEntity 	= _db()->getTableEntity('categories')->load($subject, 1800);
		$parentSubject 	= $subjectEntity->get('parent');
	}
	$language 			= pzk_global()->get('language');
	$lang 				= pzk_session('language');
?>


<?php if(!$category):?>
	<!-- Nếu không có cateogry -->
<?php else:?>
	
<?php if(pzk_session('login')) { ?>
<!-- Nếu đã đăng nhập -->

<!-- Danh mục bài luyện tập -->
<div class="container-fluid">
	
	<div class="row">
		<div class="col-md-12 col-xs-12">
		<div class="item tree-practice">
			<!-- Tiêu đề -->
			<div class="item">
				<div class="title-bt relative">
					<?php echo $language['choice'];?>
					
				</div>
				<img src="/Themes/Songngu3/skin/images/right-lt.png" class="pull-right"/>
			</div>
			
			<!-- Kết thúc tiêu đề -->
			
			<div class="item show-tree-mobile">
				<?php if($category['child']):?>
				
				<div class="col-md-12 col-xs-12 mgleft pd0 mg0">
					
						<ul class=" item list-group menu-baitap">
						<?php if($category_id == 88) {
						// Trường hợp bài luyện quan sát
							$dataCategoryCurrent =  $data->get('categoryCurrentObservation');
							if(@$dataCategoryCurrent['child']):
								foreach($dataCategoryCurrent['child'] as $k =>$topic):								
									if(strpos($topic['classes'], ''.$class) === false) continue; ?>
										<li class="list-group-item hasa">
											<a onclick="subject = <?php echo @$topic['id']?>; return check_display(<?php echo @$topic['trial']?>);" data-de="<?php echo @$topic['name']?>" class="getdata" 
												href="/practice/doQuestion/<?php echo @$topic['id']?>?subject=<?php echo $subject ?>&class=<?php echo $class ?>&de=<?php echo @$topic['alias']?>" 
												data-type="group"><?php if(pzk_user_special()): ?>#<?php echo @$topic['id']?> - <?php endif; ?><?php echo @$topic['name']?></a></li>
						<?php 	endforeach;
							endif;
						// Kết thúc bài luyện quan sát
						} else { ?>
						<?php 
							function show_media_item($media, $class, $subjectEntity, $subject) { ?>
								<li class="list-group-item hasa">
										<a onclick="return check_display(<?php echo @$media['trial']?>);" 
											class="getdata" 
											href="/practice/class-<?php echo $class ?>/subject-<?php echo $subjectEntity->get('alias')?>-<?php echo $subject ?>/media-<?php echo @$media['id']?>">
												<?php echo @$media['name']?></a></li>
				<?php		}
				
							function show_media_topic_item($media, $class, $subjectEntity, $subject, $topic) { ?>
								<li class="list-group-item hasa exercise-of-topic-<?php echo @$topic['id']?> 
											<?php if(pzk_request('topic') == $topic['id']) echo 'active'; ?>">
												<a  onclick="return check_display(<?php echo @$media['trial']?>);" class="getdata" 
													href="/practice/class-<?php echo $class ?>/subject-<?php echo $subjectEntity->get('alias')?>-<?php echo $subject ?>/topic-<?php echo @$topic['alias']?>-<?php echo @$topic['id']?>/media-<?php echo @$media['id']?>">
														<?php echo @$media['name']?></a>
										</li>
				<?php		}

							function show_homework_item($media, $class, $subjectEntity, $subject) { ?>
								<li class="list-group-item hasa">
										<a onclick="return check_display(<?php echo @$media['trial']?>);" 
											class="getdata" 
											href="/practice/class-<?php echo $class ?>/subject-<?php echo $subjectEntity->get('alias')?>-<?php echo $subject ?>/homework-<?php echo @$media['id']?>">
												<?php echo @$media['name']?></a></li>
				<?php		}
				
							function show_homework_topic_item($media, $class, $subjectEntity, $subject, $topic) { ?>
								<li class="list-group-item hasa exercise-of-topic-<?php echo @$topic['id']?> 
											<?php if(pzk_request('topic') == $topic['id']) echo 'active'; ?>">
												<a  onclick="return check_display(<?php echo @$media['trial']?>);" class="getdata" 
													href="/practice/class-<?php echo $class ?>/subject-<?php echo $subjectEntity->get('alias')?>-<?php echo $subject ?>/topic-<?php echo @$topic['alias']?>-<?php echo @$topic['id']?>/homework-<?php echo @$media['id']?>">
														<?php echo @$media['name']?></a>
										</li>
				<?php		}
							
							function show_choice_item($practices, $language, $catetype, $class, $subjectEntity, $subject) { 
							return false;
							?>
						<?php 	if($practices):?>
									<li class="list-group-item hasa question_type">
										<a onclick="return false;" class="getdata" href="#">Trắc Nghiệm</a></li>
						<?php		for($i = 1; $i <= $practices; $i++){  ?>
										<li class="list-group-item hasa">
											<a  onclick="$('#chonde').html('<?php echo $language['lesson'].$i; ?>'); de=<?php echo $i ?>; return check_display(<?php echo @$catetype['trial']?>);" 
												data-de="<?php echo $i; ?>" class="getdata" 
												href="/practice/class-<?php echo $class ?>/subject-<?php echo $subjectEntity->get('alias')?>-<?php echo $subject ?>/examination-<?php echo $i ?>">
													<?php echo $language['lesson'].$i;?></a></li>
						<?php 		} ?>
						<?php 	endif; ?>
				<?php
							}
							
							function show_choice_topic_item($practices, $language, $catetype, $class, $subjectEntity, $subject, $topic) { 
								return false;
							?>
						<?php 	if($practices):?>
									<li class="list-group-item hasa question_type exercise-of-topic-<?php echo @$topic['id']?>" 
											style="<?php if(pzk_request('topic') != $topic['id']):?>display: none;<?php endif;?>">
										<a onclick="return false;" class="getdata" href="#">Trắc Nghiệm</a>
									</li>
							
							<?php 	for($i = 1; $i <= $practices; $i++){  ?>
										<li class="list-group-item hasa exercise-of-topic-<?php echo @$topic['id']?> 
											<?php if(pzk_request('topic') == $topic['id'] && pzk_request('de') == $i) echo 'active'; ?>" 
											style="<?php if(pzk_request('topic') != $topic['id']):?>display: none;<?php endif;?>">
												<a  onclick="de=<?php echo $i ?>; return check_display(<?php echo @$topic['trial']?>);" data-de="<?php echo $i; ?>" class="getdata" 
													href="/practice/class-<?php echo $class ?>/subject-<?php echo $subjectEntity->get('alias')?>-<?php echo $subject ?>/topic-<?php echo @$topic['alias']?>-<?php echo @$topic['id']?>/examination-<?php echo $i ?>">
														<?php echo $language['lesson'].$i;?></a>
										</li>
							<?php 	} ?>
							<?php 	endif;?>
				<?php
							}
							
							function show_writting_item($practicesTL, $language, $catetype, $class, $subjectEntity, $subject) { 
								return false;
							?>
						<?php 	if($practicesTL):?>
									<li class="list-group-item hasa question_type">
										<a onclick="return false;" class="getdata" href="#">Tự luận</a></li>
						<?php
									for($i = 1; $i <= $practicesTL; $i++){  ?>
										<li class="list-group-item hasa">
											<a  onclick="$('#chonde').html('<?php echo $language['lesson'].$i; ?>'); de=<?php echo $i ?>; return check_display(<?php echo @$catetype['trial']?>);" 
												data-de="<?php echo $i; ?>" class="getdata" 
												href="/practice/class-<?php echo $class ?>/subject-<?php echo $subjectEntity->get('alias')?>-<?php echo $subject ?>/examination-<?php echo $i ?>?questionType=4">
													<?php echo $language['lesson'].$i;?></a></li>
						<?php 		}  ?>
						<?php	endif;?>	
				<?php		}
				
							function show_writting_topic_item($practicesTL, $language, $catetype, $class, $subjectEntity, $subject, $topic) { 
								return false;
							?>
						<?php if($practicesTL):?>
									<li class="list-group-item hasa question_type exercise-of-topic-<?php echo @$topic['id']?>" 
										style="<?php if(pzk_request('topic') != $topic['id']):?>display: none;<?php endif;?>">
											<a onclick="return false;" class="getdata" href="#">Tự luận</a></li>
							<?php for($i = 1; $i <= $practicesTL; $i++){  ?>
										<li class="list-group-item hasa exercise-of-topic-<?php echo @$topic['id']?> 
											<?php if(pzk_request('topic') == $topic['id'] && pzk_request('de') == $i) echo 'active'; ?>" 
											style="<?php if(pzk_request('topic') != $topic['id']):?>display: none;<?php endif;?>">
												<a  onclick="de=<?php echo $i ?>; return check_display(<?php echo @$topic['trial']?>);" data-de="<?php echo $i; ?>" class="getdata" 
													href="/practice/class-<?php echo $class ?>/subject-<?php echo $subjectEntity->get('alias')?>-<?php echo $subject ?>/topic-<?php echo @$topic['alias']?>-<?php echo @$topic['id']?>/examination-<?php echo $i ?>?questionType=4">
														<?php echo $language['lesson'].$i;?></a>
										</li>
							<?php 	} //end for
									endif; ?>
				<?php		}
							
							$level = $data->getLevel($subject);
							// Cấp danh mục là 1
							if($level == '1'){
								$questionType = 1; // Trắc nghiệm
								// $questionType = 4; // Tự luận
								$catetype 		= 	$data -> getCatetype($subject);
								$practices 		= 	$data->getPracticesSN($class,$subject, $questionType, 1);
								$practicesTL 	= 	$data->getPracticesSN($class,$subject, $questionType, 4);
								$medias			=	$data->getMedias($subject);
								$homeworks		=	$data->getHomeworks($subject);
								
								// Danh sách các đa phương tiện
								foreach($medias as $media) {  
									show_media_item($media, $class, $subjectEntity, $subject);
								} 
								
								foreach($homeworks as $homework) {  
									show_homework_item($homework, $class, $subjectEntity, $subject);
								} 
								
								?>
						<!-- Các bài trắc nghiệm -->
								
						<?php	show_choice_item($practices, $language, $catetype, $class, $subjectEntity, $subject); ?>
						<?php	show_writting_item($practicesTL, $language, $catetype, $class, $subjectEntity, $subject); ?>
						
						<?php 
							
							}elseif($level== '2'){
								// Danh mục cấp 2
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
									?>
									<li class="level2" 
											onclick="$('.exercise-of-topic-<?php echo @$topic['id']?>').toggle();"  
											onmouseover="$(this).css('border-bottom', '1px solid #333');" 
											onmouseout="$(this).css('border-bottom', 'none');">
										<div class="item-topic">
											<strong><?php if(pzk_user_special()): ?>#<?php echo @$topic['id']?> - <?php endif; ?><?php echo $topic_name ?></strong>
											<span class="glyphicon glyphicon-play-circle" style="float: right;"></span>
										</div>
										<div class="item-topic hidden">
											<?php echo @$topic['content']?>
										</div>
									</li>
									<?php 
									$practices 		= 	$data->getPracticesSN($class,$topic['id'], 1);
									$practicesTL 	= 	$data->getPracticesSN($class,$topic['id'], 4);
									$medias			=	$data->getMedias($topic['id']);
									$homeworks		=	$data->getHomeworks($topic['id']);
									?>
									<?php foreach($medias as $media): ?>
										<?php show_media_topic_item($media, $class, $subjectEntity, $subject, $topic); ?>
									<?php endforeach; ?>
									
									<?php foreach($homeworks as $homework): ?>
										<?php show_homework_topic_item($homework, $class, $subjectEntity, $subject, $topic); ?>
									<?php endforeach; ?>
									
									<?php show_choice_topic_item($practices, $language, null, $class, $subjectEntity, $subject, $topic);?>
									<?php show_writting_topic_item($practicesTL, $language, null, $class, $subjectEntity, $subject, $topic);?>
							
							<?php
								} //end foreach
								
							} elseif($level== '3'){
								// Cấp danh mục là 3
								
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
									?>
									<li class="level2<?=(@$section['trial'] ? ' trial-3-level-1': ''); ?>"  
										onclick="$('.exercise-of-topic-<?php echo @$section['id']?>').toggle();" 
										onmouseover="$(this).css('border-bottom', '1px solid #333');" 
										onmouseout="$(this).css('border-bottom', 'none');">
											<div class="item-topic">
												<strong><?php if(pzk_user_special()): ?>#<?php echo @$section['id']?> - <?php endif; ?><?php echo $section_name ?></strong>
											</div>
											<div class="item-topic hidden">
												<?php echo @$section['content']?>
											</div>
									</li>
							<?php
									$topicChilds= $data->getTopicsSN($section['id'], $class);
									if(count($topicChilds) == 0) {
										$practices = $data->getPracticesSN($class,$section['id'], 1);
										$practicesTL = $data->getPracticesSN($class,$section['id'], 4);
										$medias		=	$data->getMedias($section['id']);
										$homeworks	=	$data->getHomeworks($section['id']);
										foreach($medias as $media) {  ?>
											<?php show_media_topic_item($media, $class, $subjectEntity, $subject, $section); ?>
							<?php		} 
										
										foreach($homeworks as $homework) {  ?>
											<?php show_homework_topic_item($homework, $class, $subjectEntity, $subject, $section); ?>
							<?php		}
							?>
							<?php show_choice_topic_item($practices, $language, null, $class, $subjectEntity, $subject, $section);?>
							<?php show_writting_topic_item($practicesTL, $language, null, $class, $subjectEntity, $subject, $section);?>
							<?php	} else {
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
											?>
											<li class="level3-2<?= (@$topic['trial'] ? ' trial-3-level-2': '')?>"  
												onclick="$('.exercise-of-topic-<?php echo @$topic['id']?>').toggle();" 
												onmouseover="$(this).css('border-bottom', '1px solid #333');" 
												onmouseout="$(this).css('border-bottom', 'none');">
													<div class="item-topic">
													<strong><?php if(pzk_user_special()): ?>#<?php echo @$topic['id']?> - <?php endif; ?>
													<?php echo $topic_name ?></strong><span class="glyphicon glyphicon-play-circle" style="float: right;"></span>
													</div>
													<div class="item-topic hidden">
													<?php echo @$topic['content']?>
													</div>
											</li>
								<?php
											$practices = $data->getPracticesSN($class,$topic['id'], 1);
											$practicesTL = $data->getPracticesSN($class,$topic['id'], 4);
											$medias		=	$data->getMedias($topic['id']);
											$homeworks	=	$data->getHomeworks($topic['id']);
											foreach($medias as $media) {  ?>
												<?php show_media_topic_item($media, $class, $subjectEntity, $subject, $topic); ?>
								<?php		} 
											
											foreach($homeworks as $homework) {  ?>
												<?php show_homework_topic_item($homework, $class, $subjectEntity, $subject, $topic); ?>
								<?php		}
								?>
								
								<?php 		show_choice_topic_item($practices, $language, null, $class, $subjectEntity, $subject, $topic);?>
								
								<?php 		show_writting_topic_item($practicesTL, $language, null, $class, $subjectEntity, $subject, $topic);?>
								<?php
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
									?>
									<li class="level4 <?= (@$section1['trial'] ? ' trial-4-level-1': '')?>" >
										<div class="item-topic">
										<strong><?php if(pzk_user_special()): ?>#<?php echo @$section1['id']?> - <?php endif; ?><?php echo $section1_name ?></strong>
										</div>
										<div class="item-topic hidden">
										<?php echo @$section1['content']?>
										</div>
									</li>
							<?php
									$sections2= $data->getTopicsSN($section1['id'], $class);
									if(count($sections2) == 0) {
										$practices = $data->getPracticesSN($class,$section1['id'], 1);
										$practicesTL = $data->getPracticesSN($class,$section1['id'], 4);
										$medias		=	$data->getMedias($section1['id']);
										$homeworks	=	$data->getHomeworks($section1['id']);
										foreach($medias as $media) {  ?>
											<?php show_media_topic_item($media, $class, $subjectEntity, $subject, $section1); ?>
								<?php	} 
										
										foreach($homeworks as $homework) {  ?>
											<?php show_homework_topic_item($homework, $class, $subjectEntity, $subject, $section1); ?>
								<?php	}
								?>
								<?php 	show_choice_topic_item($practices, $language, null, $class, $subjectEntity, $subject, $section1);?>
								<?php 	show_writting_topic_item($practicesTL, $language, null, $class, $subjectEntity, $subject, $section1);?>
								<?php
									} else {
										foreach ($sections2 as $section2) {
											if ($lang == 'en' || $lang == 'ev'){
												$section_name = $section2['name_en'];
											}else{
												$section_name = $section2['name'];
											}
											?>
											<li onclick="$('.exercise-of-topic-<?php echo @$section2['id']?>').toggle();" 
												onmouseover="$(this).css('border-bottom', '1px solid #333');" 
												onmouseout="$(this).css('border-bottom', 'none');" 
												class="level4-1 <?php echo (@$section2['trial'] ? ' trial-4-level-2': '') ?>">
												<div class="item-topic">
												<strong><?php if(pzk_user_special()): ?>#<?php echo @$section2['id']?> - <?php endif; ?><?php echo $section_name ?></strong>
												<span class="glyphicon glyphicon-play-circle" style="float: right;"></span>
												</div>
												<div class="item-topic hidden">
												<?php echo @$section2['content']?>
												</div>
											<?php
											$topicChilds	= $data->getTopicsSN($section2['id'], $class);
											if(count($topicChilds) == 0) {
												$practices = $data->getPracticesSN($class,$section2['id'], 1);
												$practicesTL = $data->getPracticesSN($class,$section2['id'], 4);
												$medias		=	$data->getMedias($section2['id']);
												$homeworks	=	$data->getHomeworks($section2['id']);
												foreach($medias as $media) {  ?>
													<?php show_media_topic_item($media, $class, $subjectEntity, $subject, $section2); ?>
										<?php	} 
												foreach($homeworks as $homework) {  ?>
													<?php show_homework_topic_item($homework, $class, $subjectEntity, $subject, $section2); ?>
										<?php	}
										?>
										<?php 	show_choice_topic_item($practices, $language, null, $class, $subjectEntity, $subject, $section2);?>
										<?php 	show_writting_topic_item($practicesTL, $language, null, $class, $subjectEntity, $subject, $section2);?>
										<?php
											} else {
												foreach ($topicChilds as $topic) {
													
													if ($lang == 'en' || $lang == 'ev'){
														$topic_name = $topic['name_en'];
													}else{
														$topic_name = $topic['name'];
													}
													
										?>
													<li onclick="$('.exercise-of-topic-<?php echo @$topic['id']?>').toggle();" 
														class="level4-2 <?= (@$topic['trial'] ? ' trial-4-level-3': '')?>"  
														onmouseover="$(this).css('border-bottom', '1px solid #333');" 
														onmouseout="$(this).css('border-bottom', 'none');">
														<div class="item-topic">
															<strong><?php if(pzk_user_special()): ?>#<?php echo @$topic['id']?> - <?php endif; ?><?php echo $topic_name;?></strong>
															<span class="glyphicon glyphicon-play-circle" style="float: right;"></span>
														</div>
														<div class="item-topic hidden">
														<?php echo @$topic['content']?>
														</div>
													</li>
										<?php
													$practices 		= 	$data->getPracticesSN($class,$topic['id'], 1);
													$practicesTL 	= 	$data->getPracticesSN($class,$topic['id'], 4);
													$medias			=	$data->getMedias($topic['id']);
													$homeworks		=	$data->getHomeworks($topic['id']);
													foreach($medias as $media) {  ?>
														<?php show_media_topic_item($media, $class, $subjectEntity, $subject, $topic); ?>
										<?php		} 
													
													foreach($homeworks as $homework) {  ?>
														<?php show_homework_topic_item($homework, $class, $subjectEntity, $subject, $topic); ?>
										<?php		}
										?>
										<?php 		show_choice_topic_item($practices, $language, null, $class, $subjectEntity, $subject, $topic);?>
										<?php 		show_writting_topic_item($practicesTL, $language, null, $class, $subjectEntity, $subject, $topic);?>
												<?php
												}	
											}	
										}	
									}
								}
							}
						?>
					<?php } ?>
					</ul>
				</div>	
				<?php endif;?>
			</div>
		</div>
	</div>
</div>

<?php if(pzk_request()->isMobile()) { ?>
<style>
	.show-mobile-vc .voca-menu{
		    height: 231px !important;
			margin-bottom: 30px !important;
	}
	.show-tree-mobile .menu-baitap{
		    height: 231px !important;
	}
</style>
<?php } ?>
<script>
	if(mobileAndTabletcheck()){
		$('.show-mobile-vc').hide();
		$(".practice-vc").hover(function(){
			$('.show-mobile-vc').show();
			}, function(){
			$('.show-mobile-vc').hide();
		});
		
		$('.show-tree-mobile').hide();
		$(".tree-practice").hover(function(){
			$('.show-tree-mobile').show();
			}, function(){
			$('.show-tree-mobile').hide();
		});
		
	}
	
</script>

<script>
	de = null;
	subject = <?php echo intval(pzk_request()->getSegment(3)); ?>;
	de_type = null;
	$(function(){
		
		$( ".fix_hover" )
		  .mouseover(function() {
			$('.nomgin2').show();
		  });
	});
	var check = '<?php echo $check ?>';
	function check_display(trial, pass = false){
		if(pass){
			return true;
		}else{
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
		}
		
	};
	
	
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

<!--Kết thúc Danh mục bài luyện tập -->

<?php endif;?>
 </div>
 
 </div>