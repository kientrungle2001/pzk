  
    <?php 
      $searchfriend='%'.pzk_session()->getSearchfriend().'%';

      $items=$data->viewSearch($searchfriend);

     ?>  
    {each $items as $item}
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
        <img src="{testAvatar}" alt="" width="80" height="80">
      </div>

      <div class="result_search_content" >
        <div>
          <a href="/user/profileusercontent?member={userid}" ><span>Tên: {name}</span></a>
        </div>
        <div>
          <a href="/user/profileusercontent?member={userid}" ><span>Nickname: {username}</span></a>
        </div>
        <div>
          <span>Bài viết: 0   |   Tham gia:ngày</span>
        </div>
        <div>
          <span>{testOnline}</span>
          <span>{testStatus}</span>
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
    
   
    
   
 
