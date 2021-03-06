<link rel="stylesheet" href="/default/skin/test/css/question/choice.css">
<style>
    #left {
        background-image: url('/default/skin/test/media/bg_page_test.png');
        background-size: 99.5%;
        background-repeat: no-repeat;
        min-height: 1350px;
        margin-top: 3px;
    }
</style>
<?php
$category_id = pzk_request()->getSegment(3);
$showQuestions 	= $data->getQuestionByIds($category_id);
if($showQuestions) {
?>

<div class="col-xs-12">
    <div id="boxthank"  class="rows">
        <h4 class="titletrial fontutmc">Cảm ơn bạn đã sử dụng thử sản phẩm mới của chúng tôi!</h4>
        <div id="showtrial">
            <h4 class="text-center title_tb">Thông báo</h4>
            <div style="padding: 0px 10px;">
                <h4>Kết quả làm thử bài tập của bạn</h4>
                <h4>Số điểm: <span id="result_mark" style="color: red;" > </span></h4>
                <h4>Thời gian: <span style="color: red;"><span type="hidden" name="hour" id="hour"/>00</span>:<span type="hidden" name="min" id="min"/>00</span>:<span type="hidden" name="sec" id="sec"/></span></span> </h4>
                <h4>Hãy click vào nút mua sản phẩm để ủng hộ Next Nobels</h4>
                <button style="float: left; margin-right: 10px;padding: 5px 20px;" type="button" class="btn btn-success" onclick="location.reload()"><span class="glyphicon glyphicon-repeat"></span> Làm lại</button>
                <a class="bt-buy" href="/payment/bank">Mua sản phẩm</a><a class="bt-home" href="/">Về trang chủ</a>
            </div>
        </div>
    </div>
    <h2 class="fontutmc" style="color: #2e3092; font-weight: bold; font-size: 32px;">Trắc nghiệm dùng thử sản phẩm</h2>
    <form id="form_question_nn" class="item pd-0 question_content form-horizontal" action="" method="post">
        <fieldset id="idFieldset">  <!-- disabled="1"  -->
            <input type="hidden" value="<?php echo $category_id; ?>" name="category_id"/>
            <input type="hidden" value="<?=$_SERVER['REQUEST_TIME']?>" name="start_time"/>

            <div class="col-xs-12 margin-top-20">

                <?php
                $i	= 1;
                $page	= 1;
                $numpage	= numPage(count($showQuestions));
                ?>

                <?php foreach($showQuestions as $key =>$value):?>

                <div class=" step_ answer_box question_page_<?php echo $page?>">
                    <?php $i++; $page=ceil($i/3);?>

                    <div class="order">Câu : <?=$key+1;?></div>

                    <input type="hidden" name="questions[<?=$value['id']?>]" value="<?=$value['id']?>"/>
                    <input type="hidden" name="questionType[<?=$value['id']?>]" value="<?=questionTypeOjb($value['questionType'])?>"/>
                    <?php
                    $QuestionObj = pzk_obj('education.question.type.'.questionTypeOjb($value['questionType']));
                    $QuestionObj->setQuestionId($value['id']);
                    $QuestionObj->display();
                    ?>
                </div>
                <?php endforeach;?>

            </div>

        </fieldset>
        <?php if(count($showQuestions) > 3) { ?>
        <div class="col-xs-12">
            <button type="button" onclick="Back()" class="btn btn-default"><span class="glyphicon glyphicon-backward"></span> Quay lại</button>
            <button type="button" onclick="Next()" class="btn btn-default"><span class="glyphicon glyphicon-forward"></span> Tiếp </button>
        </div>
        <?php } ?>
        <div class="practice-result">
            <button id="finish-choice" class="btn practice-finish" name="finish-choice" onclick="finish_choice();" type="button">
                <span class="glyphicon glyphicon glyphicon-saved" aria-hidden="true"></span> Hoàn thành
            </button>
            <button id="show-answers" class="btn practice-view-result" name="show-answers" onclick="show_answers();" type="button">
                <span class="glyphicon glyphicon glyphicon-eye-open" aria-hidden="true"></span> Xem đáp án
            </button>
        </div>
    </form>
    <script>

        $(document).ready(function() {
            $('#closebg').click(function() {
                alert(1);
            });
        });

        var formdata;

        function finish_choice(){
            clearInterval(intervalId);
            $('#end_time').val('<?=date('H:i:s', $_SERVER['REQUEST_TIME'])?>');
            formdata = $('#form_question_nn').serializeForm();
            $('#idFieldset').prop( "disabled", true );
            $('#finish-choice').prop( "disabled", true );
            return formdata;
        }

        function show_answers(){

            if(formdata	==	null){
                alert('Click hoàn thành để xem đáp án !');
            }else{
                $.ajax({
                    type: "Post",
                    data:{
                        answers:formdata
                    },
                    url:BASE_REQUEST+'/Ngonngu/showAnswersChoice',
                    success: function(results){
                        var data = $.parseJSON(results);
                        var input_value_fill = '';
                        
                        $.each(data, function(i, item) {
                            $('.answers_'+item.questionId+'_'+item.value).css('color', '#5cb85c');
                            $('.answers_'+item.questionId+'_'+item.value).append('<span class="has-success glyphicon glyphicon-ok"></span>');

                            if(item.superType =='fill' || item.superType =='join' ){
                                $('.answers_full_'+item.questionId).css('color', '#3e9e00');

                                input_value_fill =  $('input[name^= "answers['+item.questionId+']"]').val();
                                if(input_value_fill == item.value_fill){
                                    $('.answers_full_'+item.questionId).append('<span class="has-success glyphicon glyphicon-ok"></span>');
                                }else{
                                    $('.remove-input_'+item.questionId).append('<span class="title-red glyphicon glyphicon-remove"></span>');
                                    $('.answers_full_'+item.questionId).append('<span class="has-success"><b>'+item.value_fill+'<b></span>');
                                }
                            }
                        });
                        $('#result_mark').text(data.total+'/'+data.totalQuestions);
                        $('#showtrial').show();
                        $('body').append('<div onclick="closebg(this);"  style="background: #000000; opacity: 0.8; position: fixed; top: 0px;left: 0px; z-index: 999; width: 100%; height: 1000px;"></div>');

                        $('html, body').animate({
                            scrollTop: $("#header").offset().top
                        }, 1000);
                    }
                });

                $('#show-answers').prop("disabled", true);
            }
        }

        function closebg(that) {
            $('#showtrial').hide();
            $(that).remove();
        }
        seconds = 0;
        min = 0;
        hour = 0;
        intervalId = setInterval(function(){
            seconds ++;
            if(seconds<10) {
                $('#sec').text('0'+seconds);
            }else {
                $('#sec').text(seconds);
            }

            if(seconds == 60) {
                $('#sec').text('00');
                seconds = 0;
                min ++;
                if(min<10) {
                    $('#min').text('0'+min);
                }else{
                    $('#min').text(min);
                }

                if(hour ==60){
                    $('#min').text('00');
                    min = 0;
                    hour ++;
                    if(hour<10) {
                        ('#hour').text('0'+hour);
                    }else {
                        ('#hour').text(hour);
                    }

                }
            }
        }, 1000);

        var currentpage=0;

        function Next(){
            var numpage=<?php echo $numpage ?>;
            if(currentpage < numpage){
                currentpage++;
            }
            $('.answer_box').removeClass('active');
            $('.question_page_'+currentpage).addClass('active');
        }
        function Back(){
            var numpage=<?php echo $numpage ?>;
            if(currentpage >1){
                currentpage--;
            }
            $('.answer_box').removeClass('active');
            $('.question_page_'+currentpage).addClass('active');
        }
        Next();


    </script>
</div>
<?php } ?>