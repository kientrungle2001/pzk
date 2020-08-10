<?php if(!pzk_session('userId')){ ?>
<div class="container">
<div class="col-md-12 col-xs-12 bd-div bgclor form_search_test top10 bot20 imgbg">
			<form class="form_search_test" style="margin: 15px 0px" action="<?=BASE_REQUEST?><?php echo $doTestPostUrl ?>" method="post" onsubmit = "return check_select_test()">
				<div class="col-xs-12 border-question" style="z-index: 9">
					<div class="question_content pd-0 margin-top-20">
						<div class="clearfix margin-top-10">
							<div class="col-xs-12 pd-0">
								<h3 class="pd-top-15" style="width: 100%; text-align: center;">Bạn phải <a rel="<?php echo @$_SERVER['REQUEST_URI']?>" class="login_required" data-toggle="modal" data-target=".bs-example-modal-lg" style="cursor:pointer;">Đăng nhập</a> thì mới được thi thử</h3>
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
<?php } else { ?>
<?php 
$getTestTls = $data->get('testTl');
$test = $data->get('dataTest');
$showQuestionTl = $data->get('showQuestionTl');

 ?>
<?php 
	
	if($showQuestionTl) {
?>
<style>
	/* Dropdown Button */
.dropbtn {
    background-color: #2696c4;
    color: white;
    padding: 10px;
    font-size: 16px;
    border: none;
    cursor: pointer;
	width: 100%;
}

/* The container <div> - needed to position the dropdown content */
.dropdown {
    position: relative;
    display: inline-block;
	
}

/* Dropdown Content (Hidden by Default) */
.dropdown-content {
    display: none;
    position: absolute;
    background-color: #f9f9f9;
    min-width: 160px;
    box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
    z-index: 9999999;
	width: 100%;
}

/* Links inside the dropdown */
.dropdown-content a {
    color: black;
    padding: 12px 16px;
    text-decoration: none;
    display: block;
}
.dropdown-content a.active{
	background: #f1f1f1; 
}
/* Change color of dropdown links on hover */
.dropdown-content a:hover {background-color: #f1f1f1}

/* Show the dropdown menu on hover */
.dropdown:hover .dropdown-content {
    display: block;
}

/* Change the background color of the dropdown button when the dropdown content is shown */
.dropdown:hover .dropbtn {
    background-color: #3e8e41;
}
</style>
<div class="container">
	<p class="t-weight text-center btn-custom8 mgright textcl">Làm đề tự luận - Lớp 5</p>
</div>
<div class="container">
	<div class="row">
		<div class="col-md-1 col-xs-1"></div>
		<div class="col-md-10 col-xs-10 bd-div bgclor form_search_test top10 bot20">
			<div class="col-xs-12 form-group  top20">
				<div style="padding: 0px;" class="col-xs-9 pd-0">
				
					<div class="dropdown item">
					  <button class="dropbtn">Chọn đề</button>
					  <div class="dropdown-content">
						  <?php foreach($getTestTls as $val){ ?>
						  <a <?php if($val['id'] == $test['id']){ echo 'class="active"'; } ?> href="/test/testtl/<?php echo @$val['id']?>"><?php echo $val['name']; ?></a>
						<?php } ?>
						
					  </div>
					</div>
					
					
				</div>
				
				
			</div>
				
			<div class="col-xs-12 border-question" style="z-index: 9">
				
				<div class="item bd-div bgclor form_search_test top10 bot20">
				
		  
					<?php foreach($showQuestionTl as $key =>$value):?>
						<?php
						$BookObj = pzk_obj_once('Education.Userbook.Type.Testtl');
						$BookObj->set ('id', false);
						$BookObj->set ('questionId', $value['id']);
						
						$BookObj->set('content', $value['teacher_answers'] );
						$BookObj->set('showTeacher', 1);
						$BookObj->set('order', $key + 1 );
						$BookObj->display ();
						?>
					<?php endforeach;?>
				</div>
	
						
				<div class="fix_da">
					<button id="tlanswers" onclick="return showtlanswers();" class="btn btn-danger" name="show-answers"   type="button">
						Xem đáp án 
					</button>
				</div>				
							
				
			</div>
		</div>
		<div class="col-md-1 col-xs-1"></div>
	</div>
</div>


<script>
function showtlanswers(){

	$('.questiontl').each(function(){
		$(this).removeClass('col-md-12');
		$(this).addClass('col-md-6');
	});
	$('.showtlanswers').each(function() {
		$(this).show();
	});
};
	
$(document).ready(function() {
	setInputTinymceClient();
	
})
	

</script>
	<?php } ?>
	
<?php } ?>