<?php $item = $data->getItem();
 $controllerlayout = $data->getControllerlayout();
 ?>
<div id="module-area-<?php echo @$item['id']?>" class="module-area">
<h3>Module: <?php echo @$item['name']?> <span class="glyphicon glyphicon-remove red" onclick="if(confirm('Bạn có chắc muốn xóa?')){ window.location='/Admin_Site_Controllerlayout/moduleDelete/<?php echo @$item['id']?>/<?php echo @$controllerlayout['id']?>'; }"></span> <span class="glyphicon glyphicon-arrow-up blue" onclick="window.location='/Admin_Site_Controllerlayout/moduleUp/<?php echo @$item['id']?>/<?php echo @$controllerlayout['id']?>';"></span><span class="glyphicon glyphicon-arrow-down blue" onclick="window.location='/Admin_Site_Controllerlayout/moduleDown/<?php echo @$item['id']?>/<?php echo @$controllerlayout['id']?>';"></span>
<span class="glyphicon glyphicon-cog blue" onclick="window.location='/Admin_Site_Controllerlayout/moduleConfig/<?php echo @$item['id']?>/<?php echo @$controllerlayout['id']?>';"></span>
</h3>
<div class="inline-edit inline-edit-item-<?php echo @$item['id']?>" rel="<?php echo @$item['id']?>"><code><?php echo nl2br (html_escape ($item['code']));?></code></div>
<div class="edit-area">
	<form action="/Admin_Site_Controllerlayout/moduleEdit/<?php echo @$item['id']?>/<?php echo @$controllerlayout['id']?>" method="post">
	<textarea name="code"><?php echo html_escape($item['code']);?></textarea>
	<button name="btn_submit" class="btn btn-primary">Sửa</button>
	<a href="#" class="btn btn-default" onclick="$('#module-area-<?php echo @$item['id']?> .inline-edit').show(); $('#module-area-<?php echo @$item['id']?> .edit-area').hide(); return false;">Đóng</a>
	</form>
</div>
</div>
