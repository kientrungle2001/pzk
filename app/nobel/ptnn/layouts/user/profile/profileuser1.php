
<?php 
  if(pzk_session('username')){
  // Load user
  $request=pzk_request();
  $member= $request->getMember();
  if(!$member){
    $member=pzk_session('userId');
  }
  $user = null;
  if($member == pzk_session()->getUserId()) {
  	$user = pzk_user();
  } else {
  	$user= _db()->getEntity('User.Account.User')->load($member);
  }
  //$userId=$user->get('id');
  $username=$user->get('username');
  $countInvi= $user->countInvitation();
  $avatar=$user->get('avatar');
  $dateVip= $user->CheckDate('1',$member);
  $learnPoint= $user->learnPoint($member);
  $sex= $user->checkSex($user->get('sex'));
  $hieghtPoint=$user->hieghtPoint($member);
  $sortPoint=$user->sortPoint($learnPoint, $hieghtPoint);
  $sortTrophies=$user->sortTrophies($learnPoint, $hieghtPoint);
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
    <div class="line"><span class="text_infor_user"><strong>{dateVip}</strong></span></div>
    <div class="line"><span class="text_infor_user">Danh hiệu: <strong>{sortTrophies}</strong></span></div>
    <div class="line"><span class="text_infor_user">Giới tính: <strong>{sex}</strong></span></div>
    <div class="line"><span class="text_infor_user">Sinh nhật: <strong>{user.get('birthday')}</strong></span></div>
    <div class="line"><span class="text_infor_user">Địa chỉ: <strong>{user.get('address')}</strong></span></div>
    <div class="line"><span class="text_infor_user">Sổ học bạ: <strong>{sortPoint}</strong></span></div>
    <div class="line"><span class="text_infor_user">Điểm thành tích:<strong>{hieghtPoint}</strong></span></div>
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
   
    ?>
  <div class="friend_list">
    <div class="prf_friend_title">
      <span style="color:#00adef;" class="glyphicon glyphicon-asterisk"></span>
      <span class="prf_text_title">Danh sách bạn bè</span><br>
      
      <span class="count_friend">(Có {friend} bạn bè)</span> <br>
    </div>
    <?php 
          $friends= $user->getFriends();
          foreach ($friends as $friend) { 
           $userfriend=$friend->get('username');
           $avatar_friend=$friend->get('avatar');
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
      <a class="prf_a" href="/favorite/lessonfavoritemember?member={member}">Bài học yêu thích</a>
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