<?php
  $noteId= pzk_request()->getNoteId();
  $commentId=pzk_request()->getCommentId();
  $userId=pzk_session('userId');
  $social= _db()->getEntity('communication.social');
?>
<?php
    $user_note= _db()->getEntity('communication.user_note'); 
    $comment_notes=$user_note->loadCommentNote($noteId,$commentId);
    $comment_notes= array_reverse($comment_notes);
    foreach ($comment_notes as $comment_note) 
    {
      //$userId= $comment_note['userId'];

      $user=$social->user($comment_note['userId']);
      $username=$user['name'];
   ?>
  
    <div id="commId{comment_note[id]}" class="user_note_comment">
     <div class="pfr_avatar_wall">
       <img src="{user[avatar]}" alt="" width="60px" height="60px">
     </div> 
     <div class="prf_titlenote">
       <a href="/profile/user?member={comment_note[userId]}" >{username}</a>
     </div>
    <div class="titel_detail">{comment_note[comment]}</div>
    <?php 
      if($item['userNote']==pzk_session('userId')){
     ?>
     <div style="float:right;"><a href="javascript:;" class="black" title="Xoá" onclick="pzk_{data.id}.delComm({comment_note[id]});">[Xoá]</a></div>
     <?php } ?>
    <div class="titel_time">Đước viết lúc: {comment_note[date]}</div>
    </div>

  <?php } 
    $datetime= date("Y-m-d H:i:s");
    if(isset($comment_note))
    {
      $count_comment= $user_note->countCommentNote($noteId,$comment_notes[0]['id']);
      //var_dump($comment_notes[0]['id']);die;
      echo "<script>$('#countComment".$noteId."').html(".$count_comment.");</script>";

      echo '<input type="hidden" id="commentId'.$noteId.'" value="'.$comment_notes[0]['id'].'">';
    }
  ?>
  <div class="clear"></div>
  <div id="end_note_comment"></div>
<script>
var countRow= '<?php echo @$count_comment ?>';
var noteId= '<?php echo @$noteId ?>';
  $('#viewMoreComment'+noteId).hide();
    if(countRow>0)
    {
      $('#viewMoreComment'+noteId).show();
    }else{
      $('#viewMoreComment'+noteId).hide();
    }
</script>
