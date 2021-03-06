<h2>&nbsp;&nbsp;&nbsp;&nbsp;Menu</h2>
<ul class="nav nav-pills nav-stacked">
  <li><a href="<?php echo BASE_REQUEST . '/admin_questions/index' ?>">Danh sách câu hỏi</a></li>
  <li><a href="<?php echo BASE_REQUEST . '/admin_questions/add' ?>">Thêm câu hỏi</a></li>
</ul>
<?php
if(pzk_request()->getAction() == 'index') {
$categories = _db()->select('*')->from('categories')->result();
$categories = buildArr($categories,'parent',0);

$testIds = _db()->select('*')->from('tests')->result();
?>
<div id="showmenucate">
    <h4>Cập nhật danh mục</h4>
    <div class="item">
        <label for="categoryIds">Danh mục</label>
        <select multiple="multiple" class="form-control" id="categoryIds" name="categoryIds[]" placeholder="Danh mục" value="<?php echo @$item['categoryIds']?>" style="height: 200px">
            <?php foreach($categories as $cat): ?>
            <?php
            $tab = '&nbsp;&nbsp;&nbsp;&nbsp;';
            $tabs = str_repeat($tab, $cat['level']);
            $catName = $tabs.$cat['name'];
            ?>
            <option value="<?php echo @$cat['id']?>"><?php echo $catName ?></option>
            <?php endforeach; ?>
        </select>
        <input style="margin-top: 5px;" class="btn btn-primary" id="updatecate" value="Cập nhật" type="button"/>
    </div>

    <h4>Cập nhật đề</h4>
    <div class="item">
        <label for="testIds">Chọn đề</label>
        <select multiple="multiple" class="form-control" id="testIds" name="testIds[]" placeholder="Danh mục"  style="height: 200px">
            <?php foreach($testIds as $cat): ?>

            <option value="<?php echo @$cat['id']?>"><?php echo @$cat['name']?></option>
            <?php endforeach; ?>
        </select>
        <input style="margin-top: 5px;" class="btn btn-primary" id="updatetets" value="Cập nhật" type="button"/>
    </div>
<?php } ?>
</div>

