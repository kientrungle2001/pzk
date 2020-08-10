<?php
$id = intval(pzk_request()->get('id'));
$categoryId = $data->get('categoryId');

 ?>
<div id="mathvoca" class="item text-center" style="<?php /*background: transparent url('/Default/skin/nobel/test/Themes/Default/media/vocabg.jpg') no-repeat center center;*/ ?>    
	-webkit-background-size: cover;
	-moz-background-size: cover;
	-o-background-size: cover;
	background-size: 100%;
	height: auto">

  <!-- Nav tabs -->
  <ul style='margin-top: 20px;' class="nav item nav-tabs" role="tablist">
    <li role="presentation" class="active"><a href="#tuvung" aria-controls="tuvung" role="tab" data-toggle="tab">Từ vựng</a></li>
   
	<li role="presentation"><a href="#kttuvung" aria-controls="kttuvung" role="tab" data-toggle="tab">Kiểm tra từ vựng</a></li>
	
  </ul>

  <!-- Tab panes -->
  <div class="tab-content item">
    <div style='overflow: hidden;' role="tabpanel" class="tab-pane active" id="tuvung">
		<?php  $item = $data->getItem(); ?>
		<div id="document-detail">
			<br>
			<p class="t-weight text-center"><?php echo @$item['title']?></p>
			<?php if(@$item['file']) : ?>
			 
			<script type="text/javascript" src="/3rdparty/jquery.gdocsviewer.v1.0/jquery.gdocsviewer.min.js"></script>
			<script type="text/javascript">
				$(document).ready(function() {
					$('a#linktl').gdocsViewer({width: '100%'});
					var scriptTag = '<'+'script language="JavaScript"'+'>\
		var dictionaries = "ev_ve";\
		<'+'/script'+'>\
		<'+'script language="JavaScript1.2" src="http://vndic.net/js/vndic.js"  type="text/javascript"'+'><'+'/'+'script'+'>';
		setTimeout(function() {
			$("#linktl-gdocsviewer iframe").contents().find("body").append(scriptTag);
		}, 15000);
				});
			</script>
			
			
			<a href="<?php echo BASE_URL.$item['file']; ?>" id="linktl">&nbsp;</a>
			<?php else: ?>
			<div class="content">
			
				<?php
					
					$string = htmlentities($item['content'], null, 'utf-8');
					$content = str_replace("&nbsp;", " ", $string);
					
					$start = '<button class="btn btn-primary" type="button" onclick="translateTl(this)">
				  Dịch
				</button>
				<div class="none" >
				  <div class="content-translate">';	
				  
				  $end = ' </div>
				</div>';
				$content = str_replace('[start]', $start, $content);
				$content = str_replace('[end]', $end, $content);
				$content = html_entity_decode($content);
				$content = preg_replace_callback('/\[audio\]([^\[]*)\[endaudio\]/', function($word) {
					$wordShow = strip_tags($word[1]);
					$wordPass =  str_replace(' ', '_', strtolower($wordShow));
					return $wordShow.' <span class="btn btn-default glyphicon glyphicon-volume-up" onclick="read_question(this,\'/3rdparty/Filemanager/source/audiovocabulary/'.$wordPass.'.mp3\');"></span>';
				}, $content);
				
				$content = preg_replace_callback('/\[fix\]([^\[]*)\[endfix\]/', function($word) {
					$wordShow = strip_tags($word[1]);
					$wordPass =  str_replace(' ', '_', strtolower($wordShow));
					return ' <span class="btn btn-default glyphicon glyphicon-volume-up" onclick="read_question(this,\'/3rdparty/Filemanager/source/audiovocabulary/'.$wordPass.'.mp3\');"></span>';
				}, $content);
				
				echo getLatex($content);
				?>
			<div class="text-center top10">
			<a href="#" onclick="$('.nav-tabs a[href=\'#kttuvung\']').tab('show'); $('html, body').animate({ scrollTop: $('.nav-tabs a[href=\'#kttuvung\']').offset().top }, 2000); return false;" class="btn btn-danger">Kiểm tra từ vựng</a><br />
			</div>	
			</div>
			<?php endif; ?>	
			
		</div>
	</div>
	
    <div style='padding: 10px 0px;' role="tabpanel" class="tab-pane" id="kttuvung">
		<div class='item'>
		<input type='hidden' id='pageGame' name='pageGame' value='1'/>
		
			<?php 
				$checkVdrag = $data->checkIsGameByType('vdrag', $id);
				$checkVdragimg = $data->checkIsGameByType('vdragimg', $id);
				$checkVmt = $data->checkIsGameByType('vmt', $id);
				$checkSortword = $data->checkIsGameByType('sortword', $id);
				$checkVdt = $data->checkIsGameByType('vdt', $id);
				$checkDragToPart = $data->checkIsGameByType('dragToPart', $id);
			?>
			<button <?php if($checkVdrag === false){ echo "style='opacity: 0.3;'";} ?> onclick="gameWords(<?=$id?>, 'vdrag', <?=$categoryId;?>, this);" class='btn v_game btn-warning'>Game 1</button>
			
			<button <?php if($checkVdt === false){ echo "style='opacity: 0.3;'";} ?> onclick="gameWords(<?=$id?>, 'vdt', <?=$categoryId;?>, this);" class='btn v_game btn-success'>Game 2</button>
					
			<button <?php if($checkVmt === false){ echo "style='opacity: 0.3;'";} ?> onclick="gameWords(<?=$id?>, 'vmt', <?=$categoryId;?>, this);" class='btn v_game btn-info'>Game 3</button>
			<button <?php if($checkSortword === false){ echo "style='opacity: 0.3;'";} ?> onclick="gameWords(<?=$id?>, 'sortword', <?=$categoryId;?>, this);" class='btn v_game btn-primary'>Game 4</button>
			<button <?php if($checkVdragimg === false){ echo "style='opacity: 0.3;'";} ?> onclick="gameWords(<?=$id?>, 'vdragimg', <?=$categoryId;?>, this);" class='btn v_game btn-danger'>Game 5</button>
			<button <?php if($checkDragToPart === false){ echo "style='opacity: 0.3;'";} ?> onclick="gameWords(<?=$id?>, 'dragToPart', <?=$categoryId;?>, this);" class='btn v_game btn-danger'>Game 6</button>
			<div class='item' id='resGame' >
				<img class='item' src="<?php echo BASE_URL; ?>/Default/skin/nobel/test/Themes/Default/media/bg_game.jpg" />
			</div>
		</div>
	</div>
	
    
  </div>

</div>
 <style>
 .active_v_game {
	font-weight: bold;
    color: red !important;
    background: #F7E285 !important;
    border: 2px solid red !important;
 }
 .v_game{
	 font-size: 16px;
 }
 </style>
<script>
var gameScoreByPage = [];
var trueWordByPages = [];
function gameWords(id, type, cateId, that) {
	$('#pageGame').val(1);
	$('.v_game').removeClass('active_v_game');
	$(that).addClass('active_v_game');
	if(id && type) {
		$.ajax({
			type: "Post",
			data: {id:id, type:type, cateId:cateId},
			url:'<?=BASE_REQUEST?>/Game/gameVocabulary',
			success: function(data){
				$('#resGame').html(data);
				
			}
		});
	}
	

}
setTimeout(function() {
	$('.imgbg').height('auto');
}, 300);

</script>