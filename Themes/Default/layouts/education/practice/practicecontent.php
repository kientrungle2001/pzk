<?php  
	$category 			= $data->getCategory();
	$category_id 		= $data->getCategoryId();
	$category_name 		= $data->getCategoryName();
	$subject			= intval(pzk_request()->getSegment(3));
	$check				= pzk_session('checkPayment');
	$class				= 5;
	if($subject) {
		$subjectEntity 	= _db()->getTableEntity('categories')->load($subject, 1800);
		$parentSubject 	= $subjectEntity->getParent();
	}
	$practices 			= $data->getPractices($class,$subject, $check);
	
?>
<?php if(empty($category)):?>
	
<?php else:?>
<div class="container">
	<p class="t-weight text-center btn-custom8 mgright textcl">Luyện tập - Lớp <?php echo $class;?></p>
</div>
<h3 class="text-center text-uppercase"><strong><?=$category_name['name']?></strong></h3>
<div class="container">
	<div class="row">
		<div class="col-md-1 col-xs-1"></div>
		<div class="col-md-10 col-xs-10">
			<div class="row">
				<div class="col-xs-12 col-md-8 col-sm-8 pull-left mgleft">
				<?php if(!empty($category['child'])):?>
					<?php $data->displayChildren('[position=choice]') ?>
					<div class="dropdown col-md-6 col-sm-6 col-xs-12 mgleft">
					<button class="btn fix_hover btn-default col-md-12 col-sm-12 col-xs-12 sharp" type="button"><span id="chonde" class="fontsize19"> Chọn bài</span><img class="img-responsive imgwh hidden-xs hidden-sm pull-right" src="<?=BASE_SKIN_URL?>/Default/skin/nobel/Themes/Story/media/icon1.png" /></span>
					</button>
						<ul class="dropdown-menu col-md-12 col-sm-12 col-xs-12" style="top:40px; max-height:350px; overflow-y: scroll;">
						<?php if($category_id == 88) {
								$dataCategoryCurrent =  $data->getCategoryCurrentObservation();
							if(@$dataCategoryCurrent['child'])
							foreach($dataCategoryCurrent['child'] as $k =>$value):?>
							<li><a onclick="subject = <?php echo @$value['id']?>;document.getElementById('chonde').innerHTML = '<?php echo @$value['name']?>';" data-de="<?php echo @$value['name']?>" class="getdata" href="/practice/doQuestion/<?php echo @$value['id']?>?class=5&de=<?php echo @$value['name']?>" data-type="group"><?php if(pzk_user_special()): ?>#<?php echo @$value['id']?><?php endif;?> - <?php echo @$value['name']?> <?php if($check == 0){ echo "Bài dùng thử";} ?></a></li>
						<?php endforeach;
						} else { ?>
							<?php 
								$level = $data -> getLevel($subject);
								if($level== '1'){
									$practices = $data->getPractices($class,$subject, $check);
										for($i = 1; $i <= $practices; $i++){  ?>
											<li ><a style="padding-left: 40px;" onclick="document.getElementById('chonde').innerHTML = '<?php echo "Bài ".$i; ?>'; de=<?php echo $i ?>; " data-de="<?php echo $i; ?>" class="getdata" href="/practice/class-5/subject-<?php echo $subjectEntity->getalias()?>-<?php echo $subject ?>/examination-<?php echo $i ?>"><?php echo "Bài ".$i;?><?php if($check == 0){ echo " - Bài dùng thử"; }?></a></li>
										<?php } //end for
								}elseif($level== '2'){
									$topics= $data->getTopics($subject, $check);
									
										foreach ($topics as $topic) {
											echo '<li class="left20" style="color:#d9534f"><h5><strong>'.$topic['name'].'</strong></h5>';
											$practices = $data->getPractices($class,$topic['id'], $check);
											for($i = 1; $i <= $practices; $i++){  ?>
												<li ><a style="padding-left: 40px;" onclick="document.getElementById('chonde').innerHTML = '<?php echo "Bài ".$i; ?>'; de=<?php echo $i ?>; " data-de="<?php echo $i; ?>" class="getdata" href="/practice/class-5/subject-<?php echo $subjectEntity->getalias()?>-<?php echo $subject ?>/topic-<?php echo @$topic['alias']?>-<?php echo @$topic['id']?>/examination-<?php echo $i ?>"><?php echo "Bài ".$i;?><?php if($check == 0){ echo " - Bài dùng thử"; }?></a></li>
											<?php } //end for
										} //end foreach

								}elseif($level== '3'){
									$sections= $data->getTopics($subject, $check);
									foreach ($sections as $section) {
										echo '<li class="left10'.(@$section['trial'] ? ' trial-3-level-1': '').'" style="color:#2696c4"><h5><strong>';?><?php if(pzk_user_special()): ?>#<?php echo @$section['id']?><?php endif;?> - <?php echo $section['name'].'</strong></h5>';
										$topicChilds= $data->getTopics($section['id'], $check);
										if(count($topicChilds) == 0) {
											$practices = $data->getPractices($class,$section['id'], $check);
											for($i = 1; $i <= $practices; $i++){  ?>
												<li ><a style="padding-left: 40px;" onclick="document.getElementById('chonde').innerHTML = '<?php echo "Bài ".$i; ?>'; de=<?php echo $i ?>; " data-de="<?php echo $i; ?>" class="getdata" href="/practice/class-5/subject-<?php echo $subjectEntity->getalias()?>-<?php echo $subject ?>/topic-<?php echo @$section['alias']?>-<?php echo @$section['id']?>/examination-<?php echo $i ?>"><?php echo "Bài ".$i;?><?php if($check == 0){ echo " - Bài dùng thử"; }?></a></li>
											<?php 
											}
										} else {										
											foreach ($topicChilds as $topic) {
												echo '<li class="left20'.(@$topic['trial'] ? ' trial-3-level-2': '').'" style="color:#d9534f"><strong>';?><?php if(pzk_user_special()): ?>#<?php echo @$topic['id']?><?php endif;?> - <?php echo $topic['name'].'</strong>';
												$practices = $data->getPractices($class,$topic['id'], $check);
												for($i = 1; $i <= $practices; $i++){  ?>
													<li ><a style="padding-left: 40px;" onclick="document.getElementById('chonde').innerHTML = '<?php echo "Bài ".$i; ?>'; de=<?php echo $i ?>; " data-de="<?php echo $i; ?>" class="getdata" href="/practice/class-5/subject-<?php echo $subjectEntity->getalias()?>-<?php echo $subject ?>/topic-<?php echo @$topic['alias']?>-<?php echo @$topic['id']?>/examination-<?php echo $i ?>"><?php echo "Bài ".$i;?><?php if($check == 0){ echo " - Bài dùng thử"; }?></a></li>
												<?php 
												} 
											}
										}
									}

								}elseif($level == '4'){
									$sections1= $data->getTopics($subject, $check);
									foreach ($sections1 as $section1) {
										echo '<li class="left10'.(@$section1['trial'] ? ' trial-4-level-1': '').'" style="color:#B6D452"><h5><strong>';?><?php if(pzk_user_special()): ?>#<?php echo @$section1['id']?><?php endif;?> - <?php echo $section1['name'].'</strong></h5>';
										$sections2= $data->getTopics($section1['id'], $check);
										if(count($sections2) == 0) {
											$practices = $data->getPractices($class,$section1['id'], $check);
											for($i = 1; $i <= $practices; $i++){  ?>
												<li ><a style="padding-left: 50px;" onclick="document.getElementById('chonde').innerHTML = '<?php echo "Bài ".$i; ?>'; de=<?php echo $i ?>; " data-de="<?php echo $i; ?>" class="getdata" href="/practice/class-5/subject-<?php echo $subjectEntity->getalias()?>-<?php echo $subject ?>/topic-<?php echo @$section1['alias']?>-<?php echo @$section1['id']?>/examination-<?php echo $i ?>"><?php echo "Bài ".$i;?><?php if($check == 0){ echo " - Bài dùng thử"; }?></a></li>
											<?php 
											}
										} else {
											foreach ($sections2 as $section2) {
												echo '<li class="left20'.(@$section2['trial'] ? ' trial-4-level-2': '').'" style="color:#2696c4"><h5><strong>';?><?php if(pzk_user_special()): ?>#<?php echo @$section2['id']?><?php endif;?> - <?php echo $section2['name'].'</strong></h5>';
												$topicChilds= $data->getTopics($section2['id'], $check);
												if(count($topicChilds) == 0) {
													$practices = $data->getPractices($class,$section2['id'], $check);
													for($i = 1; $i <= $practices; $i++){  ?>
														<li ><a style="padding-left: 50px;" onclick="document.getElementById('chonde').innerHTML = '<?php echo "Bài ".$i; ?>'; de=<?php echo $i ?>; " data-de="<?php echo $i; ?>" class="getdata" href="/practice/class-5/subject-<?php echo $subjectEntity->getalias()?>-<?php echo $subject ?>/topic-<?php echo @$section2['alias']?>-<?php echo @$section2['id']?>/examination-<?php echo $i ?>"><?php echo "Bài ".$i;?><?php if($check == 0){ echo " - Bài dùng thử"; }?></a></li>
													<?php 
													}
												} else {
													foreach ($topicChilds as $topic) {
														echo '<li class="'.(@$topic['trial'] ? ' trial-4-level-3': '').'" style="color:#d9534f; padding-left: 40px;"><h5><strong>';?><?php if(pzk_user_special()): ?>#<?php echo @$topic['id']?><?php endif;?> - <?php echo $topic['name'].'</strong></h5>';
														$practices = $data->getPractices($class,$topic['id'], $check);
														for($i = 1; $i <= $practices; $i++){  ?>
															<li ><a style="padding-left: 50px;" onclick="document.getElementById('chonde').innerHTML = '<?php echo "Bài ".$i; ?>'; de=<?php echo $i ?>; " data-de="<?php echo $i; ?>" class="getdata" href="/practice/class-5/subject-<?php echo $subjectEntity->getalias()?>-<?php echo $subject ?>/topic-<?php echo @$topic['alias']?>-<?php echo @$topic['id']?>/examination-<?php echo $i ?>"><?php echo "Bài ".$i;?><?php if($check == 0){ echo " - Bài dùng thử"; }?></a></li>
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
				<div class="col-xs-4 col-md-4 bd">
					<div class="row">
						<div class="col-md-3 col-xs-2 hidden-xs"></div>
						<div class="col-md-3 col-xs-4 hidden-xs">
							<img  src="<?=BASE_SKIN_URL?>/Default/skin/nobel/Themes/Story/media/dongho.png"  class=" wh40 img-responsive"/>
						</div>
						<div class="col-md-3 col-xs-4">
							<h4 class="text-center robotofont"><strong>10:00</strong></h4>
						</div>
						<div class="col-md-3 col-xs-2"></div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<div class="container">
	<div class="row bot20">
		<div class="col-md-1 col-xs-1"></div>
		<div class="change col-md-10 col-xs-10 bd-div bgclor imgbg">
			
		</div>
		<div class="col-md-1 col-xs-1"></div>
	</div>
</div>
<script>
	numberclass = <?php echo intval(pzk_request('class')); ?>;
	de = null;
	subject = <?php echo intval(pzk_request()->getSegment(3)); ?>;
	de_type = null;
	$(function(){
		
		$( ".fix_hover" )
		  .mouseover(function() {
			$('.nomgin2').show();
		  });
		$( ".fix_hover2" )
		  .mouseover(function() {
			$('.nomgin3').show();
		  });

		
		$(".getdata").click(function(){
			de = $(this).data("de");
			de_type =	$(this).data("type");
			$('.nomgin2').hide();
		});
		$(".start").click(function(){
			if (de == null) {
				alert('Bạn cần phải chọn đề');
			} else {
				var alias =$(this).data("alias");
				if(de_type == 'group') {
					window.location = BASE_REQUEST+'/practice/doQuestion/'+subject +'?/class='+numberclass+'&de='+de;
				} else {
					window.location = BASE_REQUEST+'/practice/class-'+numberclass+'/subject-'+alias+'-'+subject+'/examination-'+de;
				}
				
			return false;
			}
		});	
	});
	
</script>
<?php endif;?>