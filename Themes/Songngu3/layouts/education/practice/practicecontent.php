<div class="item bgcontent">

<!--div class="container">
<marquee>
Để tra Từ điển và nghe loa đọc của bất kì từ tiếng Anh nào trong phần mềm, bạn chỉ cần Click đúp vào từ đó.
</marquee>
</div-->

<?php  
	$category = $data->getCategory();
	$category_id = $data->getCategoryId();
	$category_name = $data->getCategoryName();
	$subject=pzk_request()->getSegment(3);
	$check = pzk_session('checkPayment');
	$class= pzk_session('lop');
	
	if($subject) {
		$subjectEntity = _db()->getTableEntity('categories')->load($subject, 1800);
		$parentSubject = $subjectEntity->getParent();
	}
	$language = pzk_global()->getLanguage();
	$lang = pzk_session('language');
?>


<?php if(empty($category)):?>
	
<?php else:?>
<?php if(pzk_session('login')) { ?>



<div class="container">
	<div class="item fs18 top-content bold">
		<?php //echo $language['classnumber'].$class;?>&nbsp; &nbsp;
		<a href="/#practice">
		<?php 
		if($check == 1){
			echo $language['pclass'];
		}else{
			echo $language['trialpractice'];
		}
		?> 
		</a>
		
		&nbsp; &nbsp; > &nbsp; &nbsp;
		<a href="/practice/class-<?=$class;?>/subject-<?=$subjectEntity->getalias();?>-<?=$subjectEntity->getId();?>">
		<?php 
				if ($lang == 'en' || $lang == 'ev'){
					echo $category_name['name_en'];
				}else{
					echo $category_name['name_vn'];
				}
				 ?>
		</a>
	</div>
</div>


<div class="container">
	
	<div class="row">
		<div class="col-md-6 col-xs-12">
			<div  class="item practice-content practice-vc">
				<div  class="item ">
					<div class="title-vc relative">
						<img style="left: 15px; top: -15px;" class="absolute hidden-xs" src="/Themes/Songngu3/skin/images/icon_tv.png" />
						<?php echo $language['vocabulary'];?>
					</div>
					<img src="/Themes/Songngu3/skin/images/right-vc.png" class="pull-right"/>
				</div>
				<div class="show-mobile-vc item">
					<?php $data->displayChildren('[position=choice]') ?>
				</div>
			</div>
		</div>
		
			
		
		<div class="col-md-6 col-xs-12">
		<div class="item tree-practice">
			<div class="item">
				<div class="title-bt relative">
					<img style="left: 15px; top: -15px;" class="absolute hidden-xs" src="/Themes/Songngu3/skin/images/icon_lt.png" />
					<?php echo $language['choice'];?>
					
				</div>
				<img src="/Themes/Songngu3/skin/images/right-lt.png" class="pull-right"/>
			</div>
			
			<div class="item show-tree-mobile practice-content">
				<?php if(!empty($category['child'])):?>
				
				<div class="col-md-12 col-xs-12 mgleft pd0 mg0">
					
						<ul class=" item list-group menu-baitap">
						<?php if($category_id == 88) {
							$dataCategoryCurrent =  $data->getCategoryCurrentObservation();
							//debug($dataCategoryCurrent['child']);
							if(@$dataCategoryCurrent['child'])
							foreach($dataCategoryCurrent['child'] as $k =>$value):
								
								if(strpos($value['classes'], ''.$class) === false) continue;
								
						?>
							<li class="list-group-item hasa"><a onclick="subject = <?php echo @$value['id']?>; return check_display(<?php echo @$value['trial']?>);" data-de="<?php echo @$value['name']?>" class="getdata" href="/practice/doQuestion/<?php echo @$value['id']?>?subject=<?php echo $subject ?>&class=<?php echo $class ?>&de=<?php echo @$value['alias']?>" data-type="group"><?php if(pzk_user_special()): ?>#<?php echo @$value['id']?> - <?php endif; ?><?php echo @$value['name']?></a></li>
						<?php endforeach;
						} else { ?>
							<?php 
								$level = $data -> getLevel($subject);
								//echo $level;
								if($level== '1'){
									$catetype = $data -> getCatetype($subject);
									$practices = $data->getPracticesSN($class,$subject);
									$medias		=	$data->getMedias($subject);
									foreach($medias as $media) {  ?>
										<li class="list-group-item hasa"><a onclick="return check_display(<?php echo @$media['trial']?>);"class="getdata" href="/practice/class-<?php echo $class ?>/subject-<?php echo $subjectEntity->getalias()?>-<?php echo $subject ?>/media-<?php echo @$media['id']?>"><?php echo @$media['name']?></a></li>
							<?php	}
										for($i = 1; $i <= $practices; $i++){  ?>
											<li class="list-group-item hasa"><a  onclick="document.getElementById('chonde').innerHTML = '<?php echo $language['lesson'].$i; ?>'; de=<?php echo $i ?>; return check_display(<?php echo @$catetype['trial']?>);" data-de="<?php echo $i; ?>" class="getdata" href="/practice/class-<?php echo $class ?>/subject-<?php echo $subjectEntity->getalias()?>-<?php echo $subject ?>/examination-<?php echo $i ?>"><?php echo $language['lesson'].$i;?></a></li>
										<?php } //end for
								}elseif($level== '2'){
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
											echo '<li class="level2" onclick="$(\'.exercise-of-topic-'.$topic['id'].'\').toggle();"  onmouseover="$(this).css(\'border-bottom\', \'1px solid #333\');" onmouseout="$(this).css(\'border-bottom\', \'none\');"><strong>'; ?>
											<?php if(pzk_user_special()): ?>#<?php echo @$topic['id']?> - <?php endif; ?>
											<?php
											echo $topic_name.'</strong><span class="glyphicon glyphicon-play-circle" style="float: right;"></span></li>';
											$practices = $data->getPracticesSN($class,$topic['id']);
											
											$medias		=	$data->getMedias($topic['id']);
													foreach($medias as $media) {  ?>
														<li class="list-group-item hasa exercise-of-topic-<?php echo @$topic['id']?> <?php if(pzk_request()->getTopic() == $topic['id'] && pzk_request()->getDe() == $i) echo 'active'; ?>" style="<?php if(pzk_request()->getTopic() != $topic['id']):?>display: none;<?php endif;?>"><a  onclick="return check_display(<?php echo @$media['trial']?>);"class="getdata" href="/practice/class-<?php echo $class ?>/subject-<?php echo $subjectEntity->getalias()?>-<?php echo $subject ?>/topic-<?php echo @$topic['alias']?>-<?php echo @$topic['id']?>/media-<?php echo @$media['id']?>"><?php echo @$media['name']?></a></li>
											<?php	}
											
											for($i = 1; $i <= $practices; $i++){  ?>
												
												<li class="list-group-item hasa exercise-of-topic-<?php echo @$topic['id']?> <?php if(pzk_request()->getTopic() == $topic['id'] && pzk_request()->getDe() == $i) echo 'active'; ?>" style="<?php if(pzk_request()->getTopic() != $topic['id']):?>display: none;<?php endif;?>"><a  onclick="de=<?php echo $i ?>; return check_display(<?php echo @$topic['trial']?>);" data-de="<?php echo $i; ?>" class="getdata" href="/practice/class-<?php echo $class ?>/subject-<?php echo $subjectEntity->getalias()?>-<?php echo $subject ?>/topic-<?php echo @$topic['alias']?>-<?php echo @$topic['id']?>/examination-<?php echo $i ?>"><?php echo $language['lesson'].$i;?></a></li>
											<?php } //end for
										} //end foreach

								}elseif($level== '3'){
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
										echo '<li class="level2'.(@$section['trial'] ? ' trial-3-level-1': '').'"  onclick="$(\'.exercise-of-topic-'.$section['id'].'\').toggle();" onmouseover="$(this).css(\'border-bottom\', \'1px solid #333\');" onmouseout="$(this).css(\'border-bottom\', \'none\');"><strong>'; ?>
										<?php if(pzk_user_special()): ?>#<?php echo @$section['id']?> - <?php endif; ?>
										<?php
										echo $section_name.'</strong></li>';
										$topicChilds= $data->getTopicsSN($section['id'], $class);
										if(count($topicChilds) == 0) {
											$practices = $data->getPracticesSN($class,$section['id']);
											$medias		=	$data->getMedias($section['id']);
													foreach($medias as $media) {  ?>
														<li class="list-group-item hasa exercise-of-topic-<?php echo @$section['id']?> <?php if(pzk_request()->getTopic()==$section['id'] && pzk_request()->getDe() == $i) echo 'active'; ?>" style="<?php if(!@$section['trial'] && pzk_request()->getTopic()!=$section['id']):?>display: none;<?php endif;?>"><a onclick="return check_display(<?php echo @$media['trial']?>);"class="getdata" href="/practice/class-<?php echo $class ?>/subject-<?php echo $subjectEntity->getalias()?>-<?php echo $subject ?>/topic-<?php echo @$section['alias']?>-<?php echo @$section['id']?>/media-<?php echo @$media['id']?>"><?php echo @$media['name']?></a></li>
											<?php	}
											for($i = 1; $i <= $practices; $i++){  ?>
												<li class="list-group-item hasa exercise-of-topic-<?php echo @$section['id']?> <?php if(pzk_request()->getTopic()==$section['id'] && pzk_request()->getDe() == $i) echo 'active'; ?>" style="<?php if(!@$section['trial'] && pzk_request()->getTopic()!=$section['id']):?>display: none;<?php endif;?>"><a  onclick="de=<?php echo $i ?>; return check_display(<?php echo @$section['trial']?>);" data-de="<?php echo $i; ?>" class="getdata" href="/practice/class-<?php echo $class ?>/subject-<?php  echo $subjectEntity->getalias() ?>-<?php echo $subject ?>/topic-<?php echo @$section['alias']?>-<?php echo @$section['id']?>/examination-<?php echo $i ?>"><?php echo $language['lesson'].$i;?></a></li>
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
												
												echo '<li class="level3-2'.(@$topic['trial'] ? ' trial-3-level-2': '').'"  onclick="$(\'.exercise-of-topic-'.$topic['id'].'\').toggle();" onmouseover="$(this).css(\'border-bottom\', \'1px solid #333\');" onmouseout="$(this).css(\'border-bottom\', \'none\');"><strong>'; ?>
												<?php if(pzk_user_special()): ?>#<?php echo @$topic['id']?> - <?php endif; ?>
												<?php echo $topic_name.'</strong><span class="glyphicon glyphicon-play-circle" style="float: right;"></span></li>';
												$practices = $data->getPracticesSN($class,$topic['id']);
												$medias		=	$data->getMedias($topic['id']);
													foreach($medias as $media) {  ?>
														<li class="list-group-item hasa exercise-of-topic-<?php echo @$topic['id']?> <?php if(pzk_request()->getTopic()==$topic['id'] && pzk_request()->getDe() == $i) echo'active'; ?>" style="<?php if(!@$topic['trial'] && pzk_request()->getTopic()!=$topic['id']):?>display: none;<?php endif;?>"><a  onclick="return check_display(<?php echo @$media['trial']?>);"class="getdata" href="/practice/class-<?php echo $class ?>/subject-<?php echo $subjectEntity->getalias()?>-<?php echo $subject ?>/topic-<?php echo @$topic['alias']?>-<?php echo @$topic['id']?>/media-<?php echo @$media['id']?>"><?php echo @$media['name']?></a></li>
											<?php	}
												for($i = 1; $i <= $practices; $i++){  ?>
													<li class="list-group-item hasa exercise-of-topic-<?php echo @$topic['id']?> <?php if(pzk_request()->getTopic()==$topic['id'] && pzk_request()->getDe() == $i) echo'active'; ?>" style="<?php if(!@$topic['trial'] && pzk_request()->getTopic()!=$topic['id']):?>display: none;<?php endif;?>"><a  onclick="de=<?php echo $i ?>; return check_display(<?php echo @$topic['trial']?>);" data-de="<?php echo $i; ?>" class="getdata" href="/practice/class-<?php echo $class ?>/subject-<?php  echo $subjectEntity->getalias()?>-<?php echo $subject ?>/topic-<?php echo @$topic['alias']?>-<?php echo @$topic['id']?>/examination-<?php echo $i ?>"><?php echo $language['lesson'].$i;?></a></li>
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
										
										echo '<li class="level4 '.(@$section1['trial'] ? ' trial-4-level-1': '').'" ><strong>';
										?>
										<?php if(pzk_user_special()): ?>#<?php echo @$section1['id']?> - <?php endif; ?>
										<?php echo $section1_name.'</strong></li>';
										$sections2= $data->getTopicsSN($section1['id'], $class);
										if(count($sections2) == 0) {
											$practices = $data->getPracticesSN($class,$section1['id']);
											$medias		=	$data->getMedias($section1['id']);
													foreach($medias as $media) {  ?>
														<li class="list-group-item hasa exercise-of-topic-<?php echo @$section1['id']?> <?php if(pzk_request()->getTopic()==$section1['id'] && pzk_request()->getDe() == $i) echo 'active'; ?>" style="<?php if(!@$section1['trial'] && pzk_request()->getTopic()!=$section1['id']):?>display: none;<?php endif;?>"><a  onclick="return check_display(<?php echo @$media['trial']?>, 52);" class="getdata" href="/practice/class-<?php echo $class ?>/subject-<?php echo $subjectEntity->getalias()?>-<?php echo $subject ?>/topic-<?php echo @$section1['alias']?>-<?php echo @$section1['id']?>/media-<?php echo @$media['id']?>"><?php echo @$media['name']?></a></li>
											<?php	}
											for($i = 1; $i <= $practices; $i++){  ?>
												<li class="list-group-item hasa exercise-of-topic-<?php echo @$section1['id']?> <?php if(pzk_request()->getTopic()==$section1['id'] && pzk_request()->getDe() == $i) echo 'active'; ?>" style="<?php if(!@$section1['trial'] && pzk_request()->getTopic()!=$section1['id']):?>display: none;<?php endif;?>" ><a  onclick="de=<?php echo $i ?>; return check_display(<?php echo @$section1['trial']?>);" data-de="<?php echo $i; ?>" class="getdata" href="/practice/class-<?php echo $class ?>/subject-<?php echo $subjectEntity->getalias()?>-<?php echo $subject ?>/topic-<?php echo @$section1['alias']?>-<?php echo @$section1['id']?>/examination-<?php echo $i ?>"><?php echo $language['lesson'].$i;?></a></li>
											<?php 
											}
										} else {
											foreach ($sections2 as $section2) {
												if ($lang == 'en' || $lang == 'ev'){
													$section_name = $section2['name_en'];
												}else{
													$section_name = $section2['name'];
												}
												
												echo '<li onclick="$(\'.exercise-of-topic-'.$section2['id'].'\').toggle();" onmouseover="$(this).css(\'border-bottom\', \'1px solid #333\');" onmouseout="$(this).css(\'border-bottom\', \'none\');" class="level4-1 '.(@$section2['trial'] ? ' trial-4-level-2': '').'" ><strong>';?>
												<?php if(pzk_user_special()): ?>#<?php echo @$section2['id']?> - <?php endif; ?>
												<?php echo $section_name.'</strong><span class="glyphicon glyphicon-play-circle" style="float: right;"></span>';
												$topicChilds= $data->getTopicsSN($section2['id'], $class);
												if(count($topicChilds) == 0) {
													$practices = $data->getPracticesSN($class,$section2['id']);
													$medias		=	$data->getMedias($section2['id']);
													foreach($medias as $media) {  ?>
														<li class="list-group-item hasa exercise-of-topic-<?php echo @$section2['id']?> <?php if(pzk_request()->getTopic()==$section2['id'] && pzk_request()->getDe() == $i) echo 'active'; ?>" style="<?php if(!@$section2['trial'] && pzk_request()->getTopic()!=$section2['id']):?>display: none;<?php endif;?>"><a onclick="return check_display(<?php echo @$media['trial']?>, 52);"class="getdata" href="/practice/class-<?php echo $class ?>/subject-<?php echo $subjectEntity->getalias()?>-<?php echo $subject ?>/topic-<?php echo @$section2['alias']?>-<?php echo @$section2['id']?>/media-<?php echo @$media['id']?>"><?php echo @$media['name']?></a></li>
											<?php	}
													for($i = 1; $i <= $practices; $i++){  ?>
														<li class="list-group-item hasa exercise-of-topic-<?php echo @$section2['id']?> <?php if(pzk_request()->getTopic()==$section2['id'] && pzk_request()->getDe() == $i) echo 'active'; ?>" style="<?php if(!@$section2['trial'] && pzk_request()->getTopic()!=$section2['id']):?>display: none;<?php endif;?>"><a  onclick="de=<?php echo $i ?>; return check_display(<?php echo @$section2['trial']?>);" data-de="<?php echo $i; ?>" class="getdata" href="/practice/class-<?php echo $class ?>/subject-<?php echo $subjectEntity->getalias()?>-<?php echo $subject ?>/topic-<?php echo @$section2['alias']?>-<?php echo @$section2['id']?>/examination-<?php echo $i ?>"><?php echo $language['lesson'].$i;?></a></li>
													<?php 
													}
												} else {
													foreach ($topicChilds as $topic) {
														
														if ($lang == 'en' || $lang == 'ev'){
															$topic_name = $topic['name_en'];
														}else{
															$topic_name = $topic['name'];
														}
														
														echo '<li onclick="$(\'.exercise-of-topic-'.$topic['id'].'\').toggle();" class="level4-2 '.(@$topic['trial'] ? ' trial-4-level-3': '').'"  onmouseover="$(this).css(\'border-bottom\', \'1px solid #333\');" onmouseout="$(this).css(\'border-bottom\', \'none\');"><strong>';
														?>
														<?php if(pzk_user_special()): ?>#<?php echo @$topic['id']?> - <?php endif; ?>
														<?php echo $topic_name.'</strong><span class="glyphicon glyphicon-play-circle" style="float: right;"></span></li>';
														$practices = $data->getPracticesSN($class,$topic['id']);
														$medias		=	$data->getMedias($topic['id']);
														foreach($medias as $media) {  ?>
															<li class="list-group-item hasa <?php if(pzk_request()->getTopic()==$topic['id'] && pzk_request()->getDe() == $i) echo'active'; ?>" style="<?php if(pzk_request()->getTopic()!=$topic['id']):?>display: none;<?php endif;?>"><a onclick="return check_display(<?php echo @$media['trial']?>, 52);"class="getdata" href="/practice/class-<?php echo $class ?>/subject-<?php echo $subjectEntity->getalias()?>-<?php echo $subject ?>/topic-<?php echo @$topic['alias']?>-<?php echo @$topic['id']?>/media-<?php echo @$media['id']?>"><?php echo @$media['name']?></a></li>
												<?php	}
														for($i = 1; $i <= $practices; $i++){  ?>
															<li class="list-group-item hasa exercise-of-topic-<?php echo @$topic['id']?> <?php if(pzk_request()->getTopic()==$topic['id'] && pzk_request()->getDe() == $i) echo'active'; ?>" style="<?php if(pzk_request()->getTopic()!=$topic['id']):?>display: none;<?php endif;?>"><a  onclick="de=<?php echo $i ?>; return check_display(<?php echo @$topic['trial']?>);" data-de="<?php echo $i; ?>" class="getdata" href="/practice/class-<?php echo $class ?>/subject-<?php echo $subjectEntity->getalias()?>-<?php echo $subject ?>/topic-<?php echo @$topic['alias']?>-<?php echo @$topic['id']?>/examination-<?php echo $i ?>"><?php echo $language['lesson'].$i;?></a></li>
														<?php 
														} 
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
	subject = <?php echo pzk_request()->getSegment(3); ?>;
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
<?php endif;?>
<?php 
	$dataCategoryCurrent =  $data->getCategoryCurrentEnglish();
	
 ?>
 </div>
 <img class="item mgt-60" src="/Themes/Songngu3/skin/images/bottom-content.png"/>
 
 
 