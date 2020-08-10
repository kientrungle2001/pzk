
<div id="div_view_write_wall">
    <div class="prf_hello">Chào mừng bạn đã ghé thăm góc học tập của tôi</div>

    <div class="prf_title" style="width:30%; margin-bottom: 30px;">Viết lên tường</div>
    <?php 
        $member=pzk_request()->getMember();

        $avatar1= pzk_session()->getAvatar();
        $usercomm= pzk_session()->getUsername();
        $usercommId= pzk_session()->getUserId();
        $datetime= date("Y-m-d H:i:s");
    ?>
    <div class="clearfix">
      <textarea id="viewall_post_wall1" style="border:1px solid #cecece; min-height:110px;width:100%;" placeholder="Nhập nội dung... " rel="false"></textarea>
      <input type="button" style="width:50px;float:left;color:black; margin-bottom: 10px;" onclick="pzk_<?php echo @$data->id?>.viewWall1('<?php echo $avatar1 ?>','<?php echo $usercommId ?>','<?php echo $usercomm ?>','<?php echo $member ?>','<?php echo $datetime ?>');" class="pne_st1_r_file_bt" name="send" value="Gửi">
      
    </div>
    
    <div id="viewall_write_wall1" class="prf_note" style="margin-bottom: 50px;">
     <div></div>
      <?php
      $entt= _db()->getEntity('communication.user_write_wall');      
      $write_walls=$entt->loadWriteWall($member);
      $i=0;
      ?>
      <?php foreach($write_walls as $write_wall): ?>
      <?php
         $i++;
         $loadUserID = $entt->loadUserID($write_wall['userWrite']);
         $usernameWrite=$loadUserID['username'];
         $avatar= $entt->checkAvatar($loadUserID['avatar']);
    ?>
    <div>
    
    <div class="prf_write_wall">
      <div class="pfr_avatar_wall">
        <img src="<?php echo $avatar ?>" alt="" width="60" height="60">
      </div>
      <div class="prf_titlenote">
       <a href="/profile/user?member=<?php echo @$write_wall['userWrite']?>" ><?php echo $usernameWrite ?> :</a>
         
      </div>
      <div class="titel_detail">
        <?php echo @$write_wall['content']?>    
       </div>
      <div class="titel_time">   Được viết lúc: 
        <?php echo @$write_wall['datewrite']?>   
      </div>
      
      <div class="prf_clear"> </div>
       
      </div>
    </div>
    <?php endforeach; ?>
    </div>
   
    <div>
     
    <?php
      $check =$entt->checkPage($i); 
      $pages= $entt->arrPage($i,$member);
    ?>
    <?php foreach($pages as $page): ?>
     <a href="#" onclick="pzk_<?php echo @$data->id?>.loadpage1(<?php echo $page ?>, <?php echo $member ?>)" ><?php echo $page ?></a>
    <?php endforeach; ?>
    </div>
  </div>