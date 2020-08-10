

<div class="container boder nomg contentheight">
    <div class="row t-weight text-center btn-custom8 textcl">
       <h2>Bảng danh sách học sinh chưa đăng ký thi đợt 2</h2>
    </div> 
    
        <?php 
                $user= _db()->getEntity('Userbook.Usercontest');
                $test1= $user->getListUserTest();
        ?>
        <table class="table table-hover">
            <tr>
                <th>Thứ tự</th>
                <th>Tên đăng nhập</th>
                <th>Họ tên</th>
                <th>Điện thoại</th>
                <th>Tổng điểm</th>
            </tr>
            <?php  $index = 1; ?>
			<?php foreach($test1 as $item): ?>
            <tr>
                <td><?php echo $index ?></td>
                <td><?php echo @$item['username']?></td>
                <td><?php echo @$item['name']?></td>
                <td><?php echo @$item['phone']?></td>
                <td><?php echo @$item['totalMark']?></td>
            </tr>
			<?php  $index++; ?>
			<?php endforeach; ?>
            
        </table>
        
    </div>
    