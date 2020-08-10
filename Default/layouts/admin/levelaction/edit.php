<?php
$level = _db()->select('level,id')->from('admin_level')->result();
$menu = _db()->select('*')->from('admin_menu')->result();
$menuTree = treefy($menu);
$item = $data->getItem();
?>
<form id="levelactionsEditForm" role="form" method="post" action="<?php echo BASE_REQUEST . '/admin_levelaction/editPost' ?>">

    <input type="hidden" name="id" value="<?php echo @$item['id']?>" />

    <div class="form-group col-xs-12">
        <div class="col-xs-2">
            <label for="group_question">Chọn nhóm người dùng</label><br />
        </div>
        <div class="col-xs-4">
            <select id="admin_level_id" name="admin_level_id" class="form-control input-sm">
                <option value="">-- Nhóm Người dùng --</option>
                <?php foreach($level as $val): ?>
                <option value="<?php echo @$val['id']?>"><?php echo @$val['level']?></option>
                <?php endforeach; ?>

            </select>
            <input id="admin_level" type="hidden" name="admin_level" />
            <script type="text/javascript">
                $('#admin_level_id').change(function() {
                    var optionSelected = $(this).find("option:selected");
                    var namelevel   = optionSelected.text().trim();
                    $('#admin_level').val(namelevel);
                });
                $('#admin_level_id').val('<?php echo @$item['admin_level_id']?>');
            </script>
        </div>
    </div>

    <div class="form-group col-xs-12">
        <div class="col-xs-2">
            <label for="group_question">Chọn menu</label><br />
        </div>
        <div class="col-xs-4">
            <select id="admin_action" name="admin_action" class="form-control input-sm">
                <option value="">-- Chọn menu --</option>
                <?php foreach($menuTree as $cat): ?>
                <option value="<?php echo @$cat['admin_controller']?>"><?php echo str_repeat('&nbsp;&nbsp;&nbsp;&nbsp;', $cat['level']);?><?php echo @$cat['name']?></option>
                <?php endforeach; ?>

            </select>
            <script type="text/javascript">
                $('#admin_action').val('<?php echo @$item['admin_action']?>');
            </script>
        </div>
    </div>

    <div class="form-group col-xs-12">
        <div class="col-xs-2">
            <label for="group_question">Chọn action cho phép truy cập</label><br />
        </div>
        <div class="col-xs-4">
            <div class="showlevel">
                <select id='action_type' name='action_type' class='form-control input-sm'>
                    <option value='index'>index</option>
                </select>
            </div>
        </div>
    </div>

    <div class="form-group col-xs-12">
        <div class="col-xs-2">
            <label for="group_question">Trạng thái</label><br />
        </div>
        <div class="col-xs-4">
            <select class="form-control" id="status" name="status" placeholder="Chưa kích hoạt">
                <option value="0">Chưa kích hoạt</option>
                <option value="1">Đã kích hoạt</option>
            </select>
            <script type="text/javascript">
                $('#status').val('<?php echo @$item['status']?>');
            </script>
        </div>
    </div>



    <div class="form-group col-xs-12">
        <div class="col-xs-3 col-xs-offset-2">
            <button type="submit" class="btn btn-primary"><span class="glyphicon glyphicon-save"></span>Cập nhật</button>
            <a class="btn btn-default margin-left-10" href="<?php echo BASE_REQUEST . '/admin_levelaction/index' ?>">Quay lại</a>
        </div>
    </div>
</form>
<?php
$editValidator = json_encode(pzk_controller()->editValidator);
?>
<script>
    $('#levelactionsEditForm').validate(<?php echo $editValidator ?>);
    $('#admin_action').change(function() {
        adminController = $(this).val();
        if(adminController.length > 0 ) {
            $.ajax({
                type: "POST",
                url: "<?php echo BASE_REQUEST ?>/admin_levelaction/getAdminAction",
                data:{adminController:adminController},
                success: function(data) {
                    $('.showlevel').html(data);

                }
            });
        }else {
            alert('Bạn phải chọn menu!');
        }

    });
</script>