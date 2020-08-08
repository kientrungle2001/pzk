
 


<style>

</style>
<?php 
$request=pzk_request();
$member=$request->getMember();
$user=_db()->getEntity('User.User');
$user->loadWhere(array('username',$member));

//$items=_db()->useCB()->select('user.*')->from('user')->where(array('username',$username))->result_one();
$items=_db()->useCB()->select('count(*) as friend')->from('friend')->where(array('username',$member))->result_one();

?>
<div id="profileuser" >

     <div class="profile_user" style="height: 50px;">
       <p align="center" style=" padding-top: 10px;"> Bạn có <a href="/user/friendlistmember?member=<?php echo $member; ?>"><?php echo $items['friend']; ?> bạn bè </a></p>
     </div>

    
     <div class="profile_user" style="height: 600px;">
       <div class="title">
         <p align="center" style=" padding-top: 10px;">Danh sách bạn bè</p>
       </div>
       
       <div class="title" style="height: 450px;">
      <?php 

        //$friends=_db()->useCB()->select('friend.*')->from('friend')->where(array('username',$username))->result();
        $sql="select * from `friend` where username='".$member."'  order by id asc limit 0,3 ";
        $friend= _db()->query($sql);
        //$friends=_db()->useCB()->select('friend.*')->from('friend')->where(array('username',$username))->result();  
         // $friend=_db()->getEntity('user.friend');
          //$friend->loadWhere(array('username',$username));
      
          foreach ($friend as $items) { 
           
           ?>
        <div style="clear: both;"> 

        <div class="avatarfriend" >
            <img src="<?php echo BASE_URL.'/3rdparty/uploads/img/noavatar.gif' ; ?>"alt="" width="80px" height="80px"> 
        </div>
        <div>
            <p align="center"><a href="/user/profilefriend?member=<?php echo $items['userfriend']; ?> "> <strong ><?php echo $items['userfriend']; ?></strong></a></p>
        </div>
        </div>    
        <?php  }  ?> 
        <div style="float:right;clear: both;">
          <a href="/user/friendlistmember?member=<?php echo $member; ?> ">Xem hết >></a>
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
                