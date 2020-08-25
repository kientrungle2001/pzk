<?php
$id = intval(pzk_request()->getId());

 ?>
<div class="content text-center" style="background: transparent url('/Default/skin/nobel/test/Themes/Default/media/vocabg.jpg') no-repeat center center;    
	-webkit-background-size: cover;
	-moz-background-size: cover;
	-o-background-size: cover;
	background-size: 100%;
	height: 990px;
	">

  <!-- Nav tabs -->
  <ul class="nav nav-tabs" role="tablist">
    <li role="presentation" class="active"><a href="#tuvung" aria-controls="tuvung" role="tab" data-toggle="tab">Từ vựng</a></li>
    <?php //if(DEBUG_MODE){ ?>
	<li role="presentation"><a href="#kttuvung" aria-controls="kttuvung" role="tab" data-toggle="tab">Kiểm tra từ vựng</a></li>
	<?php //} ?>
  </ul>

  <!-- Tab panes -->
  <div class="tab-content scrollquestion" style="width:100%; height:750px">
    <div role="tabpanel" class="tab-pane active" id="tuvung" >
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
					$("#linktl-gdocsviewer iframe").contents().find("body").append(scriptTag);
				});
				
				
			</script>
			
			
			<a href="<?php echo BASE_URL.$item['file']; ?>" id="linktl">&nbsp;</a>
			<?php else: ?>
			<div class="content dc-content">
				<?php
					
					$string = htmlentities($item['content'], null, 'utf-8');
					$content = str_replace("&nbsp;", " ", $string);
					$start = '<button class="btn btn-primary" type="button" onclick="translateTl(this)">
				  Dịch
				</button>
				<div class="none">
				  <div class="content-translate">';	
				  
				  $end = ' </div>
				</div>';
				$content = str_replace('[start]', $start, $content);
				$content = str_replace('[end]', $end, $content);
				$content = html_entity_decode($content);
				echo $content;
				?>
			</div>
			<?php endif; ?>	
			<div class="text-center top10">
			<a href="#kttuvung" class="btn btn-danger">Kiểm tra từ vựng</a>
			</div>
		</div>
	</div>
	<?php //if(DEBUG_MODE) { ?>
    <div style='padding: 10px 0px;' role="tabpanel" class="tab-pane" id="kttuvung">
		<div class='item'>
			<button onclick="gameWords(<?=$id?>, 'sortword');" class='btn btn-primary'>Game 1</button>
			<button onclick="gameWords(<?=$id?>, 'vdragimg');" class='btn btn-danger'>Game 2</button>			
			<button onclick="gameWords(<?=$id?>, 'vmt');" class='btn btn-info'>Game 3</button>
			<button onclick="gameWords(<?=$id?>, 'vdrag');" class='btn btn-warning'>Game 4</button>
			<button onclick="gameWords(<?=$id?>, 'vdt');" class='btn btn-success'>Game 5</button>
			<button onclick="gameWords(<?=$id?>, 'dragToPart');" class='btn btn-danger'>Game 6</button>
			
			<div class='item' id='resGame' >
				
			</div>
		</div>
	</div>
	<?php //} ?>
    
  </div>

</div>
 
<script>
function gameWords(id, type) {
		if(id && type) {
			$.ajax({
				type: "Post",
				data: {id:id, type:type},
				url:'<?=BASE_REQUEST?>/Game/gameVocabulary',
				success: function(data){
					$('#resGame').html(data);
					
				}
			});
		}
	}
</script>