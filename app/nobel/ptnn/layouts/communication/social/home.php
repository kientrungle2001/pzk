<?php

  $socialId= pzk_request()->getSocialId();
  $commentId=pzk_request()->getCommentId();
  $userId=pzk_session('userId');
  $social= _db()->getEntity('communication.social');

  $alert= $social->countAlert();
  $showAlert= $social->showAlert();
  $countInvi= $social->countInvi();
  $viewInvis= $social->viewInvi();
  $content=$social->showContent($socialId);
  $datetime= date("Y-m-d H:i:s");
?>
<div class="prffriend_right" >
  <div class="prf_hello">
    
    <div class="hiii">
      <span><a href="/profile/user?member={userId}"> Trang cá nhân </a>|</span>
    </div>
    <div class="hiii">
      <div class="dropdown" id="new_invi">
        <button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown">{countInvi} lời mời kết bạn mới 
        <span class="caret"></span></button>
        <ul class="dropdown-menu" style="width: 378px;">
          <li align="center">
            <div>Lời mời kết bạn</div>
            <div class="note_end" style="width: 100%;"></div>
          </li>
          {each $viewInvis as $invi}
          <?php 
            $userInvi= $social->user($invi['userinvitation']);
          ?>
          <li id="invi_{invi[userinvitation]}">
          <div class="view_invi">
            <div class="pfr_avatar_wall">
              <img src="{userInvi[avatar]}" alt="" width="55px" height="60px">
            </div>
            <div class="prf_titlenote" style="width: 20%;">
              <a href="/profile/user?member={invi[userinvitation]}">{userInvi[name]}</a>
            </div>
            <div class="btt_invi">
             <span ><img onclick="pzk_{data.id}.agree({invi[userinvitation]});" src="<?php echo BASE_URL.'/default/skin/nobel/ptnn/media/pr_bt_ketban.png' ; ?>" alt="Kết bạn"></span>
             <span><img onclick="pzk_{data.id}.deny({invi[userinvitation]});" src="<?php echo BASE_URL.'/default/skin/nobel/ptnn/media/huyketban.png' ; ?>" alt="Hủy Kết bạn"></span> 
            </div>            
          </div>
          <div class="clear"></div>
          <div class="note_end" style="width: 100%;"></div>
          </li>
          {/each}
            <li align="center">
              <a href="/invitation/list">Xem tất cả</a>
            </li>
            
          
        </ul>
      </div>
    </div>
    <div class="hiii">
      <div class="dropdown" id="new_alert">
        <button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown">{alert} thông báo mới
        <span class="caret"></span></button>
        <ul class="dropdown-menu scrollable-menu" role="menu">

          <?php if(!$showAlert){ ?>
          <li>Không có thông báo mới</li>
          <?php }else{ ?>
        {each $showAlert as $show}
            <li>
              <?php echo $social->checkAlert($show['type'],$show['userNote'],$show['userComment'],$show['noteId']); ?>
            </li>
            
          {/each} 
        <?php } ?> 
        </ul>
      </div>
    </div>
    
    
    
    
    
      
    
  </div>
  <div class="clear"></div>
  <div class="content">
  {each $content as $item}
    <?php
      $rowNotes= $social->rowNote($item['noteId'],$item['type']);
      $userNote= $social->user($item['userNote']); 
      $note= $social->note($item['noteId']);

      $date= $social->formatDate($note['date']);
      if($rowNotes){
        if(intval($rowNotes[0])==1){ 
     ?>
     <div class="pfr_avatar_wall">
       <img src="{userNote[avatar]}" alt="" width="60px" height="60px">
     </div>
     <div class="prf_titlenote">
       <a href="/profile/user?member={item[userNote]}">{userNote[name]}</a>
      <span class="note_new"> đã thêm một ghi chép mới</span>
        <br>
       <span class="titel_time">Vào lúc: {date[1]} Ngày {date[0]}</span>
     </div>
     <div class="clear"></div>
     <div class=""><a href="/note/detailnote?member={item[userNote]}&id={note[id]}">{note[title]}</a></div>
     <div class="prf_clear"> </div>
    <div class="title_detail">{note[content]}</div>
    <div class="clear"></div>
    
    <div>
      <div class="comment"><textarea id="note_note{note[id]}" style="min-height:65px;" class="txt_comment_note" required="required" placeholder="Bình luận" rel="false"></textarea></div>
      
      <div class="btt_comment"><input type="button" class=" btn btn-primary" id="btt_notenote{note[id]}" onclick="pzk_{data.id}.SendNote('<?php echo pzk_session('avatar') ?>','<?php echo pzk_session('userId') ?>','<?php echo pzk_session('username') ?>','{note[id]}','{note[userNote]}')" name="send" value="Bình luận"></div>
    </div>

    <div class="clear"></div>
    
    <div id="end_notenote{note[id]}"></div>
    



     <?php 
        }else if(intval($rowNotes[0])>1){
            $userComm= $social->user($rowNotes[1]);
      ?>
    <div class="prf_titlenote" style="padding-bottom: 5px;">
       <a href="/profile/user?member={rowNotes[1]}">{userComm[name]}</a>
      <span class="note_new">{rowNotes[3]} đã bình luận về nội dung này</span>
       
     </div>
     <div class="clear"></div>
     <div class="note_end"></div>
    <div class="pfr_avatar_wall">
       <img src="{userNote[avatar]}" alt="" width="60px" height="60px">
     </div>
     <div class="prf_titlenote">
       <a href="/profile/user?member={item[userNote]}">{userNote[name]}</a>
      <span class="note_new"> đã thêm một ghi chép mới</span>
        <br>
       <span class="titel_time">Vào lúc: {date[1]} Ngày {date[0]}</span>
     </div>
     <div class="clear"></div>
     <div class=""><a href="/note/detailnote?member={item[userNote]}&id={note[id]}">{note[title]}</a></div>
     <div class="prf_clear"> </div>
    <div class="title_detail">{note[content]}</div>
    <div class="clear"></div>
    
     <div>
      <div class="comment"><textarea id="note_note{note[id]}" style="min-height:65px;" class="txt_comment_note" required="required" placeholder="Bình luận" rel="false"></textarea></div>
      
      <div class="btt_comment"><input type="button" class=" btn btn-primary" id="btt_notenote{note[id]}" onclick="pzk_{data.id}.SendNote('<?php echo pzk_session('avatar') ?>','<?php echo pzk_session('userId') ?>','<?php echo pzk_session('username') ?>','{note[id]}','{note[userNote]}')" name="send" value="Bình luận"></div>
    </div>
<!-- 
    <div class="clear"></div>
    <div class="note_end"></div>
    <div id="end_notenote{note[id]}"></div>
    <div class="clear"></div>
    <div class="note_end"></div> -->
    <div class="clear"></div>
  <div id="view_note_comment">
    <div id="viewMoreComment{item[noteId]}">
      <a href="#" onclick="pzk_{data.id}.viewMore('{item[noteId]}'); return false;"><span>Xem thêm <span id="countComment{item[noteId]}"></span> bình luận khác</span></a>
    </div>
  <?php
    $user_note= _db()->getEntity('communication.user_note'); 
    $comment_notes=$user_note->loadCommentNote($item['noteId'],$commentId);
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

    
    if(isset($comment_note))
    {
      $count_comment= $user_note->countCommentNote($item['noteId'],$comment_notes[0]['id']);
      //var_dump($comment_notes[0]['id']);die;
      echo "<script>$('#countComment".$item['noteId']."').html(".$count_comment.");</script>";
      //echo "<script>window.commentId".$item['noteId']."=".$comment_notes[0]['id'].";</script>";
      echo '<input type="hidden" id="commentId'.$item['noteId'].'" value="'.$comment_notes[0]['id'].'">';
    }
  ?>
  <script>
var countRow= '<?php echo @$count_comment ?>';
var noteId= '<?php echo @$item["noteId"] ?>';
  $('#viewMoreComment'+noteId).hide();
    if(countRow>0)
    {
      $('#viewMoreComment'+noteId).show();
    }else{
      $('#viewMoreComment'+noteId).hide();
    }
</script>
  <div id="end_notenote{item[noteId]}"></div>
  <div class="clear"></div>
  <div id="end_notenote{item[noteId]}"></div>
  </div>

<?php } ?>


    <div class="prf_clear"></div>
    <div class="note_end"></div>
    <div class="prf_clear"></div>
      <?php }else if($item['type']=="avatar"){ 
        $updateDate= $social->formatDate($item['date']);
      ?>
    <div class="pfr_avatar_wall">
       <img src="{userNote[avatar]}" alt="" width="60px" height="60px">
     </div>
     <div class="prf_titlenote">
       <a href="/profile/user?member={item[userNote]}">{userNote[name]}</a>
      <span class="note_new"> đã cập nhật ảnh đại diện mới</span>
        <br>
       <span class="titel_time">Vào lúc: {updateDate[1]} Ngày {updateDate[0]}</span>
     </div>
     <div class="clear"></div>
     <div class="avatar">
       <img src="{userNote[avatar]}" alt="" width="230px" height="230px">
     </div>
    <div class="prf_clear"></div>
    <div class="note_end"></div>
    <div class="prf_clear"></div>

      
    <?php }else if($item['type']=="writewall"){ 
        $updateDate= $social->formatDate($item['date']);
        $writewall= $social->writeWall($item['writeWallId']);
        if($item['userNote']==$item['userComment']){
      ?>
    <div class="pfr_avatar_wall">
       <img src="{userNote[avatar]}" alt="" width="60px" height="60px">
     </div>
     <div class="prf_titlenote">
       <a href="/profile/user?member={item[userNote]}">{userNote[name]}</a>
      <span class="note_new"> vừa viết lên tường </span>
        <br>
       <span class="titel_time">Vào lúc: {updateDate[1]} Ngày {updateDate[0]}</span>
     </div>
     <div class="prf_clear"> </div>
    <div class="title_detail">{writewall[content]}</div>
    <div class="prf_clear"></div>
    <div class="note_end"></div>
    <div class="prf_clear"></div>
    <?php 
      }else{
        $userComment= $social->user($item['userComment']);
     ?>
     <div class="pfr_avatar_wall">
       <img src="{userComment[avatar]}" alt="" width="60px" height="60px">
     </div>
     <div class="prf_titlenote">
       <a href="/profile/user?member={item[userComment]}">{userComment[name]}</a>
      <span class="note_new"> vừa viết lên tường nhà <a href="/profile/user?member={item[userNote]}">{userNote[name]}</a></span>
        <br>
       <span class="titel_time">Vào lúc: {updateDate[1]} Ngày {updateDate[0]}</span>
     </div>
     <div class="prf_clear"> </div>
    <div class="title_detail">{writewall[content]}</div>
    <div class="prf_clear"></div>
    <div class="note_end"></div>
    <div class="prf_clear"></div>
      <?php 
          }
        }  
       ?>


  {/each}
  </div>
  <?php 
    if($content){
      echo '<script>window.socialId='.$item['id'].';</script>';
      $row= $social->countRow($item['id']);
    }else $row=0;
   ?>

<!-- kết thúc 1 vòng view
 -->

 <div id="viewmore_content">
   <a  href="#" onclick="pzk_{data.id}.viewMoreContent(); return false;"><span id="count_content">Xem thêm >></span></a>
 </div>
</div>
<script>
var countRow= '<?php echo @$row ?>';

  $('#viewmore_content').hide();
    if(countRow>0)
    {
      $('#viewmore_content').show();
    }else{
      $('#viewmore_content').hide();
    }
</script>