
<?php  $item = $data->getItem(); ?>
<?php 
$subject = _db()->getTableEntity('categories')->load($item['categoryId']);
$subjects = _db()->selectAll()->fromCategories()->whereDisplay(1)->whereParent($subject->getParent())->result();
$language = pzk_global()->getLanguage();
$lang = pzk_session('language');
 ?>
<?php $data->displayChildren('[position=public-header]') ?>	
<?php $data->displayChildren('[position=top-menu]') ?>
<div class="container fivecolumns">
	<div class="row">
		<div class="col-md-10 col-xs-12 mgleft-12">
			<div id="document-detail">
				<p class="t-weight text-center"><ul class="breadcrumb text-center">
					<li><a href="/document/home"><?php echo $language['materials'];?></a></li>
					<li><a href="/document/home"><?php echo $language['class'];?> <?php  echo pzk_request()->getClass()?></a></li>
					<li class="active">
						<span class="dropdown">
						  <a class="dropdown-toggle" type="button" id="dropdownSubjectDocument" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
							<?php echo $subject->getName()?>
							<span class="caret"></span>
						  </a>
						  <ul class="dropdown-menu" aria-labelledby="dropdownSubjectDocument" style="top: 12px;">
						  <?php foreach($subjects as $sbj): ?>
							<li><a href="/document/index/<?php echo @$sbj['id']?>?class=<?php  echo pzk_request()->getClass()?>"><?php echo @$sbj['name']?></a></li>
						  <?php endforeach; ?>
						  </ul>
						</span>
					</li>
				</ul></p>
				<p class="t-weight text-center"><?php echo @$item['title']?></p>
				<?php if(@$item['file']) : ?>
					<?php $fileAll=pathinfo($item['file']);
						 $fileType= $fileAll['extension'];
					?>
				<?php if($fileType == 'pdf' || $fileType == 'PDF'): ?>
					<iframe src = "/3rdparty/ViewerJS/index.html#<?php echo BASE_URL.$item['file']; ?>" width='100%' height='500' allowfullscreen webkitallowfullscreen></iframe>
				<?php else: ?>
				<script type="text/javascript" src="/3rdparty/jquery.gdocsviewer.v1.0/jquery.gdocsviewer.min.js"></script> 
				<script type="text/javascript">
					$(document).ready(function() {
						$('#embedURL').gdocsViewer({width: '100%'});
					});
				</script>
				<a href="<?php echo BASE_URL.$item['file']; ?>" id="embedURL">&nbsp;</a>
				<?php endif; ?>
				<?php else: ?>
				<div class="content"><?php  echo str_replace('&nbsp;', '', $item['content']) ?></div>
				<?php endif; ?>
			</div>
			<?php if(@$item['file']) : ?>
			<p class="text-center pd-20"><i class="fa fa-link"></i><?php echo $language['download'];?> <a href="<?php echo @$item['file']?>"><?php echo @$item['title']?></a></p>
			<?php endif; ?>
		</div>
		<div class="col-md-2 col-xs-12 pd-15">
			<div class="row">
				<div class="full mgright20 robotofont">
					<a href="<?php  echo FL_URL ?>"><img class="image-responsive center-block" src="<?=BASE_SKIN_URL?>/Default/skin/nobel/test/Themes/Default/media/full.png"></a>
					<p class="text-center top10"><strong>FULL LOOK</strong></p>
					<p class="text-center">(Phần mềm khảo sát năng lực toàn diện bằng tiếng Anh)</p>
				</div>
				<div class="full top20 mgright20 robotofont">
					<a href="<?php  echo NOBEL_URL ?>"><img class="image-responsive center-block" src="<?=BASE_SKIN_URL?>/Default/skin/nobel/test/Themes/Default/media/vietvan.png"></a>
					<p class="text-center top10"><strong>LUYÊN VIẾT VĂN MIÊU TẢ</strong></p>
					<p class="text-center">(Dành cho HS lớp 3,4,5,6)</p>
				</div>
				<div class="full top20 mgright20 robotofont">
					<a href="<?php  echo NOBEL_URL ?>"><img class="image-responsive center-block" src="<?=BASE_SKIN_URL?>/Default/skin/nobel/test/Themes/Default/media/khaosat.png"></a>
					<p class="text-center top10"><strong>TIẾNG VIỆT VUI</strong></p>
					<p class="text-center">( Phần mềm ôn tập chương trình TV Tiểu học)</p>
				</div>
			</div> 
		</div>
	</div>
</div>
