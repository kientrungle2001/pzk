<?php 
	
	$testId = $data->getTestId();
    
    if(pzk_request()->getPage()){
        $currentpage = intval(pzk_request()->getPage());
    }else $currentpage =0;
	$pageSize = 20;
	
	switch ($testId) {
		case 95:
			$testName = 'toán lớp 3 lên 4';
			break;
		case 94:
			$testName = 'toán lớp 4 lên 5';
			break;
		case 93:
			$testName = 'toán lớp 2 lên 3';
			break;
		case 92:
			$testName = 'tiếng việt lớp 3 lên 4';
			break;
		case 91:
			$testName = 'tiếng việt lớp 4 lên 5';
			break;
		default:
			$testName = '';
	}
	
 ?>


<div class="container boder nomg contentheight">
    <div class="row t-weight text-center btn-custom8 textcl">
       Bảng xếp hạng <?php echo $testName; ?>
    </div> 
    <div class="row  panel-default">
       
        <?php 
            if($testId){
                $pageSize= $data->getPageSize();
                
                $user= _db()->getEntity('Userbook.Usercontest');
                $users= $user->getRatingUserTestTt($testId,$currentpage,$pageSize);
                $rank= $currentpage * $pageSize;
        ?>
        <table class="table table-hover">
            <tr>
                <th>Xếp hạng</th>
                <th>Tên đăng nhập</th>
				<th>Số điện thoại</th>
                <th>Số câu đúng</th>
                <th>Thời gian làm bài</th>
                
            </tr>
            <?php foreach($users as $item): ?>
            <?php 
                $rank++;
                $username= $item['username'];
				$sdt = $item['phone'];
                $duringTime= $user->loadTime($item['duringTime']);
               
            ?>
            <tr>
                <td><?php echo $rank ?></td>
                <td><?php echo $username ?></td>
				<td><?php echo $sdt ?></td>
                <td><?php echo @$item['mark']?></td>
                <td><span class="glyphicon glyphicon-time" aria-hidden="true"></span><?php echo $duringTime ?></td>
                
            </tr>
            <?php endforeach; ?>
        </table>
        
    </div>
    <!--phan trang-->
    <?php 
        
            $page=0; 
            $pageNum= $user->showPageTt($pageSize, $testId);
            
    ?>
    <div class="row panel-footer">
    <form class="form-inline" role="form">
        <table style="margin: 0px;">
            <tr>

                <td>
                    <?php if($pageNum > 0){ ?>
                    <strong style="display: inline-block; vertical-align: middle;">Trang: </strong>
                    <?php } ?>
                    <ul style="margin: 0px; vertical-align: middle;" class="pagination">
                        <?php 
                            for($page=0; $page< $pageNum; $page ++){
                                if($currentpage== $page){
                                    $active='active';
                                }else $active='';
                         ?>
                        <li class="<?php echo $active ?>">
                        <a  href="<?php echo BASE_REQUEST ?> /contest/rating/<?php echo $testId ?>?page=<?php echo $page ?>"><?php  echo ($page + 1)?></a>
                        </li>
                        <?php } ?>
                    </ul>
                </td>
            </tr>
        </table>
    </form>
    <?php } ?> 
        
    </div>
    <!--end phan trang-->
   
</div>
