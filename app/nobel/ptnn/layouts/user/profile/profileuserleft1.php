<style>
 #profilefriend
 {
  width: 30%;
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
  font-size: 11pt;
  text-align: center;
  color: #AA0000;
  font-weight: bold;
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
.pr_bt_viewmore_c { margin-left: 20px; height:21px; float:left; background: url("/3rdparty/uploads/img/btt.png") 0px -28px  repeat-x ; text-transform:uppercase; color:#757575; font-size:11px; font-family:Tahoma, sans-serif; font-weight:bold; padding:7px 6px 0 0; padding-top:8px; height:20px ;}
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
  
  $member=pzk_request()->getMember();
  if(!$member){
    $member=pzk_session('userId');
  }
  $user=$data->loadUserName($member);
 
?>
<div id="profilefriend_left">
    <div class="prf_profile">
      <div class="prf_member"><?php echo $user->getUsername(); ?></div>
      <div class="prf_member">
       <?php 
          $check= $data->testMember($member);
          echo $check;
        ?>
            
      </div>
      <div>
       
      </div>
      <div class="prf_avatar">
      <?php 
        $avatar=$data->testAvatar($member);
       ?>
        <img src=" <?php echo $avatar; ?>" alt="avatar" width="100px" height="100px;">
      </div>
      
      <div class="prf_member">
      <?php 
        echo $data->testStatus($member);
        
       ?>
     
      </div>
      <div class="prf_clear"></div>
      <div class="prf_content" style="background-color:#F0FFFF;"> Ngày sinh: <strong><?php echo $user->getBirthday(); ?> </strong> </div>
      <div class="prf_content" style="background-color:#FFF8DC;"> Giới tính: <strong><?php echo $user->getSex(); ?></strong></div>
      <div class="prf_content" style="background-color:#F0FFFF;"> Điểm thành tích:  </div>
      <div class="prf_content" style="background-color:#FFF8DC;"> Sổ học bạ:</div>
      <div class="prf_content" style="background-color:#F0FFFF;"> Tham gia được:  </div>
      <div class="prf_content" style="background-color:#FFF8DC;"><a href="/user/viewinfor?member=<?php echo $member; ?>">Xem thông tin cá nhân</a></div>
      <div class="prf_clear"></div>
    </div>

    <div class="prf_profile" style="margin-top: 20px;">
      <div class="prf_title">BÀI HỌC CỦA THÀNH VIÊN</div>
      <div class="prf_content"><?php echo $data->checkMember($member) ?></div>
      <div class="prf_content"> <a href="">Điểm thành tích</a> </div>
      <div class="prf_content"> <a href="/user/lessonhistory?member=<?php echo $member ?>">Lịch sử học tập</a> </div>
      <div class="prf_content"> <a href="/user/user?member=<?php echo pzk_session('userId'); ?>">Về trang của tôi</a> </div>
      <div class="prf_clear"></div>
    </div>
  </div>