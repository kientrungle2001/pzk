{children [position=public-header]}
{children [position=top-menu]}

<div>
    <h2 class="text-center robotofont">Danh sách các bài thi</h2>
</div>

<?php $practice = pzk_request('practice');?>

<div class="container">

<a href="/Home/rating?practice={practice}" class="btn btn-primary">Quay lại <span class="glyphicon glyphicon-arrow-left"></span></a>

<?php

$UserId = pzk_or(pzk_request()->getSegment(3), pzk_session()->get('userId'));
$pageSize = 25;
$data->pageSize = $pageSize;

$page = pzk_request('page');
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
            <th>Tuần</th>
            <th>Đề</th>
            <th>Điểm</th>
            <th>Thời gian làm bài</th>
            <th>Ngày</th>
        </tr>
        {each $items as $val}
        <tr>
            <td><?php echo $i+$data->pageNum * $pageSize; ?></td>
            <td>{val[username]}</td>
            <td>{val[cateName]}</td>
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

                    <td>
                        <?php if($pages > 1) { ?>
                            <strong style="display: inline-block; vertical-align: middle;">Trang: </strong>

                            <ul style="margin: 0px; vertical-align: middle;" class="pagination">
                                <?php
                                if($data->pageNum >= 1) { ?>
                                    <li>
                                        <a href="{url} /Ngonngu/listTest/{UserId}?practice={practice}&page=0" aria-label="End">
                                            <span aria-hidden="true">Trang đầu</span>
                                        </a>
                                    <li>
                                        <a aria-label="Previous" href="{url} /Ngonngu/listTest/{UserId}?practice={practice}&page=<?php echo $data->pageNum -1; ?>">
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
                                        <a  href="{url} /home/listTest/{UserId}?practice={practice}&page={page}">{? echo ($page + 1)?}</a>
                                    </li>
                                <?php } ?>

                                <?php if($data->pageNum < $pages-1) { ?>
                                <li>
                                    <a href="{url} /home/listTest/{UserId}?practice={practice}&page=<?php echo $data->pageNum + 1; ?>" aria-label="Next">
                                        <span aria-hidden="true">&raquo;</span>
                                    </a>
                                    </li>
                                    <li>
                                    <a href="{url} /home/listTest/{UserId}?practice={practice}&page=<?php echo $pages-1; ?>" aria-label="end">
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