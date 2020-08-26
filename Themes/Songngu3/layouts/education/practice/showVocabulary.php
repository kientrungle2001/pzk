<?php
	
	
	$check = pzk_session('checkPayment');
	

	$class= pzk_session('lop');
	$de=pzk_request()->getDe();
	if(pzk_request()->getSubject()){
		$psubject = pzk_request()->getSubject();
	}else{
		$psubject=pzk_request()->getSegment(3);
	}
	$subject=pzk_request()->getSegment(3);
	$parentSubject = 0;
	if($subject) {
		
		$subjectEntity = _db()->getTableEntity('categories')->load($subject, 1800);
		$parentSubject = $subjectEntity->getParent();
	}
	
	$language = pzk_global()->getLanguage();
	$lang = pzk_session('language');
?>

<?php if(pzk_session('login')) { ?>




<div class="item bgcontent">

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
						?>
						<li  class="list-group-item hasa <?php if(pzk_request()->getTopic() == $value['id']) echo 'active' ;?>"><a onclick="subject = <?php echo @$value['id']?>;return check_display(<?php echo @$value['trial']?>);" data-de="<?php echo @$value['name']?>" class="getdata" href="/practice/doQuestion/<?php echo @$value['id']?>?subject=<?php echo $psubject ?>&class=<?php echo $class ?>&de=<?php echo @$value['name']?>"><?php echo @$value['name']?></a></li>
					<?php endforeach;
					} else { ?>
						<?php 
								$topicPost= pzk_request()->getTopic();
								$subjectPost= $subject;
								$level = $data -> getLevel($subject);
								//echo $level;
								if($level == '1'){
									$catetype = $data -> getCatetype($subject);
									$practices = $data->getPracticesSN($class,$subject);
									$medias		=	$data->getMedias($subject);
									foreach($medias as $media) {  ?>
										<li class="list-group-item"><a onclick="return check_display(<?php echo @$media['trial']?>);"class="getdata" href="/practice/class-<?php echo $class ?>/subject-<?php echo $subjectEntity->getalias()?>-<?php echo $subject ?>/media-<?php echo @$media['id']?>"><?php echo @$media['name']?></a></li>
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
														<li class="list-group-item hasa hasdot exercise-of-topic-<?php echo @$topic['id']?> <?php if(pzk_request()->getTopic() == $topic['id'] && pzk_request()->getDe() == $i) echo 'active'; ?>" style="<?php if(pzk_request()->getTopic() != $topic['id']):?>display: none;<?php endif;?>"><a  onclick="return check_display(<?php echo @$media['trial']?>);"class="getdata" href="/practice/class-<?php echo $class ?>/subject-<?php echo $subjectEntity->getalias()?>-<?php echo $subject ?>/topic-<?php echo @$topic['alias']?>-<?php echo @$topic['id']?>/media-<?php echo @$media['id']?>"><?php echo @$media['name']?></a></li>
											<?php	}
											
										for($i = 1; $i <= $practices; $i++){  ?>
											<li class="list-group-item hasa hasdot exercise-of-topic-<?php echo @$topic['id']?> <?php if(pzk_request()->getTopic() == $topic['id'] && pzk_request()->getDe() == $i) echo 'active'; ?>" style="<?php if(pzk_request()->getTopic() != $topic['id']):?>display: none;<?php endif;?>" ><a  onclick="de=<?php echo $i ?>; return check_display(<?php echo @$topic['trial']?>);" data-de="<?php echo $i; ?>" class="getdata" href="/practice/class-<?php echo $class ?>/subject-<?php echo $subjectEntity->getalias()?>-<?php echo $subject ?>/topic-<?php echo @$topic['alias']?>-<?php echo @$topic['id']?>/examination-<?php echo $i ?>"><?php echo $language['lesson'].$i;?></a></li>
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
										
										echo '<li style="background:white;border:none; text-align: left;" class="level3'.(@$section['trial'] ? ' trial-3-level-1': '').'" style="color:#2696c4;cursor: pointer;" onclick="$(\'.exercise-of-topic-'.$section['id'].'\').toggle();" onmouseover="$(this).css(\'border-bottom\', \'1px solid #333\');" onmouseout="$(this).css(\'border-bottom\', \'none\');"><div><strong>'.(pzk_user_special()? '#' . $section['id'] . ' ':'').$section_name.'</strong><img src="/Themes/Songngu3/skin/images/right-dr.png" style="float: right;"/></div></li>';
										$topicChilds= $data->getTopicsSN($section['id'], $class);
										if(count($topicChilds) == 0) {
											$practices = $data->getPracticesSN($class,$section['id']);
											
											
										$medias		=	$data->getMedias($section['id']);
													foreach($medias as $media) {  ?>
														<li class="list-group-item hasa hasdot exercise-of-topic-<?php echo @$section['id']?> <?php if(pzk_request()->getTopic()==$section['id'] && pzk_request()->getDe() == $i) echo 'active'; ?>" style="<?php if(!@$section['trial'] && pzk_request()->getTopic()!=$section['id']):?>display: none;<?php endif;?>"><a onclick="return check_display(<?php echo @$media['trial']?>);"class="getdata" href="/practice/class-<?php echo $class ?>/subject-<?php echo $subjectEntity->getalias()?>-<?php echo $subject ?>/topic-<?php echo @$section['alias']?>-<?php echo @$section['id']?>/media-<?php echo @$media['id']?>"><?php echo @$media['name']?></a></li>
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
												
												echo '<li style="background:white;border:none; text-align: left;" class="'.(@$topic['trial'] ? ' trial-3-level-2': '').'" style="color:#d9534f;cursor: pointer;" onclick="$(\'.exercise-of-topic-'.$topic['id'].'\').toggle();" onmouseover="$(this).css(\'border-bottom\', \'1px solid #333\');" onmouseout="$(this).css(\'border-bottom\', \'none\');"><strong>'.(pzk_user_special()? '#' . $topic['id'] . ' ':'').$topic_name.'</strong><img src="/Themes/Songngu3/skin/images/right-dr.png" style="float: right;"/></li>';

												$practices = $data->getPractices($class,$topic['id'], $check);
												//$practices = $data->getPractices($class,$topic['id']);
												//$practices = $data->getPracticesSN($class,$topic['id']);
												
										$medias		=	$data->getMedias($topic['id']);
													foreach($medias as $media) {  ?>
														<li class="list-group-item hasa hasdot exercise-of-topic-<?php echo @$topic['id']?> <?php if(pzk_request()->getTopic()==$topic['id'] && pzk_request()->getDe() == $i) echo'active'; ?>" style="<?php if(!@$topic['trial'] && pzk_request()->getTopic()!=$topic['id']):?>display: none;<?php endif;?>"><a onclick="return check_display(<?php echo @$media['trial']?>);"class="getdata" href="/practice/class-<?php echo $class ?>/subject-<?php echo $subjectEntity->getalias()?>-<?php echo $subject ?>/topic-<?php echo @$topic['alias']?>-<?php echo @$topic['id']?>/media-<?php echo @$media['id']?>"><?php echo @$media['name']?></a></li>
											<?php	}
												for($i = 1; $i <= $practices; $i++){  ?>
													<li class="list-group-item hasa exercise-of-topic-<?php echo @$topic['id']?> <?php if(pzk_request()->getTopic()==$topic['id'] && pzk_request()->getDe() == $i) echo'active'; ?>" style="<?php if(!@$topic['trial'] && pzk_request()->getTopic()!=$topic['id']):?>display: none;<?php endif;?>"><a  onclick="de=<?php echo $i ?>; return check_display(<?php echo @$topic['trial']?>);" data-de="<?php echo $i; ?>" class="getdata" href="/practice/class-<?php echo $class ?>/subject-<?php echo $subjectEntity->getalias()?>-<?php echo $subject ?>/topic-<?php echo @$topic['alias']?>-<?php echo @$topic['id']?>/examination-<?php echo $i ?>"><?php echo $language['lesson'].$i;?></a></li>
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
												echo '<li style="background:white;border:none; text-align: left;" onclick="$(\'.exercise-of-topic-'.$section2['id'].'\').toggle();" onmouseover="$(this).css(\'border-bottom\', \'1px solid #333\');" onmouseout="$(this).css(\'border-bottom\', \'none\');" class="'.(@$section2['trial'] ? ' trial-4-level-2': '').'" style="color:#2696c4;cursor: pointer;"><div><strong>'. (pzk_user_special()? '#' . $section2['id'] . ' ':'') .$section2_name.'</strong><img src="/Themes/Songngu3/skin/images/right-dr.png" style="float: right;"/></div>';
												$topicChilds= $data->getTopicsSN($section2['id'], $class);
												if(count($topicChilds) == 0) {
													$practices = $data->getPracticesSN($class,$section2['id']);
													
										$medias		=	$data->getMedias($section2['id']);
													foreach($medias as $media) {  ?>
														<li class="list-group-item hasa hasdot exercise-of-topic-<?php echo @$section2['id']?> <?php if(pzk_request()->getTopic()==$section2['id'] && pzk_request()->getDe() == $i) echo 'active'; ?>" style="<?php if(!@$section2['trial'] && pzk_request()->getTopic()!=$section2['id']):?>display: none;<?php endif;?>"><a  onclick="return check_display(<?php echo @$media['trial']?>);"class="getdata" href="/practice/class-<?php echo $class ?>/subject-<?php echo $subjectEntity->getalias()?>-<?php echo $subject ?>/topic-<?php echo @$section2['alias']?>-<?php echo @$section2['id']?>/media-<?php echo @$media['id']?>"><?php echo @$media['name']?></a></li>
											<?php	}
													for($i = 1; $i <= $practices; $i++){  ?>
														<li class="list-group-item hasa hasdot exercise-of-topic-<?php echo @$section2['id']?> <?php if(pzk_request()->getTopic()==$section2['id'] && pzk_request()->getDe() == $i) echo 'active'; ?>" style="<?php if(!@$section2['trial'] && pzk_request()->getTopic()!=$section2['id']):?>display: none;<?php endif;?>"><a  onclick="de=<?php echo $i ?>; return check_display(<?php echo @$section2['trial']?>);" data-de="<?php echo $i; ?>" class="getdata" href="/practice/class-<?php echo $class ?>/subject-<?php echo $subjectEntity->getalias()?>-<?php echo $subject ?>/topic-<?php echo @$section2['alias']?>-<?php echo @$section2['id']?>/examination-<?php echo $i ?>"><?php echo $language['lesson'].$i;?></a></li>
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
														
														echo '<li style="background:white;border:none; text-align: left;" onclick="$(\'.exercise-of-topic-'.$topic['id'].'\').toggle();" class="'.(@$topic['trial'] ? ' trial-4-level-3': '').'"  onmouseover="$(this).css(\'border-bottom\', \'1px solid #333\');" onmouseout="$(this).css(\'border-bottom\', \'none\');"><div><strong>'.(pzk_user_special()? '#' . $topic['id'] . ' ':'' ).$topic_name.'</strong><img src="/Themes/Songngu3/skin/images/right-dr.png" style="float: right;"/></div></li>';
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
		<div class="col-md-9  content-full col-sm-12  col-xs-12">
		
			<div class="item fs18 top-content bold">	
			  <?php //echo 'Lớp '. $class; ?> 
			  <a href="/#practice"><?php echo $language['pclass'];?></a> &nbsp; > &nbsp;
			  <a href="/practice/class-<?=$class;?>/subject-<?=$subjectEntity->getalias();?>-<?=$subjectEntity->getId();?>">
			  <?php 
				if ($lang == 'en' || $lang == 'ev'){
					echo $subjectEntity->getName_en();
				}else{
					echo $subjectEntity->getName_vn();
				}
				 ?>
				 </a>
			</div>	
		
			<div  class="item change">
			</div>
			
			
		</div>
		
		
	</div>

	
</div>



<!-- End Modal popover view-result -->

<script>
	
	

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