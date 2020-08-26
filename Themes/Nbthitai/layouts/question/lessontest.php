 <div class="container fulllook2 text-left hidden-xs">
	<div class="row">
		<div class="col-md-1">&nbsp;</div>			
		<div class="col-xs-11 col-md-11 ">
			<div class="pd-90 text-right">
				<h1><a href="<?=FL_URL?>">FULL LOOK</a></h1>	
				<h3 class="hidden-xs">Phần mềm Khảo sát và Phát triển năng lực toàn diện bằng tiếng Anh</h3>
				<?php echo partial('Themes/Default/layouts/home/aboutbtn');?>
			</div>
		</div>
	</div>
</div>

<div class="container top50 visible-xs">
	<div class="row">
		<div class="col-md-1">&nbsp;</div>			
		<div class="col-xs-11 col-md-11 ">
			<div class="pd-20 text-left">
				<a href="<?=FL_URL?>"><h1>FULL LOOK</h1></a>	
			</div>
		</div>
	</div>
</div>	

<?php $data->displayChildren('[position=top-menu]') ?>

<?php if(1): ?>

<?php
$category_id = intval(pzk_request()->getSegment(3));
$showQuestions 	= $data->getQuestionByIds($category_id);
// xu li questions
	$processQuestions = array();
	$arrQuestionIds = array();
	if(count($showQuestions) > 0) {
		foreach($showQuestions as $question) {
			$processQuestions[$question['id']] = $question;
			$arrQuestionIds[] = $question['id'];
		}
		//xu li cau tra loi
		$answers = _db()->useCache(1800)
			->selectAll()
			->from('answers_question_tn')
			->where(array('in', 'question_id', $arrQuestionIds))
			->result();
		$processAnswer = array();
		foreach($answers as $val) {
			$processAnswer[$val['question_id']][] = $val;
		}	
		//debug($processAnswer);die();	
	}
if($showQuestions) {
?>


<div id="boxthank">
        <div id="showtrial">
            <h4 class="text-center title_tb">Thông báo</h4>
            <div style="padding: 0px 10px;">
                <h4>Kết quả làm thử bài tập của bạn</h4>
                <h4>Số điểm: <span id="result_mark" style="color: red;" > </span></h4>
                <h4>Thời gian: <span style="color: red;"><span type="hidden" name="hour" id="hour"/>00</span>:<span type="hidden" name="min" id="min"/>00</span>:<span type="hidden" name="sec" id="sec"/></span></span> </h4>
                <h4>Hãy click vào nút mua sản phẩm để để được luyện tập cùng phần mềm Full Look!</h4>
                <button style="float: left; margin-right: 10px;padding: 5px 20px;" type="button" class="btn btn-success" onclick="location.reload()"><span class="glyphicon glyphicon-repeat"></span> Làm lại</button>
				<button style="float: left; margin-right: 10px;padding: 5px 20px;" type="button" class="btn btn-danger" onclick="show_answers();closebg($('#closebg')); return false;"> Xem đáp án</button>
                <a class="bt-buy" href="/home/about">Mua sản phẩm</a><a class="bt-home" href="/">Về trang chủ</a>
				
            </div>
        </div>
    </div>
	
	<?php if(pzk_session('login')) { ?>
	
<div class="container">
    <h2 class="text-center fontutmc">Trắc nghiệm dùng thử sản phẩm</h2>
</div>
<div class="container">
	<div class="row bot20">
		<div class="col-md-1 col-xs-1"></div>
		<div class="col-md-10 col-xs-10 bd-div bgclor">
			<form id="form_question_nn" class="item pd-0 question_content form-horizontal" style="margin-top:20px" action="" method="post">
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
							$QuestionObj = pzk_obj_once('Education.Question.Type.'.ucfirst(questionTypeOjb($value['questionType'])));
							$QuestionObj->setQuestionId($value['id']);
										
							$questionChoice = _db()->getEntity('Question.Choice');
							$questionChoice->setData($processQuestions[$value['id']]);
							$QuestionObj->setQuestion($questionChoice);
							
							//debug($processAnswer[$value['id']]);die();
							$answerEntitys = array();
							foreach($processAnswer[$value['id']] as $val) {
									$answerEntity = _db()->getEntity('Question.Choice.Answer');
									$answerEntity->setData($val);
									$answerEntitys[] = $answerEntity;
							}
							
							$QuestionObj->setAnswers($answerEntitys);
							
							$QuestionObj->display();
							?>
						</div>
						<?php endforeach;?>

					</div>

				</fieldset>
				<div class="fix_da">
					
						<!-- 
						<button id="finish-choice" class="btn practice-finish" name="finish-choice" onclick="finish_choice();" type="button">
							<span class="glyphicon glyphicon glyphicon-saved" aria-hidden="true"></span> Hoàn thành
						</button>
						<button id="show-answers" class="btn practice-view-result" name="show-answers" onclick="show_answers();" type="button">
							<span class="glyphicon glyphicon glyphicon-eye-open" aria-hidden="true"></span> Xem đáp án
						</button>
						 -->
						<button id="finish-choice" class="btn btn-primary" name="finish-choice" onclick="finish_choice();" type="button">
							Hoàn thành 
						</button>
						<button id="view-result" class="btn btn-success" onclick="return show_result();"  type="button">
							Xem kết quả 
						</button>
						<button id="show-answers" class="btn btn-danger" name="show-answers" onclick="show_answers();" type="button">
							Xem đáp án 
						</button>
						
				</div>
				
			</form>
		</div>
		<div class="col-md-1 col-xs-1"></div>
	</div>
</div>
<script>

        var formdata;

        function finish_choice(){
            clearInterval(intervalId);
            $('#end_time').val('<?=date('H:i:s', $_SERVER['REQUEST_TIME'])?>');
            formdata = $('#form_question_nn').serializeForm();
            $('#idFieldset input').prop( "disabled", true );
            $('#finish-choice').prop( "disabled", true );
            get_answers();
            return formdata;
        }

		function show_result(){
			if(formdata	==	null){
          		alert('Click hoàn thành để xem kết quả!');
          	}else{
				$('body').append('<div id="closebg" onclick="closebg(this);"  style="background: #000000; opacity: 0.8; position: fixed; top: 0px;left: 0px; z-index: 999; width: 100%; height: 1000px;"></div>');
				$('#showtrial').show();
				$('html, body').animate({
					scrollTop: $("#header").offset().top
				}, 1000);
			}
			
		}
		
        function get_answers(){
			
           	if(formdata	==	null){
          		alert('Click hoàn thành để xem đáp án !');
          	}else{
          		$.ajax({
    	          	type: "Post",
    		        data:{
    		          	answers:formdata,
    		        },
    		        url:'<?=BASE_REQUEST?>/Ngonngu/showAnswersChoice',
    		        success: function(results){
    		         	var data = $.parseJSON(results);
    		         	$('#result_mark').text(data.total+'/'+data.totalQuestions);
    		      	}
    	        });
          		$('#view-result').show();
          		$('body').append('<div id="closebg" onclick="closebg(this);"  style="background: #000000; opacity: 0.8; position: fixed; top: 0px;left: 0px; z-index: 999; width: 100%; height: 1000px;"></div>');
    	     	$('#showtrial').show();
    	     	$('html, body').animate({
                    scrollTop: 50
                }, 1000);
          	}
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
                            $('.answers_'+item.questionId+'_'+item.value).css('font-weight', 'bold');
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
                        
                        $('.explanation').removeClass('hidden');
                    }
                });

                $('#show-answers').prop("disabled", true);
                $('.explanation').show();
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
</script>
	<?php } else { ?>
		<div class='container'>
		
		<div class="col-md-10 col-xs-10 bd-div bgclor form_search_test top10 bot20 imgbg col-md-offset-1">
						<form class="form_search_test" style="margin: 15px 0px" action="/test/doTest/" method="post" onsubmit="return check_select_test()">
				<div class="col-xs-12 border-question" style="z-index: 9">
					<div class="question_content pd-0 margin-top-20">
						<div class="clearfix margin-top-10">
							<div class="col-xs-12 pd-0">
								<h3 class="pd-top-15" style="width: 100%; text-align: center;">Bạn phải <a rel="<?=$_SERVER["REQUEST_URI"];?>" class="login_required" data-toggle="modal" data-target=".bs-example-modal-lg" style="cursor:pointer;">Đăng nhập</a> thì mới truy cập được</h3>
							</div>
							<div class="col-xs-5 pd-0">
								
							</div>
						</div>
						<div class="margin-top-10">
							
						</div>
					</div>
				</div>
			</form>
						</div>
		</div>
	<?php } ?>
<?php } else { ?>
	<div class="container">
		<h2 class="text-center fontutmc">Trắc nghiệm dùng thử sản phẩm</h2>
	</div>
	<div class="container">
		<div class="row bot20">
			<div class="col-md-1 col-xs-1"></div>
			<div class="col-md-10 col-xs-10 bd-div bgclor">
				<h3>
				Mục này không có bài để dùng thử. Chỉ thành viên trả phí mới có quyền truy cập. Xem hướng dẫn mua <a href="/home/about">tại đây</a>
				</h3>
			</div>
			<div class="col-md-1 col-xs-1"></div>
		</div>
	</div>
<?php	
} ?>
<?php else: ?>
<div  class="container bank">
	<style>
		#contain-left img{width:100%; margin:0px}
	</style>
	<div style="margin-top:15px;" class="col-xs-12">
		<div class="bank_area">
		
			<?php if(pzk_request()->getSoftwareId() == 1):?>
		
			<div class="col-xs-12">
				<h2 class="title-practice" style="margin-bottom: 30px;">Phần mềm đánh giá toàn diện các chỉ số (IQ,EQ,CQ...) dành cho HS Tiểu học</h2>
			</div>
			<?php elseif (pzk_request()->getSoftwareId() == 2):?>
			<div class="col-xs-12">
				<h2 class="title-practice" style="margin-bottom: 30px;">Phần mềm đánh giá toàn diện các chỉ số IQ, EQ, CQ,... sắp có mặt tại Việt Nam</h2>
			</div>			
			<?php endif;?>
			<div class="col-xs-12">
				<div class="pm_change text-center">
					<span class="txt_bank_title" style="color: green;" > Mọi chi tiết xin liên hệ: </span> <br>
					<span class="txt_bank_title" style="color: green;" > Công ty Cổ phần Giáo dục Phát triển Trí tuệ và Sáng tạo Next Nobels </span> <br>
					<br>
					<p>Trụ sở: Nhà số 6 Ngõ 115 Nguyễn Khang, Quận Cầu Giấy, Hà Nội</p>
					<p>Website: www.nextnobels.com</p>
					<p>Điện thoại liên hệ: 04.8585.2525 </p>
					<p>Hotline: 0936.738.986</p>
				</div>
			</div>
		</div>
	</div>
</div>
<?php endif; ?>