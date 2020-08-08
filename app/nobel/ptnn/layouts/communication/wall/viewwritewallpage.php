
  <?php 
        $member=pzk_request()->getMember();

        $avatar1= pzk_session('avatar');
        $usercomm= pzk_session('username');
        $datetime= date("Y-m-d H:i:s");
  ?>

  <?php
      $entt= _db()->getEntity('communication.user_write_wall');      
      $write_walls=$entt->loadWriteWall($member);

      ?>
      {each $write_walls as $write_wall}
      <?php
        
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
      <div style="float:right;"><a href="javascript:;" class="black" title="Xoá" onclick="pzk_{data.id}.delWrite({write_wall[id]});">[Xoá]</a></div>
      <div class="prf_clear"> </div>
       
      </div>
    </div>
{/each} 

