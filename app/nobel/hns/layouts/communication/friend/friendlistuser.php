
<style>

  #friend_list_user
 {
  width: 100%;
  height: auto;
  
  float: left;

 } 
 
 .prf_title
 {
  width: 100%;
  float: left;
  background-color: #008000;
  height: 30px;
  font-size: 10pt;
  text-align: center;
  color: #fff;
  margin: 10px 0;
 } 

 .prf_clear
 {
  padding-bottom: 20px;
 clear: both;
 color: #57970F;

 } 
 

 .prf_note
 {
  clear: both;
  height: auto;
  width: 100%;
 }
.result_search_content
{
  float: left;

font-weight: bold;
color: #0081a1;
font-size: 12px;
width: 40%;
height: auto;

}
.result_search_mark
{
  float: right;

font-weight: bold;
color: #0081a1;
font-size: 12px;
width: 30%;
height: auto;

}
.pr_bt_viewmore_c { margin-left: 20px; height:21px; float:left; background: url("http://ptnn.vn/3rdparty/uploads/img/btt.png") 0px -28px  repeat-x ; text-transform:uppercase; color:#757575; font-size:11px; font-family:Tahoma, sans-serif; font-weight:bold; padding:7px 6px 0 0; padding-top:8px; height:20px ;}

.pfr_avatar_wall
{

  
  width: 30%;
  height: auto;float: left;
  
}
.prf_write_wall
{
  
 width: 97%;
  margin: 10px 10px 10px 10px ;
  height:auto;
  border:1px dotted #8FBC8F;
}
</style>


<div id="friend_list_user">
   
    
    <div id="view_friend_list" class="prf_note" style="margin-bottom: 50px;">
  <?php 
      $member=$data->getUserId();
    
      $items=$data->viewListFriend($member);
     ?>  
  
   
    <div>
   <?php foreach($items as $item): ?>
    <?php 
        $userfriend=$item['userfriend'];
        $user=$data->loadUserId($userfriend);
        $avatar=$user['avatar'];
        
        $userid=$user['userid'];

        $name=$user['name'];
        $testAvatar=$data->testAvatar($avatar);
        $testOnline=$data->testOnline($userid);
        
     ?>
  
    <div class="prf_write_wall">
      <div class="pfr_avatar_wall">
        <img src="<?php echo $testAvatar ?>" alt="" width="80" height="80">
      </div>

      <div class="result_search_content" >
        <div>
          <a href="/profile/profileusercontent?member=<?php echo $userid ?>" ><span>Tên: <?php echo $name ?></span></a>
        </div>
        <div>
          <a href="/profile/profileusercontent?member=<?php echo $userid ?>" ><span>Nickname: <?php echo $userfriend ?></span></a>
        </div>
        <div>
          <span>Bài viết: 0   |   Tham gia:ngày</span>
        </div>
        <div>
          <span><?php echo $testOnline ?></span>
          <span><a href="/friend/denyfriend?member=<?php echo $userid ?>"><img src="<?php echo BASE_URL.'/3rdparty/uploads/img/huyketban.png' ; ?>" alt="Bạn bè"></a></span>
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
    
    </div>
   
           
  

    </div>
    
    <div>
     Trang 
    <?php 
      $num_page=$data->numberPage($member);
      //$num_page= $data->numberPage($member);
      for($i=1; $i<= $num_page; $i++){
    ?>
     <a href="#" onclick="loadpage( <?php echo $i ?>)" > <?php echo $i; ?></a>
    <?php } ?>
    </div>
  <script>
   
    function loadpage(page){
      current_page= page;
      
      $.ajax({
        type:"POST",
        data:{
          page: current_page,
          member:'<?php echo $member; ?>'
        },
        url:'/friend/friendlistuserpage',
        success: function(msg){
          //alert(msg);
          $('#view_friend_list').html(msg);
        }

      });
   }
  </script>

</div> <!-- end div id= friend_list_user-->