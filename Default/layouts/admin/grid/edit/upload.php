{? 
$rand 		= rand(1, 100);
$xssize 	= pzk_or($data->get('xssize'), 12);
$mdsize 		= pzk_or($data->get('mdsize'), 12);
?}
<script src="/3rdparty/uploadify/jquery.uploadify.min.js"
	type="text/javascript"></script>
<link rel="stylesheet" href="/3rdparty/uploadify/uploadify.css"
	type="text/css" />
<div class="col-xs-{xssize} col-md-{mdsize}">
   <div   class="form-group clearfix">
	<b>{? echo $data->get('label')?}</b><br /> <br />
      <?php if($data->get('uploadtype') == 'image') { ?>
      <img id="{? echo $data->get('index')?}{rand}_image" src="{? echo $data->get('value')?}"
		height="80px" width="auto">
      <?php } ?>
      <input id="{? echo $data->get('index')?}{rand}_value" name="{? echo $data->get('index')?}"
		value="{? echo $data->get('value')?}" type="hidden" /> <input type="file"
		name="{? echo $data->get('index')?}" id="{? echo $data->get('index')?}{rand}" multiple="true" />
	<a href="javascript:$('#{? echo $data->get('index')?}{rand}').uploadify('upload')">Upload
		Files</a>
</div>
</div>

<script type="text/javascript">
      <?php $timestamp = $_SERVER['REQUEST_TIME'];?>
      setTimeout(function() {
          $('#{? echo $data->get('index')?}{rand}').uploadify({
              'formData'     : {
                  'timestamp' : '<?php echo $timestamp;?>',
                  'token'     : '<?php echo md5(SECRETKEY . $timestamp);?>',
                  'uploadtype' : '<?php echo $data->get('uploadtype'); ?>'
              },
              'swf'      : BASE_URL+'/3rdparty/uploadify/uploadify.swf',
              'uploader' : BASE_URL+'/3rdparty/uploadify/uploadify.php',
              'folder' : BASE_URL+'/3rdparty/uploads/videos',
              'auto' : false,
              'onUploadSuccess' : function(file, data, response) {
                  var src = data;
                  $('#{? echo $data->get('index')?}{rand}_value').val(src);
                  <?php if($data->get('uploadtype') == 'image') { ?>
                  $('#{? echo $data->get('index')?}{rand}_image').attr('src', src);
                  <?php } ?>
              }


          });
      }, 100);
  </script>