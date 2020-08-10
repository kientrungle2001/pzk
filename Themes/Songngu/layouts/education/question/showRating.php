<?php

$dataTest = $data->get('dataTest');
$setting = pzk_controller();
$class= pzk_session('lop');
/*$testId = pzk_session('userBookTestId');*/
$testId= pzk_request('examination');
$weekId= pzk_request('week');
$practice = pzk_request('practice');
$weekName = $data->getWeekById($weekId);
$pageSize = pzk_session('ratingPageSize');
if($testId) {
    $data->conditions .= " and testId = '$testId'";
    $testDetail= $data->getTestById($testId);
}
if($testId) {
    
    if($pageSize) {
        $data->pageSize = $pageSize;
    }else{
        $data->pageSize = 20;
    }
    $page = pzk_request('page');

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
$practice = pzk_request('practice');
$check= pzk_session('checkPayment'); 
//data
?>
<?php $data->displayChildren('[position=public-header]') ?>
<?php $data->displayChildren('[position=top-menu]') ?>
<div class="container">
		<p class="t-weight text-center btn-custom8 textcl">Bảng xếp hạng</p>
</div>
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1 col-sm-10 col-sm-offset-1 col-xs-12 top10 bot20">
            
                <div class="dropdown col-md-8 col-sm-8 col-xs-12 mgleft pd0 mg0">
                    <button class="btn fix_hover btn-default col-md-12 col-sm-12 col-xs-12 sharp" type="button"><span id="chonde" class="fontsize19"><?php echo @$testDetail['name_sn']?></span><img class="img-responsive imgwh hidden-xs hidden-sm pull-right" src="<?=BASE_SKIN_URL?>/Default/skin/nobel/Themes/Story/media/icon1.png" /></span>
                    </button>
                        <ul class="dropdown-menu col-md-12 col-sm-12 col-xs-12" style="top:40px; max-height:350px; overflow-y: scroll;">
                        <?php 
                            $weeks = $data->getWeekTest(ROOT_WEEK_CATEGORY_ID, $practice, $check);
                            
                         ?>
                        <?php foreach($weeks as $week ): ?>
                        
                        <li class="left20" style="color:#d9534f"><h5><strong><?php echo @$week['name']?></strong></h5>
                           
                        <?php 
                            $tests = $data->getTestSN($week['id'], $practice, $check);
                            if($practice== 1 || $practice == '1'){  ?>
                                <?php foreach($tests as $test ): ?>
                                <?php 
                                    if($test['name_sn']){
                                        $testName = $test['name_sn'];
                                    }else $testName = $test['name'];
                                ?>
                                    <li style="padding-left: 40px;"<?php if(pzk_request('week') == $week['id'] && pzk_request('examination') == $test['id']) echo'class="active"'; ?>>
                                        
                                        <a onclick="document.getElementById('chonde').innerHTML = '<?php echo $testName ?>';"  data-de="<?php echo $testName ?>" class="getdata" href="/Home/showRating?week=<?php echo @$week['id']?>&practice=1&examination=<?php echo @$test['id']?>" data-type="group"><?php echo $testName ?></a>
                                        
                                    </li>
                                <?php endforeach; ?>
                        <?php
                            }else{
                         ?>                     
                            <?php foreach($tests as $test ): ?>
                            <?php 
                                if($test['name_sn']){
                                    $testName = $test['name_sn'];
                                }else $testName = $test['name'];
                            ?>
                            <li style="padding-left: 40px;"<?php if(pzk_request('week') == $week['id'] && pzk_request('examination') == $test['id']) echo'class="active"'; ?>>
                                
                                <a onclick="id = <?php echo @$week['id']?>;document.getElementById('chonde').innerHTML = '<?php echo $testName ?>';"  data-de="<?php echo $testName ?>" class="getdata" href="/Home/showRating?week=<?php echo @$week['id']?>&practice=0&examination=<?php echo @$test['id']?>" data-type="group"><?php echo $testName ?></a>
                                
                            </li>
                            <?php endforeach; ?>
                            <?php } ?>
                            
                        </li>
                        <?php endforeach; ?>
                        </ul>
                </div>
                <div class="col-xs-12 col-md-4 col-sm-2 bd pull-right mgleft">
                    <div class="row text-center">
                        <div class="col-md-3 hidden-xs hidden-sm">
                            <img  src="<?=BASE_SKIN_URL?>/Default/skin/nobel/Themes/Story/media/dongho.png"  class=" wh40 img-responsive"/>
                        </div>
                        <div class="col-md-9 col-sm-9 col-xs-12">
                            <h4 class="robotofont"><strong>45:00</strong></h4>
                        </div>
                    </div>
                </div>
            
        </div>
    </div>
</div>
<div class="container  panel-default">
    <div class=" panel-heading">
        
    </div>
	<?php
	if($items) {
		$i=1;
		?>
	<div class="table-responsive">
    <table class="table table-hover">
        <thead>
			<tr>
				<th>Xếp hạng</th>
				<th>Tên đăng nhập</th>
                <th>Tuần</th>
				<th>Đề</th>
				<th>Điểm</th>
				<th>Thời gian làm bài</th>
				<th>Ngày</th>
			</tr>
		</thead>
		<tbody>
        <?php foreach($items as $val): ?>
        <tr>
            <td><?php echo $i+ $data->pageNum*$data->pageSize; ?></td>
            <td><a href="/home/listTest/<?php echo @$val['userId']?>?practice=<?php echo $practice ?>"><?php echo @$val['username']?></a></td>
            <td><?php echo $weekName ?></td>
            <td><?php echo @$val['name_sn']?></td>

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
		</tbody>
    </table>
	</div>
	
	<div class="panel-footer ">
        <form class="form-inline" role="form">

			<!-- <div style="padding-left: 0px ;" class='col-md-2 co-xs-12'>
                <strong>Số mục: </strong>
                <select id="pageSize" name="pageSize" class="form-control input-sm" placeholder="Số mục / trang" onchange="window.location='<?php echo BASE_REQUEST . '/home/changePageSize' ?>?pageSize=' + this.value;">
                    <option value="5">5</option>
                    <option value="10">10</option>
                    <option value="20">20</option>
                    <option value="25">25</option>
                </select>
                <script type="text/javascript">
                    $('#pageSize').val('<?php echo $pageSize ?>');
                </script>
                                
            </div> -->
		
            <table style="margin: 0px;">
                <tr>
                    <td>
                        <?php if($pages > 1) { ?>
                            <strong style="display: inline-block; vertical-align: middle;">Trang: </strong>

                            <ul style="margin: 0px; vertical-align: middle;" class="pagination">
                                <?php
                                if($data->pageNum >= 1) { ?>
                                    <li>
                                        <a href="<?php echo BASE_REQUEST ?> /Home/showRating?week=<?php echo $weekId ?>&practice=<?php echo $practice ?>&examination=<?php echo $testId ?>&page=0" aria-label="End">
                                            <span aria-hidden="true">Trang đầu</span>
                                        </a>
                                    <li>
                                        <a aria-label="Previous" href="<?php echo BASE_REQUEST ?> /Home/showRating?week=<?php echo $weekId ?>&practice=<?php echo $practice ?>&examination=<?php echo $testId ?>&page=<?php echo $data->pageNum -1; ?>">
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
                                        <a  href="<?php echo BASE_REQUEST ?> /Home/showRating?week=<?php echo $weekId ?>&practice=<?php echo $practice ?>&examination=<?php echo $testId ?>&page=<?php echo $page ?>"><?php  echo ($page + 1)?></a>
                                    </li>
                                <?php } ?>

                                <?php if($data->pageNum < $pages-1) { ?>
                                    <li>
                                        <a href="<?php echo BASE_REQUEST ?> /Home/showRating?week=<?php echo $weekId ?>&practice=<?php echo $practice ?>&examination=<?php echo $testId ?>&page=<?php echo $data->pageNum + 1; ?>" aria-label="Next">
                                            <span aria-hidden="true">&raquo;</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="<?php echo BASE_REQUEST ?> /Home/showRating?week=<?php echo $weekId ?>&practice=<?php echo $practice ?>&examination=<?php echo $testId ?>&page=<?php echo $pages-1; ?>" aria-label="end">
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
	if(!$testId) {
	?>
	<div class='item text-center'>
		<img class='item' src='/Default/skin/nobel/test/Themes/Default/media/final.jpg' />
	</div>
	<?php
	}
}
?>
</div>

