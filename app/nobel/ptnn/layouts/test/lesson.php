<div class="item bg_section">
<form class="item" style="margin: 15px 0px;" action="/test/test?id=<?php echo pzk_request()->getId();?>" method="post">
    <table class="tb_lesson" border="1px" cellpadding="0" cellspacing="0">
    <?php 
        $test= $data->getTest();
        $key= $data->getKeyTest();
     ?>
        <thead>
        <tr>
            <th colspan="4"> <?php $data->checkCategory($test->getCategoryId()); ?></th>
        </tr>
        <tr>
            <th>Số câu</th>
            <th>Thời gian</th>
            <th>Mức độ</th>
            <th rowspan="2">
                <input type="submit" name="submit" value="Bắt đầu làm bài">
            </th>
        </tr>
        <tr>
            <th><?php echo $test->getQuantity(); ?></th>
            <th><?php echo $test->getTime(); ?></th>
            <th><?php  $data->checkLevel($test->getLevel()); ?></th>
    
        </tr>    
        </thead>
    </table>
</form>

</div>
