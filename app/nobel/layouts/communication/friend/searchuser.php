  
    <?php 
      $searchfriend='%'.pzk_session()->getSearchfriend().'%';

      $items=$data->viewSearch($searchfriend);

     ?>  
    <?php foreach($items as $item): ?>
    <?php 
        $avatar=$item['avatar'];
        $username=$item['username'];
        $userid=$item['id'];
        $name=$item['name'];
        $testAvatar=$data->testAvatar($avatar);
        $testOnline=$data->testOnline($userid);
        $testStatus=$data->testStatus($userid);
     ?>

    <div class="prf_write_wall">
      <div class="pfr_avatar_wall">
        <img src="<?php echo $testAvatar ?>" alt="" width="80" height="80">
      </div>

      <div class="result_search_content" >
        <div>
          <a href="/user/profileusercontent?member=<?php echo $userid ?>" ><span>Tên: <?php echo $name ?></span></a>
        </div>
        <div>
          <a href="/user/profileusercontent?member=<?php echo $userid ?>" ><span>Nickname: <?php echo $username ?></span></a>
        </div>
        <div>
          <span>Bài viết: 0   |   Tham gia:ngày</span>
        </div>
        <div>
          <span><?php echo $testOnline ?></span>
          <span><?php echo $testStatus ?></span>
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
    <?php endforeach; ?>
    
   
    
   
 
