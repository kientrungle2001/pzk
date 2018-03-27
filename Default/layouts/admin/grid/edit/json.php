{? 
$rand = rand(1, 100);?}
<div class="form-group clearfix">
        <label for="{? echo $data->get('index')?}{rand}">{? echo $data->get('label')?}</label>
        <div id="{? echo $data->get('index')?}{rand}-json-editor" class="json-editor"></div>
		<input type="hidden" name="{? echo $data->get('index')?}" id="{? echo $data->get('index')?}{rand}" />
    </div>
	<link rel="stylesheet" href="/3rdparty/FlexiJsonEditor/jsoneditor.css"/>
	<script type="text/javascript" src="/3rdparty/FlexiJsonEditor/json2.js"></script>
	<script type="text/javascript" src="/3rdparty/FlexiJsonEditor/jquery.jsoneditor.js"></script>
    <script type="text/javascript">
		<?php if($data->get('value')): ?>
			var {? echo $data->get('index')?}{rand}json = {? echo $data->get('value')?};
		<?php else: ?>
			<?php if($data->getIsArray()): ?>
			var {? echo $data->get('index')?}{rand}json = [];
			<?php else: ?>
			var {? echo $data->get('index')?}{rand}json = {};
			<?php endif; ?>
		<?php endif; ?>
function {? echo $data->get('index')?}{rand}printJSON() {
    $('#{? echo $data->get('index')?}{rand}').val(JSON.stringify({? echo $data->get('index')?}{rand}json));

}

function {? echo $data->get('index')?}{rand}updateJSON(data) {
    {? echo $data->get('index')?}{rand}json = data;
    {? echo $data->get('index')?}{rand}printJSON();
}

function {? echo $data->get('index')?}showPath(path) {
    $('#{? echo $data->get('index')?}-path').text(path);
}

$(document).ready(function() {

    $('#{? echo $data->get('index')?}{rand}').change(function() {
        var val = $('#{? echo $data->get('index')?}{rand}').val();

        if (val) {
            try { {? echo $data->get('index')?}{rand}json = JSON.parse(val); }
            catch (e) { alert('Error in parsing json. ' + e); }
        } else {
            {? echo $data->get('index')?}{rand}json = {};
        }
        
        $('#{? echo $data->get('index')?}{rand}-json-editor').jsonEditor({? echo $data->get('index')?}{rand}json, { change: {? echo $data->get('index')?}{rand}updateJSON, propertyclick: {? echo $data->get('index')?}{rand}showPath });
    });

    $('#expander').click(function() {
        var editor = $('#{? echo $data->get('index')?}{rand}-json-editor');
        editor.toggleClass('expanded');
        $(this).text(editor.hasClass('expanded') ? 'Collapse' : 'Expand all');
    });
    
    {? echo $data->get('index')?}{rand}printJSON();
    $('#{? echo $data->get('index')?}{rand}-json-editor').jsonEditor({? echo $data->get('index')?}{rand}json, { change: {? echo $data->get('index')?}{rand}updateJSON, propertyclick: {? echo $data->get('index')?}{rand}showPath });
});
    </script>