<?php
if(file_exists(BASE_DIR .($audio = '/3rdparty/Filemanager/source/practice/all/' . $data->get('itemId') . '.mp3'))):
?>
<span class="btn btn-default glyphicon glyphicon-volume-up" onclick="read_question(this, '<?php echo $audio ?>');"></span>
<?php
endif;
?>