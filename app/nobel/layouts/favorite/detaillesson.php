<div id="lesson_history">
    <div class="lesson_favorite_">
        <div class="fvr_title"><span class="glyphicon glyphicon-star"></span><span> Lịch sử học tập</span></div>
        <div class="prf_clear"></div>
        <div style="margin:auto;text-align:center;"><img src="/3rdparty/uploads/img/circle.png" alt="" width="500px" height="30px"></div>
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
                    {each $listlessions as $item}
                    <?php $question = $data->getQuestionById($item['questionId']); ?>
                    <div style="margin: 5px 0px; padding: 10px 0px;" class="question item">
                        <div class="step">
                            <span><strong> Câu {i}:</strong> {question[name]}</span>
                        </div>
                        <div class="step" >

                            <?php
                            $answers = _db()->useCB()->select('*')->from('answers_question_tn')->where(array('question_id', $item['questionId']))->result();
                            ?>
                            <table>
                                {each $answers as $val}
                                <tr >
                                    <td><input style="width: 15px; height: 15px;" <?php if($val['content'] == $item['content']) { echo "checked";} ?> name="answers[<?=$item['id'];?>][]" value="{val[id]}" type="radio" />
                                    {val[content]}</td>
                                </tr>
                                {/each}
                            </table>
                        </div>
                    </div>

                    <?php $i++; ?>
                    {/each}

                </div>


            </div>

        </div>

    </div>
</div>

