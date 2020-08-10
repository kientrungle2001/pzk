<?php
$testId = $data->parentId;
?>

<div class="well">
    <div class="row">
        <div class="form-group col-xs-2">
            <label for="keyword">Tên câu hỏi or id</label><br>
            <input  onfocus="clearText(this)" onblur="clearText(this)" class="form-control input-sm" type="text" name="keyword" id="sques"  placeholder="Câu hỏi" value="<?php echo $keyword ?>" />
        </div>
        <input type="hidden" name="testId" value="<?php echo $testId ?>"/>

        <div class="form-group col-xs-1">
            <label>&nbsp;</label> <br>
            <button id="findQuestions" type="button" name ="submit_action" class="btn btn-primary btn-sm" ><span class="glyphicon glyphicon-search"></span> Tìm câu hỏi</button>
        </div>

    </div>
</div>

<div id="resultQuestion">

</div>

<script>
    $('#findQuestions').click(function() {
        var namequestion = $('#sques').val();
        if(namequestion) {
            $.ajax({
                type: "POST",
                url: "<?php echo BASE_REQUEST ?>/admin_test/resultQuestion/<?php echo $testId ?>",
                data:{namequestion:namequestion},
                success: function(data) {
                    $('#resultQuestion').html(data)
                }
            });
        }

    });
</script>
<?php
$testQuestionOrderBy = pzk_session()->getTestQuestionOrderBy();
if($testQuestionOrderBy) {
    $data->orderBy = $testQuestionOrderBy;
}

$keyword = pzk_session()->getDetailTestKeyword();
$sttt = 1;
$pageSize = 100;
if($pageSize) {
    $data->pageSize = $pageSize;
}

$data->pageNum = pzk_request()->getPage();

$items = $data->getItems($keyword, array('id', 'name'));
$countItems = $data->getCountItems($keyword, array('id', 'name'));
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




?>

<div class="well">
    <form role="search" action="<?php echo BASE_REQUEST . '/admin_test/searchPost' ?>">
        <div class="row">
            <div class="form-group col-xs-2">
                <label for="keyword">Tên câu hỏi or id</label><br>
                <input class="form-control input-sm" type="text" name="keyword" id="keyword"  placeholder="Câu hỏi" value="<?php echo $keyword ?>" />
            </div>
            <input type="hidden" name="testId" value="<?php echo $testId ?>"/>

            <div class="form-group col-xs-2">
                <label>Sắp xếp</label><br>
                <select id="orderBy" name="orderBy" class="form-control" placeholder="Sắp xếp theo" onchange="window.location='<?php echo BASE_REQUEST . '/admin' ?>_test/changeOrderBy?testId=<?php echo $testId ?>&orderBy=' + this.value;">
                    <option value="id asc">ID tăng</option>
                    <option value="id desc">ID giảm</option>
                    <option value="ordering asc">Ordering tăng</option>
                    <option value="ordering desc">Ordering giảm</option>

                </select>
                <script type="text/javascript">
                    $('#orderBy').val('<?php echo $testQuestionOrderBy ?>');
                </script>
            </div>

            <div class="form-group col-xs-1">
                <label>&nbsp;</label> <br>
                <button type="submit" name ="submit_action" class="btn btn-primary btn-sm" value="<?=ACTION_SEARCH?>"><span class="glyphicon glyphicon-search"></span> Search</button>
            </div>
            <div class="form-group col-xs-1">
                <label>&nbsp;</label> <br>
                <button type="submit" name =submit_action class="btn btn-default btn-sm" value="<?=ACTION_RESET?>"><span class="glyphicon glyphicon-refresh"></span>Reset</button>
            </div>
        </div>
    </form>
</div>

<div class="panel panel-default">
    <div class="panel-heading">
        Danh sách câu hỏi(<strong><?php echo $countItems; ?> câu</strong>)
        <div style="margin-top: -6px;" class="col-xs-2 pull-right">
            <select id="printTest" name="printTest" class="form-control" placeholder="print" onchange="window.location='<?php echo BASE_REQUEST . '/admin' ?>_test/print?testId=<?php echo $testId ?>&orderBy=' + this.value;">
                <option value="0">Chọn in</option>
                <option value="1">ID tăng</option>
                <option value="2">Ordering tăng</option>
            </select>
        </div>
    </div>
    <table class="table">
        <tr>
            <th><input type="checkbox" id="selectall"/></th>
            <th>Stt</th>
            <th>#</th>
            <th>
                Ordering
                <span class="glyphicon glyphicon-floppy-disk" style="cursor: pointer;" onclick="saveOrdering('ordering');"></span>
            </th>
            <th>Tên</th>
            <th>Dạng bài tập</th>
            <th>Status</th>

            <th colspan="2">Action</th>
        </tr>
        <?php foreach($items as $item): ?>
        <?php
        $catNames = getCategoriesName($item, $cats);

        $answer = _db()->useCB()->select('*')->from('answers_question_tn')->where(array('question_id', $item['id']))->result();
        ?>

        <!-- Modal -->
        <div class="modal fade" id="testModal<?php echo $item['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
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
            <td><input name="ordering[<?php echo @$item['id']?>]" rel="<?php echo @$item['id']?>" value="<?php echo @$item['ordering']?>" style="width: 20px" /></td>
            <td><a href="<?php echo BASE_REQUEST . '/admin_questions/detail' ?>/<?php echo @$item['id']?>"> <?php if($item['name'] !='') echo substr(strip_tags($item['name']), 0, 30);?>...</a></td>
            <td><?php echo $catNames ?></td>
            <td>
                <span class="glyphicon glyphicon-star" onclick="window.location='<?php echo BASE_REQUEST . '/admin' ?>_test/onchangeStatusTest?testId=<?php echo $testId ?>&field=status&id=<?php echo @$item['id']?>'" <?php if($item['status'] == QUESTION_ENABLE):?>style="color: blue; font-size: 100%; cursor: pointer;" <?php else:?> style="color: black; font-size: 100%; cursor: pointer;" <?php endif;?>></span>
            </td>
            <td width="12%">
                <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#testModal<?php echo $item['id']; ?>">
                    Chi tiết
                </button>
                <a href="<?php echo BASE_REQUEST . '/admin_questions/edit' ?>/<?php echo @$item['id']?>"  class="text-center" title="Sửa"><span class="glyphicon glyphicon-edit"></span></a>
                <button rel="<?php echo @$item['testId']?>" type="button" class="color_delete text-center" onclick="delTest(this, <?php echo @$item['id']?>);" title="Xóa"><span class="glyphicon glyphicon-remove"></span></button>
            </td>
        </tr>
        <?php $sttt++; ?>
        <?php endforeach; ?>
    </table>
</div>


<div class="clearfix pull-right">

    <form class="form-inline" role="form">

        <strong>Trang: </strong>
        <?php
        for ($page = 0; $page < $pages; $page++):?>
            <?php
            if($page == $data->pageNum) {
                $btn = 'btn-primary';
            } else {
                $btn = 'btn-default';
            }
            ?>
            <a class="btn <?php echo $btn ?>" href="<?php echo BASE_REQUEST . '/admin_test/detail/' ?><?php echo $testId ?>?page=<?php echo $page ?>"><?php  echo ($page + 1)?></a>
        <?php endfor; ?>
    </form>

</div>

<script>
    $(document).ready(function() {
        $('#selectall').click(function(event) {
            if(this.checked) {
                $('.checkIds').each(function() {
                    this.checked = true;
                });
            }else{
                $('.checkIds').each(function() {
                    this.checked = false;
                });
            }
        });

    });

    function delTest(that, questionId) {
        var r = confirm("Bạn có muốn xóa câu hỏi khỏi đề không?");
        if (r == true) {
            var testIds = $(that).attr('rel');
            var testId = <?php echo $testId; ?>;
            $.ajax({
                type: "POST",
                url: "<?php echo BASE_REQUEST ?>/admin_test/delTest",
                data:{questionId:questionId, testIds:testIds, testId:testId},
                success: function(data) {
                    if(data ==1){
                        window.location.reload();
                    }
                }
            });
        }
    }

    function saveOrdering(field) {
        var inputs = $('input[name^='+field+']');
        var orderings = {};
        $.each(inputs, function(index, input) {
            var val = $(input).val();
            var id = $(input).attr('rel');
            orderings[id] = val;
        });
        $.ajax({
            url: "<?php echo BASE_REQUEST ?>/admin_test/saveDetailOrderings",
            type: 'post',
            data: {orderings: orderings, field: field},
            success: function() {
                window.location.reload();
            }
        });
    }
</script>