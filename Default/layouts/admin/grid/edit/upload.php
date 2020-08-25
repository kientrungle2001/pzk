<?php  
$rand 		= rand(1, 100);
$xssize 	= pzk_or($data->getXssize(), 12);
$mdsize 		= pzk_or($data->getMdsize(), 12);
?>
<script src="/3rdparty/uploadify/jquery.uploadify.min.js"
	type="text/javascript"></script>
<link rel="stylesheet" href="/3rdparty/uploadify/uploadify.css"
	type="text/css" />
<div class="col-xs-<?php echo $xssize ?> col-md-<?php echo $mdsize ?>">
   <div   class="form-group clearfix">
	<b><?php  echo $data->getLabel()?></b><br /> <br />
      <?php if($data->getUploadtype() == 'image') { ?>
      <img id="<?php  echo $data->getIndex()?><?php echo $rand ?>_image" src="<?php  echo $data->getValue()?>"
		height="80px" width="auto">
      <?php } ?>
      <input id="<?php  echo $data->getIndex()?><?php echo $rand ?>_value" name="<?php  echo $data->getIndex()?>"
		value="<?php  echo $data->getValue()?>" type="hidden" /> <input type="file"
		name="<?php  echo $data->getIndex()?>" id="<?php  echo $data->getIndex()?><?php echo $rand ?>" multiple="true" />
	<a href="javascript:$('#<?php  echo $data->getIndex()?><?php echo $rand ?>').uploadify('upload')">Upload
		Files</a>
</div>
</div>

<script type="text/javascript">
      <?php $timestamp = $_SERVER['REQUEST_TIME'];?>
      setTimeout(function() {
          $('#<?php  echo $data->getIndex()?><?php echo $rand ?>').uploadify({
              'formData'     : {
                  'timestamp' : '<?php echo $timestamp;?>',
                  'token'     : '<?php echo md5(SECRETKEY . $timestamp);?>',
                  'uploadtype' : '<?php echo $data->getUploadtype(); ?>'
              },
              'swf'      : BASE_URL+'/3rdparty/uploadify/uploadify.swf',
              'uploader' : BASE_URL+'/3rdparty/uploadify/uploadify.php',
              'folder' : BASE_URL+'/3rdparty/uploads/videos',
              'auto' : false,
              'onUploadSuccess' : function(file, data, response) {
                  var src = data;
                  $('#<?php  echo $data->getIndex()?><?php echo $rand ?>_value').val(src);
                  <?php if($data->getUploadtype() == 'image') { ?>
                  $('#<?php  echo $data->getIndex()?><?php echo $rand ?>_image').attr('src', src);
                  <?php } ?>
              }


          });
      }, 100);
  </script>