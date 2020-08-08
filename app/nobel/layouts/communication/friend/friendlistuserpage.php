

 <?php 
      $member=pzk_request()->getMember();
     // $member=99;

      $items=$data->viewListFriend($member);
    
 ?>  
  
   

  {each $items as $item}
    <?php 
        $userfriend=$item['userfriend'];
        $user=$data->loadUserId($userfriend);
        $avatar=$user['avatar'];
        
        $userid=$user['userid'];

        $name=$user['name'];
        $testAvatar=$data->testAvatar($avatar);
        $testOnline=$data->testOnline($userid);
        
     ?>
  
<div class="prf_write_wall">
      <div class="pfr_avatar_wall">
        <img src="{testAvatar}" alt="" width="80" height="80">
      </div>

      <div class="result_search_content" >
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
          <span>{testOnline}</span>
          <span><a href="/friend/denyfriend?member={userid}"><img src="<?php echo BASE_URL.'/3rdparty/uploads/img/huyketban.png' ; ?>" alt="Bạn bè"></a></span>
        </div>
      </div>
       
      <div class="result_search_mark" >
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
      <div class="prf_clear"> </div>
       
      </div>
  {/each}