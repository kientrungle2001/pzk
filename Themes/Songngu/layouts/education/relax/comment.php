<?php

$newsid=$data->getNewId();

pzk_session('newsid',$newsid);
if (pzk_session('login')){
	$username= pzk_session('username');
	$userid=pzk_session('userId');
	
}
else
{
	$username="Khách";
	$userid = false;
}
?>
<style>
.user-id p{padding-top:0px; margin:0px}
span.comment_date{font-weight:none; font-size:12px;}
.useravatar{float: left; width: 100%; min-width: 40px; max-width: 100px;border-radius: 50%;}
.Showcomments{width: 100%; margin:15px 0px; padding: 10px; float:left; line-height: 1.42857143;color: #555;background-color: #fff;background-image: none;border: 1px solid #ccc;border-radius: 4px;}
.mgt15{margin-top: 15px;}
</style>


<div class="comments-wrapper">
		<div class="Showcomments">
			<div style="clear:both;"></div>
				<div style="float:left;"><h4>Ý kiến thành viên</h4></div> 
				<div style="float:right;">
				<?php $count=$data->getCountComment($newsid); ?>
				<h4> <?php echo $count ?> Bình luận</h4>
				</div>
			
			<div class="comments row">
			<?php $allcomments=$data->getComments($newsid); ?>
			<?php if($allcomments){ ?>
			<?php foreach($allcomments as $allcomment): ?>
				<div class=" col-xs-12" style="margin-top:20px;">
					<div class="avatar col-xs-2" >
						<?php if($allcomment['avatar']) { ?>
						<img src="<?php echo @$allcomment['avatar']?>" class="useravatar"></img>
						<?php }else { ?>
							<img src="<?= BASE_URL; ?>/Default/skin/nobel/ptnn/media/noavatar.gif" class="useravatar"></img>
						<?php } ?>
					</div>
					<div class="user-comments col-xs-10">
						<div class="user-id" style="float:left;">
							<div class="comment-name" align="left"><span><?php echo @$allcomment['name']?></span></div>
							<div align="left"><span class="comment_date">on <?php echo @$allcomment['created']?> says: </span></div>
							<div><?php echo @$allcomment['content']?></div>
						</div>
					</div>
				</div>
			<?php endforeach; ?>
			<?php } ?>
			</div>
		</div>
							

  <div class="form-group">
    <textarea  type="text" style="height:100px;" class="form-control" id="comments" name="comments" placeholder="
	<?php if(pzk_session('login')){
	echo 'Đăng bình luận';
	}else{
	echo 'Bạn chưa đăng nhập, đăng nhập để gửi bình luận';	
	}
	?>" > </textarea >
	<?php if(pzk_session('login')) { ?>
	<button onclick ='comment();' class="btn mgt15 btn-primary comment-button">Bình luận</button>
	<?php } ?>
  </div>
  
 

</div>
<script>
	
	function comment() {
		var comment = $('#comments').val();
		
		if(comment.length > 3){
			$.ajax({
				url:'<?php echo BASE_REQUEST;?>/relax/newComment',
				data:{
					userid: '<?php echo $userid; ?>',
					newsid:'<?php echo $newsid; ?>',
					comment:comment
				}, 
				success:function(data){
					if(data == 1) {
						alert('Bình luận thành công!');
						window.location.href = location;
					}

				}
			});
		}else{
			alert('Bình luận phải từ 3 kí tự trở lên!');
			$('#comments').focus();
		}
		return false;
	}

</script>
