<?php $item = $data->getItem();
$controllers = pzk_controller();
$addFieldSettings = $controllers->addFieldSettings;
$controller = pzk_request()->getController();
$row = $item;
?>
<div class="panel panel-default">
    <div class="panel-heading">
        <b>Bạn muốn xóa nội dung này?</b>
    </div>
    <div class="panel-body borderadmin">
        <form role="form" method="post" action="<?php echo BASE_REQUEST . '/' ?><?php echo $controller ?>/delPost">

            <input type="hidden" name="id" value="<?php echo @$item['id']?>" />
            <?php foreach($addFieldSettings as $field): ?>
            <?php  if ($field['type'] == 'text' || $field['type'] == 'date' || $field['type'] == 'email' || $field['type'] == 'password') : ?>
            <div class="form-group clearfix">
                <label for="<?php echo @$field['index']?>"><?php echo @$field['label']?></label>
                <input type="<?php echo @$field['type']?>" class="form-control" id="<?php echo @$field['index']?>" name="<?php echo @$field['index']?>" placeholder="<?php echo @$field['label']?>" value="<?php  if ($field['type'] != 'password') { echo $row[$field['index']]; } ?>" />
            </div>
            <?php  elseif($field['type'] == 'select'): ?>
            <div class="form-group clearfix">
                <label for="<?php echo @$field['index']?>"><?php echo @$field['label']?></label>
                <select class="form-control" id="<?php echo @$field['index']?>" name="<?php echo @$field['index']?>" >

                    <?php
                    $parents = _db()->select('*')->from($field['table'])->result();
                    if(isset($parents[0]['parent'])) {
                        $parents = treefy($parents, 'parent', 0);
                        echo "<option value='0'>&nbsp;&nbsp;&nbsp;&nbsp;Danh mục gốc</option>";
                    }else{
                        echo "<option value='0'>Danh mục gốc</option>";
                    }
                    ?>
                    <?php foreach($parents as $parent): ?>
                    <?php
                    $selected = '';
                    if($parent[$field['show_value']] == $row[$field['index']]) { $selected = 'selected'; }?>
                    <option value="<?php echo $parent[$field['show_value']]; ?>" <?php echo $selected ?>>
                    <?php if(isset($parent['parent'])){ echo str_repeat('--', $parent['level']); } ?>
                    <?php echo $parent[$field['show_name']]; ?>
                    </option>
                    <?php endforeach; ?>

                </select>
            </div>

            <?php  elseif($field['type'] == 'selectInput'): ?>
            <div class="form-group clearfix">
                <label for="<?php echo @$field['index']?>"><?php echo @$field['label']?></label>
                <select class="form-control" id="<?php echo @$field['index']?>" name="<?php echo @$field['index']?>" >
                    <?php
                    $table = $field['table'];
                    $data = _db()->useCB()->select('*')->from($table)->where(array('status', 1))->result();
                    ?>
                    <?php foreach($data as $val ): ?>
                    <option <?php if($row[$field['index']] == $val[$field['show_value']]) { echo 'selected'; } ?> value="<?php echo $val[$field['show_value']]; ?>"><?php echo $val[$field['show_name']]; ?></option>
                    <?php endforeach; ?>

                </select>
                <input id="<?php echo @$field['hidden']?>" type="hidden" value="<?php echo $row[$field['hidden']]; ?>" name="<?php echo @$field['hidden']?>"/>
            </div>
            <script>
                $('#<?php echo @$field['index']?>').change(function() {
                    var optionSelected = $(this).find("option:selected");
                    var textSelected   = optionSelected.text();
                    $('#<?php echo @$field['hidden']?>').val(textSelected);
                });
            </script>


            <?php  elseif($field['type'] == 'admin_controller'): ?>
            <div class="form-group clearfix">
                <label for="<?php echo @$field['index']?>"><?php echo @$field['label']?></label>
                <select class="form-control" id="<?php echo @$field['index']?>" name="<?php echo @$field['index']?>" >
                    <option value="">Chọn controller</option>
                    <?php
                    $arrcontroller = glob(BASE_DIR.'/app/ptnn/controller/admin/*.php');

                    ?>
                    <?php foreach($arrcontroller as $val ): ?>
                    <?php
                    $namec = 'admin_'.strtolower(basename($val,".php"));
                    //var_dump($row[$field['index']]);
                    //$file = file_get_contents($val);
                    //preg_match('/\/\/\[([^\]]+)\]/', $file, $match);
                    //var_dump($match);
                    ?>

                    <option <?php if($row[$field['index']] == $namec) { echo 'selected'; } ?> value="<?php echo 'admin_'.strtolower(basename($val,".php"));  ?>"><?php echo 'admin_'.strtolower(basename($val,".php"));  ?></option>
                    <?php endforeach; ?>

                </select>
            </div>

            <?php  elseif($field['type'] == 'upload'): ?>
            <script src="/3rdparty/uploadify/jquery.uploadify.min.js" type="text/javascript"></script>
            <link rel="stylesheet" href="/3rdparty/uploadify/uploadify.css" type="text/css"/>

            <div class="form-group clearfix">
                <b><?php echo @$field['label']?></b><br /><br />

                <?php if($field['uploadtype'] == 'image') { ?>
                    <img id="<?php echo @$field['index']?>_image" src="<?php echo $row[$field['index']]; ?>" height="80px" width="auto">
                <?php } ?>

                <input id="<?php echo @$field['index']?>_value" name="<?php echo @$field['index']?>" value="<?php echo @$row['url']?>" type="hidden" />
                <input type="file" name="<?php echo @$field['index']?>" id="<?php echo @$field['index']?>"  multiple="true" />
                <a href="javascript:$('#<?php echo @$field['index']?>').uploadify('upload')">Upload Files</a>

            </div>

            <script type="text/javascript">
                <?php $timestamp = $_SERVER['REQUEST_TIME'];?>
                setTimeout(function() {
                    $('#<?php echo @$field['index']?>').uploadify({
                        'formData'     : {
                            'timestamp' : '<?php echo $timestamp;?>',
                            'token'     : '<?php echo md5('ptnn' . $timestamp);?>',
                            'uploadtype' : '<?php echo $field['uploadtype']; ?>'
                        },
                        'swf'      : BASE_URL+'/3rdparty/uploadify/uploadify.swf',
                        'uploader' : BASE_URL+'/3rdparty/uploadify/uploadify.php',
                        'folder' : BASE_URL+'/3rdparty/uploads/videos',
                        'auto' : false,
                        'onUploadSuccess' : function(file, data, response) {
                            var src = data;
                            $('#<?php echo @$field['index']?>_value').val(src);
                            <?php if($field['uploadtype'] == 'image') { ?>
                            $('#<?php echo @$field['index']?>_image').attr('src', src);
                            <?php } ?>
                        }


                    });
                },100);
            </script>



            <?php  elseif($field['type'] == 'select_fix'): ?>
            <div class="form-group clearfix">
                <label for="<?php echo @$field['index']?>"><?php echo @$field['label']?></label>
                <select class="form-control" id="<?php echo @$field['index']?>" name="<?php echo @$field['index']?>" >
                    <option <?php if($row[$field['index']] == 1) { echo 'selected'; } ?> value="1">Không cấm</option>
                    <option <?php if($row[$field['index']] == 'edit') { echo 'selected'; } ?> value="edit">edit</option>
                    <option <?php if($row[$field['index']] == 'add') { echo 'selected'; } ?> value="add">add</option>
                </select>
            </div>


            <?php  elseif($field['type'] == 'tinymce'): ?>
            <div class="form-group clearfix">
                <label for="<?php echo @$field['index']?>"><?php echo @$field['label']?></label>
                <div style="float: left;width: 100%;" class="item">
                    <textarea id="<?php echo @$field['index']?>" name="<?php echo @$field['index']?>"><?php if(isset($row[$field['index']])) { echo $row[$field['index']];}  ?></textarea>
                </div>
            </div>
            <script type="text/javascript">
                tinymce.init({
                    selector: "textarea#<?php echo @$field['index']?>",
                    forced_root_block : "",
                    force_br_newlines : true,
                    force_p_newlines : false,
                    relative_url: false,
                    remove_script_host: false,
                    plugins: [
                        "advlist autolink lists link image charmap print preview anchor",
                        "searchreplace visualblocks code fullscreen media",
                        "insertdatetime media table contextmenu paste responsivefilemanager textcolor"
                    ],

                    toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image | styleselect formatselect fontselect fontsizeselect | forecolor backcolor",
                    entity_encoding : "raw",
                    relative_urls: false,
                    external_filemanager_path: "/3rdparty/Filemanager/filemanager/",
                    filemanager_title:"Quản lý file upload" ,
                    external_plugins: { "filemanager" :"/3rdparty/Filemanager/filemanager/plugin.min.js"},
                    height: 250
                });
            </script>


            <?php  elseif($field['type'] == 'status'): ?>
            <div class="form-group clearfix"><?php
                $selected0 = ''; $selected1 = '';
                $selectedField = 'selected'.$row['status'];
                $$selectedField = 'selected';
                ?>
                <label for="<?php echo @$field['index']?>"><?php echo @$field['label']?></label>
                <select class="form-control" id="<?php echo @$field['index']?>" name="<?php echo @$field['index']?>" placeholder="Chưa kích hoạt" value="<?php echo @$item['status']?>">
                    <option value="0" <?php echo $selected0 ?>>Chưa kích hoạt</option>
                    <option value="1" <?php echo $selected1 ?>>Đã kích hoạt</option>
                </select>
            </div>
            <?php  endif ?>
            <?php endforeach; ?>

          <button type="submit" class="btn btn-primary"><span class="glyphicon glyphicon-ok"></span> Đúng</button>
          <a class="btn btn-default" href="<?php echo BASE_REQUEST . '/' ?><?php echo $controller ?>/index}"><span class="glyphicon glyphicon-backward"></span> Không, quay lại</a>
        </form>
    </div>
</div>