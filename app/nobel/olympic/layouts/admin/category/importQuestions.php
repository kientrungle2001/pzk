<?php $categoryId = pzk_request()->getSegment(3); 
$controller = pzk_controller();
$content = file_get_contents(BASE_DIR . '/tmp/cauhoi.txt');
?>
<div class="panel panel-default">
<div class="panel-heading">
    <b>Import câu hỏi</b>
</div>
<div class="panel-body borderadmin">
<form role="form" method="post" enctype="multipart/form-data"  action="<?php echo BASE_REQUEST . '/admin' ?>_<?php echo @$controller->module?>/importQuestionsPost/<?php echo $categoryId ?>">
 <div class="form-group clearfix">
        <label for="content">Nội dung</label>
        <div style="float: left;width: 100%;" class="item">
            <textarea id="content" name="content" style="width: 100%; height: 400px"><?php echo $content ?></textarea>
        </div>
    </div>
  <button type="submit" class="btn btn-primary"><span class="glyphicon glyphicon-saved"></span> Cập nhật</button>
  <a class="btn btn-default" href="<?php echo BASE_REQUEST . '/admin' ?>_<?php echo @$controller->module?>/index"><span class="glyphicon glyphicon-refresh"></span> Quay lại</a>
</form>
</div>
</div>