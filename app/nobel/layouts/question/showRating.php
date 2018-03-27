<style>
    #left {
        background-image: url('/default/skin/test/media/bg_test_page.png');
        background-size: 99.5%;
        background-repeat: no-repeat;
        min-height: 1350px;
        margin-top: 3px;
    }
</style>
<?php
$dataTest = $data->getDataTest();

$setting = pzk_controller();

$testId = pzk_session('userBookTestId');
$keyword = pzk_session('usernameTest');
$pageSize = pzk_session('ratingPageSize');

if($keyword) {
    $data->conditions .= " and username like '%$keyword%'";
}
if($testId) {
    $data->conditions .= " and testId like '%$testId%'";

}
if($keyword or $testId) {

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
//data
?>
<div style="float: left; margin-bottom:-4px; margin-top:20px; margin-left:1.5%; border: 4px solid #017F3F; border-radius: 20px; background: white; padding: 4px 25px;">
    <h2 style="color: #2e3092; text-transform: uppercase; text-align: center; font-family: 'utmc'; font-weight: bold; font-size: 18px; margin: 4px 0px 10px 0px;">Bảng xếp hạng</h2>
</div>
<div style="border: 4px solid #017F3F; float: left; width: 94%; margin: 0px 3%;" class="panel panel-default">

    <div class="panel-heading">
        <form role="search" action="{url /Ngonngu/searchPost}">
            <div class="row">
                <!--
                <div class="form-group col-xs-2">
                    <label for="keyword">Tên đăng nhập</label><br>
                    <input class="form-control input-sm" type="text" name="keyword" id="keyword"  placeholder="Tên đăng nhập" value="{keyword}" />
                </div-->

                <div class="col-xs-3">
                    <label for="testId"> Chọn đề thi</label>
                    <select style="margin-left: 4px;"  class="input-sm" id="testId" name="testId" onchange="window.location = 'onchangeTestId?testId='+this.value;" >
                        <option value="" >Chọn đề</option>
                        {each $dataTest as $item}
                        <option value="{item[id]}">{item[name]}</option>
                        {/each}
                        <script type="text/javascript">
                            $('#testId').val('{testId}');
                        </script>
                    </select>
                </div>

                <!--
                <div class="form-group col-xs-1">
                    <label>&nbsp;</label> <br>
                    <button type="submit" name ="submit_action" class="btn btn-primary btn-sm" value="<?=ACTION_SEARCH?>"><span style="padding: 0px;" class="glyphicon glyphicon-search"></span> Search</button>
                </div>
                <div style="margin-left: 10px" class="form-group col-xs-1">
                    <label>&nbsp;</label> <br>
                    <button type="submit" name =submit_action class="btn btn-default btn-sm" value="<?=ACTION_RESET?>"><span style="padding: 0px;" class="glyphicon glyphicon-refresh"></span>Reset</button>
                </div>
                -->
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
        {each $items as $val}
        <tr>
            <td><?php echo $i+$data->pageNum*$data->pageSize; ?></td>
            <td><a href="/Ngonngu/listTest/{val[userId]}">{val[username]}</a></td>
            <td>{val[name]}</td>
            <td>{val[mark]}</td>
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
        {/each}
    </table>
<div class="panel-footer ">
        <form class="form-inline" role="form">

            <table style="margin: 0px;">
                <tr>
                    <td style="width: 135px;"> <strong>Số mục: </strong>
                        <select id="pageSize" name="pageSize" class="form-control input-sm" placeholder="Số mục / trang" onchange="window.location='{url /Ngonngu/changePageSize}?pageSize=' + this.value;">
                            <option value="5">5</option>
                            <option value="10">10</option>
                            <option value="20">20</option>
                            <option value="25">25</option>
                        </select>
                        <script type="text/javascript">
                            $('#pageSize').val('{pageSize}');
                        </script>
                    </td>
                    <td>
                        <?php if($pages > 1) { ?>
                            <strong style="display: inline-block; vertical-align: middle;">Trang: </strong>

                            <ul style="margin: 0px; vertical-align: middle;" class="pagination">
                                <?php
                                if($data->pageNum >= 1) { ?>
                                    <li>
                                        <a href="{url} /Ngonngu/rating?page=0" aria-label="End">
                                            <span aria-hidden="true">Trang đầu</span>
                                        </a>
                                    <li>
                                        <a aria-label="Previous" href="{url} /Ngonngu/rating?page=<?php echo $data->pageNum -1; ?>">
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
                                    <li class="{active}">
                                        <a  href="{url} /Ngonngu/rating?page={page}">{? echo ($page + 1)?}</a>
                                    </li>
                                <?php } ?>

                                <?php if($data->pageNum < $pages-1) { ?>
                                    <li>
                                        <a href="{url} /Ngonngu/rating?page=<?php echo $data->pageNum + 1; ?>" aria-label="Next">
                                            <span aria-hidden="true">&raquo;</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="{url} /Ngonngu/rating?page=<?php echo $pages-1; ?>" aria-label="end">
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

