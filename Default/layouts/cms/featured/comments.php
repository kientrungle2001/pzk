﻿<?php if(!$data->getIsAjax()): ?>
<?php
$comments = pzk_request()->getComments();
$featuredid = pzk_request()->getId();
$ip = getRealIPAddress();
pzk_session('featuredid',$featuredid);
if (pzk_session('login')){
	$username= pzk_session('username');
	$id=$data->getInfo($username);
	pzk_session('id',$id['id']);
}
else
{
	$username="Khách";
}
//$count = $data->getCountComment($newsid);
//$pages = ceil($count / 5);	

?>
<style>
.user-id p{padding-top:0px; margin:0px}
span.comment_date{font-weight:none; font-size:12px;}

</style>

<div class="comments-wrapper">
<div id="pagechange">		
		<h4 class="text-center"><span class="label label-primary">Nhận xét về bài viết</span></h4>
<?php $allcomments=$data->getComments($featuredid); ?>

<?php foreach($allcomments as $allcomment): ?>		
<div class="panel-group" >
  <div class="panel panel-default">
    <div class="panel-heading" id="accordion2">
      <h4 data-toggle="collapse" data-parent="#accordion2" href="#2<?php echo @$allcomment['id']?>" class="panel-title">
		<a href="/user/profileusercontent?member=<?php echo @$allcomment['username']?>"><?php echo @$allcomment['name']?></a>
		<span><?php echo @$allcomment['created']?></span>
      </h4>
    </div>
    <div id="2<?php echo @$allcomment['id']?>" class="panel-collapse collapse in">
      <div class="panel-body">
	  <?php echo @$allcomment['comment']?></div>
    </div>
  </div>
</div>
<?php endforeach; ?>	

<?php 
			$total = $data->countItems();
			$pages = ceil($total / 5);
			$curPage = pzk_request()->getPage();
			?>

			<p class="text-center">Trang 
			<?php for($i = 0; $i < $pages; $i++) { 
				$btnActive = '';
				if($i == $curPage) {
					$btnActive = 'btn-default';
				}
				$page = $i + 1;
			?>
			<a onclick="commentpage(<?php echo $i ?>); return false;" href="#" class="btn <?php echo $btnActive ?>"><?php echo $page ?></a>
			<?php }?>	
			</p>
			</div>	
<form role="form" method="post" action="/featured/commentsPost">
  <input type="hidden" name="id" value="" />
  <div class="form-group">
    <input type="text" style="height:100px;" class="form-control" id="comments" name="comments" placeholder="
	<?php if(pzk_session('login')){
	echo"Đăng bình luận";
	}else{
	echo "Bạn chưa đăng nhập, đăng nhập để gửi bình luận";	
	}
	?>" >
	<button type="submit" class="btn btn-primary comment-button">Bình luận</button>
  </div>
  
  </form>

</div>
 <script>
$(document).ready(function(){
    $('[data-toggle="popover"]').popover(); 
	
});
function commentpage(i){
	$.ajax({
		url: BASE_REQUEST + '/featured/page',
		data: {
			page: i,
			id: <?php echo $featuredid ?>
		},
		type: 'post',
		success: function(resp) {
			$('#pagechange').html(resp);
		}
	});
}
</script>
<?php else: ?>
<?php
$comments=pzk_request()->getComments();
$featuredid=pzk_request()->getId();
$ip = getRealIPAddress();
pzk_session('featuredid',$featuredid);
if (pzk_session('login')){
	$username= pzk_session('username');
	$id=$data->getInfo($username);
	pzk_session('id',$id['id']);
}
else
{
	$username="Khách";
}
//$count = $data->getCountComment($newsid);
//$pages = ceil($count / 5);	

?>
<style>
.user-id p{padding-top:0px; margin:0px}
span.comment_date{font-weight:none; font-size:12px;}

</style>

<div class="comments-wrapper">
		
		<h4 class="text-center"><span class="label label-primary">Nhận xét về bài viết</span></h4>
<?php $allcomments=$data->getComments($featuredid,pzk_request()->getPage()); ?>
<?php foreach($allcomments as $allcomment): ?>		
<div class="panel-group" id="accordion2">
  <div class="panel panel-default">
    <div class="panel-heading">
      <h4 data-toggle="collapse" data-parent="#accordion2" href="#2<?php echo @$allcomment['id']?>" class="panel-title">
		<a href="/user/profileusercontent?member=<?php echo @$allcomment['username']?>"><?php echo @$allcomment['name']?></a>
		<span><?php echo @$allcomment['created']?></span>
      </h4>
    </div>
    <div id="2<?php echo @$allcomment['id']?>" class="panel-collapse collapse in">
      <div class="panel-body">
	  <?php echo @$allcomment['comment']?></div>
    </div>
  </div>
</div>
<?php endforeach; ?>		
<?php 
			$total = $data->countItems();
			$pages = ceil($total / 5);
			$curPage = intval(pzk_request()->getPage());
			?>

			<p class="text-center">Trang 
			<?php for($i = 0; $i < $pages; $i++) { 
				$btnActive = '';
				if($i === $curPage) {
					$btnActive = 'btn-default';
				}
				$page = $i + 1;
			?>
			<a onclick="commentpage(<?php echo $i ?>); return false;" href="#" class="btn <?php echo $btnActive ?>"><?php echo $page ?></a>
			<?php }?>	
			</p>
<?php endif;?>