<?php 
      //$member=$data->getUserId(); 
      $member= pzk_request()->getMember(); 
      $user=_db()->getEntity('User.Account.User');  
      $items=$user->viewFriends($member);
      $pages=$data->arrPage($member);
  ?>   
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
<div class="prf_write_wall" >
 <div class="pfr_avatar_wall">
        <img src="<?php echo $user->get('avatar')?>" alt="" width="80" height="80">
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
          <span><a href="<?php echo BASE_REQUEST; ?>/friend/denyfriend?member={user.getid()}"><img src="<?php echo BASE_URL.'/default/skin/nobel/ptnn/media/huyketban.png' ; ?>" alt="Bạn bè"></a></span>
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