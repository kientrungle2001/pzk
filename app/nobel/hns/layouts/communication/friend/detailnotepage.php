<?php 
    $id= pzk_request()->getId();
    $commentId=pzk_request()->getCommentId();
    $comment_notes=$data->loadCommentNote($id,$commentId);
    $comment_notes= array_reverse($comment_notes);
    $count_arr= count($comment_notes); 
    foreach ($comment_notes as $comment_note) 
    {
      $userId= $comment_note['userId'];

      $user=$data->loadUserName($userId);
      $username=$user['username'];
   ?>
    <div class="user_note_comment">
     <div class="pfr_avatar_wall"><?php echo $data->checkAvatar($userId) ?></div> 
     <div class="prf_titlenote" style="width:30%; height: auto; float:left;">
       <a href="/profile/profileusercontent?member=<?php echo $userId; ?>" ><?php echo $username ?></a>
       <br><span>{comment_note[date]}</span>
     </div>
     <div class="prf_titlenote"><span>id: </span>{comment_note[id]}  </div>  
    <div class="prf_titlenote" style="width:30%; height: auto; float:left;">{comment_note[comment]}</div>
    <div class="prf_titlenote"></div>
    </div>

  <?php } 
    
    $datetime= date("Y-m-d H:i:s");
    if(isset($comment_note))
    {
      $count_comment= $data->countCommentNote($id,$comment_notes[0]['id']);
      echo "<script>$('#count_comment_note').html(".$count_comment.");</script>";
      echo '<script>window.commentId='.$comment_notes[0]['id'].';</script>';
    }
  ?>
  <script>
      var numberrow= parseInt('<?php echo $count_arr ; ?>');
      var count_comment=parseInt('<?php echo $count_comment; ?>');
      $('#view_more_comment').hide();
      if(numberrow < 6 || count_comment< 6)
      {
        $('#view_more_comment').hide();
      }else{
        $('#view_more_comment').show();
      }
  </script>