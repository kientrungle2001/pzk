<style>
 #profilefriend
 {
  width: 100%;
  height: 800px;
  
  float: left;
 } 
  #profilefriend_left
 {
  width: 30%;
  height: 800px;
  float: left;
  
 }
  #profilefriend_right
 {
  width: 70%;
  height: 800px;
  
  float: left;
 } 
 .prf_profile
 {
  width: 100%;
  float: left;
 background-color: #E6E6FA;
  height: 400px;
  margin-top: 10px;
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
.prf_content
 {
  
  width: 100%;
  float: left;
  height: 30px;
  
 }
 .prf_clear
 {
  padding-bottom: 20px;
 clear: both;
 color: #57970F;

 } 
 .prf_member
 {
  font-size: 13pt;
  text-align: center;
 
  margin-top: 10px;
 } 
.prf_avatar
 {
  margin-left: 70px;
  margin-right: 30px;
  margin-top: 10px;
  margin-bottom: 10px;
  min-height: 80px;
  max-height: 160px;
  width: 123px;

 }
 .prf_note
 {
  clear: both;
  height: auto;
  width: 100%;
 }
.prf_titlenote
{
  float: left;
margin-left: 5px;
font-weight: bold;
color: #0081a1;
font-size: 12px;
}
.pr_bt_viewmore_c { margin-left: 20px; height:21px; float:left; background: url("http://ptnn.vn/3rdparty/uploads/img/btt.png") 0px -28px  repeat-x ; text-transform:uppercase; color:#757575; font-size:11px; font-family:Tahoma, sans-serif; font-weight:bold; padding:7px 6px 0 0; padding-top:8px; height:20px ;}
.pne_st1_r_file_bt {float:right; background:url("http://data.tienganh123.com/images/v2/pne_bt_file.jpg") repeat-x; /*padding:10px 15px 0 15px;*/ height:25px; font-weight:bold; border-radius:4px;margin-left: 4px; }
.pfr_avatar_wall
{

  clear: both;
  width: 30%;
  height: auto;float: left;
}
.prf_write_wall
{
  width: 100%;
  height:auto;
}
</style>
<?php  
  $request=pzk_element('request');
  $member=$request->get('member');
 
  $user=_db()->getEntity('User.User');
  $user->loadWhere(array('username',$member));
 
?>
<div id="profilefriend">
  <div id="profilefriend_left">
    <div class="prf_profile">
      <div class="prf_member"> <?php echo $member; ?></div>
      <div class="prf_member">
        <?php 
          if(pzk_session('username')==$member)
          {
        ?>
        <img src="<?php echo BASE_URL.'/3rdparty/uploads/img/online.png' ; ?>" alt=""> Online
        <?php    
          }
          else
          { ?>
        <img src=" <?php echo BASE_URL.'/3rdparty/uploads/img/offline.png' ; ?>" alt=""> Offline
          <?php 
          }
         ?>
      </div>
      <div>
       
      </div>
      <div class="prf_avatar">
        <img src=" <?php if($user->get('avatar')=="")
        {
          echo BASE_URL.'/3rdparty/uploads/img/noavatar.gif' ;
        }else echo $user->get('avatar');
        ?>" alt="avatar" width="100px" height="100px;">
      </div>
      <div class="prf_member">
        <a href="/user/denyfriend?userfriend=<?php echo $user->get('username'); ?>"><img src="<?php echo BASE_URL.'/3rdparty/uploads/img/huyketban.png' ; ?>" alt="Bạn bè"></a>
      </div>
      <div class="prf_content" style="background-color:#F0FFFF;"> Ngày sinh: <strong><?php echo $user->get('birthday'); ?> </strong> </div>
      <div class="prf_content" style="background-color:#FFF8DC;"> Giới tính: <strong><?php echo $user->get('sex'); ?></strong></div>
      <div class="prf_content" style="background-color:#F0FFFF;"> Điểm thành tích:  </div>
      <div class="prf_content" style="background-color:#FFF8DC;"> Sổ học bạ:</div>
      <div class="prf_content" style="background-color:#F0FFFF;"> Tham gia được:  </div>
      <div class="prf_content" style="background-color:#FFF8DC;"><a href="#">Xem thông tin cá nhân</a></div>
      <div class="prf_clear"></div>
    </div>

    <div class="prf_profile" style="margin-top: 20px;">
      <div class="prf_title">BÀI HỌC CỦA THÀNH VIÊN</div>
      <div class="prf_content"><a href="">Bài học yêu thích</a> </div>
      <div class="prf_content"> <a href="">Điểm thành tích</a> </div>
      <div class="prf_content"> <a href="">Lịch sử học tập</a> </div>
      <div class="prf_content"> <a href="">Về trang của tôi</a> </div>
      <div class="prf_clear"></div>
    </div>
  </div>


  <div id="profilefriend_right">
    <div class="prf_title">Chào mừng bạn đã ghé thăm góc học tập của tôi</div>
    <div class="prf_clear" style="width: 100%; height: 30px;"></div>

    <div class="prf_title" style="width:30%;">Ghi chép cá nhân</div>
    <div class="prf_note">
      <?php 
        $notes=$data->loadNote();

      ?>
      {each $notes as $note}
      <div>
      <div style="float:left;">
        <img src="<?php echo BASE_URL.'/3rdparty/uploads/img/usernote.png' ; ?>" alt="">
      </div>
      <div class="prf_titlenote">
         {note[titlenote]}
      </div>

      <div class="prf_clear"> </div>
       
      </div>
      {/each}
      <div class="pr_bt_viewmore_c">
        <a href="#">Xem tất cả</a>
      </div>
      
    </div>
    
    
    
    <div class="prf_clear" style="width: 100%; height: 60px;"></div>
    <div class="prf_title" style="width:30%; margin-bottom: 30px;">Viết lên tường</div>

    
    <div class="prf_clear" style="width: 100%; height: 50px; margin-bottom: 100px;">
      <textarea id="pr_post_wall" style="border:1px solid #cecece; min-height:110px;width:100%;" rel="false">Nhập nội dung... (Nội dung ít nhất 10 kí tự)</textarea>
      <input type="button" id="prfwrite_wall" name="send" value="Gửi">
      <script>
        $('#prfwrite_wall').click(function()
        {
          <?php $request = pzk_element('request');  ?>
          var write_wall= $('#pr_post_wall').val();
          var avatar1='<?php echo pzk_session('avatar'); ?>';
          var userwritewall= '<?php echo pzk_session('username'); ?>';
          var username= '<?php echo $member; ?>';
          var datetime= '<?php echo date("Y-m-d H:i:s"); ?>';
          $.ajax({
            url:'http://ptnn.vn/user/PostCommentFriend',
            data:{
              username: username,
              write_wall:write_wall }, 
            success:function(result){
            
              $('#prf_comment_wall div:eq(0)').before('<div><div class="prf_write_wall"><div class="pfr_avatar_wall"><img src="'+avatar1+'" alt="" width="60" height="60"></div><div class="prf_titlenote" style="width:30%; height: auto; float:left;"><a href="/user/profilefriend?member='+userwritewall+'">'+userwritewall+'</a></div><div class="prf_titlenote" style="width:30%; height: auto; float:left;">'+write_wall+' </div><div class="prf_titlenote">'+datetime+' </div><div class="prf_clear"> </div></div></div>');
              
              
            }
          });

        
        });
      </script>
    </div>
    
    <div  id="prf_comment_wall"class="prf_note" style="margin-bottom: 50px;">
      <?php 
        $write_walls=$data->loadWriteWall();

      ?>
      {each $write_walls as $write_wall}
      <div>
    <div class="prf_write_wall" >
      <div class="pfr_avatar_wall">
        <img src="<?php echo BASE_URL.'/3rdparty/uploads/img/noavatar.gif' ; ?>" alt="" width="60" height="60">
      </div>
      <div class="prf_titlenote" style="width:30%; height: auto; float:left;">
        <a href="/user/profilefriend?member=<?php echo $write_wall['userwritewall']; ?>" >{write_wall[userwritewall]}</a>
         
      </div>
      <div class="prf_titlenote"style="width:30%; height: auto; float:left;">
         {write_wall[content]}
      </div>
      <div class="prf_titlenote">
         {write_wall[datewrite]}
      </div>
      <div class="prf_clear"> </div>
       
      </div>
    </div>
      {/each}
      <div class="pr_bt_viewmore_c">
        <a href="#">Xem tất cả</a>
      </div>
      
    </div>

  </div>
</div>