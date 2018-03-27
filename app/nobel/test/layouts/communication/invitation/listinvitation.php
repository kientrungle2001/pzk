 
 <div class="listinvitation" >
 <div style="width: 40%;"class="layout_title">DANH SÁCH LỜI MỜI KẾT BẠN</div>
 <div class="clear"></div>
 <?php 
    $invi= $data->countinvi();
    if($invi['count']==0){
  ?>
 <div class="note_invi">Bạn không có lời mời kết bạn nào</div>
 <?php } ?>
      <?php 
        $items=$data->viewListInvitation();
       
      ?>
      {each $items as $item}
      <?php 
        $username=$item['username'];
        $user=$data->loadUserId($username);
        $avatar=$user['avatar'];
        
        $userid=$user['userid'];

        $name=$user['name'];
        $testAvatar=$data->testAvatar($avatar);
        //$testOnline=$data->testOnline($userid);
        
     ?>
     <div class="list_invitation_row">
      <div class="invi_avatar">
        <img src="{testAvatar}" alt="" width="80" height="80">
      </div>

      <div class="invi_content" >
        <div>
          <a href="/profile/profileusercontent?member={userid}" ><span>Tên: {name}</span></a>
        </div>
        <div>
          <a href="/profile/profileusercontent?member={userid}" ><span>Nickname: {userfriend}</span></a>
        </div>
        <div>
          <span>Bài viết: 0   |   Tham gia:ngày</span>
        </div>
        <div>
          <span><a href="{url /invitation/agree}?userinvitation={username}"><img src="<?php echo BASE_URL.'/3rdparty/uploads/img/pr_bt_ketban.png' ; ?>" alt="Kết bạn"></a></span>
          <span><a href="{url /invitation/deny}?userinvitation={username}"><img src="<?php echo BASE_URL.'/3rdparty/uploads/img/huyketban.png' ; ?>" alt="Hủy Kết bạn"></a></span>
        </div>
      </div>
       
      <div class="invi_extra" >
        <div>
          <span>• Danh hiệu:</span>
        </div>
        <div>
          <span>• Điểm thành tích:</span>
        </div> 
        <div>
          <span>• Sổ học bạ:</span>
        </div>
        <div>
          <span>• Điểm học bạ:</span>
        </div>
        
      </div>
      <div class="clear"> </div>
       
      </div>
  {/each}
    
 


 </div>