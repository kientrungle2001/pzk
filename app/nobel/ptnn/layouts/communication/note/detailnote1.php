<div id="detail_note">
  <div class="layout_title">Ghi chép cá nhân</div>
  <div class="clear"></div>
  <div class="detail_note">
     <?php 

      $id= pzk_request()->getId();
      $commentId=pzk_request()->getCommentId();
      $member= pzk_request()->getMember();
      $user_note= _db()->getEntity('communication.user_note');
      $note= $user_note->loadWhere(array('id',$id));
      $date= $user_note->formatDate($note->getDatenote());
      ?>

    <div style="float:left;"><img src="<?php echo BASE_URL.'/default/skin/nobel/ptnn/media/usernote.png' ?>" alt=""></div>

    <div class="prf_titlenote">{note.getTitlenote()}  </div>  
    <div class="prf_clear"> </div>
    <div class="title_detail"><strong>Nội dung: </strong>{note.getContentnote()}</div>
    <div class="clear"></div>
    <div class="titel_time">Vào lúc: <?php echo @$date['1']?> Ngày <?php echo @$date['0']?></div> 
    <div class="clear"></div>
    <div>
      <div><textarea id="txt_comment_note1" class="txt_comment_note" required="required" placeholder="Bình luận" rel="false"></textarea></div>
      <div class="clear"></div>
      <div><input type="button" class=" btn btn-primary" id="btt_comment_note" onclick="pzk_<?php echo @$data->id?>.Send1('<?php echo pzk_session()->getAvatar() ?>','<?php echo pzk_session()->getUserId() ?>','<?php echo pzk_session()->getUsername() ?>','<?php echo $id ?>','<?php echo $member ?>')" name="send" value="Bình luận"></div>
    </div>

  </div>
  <div class="clear"></div>
  <div id="view_note_comment">
    <div id="view_more_comment">
      <a href="#" onclick="pzk_<?php echo @$data->id?>.viewMore1('<?php echo $id ?>'); return false;"><span>Xem thêm <span id="count_comment_note"></span> bình luận khác</span></a>
    </div>
  <?php 
    $comment_notes=$user_note->loadCommentNote($id,$commentId);
    $comment_notes= array_reverse($comment_notes);
    foreach ($comment_notes as $comment_note) 
    {
      $userId= $comment_note['userId'];

      $user=$user_note->loadUserName($userId);
      $username=$user['username'];
   ?>
    <div class="user_note_comment">
     <div class="pfr_avatar_wall"><?php echo $user_note->checkAvatar($user['avatar']) ?></div> 
     <div class="prf_titlenote">
       <a href="/profile/user?member=<?php echo $userId ?>" ><?php echo $username ?></a>
     </div>
    <div class="titel_detail"><?php echo @$comment_note['comment']?></div>
    <div class="titel_time">Đước viết lúc: <?php echo @$comment_note['date']?></div>
    </div>

  <?php } 
    $datetime= date("Y-m-d H:i:s");
    if(isset($comment_note))
    {
      $count_comment= $user_note->countCommentNote($id,$comment_notes[0]['id']);
      echo "<script>$('#count_comment_note').html(".$count_comment.");</script>";
      echo '<script>window.commentId='.$comment_notes[0]['id'].';</script>';
    }
  ?>
  <div class="clear"></div>
  <div id="end_note_comment1"></div>
  </div>
</div>
<script>

  var count_comment=parseInt('<?php echo @$count_comment ?>');
  
  $('#view_more_comment').hide();
  if(count_comment> 0)
  {
    $('#view_more_comment').show();
  }else{
    $('#view_more_comment').hide();
  }
  
</script>
 