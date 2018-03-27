<?php 
      //$member=$data->getUserId(); 
      $member= pzk_request('member'); 
      $user=_db()->getEntity('User.Account.User');  
      $items=$user->viewFriends($member);
      $pages=$data->arrPage($member);
  ?>   
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
<div class="prf_write_wall" >
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
          <span><a href="<?php echo BASE_REQUEST; ?>/friend/denyfriend?member={user.getid()}"><img src="<?php echo BASE_URL.'/default/skin/nobel/ptnn/media/huyketban.png' ; ?>" alt="Bạn bè"></a></span>
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