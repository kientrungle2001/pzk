
<div id="div_view_write_wall">
    <div class="prf_hello">Chào mừng bạn đã ghé thăm góc học tập của tôi</div>

    <div class="prf_title" style="width:30%; margin-bottom: 30px;">Viết lên tường</div>
    <?php 
        $member=pzk_request()->getMember();

        $avatar1= pzk_session('avatar');
        $usercomm= pzk_session('username');
        $usercommId= pzk_session('userId');
        $datetime= date("Y-m-d H:i:s");
    ?>
    <div class="clearfix">
      <textarea id="viewall_post_wall" style="border:1px solid #cecece; min-height:110px;width:100%;" placeholder="Nhập nội dung... " rel="false"></textarea>
      <input type="button" style="width:50px;float:left;color:black; margin-bottom: 10px;" onclick="pzk_{data.id}.viewWall('{avatar1}','{usercommId}','{usercomm}','{member}','{datetime}');" class="pne_st1_r_file_bt" name="send" value="Gửi">
      
    </div>
    
    <div id="viewall_write_wall" class="prf_note" style="margin-bottom: 50px;">
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
    </div>
   
    <div>
     
    <?php
      $check =$entt->checkPage($i); 
      $pages= $entt->arrPage($i,$member);
    ?>
    {each $pages as $page}
     <a href="#" onclick="pzk_{data.id}.loadpage({page}, {member})" >{page}</a>
    {/each}
    </div>
  </div>