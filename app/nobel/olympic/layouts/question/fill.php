<link rel="stylesheet" href="/default/skin/nobel/ptnn/css/question/fill.css">
<?php 
	$categoryIds= pzk_request()->getSegment(3);
	//$quantity=11;

	//$level=1;
	
	$questionId=array();
	$questionType=array();


 ?>
 <div class="view_question" id="ctg_question_fill">
 <form role="form" id="frm_question_fill" method="post" action="">
 <div  class="title_question">ĐIỀN TỪ THÍCH HỢP VÀO CHỖ TRỐNG</div>

<?php 
	if(pzk_request()->is('POST') && is_numeric($categoryIds)) {
    	$request = pzk_request()->query;
    	$quantity=$request['number'];
    	$level=$request['level'];
    	$time=$request['time'];
    	$num_row=3;
		$num_page=ceil($quantity/$num_row);
		$items=$data->ShowQestion($level,$categoryIds,$quantity);
	

 ?>

 <!--Chọn dạng -->
 <div class="step">
            <label for="">Chọn dạng</label>
            <?php
            echo $data->ShowCate($categoryIds);
            ?>
 </div>
  <!--End chọn dạng -->
<table class="tb_question" border="1px" cellpadding="0" cellspacing="0">
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
                    <input  type="hidden" class="chose_time" name="time" />
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
                    <input type="hidden" name="start_time" value="<?php echo date('H:i:s', $_SERVER['REQUEST_TIME']); ?>"/>
                </th>
            </tr>
            </thead>
        </table>

 <?php 
 	for($j=0;$j< $num_page; $j++){
  ?>
 <div id="frm_answer_box<?=$j+1?>" class="answer_box">
 <?php 
 	for($i=$j*$num_row;$i<$j*$num_row+ $num_row; $i++) {	
 		if($i>=$quantity){
 			break;
 		}
  ?>
 	<div class="step">
 		<span><strong>Yêu Cầu:</strong> <?=$items[$i]['request']?></span>
		
		<input class="input_question_id" type="hidden" name="question_id[<?=$i;?>]" value="<?php echo $items[$i]['id']; ?>">
		<input type="hidden" name="question_type[<?=$i;?>]" value="<?php echo $items[$i]['type']; ?>">
 	</div>
 	<div class="step">
 	<span><strong> Câu <?=$i+1;?>:</strong> <?=$items[$i]['name']?></span>
  	</div>
	<div class="view_tamp_answers">
	 	<div class="clear"><strong><span>Đáp án mẫu:</span></strong></div>
  	 		<div class="col-xs-3 margin-top-10" style="position:relative; margin-top: 20px; " >
  			<div class="view_tamp_answer_<?php echo $items[$i]['id']; ?>"></div>
  		</div>
  	
	</div>	

  	<div class="step" >
  		<div style="clear:both;"><span><strong>Đáp án:</strong></span></div>
  		
  		<div class="col-xs-3 margin-top-10" style="position:relative; margin-top: 20px; " >
			<div class="input-group" >
			    <input type="text" name="answers[<?=$i;?>][]" class="input_user_test form-control content_value"/>
			</div>
			<div class="remove-input" ><a href="javascript:void(0)" class="color_delete" title="Xóa"><span class="glyphicon glyphicon-remove-circle"></span></a></div>
		</div>
		<div class="add_row_answer">
			<div class="itemAnswer_<?=$i;?>"  ></div>
		</div>
		<div class="btt_add_answer"><button type="button" class="btn btn-primary add-sub-input-test" onclick="addInputRow(<?=$i;?>)" style="margin-left: 15px;"><span class="glyphicon glyphicon-plus-sign"></span> Thêm đáp án</button></div>
  		
  	</div>
  	
 	<?php } ?>
 </div>
 <?php } ?>	
 	 <div class="toeic_footer">
 	 	<button type="button" onclick="Back()" class="btn btn-default"><span class="glyphicon glyphicon-backward"></span> Quay lại</button>
 	 	<button type="button" onclick="Next()" class="btn btn-default"><span class="glyphicon glyphicon-forward"></span> Tiếp </button>
 	 </div>
	<div >
		<button type="submit" id="btt_Fillfinish" class="btn btn-primary" onclick="finish(); return false; " ><span class="glyphicon glyphicon-save"></span> Hoàn Thành</button>
		<button id="btt_view_tamp_answer" type="button" class="btn btn-primary" onclick="showAnswer()" ><span class="glyphicon glyphicon-save"></span> Xem Đáp Án</button>
		<button id="btt_save_book" type="button" class="btn btn-primary" onclick="saveBook();" ><span class="glyphicon glyphicon-save"></span> Lưu vào vở bài tập</button>
		<button type="button" class="btn btn-primary" id="btt_fill_sendmark" onclick="sendMark()" ><span class="glyphicon glyphicon-save"></span> Gửi giáo viên chấm</button>
			
	</div>
	<input type="hidden" name="quantity_question" value="<?php echo $quantity; ?>">
	<input type="hidden" name="category_id" value="<?php echo $categoryIds; ?>">
	
 </form>
 </div>
 <?php 
 	}
  ?>
 <script>
 	$('.view_tamp_answers').hide();
 	$('#btt_fill_sendmark').prop( "disabled", true );
 	
 	$(function(){
 				$('.chose_time').val('<?php echo $request['time']; ?>');
                $('.ms_timer').countdowntimer({
                	minutes :<?php echo $request['time']; ?>,
                    seconds : 0,
                    size : "lg",
                    timeUp : timeisUp
                });
                function timeisUp() {
                    finish();
                }
    });
 	function addInputRow(key){
		
		var div = document.createElement('div');

	    div.className = 'col-xs-3  element-input';
		
	    div.innerHTML = '<div class="input-group" style="margin-bottom: 10px;" >\
	    					<input type="text" name="answers['+key+'][]" class="input_user_test form-control content_value"/>\
	        			</div>\
	        			<div class="remove-input"  style="margin-bottom: 10px;" ><a href="javascript:void(0)" class="color_delete" title="Xóa"><span class="glyphicon glyphicon-remove-circle"></span></a></div>';

	   	$('.itemAnswer_'+key).append(div);

	}

  var formdata;

	function finish() {
		var time = $(".ms_timer").text();
        if(time) {
            $('.stop_timer').text(time);
            $('.input_time').val(time);
        }
        $('.ms_timer').remove();
		$('.remove-input').hide();
		$('.btt_add_answer').hide();
		formdata = $('#frm_question_fill').serializeForm();
		$('.input_user_test').prop( "disabled", true );
		$('#btt_Fillfinish').prop( "disabled", true );
		return formdata;
	}
	function showAnswer(){
    if(formdata==null){  		
  			formdata= finish();
    }
 		$('.view_tamp_answers').show();
 		
    $.ajax({
              type: "POST",
              url:'/fill/showAnswer',
              data: {answers:formdata},
                success: function(data) {
                  $('#btt_view_tamp_answer').prop("disabled",false);
                  var data = $.parseJSON(data);
                            $.each(data, function(i, item) {
                                var type = item.type;
                                if(type == 'Q2' || type == 'Q3' || type == 'Q5' || type == 'Q6'){
                                    if(item.value) {
                                        $('.view_tamp_answer_'+item.questionId).css('background-color', '#5cb85c');
                                        $('.view_tamp_answer_'+item.questionId).html(item.value);
                                      }
                                } else if (type == 'Q0' || type == 'Q4') {
                                    $('.view_tamp_answer_'+item.value).css('background-color', '#5cb85c');
                                }
                            }); 
                }
    });
 	}

	$("#ctg_question_fill").on("click", '.remove-input', function(e){
		 $(this).parent().remove();
	});

	// phan trang
var currentpage=0;

  function Next()
  {
  	var numpage=<?php echo $num_page ?>;
    if(currentpage < numpage){
    	currentpage++;
    }
    $('.answer_box').removeClass('active');
    $('#frm_answer_box'+currentpage).addClass('active');
   
  }
   function Back()
  {
  	var numpage=<?php echo $num_page ?>;
    if(currentpage >1){
    	currentpage--;
    }
    $('.answer_box').removeClass('active');
    $('#frm_answer_box'+currentpage).addClass('active');
   
  }
  Next();
  // Lưu vào vở bài tập
 var user_book_id;
  function saveBook(){
  	if(formdata==null){  		
  		formdata= finish();
  	}
  	$.ajax({
      type: "Post",
      data:{
        	answers: formdata,
          keyBook:'<?php echo pzk_session("keyBook"); ?>'
      },
      url:'/fill/fillPost',
      success: function(msg){
        if(msg){
           	user_book_id=msg;
        	$('#btt_save_book').prop( "disabled", true );
           	$('#btt_fill_sendmark').prop( "disabled", false );
        }
        
      }

    });

  }
// Gửi giáo viên chấm điểm
function sendMark(){
   	$.ajax({
      type: "Post",
      data:{
        user_book_id: user_book_id
      },
      url:'/fill/fillPostMark',
      success: function(msg){
        if(msg){
        	$('#btt_fill_sendmark').prop( "disabled", true );
        }
       }

    });
  }
 </script>