
<div class="bank_area">
   <div class="content">
     <div id="view_result_search" class="prf_note" style="margin-bottom: 50px;">
    <?php 
      $searchfriend='%'.pzk_session('searchfriend').'%';
      $items=$data->viewSearch($searchfriend);
      
     ?> 
    <div>
    {each $items as $user}
    <?php 
        $testOnline=$user->testOnline($user->get('id'));
        $testStatus=$user->testStatus($user->get('id'));
        $date=$user->dateRegister($user->getRegistered());
        $learnPoint= $user->learnPoint($user->get('id'));
        $hieghtPoint=$user->hieghtPoint($user->get('id'));
        $sortPoint=$user->sortPoint($learnPoint, $hieghtPoint);
        $sortTrophies=$user->sortTrophies($learnPoint, $hieghtPoint);
     ?>

    <div class="prf_write_wall">
      <div class="pfr_avatar_wall">
        <img src="{user.get('avatar')}" alt="" width="80" height="80">
      </div>

      <div class="result_search_content" >
        <div>
          <a href="<?php echo BASE_REQUEST; ?>/profile/user?member={user.getid()}" ><span class="title_name">Tên: {user.getname()}</span></a>
        </div>
        <div>
          <a href="<?php echo BASE_REQUEST; ?>/profile/user?member={user.getid()}" ><span class="title_name">Nickname: {user.getusername()}</span></a>
        </div>
        <div>
          <span class="titel_detail">Bài viết: 0   |   Tham gia:{date}</span>
        </div>
        <div>
          <span>{testOnline}</span>
          <span>{testStatus}</span>
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
      <div class="prf_clear"> </div>
       
      </div>

    {/each}
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