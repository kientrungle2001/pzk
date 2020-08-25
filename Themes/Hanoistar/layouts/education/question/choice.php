<?php 
//require_once BASE_DIR . '/lib/string.php';
$items = $data->getQuestion(); 
$answers = $data->getanswers();
//debug($items);
$audio = pzk_or($items->getaudio(), $data->getaudio(), false);
$language = pzk_global()->getLanguage();
$lang = pzk_session('language');
$stt=$data->getStt();
$bookId = @$data->getBookId();

// lấy kết quả đã làm đưa ra
$answerId = null;
if($bookId) {
	$userAnswer = _db()->select('*')->from('user_answers')
		->whereUser_book_id($bookId)
		->whereQuestionId($items->getId())
		->result_one();
	if($userAnswer) {
		$answerId = $userAnswer['answerId'];
	}
}
?>
<div class="item cau">
	<div class="stt"><?php echo $language['question'];?> <?=$stt;?>
	<?php if(pzk_user_special()) :?><br />
	(#<?php  echo $items->getId() ?>)
	<?php endif; ?>
	</div>

	<?php if($audio): ?>
		<span class="btn volume glyphicon glyphicon-volume-up" onclick="read_question(this, '<?php echo $audio ?>');"></span>
	<?php endif; ?>
</div>

<div class="nobel-list-md choice">
	<?php if($items->getRequest()){ ?>
	<div>
		<i class="ptnn-title"><?=$items->getRequest()?></i>
	</div>
	<?php } ?>
	<div>
		<div class="ptnn-title"> 
		<?php 
		$categoryIds = $items->getCategoryIds();
		//$pos = strpos($categoryIds, '164');
		if($lang == 'en' || $lang == 'ev'){ 
			$name = $items->getName();
			$name = htmlentities($name, null, 'utf-8');
			$name = str_replace("&nbsp;", " ", $name);
			$name = html_entity_decode($name);
		?>
			
			<?=getLatex($name);?>
		<?php }else{ 
			$name = $items->getName_vn();
			$name = htmlentities($name, null, 'utf-8');
			$name = str_replace("&nbsp;", " ", $name);
			$name = html_entity_decode($name);
		?>
			<?=getLatex($name);?>
		<?php } ?>
		</div>
		
	</div>
	<table>
	<?php $explanation = ""; ?>
	<?php foreach($answers as $key =>$value):?>
	<tr>
		<td>
			<input type="radio" style="font-weight: normal; float:left" name="answers[<?=$items->getId()?>]" 
				id="answers_<?=$items->getId()?>_<?=$value->getId()?>" 
				value="<?php  echo $value->getId()?>"
				<?php if($answerId && $answerId == $value->getId()):?>checked="checked"<?php endif;?>
				/>
			<span  class="answers_<?=$items->getId()?>_<?=$value->getId()?>" style="padding-left:10px;">
			<?php if($value->getContent_vn() == NULL) {
				echo "0";
			}else if($lang == 'en' || $lang == 'ev'){
				$content = $value->getContent();
				$content = htmlentities($content, null, 'utf-8');
				$content = str_replace("&nbsp;", " ", $content);
				$content = html_entity_decode($content);
				echo getLatex($content);
			}else{
				$content_vn = $value->getContent_vn();
				$content_vn = htmlentities($content_vn, null, 'utf-8');
				$content_vn = str_replace("&nbsp;", " ", $content_vn);
				$content_vn = html_entity_decode($content_vn);
				echo getLatex($content_vn);
			}	
			?>
			</span>
		</td>
	</tr>
	<?php 
	if($value->getStatus() == 1 && $lang == 'en'){
		$explanation = $value->getRecommend();
	}else if($value->getStatus() == 1 && (!$lang || $lang == 'vn' || $lang == 'ev')){
		$explanation = $items->getExplaination();
	}
	?>
	<?php endforeach;?>
	</table>
	
	<!-- bắt đầu phần tiếng việt cho song ngữ -->
		<?php if($lang == 'ev'){ ?>
		<div>
			<p><i class="ptnn-title"><?=$items->getRequest()?></i></p>
			<p><strong>Dịch tiếng Việt:</strong><span class="ptnn-title"> 
				<?=getLatex($items->getName_vn());?>
			</span>
			<table>
			<?php $explanation = ""; ?>
			
			<?php foreach($answers as $key =>$value):?>
			<tr>
				<td>
					<span  class="answers_<?=$items->getId()?>_<?=$value->getId()?>" style="padding-left:10px;">
					<?php 
					if($value->getContent_vn() == NULL) {
						echo "0";
					}else{
						echo getLatex(strip_tags((string)$value->getContent_vn(), '<img>'));
					} ?>
					</span>
				</td>
			</tr>
			<?php 
			if($value->getStatus() == 1 && $lang == 'en'){
				$explanation = $value->getRecommend();
			}else if($value->getStatus() == 1 && (!$lang || $lang == 'vn' || $lang == 'ev')){
				$explanation = $items->getExplaination();
			}
			?>
			<?php endforeach;?>
			</table>
			</p>
		</div>
		<?php } ?>
	<!-- kết thúc phần tiếng việt cho song ngữ -->
	<?php 
	//nl2br
		$recommentSoftware = "Bấm vào đây để xem đáp án";
		if($explanation == ""){
			$explanation = "Không có giải thích";
		}
		if(pzk_request('softwareId') == 1){
			$recommentSoftware = $language['view-explanation'];
		
			if($explanation == ""){
				$explanation = $language['not-explanation'];
			}
		}
	?>
	<!--Lý giải -->
	
	<a href="#mobile-explan-<?=$items->getId()?>" class="explanation top10 hidden btn btn-success btn-show-exp" data-toggle="collapse"><?=$recommentSoftware;?></a>
	
	<div id="mobile-explan-<?=$items->getId()?>" class="collapse top10 item" style="border: 1px solid rgb(221, 221, 221);
    border-radius: 5px;
    padding: 10px;
    text-align: justify;
    background: rgb(255, 255, 255); margin-bottom:10px;">
		<div class="item">
		<?=getLatex($explanation)?>
		</div>
		
		<!--report-->
		<div class="item">
			<div class="btn btn-danger" data-toggle="modal" data-target="#report<?=$items->getId()?>">
			<?=$language['report']?>
			</div>
			
			<div class="modal fade" id="report<?=$items->getId()?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
			  <div class="modal-dialog" role="document">
				<div class="modal-content">
				  <div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					<h4 class="modal-title" id="myModalLabel"><?=$language['report']?></h4>
				  </div>
				  <div class="modal-body">
					 <div class="w100p">
						<label for="exampleInputEmail1"><?=$language['content']?>:</label>
						<textarea style="height: 150px !important;" id="contentError<?=$items->getId()?>" name="contentError" class="form-control"></textarea>
					  </div>
		 
				  </div>
				  <div class="modal-footer">
					
					<button onclick="reportError(<?=$items->getId()?>);" type="button" class="btn btn-primary"><?=$language['report']?></button>
				  </div>
				</div>
			  </div>
			</div>
			
		</div>
		<!--end report-->
		
	</div>
	<!--Lý giải -->
	<!-- giáo viên -->
	<?php if(pzk_session('adminClassname') && pzk_session('adminLevel')== 'Monitor'): ?>
		<div class="top10">
		<a href="#mobile-explan-<?=$items->getId()?>" class="explanation_teacher explanation_teacher_<?=$items->getId()?> hidden btn btn-default btn-show-exp" data-toggle="collapse"><?=$recommentSoftware;?></a>
		</div>
		<div id="mobile-explan-<?=$items->getId()?>" class="collapse top10 item" style="border: 1px solid rgb(221, 221, 221);
		border-radius: 5px;
		padding: 10px;
		text-align: justify;
		background: rgb(255, 255, 255); margin-bottom:10px;">
			<div class="item"><?=getLatex($explanation)?></div>
			
			<!--report-->
		<div class="item">
			<div class="btn btn-danger" data-toggle="modal" data-target="#report<?=$items->getId()?>">
			<?=$language['report']?>
			</div>
			
			<div class="modal fade" id="report<?=$items->getId()?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
			  <div class="modal-dialog" role="document">
				<div class="modal-content">
				  <div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					<h4 class="modal-title" id="myModalLabel"><?=$language['report']?></h4>
				  </div>
				  <div class="modal-body">
					 <div class="w100p">
						<label for="exampleInputEmail1"><?=$language['content']?>:</label>
						<textarea style="height: 150px !important;" id="contentError<?=$items->getId()?>" name="contentError" class="form-control"></textarea>
					  </div>
		 
				  </div>
				  <div class="modal-footer">
					
					<button onclick="reportError(<?=$items->getId()?>);" type="button" class="btn btn-primary"><?=$language['report']?></button>
				  </div>
				</div>
			  </div>
			</div>
			
		</div>
		<!--end report-->
			
		</div>
		<div class="top10">
		<button class="btn btn-primary" onclick="show_question_answer(<?=$items->getId()?>) ;return false;"><?php echo $language['finish']; ?>
		</button>
		</div>
	<?php endif; ?>
	<!-- giáo viên -->
</div>

<div class="line-question">
</div>
