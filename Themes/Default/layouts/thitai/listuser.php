

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
            {? $index = 1; ?}
			{each $test1 as $item}
            <tr>
                <td>{index}</td>
                <td>{item[username]}</td>
                <td>{item[name]}</td>
                <td>{item[phone]}</td>
                <td>{item[totalMark]}</td>
            </tr>
			{? $index++; ?}
			{/each}
            
        </table>
        
    </div>
    