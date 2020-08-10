<?php
if(pzk_request()->is('POST')) {
    $request = pzk_request()->query;
    $items = $request['answers'];
    $total = 0;
    foreach($items as $key => $value){
        $answerId = $value[0];
        $answers = _db()->useCB()->select('*')->from('answers_question_tn')
            ->where(array('and', array('status', 1), array('id', $answerId)) )->result();
        if(count($answers)>0) {
            $total++;
        }
    }
    ?>

    <form action="/category/success" method="post">

        <div class="col-md-6">
            <label for="">Chọn dạng</label>
            <?php
            echo $data->getNameById($request['parent_id'], 'categories', 'name');
            ?>
            <input type="hidden" name="parent_id" value="<?Php echo $request['parent_id']; ?>"/>
        </div>
        <?php if(!empty($request['subject'])) { ?>
            <div class="col-md-6">
                <label for="">Chủ đề</label>
                <?php
                echo $data->getNameById($request['subject'], 'categories', 'name');
                //echo $name['name'];
                ?>
                <input type="hidden" name="subject" value="<?php echo $request['subject']; ?>"/>
            </div>
        <?php } ?>

        <br>

        <table class="tb_question" border="1px" cellpadding="0" cellspacing="0">
            <thead>
            <tr>
                <th>Số câu</th>
                <th>Thời gian còn lại</th>
                <th>Mức độ</th>
                <th>Số đáp án đúng</th>
                <th>Giờ làm bài</th>
                <th>Giờ nộp bài</th>
                <input type="hidden" name="start_time" value="<?php echo $request['start_time']; ?>"/>
                <input type="hidden" name="end_time" value="<?php echo $request['end_time']; ?>"/>
                <input type="hidden" name="total" value="<?php echo count($items); ?>"/>
                <input type="hidden" name="total_true" value="<?php echo $total; ?>"/>
            </tr>
            <tr>
                <th>
                    <?php echo $request['number']; ?>
                    <input type="hidden" name="number" value="<?Php echo $request['number']; ?>"/>
                </th>
                <th>
                    <div id="ms_timer"><?php if($request['mi']){ echo $request['mi']; } ?> : <?php if($request['se']) { echo $request['se']; } ?></div>
                    <input id="mi" name="mi" type="hidden" value="<?php echo $request['mi']; ?>"/>
                    <input id="se" name="se" type="hidden" value="<?php echo $request['se']; ?>"/>


                </th>
                <th>
                    <?php
                    switch ($request['level']) {
                        case 1:
                            echo "Dễ";
                            break;
                        case 2:
                            echo "Bình thường";
                            break;
                        case 3:
                            echo "Khó";
                            break;
                    }
                    ?>
                    <input type="hidden" name="level" value="<?Php echo $request['level']; ?>"/>
                </th>
                <th><?php echo $total.'/'.count($items); ?></th>
                <th><?php echo $request['start_time']; ?></th>
                <th><?php echo $request['end_time']; ?></th>
            </tr>
            </thead>
        </table>

        <table class="table">
            <?php $i = 1; ?>


            <?php foreach($items as $key => $item): ?>
            <?php
            $answers = _db()->useCB()->select('*')->from('answers_question_tn')->where(array('question_id', $key))->result();
            ?>
            <tr>
                <td><?php echo 'Câu '.$i.':'; ?></td>
                <td>
                    <?php
                    echo $data->getNameById($key, 'questions', 'name');
                    ?>
                </td>
            </tr>
            <?php foreach($answers as $val): ?>
            <tr>
                <?php $postAnswer = $item[0]; ?>
                <td>
                    <input style="height: 15px;width: 15px;" disabled="disabled"   <?php if(isset($postAnswer) && $postAnswer == $val['id']){ echo 'checked'; }  ?> type="radio" />
                    <input name="value[<?php echo $key; ?>][]" style="display: none;"  value="<?php echo @$val['id']?>" <?php if(isset($postAnswer) && $postAnswer == $val['id']){ echo 'checked'; }  ?> type="radio" />

                </td>
                <td <?php if($val['status'] == 1) { echo "class='highlinght'";} ?> ><?php echo @$val['content']?></td>
            </tr>
            <?php endforeach; ?>
            <?php $i++; ?>
            <?php endforeach; ?>


        </table>

        <div class="item center">
            <input id="answer" type="submit" name="done" value="Lưu vào vở bài tập">
            <a href="/category/requestion/">Làm lại</a>
        </div>
    </form>
    <script>
        $('#resetquestions').click(function() {

            $.ajax({
                url:"/category/question/24",
                type:"post",
                data:{start:1,des_id:1,orderdes:1},
                async:false,
                success:function (result) {
                    window.location.href = "/category/question/24";
                }
            });
        })
    </script>
    <style>
        .tb_question tr th{
            text-align: center;
        }
        .highlinght{
            background-color: #a8cae6;
        }
    </style>
<?php } ?>