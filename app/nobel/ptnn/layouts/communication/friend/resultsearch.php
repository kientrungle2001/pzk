
<div class="bank_area">
   <div class="content">
     <div id="view_result_search" class="prf_note" style="margin-bottom: 50px;">
    <?php 
      $searchfriend='%'.pzk_session()->getSearchfriend().'%';
      $items=$data->viewSearch($searchfriend);
      
     ?> 
    <div>
    <?php foreach($items as $user): ?>
    <?php 
        $testOnline=$user->testOnline($user->getId());
        $testStatus=$user->testStatus($user->getId());
        $date=$user->dateRegister($user->getRegistered());
        $learnPoint= $user->learnPoint($user->getId());
        $hieghtPoint=$user->hieghtPoint($user->getId());
        $sortPoint=$user->sortPoint($learnPoint, $hieghtPoint);
        $sortTrophies=$user->sortTrophies($learnPoint, $hieghtPoint);
     ?>

    <div class="prf_write_wall">
      <div class="pfr_avatar_wall">
        <img src="<?php echo $user->getavatar()?>" alt="" width="80" height="80">
      </div>

      <div class="result_search_content" >
        <div>
          <a href="<?php echo BASE_REQUEST; ?>/profile/user?member={user.getid()}" ><span class="title_name">Tên: {user.getname()}</span></a>
        </div>
        <div>
          <a href="<?php echo BASE_REQUEST; ?>/profile/user?member={user.getid()}" ><span class="title_name">Nickname: {user.getusername()}</span></a>
        </div>
        <div>
          <span class="titel_detail">Bài viết: 0   |   Tham gia:<?php echo $date ?></span>
        </div>
        <div>
          <span><?php echo $testOnline ?></span>
          <span><?php echo $testStatus ?></span>
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
      <div class="prf_clear"> </div>
       
      </div>

    <?php endforeach; ?>
    <div class="clearfix"></div>
    </div>
   
           
  

    </div>
    
    <div>
     Trang 
    <?php 
      $num_page=$data->numberPage($searchfriend);
      
      for($i=1; $i<= $num_page; $i++){
    ?>
     <a href="#" onclick="loadpage( <?php echo $i ?>)" > <?php echo $i; ?></a>
    <?php } ?>
    </div>
  
   </div>   

</div> 