 
 <div class="listinvitation" >
 <div style="width: 40%;"class="layout_title">DANH SÁCH LỜI MỜI KẾT BẠN</div>
 <div class="clear"></div>
 <?php
    $user=_db()->getEntity('User.Account.User');     
    $invi= $user->countInvitation();

    if($invi==0){
  ?>
 <div class="note_invi">Bạn không có lời mời kết bạn nào</div>
 <?php } ?>
      <?php 
        $items=$user->viewInvitation();
       
      ?>
      {each $items as $user}
      <?php 
        $date=$user->dateRegister($user->getRegistered());
        $learnPoint= $user->learnPoint($user->getId());
        $hieghtPoint=$user->hieghtPoint($user->getId());
        $sortPoint=$user->sortPoint($learnPoint, $hieghtPoint);
        $sortTrophies=$user->sortTrophies($learnPoint, $hieghtPoint);
        
     ?>
     <div class="list_invitation_row">
      <div class="invi_avatar">
        <img src="{user.get('avatar')}" alt="" width="80" height="80">
      </div>

      <div class="invi_content" >
        <div>
          <a href="/profile/user?member={user.get('id')}" ><span>Tên: {user.get('name')}</span></a>
        </div>
        <div>
          <a href="/profile/user?member={user.get('id')}" ><span>Nickname: {user.get('username')}</span></a>
        </div>
        <div>
          <span class="titel_detail">Bài viết: 0   |   Tham gia:{date}</span>
        </div>
        <div>
          <span><a href="{url /invitation/agree}?member={user.get('id')}"><img src="<?php echo BASE_URL.'/default/skin/nobel/ptnn/media/pr_bt_ketban.png' ; ?>" alt="Kết bạn"></a></span>
          <span><a href="{url /invitation/deny}?member={user.get('id')}"><img src="<?php echo BASE_URL.'/default/skin/nobel/ptnn/media/huyketban.png' ; ?>" alt="Hủy Kết bạn"></a></span>
        </div>
      </div>
       
      <div class="result_search_mark" >
        <div>
          <span>• Danh hiệu: {sortTrophies}</span>
        </div>
        <div>
          <span>• Điểm thành tích: {hieghtPoint}</span>
        </div> 
        <div>
          <span>• Sổ học bạ: {sortPoint}</span>
        </div>
        <div>
          <span>• Điểm học bạ: {learnPoint}</span>
        </div>
        
      </div>
      <div class="clear"> </div>
       
      </div>
  {/each}
    
 


 </div>