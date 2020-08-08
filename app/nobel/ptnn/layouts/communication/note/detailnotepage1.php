<?php 
    $id= pzk_request()->getId();
    $commentId=pzk_request()->getCommentId();
    $user_note= _db()->getEntity('communication.user_note');
    $comment_notes=$user_note->loadCommentNote($id,$commentId);
    $comment_notes= array_reverse($comment_notes);
    $count_arr= count($comment_notes); 
    foreach ($comment_notes as $comment_note) 
    {
      $userId= $comment_note['userId'];

      $user=$user_note->loadUserName($userId);
      $username=$user['username'];
   ?>
    <div class="user_note_comment">
     <div class="pfr_avatar_wall"><?php echo $user_note->checkAvatar($user['avatar']) ?></div> 
     <div class="prf_titlenote">
       <a href="/profile/user?member={userId}" >{username}</a>
     </div>
    <div class="titel_detail">{comment_note[comment]}</div>
    <div class="titel_time">Đước viết lúc: {comment_note[date]}</div>
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
  <script>
      //var numberrow= parseInt('<?php echo $count_arr ; ?>');
      var count_comment=parseInt('<?php echo $count_comment; ?>');
      $('#view_more_comment').hide();
      if(count_comment> 0)
      {
        $('#view_more_comment').show();
      }else{
        $('#view_more_comment').hide();
      }
  </script>