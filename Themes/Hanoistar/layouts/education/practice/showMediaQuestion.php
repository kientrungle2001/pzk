<?php
	
	$check = pzk_session('checkPayment');
	$category = $data->get('category');
	$category_id = $data->get('categoryId');
	$category_name = $data->get('categoryName');

	$class= pzk_session('lop');
	$currentMedia	=	pzk_request('media');
	$media=$currentMedia;
	$mediaEntity	=	_db()->getTableEntity('media')->load($media);
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
	
?>
{children [position=public-header]}	
{children [position=top-menu]}
<?php if(pzk_session('login')) { ?>

<div class="container-fluid bgcontent">

<div class="container">
	<div class="row ">	
			<!--bai tap-->
			<div class="col-md-12 content-full  col-sm-12  col-xs-12">
			
				<div class="item fs18 top-content bold">	
				  <?php echo 'Lớp '. $class; ?> &nbsp;  >  &nbsp; 
				  <a href="/#practice">
				  <?php echo $language['pclass'];?> &nbsp; > &nbsp;
				  </a>
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
				</div>	
				
				<div class="content-lt relative change item">
				
					<div onclick="fullscreen();" style="position: absolute; right: -1px; top: 0px; z-index: 999999;" class="btn btn-primary hidden-xs">
							<i  class="fa fa-arrows-alt fa-1x" aria-hidden="true"></i>
						</div>
				
					<div style="margin: 15px 0px;" class="item ">
					
					
						<div class="name-detail col-md-12 col-xs-12">
							
							<?php if($psubject == 88) { ?>
								{de}
							<?php } else { 
								if($check == 0){ 
									echo $language['trialpractice']; 
								}else{ 
									$topicId = pzk_request('topic');
									$topic = $data->getTopicsName($topicId, $class);
									if($lang == 'en' || $lang == 'ev'){ echo $topic['name_en']; }else{ echo $topic['name_vn']; }
									echo ' - ' .$mediaEntity->get('name'); 
								} ?>
								
							<?php } ?>
						
						</div>
					</div>
				

				
				<div class="col-xs-12 margin-top-20">
					<?php if(strpos($mediaEntity->get('url'), 'youtube.com') === false):?>
					<?php if($mediaEntity->get('url')):?>
					<video width="100%" controls>
					  <source src="<?=$media['url']; ?>" type="video/mp4">
					  Your browser does not support HTML5 video.
					</video>
					<?php endif;?>
					<?php else: ?>
					<?php
						$url = $mediaEntity->get('url');
						preg_match('/[\\?\\&]v=([^\\?\\&]+)/', $url, $matches);
						$id = $matches[1];
						$width = '100%';
						$height = '450px';
					?>
					<iframe id="ytplayer" type="text/html" width="<?php echo $width ?>" height="<?php echo $height ?>"
    src="https://www.youtube.com/embed/<?php echo $id ?>?rel=0&showinfo=0&color=white&iv_load_policy=3"
    frameborder="0" allowfullscreen></iframe> 
					<?php endif;?>
					<style>
					.show-less {
						height: 40px;
						overflow: hidden;
					}
					</style>
					<div class="media-content show-less">
						<?php echo $mediaEntity->get('content') ?>
					
					</div>
				</div>
				

			</div>
			<!--end content-->	
		</div>
	</div>
	
</div>

</div>

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