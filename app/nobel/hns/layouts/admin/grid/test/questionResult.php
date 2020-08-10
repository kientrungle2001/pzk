<?php
$testId = $data->parentId;
$data->setConditions(array('and', $data->getConditions(), array('notlike', 'testId', "%,$testId,%") ));
$keyword = pzk_request()->getNamequestion();
$sttt = 1;
$pageSize = 30;
if($pageSize) {
    $data->pageSize = $pageSize;
}

$data->pageNum = 0;

$items = $data->getItems($keyword, array('name', 'id'));
$countItems = $data->getCountItems($keyword, array('name', 'id'));
$pages = ceil($countItems / $data->pageSize);

$categories = _db()->select('*')->from('categories')->result();


$cats = array();
foreach($categories as $cat) {
    $cats[$cat['id']] = $cat;
}



function getCategoriesName($item, $categories) {
    $rs = array();
    $catIds = explode(',', $item['categoryIds']);

    foreach($catIds as $catId) {
        if($catId) {
            if(isset($categories[$catId]['name'])) {
                $rs[] = $categories[$catId]['name'];

            }
        }
    }
    return implode(', ', $rs);
}


if($items) {

?>


<div class="panel panel-default">
    <div class="panel-heading">
        Danh sách câu hỏi
    </div>
    <table class="table">
        <tr>
            <th><input type="checkbox" id="selectall"/></th>
            <th>Stt</th>
            <th>#</th>

            <th>Tên</th>
            <th>Dạng bài tập</th>

            <th colspan="2">Action</th>
        </tr>
        <?php foreach($items as $item): ?>
        <?php
        $catNames = getCategoriesName($item, $cats);
        $answer = _db()->useCB()->select('*')->from('answers_question_tn')->where(array('question_id', $item['id']))->result();
        ?>

        <!-- Modal -->
        <div class="modal fade" id="myModal<?php echo $item['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="myModalLabel">Chi tiết câu hỏi</h4>
                    </div>
                    <div class="modal-body">
                        <strong>Câu hỏi: <?php echo getLatex(strip_tags($item['name'])); ?></br></strong>
                        <?php
                            $i = 1;
                            $recomend = false;
                            foreach($answer as $val) {

                                switch ($i) {
                                    case 1:
                                        $stt = 'A';
                                        break;
                                    case 2:
                                        $stt = 'B';
                                        break;
                                    case 3:
                                        $stt = 'C';
                                        break;
                                    case 4:
                                        $stt = 'D';
                                        break;
                                    case 5:
                                        $stt = 'E';
                                        break;
                                    case 6:
                                        $stt = 'F';
                                        break;
                                    case 7:
                                        $stt = 'G';
                                        break;
                                    default:
                                        $stt = '';
                                }

                                if($val['status'] == 1) {
                                    $dapan = '<strong>'.'Đáp án là '. $stt.'. '.getLatex(strip_tags($val['content'], '<img>')).'</strong>'.'</br>';
                                    $recomend = getLatex($val['recommend']);
                                }
                                echo $stt.'. '.getLatex(strip_tags($val['content'], '<img>')).'</br>';
                                $i++;
                            }
                            echo $dapan.'<br>';
                            if($recomend) {
                                echo $recomend;
                            }
                        ?>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>

        <tr>
            <td><input class="checkIds" type="checkbox" name="checkIds[]" value="<?php echo @$item['id']?>"></td>
            <td><?php echo ($sttt +  $pageSize * $data->pageNum);?></td>
            <td><?php echo @$item['id']?></td>

            <td><a href="<?php echo BASE_REQUEST . '/admin_questions/detail' ?>/<?php echo @$item['id']?>"> <?php if($item['name'] !='') echo strip_tags($item['name']);?></a></td>
            <td><?php echo $catNames ?></td>

            <td width="12%">
                <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#myModal<?php echo $item['id']; ?>">
                    Chi tiết
                </button>
                <a href="<?php echo BASE_REQUEST . '/admin_questions/edit' ?>/<?php echo @$item['id']?>"  class="text-center" title="Sửa"><span class="glyphicon glyphicon-edit"></span></a>
                <button rel="<?php echo @$item['testId']?>" type="button" class="btn-primary text-center" onclick="addTest(this, <?php echo @$item['id']?>);" title="Xóa"><span class="glyphicon glyphicon-plus"></span></button>
            </td>
        </tr>
        <?php $sttt++; ?>
        <?php endforeach; ?>
    </table>
</div>
<?php } else { ?>
<div class="panel-heading">
    Câu hỏi không tồn tại
</div>
<?php } ?>

<script>

    function addTest(that, questionId) {
        var r = confirm("Bạn có muốn thêm câu hỏi này vào đề không?");
        if (r == true) {
            var testIds = $(that).attr('rel');
            var testId = <?php echo $testId; ?>;
            $.ajax({
                type: "POST",
                url: "<?php echo BASE_REQUEST ?>/admin_test/addTest",
                data:{questionId:questionId, testIds:testIds, testId:testId},
                success: function(data) {
                    if(data ==1){
                        window.location.reload();
                    }
                }
            });
        }
    }
</script>

