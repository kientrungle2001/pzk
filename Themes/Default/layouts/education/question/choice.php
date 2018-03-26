<?php 
$items = $data->get('question'); 
$answers = $data->get('answers');
//debug($items);
$audio = pzk_or($items->get('audio'), $data->get('audio'), false);
$language = pzk_global()->get('language');
$lang = pzk_session('language');

?>

<div class="nobel-list-md choice">
	<div>
		<i class="ptnn-title"><?=$items->get('request')?></i>
	</div>
	<div>
		<div class="ptnn-title"> 
		<?php 
		$categoryIds = $items->get('categoryIds');
		//$pos = strpos($categoryIds, '164');
		if($lang == 'en' || $lang == 'ev'){ ?>
			<?=getLatex($items->get('name'));?>
		<?php }else{ ?>
			<?=getLatex($items->get('name_vn'));?>
		<?php } ?>
		</div>
		<div style="width: 100%; float: left;">
		<?php if($audio): ?>
			<span class="btn btn-success glyphicon glyphicon-volume-up" onclick="read_question(this, '{audio}');"></span>
		<?php endif; ?>
		</div>
	</div>
	<table>
	<?php $explanation = ""; ?>
	<?php foreach($answers as $key =>$value):?>
	<tr>
		<td>
			<input type="radio" style="font-weight: normal; float:left" name="answers[<?=$items->get('id')?>]" id="answers_<?=$items->get('id')?>_<?=$value->get('id')?>" value="{value.get('id')}"/>
			<span  class="answers_<?=$items->get('id')?>_<?=$value->get('id')?>" style="padding-left:10px;">
			<?php if($value->get('content') == NULL) {
				echo "0";
			}else if($lang == 'en' || $lang == 'ev'){
				echo getLatex($value->get('content'));
			}else{
				echo getLatex($value->get('content_vn'));
			}	
			?>
			</span>
		</td>
	</tr>
	<?php 
	if($value->get('status') == 1 && $lang == 'en'){
		$explanation = $value->get('recommend');
	}else if($value->get('status') == 1 && (!$lang || $lang == 'vn' || $lang == 'ev')){
		$explanation = $items->get('explaination');
	}
	?>
	<?php endforeach;?>
	</table>
	
	<!-- bắt đầu phần tiếng việt cho song ngữ -->
		<?php if($lang == 'ev'){ ?>
		<div>
			<p><i class="ptnn-title"><?=$items->get('request')?></i></p>
			<p><strong>Dịch tiếng Việt:</strong><span class="ptnn-title"> 
				<?=getLatex($items->get('name_vn'));?>
			</span>
			<table>
			<?php $explanation = ""; ?>
			
			<?php foreach($answers as $key =>$value):?>
			<tr>
				<td>
					<span  class="answers_<?=$items->get('id')?>_<?=$value->get('id')?>" style="padding-left:10px;">
					<?php 
					if($value->get('content') == NULL) {
						echo "0";
					}else{
						echo getLatex(strip_tags((string)$value->get('content_vn'), '<img>'));
					} ?>
					</span>
				</td>
			</tr>
			<?php 
			if($value->get('status') == 1 && $lang == 'en'){
				$explanation = $value->get('recommend');
			}else if($value->get('status') == 1 && (!$lang || $lang == 'vn' || $lang == 'ev')){
				$explanation = $items->get('explaination');
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
			$recommentSoftware = "View explanation";
			if($explanation == ""){
				$explanation = "Have not explanation";
			}
		}
	?>
	<!--Lý giải -->
	<div class="top10">
		<a href="#mobile-explan-<?=$items->get('id')?>" class="explanation hidden btn btn-success btn-show-exp" data-toggle="collapse"><?=$recommentSoftware;?></a>
	</div>
	<div id="mobile-explan-<?=$items->get('id')?>" class="collapse top10 col-md-12 col-sm-12 colxs-12" style="border: 1px solid rgb(221, 221, 221);
    border-radius: 5px;
    padding: 10px;
    text-align: justify;
    background: rgb(255, 255, 255); margin-bottom:10px;">
		<div style="margin-left:10px;"><?=getLatex($explanation)?></div>
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
	</div>
	<!--Lý giải -->
	<!-- giáo viên -->
	<?php if(pzk_session('adminClassname') && pzk_session('adminLevel')== 'Monitor'): ?>
		<div class="top10">
		<a href="#mobile-explan-<?=$items->get('id')?>" class="explanation_teacher explanation_teacher_<?=$items->get('id')?> hidden btn btn-default btn-show-exp" data-toggle="collapse"><?=$recommentSoftware;?></a>
		</div>
		<div id="mobile-explan-<?=$items->get('id')?>" class="collapse top10 col-md-12 col-sm-12 colxs-12" style="border: 1px solid rgb(221, 221, 221);
		border-radius: 5px;
		padding: 10px;
		text-align: justify;
		background: rgb(255, 255, 255); margin-bottom:10px;">
			<div style="margin-left:10px;"><?=getLatex($explanation)?></div>
			
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
		</div>
		<div class="top10">
		<button class="btn btn-primary" onclick="show_question_answer(<?=$items->get('id')?>) ;return false;"><?php echo $language['finish']; ?>
		</button>
		</div>
	<?php endif; ?>
	<!-- giáo viên -->
</div>
