
<style>

  #div_view_write_wall
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
.prf_titlenote
{
  float: left;
margin-left: 5px;
font-weight: bold;
color: #0081a1;
font-size: 12px;
}
.pr_bt_viewmore_c { margin-left: 20px; height:21px; float:left; background: url("../../3rdparty/uploads/img/btt.png") 0px -28px  repeat-x ; text-transform:uppercase; color:#757575; font-size:11px; font-family:Tahoma, sans-serif; font-weight:bold; padding:7px 6px 0 0; padding-top:8px; height:20px ;}

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


<div id="div_view_write_wall">
    <div class="prf_title">Chào mừng bạn đã ghé thăm góc học tập của tôi</div>
    <div class="prf_clear" style="width: 100%; height: 30px;"></div>

   
    
    <div class="prf_clear" style="width: 100%; height: 60px;"></div>
    <div class="prf_title" style="width:30%; margin-bottom: 30px;">Viết lên tường</div>

    
    <div class="prf_clear" style="width: 100%; height: 50px; margin-bottom: 100px;">
      <textarea id="viewall_post_wall" style="border:1px solid #cecece; min-height:110px;width:100%;" placeholder="Nhập nội dung... (Nội dung ít nhất 10 kí tự)" rel="false"></textarea>
      <input type="button" id="btt_viewall_write_wall" name="send" value="Gửi">
      <?php 
        $member=pzk_request('member');
        $loadUserName=$data->loadUserName($member);
        $username=$loadUserName['username'];
       ?>
      <script>
       
      </script>
    </div>
    
    <div id="viewall_write_wall" class="prf_note" style="margin-bottom: 50px;">
      <?php 
          $member=pzk_request('member');
          $write_walls=$data->viewWriteWall($member);

      ?>
      {each $write_walls as $write_wall}
    <div>


    <div class="prf_write_wall">
      <div class="pfr_avatar_wall">
        <img src="
        <?php 
        $username=$write_wall['userwritewall'];
        $loadUserID=$data->loadUserID($username);
        $avatar=$loadUserID['avatar'];
        if($avatar !=''){
          echo $avatar;
        }else{
           echo BASE_URL.'/defaul/skin/nobel/ptnn/media/noavatar.gif' ;
          }
         ?>" alt="" width="60" height="60">
      </div>
      <div class="prf_titlenote" style="width:30%; height: auto; float:left;">
       <a href="/user/profile/user?member=<?php echo $loadUserID['userid']; ?>" >{write_wall[userwritewall]}</a>
         
      </div>
      <div class="prf_titlenote" style="width:30%; height: auto; float:left;">
        {write_wall[content]}    
       </div>
      <div class="prf_titlenote">
        {write_wall[datewrite]}   
      </div>
      <div class="prf_clear"> </div>
       
      </div>
    </div>
    {/each}
           
  

    </div>
   
    <div>
     Trang 
    <?php 
      $num_page= $data->numberPage($member);
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
          page_wall: page,
          member: "<?php echo $member ?>"
        },
        url:'/friend/viewwritewallPage',
        success: function(msg){
          //alert(msg);
          $('#viewall_write_wall').html(msg);
        }

      });
    }

     $('#btt_viewall_write_wall').click(function()
        {
          <?php $request = pzk_request();  ?>
          var member= '<?php echo $request->get('member'); ?>';
          var write_wall= $('#viewall_post_wall').val();
          var avatar1='<?php echo pzk_session('avatar'); ?>';
          var userwritewall= '<?php echo pzk_session('username'); ?>';
          var username= '<?php echo $username; ?>';
          var datewrite= '<?php echo date("Y-m-d H:i:s"); ?>';
          
          $.ajax({
            url:'/user/PostCommentFriend',
            data:{
              username: username,
              write_wall:write_wall }, 
            success:function(result){
             
              
              $('#viewall_write_wall div:eq(0)').before('<div><div class="prf_write_wall"><div class="pfr_avatar_wall"><img src="'+avatar1+'" alt="" width="60" height="60"></div><div class="prf_titlenote" style="width:30%; height: auto; float:left;"><a href="/user/user?member='+username+'">'+username+'</a></div><div class="prf_titlenote" style="width:30%; height: auto; float:left;">'+write_wall+'</div><div class="prf_titlenote">'+datewrite+'</div><div class="prf_clear"> </div></div>');
             
            }
          });

        
        });
  </script>

  </div>