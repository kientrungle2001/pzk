<?php 
if(method_exists($data, 'getQuestion')){
	$items = $data->getQuestion();
}else{
	$items = $data->get('question');
}
?>
<div class="nobel-list-md typedt">
	
	<p class='dt-request'><i><?=$items->get('request')?></i></p>
	
	<?php 
		$pattern = '/\[(input|i)([\d]+)(\[([\d]+)\])?\]/';
		$replacement =	"<input size='$4' name='answers[".$items->get('id')."_i][$2]'/>";
		$content = preg_replace($pattern, $replacement, $items->get('name'));
		
		$pattern2 = '/\[(tput|tp)([\d]+)(\[([\d]+)\])?\]/';
		$replacement2 =	"<input class='input_dt' size='$4' name='answers[".$items->get('id')."_i][$2]'/>";
		$content = preg_replace($pattern2, $replacement2, $content);
		
		$pTextarea = '/\[(textarea|t)([\d]+)\]/';
		$reTextarea = "<textarea class='item tinymce_input' name='answers[".$items->get('id')."_t][$2]'></textarea>";	
		$content = preg_replace($pTextarea, $reTextarea, $content);
		
			?>
	<p><span class="ptnn-title"> <?= $content; ?></span></p>
	
	<div class="line_question pd-top-10"></div>
</div>