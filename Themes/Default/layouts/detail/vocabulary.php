<?php 
	$check= pzk_session('checkPayment');
	$subjectId = intval(pzk_request()->getSegment(3));
	$vocabularys = $data->showDocument($check, $subjectId); 
	
?>
<div class="row <?php if(count($vocabularys) == 0){ echo "hidden"; }?>">
<button class="btn fix_hover2 btn-default col-md-12 sharp" type="button"><span id="chontu" class="fontsize19">Từ vựng chuyên ngành</span><span class="pull-right"><img class="img-responsive imgwh" src="<?=BASE_SKIN_URL?>/Default/skin/nobel/Themes/Story/media/icon1.png" /></span>
</button>
<ul class="dropdown-menu col-md-12 nomgin3">
	<?php foreach($vocabularys as $item): ?>
	<li><a href="" onclick="showdoc(<?php echo @$item['id']?>); return false"><?php echo @$item['title']?></a></li>
	<?php endforeach; ?>
</ul>
</div>
<script>
	function showdoc(id){
	$(".content").load(BASE_REQUEST + "/practice/vocabulary/?class=&id="+id);
}
</script>	