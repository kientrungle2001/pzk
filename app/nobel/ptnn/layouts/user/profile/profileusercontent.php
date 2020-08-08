
<?php 
  $member= pzk_request()->getMember();
  $ettUser= _db()->getEntity('User.Account.User');
  $quanttMess=$ettUser->countMessage();  
?>
<div class="prffriend_right">
    <div class="prf_hello">Chào mừng bạn đã ghé thăm góc học tập của tôi</div>
    <div class="prf_clear" style="width: 100%; height: 30px;"></div>
    <div class="request">Bạn có <a href="/profile/message?message={quanttMess}">{quanttMess}</a> thông báo mới</div>
    <div class="prf_title" style="width:30%;">Ghi chép cá nhân</div>
    <div class="prf_note">
      <?php 
        
        $user_note=_db()->getEntity('communication.user_note'); 
        $notes=$user_note->loadNote($member);    
        //$notes=$data->loadNote($member);
        //$checkNote= $data->checkNote($member);
        $i=0;
      ?>
      {each $notes as $note}
      <?php
        $i++; 
        $countComment=$user_note->countComment($note->getId());
        $date= $user_note->formatDate($note->getDatenote());
       ?>
     <div id="listnote{note.get('id')}">
      <div style="float:left;">
        <img src="/default/skin/nobel/ptnn/media/usernote.png" alt="">
      </div>
    <div class="prf_titlenote">
      <a href="/note/detailnote?member={member}&id={note.get('id')}">{note.gettitlenote()}</a>

    </div>
    <div style="float:right;"><a href="javascript:;" class="black" title="Xoá" onclick="pzk_{data.id}.delNote({note.get('id')});">[Xoá]</a></div>
    <div class="prf_clear1">
      <span class="titel_detail1">Bình luận: {countComment}  |   Vào lúc: {date[1]} Ngày {date[0]} </span>
    </div>

      </div>
      {/each}      
     
    <div class="prf_clear"></div>
      <?php $user_note->checkNote($member,$i); ?>
    </div>
          
    <div class="prf_clear" style="width: 100%; height: 60px;"></div>
    <div class="prf_title" style="width:30%; margin-bottom: 30px;">Viết lên tường</div>
  <?php       
        $datetime= date("Y-m-d H:i:s");
        $avatar1= pzk_session('avatar');
        $usercomm= pzk_session('username');
        $usercommId= pzk_session('userId');
      ?>
    
    <div class="prf_clear" style="width: 100%; height: 50px; margin-bottom: 100px;">
      <textarea id="pr_post_wall" style="border:1px solid #cecece; min-height:110px;width:100%;" required="required" placeholder="Nhập nội dung... " rel="false"></textarea>
      <input type="button" class="btn btn-primary" onclick="pzk_{data.id}.PostComment('{avatar1}','{usercommId}', '{usercomm}','{member}','{datetime}');" id="prfwrite_wall" name="send" value=" Gửi ">
      
    </div>
    
    <div id="prf_comment_wall" class="prf_note" style="margin-bottom: 50px;">
        <div></div>
    <?php
      $entt= _db()->getEntity('communication.user_write_wall');      
      $write_walls=$entt->loadWriteWall($member);
      $i=0;
      ?>
      {each $write_walls as $write_wall}
      <?php
         $i++;
         $loadUserID = $entt->loadUserID($write_wall['userWrite']);
         $usernameWrite=$loadUserID['username'];
         $avatar= $entt->checkAvatar($loadUserID['avatar']);
    ?>
    <div>
    <div id="listwrite{write_wall[id]}" class="prf_write_wall">
      <div class="pfr_avatar_wall">
        <img src="{avatar}" alt="" width="60" height="60">
      </div>
      <div class="prf_titlenote">
       <a href="/profile/user?member={write_wall[userWrite]}" >{usernameWrite} :</a>
         
      </div>
      <div class="titel_detail">
        {write_wall[content]}    
       </div>
      <div class="titel_time">   Được viết lúc: 
        {write_wall[datewrite]}   
      </div>
      <div style="float:right;"><a href="javascript:;" class="black" title="Xoá" onclick="pzk_{data.id}.delWrite({write_wall[id]});">[Xoá]</a></div>
      <div class="prf_clear"> </div>
       
      </div>
    </div>
    {/each}
    
    <?php $check= $entt->checkWall($i,$member); ?>

    </div>

  </div>

 
