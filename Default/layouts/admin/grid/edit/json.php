<?php  
$rand = rand(1, 100);?>
<div class="form-group clearfix">
        <label for="<?php  echo $data->getIndex()?><?php echo $rand ?>"><?php  echo $data->getLabel()?></label>
        <div id="<?php  echo $data->getIndex()?><?php echo $rand ?>-json-editor" class="json-editor"></div>
		<input type="hidden" name="<?php  echo $data->getIndex()?>" id="<?php  echo $data->getIndex()?><?php echo $rand ?>" />
    </div>
	<link rel="stylesheet" href="/3rdparty/FlexiJsonEditor/jsoneditor.css"/>
	<script type="text/javascript" src="/3rdparty/FlexiJsonEditor/json2.js"></script>
	<script type="text/javascript" src="/3rdparty/FlexiJsonEditor/jquery.jsoneditor.js"></script>
    <script type="text/javascript">
		<?php if($data->getValue()): ?>
			var <?php  echo $data->getIndex()?><?php echo $rand ?>json = <?php  echo $data->getValue()?>;
		<?php else: ?>
			<?php if($data->getIsArray()): ?>
			var <?php  echo $data->getIndex()?><?php echo $rand ?>json = [];
			<?php else: ?>
			var <?php  echo $data->getIndex()?><?php echo $rand ?>json = {};
			<?php endif; ?>
		<?php endif; ?>
function <?php  echo $data->getIndex()?><?php echo $rand ?>printJSON() {
    $('#<?php  echo $data->getIndex()?><?php echo $rand ?>').val(JSON.stringify(<?php  echo $data->getIndex()?><?php echo $rand ?>json));

}

function <?php  echo $data->getIndex()?><?php echo $rand ?>updateJSON(data) {
    <?php  echo $data->getIndex()?><?php echo $rand ?>json = data;
    <?php  echo $data->getIndex()?><?php echo $rand ?>printJSON();
}

function <?php  echo $data->getIndex()?>showPath(path) {
    $('#<?php  echo $data->getIndex()?>-path').text(path);
}

$(document).ready(function() {

    $('#<?php  echo $data->getIndex()?><?php echo $rand ?>').change(function() {
        var val = $('#<?php  echo $data->getIndex()?><?php echo $rand ?>').val();

        if (val) {
            try { <?php  echo $data->getIndex()?><?php echo $rand ?>json = JSON.parse(val); }
            catch (e) { alert('Error in parsing json. ' + e); }
        } else {
            <?php  echo $data->getIndex()?><?php echo $rand ?>json = {};
        }
        
        $('#<?php  echo $data->getIndex()?><?php echo $rand ?>-json-editor').jsonEditor(<?php  echo $data->getIndex()?><?php echo $rand ?>json, { change: <?php  echo $data->getIndex()?><?php echo $rand ?>updateJSON, propertyclick: <?php  echo $data->getIndex()?><?php echo $rand ?>showPath });
    });

    $('#expander').click(function() {
        var editor = $('#<?php  echo $data->getIndex()?><?php echo $rand ?>-json-editor');
        editor.toggleClass('expanded');
        $(this).text(editor.hasClass('expanded') ? 'Collapse' : 'Expand all');
    });
    
    <?php  echo $data->getIndex()?><?php echo $rand ?>printJSON();
    $('#<?php  echo $data->getIndex()?><?php echo $rand ?>-json-editor').jsonEditor(<?php  echo $data->getIndex()?><?php echo $rand ?>json, { change: <?php  echo $data->getIndex()?><?php echo $rand ?>updateJSON, propertyclick: <?php  echo $data->getIndex()?><?php echo $rand ?>showPath });
});
    </script>