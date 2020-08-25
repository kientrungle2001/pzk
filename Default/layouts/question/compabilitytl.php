<?php $items = $data->getQuestion();
$language = pzk_global()->getLanguage();
$lang = pzk_session('language')
?>

<?php //debug($items->getTeacher_answers()); die(); ?>
<div class="nobel-list-md typedt">
	
	<p class='dt-request'><i><?=$items->getRequest();?></i></p>
	
	<?php
		
		if ($lang == 'en' || $lang == 'ev'){
			$name = $items->getName();
		}else{
			$name = $items->getName_vn();
		} 
		
		
		$pattern = '/\[(input|i)([\d]+)(\[([\d]+)\])?\]/';
		$replacement =	"<input size='$4' name='answers[".$items->getId()."_i][$2]'/>";
		$content = preg_replace($pattern, $replacement, $name);
		
		$pattern2 = '/\[(tput|tp)([\d]+)(\[([\d]+)\])?\]/';
		$replacement2 =	"<input class='input_dt' size='$4' name='answers[".$items->getId()."_i][$2]'/>";
		$content = preg_replace($pattern2, $replacement2, $content);
		
		$pTextarea = '/\[(textarea|t)([\d]+)\]/';
		$reTextarea = "<textarea class='item tinymce_input' name='answers[".$items->getId()."_t][$2]'></textarea>";	
		$content = preg_replace($pTextarea, $reTextarea, $content);
		
			?>
	<div class="ptnn-title item mgb30"> <?= $content; ?></div>
	
	<div class="line-question "></div>
	
	<div style='display: none; border: 1px solid rgb(221, 221, 221);
    border-radius: 5px;
    padding: 10px;
    text-align: justify;
    margin-bottom: 10px;' class="showtlanswers item">
		<label class="control-label red" ><?= $language['view-explanation'];?></label>
		<div class="item content">
		<?php 
		$ligiai = $items->getTeacher_answers();
		if(isset($ligiai)) {
			$content = json_decode($ligiai, true);
			if(isset($content['content_full'])) {
				echo $content['content_full'];
			}
				
		} ?>
		
		</div>
	</div>
	<!-- bắt đầu phần tiếng việt cho song ngữ -->
		<?php if($lang == 'ev'){ ?>
		<div>
			<p><i class="ptnn-title"><?=$items->getRequest()?></i></p>
			<p><strong>Dịch tiếng Việt:</strong><span class="ptnn-title"> 
			<?php 
		$name = $items->getName_vn();
		$name = strip_tags($name, '<img><b><i><br><i>');
		$pattern = '/\[(input|i)([\d]+)(\[([\d]+)\])?\]/';
		$replacement =	".....";
		$content = preg_replace($pattern, $replacement, $name);
		
		$pattern2 = '/\[(tput|tp)([\d]+)(\[([\d]+)\])?\]/';
		$replacement2 =	".....";
		$content = preg_replace($pattern2, $replacement2, $content);
		
		$pTextarea = '/\[(textarea|t)([\d]+)\]/';
		$reTextarea = ".....";
		$content = preg_replace($pTextarea, $reTextarea, $content);
		
			?>
				<?=getLatex($content);?>
			</span>
			</p>
		</div>
		<?php } ?>
	<!-- kết thúc phần tiếng việt cho song ngữ -->
	

</div>