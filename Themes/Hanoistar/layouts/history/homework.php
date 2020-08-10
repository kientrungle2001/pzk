<?php $item = $data->getItem();
$lang = pzk_session('language');
$questions = $data->getQuestions();

$test = null;
if($item['testId']) {
	$test = _db()->selectAll()->fromTests()->whereId($item['testId'])->result_one();
}

?>
<div class="container">
<hr />
<h1 class="text-center">Chi tiết vở bài tập</h1>
<?php if($test): ?><h2 class="text-center">Đề thi: <?php echo @$test['name']?></h2><?php endif;?>
<p class="text-center"><a href="/Profile/detail">Quay lại</a></p>
<?php $index = 1;?>
<div class="row">
		<div class="col-xs-8 col-xs-offset-2">
			<table class="table table-bordered">
				<tr>
					<th>Tổng điểm</th>
					<td><?php echo @$item['totalMark']?></td>
				</tr>
				
			</table>
		</div>
</div>

<?php foreach($questions as $question): ?>
<?php if($question['questionType'] == 1){ ?>
	<div class="row">
		<div class="col-xs-8 col-xs-offset-2">
			<strong> <?php if($lang == 'vn'){ echo 'Câu'; }else{ echo 'Question';} ?> <?php echo $index ?></strong>
		</div>
		<div class="col-xs-8 col-xs-offset-2">
		<?php 
		if($lang == 'vn'){ 
			echo getLatex($question['name_vn']); 
		} else { 
			echo getLatex($question['questionName']);
		} ?>
		
		</div>
		<div class="col-xs-8 col-xs-offset-2">
			<strong>Đáp án đã chọn</strong>
		</div>
		<div class="col-xs-8 col-xs-offset-2">
		<?php 
		$answers = $data->getAnswers($question['questionId']);
		
		 
		?>
		<?php foreach($answers as $answer): ?>
		<div>
			<input type="radio" name="answer_question_<?php echo @$question['questionId']?>" 
			<?php 
			if($question['answerId'] == $answer['id']){ echo 'checked'; }
			?>
			
			disabled />
				<?php if($lang == 'vn'){ 
					echo getLatex($answer['content_vn']);
				} else { 
					echo getLatex($answer['content']);
				} ?>
				<?php if($answer['status']):?><span class="glyphicon glyphicon-ok text-success"></span><?php endif;?></div>
		<?php endforeach; ?>
		</div>
	</div>
	<hr />
<?php } else if($question['questionType'] == 4) { 
	
		$answerTl = $data->getAnswersTl($question['questionId']);
		
		$answerHs = unserialize($answerTl['content']);
		
		
		
		pzk_global()->set('answerTmpHs', $answerHs);
		
		pzk_global()->set('itemsTmp', $question);
		
		//bai cua hoc sinh
		$pattern = '/\[(input|i)([\d]+)(\[([\d]+)\])?\]/';
		
		$contenths = preg_replace_callback($pattern, function($matches) {
			$answer	=	pzk_global()->get('answerTmpHs');
			$item		=	pzk_global()->get('itemsTmp');
			
			return '
			<input  size="' . @$matches[4] . '" value="'.$answer['i'][$matches[2]].'"  />';
		}, $question['name_vn']);
		
		$pattern = '/\[(tput|tp)([\d]+)(\[([\d]+)\])?\]/';
		
		$contenths = preg_replace_callback($pattern, function($matches) {
			$answer	=	pzk_global()->get('answerTmpHs');
			$item		=	pzk_global()->get('itemsTmp');
			
			return '
			<input  class="input_dt" size="' . @$matches[4] . '" value="'.@$answer['i'][@$matches[2]].'" />';
		}, $contenths);

		
		$pattern = '/\[(textarea|t)([\d]+)\]/';
		
		$contenths = preg_replace_callback($pattern, function($matches) {
			$answer	=	pzk_global()->get('answerTmpHs');
			$item		=	pzk_global()->get('itemsTmp');
			return '<textarea class="item tinymce_input" name="answers['.$item['id'].'_t]['.$matches[2].']">'
			.
			nl2br($answer['t'][$matches[2]])
			.
			'</textarea>';
		}, $contenths);
		
		//giao vien sua
		
		$content = '';
		if($answerTl['content_edit'] != '') {
			$answer = unserialize($answerTl['content_edit']);
			
			pzk_global()->set('answerTmp', $answer);
		
			$pattern = '/\[(input|i)([\d]+)(\[([\d]+)\])?\]/';
			
			$content = preg_replace_callback($pattern, function($matches) {
				$answer	=	pzk_global()->get('answerTmp');
				$item		=	pzk_global()->get('itemsTmp');
				
				if(isset($answer['checkfalse'][@$matches[2]])) {
					$check = 'checked="checked"';
					$style = 'color: red;';
				}else{
					$check = '';
					$style = '';
				}
				
				return '
				<input '.$check.'  type="checkbox" name="checkfalse['.$item['id'].']['.$matches[2].']" value="1" class="checkfalse" />
				<input style="'.$style.'" size="' . @$matches[4] . '" value="'.$answer['i'][$matches[2]].'" name="answers['.$item['id'].'_i]['.$matches[2].']" />';
			}, $question['name_vn']);
			
			$pattern = '/\[(tput|tp)([\d]+)(\[([\d]+)\])?\]/';
			
			$content = preg_replace_callback($pattern, function($matches) {
				$answer	=	pzk_global()->get('answerTmp');
				$item		=	pzk_global()->get('itemsTmp');
				
				if(isset($answer['checkfalse'][@$matches[2]])) {
					$check = 'checked';
					$style = 'color: red;';
				}else{
					$check = '';
					$style = '';
				}
				
				return '
				<input '.$check.'  type="checkbox" name="checkfalse['.@$item['id'].']['.@$matches[2].']" value="1" class="checkfalse" />
				<input style="'.$style.'" class="input_dt" size="' . @$matches[4] . '" value="'.@$answer['i'][@$matches[2]].'" name="answers['.$item['id'].'_i]['.@$matches[2].']" />';
			}, $content);

			
			$pattern = '/\[(textarea|t)([\d]+)\]/';
			
			$content = preg_replace_callback($pattern, function($matches) {
				$answer	=	pzk_global()->get('answerTmp');
				$item		=	pzk_global()->get('itemsTmp');
				return '<textarea class="item tinymce_input" name="answers['.$item['id'].'_t]['.$matches[2].']">'
				.
				nl2br($answer['t'][$matches[2]])
				.
				'</textarea>';
			}, $content);
		
			
		}
		
		
		
?>
		<div class="row">
		
			<div class="col-xs-8 col-xs-offset-2">
				<strong> Câu <?php echo $index ?></strong>
				<h3>Bài làm của học sinh</h3>
				<p><?= $contenths; ?></p>
				<?php if($content !=''){ ?>
					<h3>Giáo viên sửa</h3>
					<p><?= $content; ?></p>
				<?php } ?>	
			</div>
			
			<div class="col-xs-8 col-xs-offset-2">
				<div class="table-responsive">
					<table class="table table-bordered">
						<tbody>
						<tr>
							<td><label class="control-label red">Điểm</label></td>
							<td><label class="control-label red">Nhận xét giáo viên</label></td>
						</tr>
						<tr>
							<td><b class="red"><?php if($answerTl['mark'] != 0) { echo $answerTl['mark']; }else { echo '0';} ?></b></td>
							<td>
								<?php echo $answerTl['recommend_mark']; ?>
							</td>
						</tr>
					</tbody>
					</table>
							
				</div>
			</div>	
			
		</div>	
		
		<hr />
	

<?php } ?>	
<?php $index++;?>
<?php endforeach; ?>
</div>
<script src="/3rdparty/tinymce/tinymce.min.js" type="text/javascript"></script>
<script>
function setInputTinymce(checkspelling) {
    var options = {
        selector: "textarea.tinymce_input",
        forced_root_block : "",
        force_br_newlines : false,
        force_p_newlines : false,
        relative_url: false,
        remove_script_host: false,
        plugins: [
            "advlist autolink lists link image charmap print preview anchor",
            "visualblocks code fullscreen media",
            "media table contextmenu textcolor"
        ],
        toolbar: "media image link bold italic underline table | alignleft aligncenter alignjustify forecolor backcolor removeformat fullscreen code",
		statusbar: false,
		menubar: false,
        entity_encoding : "raw",
        relative_urls: false,
        external_filemanager_path: BASE_URL +"/3rdparty/Filemanager/filemanager/",
        filemanager_title:"Quản lí file upload" ,
        external_plugins: { "filemanager" :BASE_URL +"/3rdparty/Filemanager/filemanager/plugin.min.js", "nanospell": BASE_URL+"/3rdparty/nanospell/plugin.js"},
        nanospell_server: "php",
        height: 130
    };
    if(!checkspelling) {
        delete options.external_plugins.nanospell;
        delete options.nanospell_server;
    }
    tinymce.init(options);
}
$(document).ready(function () {
	setInputTinymce();
});

</script>