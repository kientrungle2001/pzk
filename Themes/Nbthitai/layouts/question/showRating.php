<?php

$dataTest = $data->get('dataTest');

$setting = pzk_controller();

$testId = pzk_session('userBookTestId');

$pageSize = pzk_session('ratingPageSize');

if($testId) {
    $data->conditions .= " and testId like '%$testId%'";

}
if($testId) {

    if($pageSize) {
        $data->pageSize = $pageSize;
    }else{
        $data->pageSize = 20;
    }
    $page = intval(pzk_request('page'));

    if(!empty($page)) {
        $data->pageNum = $page;
    }else{
        $data->pageNum = 0;
    }

    $items = $data->getItems();
    $countItems = $data->getCountItems();

    $pages = ceil($countItems / $data->pageSize);

}else{
    $items = '';
}
$practice = intval(pzk_request('practice'));
//data
?>
<div class="container fulllook3 hidden-xs">
	<div class="row">
		<div class="col-md-1">&nbsp;</div>			
		<div class="col-xs-11 col-md-11 ">
			<div class="pd-20 text-center">
				<h1>FULL LOOK</h1>	
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
<div class="container">
		<p class="t-weight text-center btn-custom8 textcl">Bảng xếp hạng</p>
</div>
<div class="container  panel-default">
    <div class=" panel-heading">
        <form role="search" action="<?php echo BASE_REQUEST . '/home/searchPost' ?>">
            <div class="row">
                <div class="col-xs-2">
                    <label for="testId"> Chọn đề thi</label>
                    <select style="margin-left: 4px;"  class="form-control input-sm" id="testId" name="testId" onchange="window.location = '/home/onchangeTestId?testId='+this.value+'&practice=<?php echo $practice ?>';" >
                        <option value="" >Chọn đề</option>
                        <?php foreach($dataTest as $item): ?>
                        <option value="<?php echo @$item['id']?>"><?php echo @$item['name']?></option>
                        <?php endforeach; ?>
                        <script type="text/javascript">
                            $('#testId').val('<?php echo $testId ?>');
                        </script>
                    </select>
                </div>


            </div>
        </form>
    </div>
	<?php
	if($items) {
		$i=1;
		?>
    <table class="table table-hover">
        <tr>
            <th>Xếp hạng</th>
            <th>Tên đăng nhập</th>
            <th>Đề</th>
            <th>Điểm</th>
            <th>Thời gian làm bài</th>
            <th>Ngày</th>
        </tr>
        <?php foreach($items as $val): ?>
        <tr>
            <td><?php echo $i+ $data->pageNum*$data->pageSize; ?></td>
            <td><a href="/home/listTest/<?php echo @$val['userId']?>"><?php echo @$val['username']?></a></td>
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
                    <td style="width: 135px;"> <strong>Số mục: </strong>
                        <select id="pageSize" name="pageSize" class="form-control input-sm" placeholder="Số mục / trang" onchange="window.location='<?php echo BASE_REQUEST . '/home/changePageSize' ?>?pageSize=' + this.value;">
                            <option value="5">5</option>
                            <option value="10">10</option>
                            <option value="20">20</option>
                            <option value="25">25</option>
                        </select>
                        <script type="text/javascript">
                            $('#pageSize').val('<?php echo $pageSize ?>');
                        </script>
                    </td>
                    <td>
                        <?php if($pages > 1) { ?>
                            <strong style="display: inline-block; vertical-align: middle;">Trang: </strong>

                            <ul style="margin: 0px; vertical-align: middle;" class="pagination">
                                <?php
                                if($data->pageNum >= 1) { ?>
                                    <li>
                                        <a href="<?php echo BASE_REQUEST ?> /Home/rating?page=0" aria-label="End">
                                            <span aria-hidden="true">Trang đầu</span>
                                        </a>
                                    <li>
                                        <a aria-label="Previous" href="<?php echo BASE_REQUEST ?> /Home/rating?page=<?php echo $data->pageNum -1; ?>">
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
                                        <a  href="<?php echo BASE_REQUEST ?> /Home/rating?page=<?php echo $page ?>"><?php  echo ($page + 1)?></a>
                                    </li>
                                <?php } ?>

                                <?php if($data->pageNum < $pages-1) { ?>
                                    <li>
                                        <a href="<?php echo BASE_REQUEST ?> /Home/rating?page=<?php echo $data->pageNum + 1; ?>" aria-label="Next">
                                            <span aria-hidden="true">&raquo;</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="<?php echo BASE_REQUEST ?> /Home/rating?page=<?php echo $pages-1; ?>" aria-label="end">
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
}else {
	?>
	<div class='item text-center'>
		<img class='item' src='/Default/skin/nobel/test/Themes/Default/media/final.jpg' />
	</div>
	<?php
}
?>
</div>

