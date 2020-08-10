<link rel="stylesheet" href="/default/skin/nobel/ptnn/css/question/fill.css">
<?php
    $parent_id = pzk_request()->getSegment(3);
if(pzk_request()->is('POST') && is_numeric($parent_id)) {
    $request = pzk_request()->query;
    $ids = $request['id_category'];
    if(isset($request['categoryId2'])) {
        $ids = $request['categoryId2'].','.$ids;
    }
    if(isset($request['subject'])) {
        $topic = $request['subject'];
    } else {
        $topic = false;
    }
    if(isset($request['make'])) {
        $make = $request['make'];
    } else {
        $make = false;
    }
    $items = $data->getQuestionByIds($ids, $topic, $request['level'], $request['number'], $make);
?>
    <div class="item bg_section">
<?php if(count($items) > 0) { ?>
    <div   class="well well-sm">
    <form id="dm" class="form-inline"  action="/category/answer" method="post">


        <input type="hidden" name="time" value="<?php echo $request['time']; ?>"/>
        <div class="row">
            <div class="col-md-6">
                <label for="">Dạng bài </label>
                <?php
                echo $data->getNameById($parent_id, 'categories', 'name');
                ?>
                <input type="hidden" name="parent_id" value="<?Php echo $parent_id; ?>"/>
            </div>
            <?php if(!empty($request['subject'])) { ?>
                <div class="col-md-6">
                    <label for="">Chủ đề</label>
                    <?php
                    echo $data->getNameById($request['subject'], 'topics', 'name');
                    ?>
                    <input type="hidden" name="subject" value="<?php echo $topic; ?>"/>
                </div>
            <?php } ?>
        </div>

        <table class="tb_lesson table-bordered">
            <thead>
            <tr>
                <th>Số câu</th>
                <th>Thời gian làm bài</th>
                <th>Mức độ</th>
                <th>Thời gian bắt đầu làm</th>

            </tr>
            <tr>
                <th>
                    <?php echo $request['number']; ?>
                    <input type="hidden" name="number" value="<?php echo $request['number']; ?>"/>
                </th>
                <th>
                     <div class="ms_timer"></div>
                     <div class="stop_timer"></div>
                    <input class="input_time" type="hidden" name="stop_timer"/>
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
                    <input type="hidden" name="level" value="<?php echo $request['level']; ?>"/>
                </th>
                <th>

                    <?php echo date('H:i:s', $_SERVER['REQUEST_TIME']); ?>
                    <input type="hidden" name="start_time" value="<?php echo $_SERVER['REQUEST_TIME']; ?>"/>
                </th>
            </tr>
            </thead>
        </table>
    </div>

    <!--dang phat trien chu diem-->
        <div class="w_question item"   id="ctg_question_fill">
        <?php $i = 1;  ?>
            <?php foreach($items as $item): ?>
            <?php if($item['type'] == 'Q2' or $item['type'] == 'Q22') { ?>
            <div class="question item">
                <div class="step">
                   <p class="item"><strong > Câu <?php echo $i ?>:</strong></p>
                    <p class="item"><i >
                        <strong><?php echo @$item['request']?></strong>
                    </i></p>
                    <div class="item"><?php echo @$item['name']?></div>
                </div>
                <div class="step" >
                    <div style="clear:both;"><span><strong>Đáp án:</strong></span></div>

                    <div class="col-xs-3" style="position:relative; margin-top: 20px; " >
                        <div class="input-group" >
                            <input type="text" name="answers[<?=$item['id'];?>][]" class="form-control content_value"/>
                        </div>
                        <div class="remove-input" ><a href="javascript:void(0)" class="color_delete" title="Xóa"><span class="glyphicon glyphicon-remove-circle"></span></a></div>
                    </div>
                    <div class="add_row_answer">
                        <div class="itemAnswer_<?=$item['id'];?>"  ></div>
                    </div>
                    <div class="btt_add_answer"><button title="Thêm đáp án" type="button" class="btn btn-primary add-sub-input-test" onclick="addInputRow(<?=$item['id'];?>)" style="margin-left: 15px;"><span class="glyphicon glyphicon-plus-sign"></span></button></div>
                </div>
                <div id="review_<?php echo $item['id']; ?>" class="step review">

                </div>
            </div>
            <?php } elseif($item['type'] == 'Q21' or $item['type'] == 'Q29' or $item['type'] == 'Q26' or $item['type'] == 'Q27' ) { ?>
        <div class="question item">
                <div class="step">
                    <p class="item"><strong > Câu <?php echo $i ?>:</strong></p>
                    <p class="item"><i >
                            <strong><?php echo @$item['request']?></strong>
                        </i></p>
                    <div class="item"><?php echo @$item['name']?></div>
                </div>
                <div class="step" >
                    <div style="clear:both;"><span><strong>Đáp án:</strong></span></div>

                    <div class="col-xs-8" style="position:relative; margin-top: 20px; " >
                        <textarea style="height: 140px;" class="item" name="answers[<?=$item['id'];?>][]"> </textarea>
                    </div>

                </div>
                <div id="review_<?php echo $item['id']; ?>" class="step review">

                </div>
        </div>
            <?php } elseif($item['type'] == 'Q0') { ?>
            <div class="question item">
                <div class="step">
                    <p class="item"><strong > Câu <?php echo $i ?>:</strong></p>
                    <div class="item"><?php echo @$item['name']?></div>
                </div>
                <div class="step" >
                    <div style="clear:both;"><span><strong>Đáp án:</strong></span></div>

                        <?php
                        $answers = _db()->useCB()->select('*')->from('answers_question_tn')->where(array('question_id', $item['id']))->result();
                        ?>
                        <table>
                            <tr >
                        <?php foreach($answers as $val): ?>
                            <td><input style="width: 15px; height: 15px;" name="answers[<?=$item['id'];?>][]" value="<?php echo @$val['id']?>" type="radio" /></td>
                            <td id="answers_<?php echo $val['id']; ?>"><?php echo @$val['content']?></td>
                        <?php endforeach; ?>
                            </tr>
                        </table>
                </div>
            </div>
            <?php } ?>
        <?php $i++; ?>
            <?php endforeach; ?>

        </div>


    <script>
        function addInputRow(key){

            var div = document.createElement('div');

            div.className = 'col-xs-3 element-input';

            div.innerHTML = '<div class="input-group" style="margin-bottom: 10px;" >\
	    					<input type="text" name="answers['+key+'][]" class="form-control content_value"/>\
	        			</div>\
	        			<div class="remove-input"  style="margin-bottom: 10px;" ><a href="javascript:void(0)" class="color_delete" title="Xóa"><span class="glyphicon glyphicon-remove-circle"></span></a></div>';

            $('.itemAnswer_'+key).append(div);
        }

        $("#ctg_question_fill").on("click", '.remove-input', function(e){
            $(this).parent().remove();
        });
    </script>

        <div class="item box_button">
            <button type="button" onclick="hoanthanh();" name="done" id="answer" class="group_button section_cate">
                <span class="glyphicon glyphicon glyphicon-saved" aria-hidden="true"></span> Hoàn thành
            </button>
            <button type="button" onclick="save();" name="done" id="bt-save" class="group_button section_cate">
                <span class="glyphicon glyphicon glyphicon-save" aria-hidden="true"></span> Lưu vào vở bài tập
            </button>
            <button disabled type="button" onclick="see();" name="done" id="bt-see" class="group_button section_cate">
                <span class="glyphicon glyphicon glyphicon-eye-open" aria-hidden="true"></span> Xem đáp án
            </button>
            <button type="button" disabled onclick="check();" name="done" id="send" class="group_button section_cate">
                <span class="glyphicon glyphicon glyphicon-send" aria-hidden="true"></span> Yêu cầu chấm
            </button>
        </div>
    </form>
    
    <div class="item bg_footer">
        <?php $data->displayChildren('all') ?>
    </div>

        <?php
        foreach($items as $val) {
            $ids .= ','.$val['id'];
        }
        ?>
        <script>
            formdata = false;
            var book_id = false;
            var checksave = false;

            function see() {
                $('#bt-see').prop( "disabled", true );
                var check = $('#bt-save').is(':disabled');
                if(check && checksave == true) {
                    var ids = "<?php echo $ids ?>";
                    $.ajax({
                        type: "POST",
                        url: '/category/seeAnswer',
                        data: {ids:ids},
                        success: function(data) {
                            var data = $.parseJSON(data);
                            $.each(data, function(i, item) {
                                var type = item.type;
                                if(type == 'Q2' || type == 'Q21' || type == 'Q29' || type == 'Q22' || type == '26'){
                                    if(item.value) {
                                        $('#review_'+item.questionId).css('background-color', '#5cb85c');
                                        $('#review_'+item.questionId).html(item.value);
                                    }
                                } else if (type == 'Q0') {
                                    $('#answers_'+item.value).css('background-color', '#5cb85c');
                                }
                            });
                        }
                    });
                }
            }
            function hoanthanh() {
                endtime = "<?php echo $_SERVER['REQUEST_TIME']; ?>";
                var time = $(".ms_timer").text();
                if(time) {
                    $('.stop_timer').text(time);
                    $('.input_time').val(time);
                }
                $('.ms_timer').remove();
                $('.remove-input').hide();
                $('.btt_add_answer').hide();
                 formdata = $('#dm').serializeForm();

                $('input[type=text]').prop( "disabled", true );
                $('input[type=radio]').prop( "disabled", true );
                $('textarea').prop( "disabled", true );
                $('#answer').prop( "disabled", true );
                return formdata;

            }
            function save() {
                if(formdata == false) {
                    formdata = hoanthanh();
                }
                $('#bt-save').prop( "disabled", true );
                $.ajax({
                    type: "POST",
                    url: '/category/ajax',
                    data:{
                        answers: formdata,
                        key:'<?php echo pzk_session("keyBook") ?>'
                    },
                    success: function(response) {
                        $('#send').prop( "disabled", false );
                        $('#bt-see').prop( "disabled", false );
                        checksave = true;
                        book_id = response;

                    }
                });
            }
            function check() {
                var check = $('#bt-save').is(':disabled');
                if(check && checksave == true) {
                    $('#send').prop( "disabled", true );
                    var bookid = book_id;
                    $.ajax({
                        type: "POST",
                        url: '/category/mark',
                        data: {bookid:bookid},
                        success: function(response) {
                            alert('Yêu cầu của bạn đã được gửi');

                        }
                    });
                }else {
                    alert('Hãy lưu bài của bạn vào vở bài tập');
                }
            }
            $(function(){
                $('.ms_timer').countdowntimer({
                    hours : 0,
                    minutes :<?php echo $request['time']; ?>,
                    seconds : 0,
                    size : "lg",
                    timeUp : timeisUp
                });
                function timeisUp() {
                    hoanthanh();
                }
            });

        </script>

    <?php } else { ?>
        Chưa có câu hỏi
    <?php } ?>
<?php } ?>

    </div>