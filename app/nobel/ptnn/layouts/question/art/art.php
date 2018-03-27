<link rel="stylesheet" href="/default/skin/nobel/ptnn/css/question/fill.css">
<div class="view_question" id="">
  <div  class="title_question">BÀI TẬP</div>
<?php
$questions = $data->showQuestion();
$numpage= $data->numPage();
$i=1;
$page=1;
?>
<table class="tb_question" border="1px" cellpadding="0" cellspacing="0">
            <thead>
            <tr>
                <th>Số câu</th>
                <th>Mức độ</th>
                <th>Thời gian làm bài</th>
                <th>Thời gian còn lại</th>
                <th>Thời gian bắt đầu làm</th>
            </tr>
            <tr>
                <th>
                  <?php echo pzk_request('number'); ?>
                  <input type="hidden" name="number" value="<?php echo pzk_request('number'); ?>"/>
                </th>
                <th>
                  <?php echo $data->checkLevel(pzk_request('level')); ?>
                  <input type="hidden" name="level" value="<?php echo pzk_request('level'); ?>"/>
                </th>
                <th><?php echo pzk_request('time'); ?></th>
                
                <th><span class="ms_timer"></span></th>
                <th><?php echo date('H:i:s', time()); ?></th>
            </tr>
            </thead>
        </table>
<form action="" id="frm_category_art">

<div >
<input type="hidden" name="categoryId" value="<?php echo $data->getCategoryId(); ?>">
<input type="hidden" name="time" value="<?php echo pzk_request('time'); ?>">
<input type="hidden" name="key_test" value="<?php echo pzk_request('key'); ?>">
<input type="hidden" name="quantity" value="<?php echo $data->getQuantity(); ?>">
{each $questions as $question}
<div class=" step_ answer_box question_page_<?php echo $page?>">
	<input type="hidden" name="question_id[<?php echo $question['id']; ?>]" value="<?php echo $question['id']; ?>">
	<input type="hidden" name="question_type[<?php echo $question['id']; ?>]" value="<?php echo $question['type']; ?>">
<span><strong>Câu : <?php echo $i; ?> </strong> </span>
{?
  $type= $question['type'];
  $layoutType= $data->getQuestionType($type);
	$i++;
	$page=ceil($i/3);
	$obj = pzk_parse('<education.question.art.' . $layoutType . ' />');
	$obj->setItem($question);
	$obj->setId($question['id']);
	$obj->display();
?}
<div class="step view_answer_question ">
  <div style="float:left; padding-right: 10px;"><strong><span>Đáp án mẫu:</span></strong></div>
  <div class="view_answer_tamp_<?php echo $question['id']; ?>"></div>
</div>
<div class="step view_answer_topic_<?php echo $question['id']; ?>">
  
  
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
	<button type="submit" class="btn btn-primary btt_test_finish" onclick="finish();  " ><span class="glyphicon glyphicon-save"></span> Hoàn Thành</button>
	<button type="button" class="btn btn-primary btt_view_tamp_answer" onclick="showAnswerTest()" ><span class="glyphicon glyphicon-save"></span> Xem Đáp Án</button>
	<button  type="button" class="btn btn-primary btt_save_test" onclick="saveTest();" ><span class="glyphicon glyphicon-save"></span> Lưu vào vở bài tập</button>
	<button type="button" class="btn btn-primary btt_sendtestmark " onclick="sendTestMark()" ><span class=" glyphicon glyphicon-save"></span> Gửi giáo viên chấm</button>
</div>
</form>

</div>
<script>
$(function(){
 				$('.ms_timer').countdowntimer({
                	minutes :<?php echo pzk_request('time'); ?>,
                    seconds : 0,
                    size : "lg",
                    timeUp : timeisUp
                });
                function timeisUp() {
                    finish();
                }
});
$("#frm_category_art").on("click", '.remove-input', function(e){
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
		formdata = $('#frm_category_art').serializeForm();
		$('.input_user_test').prop( "disabled", true );
		$('.btt_test_finish').prop( "disabled", true );
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
          key:'<?php echo pzk_session("keyBook") ?>'
      },
      url:'/art/saveBook',
      success: function(msg){
        if(msg){
          user_test_id=msg;
        	$('.btt_save_test').prop( "disabled", true );
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
      url:'/art/sendTestMark',
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
              url:'/art/showAnswerTest',
              data: {answers:formdata},
                success: function(data) {
                  $('.btt_view_tamp_answer').prop("disabled",true);
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
                                }else if(type=='Q9' || type=='Q10' || type=='Q12'){
                                  $('.view_answer_tamp_'+item.questionId).append('<p ><span class="view_tamp_answerchoice">'+item.value+'</span></p>');
                                  $('.view_answer_tamp_'+item.questionId).append('<p><strong>Câu hoàn chỉnh: </strong> <span class="view_tamp_answerchoice">'+item.contentfull+'</span>');
                                }else if(type=='Q14'){
                                  $('.view_answer_tamp_'+item.questionId).append('<p ><span class="view_tamp_answerchoice">'+item.value+'</span></p>');
                                }else if(type=='Q11' || type=='Q13'){
                                  $('.view_answer_tamp_'+item.questionId).append('<p ><span class="view_tamp_answerchoice">'+item.value+'</span></p>');
                                  $('.view_answer_tamp_'+item.questionId).append('<p><strong>Câu viết lại: </strong> <span class="view_tamp_answerchoice">'+item.contentfull+'</span>');
                                }else if(type=='Q15' || type=='Q16' || type=='Q17'){
                                  $.each(item.value, function(j, valueAnswer) {
                                    j=j+1;
                                    $('.view_answer_tamp_'+item.questionId).append('<p class="view_tamp_answer"><span style="color:blue;">'+j+':  </span>'+valueAnswer+'</p>');
                                  });
                                }
                            }); 
                }
    });
  }
</script>