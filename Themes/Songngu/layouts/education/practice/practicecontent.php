<div class="container top10">
<marquee>
Để tra Từ điển và nghe loa đọc của bất kì từ tiếng Anh nào trong phần mềm, bạn chỉ cần Click đúp vào từ đó.
</marquee>
</div>

<?php  
	$category = $data->get('category');
	$category_id = $data->get('categoryId');
	$category_name = $data->get('categoryName');
	$subject=pzk_request()->getSegment(3);
	$check = pzk_session('checkPayment');
	$class= pzk_session('lop');
	if($subject) {
		$subjectEntity = _db()->getTableEntity('categories')->load($subject, 1800);
		$parentSubject = $subjectEntity->get('parent');
	}
	$language = pzk_global()->get('language');
	$lang = pzk_session('language');
?>
<div class="container top10 hidden-xs">
	<p class="t-weight text-center btn-custom8 mgright textcl">
	<?php echo $language['classnumber'].$class;?> - 
	<?php 
	if($check == 1){
		echo $language['pclass'];
	}else{
		echo $language['trialpractice'];
	}
	?> 
	</p>
</div>
<div class="container top10 visible-xs">
	<p class="t-weight text-center btn-custom8 textcl">
	<?php echo $language['classnumber'].$class;?> - 
	<?php 
	if($check == 1){
		echo $language['pclass'];
	}else{
		echo $language['trialpractice'];
	}
	?> 
	</p>
</div>
<?php if(empty($category)):?>
	
<?php else:?>
<?php if(pzk_session('login')) { ?>

<div class="container top10">
	<h3 class="text-center text-uppercase">
		<strong><?php 
			if ($lang == 'en' || $lang == 'ev'){
				echo $category_name['name_en'];
			}else{
				echo $category_name['name_vn'];
			}
			 ?>
		</strong>
	</h3>
</div>


<div class="container">
	<div class="row">
		<div class="col-md-1 col-xs-1"></div>
		<div class="col-md-10 col-xs-10">
			<div class="row">
				<?php if(!empty($category['child'])):?>
				{children [position=choice]}
				<div class="dropdown col-md-4 col-sm-4 col-xs-12 mgleft pd0 mg0">
					<button class="btn fix_hover btn-default col-md-12 col-sm-12 col-xs-12 sharp" type="button" data-toggle="dropdown" data-bind="enable: !noResults()" aria-haspopup="true" aria-expanded="true"><span id="chonde" class="fontsize19"><?php echo $language['choice'];?></span><img class="img-responsive imgwh hidden-xs hidden-sm pull-right" src="<?=BASE_SKIN_URL?>/Default/skin/nobel/Themes/Story/media/icon1.png" /></span>
					</button>
						<ul class="dropdown-menu col-md-12 col-sm-12 col-xs-12 list-group" style="top:38px; max-height:350px; overflow-y: scroll;">
						<?php if($category_id == 88) {
							$dataCategoryCurrent =  $data->get('categoryCurrentObservation');
							//var_dump($dataCategoryCurrent);die;
							if(@$dataCategoryCurrent['child'])
							foreach($dataCategoryCurrent['child'] as $k =>$value):
								if(strpos($value['classes'], $class) === false) continue;
						?>
							<li class="list-group-item"><a onclick="subject = {value[id]};document.getElementById('chonde').innerHTML = '{value[name]}'; return check_display({value[trial]});" data-de="{value[name]}" class="getdata" href="/practice/doQuestion/{value[id]}?subject={subject}&class={class}&de={value[alias]}" data-type="group"><?php if(pzk_user_special()): ?>#{value[id]} - <?php endif; ?>{value[name]}</a></li>
						<?php endforeach;
						} else { ?>
							<?php 
								$level = $data -> getLevel($subject);
								if($level== '1'){
									$catetype = $data -> getCatetype($subject);
									$practices = $data->getPracticesSN($class,$subject);
									$medias		=	$data->getMedias($subject);
									foreach($medias as $media) {  ?>
										<li class="list-group-item"><a style="padding-left: 40px;" onclick="return check_display(1);"class="getdata" href="/practice/class-{class}/subject-{subjectEntity.get('alias')}-{subject}/media-{media[id]}">{media[name]}</a></li>
							<?php	}
										for($i = 1; $i <= $practices; $i++){  ?>
											<li class="list-group-item"><a style="padding-left: 40px;" onclick="document.getElementById('chonde').innerHTML = '<?php echo $language['lesson'].$i; ?>'; de={i}; return check_display({catetype[trial]});" data-de="<?php echo $i; ?>" class="getdata" href="/practice/class-{class}/subject-{subjectEntity.get('alias')}-{subject}/examination-{i}"><?php echo $language['lesson'].$i;?></a></li>
										<?php } //end for
								}elseif($level== '2'){
									$topics= $data->getTopicsSN($subject, $class);
									
										foreach ($topics as $topic) {
											echo '<li class="left20" style="color:#d9534f;cursor: pointer;" onclick="$(\'.exercise-of-topic-'.$topic['id'].'\').toggle();"  onmouseover="$(this).css(\'border-bottom\', \'1px solid #333\');" onmouseout="$(this).css(\'border-bottom\', \'none\');"><h5><strong>'; ?>
											<?php if(pzk_user_special()): ?>#{topic[id]} - <?php endif; ?>
											<?php
											echo $topic['name'].'</strong><span class="glyphicon glyphicon-play-circle" style="float: right;"></span></h5></li>';
											$practices = $data->getPracticesSN($class,$topic['id']);
											
											$medias		=	$data->getMedias($topic['id']);
													foreach($medias as $media) {  ?>
														<li class="list-group-item"><a style="padding-left: 40px;" onclick="return check_display(1);"class="getdata" href="/practice/class-{class}/subject-{subjectEntity.get('alias')}-{subject}/topic-{topic[alias]}-{topic[id]}/media-{media[id]}">{media[name]}</a></li>
											<?php	}
											
											for($i = 1; $i <= $practices; $i++){  ?>
												
												<li class="list-group-item"><a style="padding-left: 40px;" onclick="document.getElementById('chonde').innerHTML = '<?php echo $language['lesson'].$i; ?>'; de={i}; return check_display({topic[trial]});" data-de="<?php echo $i; ?>" class="getdata" href="/practice/class-{class}/subject-{subjectEntity.get('alias')}-{subject}/topic-{topic[alias]}-{topic[id]}/examination-{i}"><?php echo $language['lesson'].$i;?></a></li>
											<?php } //end for
										} //end foreach

								}elseif($level== '3'){
									$sections= $data->getTopicsSN($subject, $class);
									foreach ($sections as $section) {
										echo '<li class="left10'.(@$section['trial'] ? ' trial-3-level-1': '').'" style="color:#2696c4;cursor: pointer;" onclick="$(\'.exercise-of-topic-'.$section['id'].'\').toggle();" onmouseover="$(this).css(\'border-bottom\', \'1px solid #333\');" onmouseout="$(this).css(\'border-bottom\', \'none\');"><h5><strong>'; ?>
										<?php if(pzk_user_special()): ?>#{section[id]} - <?php endif; ?>
										<?php
										echo $section['name'].'</strong><span class="glyphicon glyphicon-play-circle" style="float: right;"></span></h5></li>';
										$topicChilds= $data->getTopicsSN($section['id'], $class);
										if(count($topicChilds) == 0) {
											$practices = $data->getPracticesSN($class,$section['id']);
											$medias		=	$data->getMedias($section['id']);
													foreach($medias as $media) {  ?>
														<li class="list-group-item"><a style="padding-left: 40px;" onclick="return check_display(1);"class="getdata" href="/practice/class-{class}/subject-{subjectEntity.get('alias')}-{subject}/topic-{section[alias]}-{section[id]}/media-{media[id]}">{media[name]}</a></li>
											<?php	}
											for($i = 1; $i <= $practices; $i++){  ?>
												<li class="list-group-item"><a style="padding-left: 40px;" onclick="document.getElementById('chonde').innerHTML = '<?php echo $language['lesson'].$i; ?>'; de={i}; return check_display({section[trial]});" data-de="<?php echo $i; ?>" class="getdata" href="/practice/class-{class}/subject-{subjectEntity.get('alias')}-{subject}/topic-{section[alias]}-{section[id]}/examination-{i}"><?php echo $language['lesson'].$i;?></a></li>
											<?php 
											}
										} else {										
											foreach ($topicChilds as $topic) {
												echo '<li class="left20'.(@$topic['trial'] ? ' trial-3-level-2': '').'" style="color:#d9534f;cursor: pointer;" onclick="$(\'.exercise-of-topic-'.$topic['id'].'\').toggle();" onmouseover="$(this).css(\'border-bottom\', \'1px solid #333\');" onmouseout="$(this).css(\'border-bottom\', \'none\');"><strong>'; ?>
												<?php if(pzk_user_special()): ?>#{topic[id]} - <?php endif; ?>
												<?php echo $topic['name'].'</strong><span class="glyphicon glyphicon-play-circle" style="float: right;"></span></li>';
												$practices = $data->getPracticesSN($class,$topic['id']);
												$medias		=	$data->getMedias($topic['id']);
													foreach($medias as $media) {  ?>
														<li class="list-group-item"><a style="padding-left: 40px;" onclick="return check_display(1);"class="getdata" href="/practice/class-{class}/subject-{subjectEntity.get('alias')}-{subject}/topic-{topic[alias]}-{topic[id]}/media-{media[id]}">{media[name]}</a></li>
											<?php	}
												for($i = 1; $i <= $practices; $i++){  ?>
													<li class="list-group-item"><a style="padding-left: 40px;" onclick="document.getElementById('chonde').innerHTML = '<?php echo $language['lesson'].$i; ?>'; de={i}; return check_display({topic[trial]});" data-de="<?php echo $i; ?>" class="getdata" href="/practice/class-{class}/subject-{subjectEntity.get('alias')}-{subject}/topic-{topic[alias]}-{topic[id]}/examination-{i}"><?php echo $language['lesson'].$i;?></a></li>
												<?php 
												} 
											}
										}
									}

								}elseif($level == '4'){
									$sections1= $data->getTopicsSN($subject, $class);
									foreach ($sections1 as $section1) {
										echo '<li class="left10'.(@$section1['trial'] ? ' trial-4-level-1': '').'" style="color:#B6D452"><h5><strong>';
										?>
										<?php if(pzk_user_special()): ?>#{section1[id]} - <?php endif; ?>
										<?php echo $section1['name'].'</strong></h5></li>';
										$sections2= $data->getTopicsSN($section1['id'], $class);
										if(count($sections2) == 0) {
											$practices = $data->getPracticesSN($class,$section1['id']);
											$medias		=	$data->getMedias($section1['id']);
													foreach($medias as $media) {  ?>
														<li class="list-group-item"><a style="padding-left: 40px;" onclick="return check_display(1);"class="getdata" href="/practice/class-{class}/subject-{subjectEntity.get('alias')}-{subject}/topic-{section1[alias]}-{section1[id]}/media-{media[id]}">{media[name]}</a></li>
											<?php	}
											for($i = 1; $i <= $practices; $i++){  ?>
												<li class="list-group-item"><a style="padding-left: 50px;" onclick="document.getElementById('chonde').innerHTML = '<?php echo $language['lesson'].$i; ?>'; de={i}; return check_display({section1[trial]});" data-de="<?php echo $i; ?>" class="getdata" href="/practice/class-{class}/subject-{subjectEntity.get('alias')}-{subject}/topic-{section1[alias]}-{section1[id]}/examination-{i}"><?php echo $language['lesson'].$i;?></a></li>
											<?php 
											}
										} else {
											foreach ($sections2 as $section2) {
												echo '<li onclick="$(\'.exercise-of-topic-'.$section2['id'].'\').toggle();" onmouseover="$(this).css(\'border-bottom\', \'1px solid #333\');" onmouseout="$(this).css(\'border-bottom\', \'none\');" class="left20'.(@$section2['trial'] ? ' trial-4-level-2': '').'" style="color:#2696c4;cursor: pointer;"><h5><strong>';?>
												<?php if(pzk_user_special()): ?>#{section2[id]} - <?php endif; ?>
												<?php echo $section2['name'].'</strong><span class="glyphicon glyphicon-play-circle" style="float: right;"></span></h5>';
												$topicChilds= $data->getTopicsSN($section2['id'], $class);
												if(count($topicChilds) == 0) {
													$practices = $data->getPracticesSN($class,$section2['id']);
													$medias		=	$data->getMedias($section2['id']);
													foreach($medias as $media) {  ?>
														<li class="list-group-item"><a style="padding-left: 40px;" onclick="return check_display(1);"class="getdata" href="/practice/class-{class}/subject-{subjectEntity.get('alias')}-{subject}/topic-{section2[alias]}-{section2[id]}/media-{media[id]}">{media[name]}</a></li>
											<?php	}
													for($i = 1; $i <= $practices; $i++){  ?>
														<li class="list-group-item"><a style="padding-left: 50px;" onclick="document.getElementById('chonde').innerHTML = '<?php echo $language['lesson'].$i; ?>'; de={i}; return check_display({section2[trial]});" data-de="<?php echo $i; ?>" class="getdata" href="/practice/class-{class}/subject-{subjectEntity.get('alias')}-{subject}/topic-{section2[alias]}-{section2[id]}/examination-{i}"><?php echo $language['lesson'].$i;?></a></li>
													<?php 
													}
												} else {
													foreach ($topicChilds as $topic) {
														echo '<li onclick="$(\'.exercise-of-topic-'.$topic['id'].'\').toggle();" class="'.(@$topic['trial'] ? ' trial-4-level-3': '').'" style="color:#d9534f; padding-left: 40px;cursor: pointer;" onmouseover="$(this).css(\'border-bottom\', \'1px solid #333\');" onmouseout="$(this).css(\'border-bottom\', \'none\');"><h5><strong>';
														?>
														<?php if(pzk_user_special()): ?>#{topic[id]} - <?php endif; ?>
														<?php echo $topic['name'].'</strong><span class="glyphicon glyphicon-play-circle" style="float: right;"></span></h5></li>';
														$practices = $data->getPracticesSN($class,$topic['id']);
														$medias		=	$data->getMedias($topic['id']);
														foreach($medias as $media) {  ?>
															<li class="list-group-item"><a style="padding-left: 40px;" onclick="return check_display(1);"class="getdata" href="/practice/class-{class}/subject-{subjectEntity.get('alias')}-{subject}/topic-{topic[alias]}-{topic[id]}/media-{media[id]}">{media[name]}</a></li>
												<?php	}
														for($i = 1; $i <= $practices; $i++){  ?>
															<li class="list-group-item"><a style="padding-left: 50px;" onclick="document.getElementById('chonde').innerHTML = '<?php echo $language['lesson'].$i; ?>'; de={i}; return check_display({topic[trial]});" data-de="<?php echo $i; ?>" class="getdata" href="/practice/class-{class}/subject-{subjectEntity.get('alias')}-{subject}/topic-{topic[alias]}-{topic[id]}/examination-{i}"><?php echo $language['lesson'].$i;?></a></li>
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
				<div class="col-xs-12 col-md-4 col-sm-2 bd pull-right mgleft">
					<div class="row text-center">
						<div class="col-md-3 hidden-xs hidden-sm">
							<img  src="<?=BASE_SKIN_URL?>/Default/skin/nobel/Themes/Story/media/dongho.png"  class=" wh40 img-responsive"/>
						</div>
						<div class="col-md-9 col-sm-9 col-xs-12">
							<h4 class="robotofont"><strong>10:00</strong></h4>
						</div>
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
			<div class="row">
				<div class="col-md-offset-2 col-md-8 top50">
					<div class="panel panel-default top10 col-md-12">
						<div class="panel-heading" style="background-color: white;">
							<a data-toggle="collapse" data-parent="#accordion" href="#collapse2" class="roboto">
								<h4 class="panel-title text-center">
									<strong>HƯỚNG DẪN HỌC TỪ VỰNG VÀ LÝ THUYẾT</strong>
								</h4>
							</a>
						</div>
						<div id="collapse2" class="panel-collapse collapse roboto">
							<div class="left10 top20 blue">
								<strong>Bước 1: </strong> <span>Click chuột vào mục </span> <strong>Từ vựng & Lý thuyết</strong>
							</div>
							<div class="left10 top20 blue">
								<strong>Bước 2: </strong><span>Click chuột để chọn chủ đề</span>
							</div>
							<div class="left10 top20 blue">
								<strong>Bước 3: </strong><span>Học từ vựng</span>
							</div>
							<div class="left10 top20 blue">
								<strong>Bước 4: </strong><span>Click chuột vào mục </span> <strong>Kiểm tra từ vựng</strong>
							</div>
							<div class="left10 top20 blue">
								<strong>Bước 5: </strong><span>Click chuột để chọn các loại </span><strong>game (game 1,.., game 6)</strong><span> ,ôn luyện và kiểm tra các từ vựng vừa học.</span>
							</div>
							<div class="left10 top20 blue bot10">
								<strong>Chú ý: </strong><span>Click đúp chuột vào các từ vựng để xem từ điển và nghe loa đọc.</span>
							</div>
						</div>
					</div>
					
					
					<div class="panel panel-default top10 col-md-12">
						<div class="panel-heading" style="background-color: white;">
							<a data-toggle="collapse" data-parent="#accordion" href="#collapse3" class="roboto">
								<h4 class="panel-title text-center text-uppercase">
									<strong>Hướng dẫn làm bài luyện tập</strong>
								</h4>
							</a>
						</div>
						<div id="collapse3" class="panel-collapse collapse roboto">
							<div class="left10 top20 blue">
								<strong>Bước 1: </strong> <span>Click chuột vào mục  </span><strong>Chọn bài</strong>
							</div>
							<div class="left10 top20 blue">
								<strong>Bước 2: </strong> <span>Click chuột để chọn 1 bài trong các chủ đề </span>
							</div>
							<div class="left10 top20 blue">
								<strong>Bước 3: </strong> <span>Thực hiện làm bài luyện tập : </span>
								<ul>
									<li class="top10">Click chuột để tích chọn đáp án đúng</li>
									<li class="top10">Click chuột vào biểu tượng loa để nghe câu hỏi bằng tiếng anh</li>
								</ul>
							</div>
							<div class="left10 top20 blue">
								<strong>Bước 4: </strong> <span>Để hoàn thành bài luyện tập: Click chuột vào nút </span>
								<img src="<?=BASE_SKIN_URL?>/Themes/Songngu/skin/media/hoanthanh.jpg"/></div>
							<div class="left10 top20 blue bot10">
								<strong>Bước 5: </strong> <span>Để xem kết quả và đáp án: Click chuột vào nút </span><img src="<?=BASE_SKIN_URL?>/Themes/Songngu/skin/media/xemdapan.jpg"/>
							</div>
						</div>
					</div>
				</div>

				<div class="col-md-2 col-xs-2"></div>
			</div>
		</div>
		<div class="col-md-1 col-xs-1"></div>
	</div>
</div>
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
	var check = '{check}';
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
<?php endif;?>
<?php 
	$dataCategoryCurrent =  $data->get('categoryCurrentEnglish');
	
 ?>