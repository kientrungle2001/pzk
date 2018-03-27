<?php 
	$dataClass = $data->getDataClass();
	$class_id = $data->getClassId();
	$className = $dataClass['name'];
	$topics = $dataClass['child'];
	
	 if($topics) {
 ?>

<div class='container'>
	<div class='row'>
	<style>
	<?php foreach($topics as $topic) { ?>
		.t<?= $topic['color']; ?>:hover{ background: #<?= $topic['color']; ?>;}
	<?php } ?>
	</style>
	<?php foreach($topics as $topic) { ?>
		<div class='col-md-3 col-xs-12 bdrtopic'>
		<a style="color: #<?= $topic['color']; ?> !important;" class='font-submenu' href="<?php echo BASE_REQUEST.'/'.$topic['router']."/".$topic['id']; ?>">
			<img src="<?php echo BASE_URL.$topic['img']; ?>" />
			<?php echo $topic['name'];?>
			</a>
			<?php
				if($topic['router'] == 'topic/index'){
					
					$subjects = $data->getSubjects($topic['id']);
					if($subjects) { 
						foreach($subjects as $subject){
			?>
							<div class='col-xs-12 subtopic t<?= $topic['color']; ?>'>
							<a href="<?php echo BASE_REQUEST.'/'.$subject['router']."/".$subject['id']; ?>">
							<?php echo $subject['name']; ?>
							</a>
							</div>	
					<?php } }?>
			<?php
				} elseif(substr($topic['router'],0,4) == 'test') {
					$class = pzk_request()->get('class');		
					$subjects = $data->getTests($class);
					$i=1;
					if($subjects) { 
						foreach($subjects as $subject){
							$alert = '';
							if($i > 1){
								$alert = "class='alertBuy'";
							}
			?>
							<div class='col-xs-12 subtopic t<?= $topic['color']; ?>'>
							<a <?=$alert;?> href="<?php if($i == 1){ echo BASE_REQUEST."/test/getTest/".$subject['id']; } else { echo 'javascript:void(0);';}?>">
							<?php echo $subject['name']; ?>
							</a>
							</div>	
					<?php $i++; } }?>
			<?php
				}elseif($topic['router'] == 'game/index') { 
			
			?>
							<div class='col-xs-12 subtopic t<?= $topic['color']; ?>'>
							<a href="">
							 Trò chơi
							</a>
							</div>	
			<?php
				}
			?>
			
					
			
			
		</div>
	<?php } ?>
	</div>
</div>
<?php } ?>
<script>
	$('.alertBuy').click(function(){
		alert('Bạn phải mua tài khoản mới truy cập được');
	})
</script>
 
 
 