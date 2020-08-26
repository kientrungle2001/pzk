<?php
$comments=pzk_request()->getComments();
$newsid=pzk_request()->getId();
$ip=getRealIPAddress();
pzk_session('newsid',$newsid);
if (pzk_session('login')){
	$username= pzk_session('username');
	$id=$data->getInfo($username);
	pzk_session('id',$id['id']);
}
else
{
	$username="Khách";
}
?>
<style>
.user-id p{padding-top:0px; margin:0px}
span.comment_date{font-weight:none; font-size:12px;}

</style>

<div class="comments-wrapper">
		<div class="Showcomments" align="center" style="margin:20px; float:left; line-height: 1.42857143;color: #555;background-color: #fff;background-image: none;border: 1px solid #ccc;border-radius: 4px;">
			<div style="clear:both;"></div>
				<div style="float:left;"><h4>Ý kiến thành viên</h4></div> 
				<div style="float:right;">
				<?php $count=$data->getCountComment($newsid); ?>
				<h4> <?php echo $count ?> Bình luận</h4>
				</div>
			
			<div class="comments" style="width:800px; height:auto;  float:left;">
			<?php $allcomments=$data->getComments($newsid); ?>
			<?php foreach($allcomments as $allcomment): ?>
				<div class=" col-xs-12" style="margin-top:20px;">
					<div class="avatar col-xs-2"  style="width:50px; height:50px;float:left; margin:10px; ">
						<img src="<?php echo @$allcomment['avatar']?>" class="useravatar" width=50; height=50;></img>
					</div>
					<div class="user-comments col-xs-10"style="width:600px; height:auto;">
						<div class="user-id" style="float:left;">
							<p class="comment-name" align="left"><a href="/user/profileusercontent?member=<?php echo @$allcomment['username']?>"><?php echo @$allcomment['name']?></a></p>
							<p align="left"><span class="comment_date">on <?php echo @$allcomment['created']?> says: </span></p>
							<p><?php echo @$allcomment['comment']?></p>
							<button type="button" class="btn btn-default btn-xs like-comment" value="<?=$allcomment['id']?>"><span class="glyphicon glyphicon-heart-empty" aria-hidden="true"></span>Like</button><span id="<?=$allcomment['id']?>"> <?php echo @$allcomment['likecomment']?></span>
						</div>
					</div>
				</div>
			<?php endforeach; ?>
			</div>
		</div>
							<?php
								$userid=$data->getInfo($username);
								$newsid=pzk_request()->getId();
								$datelike=date("Y-m-d");
							?>
							<script>
								
								$('.like-comment').click(function() {
									
									
									var userid='<?php echo $userid['id']; ?>';
									var newsid= '<?php echo $newsid; ?>';
									var datelike= '<?php echo $datelike; ?>';
									var commentid= $(this).val();
									
									$.ajax({
										url:'../cms/news/likecomment',
										data:{
											userid: userid,
											newsid:newsid,
											datelike:datelike,
											commentid:commentid
										}, 
										success:function(result){
										
											
											if(result !=""){
												
												$('#'+commentid+'').html(result);
											}else{
												
											}
     
										}
									});

        
								});
							</script>
<form role="form" method="post" action="/cms/news/commentsPost">
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