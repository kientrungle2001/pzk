<?php

if(pzk_request()->is('POST')) {
    $request = pzk_request()->query;
    $items = explode(',',$request['questionIds']);
    $total = 0;
    foreach($items as $value){
        $tam = 'value_'.$value;
        if(isset($request[$tam])) {
            $answerId = $request[$tam];
            $answers = _db()->useCB()->select('*')->from('answers')
                ->where(array('and', array('valueTrue', 1), array('id', $answerId)) )->result();
            if(count($answers)>0) {
                $total++;
            }
        }
    }
    echo $total;
    ?>

    <form action="/category/success" method="post">
        <input type="hidden" name="questionIds" value="<?php echo $request['questionIds'];?>"/>
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
                ?>
                <input type="hidden" name="subject" value="<?Php echo $request['subject']; ?>"/>
            </div>
        <?php } ?>

        <br>

        <table class="tb_question" border="1px" cellpadding="0" cellspacing="0">
            <thead>
            <tr>
                <th>Số câu</th>
                <th>Thời gian</th>
                <th>Mức độ</th>
                <th rowspan="2"></th>

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


            {each $items as $item}
            <?php
            $answers = _db()->useCB()->select('*')->from('answers')->where(array('questionId', $item))->result();
            ?>
            <tr>
                <td><?php echo 'Câu '.$i.':'; ?></td>
                <td>
                    <?php
                    echo $data->getNameById($item, 'questions', 'name');
                    ?>
                </td>
            </tr>
            {each $answers as $val}
            <tr>
                <?php $a = "value_".$item; ?>
                <td><input name="value_<?php echo $item; ?>" disabled="disabled"  value="{val[id]}" <?php if(isset($request[$a]) && $request[$a] == $val['id']){ echo 'checked'; }  ?> type="radio" /></td>
                <td <?php if($val['valueTrue'] == 1) { echo "class='highlinght'";} ?> >{val[value]}</td>
            </tr>
            {/each}
            <?php $i++; ?>
            {/each}


        </table>

        <div class="item center">
            <input id="answer" type="submit" name="done" value="Lưu vào vở bài tập">
        </div>
    </form>
    <style>
        .tb_question tr th{
            text-align: center;
        }
        .highlinght{
            background-color: #a8cae6;
        }
    </style>
<?php } ?>