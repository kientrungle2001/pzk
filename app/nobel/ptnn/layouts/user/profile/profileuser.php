
<?php 
  if(pzk_session()->getUsername()){
  // Load user
  $request=pzk_request();
  $member= $request->getMember();
  if(!$member){
    $member=pzk_session()->getUserId();
  }
  $user = null;
  if($member == pzk_session()->getUserId()) {
  	$user = pzk_user();
  } else {
  	$user= _db()->getEntity('User.Account.User')->load($member);
  }
  //$userId=$user->getId();
  $username=$user->getUsername();
  $countInvi= $user->countInvitation();
  $avatar=$user->getAvatar();
  $dateVip= $user->CheckDate('1',$member);
  $checkMember=$user->checkMember($dateVip);
  $learnPoint= $user->learnPoint($member);
  $sex= $user->checkSex($user->getSex());
  $hieghtPoint=$user->hieghtPoint($member);
  $sortPoint=$user->sortPoint($learnPoint, $hieghtPoint);
  $sortTrophies=$user->sortTrophies($learnPoint, $hieghtPoint);
  $checkTrophies=$user->checkTrophies($sortTrophies);
?>
<div id="profileuser">
  
  <div class="infor_user">
    
      <div class="infor_user1" ><span style="font-size:35px;" class="glyphicon glyphicon-star"></span></div>
      <div class="infor_user2">
        <a href="/profile/user?member={member}">{user.get('username')}</a>
      </div>
   
    <div class="avatar_user">
      <img style="border-radius:10%" src="{avatar}" alt="" width="115px" height="115px">
    </div>
    <div class="clear"></div>
    <div class="line"><span class="text_infor_user"><strong>{checkMember}</strong></span></div>
    <div class="line"><span class="text_infor_user">Danh hiệu: <strong>{sortTrophies}</strong></span></div>
    <div class="line"><span class="text_infor_user">Giới tính: <strong>{sex}</strong></span></div>
    <div class="line"><span class="text_infor_user">Sinh nhật: <strong>{user.get('birthday')}</strong></span></div>
    <div class="line"><span class="text_infor_user">Địa chỉ: <strong>{user.get('address')}</strong></span></div>
    <div class="line"><span class="text_infor_user">Sổ học bạ: <strong>{sortPoint}</strong></span></div>
    <div class="line"><span class="text_infor_user">Điểm thành tích:<strong>{hieghtPoint}</strong></span></div>
    <!-- <div class="line"><span class="text_infor_user">Biểu đồ phát triển</strong></span></div>
    <div class="grow_map"> </div> -->
  </div>
  <div class="tamp"></div>
  
  <div class="friend_list">
    <div class="prf_friend_title">
      <span style="color:#00adef;" class="glyphicon glyphicon-asterisk"></span>
      <span class="prf_text_title">Quản trị</span><br>
    </div>
    
    <?php 
      $user->checkIdFB();
      $user->checkIdG();
      /*$checkFb=$data->checkIdFacebook($member);
      $checkG=$data->checkIdGoogle($member);*/
     ?>
    <div class="prf_friend" style="height: 45px;">
      <a class="userfriend" href="/profile/editinfor?member={member}">Sửa thông tin cá nhân</a>
    </div>
    <div class="prf_friend" style="height: 45px;">
      <a class="userfriend" href="/profile/changePassword?member={member}">Thay đổi mật khẩu</a>
    </div>
    <div class="prf_friend" style="height: 45px;">
      <a class="userfriend" href="/profile/editavatar?member={member}">Thay đổi avatar</a>
    </div>
  </div>


  <div class="tamp"></div>
  <div class="notebook">
    <div class="prf_text_title" style="padding-left:10px;">
      <span style="color:#00adef;" class="glyphicon glyphicon-asterisk"></span>
      <span class="prf_text_title">Vở bài tập</span>
    </div>
    <div class="prf_img"> <img src="<?php echo BASE_URL; ?>/default/skin/nobel/ptnn/media/address_book.ico" alt="" width="100px" height="100px"></div>
  </div>
  <div class="tamp"></div>

   <?php 
   $friend=$user->countFriend($member);
   $countInvi= $user->countInvitation();
    ?>
  <div class="friend_list">
    <div class="prf_friend_title">
      <span style="color:#00adef;" class="glyphicon glyphicon-asterisk"></span>
      <span class="prf_text_title">Danh sách bạn bè</span><br>
      <a href="/invitation/list" title=""><span class="count_friend">(Có {countInvi} lời mời kết bạn)</span></a> <br>
      <span class="count_friend">(Có {friend} bạn bè)</span> <br>
    </div>
    <?php 
          $friends= $user->getFriends();
          foreach ($friends as $friend) { 
           $userfriend=$friend->getUsername();
           $avatar_friend=$friend->getAvatar();
      ?>
    <div class="prf_friend">
      <div class="prf_avatar_friend">
        <a href="/profile/user?member={friend.get('id')}">
          <img style="border-radius:6%" src="{avatar_friend}" alt="" width="60px" height="60px">
        </a>
        
      </div>
      <div class="prf_name_friend">
      <a class="userfriend" href="/profile/user?member={friend.get('id')}">{userfriend}</a>
      </div>
    </div>
    <?php } ?>
    
    <div class="prf_friend_more">
      <div style=" float:right;"><a style="color: #fefeff;" href="/friend/list?member={member}">Xem tiếp >></a></div>
    </div>
  </div>

  <div class="tamp"></div>
  <div class="notebook">
  <div class="prf_text_title" style="padding-left:10px;">
      <span style="color:#00adef;" class="glyphicon glyphicon-asterisk"></span>
      <span class="prf_text_title">Tìm kiếm bạn bè</span>
  </div>
  <div class="profile_search">
        <form method="post" action="/Friend/searchPost" >
            <input type="text" name="searchfriend"placeholder="Tìm kiếm bạn bè" id="searchfriend" value="">
            <button type="submit" class="search-button">Tìm kiếm</button>
        </form>
  </div>
  </div>

  <div class="tamp"></div>


  <div class="learning_user">
    <div class="prf_text_title" style="padding-left:10px; height:40px;" >
      <span style="color:#ed008c;" class="glyphicon glyphicon-heart-empty"></span>
      <span style="color:#802890;" >Góc học tập</span>
    </div>
    
    <div class="prf_lesson_list">
      <a class="prf_a" href="/favorite/lessonfavorite?member={member}">Bài học yêu thích</a>
    </div>
    <div class="prf_lesson_list">
      <a class="prf_a" href="/favorite/lessonhistory?member={member}">Lịch sử học tập</a>
    </div>
    <div class="prf_lesson_list">
      <a class="prf_a" href="">Điểm thành tích</a>
    </div>

  </div>
</div>
<?php } ?>