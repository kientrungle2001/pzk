<?php 
$parentId = $data->getParentId();
$parents = _db()->select('*')->from('categories')->result();
$parents = buildArr($parents, 'parent', 0);
$row = pzk_validator()->getEditingData();
$questionTypes = _db()->select('*')->from('questiontype')->result();
?>
<form role="form" method="post" action="{url /admin_category/addPost}">
  <input type="hidden" name="id" value="" />
    <input type="hidden" name="software" value="<?php echo pzk_request()->getSoftwareId(); ?>" />
  <div class="form-group col-xs-12">
    <label class="col-xs-2" for="name">Tên dạng bài tập</label>
    <div class="col-xs-8">
    	<input type="text" class="form-control" id="name" name="name" placeholder="Tên danh mục" value="{row[name]}">
    </div>
  </div>
    <div class="form-group col-xs-12">
        <div class="col-xs-2">
            <label for="router" class="2">Tên đường dẫn</label>
        </div>
        <div class="col-xs-8">
            <input type="text" class="form-control col-xs-4" id="router" name="router" placeholder="Đường dẫn" >
        </div>
    </div>
  <div class="form-group col-xs-12">
    <label class="col-xs-2" for="parent">Danh mục cha</label>
    <div class="form-group col-xs-8">
	    <select class="form-control" id="parent" name="parent" placeholder="Danh mục cha" value="{row[parent]}">
			<option value="0">Danh mục gốc</option>
			{each $parents as $parent}
				<?php 
				$selected = '';
				if($parent['id'] == $parentId) { $selected = 'selected'; }?>
				<option value="{parent[id]}" {selected}><?php echo str_repeat('&nbsp;&nbsp;&nbsp;&nbsp;', $parent['level']); ?>{parent[name]}</option>
			{/each}
		</select>
	</div>
  </div>
    <script src="/3rdparty/uploadify/jquery.uploadify.min.js" type="text/javascript"></script>
    <link rel="stylesheet" href="/3rdparty/uploadify/uploadify.css" type="text/css"/>
    <div class="form-group col-xs-12">
        <label class="col-xs-2" for="parent">Ảnh nền</label>
        <div class="form-group col-xs-8">
            <img id="img_image"  height="80px" width="auto">
            <input id="img_value" name="img"  type="hidden">
            <input type="file" name="img" id="img"  multiple="true" />
            <a href="javascript:$('#img').uploadify('upload')">Upload Files</a>
        </div>
    </div>

    <script type="text/javascript">
        <?php $timestamp = $_SERVER['REQUEST_TIME'];?>
        setTimeout(function() {
            $('#img').uploadify({
                'formData'     : {
                    'timestamp' : '<?php echo $timestamp;?>',
                    'token'     : '<?php echo md5(SECRETKEY . $timestamp);?>',
                    'uploadtype' : 'image'
                },
                'swf'      : BASE_URL+'/3rdparty/uploadify/uploadify.swf',
                'uploader' : BASE_URL+'/3rdparty/uploadify/uploadify.php',
                'folder' : BASE_URL+'/3rdparty/uploads/videos',
                'auto' : false,
                'onUploadSuccess' : function(file, data, response) {
                    var src = data;
                    $('#img_value').val(src);
                    $('#img_image').attr('src', src);
                }


            });
        }, 100);
    </script>
  <div class="form-group col-xs-12">
  	<div class="col-xs-2">
		<label for="question_types">Các dạng bài tập</label>
	</div>
    <div class="col-xs-10">
	    <select multiple="multiple" class="form-control" id="question_types" name="question_types[]"  style="height: 300px">
			{each $questionTypes as $type}
				<option value="{type[id]}">{type[name]}</option>
			{/each}
		</select>
	</div>
  </div>
  <div class="col-xs-12">
	  <button type="submit" class="btn btn-primary col-xs-offset-6"><span class="glyphicon glyphicon-saved"></span>Save</button>
	  <a class="btn btn-default col-xs-offset-1" href="{url /admin_category/index}">Cancel</a>
  </div>
</form>