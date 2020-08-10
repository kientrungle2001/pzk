<?php
if(pzk_request()->is('POST')) {
    $request = pzk_request()->query;
    $items = $request['answers'];
    ?>

    <form action="/category/review" method="post">
        <div class="col-md-6">
            <label for="">Dạng</label>
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
                <th>Thời gian</th>
                <th>Mức độ</th>
                <input type="hidden" name="start_time" value="<?php echo $request['start_time']; ?>"/>
                <input type="hidden" name="end_time" value="<?php echo date('H:i:s', $_SERVER['REQUEST_TIME']); ?>"/>
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
                    <input style="width: 15px; height: 15px;" disabled   <?php if(isset($postAnswer) && $postAnswer == $val['id']){ echo 'checked'; }  ?> type="radio" />
                    <input style="display: none;" name="answers[<?=$key;?>][]"  value="<?php echo @$val['id']?>" <?php if(isset($postAnswer) && $postAnswer == $val['id']){ echo 'checked'; }  ?> type="radio" />

                </td>
                <td><?php echo @$val['content']?></td>
            </tr>
            <?php endforeach; ?>
            <?php $i++; ?>
            <?php endforeach; ?>


        </table>

        <div class="item center">
            <input id="answer" type="submit" name="done" value="Xem dap an">
        </div>

    </form>
    <style>
        .tb_question tr th{
            text-align: center;
        }
    </style>
<?php } ?>