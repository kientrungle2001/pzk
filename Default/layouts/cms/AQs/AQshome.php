<?php if(!$data->getIsAjax()): ?>
<?php
	$username= pzk_session('username');
	if(!$username){
		$username = "Khách";
	}else{
		$id=$data->getInfo($username);	
	}
?>
<style>
.aqs{
	width:100%;  min-height: 470px;
}
.question{
	min-height:300px; 
	overflow: hidden;
}
</style>

<div class="container aqs">
	<h4 class="text-center"><span class="label label-primary">Hỏi đáp nhanh</span></h4>
	<div class="row question" id="aqs_questions">
	<?php $allquestions=$data->getQuestion();?>
		{each $allquestions as $allquestion}
		<div class="panel panel-default">
    <div class="panel-heading" role="tab" id="headingOne">
      <h4 class="panel-title">
		<p class="text-left"><span class="label label-primary">{allquestion[username]}:</span> {allquestion[question]}</p>
		<a role="button" data-toggle="collapse" data-parent="#accordion" href="#<?=$allquestion['id']?>" aria-expanded="true" aria-controls="<?=$allquestion['id']?>">
         <?php 
				$questionid=$allquestion['id'];
				$count=$data->getCountAnswer($allquestion['id']); 
				$allanswers=$data->getAnswer($allquestion['id']);
				?>
		 <button type="button"  class="btn-xs btn-primary" >Trả lời <span class="badge">{count}</span></button>
        </a>
      </h4>
    </div>
    <div id="<?=$allquestion['id']?>" class="panel-collapse collapsing" role="tabpanel" aria-labelledby="headingOne">
      <div class="panel-body">
        
				{each $allanswers as $allanswer}
				<p class="text-left"><span class="label label-primary">{allanswer[username]}:</span> {allanswer[answer]}</p>
				{/each}
				<form role="form" method="post" action="/AQs/answerPost">
					<input type="hidden" name="id" value=""/>
					<div class="form-group">
						<input type="hidden" id="questionid" name="questionid" value="<?=$allquestion['id']?>" />
						<input type="text"  class="form-control" id="answer" name="answer" placeholder="<?php if(pzk_session('login')){echo"Trả lời";
						}else{
						echo "Bạn chưa đăng nhập, đăng nhập để gửi câu hỏi";	
						}
						?>" >
						<button type="submit" class="btn-xs btn-primary comment-button" style="margin-top:5px;">Trả lời</button>
						
					</div>
				</form>
	  </div>
    </div>
  </div>
  
  {/each}
	<?php 
			$total = $data->countItems();
			$pages = ceil($total / 5);
			$curPage = pzk_request('page');
			?>

			<p style="text-align:left;">Trang 
			<?php for($i = 0; $i < $pages; $i++) { 
				$btnActive = '';
				if($i == $curPage) {
					$btnActive = 'btn-default';
				}
				$page = $i + 1;
			?>
			<a onclick="aqs_changepage({i}); return false;" href="#" class="btn {btnActive}">{page}</a>
			<?php }?>	
			</p>
	</div>
	<div class="clearfix" style="padding:5px; height:60px; width:224px;">
		<form role="form" method="post" action="/AQs/questionPost">
			<input type="hidden" name="id" value="" />
			<div class="form-group">
				<input type="text"  class="form-control" id="question" name="question" placeholder="<?php if(pzk_session('login')){
				echo"Mời bạn đặt câu hỏi";
				}else{
				echo "Bạn chưa đăng nhập, đăng nhập để gửi câu hỏi";	
				}
				?>" >
				<button type="submit" class="btn-xs btn-primary comment-button" style="margin-top:5px;">Gửi</button>
			</div>
		  
		 </form>
	 </div>
 </div>
 <div>
			

</div>
 <script>
$(document).ready(function(){
    $('[data-toggle="popover"]').popover(); 
	
});
function aqs_changepage(i){
	$.ajax({
		url: BASE_REQUEST + '/AQs/page',
		data: {
			page: i
		},
		type: 'post',
		success: function(resp) {
			$('#aqs_questions').html(resp);
		}
	});
}
</script>
<?php else: ?>
<?php
	$username= pzk_session('username');
	if(!$username){
		$username = "Khách";
	}else{
		$id=$data->getInfo($username);	
	}
?>
	<?php $allquestions=$data->getQuestion(pzk_request('page'));?>
		{each $allquestions as $allquestion}
		<div class="panel panel-default">
    <div class="panel-heading" role="tab" id="headingOne">
      <h4 class="panel-title">
		<p class="text-left"><span class="label label-primary">{allquestion[username]}</span>: {allquestion[question]}</p>
		<a role="button" data-toggle="collapse" data-parent="#accordion" href="#<?=$allquestion['id']?>" aria-expanded="true" aria-controls="<?=$allquestion['id']?>">
         <?php 
				$questionid=$allquestion['id'];
				$count=$data->getCountAnswer($allquestion['id']); 
				$allanswers=$data->getAnswer($allquestion['id']);
				?>
		 <button type="button"  class="btn-xs btn-primary" >Trả lời <span class="badge">{count}</span></button>
        </a>
      </h4>
    </div>
    <div id="<?=$allquestion['id']?>" class="panel-collapse collapsing" role="tabpanel" aria-labelledby="headingOne">
      <div class="panel-body">
        
				{each $allanswers as $allanswer}
				<p class="text-left"><span class="label label-primary">{allanswer[username]}</span>: {allanswer[answer]}</p>
				{/each}
				<form role="form" method="post" action="/AQs/answerPost">
					<input type="hidden" name="id" value=""/>
					<div class="form-group">
						<input type="hidden" id="questionid" name="questionid" value="<?=$allquestion['id']?>" />
						<input type="text"  class="form-control" id="answer" name="answer" placeholder="<?php if(pzk_session('login')){echo"Trả lời";
						}else{
						echo "Đăng nhập để gửi câu hỏi";	
						}
						?>" >
						<button type="submit" class="btn-xs btn-primary comment-button" style="margin-top:5px;">Trả lời</button>
					
					</div>
				</form>
	  </div>
    </div>
  </div>
  {/each}
	<?php 
			$total = $data->countItems();
			$pages = ceil($total / 5);
			$curPage = pzk_request('page');
			?>

			<p style="text-align:left;">Trang 
			<?php for($i = 0; $i < $pages; $i++) { 
				$btnActive = '';
				if($i == $curPage) {
					$btnActive = 'btn-default';
				}
				$page = $i + 1;
			?>
			<a onclick="aqs_changepage({i}); return false;" href="#" class="btn {btnActive}">{page}</a>
			<?php }?>	
			</p>
<?php endif;?>