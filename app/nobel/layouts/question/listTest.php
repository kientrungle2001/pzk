<style>
    #left {
        background-image: url('/default/skin/test/media/bg_test_page.png');
        background-size: 99.5%;
        background-repeat: no-repeat;
        min-height: 1350px;
        margin-top: 3px;
    }
</style>
<div style="float: left; margin-bottom:-4px; margin-top:20px; margin-left:1.5%; border: 4px solid #017F3F; border-radius: 20px; background: white; padding: 4px 25px;">
    <h2 style="text-transform: uppercase; font-family: 'utmc';color: #2e3092; text-align: center; font-weight: bold; font-size: 18px; margin: 4px 0px 10px 0px;">Danh sách các bài thi</h2>
</div>
<div style="border: 4px solid #017F3F; float: left; width: 94%; margin: 0px 3%;" class="panel panel-default">

<?php
$UserId = pzk_or(pzk_request()->getSegment(3), pzk_session()->getUserId());
$pageSize = pzk_session('listPageSize');

if($pageSize) {
    $data->pageSize = $pageSize;
}else {
    $data->pageSize = 20;
}

$page = pzk_request()->getPage();
if(!empty($page)) {
    $data->pageNum = $page;
}else{
    $data->pageNum = 0;
}

$items = $data->getTestByUserId($UserId);

$countItems = $data->countTestByUserId($UserId);

$pages = ceil($countItems / $data->pageSize);
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
        {each $items as $val}
        <tr>
            <td><?php echo $i+$data->pageNum*$data->pageSize; ?></td>
            <td>{val[username]}</td>
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
                        <select id="pageSize" name="pageSize" class="form-control input-sm" placeholder="Số mục / trang" onchange="window.location='{url} /Ngonngu/changePageSize?userId={UserId}&pageSize=' + this.value;">
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
                                        <a href="{url} /Ngonngu/listTest/{UserId}?page=0" aria-label="End">
                                            <span aria-hidden="true">Trang đầu</span>
                                        </a>
                                    <li>
                                        <a aria-label="Previous" href="{url} /Ngonngu/listTest/{UserId}?page=<?php echo $data->pageNum -1; ?>">
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
                                        <a  href="{url} /Ngonngu/listTest/{UserId}?page={page}">{? echo ($page + 1)?}</a>
                                    </li>
                                <?php } ?>

                                <?php if($data->pageNum < $pages-1) { ?>
                                <li>
                                    <a href="{url} /Ngonngu/listTest/{UserId}?page=<?php echo $data->pageNum + 1; ?>" aria-label="Next">
                                        <span aria-hidden="true">&raquo;</span>
                                    </a>
                                    </li>
                                    <li>
                                    <a href="{url} /Ngonngu/listTest/{UserId}?page=<?php echo $pages-1; ?>" aria-label="end">
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