 
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
      <?php foreach($items as $user): ?>
      <?php 
        $date=$user->dateRegister($user->getRegistered());
        $learnPoint= $user->learnPoint($user->getId());
        $hieghtPoint=$user->hieghtPoint($user->getId());
        $sortPoint=$user->sortPoint($learnPoint, $hieghtPoint);
        $sortTrophies=$user->sortTrophies($learnPoint, $hieghtPoint);
        
     ?>
     <div class="list_invitation_row">
      <div class="invi_avatar">
        <img src="<?php echo $user->getavatar()?>" alt="" width="80" height="80">
      </div>

      <div class="invi_content" >
        <div>
          <a href="/profile/user?member=<?php echo $user->getId()?>" ><span>Tên: <?php echo $user->getName()?></span></a>
        </div>
        <div>
          <a href="/profile/user?member=<?php echo $user->getId()?>" ><span>Nickname: <?php echo $user->getUsername()?></span></a>
        </div>
        <div>
          <span class="titel_detail">Bài viết: 0   |   Tham gia:<?php echo $date ?></span>
        </div>
        <div>
          <span><a href="<?php echo BASE_REQUEST . '/invitation/agree' ?>?member=<?php echo $user->getId()?>"><img src="<?php echo BASE_URL.'/default/skin/nobel/ptnn/media/pr_bt_ketban.png' ; ?>" alt="Kết bạn"></a></span>
          <span><a href="<?php echo BASE_REQUEST . '/invitation/deny' ?>?member=<?php echo $user->getId()?>"><img src="<?php echo BASE_URL.'/default/skin/nobel/ptnn/media/huyketban.png' ; ?>" alt="Hủy Kết bạn"></a></span>
        </div>
      </div>
       
      <div class="result_search_mark" >
        <div>
          <span>• Danh hiệu: <?php echo $sortTrophies ?></span>
        </div>
        <div>
          <span>• Điểm thành tích: <?php echo $hieghtPoint ?></span>
        </div> 
        <div>
          <span>• Sổ học bạ: <?php echo $sortPoint ?></span>
        </div>
        <div>
          <span>• Điểm học bạ: <?php echo $learnPoint ?></span>
        </div>
        
      </div>
      <div class="clear"> </div>
       
      </div>
  <?php endforeach; ?>
    
 


 </div>