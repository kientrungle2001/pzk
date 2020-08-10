<?php
$type 		= $data->get('type');
$file 		= $data->getFile();
$backHref 	= $data->getBackHref();
$content 	= @file_get_contents(BASE_DIR . $file);
?>

<form method="post" 
	onsubmit="$('#fileContent').val(aceEditor.getValue());"
	action="/Admin_Editor/filePost?file=<?php echo $file ?>&type=<?php echo $type ?>">
<input type="submit" name="btn_submit" value="Lưu" class="btn btn-primary" />
<a href="<?php echo $backHref ?>">Back</a>
<br /><br />
<?php echo $file ?><br />
<input type="hidden" name="file" value="<?php echo $file ?>" />
<input type="hidden" name="backHref" value="<?php echo $backHref ?>" />
<textarea id="content" class="form-control" style="height: 800px" name="content"><?php echo $content ?></textarea>
<input type="hidden" name="fileContent" id="fileContent" />
<input type="submit" name="btn_submit" value="Lưu" class="btn btn-primary" />
<a href="<?php echo $backHref ?>">Back</a>
</form>

<script src="https://cdnjs.cloudflare.com/ajax/libs/ace/1.2.3/ace.js" type="text/javascript" charset="utf-8"></script>
<script>
    var editor = ace.edit("content");
	aceEditor = editor;
    editor.setTheme("ace/theme/monokai");
	<?php if($type == 'js'):?>
	editor.getSession().setMode("ace/mode/javascript");
	<?php elseif($type == 'css'): ?>
	editor.getSession().setMode("ace/mode/css");
	<?php elseif($type == 'xml'): ?>
	editor.getSession().setMode("ace/mode/xml");
	<?php else: ?>
    editor.getSession().setMode("ace/mode/php");
	<?php endif; ?>
	editor.setOption("maxLines", 30);
	editor.setOption("minLines", 10);
</script>