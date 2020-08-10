<?php 
if(method_exists($data, 'getQuestion')){
	$items = $data->getQuestion();
}else{
	$items = $data->get('question');
}
$language = pzk_global()->get('language');
$lang = pzk_session('language');
$bookId = @$data->get('bookId');
// lấy kết quả đã làm đưa ra
$answer = null;
$recommend_mark = null;
if($bookId) {
	$userAnswer = _db()->select('*')->from('user_answers')
		->whereUser_book_id($bookId)
		->whereQuestionId($items->get('id'))
		->result_one();
	if($userAnswer) {
		$answer = unserialize($userAnswer['content']);
		$recommend_mark = $userAnswer['recommend_mark'];
	}
}
?>

<?php //debug($items->get('teacher_answers')); die(); ?>
<div class="nobel-list-md typedt">
	<?php if($data->get('stt')):?>
	<div class="item cau">
		<div class="stt"><?php echo $language['question'];?> <?=$data->get('stt');?>
		<?php if(pzk_user_special()) :?><br />
		(#<?php  echo $items->get('id') ?>)
		<?php endif; ?>
		</div>

	</div>
	<?php endif; ?>
	<p class='dt-request'><i><?=$items->get('request');?></i></p>
	
	<?php
		
		if ($lang == 'en' || $lang == 'ev'){
			$name = $items->get('name');
		}else{
			$name = $items->get('name_vn');
		} 
		
		
		$pattern = '/\[(input|i)([\d]+)(\[([\d]+)\])?\]/';
		$replacement =	"<input size='$4' class='answers_".$items->get('id')."_i_$2' name='answers[".$items->get('id')."_i][$2]'/>";
		$content = preg_replace($pattern, $replacement, $name);
		
		$pattern2 = '/\[(tput|tp)([\d]+)(\[([\d]+)\])?\]/';
		$replacement2 =	"<input class='input_dt answers_".$items->get('id')."_i_$2' size='$4' name='answers[".$items->get('id')."_i][$2]'/>";
		$content = preg_replace($pattern2, $replacement2, $content);
		
		$pattern3 = '/\[(upload|u)([\d]+)(\[([\d]+)\])?\]/';
		$replacement3 =	"<input type=\"file\" class='input_upload' size='$4' name='answers[".$items->get('id')."_u][$2]'/>";
		$content = preg_replace($pattern3, $replacement3, $content);
		
		$pTextarea = '/\[(textarea|t)([\d]+)\]/';
		$reTextarea = "<textarea class='w100p tinymce_input' name='answers[".$items->get('id')."_t][$2]'></textarea>";	
		$content = preg_replace($pTextarea, $reTextarea, $content);
		
			?>
	<div class="ptnn-title item mgb30"> <?= $content; ?></div>
	<?php if($recommend_mark):?>
	<div class="item" style="color: red;">
	<strong>
	Nhận xét của GV: <?php echo $recommend_mark ?>
	</strong>
	</div>
	<?php endif; ?>
	
	<?php 
		$explanation = $items->get('explaination');
	?>
	<a href="#mobile-explan-<?=$items->get('id')?>" class="explanation top10 hidden btn btn-success btn-show-exp" data-toggle="collapse">Lý giải</a>
	
	<div id="mobile-explan-<?=$items->get('id')?>" class="collapse top10 item" 
		style="	border: 1px solid rgb(221, 221, 221); border-radius: 5px;
				padding: 10px; text-align: justify;
				background: rgb(255, 255, 255); margin-bottom:10px;">
		<div class="item">
		<?=getLatex($explanation)?>
		</div>
		
		<!--report-->
		<div class="item">
			<div class="btn btn-danger" data-toggle="modal" data-target="#report<?=$items->get('id')?>">
			<?=$language['report']?>
			</div>
			
			<div class="modal fade" id="report<?=$items->get('id')?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
			  <div class="modal-dialog" role="document">
				<div class="modal-content">
				  <div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					<h4 class="modal-title" id="myModalLabel"><?=$language['report']?></h4>
				  </div>
				  <div class="modal-body">
					 <div class="w100p">
						<label for="exampleInputEmail1"><?=$language['content']?>:</label>
						<textarea style="height: 150px !important;" id="contentError<?=$items->get('id')?>" name="contentError" class="form-control"></textarea>
					  </div>
		 
				  </div>
				  <div class="modal-footer">
					
					<button onclick="reportError(<?=$items->get('id')?>);" type="button" class="btn btn-primary"><?=$language['report']?></button>
				  </div>
				</div>
			  </div>
			</div>
			
		</div>
		<!--end report-->
		<br />
	</div>
	<br />
	
	
	<div style='display: none; border: 1px solid rgb(221, 221, 221);
    border-radius: 5px;
    padding: 10px;
    text-align: justify;
    margin-bottom: 10px;' class="showtlanswers item">
		<label class="control-label red" ><?= $language['view-explanation'];?></label>
		<div class="item content">
		<?php 
		$ligiai = $items->get('teacher_answers');
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
			<p><i class="ptnn-title"><?=$items->get('request')?></i></p>
			<p><strong>Dịch tiếng Việt:</strong><span class="ptnn-title"> 
			<?php 
		$name = $items->get('name_vn');
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
	
	<div class="line-question "></div>
	
</div>
<?php  	if($answer): ?>
<script type="text/javascript">
var answerData = <?php echo json_encode($answer);?>;
for(var type in answerData) {
	for(var index in answerData[type]) {
		
		$('[name="answers[<?php echo $items->get('id') ?>_'+type+']['+index+']"]').val(answerData[type][index]);
	}
}
</script>
<?php 	endif; ?>