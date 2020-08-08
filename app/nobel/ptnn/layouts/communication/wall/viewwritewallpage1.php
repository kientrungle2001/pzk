
 <?php 
    
  $member=pzk_request()->getMember();
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
<div class="prf_write_wall">
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
      <div class="prf_clear"> </div>
       
      </div>
    </div>
{/each} 

