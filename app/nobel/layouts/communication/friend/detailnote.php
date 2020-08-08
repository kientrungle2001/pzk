<div id="detail_note">
  <div class="layout_title">Ghi chép cá nhân</div>
  <div class="clear"></div>
  <div class="detail_note">
     <?php 

        $id= pzk_request()->getId();
        $commentId=pzk_request()->getCommentId();
       $member= pzk_request()->getMember();
       $count= $data->countComment($id);
       $numberrow=$count['count'];
        $note=$data->loadDetailNote($id);

      ?>

    <div style="float:left;"><img src="/3rdparty/uploads/img/usernote.png" alt=""></div>

    <div class="prf_titlenote">{note[titlenote]}  </div>  
    <div class="prf_clear"> </div>
    <div class="prf_titlenote"><span>Nội dung: </span>{note[contentnote]}</div>
    <div class="clear"></div>
    <div class="prf_titlenote"><span>Ngày: {note[datenote]}</span></div> 
    <div class="clear"></div>
    <div>
      <div><textarea id="txt_comment_note" class="txt_comment_note" required="required" placeholder="Bình luận" rel="false"></textarea></div>
      <div class="clear"></div>
      <div><input type="button" id="btt_comment_note" onclick="Send()" name="send" value="Bình luận"></div>
    </div>

  </div>
  <div class="clear"></div>
  <div id="view_note_comment">
    <div id="view_more_comment">
      <a href="#" onclick="viewMore(); return false;"><span>Xem thêm <span id="count_comment_note"></span> bình luận khác</span></a>
    </div>
  <?php 
    $comment_notes=$data->loadCommentNote($id,$commentId);
    $comment_notes= array_reverse($comment_notes);
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
  <div class="clear"></div>
  <div id="end_note_comment"></div>
  </div>
  <?php
   $count_arr= count($comment_notes);
  
   ?>
</div>
<script>

  var numberrow= parseInt('<?php echo @$count_arr ; ?>');
  var count_comment=parseInt('<?php echo @$count_comment ?>');
  $('#view_more_comment').hide();
  if(numberrow < 6 || count_comment<6)
  {
    $('#view_more_comment').hide();
  }else{
    $('#view_more_comment').show();
  }
  function Send()
  {

    var comment_note= $('#txt_comment_note').val();
    var avatar1='<?php echo pzk_session('avatar'); ?>';
    var userId='<?php echo pzk_session('userId'); ?>';
    var userComment= '<?php echo pzk_session('username'); ?>';
    
   // var datetime= '<?php echo $datetime ?>';
   var d = new Date();
   var datetime= d.getFullYear()+'-'+ (d.getMonth()+1) +'-'+ d.getDate()+' '+d.getHours()+':'+d.getMinutes()+':'+d.getSeconds() ;
   //var datetime= dateFormat(new Date(), "mm-dd-yy h:MM:ss");
    var note_id='<?php echo pzk_request("id") ?>';
    
    $.ajax({
      data:{
        comment_note: comment_note,
        note_id: note_id
      },
      url:'/friend/PostCommentNote',
      success: function(result){
       $('#end_note_comment').append('<div class="user_note_comment"><div class="pfr_avatar_wall"><img src="'+avatar1+'" alt="" width="60" height="60"></div><div class="prf_titlenote" style="width:30%; height: auto; float:left;"><a href="/profile/profileusercontent?member='+userId+'">'+userComment+'</a><br><span>'+datetime+'</span></div><div class="prf_titlenote" style="width:30%; height: auto; float:left;">'+comment_note+'</div><div class="prf_titlenote"></div></div>');
      
      }
    });

    
  }
   function viewMore()
    {
      //alert('in');
      var noteId= '<?php echo $id; ?>';
      var commentId= window.commentId;
      $.ajax({
        url:'/friend/viewComment',
        data:{
          commentId:commentId,
          id: noteId
        },
        success: function(result)
        {
          //alert(result);
          $('#view_more_comment').after(result);
        }
      });
      
    }
</script>
 