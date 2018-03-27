<link rel="stylesheet" href="/default/skin/nobel/ptnn/css/question/fill.css">
<div class="view_question" id="">
  <div  class="title_question">BÀI KIỂM TRA</div>
<?php
$test = $data->getTest();
$questions = $test->getQuestions();

$numpage= $data->numPage($test->getQuantity());

$i=1;
$page=1;
?>
<table class="tb_question" border="1px" cellpadding="0" cellspacing="0">
            <thead>
            <tr>
                <th>Số câu</th>
                <th>Thời gian làm bài</th>
                <th>Thời gian còn lại</th>
                <th>Thời gian bắt đầu làm</th>
            </tr>
            <tr>
                <th><?php echo $test->getQuantity(); ?></th>
                <th><?php echo $test->getTime(); ?></th>
                <th><span class="ms_timer"></span></th>
                <th><?php echo date('H:i:s', $_SERVER['REQUEST_TIME']); ?>
                    
                </th>
            </tr>
            </thead>
        </table>
<form action="" id="frm_user_test">

<div >
<input type="hidden" name="categoryId" value="<?php echo $test->getCategoryId(); ?>">
<input type="hidden" name="time" value="<?php echo $test->getTime(); ?>">
<input type="hidden" name="key_test" value="<?php echo pzk_request()->get('key'); ?>">
<input type="hidden" name="quantity" value="<?php echo $test->getQuantity(); ?>">
{each $questions as $question}
<div class=" step_ answer_box question_page_<?php echo $page?>">
	<input type="hidden" name="question_id[<?php echo $question->get('id'); ?>]" value="<?php echo $question->get('id'); ?>">
	<input type="hidden" name="question_type[<?php echo $question->get('id'); ?>]" value="<?php echo $question->getType(); ?>">
<span><strong>Câu : <?php echo $i; ?> </strong> </span>
{?
	$i++;
	$page=ceil($i/3);
	$obj = pzk_parse('<education.test.' . $question->getQuestionType() . ' />');
	$obj->setItem($question);
	$obj->setQuestionId($question->get('id'));
	$obj->display();
?}
<div class="step view_answer_question ">
  <div style="float:left; padding-right: 10px;"><strong><span>Đáp án mẫu:</span></strong></div>
  <div class="view_answer_tamp_<?php echo $question->get('id'); ?>"></div>
</div>
<div class="step view_answer_topic_<?php echo $question->get('id'); ?>">
  
  
</div>
<div class="clear_step"></div>
</div>
{/each}

</div>
<div class="toeic_footer">
 	<button type="button" onclick="Back()" class="btn btn-default"><span class="glyphicon glyphicon-backward"></span> Quay lại</button>
 	<button type="button" onclick="Next()" class="btn btn-default"><span class="glyphicon glyphicon-forward"></span> Tiếp </button>
 </div>
<div >
	<button type="submit" id="btt_test_finish" class="btn btn-primary" onclick="finish(); return false; " ><span class="glyphicon glyphicon-save"></span> Hoàn Thành</button>
	<button type="button" class="btn btn-primary btt_view_tamp_answer" onclick="showAnswerTest()" ><span class="glyphicon glyphicon-save"></span> Xem Đáp Án</button>
	<button  type="button" class="btn btn-primary btt_save_test" onclick="saveTest();" ><span class="glyphicon glyphicon-save"></span> Lưu vào vở bài tập</button>
	<button type="button" class="btn btn-primary btt_sendtestmark " onclick="sendTestMark()" ><span class=" glyphicon glyphicon-save"></span> Gửi giáo viên chấm</button>
</div>
</form>

</div>
<script>
$(function(){
 				$('.ms_timer').countdowntimer({
                	minutes :<?php echo $test->getTime(); ?>,
                    seconds : 0,
                    size : "lg",
                    timeUp : timeisUp
                });
                function timeisUp() {
                    //finish();
                }
});
$("#frm_user_test").on("click", '.remove-input', function(e){
     $(this).parent().remove();
  });
// phân trang
 var currentpage=0;

  function Next()
  {
  	var numpage=<?php echo $numpage ?>;
    if(currentpage < numpage){
    	currentpage++;
    }
 	$('.answer_box').removeClass('active');
   	$('.question_page_'+currentpage).addClass('active');
  }
  function Back()
  {
  	var numpage=<?php echo $numpage ?>;
    if(currentpage >1){
    	currentpage--;
    }
    $('.answer_box').removeClass('active');
    $('.question_page_'+currentpage).addClass('active');
   
  }
  Next();
// End phân trang
$('.btt_fill_sendmark').prop( "disabled", true );
var formdata;
function finish() {
		var time = $(".ms_timer").text();
        if(time) {
            //$('.stop_timer').text(time);
            //$('.input_time').val(time);
        }
        $('.ms_timer').remove();
		$('.remove-input').hide();
		$('.btt_add_answer').hide();
		formdata = $('#frm_user_test').serializeForm();
		$('.input_user_test').prop( "disabled", true );
		$('#btt_test_finish').prop( "disabled", true );
		return formdata;
}
// Lưu vào vở bài tập
 var user_test_id;
  function saveTest(){
  	if(formdata==null){  		
  		formdata= finish();
  	}
  	$.ajax({
      type: "Post",
      data:{
        	answers: formdata,
          key:'<?php echo pzk_session("keyTest") ?>'
      },
      url:'/test/saveTest',
      success: function(msg){
        if(msg){
           	user_test_id=msg;
        	//$('.btt_save_test').prop( "disabled", true );
          $('.btt_sendtestmark').prop( "disabled", false );
        }
        
      }

    });

  }
// Gửi giáo viên chấm điểm
function sendTestMark(){
   	$.ajax({
      type: "Post",
      data:{
        user_test_id: user_test_id
      },
      url:'/test/sendTestMark',
      success: function(msg){
        if(msg){
        	$('.btt_sendtestmark').prop( "disabled", true );
        }
       }

    });
}
$('.view_answer_question').hide();
  function showAnswerTest(){
    if(formdata==null){     
        formdata= finish();
    }
    $('.view_answer_question').show();
    $.ajax({
              type: "POST",
              url:'/test/showAnswerTest',
              data: {answers:formdata},
                success: function(data) {
                  //alert(data);
                  
                  $('.btt_view_tamp_answer').prop("disabled",false);
                  var data = $.parseJSON(data);
                  //console.log(data); return false;
                            $.each(data, function(i, item) {
                                var type = item.type;
                                if(type == 'Q2' || type == 'Q3' || type == 'Q5' || type == 'Q6'){
                                    if(item.value) {
                                      var index=0;
                                      $.each(item.value, function(i, val) {
                                        index++;
                                        $('.view_answer_tamp_'+item.questionId).append('<p class="view_tamp_answer"><span style="color:blue;">'+index+':  </span>'+val+'</p>');
                                      });
                                    }
                                }else if (type == 'Q0' || type == 'Q4') {
                                  $('.view_answer_tamp_'+item.questionId).append('<p class="view_tamp_answerchoice">'+item.value+'</p>');
                                }else if (type=='Q7'){
                                  if(item.topics){
                                    $.each(item.topics, function(i, topic) {
                                      $('.view_answer_topic_'+item.questionId).append('<div class=" viewtopic view_topic_'+i+'"><p>Chủ đề : '+topic.content+' </p></div>');
                                      var index=0;
                                      $.each(topic.answers, function(j, valueAnswer) {
                                          index++;
                                          $('.view_topic_'+i).append('<p class="view_tamp_answer"><span style="color:blue;">'+index+':  </span>'+valueAnswer.content+'</p>');
                                      });
                                    });
                                  }
                                }else if(type=='Q8'){
                                  $('.view_answer_tamp_'+item.questionId).append('<p class="view_tamp_answerchoice">'+item.value+'</p>');
                                  $('.view_answer_tamp_'+item.questionId).append('<p><strong>Câu viết lại: </strong> <span class="view_tamp_answerchoice">'+item.contentfull+'</span>');
                                }

                            }); 
                }
    });
  }
</script>