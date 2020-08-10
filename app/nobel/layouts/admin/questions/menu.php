<h2>&nbsp;&nbsp;&nbsp;&nbsp;Menu</h2>
<ul class="nav nav-pills nav-stacked">
  <li><a href="<?php echo BASE_REQUEST . '/admin_questions/index' ?>">Danh sách câu hỏi</a></li>
  <li><a href="<?php echo BASE_REQUEST . '/admin_questions/add' ?>">Thêm câu hỏi</a></li>
</ul>
<?php
$categories = _db()->select('*')->from('categories')->result();
$categories = buildArr($categories,'parent',0);
?>
<div id="showmenucate">
    <h4>Cập nhật danh mục</h4>
    <div class="item">
        <label for="categoryIds">Danh mục</label>
        <select multiple="multiple" class="form-control" id="categoryIds" name="categoryIds[]" placeholder="Danh mục" value="<?php echo @$item['categoryIds']?>" style="height: 300px">
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
</div>

