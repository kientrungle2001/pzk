<div class="container fulllook3 hidden-xs">
	<div class="row">
		<div class="col-md-1">&nbsp;</div>			
		<div class="col-xs-11 col-md-11 ">
			<div class="pd-20 text-center">
				<a href="<?=FL_URL?>"><h1>FULL LOOK</h1></a>	
				<h3 class="hidden-xs">Phần mềm Khảo sát và Phát triển năng lực toàn diện bằng tiếng Anh</h3>
				<?php echo partial('Themes/Default/layouts/home/aboutbtn');?>
			</div>
		</div>
	</div>
</div>
<div class="container top50 visible-xs">
	<div class="row">
		<div class="col-md-1">&nbsp;</div>			
		<div class="col-xs-11 col-md-11 ">
			<div class="pd-20 text-left">
				<a href="<?=FL_URL?>"><h1>FULL LOOK</h1></a>	
			</div>
		</div>
	</div>
</div>	
<?php $data->displayChildren('[position=top-menu]') ?>
<div>
	
    <h2 class="text-center robotofont">Danh sách các bài thi</h2>
</div>

<?php $practice = intval(pzk_request()->getPractice());?>
 
<div class="container">
<a href="/Home/rating?practice=<?php echo $practice ?>" class="btn btn-primary">Quay lại <span class="glyphicon glyphicon-arrow-left"></span></a>
<?php
$UserId = pzk_or(intval(pzk_request()->getSegment(3)), pzk_session()->getUserId());


$pageSize = 25;
$data->pageSize = $pageSize;

$page = intval(pzk_request()->getPage());
if(!empty($page)) {
    $data->pageNum = $page;
}else{
    $data->pageNum = 0;
}

$items = $data->getTestByUserId($UserId);
$countItems = $data->countTestByUserId($UserId);
$pages = ceil($countItems / $pageSize);
if($items) {
    $i=1;
    ?>
    <table class="table table-hover">
        <tr>
            <th>#</th>
            <th>Tên đăng nhập</th>
            <th>Đề</th>
            <th>Điểm</th>
            <th>Thời gian làm bài</th>
            <th>Ngày</th>
        </tr>
        <?php foreach($items as $val): ?>
        <tr>
            <td><?php echo $i+$data->pageNum*$pageSize; ?></td>
            <td><?php echo @$val['username']?></td>
            <td><?php echo @$val['name']?></td>
            <td><?php echo @$val['mark']?></td>
            <?php
            $time = $val['duringTime'];
            $time = secondsToTime($time);
            $hour = $time['h'];
            $min = $time['m'];
            $sec = $time['s'];

            $resultStrTime = '';

            if(!empty($hour)) {
                $resultStrTime .= $hour.' giờ ';
            }

            if(!empty($min)) {
                $resultStrTime .= $min.' phút ';
            }

            if(!empty($sec)) {
                $resultStrTime .= $sec.' giây ';
            }
            ?>
            <td><span class="glyphicon glyphicon-time" aria-hidden="true"></span>  <?php  echo $resultStrTime; ?></td>
            <td><span class="glyphicon glyphicon-calendar" aria-hidden="true"></span>  <?php echo date('d/m/Y H:m:i A', strtotime($val['startTime'])); ?></td>
        </tr>
        <?php $i++; ?>
        <?php endforeach; ?>
    </table>
    <div class="panel-footer ">
        <form class="form-inline" role="form">

            <table style="margin: 0px;">
                <tr>
                   
                    <td>
                        <?php if($pages > 1) { ?>
                            <strong style="display: inline-block; vertical-align: middle;">Trang: </strong>

                            <ul style="margin: 0px; vertical-align: middle;" class="pagination">
                                <?php
                                if($data->pageNum >= 1) { ?>
                                    <li>
                                        <a href="<?php echo BASE_REQUEST ?> /home/listTest/<?php echo $UserId ?>?practice=<?php echo $practice ?>&page=0" aria-label="End">
                                            <span aria-hidden="true">Trang đầu</span>
                                        </a>
                                    <li>
                                        <a aria-label="Previous" href="<?php echo BASE_REQUEST ?> /home/listTest/<?php echo $UserId ?>?practice=<?php echo $practice ?>&page=<?php echo $data->pageNum -1; ?>">
                                            <span aria-hidden="true">&laquo;</span>
                                        </a>
                                    </li>
                                <?php } ?>

                                <?php
                                for ($page = 0; $page < $pages; $page++) { ?>
                                    <?php
                                    if($pages > 10 && ($page < $data->pageNum - 5 || $page > $data->pageNum + 5))
                                        continue;
                                    if($page == $data->pageNum) {
                                        $active = 'active';
                                    } else {
                                        $active = '';
                                    }
                                    ?>
                                    <li class="<?php echo $active ?>">
                                        <a  href="<?php echo BASE_REQUEST ?> /home/listTest/<?php echo $UserId ?>?practice=<?php echo $practice ?>&page=<?php echo $page ?>"><?php  echo ($page + 1)?></a>
                                    </li>
                                <?php } ?>

                                <?php if($data->pageNum < $pages-1) { ?>
                                <li>
                                    <a href="<?php echo BASE_REQUEST ?> /home/listTest/<?php echo $UserId ?>?practice=<?php echo $practice ?>&page=<?php echo $data->pageNum + 1; ?>" aria-label="Next">
                                        <span aria-hidden="true">&raquo;</span>
                                    </a>
                                    </li>
                                    <li>
                                    <a href="<?php echo BASE_REQUEST ?> /home/listTest/<?php echo $UserId ?>?practice=<?php echo $practice ?>&page=<?php echo $pages-1; ?>" aria-label="end">
                                        <span aria-hidden="true">Trang cuối</span>
                                    </a>
                                </li>
                                <?php } ?>
                            </ul>
                        <?php } ?>
                    </td>
                </tr>
            </table>


        </form>

    </div>
<?php
}
?>
</div>