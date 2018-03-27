
 

<link rel="stylesheet" href="<?php echo BASE_URL ?>/default/skin/nobel/ptnn/css/style.css">
<style>
  #profileuser
  {
      border-width: 1px;
      border-style: solid;
      border-color: #FF7357;
      width:100%; 
      height: auto;
      display: block;
  }
  .profile_user
  {
      margin-top:20px;  
      width:80%;
      height: 150px;
      margin-left:45px;  
      margin-right:30px; 
      border:1px dotted #FF7357;
     

  }
   .invitation_user
  {
      margin-top:20px;  
      width:80%;
      height: 150px;
      margin-left:45px;  
      margin-right:30px; 
      border:1px dotted #FF7357;
      

  }
  .avatar
  {
      margin-top:20px;  
      width:50%;
      height: 100px;
      border:1px dotted #FF7357 
  }
  .title
  {
    
      width:100%;
      height: 50px;
       
      border:1px dotted #FF7357;
  }
</style>
<?php 
$user=_db()->getEntity('user.user');
$user->loadWhere(array('username',pzk_session('username')));
//$items=_db()->useCB()->select('user.*')->from('user')->where(array('username',pzk_session('username')))->result_one();
$items=_db()->useCB()->select('count(*) as invi')->from('invitation')->where(array('userinvitation',pzk_session('username')))->result_one();

?>
<div id="profileuser" >

     <div class="profile_user" style="height: 50px;">
       <p align="center" style=" padding-top: 10px;"> Bạn có <a href="/user/listinvitation"><?php echo $items['invi']; ?> lời mời kết bạn</a></p>
     </div>
     <div class="profile_user" >

     <div style="float:left; padding-top: 20px;padding-bottom: 20px;padding-left: 20px;">
       <img src="<?php echo $user->get('avatar'); ?>"alt="" width="100px" height="100px"> 
     </div>
     <div>
       <p align="center"> <strong >xin chào <?php echo pzk_session('name'); ?></strong></p>
     </div>
        
     </div>
     <div class="profile_user" >
        <table>
          <tr>
            
            <td ><a href="/user/editinfor">Chỉnh sửa thông tin cá nhân</a></td>
          </tr>
          <tr>
            <td >
              <a href="/user/editavatar">Thay đổi avatar</a>
            </td>
          </tr>
          <tr>
            <td >
              <a href="/user/editsign">Thay đổi chữ ký</a>
            </td>
          </tr>
          <tr>
            <td >
              <a href="/user/changePassword">Thay đổi mật khẩu</a>
            </td>
          </tr>
          <tr>
            <td >
              <a href="/user/editinfor">Thay đổi thông tin cá nhân</a>
            </td>
          </tr>
          <tr>
            <td >
              <a href="/user/payment/payment">Nạp Tiền</a>
            </td>
          </tr>
          <tr>
            <td >
              <a href="/user/logout">Thoát</a>
            </td>
          </tr>
        </table>
     </div>
     <div class="profile_user" style="height: 600px;">
       <div class="title">
         <p align="center" style=" padding-top: 10px;">Danh sách bạn bè</p>
       </div>
       
       <div class="title" style="height: 450px;">
      <?php 

        //$friends=_db()->useCB()->select('friend.*')->from('friend')->where(array('username',pzk_session('username')))->result();
        $sql="select * from `friend` where username='".pzk_session('username')."' order by id asc limit 0,3 ";
        $friend= _db()->query($sql);
        //$friends=_db()->useCB()->select('friend.*')->from('friend')->where(array('username',pzk_session('username')))->result();  
         // $friend=_db()->getEntity('user.friend');
          //$friend->loadWhere(array('username',pzk_session('username')));
      
          foreach ($friend as $items) { 
           
           ?>
        <div style="clear: both;">  
        <div style="float:left; padding-top: 20px;padding-bottom: 20px;padding-left: 20px;">
            <img src="<?php echo BASE_URL.'/3rdparty/uploads/img/noavatar.gif' ; ?>"alt="" width="80px" height="80px"> 
        </div>
        <div>
            <p align="center"><a href="/user/profilefriend?member=<?php echo $items['userfriend']; ?> "> <strong ><?php echo $items['userfriend']; ?></strong></a></p>
        </div>
        </div>    
        <?php  }  ?> 
        <div style="float:right;clear: both;">
          <a href="/user/friendlist">Xem hết >></a>
        </div> 
       </div>
       <div class="title">
          <form method="post" action="/User/searchPost" >
            <input style="width: 200px;"type="text" name="searchfriend"placeholder="Tìm kiếm bạn bè" id="searchfriend" value="">
            <button type="submit" class="login-button">Tìm kiếm</button>
          </form>
       </div>
     </div>              
        
 </div> 
                