
 <?php 
    $member=pzk_request('member');
    $write_walls=$data->viewWriteWall($member);

  ?>
   {each $write_walls as $write_wall}
<div class="prf_write_wall">
       <div class="pfr_avatar_wall">
        <img src="
        <?php 
        $username=$write_wall['userwritewall'];
        $loadUserID=$data->loadUserID($username);
        $avatar=$loadUserID['avatar'];
        if($avatar !=''){
          echo $avatar;
        }else{
           echo BASE_URL.'/default/skin/nobel/ptnn/media/noavatar.gif' ;
          }
         ?>" alt="" width="60" height="60">
      </div>

     <div class="prf_titlenote" style="width:30%; height: auto; float:left;">
       <a href="/user/profile/user?member=<?php echo $loadUserID['userid']; ?>" >{write_wall[userwritewall]}</a>
         
      </div>
       <div class="prf_titlenote" style="width:30%; height: auto; float:left;">
        {write_wall[content]}    
       </div>
      <div class="prf_titlenote">
        {write_wall[datewrite]}   
      </div>
      <div class="prf_clear"> </div>
{/each}       
</div>

