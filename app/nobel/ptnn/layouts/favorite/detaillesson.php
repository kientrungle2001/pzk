<div id="lesson_history">
    <div class="lesson_favorite_">
        <div class="fvr_title"><span class="glyphicon glyphicon-star"></span><span> Lịch sử học tập</span></div>
        <div class="prf_clear"></div>
        <div style="margin:auto;text-align:center;"><img src="<?php echo BASE_URL.'/default/skin/test/media/circle.png'; ?>" alt="" width="500px" height="30px"></div>
        <div class="clear" style="padding-bottom:10px;"></div>
        <div class="lesson_favorite_list">
            <div class="list_lesson_favorite">

                <h4>Bài <?php echo pzk_request()->getLesson(); ?></h4>

            </div>
            <div id="add_more_history"></div>
            <div id="show_empty_history" class="show_empty"></div>
            <?php
            $member=pzk_request()->getMember();
            $lessonId = pzk_request()->getLesson();
            $listlessions = $data->detailLesson($lessonId);
            ?>
            <div class="list_lesson_row">

                <div class="w_question item"   id="ctg_question_fill">
                    <?php $i = 1;  ?>
                    <?php foreach($listlessions as $item): ?>
                    <?php $question = $data->getQuestionById($item['questionId']); ?>
                    <?php if($item['question_type'] == 'Q2' or $item['question_type'] == 'Q22') { ?>

                        <div class="step">
                            <span><strong>Yêu Cầu:</strong> <?php echo @$question['request']?></span>

                        </div>
                        <div class="step">
                            <span><strong> Câu <?php echo $i ?>:</strong> <?php echo @$question['name']?></span>
                        </div>
                        <div class="step" >
                            <div style="clear:both;"><span><strong>Đáp án:</strong></span></div>

                            <div class="item">
                                <?php echo $item['content']; ?>
                            </div>

                        </div>


                    <?php } elseif($item['question_type'] == 'Q21' or $item['question_type'] == 'Q29' or $item['question_type'] == 'Q26' ) { ?>
                        <div class="step">
                            <span><strong>Yêu Cầu:</strong> <?php echo @$question['request']?></span>

                        </div>
                        <div class="step">
                            <span><strong> Câu <?php echo $i ?>:</strong> <?php echo @$question['name']?></span>
                        </div>
                        <div class="step" >
                            <div style="clear:both;"><span><strong>Đáp án:</strong></span></div>

                            <div class="item"><?php echo $item['content']; ?></div>

                        </div>

                    <?php } elseif($item['question_type'] == 'Q0') { ?>

                        <div class="step">
                            <span><strong> Câu <?php echo $i ?>:</strong> <?php echo @$question['name']?></span>
                        </div>
                        <div class="step" >
                            <div style="clear:both;"><span><strong>Đáp án:</strong></span></div>

                            <?php
                            $answers = _db()->useCB()->select('*')->from('answers_question_tn')->where(array('question_id', $item['questionId']))->result();
                            ?>
                            <table>
                                <?php foreach($answers as $val): ?>
                                <tr >
                                    <td><input style="width: 15px; height: 15px;" <?php if($val['id'] == $item['content']) { echo "checked";} ?> name="answers[<?=$item['id'];?>][]" value="<?php echo @$val['id']?>" type="radio" /></td>
                                    <td><?php echo @$val['content']?></td>
                                </tr>
                                <?php endforeach; ?>
                            </table>
                        </div>
                    <?php } ?>
                    <?php $i++; ?>
                    <?php endforeach; ?>

                </div>


            </div>

        </div>

    </div>
</div>

