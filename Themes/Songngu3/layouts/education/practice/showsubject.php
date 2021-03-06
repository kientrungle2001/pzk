<?php
	$language = pzk_global()->getLanguage();
	$lang = pzk_session('language');
	$languagevn = pzk_global()->getLanguagevn();
	$class = 5;
	if(pzk_session('lop')) {
		$class = pzk_session('lop');	
	}
	
?>
<?php  $items = $data->getSubject($class); ?>
<?php foreach($items as $item): ?>
<!-- desktop -->
<div class="col-lg-2 col-md-2 col-sm-2 hidden-xs pd-40">
	<a href="#" onclick ="return false;" class="subjectclick" data-subject="<?php echo @$item['id']?>" data-alias="<?php echo @$item['alias']?>" data-class="<?php echo $class ?>">
		<div class="heightresponsive btn-custom3 white text-uppercase weight-12 text-center relative" <?php if($lang == 'ev'){
					echo 'title="'.$item['name_vn'].'"'; }?>>
			<div class="item hidden-xs">
				<img src="<?=BASE_SKIN_URL?><?php echo @$item['img']?>" alt="<?php echo @$item['alias']?>" class=" img-responsive center-block">
			</div>
			<div class="top20 absolute item hidden-xs">
				<p>
				<?php 
					if ($lang == 'en' || $lang == 'ev'){
						echo $item['name_en'];
					}else{
						echo $item['name_vn'];
					}
				?>
				</p>
			</div>
			<div class="top50 visible-xs">
				<p style="padding-top:30px;">
				<?php 
					if ($lang == 'en' || $lang == 'ev'){
						echo $item['name_en'];
					}else{
						echo $item['name_vn'];
					}
				?>
				</p>
			</div>
		</div>
	</a>
</div>
<!-- mobile -->
<div class="col-xs-6 visible-xs top10">
	<a href="#" onclick ="return false;" class="subjectclick" data-subject="<?php echo @$item['id']?>" data-alias="<?php echo @$item['alias']?>" data-class="<?php echo $class ?>">
		<div class="heightresponsive btn-custom3 text-color text-uppercase weight-12 text-center sharp" <?php if($lang == 'ev'){
					echo 'title="'.$item['name_vn'].'"'; }?>>
			<div>
				<img src="<?=BASE_SKIN_URL?><?php echo @$item['img']?>" alt="<?php echo @$item['alias']?>" class=" img-responsive center-block" width="35" height="35">
			</div>
			<div class="visible-xs">
				<p style="padding-top:10px;">
				<?php 
					if ($lang == 'en' || $lang == 'ev'){
						echo $item['name_en'];
					}else{
						echo $item['name_vn'];
					}
				?>
				</p>
			</div>
		</div>
	</a>
</div>
<?php endforeach; ?>