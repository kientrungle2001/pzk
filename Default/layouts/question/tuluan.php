<?php 
if(method_exists($data, 'getQuestion')){
	$items = $data->getQuestion();
}else{
	$items = $data->getQuestion();
}
?>
<div class="nobel-list-md typedt">
	
	<p class='dt-request'><i><?=$items->getRequest()?></i></p>
	
	<?php 
		$pattern = '/\[(input|i)([\d]+)(\[([\d]+)\])?\]/';
		$replacement =	"<input size='$4' name='answers[".$items->getId()."_i][$2]'/>";
		$content = preg_replace($pattern, $replacement, $items->getName());
		
		$pattern2 = '/\[(tput|tp)([\d]+)(\[([\d]+)\])?\]/';
		$replacement2 =	"<input class='input_dt' size='$4' name='answers[".$items->getId()."_i][$2]'/>";
		$content = preg_replace($pattern2, $replacement2, $content);
		
		$pTextarea = '/\[(textarea|t)([\d]+)\]/';
		$reTextarea = "<textarea class='item tinymce_input' name='answers[".$items->getId()."_t][$2]'></textarea>";	
		$content = preg_replace($pTextarea, $reTextarea, $content);
		
			?>
	<p><span class="ptnn-title"> <?= $content; ?></span></p>
	
	<div class="line_question pd-top-10"></div>
</div>